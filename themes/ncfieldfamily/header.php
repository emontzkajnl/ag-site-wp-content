<?php
/**
 * The header for our child theme
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
	<link rel="stylesheet" href="https://use.typekit.net/gro4msi.css">

	<?php wp_head(); ?>
	<!-- <script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=tbkhoq6cpkdn2dguhvqrpq" async="true"></script> -->

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ag-sites' ); ?></a>

	<header id="masthead" class="site-header">
	<div class="nav-container">
		<div class="site-branding">
			<?php
            if (!is_front_page()):
				?>
                <a href="<?php echo home_url(); ?>">

				<img class="site-logo"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/NCFF_logo_white.svg" alt="North Carolina Field Family" />
            </a>
		
				<?php
                else:
				?>
                <img class="site-logo"  src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/NCFF_logo_white.svg" alt="North Carolina Field Family" />

				<!-- <p class="site-description"><?php //echo $ag_sites_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p> -->
			<?php endif; ?>
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
		//  $instagram = get_field('instagram', 'options');
		//  $pinterest = get_field('pinterest', 'options');
		//  $youtube = get_field('youtube', 'options');
		//  echo '<ul class="newsletter-social">';
		//  //echo $facebook ? '<li class="facebook background__primary"><a href="'.esc_url($facebook).'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>' : '';
		//  echo $facebook ? '<li class="facebook"><a href="'.esc_url($facebook).'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>' : '';
		//  echo $instagram ? '<li class="instagram"><a href="'.esc_url($instagram).'" target="_blank"><i class="fab fa-instagram"></i></a></li>' : '';
		//  echo $pinterest ? '<li class="pinterest"><a href="'.esc_url($pinterest).'" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>' : '';
		//  echo $youtube ? '<li class="youtube"><a href="'.esc_url($youtube).'" target="_blank"><i class="fab fa-youtube"></i></a></li>' : '';
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
