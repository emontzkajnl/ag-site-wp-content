<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- <header class="entry-header container"> -->
		<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<!-- </header> --> <!-- .entry-header -->

	<?php //if( function_exists('the_ad_placement') ) { 
		// the_ad_placement('top-leaderboard');
	// }
	
	// ag_sites_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if (!is_front_page()) {
			the_title( '<h1 class="entry-title">', '</h1>' ); 
		} else {
            get_template_part( 'template-parts/homepage-hero');
        }
		
		the_content();

		// wp_link_pages(
		// 	array(
		// 		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ag-sites' ),
		// 		'after'  => '</div>',
		// 	)
		// );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'ag-sites' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
