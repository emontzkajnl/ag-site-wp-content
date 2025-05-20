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
 $twitter = get_field('twitter', 'options');
 $pinterest = get_field('pinterest', 'options');
 $instagram = get_field('instagram', 'options');
 $mag_args = array(
     'numberposts'       => 1,
     'post_type'         => 'magazine'
 );
$latest_mag = get_posts($mag_args);
// print_r($latest_mag);
if ( !is_front_page() && !is_page('newsletter') ) {
    get_template_part( 'template-parts/mag-social'); 
}

?>


	<footer id="colophon" class="site-footer">
    <div class="container">
    <?php wp_nav_menu(array('theme_location' => 'bottom_menu', 'menu_class' => 'menu font__sans-serif')); ?>
		<div class="site-info container">
        <?php //dynamic_sidebar('footer'); ?>
		<div class="row">
			<div class="col-12 l-col-4 l-offset-2 left-footer">
            <a href="<?php echo site_url( ); ?>"><img class="site-logo" width="250" src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/mih-white.svg" alt="My Indiana Home" /></a>
				<?php echo the_field('left_footer', 'options');?>
                <ul class="header-social">
                    <?php
                        echo $facebook ? '<li class="facebook"><a href="'.esc_url($facebook).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/facebook-white.svg" /></a></li>' : '';
                        echo $twitter ? '<li class="twitter"><a href="'.esc_url($twitter).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/twitter-white.svg" /></a></li>' : '';
                        echo $pinterest ? '<li class="pinterest"><a href="'.esc_url($pinterest).'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/images/social-icons/pinterest-white.svg" /></a></li>' : '';                    ?>
                </ul>
			</div>
           
			<div class="col-12 l-col-4 l-offset-1 right-footer">
            <a href="https://www.infarmbureau.org/"><img style="margin-top: 10px;" class="" width="250" src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/ifb-logo-white-trans.png" alt="My Indiana Home" /></a>
                <!-- <div class="clearfix"> -->
                   <!-- <div class="float-left"> -->
                   <?php echo the_field('right_footer', 'options'); ?>
                   <!-- </div>  -->
                   <!-- <div class="float-right"> -->
                        <?php //echo get_the_post_thumbnail( $latest_mag[0]->ID, 'small-thumb' ); ?>
                   <!-- </div> -->

                <!-- </div> -->
				
			</div>
		</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
</div>
<div class="search-pop-up">
    <div class="close-search"><i class="fas fa-times"></i></div>
    <?php get_search_form(); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>