<?php
/**
 * AJAX Drop-in to track ads.
 *
 * This method speeds up ad tracking by a factor of 100 compared to wp-admin/admin-ajax.php
 * If you wish not to use this tracking method, please set the constant ADVANCED_ADS_TRACKING_LEGACY_AJAX,
 * i.e. define( 'ADVANCED_ADS_TRACKING_LEGACY_AJAX', true ) in your wp-config.php
 */
// phpcs:disable WordPress.Security.NonceVerification
// phpcs:disable WordPress.PHP.NoSilencedErrors.Discouraged
// phpcs:disable WordPress.DateTime.RestrictedFunctions

$start_time = microtime( true );

// set some headers to avoid caching.
$headers = array(
	'X-Content-Type-Options: nosniff',
	'Cache-Control: no-cache, must-revalidate, max-age=0, smax-age=0',
	'Expires: Sat, 26 Jul 1997 05:00:00 GMT',
	'X-Accel-Expires: 0',
	'X-Robots-Tag: noindex',
);
foreach ( $headers as $header ) {
	@header( $header );
}
header_remove( 'Last-Modified' );

// ensure headers are send.
flush();

// do not stop when user ended the connection.
@ignore_user_abort( true );

$data = strtolower( $_SERVER['REQUEST_METHOD'] ) === 'get' ? $_GET : $_POST;

if ( empty( $data ) ) {
	$data = json_decode( file_get_contents( 'php://input' ), true );
	if ( is_array( $data ) ) {
		// add data back to global request vars.
		$_POST    = array_merge( $_POST, $data );
		$_REQUEST = array_merge( $_REQUEST, $data );
	}
}

if ( empty( $data['ads'] ) || ! is_array( $data['ads'] ) ) {
	die( 'no ads' );
}

if ( empty( $data['action'] ) || ! in_array( $data['action'], array( 'aatrack-records', 'aatrack-click' ), true ) ) {
	die( 'nothing to do' );
}

// 12: regex string to match bots. Empty if tracking bots.
$bots = 'bot|spider|crawler|scraper|parser|008|Accoona-AI-Agent|ADmantX|alexa|appie|Apple-PubSub|Arachmo|Ask Jeeves|avira\.com|B-l-i-t-z-B-O-T|boitho\.com-dc|BUbiNG|Cerberian Drtrs|Charlotte|cosmos|Covario IDS|curl|Datanyze|DataparkSearch|Dataprovider\.com|DDG-Android|Ecosia|expo9|facebookexternalhit|Feedfetcher-Google|FindLinks|Firefly|froogle|Genieo|heritrix|Holmes|htdig|https:\/\/developers\.google\.com|ia_archiver|ichiro|igdeSpyder|InfoSeek|inktomi|Kraken|L\.webis|Larbin|Linguee|LinkWalker|looksmart|lwp-trivial|mabontland|Mnogosearch|mogimogi|Morning Paper|MVAClient|NationalDirectory|NetResearchServer|NewsGator|NG-Search|Nusearch|NutchCVS|Nymesis|oegp|Orbiter|Peew|Pompos|PostPost|proximic|PycURL|Qseero|rabaz|Radian6|Reeder|savetheworldheritage|SBIder|Scooter|ScoutJet|Scrubby|SearchSight|semanticdiscovery|Sensis|ShopWiki|silk|Snappy|Spade|Sqworm|StackRambler|TechnoratiSnoop|TECNOSEEK|Teoma|Thumbnail\.CZ|TinEye|truwoGPS|updated|Vagabondo|voltron|Vortex|voyager|VYU2|WebBug|webcollage|WebIndex|Websquash\.com|WeSEE:Ads|wf84|Wget|WomlpeFactory|WordPress|yacy|Yahoo! Slurp|Yahoo! Slurp China|YahooSeeker|YahooSeeker-Testing|YandexBot|YandexMedia|YandexBlogs|YandexNews|YandexCalendar|YandexImages|Yeti|yoogliFetchAgent|Zao|ZyBorg|okhttp|ips-agent|ltx71|Optimizer|Daum|Qwantify|AspiegelBot|BingPreview|bingbot|datanyze|ecosia|Googlebot|Google-AMPHTML|GoogleAdSenseInfeed|Hexometer|mediapartners|^Mozilla\/5\.0$|Barkrowler|Seekport Crawler|Sogou web spider|WP Rocket|FlyingPress';
if ( ! empty( $bots ) ) {
	// Check user agent if is bot.
	$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? stripslashes( $_SERVER['HTTP_USER_AGENT'] ) : '';
	if ( empty( $user_agent ) ) {
		die( 'not tracking bots' );
	}

	// create regex as variable.
	if ( preg_match( '/' . $bots . '/i', $user_agent ) ) {
		die( 'not tracking bots' );
	}
}

