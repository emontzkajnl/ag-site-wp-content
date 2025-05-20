<?php get_header(); ?>
	<div id="content-wrapper">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="content-main">
			<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
			<div id="featured-image">
				<?php the_post_thumbnail('post-thumb'); ?>
				<?php if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
				<span class="photo-credit"><?php _e( 'Photo:', 'mvp-text' ); ?> <?php echo get_post_meta($post->ID, "mvp_photo_credit", true); ?></span>
				<?php endif; ?>
			</div><!--featured-image-->
			<?php } ?>
			<?php } ?>
			<div id="home-main">
				<div id="post-area" <?php post_class(); ?>>
					<h1 class="story-title"><?php the_title(); ?></h1>
					<div id="content-area">
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</div><!--content-area-->
				</div><!--post-area-->
			</div><!--home-main-->
		</div><!--content-main-->
		<?php get_sidebar(); ?>
		<?php endwhile; endif; ?>
	</div><!--content-wrapper-->
</div><!--main-wrapper-->
<?php get_footer(); ?>