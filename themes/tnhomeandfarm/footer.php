<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ag_Sites
 */

 
 $facebook = get_field('facebook', 'options');
 $instagram = get_field('instagram', 'options');
 $pinterest = get_field('pinterest', 'options');
 $youtube = get_field('youtube', 'options');
 $twitter = get_field('twitter', 'options');
//  echo '<ul class="newsletter-social">';
//  echo $facebook ? '<li class="facebook"><a href="'.esc_url($facebook).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/facebook.svg" /></a></li>' : '';
//  echo $instagram ? '<li class="instagram"><a href="'.esc_url($instagram).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/instagram.svg" /></a></li>' : '';
//  echo $pinterest ? '<li class="pinterest"><a href="'.esc_url($pinterest).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/pinterest.svg" /></a></li>' : '';
//  echo $youtube ? '<li class="youtube"><a href="'.esc_url($youtube).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/youtube.svg" /></a></li>' : '';
//  echo $twitter ? '<li class="twitter"><a href="'.esc_url($twitter).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/twitter.svg" /></a></li>' : '';
//  echo '</ul>';

if ( !is_front_page() && !is_page('newsletter') ) {
    get_template_part( 'template-parts/blocks/newsletter'); 
}
?>

<footer id="colophon" class="site-footer">
		<div class="site-info container">
		<?php wp_nav_menu(array('theme_location' => 'bottom_menu', 'menu_class' => 'menu font__sans-serif')); ?>
        <?php //dynamic_sidebar('footer'); ?>
		<div class="row">
			<div class="col-12 m-col-2"></div>
			<div class="col-12 m-col-4 footer-left">
			<a href="<?php echo site_url(); ?>"><img width="260" src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/THF-white.svg" /></a>
				<?php echo wp_kses_post(get_field('left_footer', 'options') );?>
             <?php //get_template_part('template-parts/social-icons'); 
			   echo '<ul class="newsletter-social">';
			 echo $facebook ? '<li class="facebook"><a href="'.esc_url($facebook).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/facebook-white.svg" /></a></li>' : '';
			 echo $instagram ? '<li class="instagram"><a href="'.esc_url($instagram).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/instagram-white.svg" /></a></li>' : '';
			 echo $pinterest ? '<li class="pinterest"><a href="'.esc_url($pinterest).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/pinterest-white.svg" /></a></li>' : '';
			 echo $youtube ? '<li class="youtube"><a href="'.esc_url($youtube).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/youtube-white.svg" /></a></li>' : '';
			 echo $twitter ? '<li class="twitter"><a href="'.esc_url($twitter).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/twitter-white.svg" /></a></li>' : '';
			 echo '</ul>';
?>
			</div>
			<div class="col-12 m-col-6 footer-right">
				<p class="tfb-title">Tennessee Farm Bureau</p>
				<div class="footer-right-flex">
				<a href="https://tnfarmburearu.org" target="_blank"><img width="125" src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/tfbf-logo.svg" /></a>
				<?php echo wp_kses_post(get_field('right_footer', 'options') ); ?>
				</div>
			</div>
		</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
    </div><!-- #page -->
<div class="search-pop-up">
    <div class="close-search"><i class="fas fa-times"></i></div>
    <?php get_search_form(); ?>
</div>
<?php wp_footer(); ?>

</body>
</html>