<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ag_Sites
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Partners_150.jpg"> 
	<!-- <link rel="stylesheet" href="https://use.typekit.net/tua3ynd.css">	 -->

	<?php wp_head(); ?>
	<!-- <script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=tbkhoq6cpkdn2dguhvqrpq" async="true"></script> -->
	<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
	<script>
	  window.googletag = window.googletag || {cmd: []};
	  googletag.cmd.push(function() {
	  googletag.defineSlot('/51853864/partners_desktop_mobile_medium_rectangle', [300, 250], 'div-gpt-ad-1692784904931-0').addService(googletag.pubads());
      googletag.defineSlot('/51853864/partners_desktop_leaderboard', [728, 90], 'div-gpt-ad-1692784329715-0').addService(googletag.pubads());
      googletag.defineSlot('/51853864/partners_mobile_leaderboard', [320, 50], 'div-gpt-ad-1692784622292-0').addService(googletag.pubads());
	  googletag.defineSlot('/51853864/partners_desktop_in_content_medium_rectangle', [300, 250], 'div-gpt-ad-1694457127306-0').addService(googletag.pubads());
	    googletag.pubads().enableSingleRequest();
	    googletag.enableServices();
	  });
	</script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ag-sites' ); ?></a>

	<header id="masthead" class="site-header">
	<div class="nav-container">
		<div class="site-branding">
			<?php
			// the_custom_logo();
			if (  is_home() ) :
				?>
				<img class="site-logo green"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/green-ilfb.svg" alt="mississippi farm country" />
				<img class="site-logo white" style="display: none;"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/white-ilfb.svg" alt="illinois farm bureau partners" />
				<?php
			else :
				?>
				<a href="<?php echo home_url(); ?>">
				<img class="site-logo green"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/green-ilfb.svg" alt="mississippi farm country" />
				<img class="site-logo white" style="display: none;"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/white-ilfb.svg" alt="illinois farm bureau partners" />
				</a>
				<?php
			endif;
			// $ag_sites_description = get_bloginfo( 'description', 'display' );
			// if ( $ag_sites_description || is_customize_preview() ) :
				?>
				<!-- <p class="site-description"><?php //echo $ag_sites_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p> -->
			<?php //endif; ?>
		</div><!-- .site-branding -->

		
		<!-- <div class="hamburger menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</div> -->
			<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ag-sites' ); ?></button> -->
			<nav id="site-navigation" class="main-navigation">
			<?php
            wp_nav_menu(
				array(
					'theme_location' => 'top_bar_22',
					'menu_id'        => 'top_bar_22',
				)
			);
			?> 
		</nav><!-- #site-navigation -->
		<?php
		//  $facebook = get_field('facebook', 'options');
		//  $twitter = get_field('twitter', 'options');
		//  $pinterest = get_field('pinterest', 'options');
		//  $youtube = get_field('youtube', 'options');
		//  echo '<ul class="header-social">';
		//  echo $facebook ? '<li class="facebook background__primary"><a href="'.esc_url($facebook).'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>' : '';
		//  echo $twitter ? '<li class="twitter background__primary"><a href="'.esc_url($twitter).'" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" fill="#ffffff" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a></li>' : '';
		//  echo $pinterest ? '<li class="pinterest background__primary"><a href="'.esc_url($pinterest).'" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>' : '';
		//  echo $youtube ? '<li class="youtube background__primary"><a href="'.esc_url($youtube).'" target="_blank"><i class="fab fa-youtube"></i></a></li>' : '';
		//  echo '</ul>';
		?>
		
		<button class="search-btn"><i class="fa fa-search"></i></button>
		<div class="hamburger menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</div>
		
		</div><!-- nav-container -->
		

	</header><!-- #masthead -->
