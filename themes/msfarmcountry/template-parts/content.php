<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

?>
<?php if ( is_singular() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-content '); ?>>
	<?php if( function_exists('the_ad_placement') ) { 
			the_ad_placement('top-leaderboard');
		} ?>


	
	<div class="ag-site-sidebar-layout wp-block-columns container">
	<div class="wp-block-column">
	<header class="entry-header">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		$categories = get_the_terms( get_the_ID(  ), 'category' );
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				
				//if ($categories) : ?>
					<!-- <div class="category-wrap">
						<ul>
							<?php //foreach ($categories as $category): ?>
								<li><a class="background__primary" href="<?php //echo esc_url(get_category_link($category->term_id)); ?>"><?php //echo $category->name; ?></a></li>
							<?php //endforeach; ?>
						</ul>
					</div> -->
					
				<?php //endif;

				the_title( '<h1 class="entry-title">', '</h1>' );
				ag_sites_posted_by();
				 echo ' &nbsp;|&nbsp; ';
				ag_sites_posted_on();
				if (function_exists( 'ADDTOANY_SHARE_SAVE_KIT' )) {
					echo do_shortcode('[addtoany url="' . esc_url(get_the_permalink(get_the_ID())).'" ]');
				}
				if (get_field('subheading')) {echo '<h2 class="post-excerpt">'.get_field('subheading').'</h2>';}
				// if ( function_exists('yoast_breadcrumb') ) {
				// 	yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
				//   }
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ag-sites' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ag-sites' ),
				'after'  => '</div>',
			)
		); ?>
		</div><!-- .entry-content -->
		<div class="wp-block-column sticky">
			<?php get_sidebar(); ?>
		</div>
		</div>
		<div class="offwhite-bkgrnd">
		<?php // you might also like section
		get_template_part('template-parts/content-related-articles');
		?>
		</div>	
		<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
		


	<footer class="entry-footer">
		<?php // ag_sites_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->	
<?php else: ?>
	<?php $cat = get_the_category(get_the_ID()); ?>
	<div class="col-12 m-col-12">
		<div class="row mfc-archive">
			<div class="col-12 l-col-4">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<div class="two-thirds-container">
			<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
			</div></a>
			</div>
			<div class="col-12 l-col-8 mfc-archive__text-area">
			<?php 
			echo '<p class="mfc-cat-title "><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
			echo '<h3 class="mfc-archive__title"><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h3>';
			echo '<p class="mfc-archive__excerpt">'.get_the_excerpt(  ).'</p>'; ?>
			</div>
		</div>
	</div>
<?php endif; 

