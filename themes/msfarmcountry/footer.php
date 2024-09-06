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
 $pinterest = get_field('pinterest', 'options');
 $instagram = get_field('instagram', 'options');

 if (!is_front_page(  )) {
	get_template_part( 'template-parts/mag-footer');
 }
?>

	<footer id="colophon" class="site-footer">
		<div class="site-info container">
		<?php wp_nav_menu(array('theme_location' => 'bottom_menu', 'menu_class' => 'menu font__sans-serif')); ?>
        <?php //dynamic_sidebar('footer'); ?>
		<div class="row">
			<div class="col-12 m-col-2"></div>
			<div class="col-12 m-col-4 footer-left">
				<?php echo wp_kses_post(get_field('left_footer', 'options') );?>
             <?php get_template_part('template-parts/social-icons'); ?>
			</div>
			<div class="col-12 m-col-6 footer-right">
				<?php echo wp_kses_post(get_field('right_footer', 'options') ); ?>
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
