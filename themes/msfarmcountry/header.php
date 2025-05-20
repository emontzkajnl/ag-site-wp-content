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
	<!-- <link rel="stylesheet" href="https://use.typekit.net/tua3ynd.css">	 -->
	<link rel="stylesheet" href="https://use.typekit.net/tmv3pgb.css">

	<?php wp_head(); ?>
	<!-- <script src="https://ads.cordlessmedia.com/ad-wrapper/28541/cm.min.js"></script> -->
	<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=2psitrn1k3ic3lkw0efdrg" async="true"></script>
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
			if ( is_front_page() && is_home() ) :
				?>
				<img class="site-logo"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/msfc-logo-white.svg" alt="mississippi farm country" />
				<?php
			else :
				?>
				<a href="<?php echo home_url(); ?>"><img  class="site-logo"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/msfc-logo-white.svg" alt="mississippi farm country" /></a>
				<?php
			endif;
			// $ag_sites_description = get_bloginfo( 'description', 'display' );
			// if ( $ag_sites_description || is_customize_preview() ) :
				?>
				<!-- <p class="site-description"><?php //echo $ag_sites_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p> -->
			<?php //endif; ?>
		</div><!-- .site-branding -->

		
		<div class="hamburger menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</div>
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
		<?php //get_template_part('template-parts/social-icons'); ?>
		<button class="search-btn"><i class="fa fa-search"></i></button>
		
		</div><!-- nav-container -->

	</header><!-- #masthead -->
