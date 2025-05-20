<?php
/**
 * Sidebar.
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

?>
<div class="<?php echo esc_attr( visualcomposerstarter_get_sidebar_class() ); ?> ffm-sticky">
<!-- 
	<div id="sidebarinfo">
		<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/ad-placeholder.jpg">
		<?php if( get_field('magazine_image', 'option') ): ?>
			<img class="img-fluid" src="<?php the_field('magazine_image', 'option'); ?>" />
		<?php endif; ?>
		<?php if( get_field('magazine_text', 'option') ): ?>
			<?php the_field('magazine_text', 'option'); ?>
		<?php endif; ?>
		<?php if( get_field('latest_issue', 'option') ): ?>
			<a href="<?php the_field('latest_issue', 'option'); ?>"><button class="btn btn-primary">READ LATEST ISSUE</button></a>
		<?php endif; ?>
	</div>
 -->
	<div class="sidebar-widget-area">
		<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar' ); ?>
		<?php endif; ?>
	</div>
</div>
