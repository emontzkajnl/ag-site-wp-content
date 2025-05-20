<?php get_header(); ?>
	<div id="content-wrapper">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="content-main">
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