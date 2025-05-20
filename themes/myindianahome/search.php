<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Ag_Sites
 */

get_header();
?>

	<main id="primary" class="site-main container">
    <header class="page-header">
        <?php
            if( function_exists('the_ad_placement') ) { 
                the_ad_placement('top-leaderboard');
            }
        ?>
    </header><!-- .page-header -->

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title ">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'ag-sites' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
			<div class="wp-block-columns ag-site-sidebar-layout">
				<div class="wp-block-column">
                    <div class="row">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			// the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
        </div><!--row-->
			</div>
				<div class="wp-block-column">
				<?php get_sidebar(); ?>
				</div>
			</div>
	</main><!-- #main -->

<?php

get_footer();
