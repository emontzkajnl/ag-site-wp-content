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
//  $twitter = get_field('twitter', 'options');
 $pinterest = get_field('pinterest', 'options');
 $youtube = get_field('youtube', 'options');
 $instagram = get_field('instagram', 'options');
 $mag_args = array(
     'numberposts'       => 1,
     'post_type'         => 'magazine'
 );
$latest_mag = get_posts($mag_args);
// print_r($latest_mag);
if ( !is_front_page() && !is_page('newsletter') ) {
    get_template_part( 'template-parts/newsletter'); 
}

?>


	<footer id="colophon" class="site-footer">
    <div class="container">
    <?php wp_nav_menu(array('theme_location' => 'bottom_menu', 'menu_class' => 'menu font__sans-serif')); ?>
		<div class="site-info container">
        <?php //dynamic_sidebar('footer'); ?>
		<div class="row">
			<div class="col-12 l-col-4 l-offset-2 left-footer">
            <a href="<?php echo site_url( ); ?>"><img class="site-logo" width="250" src="<?php echo get_stylesheet_directory_uri(  ); ?>/assets/images/NCFF_logo_white.svg" alt="North Carolina Field Family" /></a>
				<?php echo the_field('left_footer', 'options');?>
                <ul class="header-social">
                    <?php
                        echo $facebook ? '<li class="facebook"><a href="'.esc_url($facebook).'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>' : '';
                        echo $instagram ? '<li class="instagram"><a href="'.esc_url($instagram).'" target="_blank"><i class="fab fa-instagram"></i></a></li>' : '';
                        echo $pinterest ? '<li class="pinterest"><a href="'.esc_url($pinterest).'" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>' : '';
                        echo $youtube ? '<li class="youtube"><a href="'.esc_url($youtube).'" target="_blank"><i class="fab fa-youtube"></i></a></li>' : '';
                    ?>
                </ul>
			</div>
           
			<div class="col-12 l-col-4 l-offset-1 right-footer">
                <div class="clearfix">
                   <!-- <div class="float-left"> -->
                   <?php echo the_field('right_footer', 'options'); ?>
                   <!-- </div>  -->
                   <!-- <div class="float-right"> -->
                        <?php //echo get_the_post_thumbnail( $latest_mag[0]->ID, 'small-thumb' ); ?>
                   <!-- </div> -->

                </div>
				
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
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=bz2xnk020cib7bcexqizza" async="true"></script>
<?php wp_footer(); ?>

</body>
</html>