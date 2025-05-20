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

<style type="text/css">

<?php $customcss = get_option('mvp_customcss'); if ($customcss) { echo stripslashes($customcss); } ?>

</style>


<script type='text/javascript' src='https://www.tnhomeandfarm.com/wp-content/themes/thf-child/js/libs/modernizr.custom.min.js'></script>

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

					<div style="width:100%; text-align:center; margin:20px auto; 0px">
						<?php
						if( function_exists('the_ad_placement') ) { the_ad_placement('top-leaderboard'); }
						?>
					</div>

				</div><!--leaderboard-wrapper-->