@date_default_timezone_set( 'UTC' );

// open db connection
// phpcs:disable WordPress.DB.RestrictedFunctions
// 1: host, 2: user, 3: password, 4: db name, 5: port, 6: socket.
$mysqli = @mysqli_connect( 'database', 'wordpress', 'wordpress', 'wordpress', '0', '' );
if ( ! $mysqli ) {
	die( 'Could not connect to database' );
}

// 7: table prefix.
$prefix = $data['bid'] > 1 ? 'wp_' . $data['bid'] . '_' : 'wp_';
$table  = $data['action'] === 'aatrack-records' ? 'advads_impressions' : 'advads_clicks';

foreach ( array_count_values( array_filter( array_map( 'intval', $data['ads'] ) ) ) as $ad_id => $count ) {
	$error_msg = adt_track( $ad_id, $mysqli, $prefix, $table, $count );

	// 9: debugging active, 10: ad_id to debug.
	if ( 'false' === 'true' || (int) '0' === $ad_id ) {
		// 10: debugger file path
		require_once '/app/wp-content/plugins/advanced-ads-tracking/classes/debugger.php';
		while ( $count-- ) {
			Advanced_Ads_Tracking_Debugger::log(
				(int) $ad_id,
				$prefix . $table,
				empty( $error_msg ) ? round( ( microtime( true ) - $start_time ) * 1000 ) : -1,
				$data['handler'] === 'Frontend on AMP' ? 'Frontend on AMP' : 'Frontend',
				$error_msg,
				'/app/wp-content/advanced-ads-tracking-msfarmcountry_com-f1af905511c70f882795661498ba739b.csv' // 8: debug file.
			);
		}
	}
}

mysqli_close( $mysqli );

/**
 * Write impression to database.
 *
 * @param int    $ad_id  The ID of the ad to track.
 * @param mysqli $mysqli DB instance.
 * @param string $prefix Table prefix to track into.
 * @param string $table  Table to track click|impression.
 * @param int    $count  Number of impressions.
 *
 * @return string Error message, or empty string on success.
 */
function adt_track( $ad_id, $mysqli, $prefix, $table, $count ) {
	$ts    = advads_timestamp();
	$count = (int) $count;
	// 7: table prefix.
	$success = mysqli_query( $mysqli, "INSERT INTO `${prefix}${table}` (`ad_id`, `timestamp`, `count`) VALUES (${ad_id}, ${ts}, ${count}) ON DUPLICATE KEY UPDATE `count` = `count`+ ${count}" );

	if ( $success ) {
		return '';
	}

	return mysqli_error( $mysqli );
}

/**
 * Get timestamp string; only do this once per request.
 *
 * @return string
 */
function advads_timestamp() {
	static $ts;
	if ( ! is_null( $ts ) ) {
		return $ts;
	}
	$timezone = 'America/Chicago';
	if ( preg_match( '/^\d/', $timezone ) ) {
		$timezone = '+' . $timezone;
	}
	$time = new DateTime( 'now', new DateTimeZone( $timezone ) );
	// default timestamp
	$ts = $time->format( 'ymWd06' );

	// check for week/month inconsistencies
	$week  = abs( $time->format( 'W' ) );
	$month = abs( $time->format( 'm' ) );

	if ( 52 <= $week && 1 === $month ) {
		// still week 52 but already in January
		$ts = $time->format( 'ym01d06' );
	} elseif ( 12 === $month && $week > 52 ) {
		// still in December but week 53
		$ts = $time->format( 'ym52d06' );
	}

	return $ts;
}

die( 'ok' );
