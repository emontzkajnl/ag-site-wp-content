<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					if( function_exists('the_ad_placement') ) { 
						the_ad_placement('top-leaderboard');
					}
				
				?>
			</header><!-- .page-header -->
			<!-- set up two columns -->
			<div class="wp-block-columns ag-site-sidebar-layout">
			<div class="wp-block-column">
			<!-- <div class="col-12 m-col-9"> -->
			<?php 
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
			$q = get_queried_object(  );
					if (is_category(  )) {
						echo '<h1 class="page-title color__primary">'.$q->cat_name.'</h1>';
						echo $q->category_description ? '<p class="mfc-cat-description">'.$q->category_description.'</p>': '';
					} elseif (is_author()){
						echo '<h1 class="page-title color__primary">Articles by '.get_the_author().'</h1>';
					} else {
						the_archive_title( '<h1 class="page-title color__primary">', '</h1>' );
					} ?>
					<div class="alm-container">
				<div class="row">

			
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				// print_r($wp_query->query_vars);
				if ($wp_query->current_post === 4 && function_exists('the_ad_placement') ){
					echo '</div><div style="display: flex; justify-content: center;">';
					the_ad_placement('in-content');
					echo '</div><div class="row">';
				}
				get_template_part( 'template-parts/content', 'get_post_type()' );
				

			endwhile; ?>
			</div><!-- row -->
			</div><!-- alm-container -->
			<div style="text-align: center;">
			<?php $query_vars = $wp_query->query_vars; 
			$paged = $query_vars['paged'] ? $query_vars['paged'] : 1; ?>
			<script>
				// window.document.params.page = "<?php //echo $paged; ?>";
				// console.log('start');
				// console.log(window.document);
			</script>
			<button data-cat="<?php echo $query_vars['cat']; ?>" data-tag="<?php echo $query_vars['tag'] ?>" data-paged="<?php echo $paged; ?>" class="background__primary font__serif" id="mfc-load-more-cats">LOAD MORE</button>
			</div>
			
			<?php  //print_r($wp_query->query_vars); //the_posts_navigation();
			 ?>
			</div>

		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<div class="wp-block-column">
		<?php get_sidebar('category'); ?>
		</div>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
