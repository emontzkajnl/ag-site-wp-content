<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>

<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<meta name="p:domain_verify" content="cdc6861554d64a285810169775cf758c"/>


<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

<?php 
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); 
?>

<meta property="og:image" content="<?php echo $thumb['0']; ?>" />

<?php } ?>



<title><?php wp_title( '-', true, 'right' ); ?></title>



<?php if(get_option('mvp_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('mvp_favicon'); ?>" /><?php } ?>

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>



<?php $analytics = get_option('mvp_tracking'); if ($analytics) { echo stripslashes($analytics); } ?>


<?php wp_head(); ?>
<?php // Cordless Ad Setup ?>
<?php
////// DATA VARS //////
// $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// Check for Main Section Pages
	if (is_page('online-library')) {$categories = 'magazine'; $pagetype = 'magazine'; $subcats = 'magazine';}
	if (is_front_page()) {$pagetype = 'page'; $categories = 'Home';}
if (is_category()) {
	$cat = get_queried_object();
	$catid = $cat->term_id;
	$topcat = pa_category_top_parent_id($catid);
	$topcatname = get_cat_name($topcat);
	$categories = $topcatname;
	$subcats = get_cat_name($catid);
	$pagetype = 'category';
}
if (is_single()) {
	$posttype = get_post_type();
	$pagetype = 'article';
	if ($posttype == 'magazine') {$pagetype = 'magazine';}
	$cat = get_queried_object();
 	$cat = get_the_category($cat);
 	$catid = $cat[0]->term_id;
 	$topcat = pa_category_top_parent_id($catid);
 	$categories = get_cat_name($topcat);
 	$catnames = array();
 	foreach ($cat as $mysub) {
 		$catnames[] = $mysub->name;
 	}
 	$subcats = implode(',', $catnames);
 	if ($posttype == 'magazine') {$pagetype = 'magazine'; $categories = 'magazine'; $subcats = 'magazine';}
}
?>
<!-- Public Data Object -->
<script>
	var ListingObj = {
		pageslug: '<?php echo $_SERVER['REQUEST_URI'] ?>',
		pagetype: '<?php echo $pagetype; ?>',
		category: '<?php echo $categories; ?>',
		subcategories: '<?php echo $subcats; ?>'
	}
</script>


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '115526493224295');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=115526493224295&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<script src="https://ads.cordlessmedia.com/ad-wrapper/25541/cm.min.js"></script>

<style type="text/css">

<?php $customcss = get_option('mvp_customcss'); if ($customcss) { echo stripslashes($customcss); } ?>

</style>


<script type='text/javascript' src='https://www.tnhomeandfarm.com/wp-content/themes/thf-child/js/libs/modernizr.custom.min.js'></script>

<!-- <script type="text/javascript">
/*
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'none')
          e.style.display = 'block';
          e.style.height = '50px';
       else
          e.style.display = 'none';
    }
/*
</script> -->

<?php if (is_mobile()) { ?>
	<style>
	.woobox-offer {
		max-width:280px !important;
		margin-left:0px !important;
	}
	</style>
<?php } ?>

</head>

<body <?php body_class(); ?>>
<div id="site">
	<?php get_template_part('fly-menu'); ?>
	<div id="nav-wrapper">
		<div class="nav-wrap-out">
		<div class="nav-wrap-in">
			<div id="nav-inner">
				<div class="fly-but-wrap left relative" style="margin-top:4px;">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div><!--fly-but-wrap-->
			<?php $mvp_logo_loc = get_option('mvp_logo_loc'); if($mvp_logo_loc == 'Left of leaderboard' || $mvp_logo_loc == 'Wide below leaderboard') { ?>
				<div class="logo-small-fade" itemscope itemtype="http://schema.org/Organization">
					<?php if(get_option('mvp_logo')) { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo_nav'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-small.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--logo-small-fade-->
			<?php } else { ?>
				<div id="logo-small" itemscope itemtype="http://schema.org/Organization">
					<?php if(get_option('mvp_logo')) { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-small.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--logo-small-->
			<?php } ?>
			<div id="main-nav">
				<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
			</div><!--main-nav-->
			<div id="search-button">
				<img src="<?php echo get_template_directory_uri(); ?>/images/search-icon.png" />
			</div><!--search-button-->
			<div id="search-bar">
				<?php get_search_form(); ?>
			</div><!--search-bar-->
			</div><!--nav-inner-->
		</div><!--nav-wrap-in-->
		</div><!--nav-wrap-out-->
	</div><!--nav-wrapper-->	
	<div id="body-wrapper">

		<?php if ( is_home() || is_front_page() ) { ?>
		<?php if(get_option('mvp_wall_ad')) { ?>
		<div id="wallpaper">
			<?php if(get_option('mvp_wall_url')) { ?>
			<a href="<?php echo get_option('mvp_wall_url'); ?>" class="wallpaper-link" target="_blank"></a>
			<?php } ?>
		</div><!--wallpaper-->
		<?php } ?>
		<?php } ?>

		<div id="main-wrapper">
		
				<img id="print-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/thf-print-logo.jpg" />

				<div id="leaderboard-wrapper" class="logo-header">

					<div style="width:100%; text-align:center;">
					<!-- /14503085/CordlessMedia_tnhomeandfarm.com_ROS_ATF_970x90 -->
					<div id='div-gpt-ad-1568935880246-0'>
					  <script>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1568935880246-0'); });
					  </script>
					</div>
					<?php // echo "advertisement "; echo $adhesive; ?>
					</div>

				</div><!--leaderboard-wrapper-->
