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
 $youtube = get_field('youtube', 'options');
 $mag_args = array(
     'numberposts'       => 1,
     'post_type'         => 'magazine'
 );
$latest_mag = get_posts($mag_args);
// print_r($latest_mag);
?>

	<footer id="colophon" class="site-footer">
    <div class="container">
    <?php wp_nav_menu(array('theme_location' => 'bottom_menu', 'menu_class' => 'menu font__sans-serif')); ?>
		<div class="site-info container">
        <?php //dynamic_sidebar('footer'); ?>
		<div class="row">
			<div class="col-12 l-col-4 left-footer">
				<?php echo the_field('left_footer', 'options');?>
                <ul class="header-social">
                    <?php
                        echo $facebook ? '<li class="facebook"><a href="'.esc_url($facebook).'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>' : '';
                        echo $twitter ? '<li class="twitter"><a href="'.esc_url($twitter).'" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a></li>' : '';
                        echo $pinterest ? '<li class="pinterest"><a href="'.esc_url($pinterest).'" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>' : '';
                        echo $youtube ? '<li class="youtube"><a href="'.esc_url($youtube).'" target="_blank"><i class="fab fa-youtube"></i></a></li>' : '';
                    ?>
                </ul>
			</div>
            <div class="col-12 l-col-4 middle-footer">
				<?php echo the_field('middle_footer', 'options'); ?>
			</div>
			<div class="col-12 l-col-4 right-footer">
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
<!-- <script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=teuegp8jpfr4o7pmcgn2dw" async="true"></script> -->
<?php wp_footer(); ?>

</body>
</html>