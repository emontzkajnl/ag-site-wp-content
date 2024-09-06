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
            <?php if (! is_mobile()): ?>
<!-- /51853864/partners_desktop_leaderboard -->
<div id='div-gpt-ad-1692784329715-0' style='min-width: 728px; min-height: 90px;'>
  <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1692784329715-0'); });
  </script>
</div>
<?php else: ?>
<!-- /51853864/partners_mobile_leaderboard -->
<div id='div-gpt-ad-1692784622292-0' style='min-width: 320px; min-height: 50px;'>
  <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1692784622292-0'); });
  </script>
</div>
        <?php endif; ?>
			</header><!-- .page-header -->
			<!-- set up two columns -->
			<div class="wp-block-columns ag-site-sidebar-layout">
			<div class="wp-block-column">
			<!-- <div class="col-12 m-col-9"> -->
			<?php $q = get_queried_object(  );
					if (is_category(  )) {
						echo '<h1 class="page-title color__primary">'.$q->cat_name.'</h1>';
						echo '<p style="font-size: 20px;">'.$q->category_description.'</p>';
					} elseif (is_author()){
						echo '<h1 class="page-title color__primary">Posts by '.get_the_author().'</h1>';
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
				global $wp_query;
				// print_r($wp_query->query_vars);
				// if ($wp_query->current_post === 4 && function_exists('the_ad_placement') ){
				// 	echo '</div><div style="display: flex; justify-content: center;">';
				// 	the_ad_placement('in-content');
				// 	echo '</div><div class="row">';
				// }
				if ($wp_query->current_post === 4  ){ ?>
					<!-- /51853864/partners_desktop_in_content_medium_rectangle -->
					<div class="advertisement">Advertisement</div>
					<div style="width: 100%;">
					<div id='div-gpt-ad-1694457127306-0' style='min-width: 300px; min-height: 250px;'>
					  <script>
					    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1694457127306-0'); });
					  </script>
					  </div>
				</div>
				<?php }
				get_template_part( 'template-parts/content', 'get_post_type()' );
				

			endwhile; ?>
			</div><!-- row -->
			</div><!-- alm-container -->
			<?php if ($wp_query->max_num_pages > 1): ?>
			
			<?php $query_vars = $wp_query->query_vars; 
			$paged = $query_vars['paged'] ? $query_vars['paged'] : 1; 
			$max_pages = $wp_query->max_num_pages;
			?>
			<script>
				window.maxpages = <?php echo $max_pages; ?>;
				// window.document.params.page = "<?php //echo $paged; ?>";
				// console.log('start');
				// console.log(window.document);
			</script>
			<div style="text-align: center;">
			<button data-cat="<?php echo $query_vars['cat']; ?>" data-tag="<?php echo $query_vars['tag'] ?>" data-paged="<?php echo $paged; ?>" class="background__primary font__serif" id="load-more-cats">LOAD MORE</button>
			</div>
			
			<?php  endif;
			//print_r($wp_query->query_vars); //the_posts_navigation();
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
