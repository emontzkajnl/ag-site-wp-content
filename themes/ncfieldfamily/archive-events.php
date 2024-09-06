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
				<h1>North Carolina Events Calendar</h1>
			<?php 
			// $q = get_queried_object(  );
			// 		if (is_category(  )) {
			// 			echo '<h1 class="page-title color__primary">'.$q->cat_name.'</h1>';
			// 			echo '<p style="font-size: 20px;">'.$q->category_description.'</p>';
			// 		} elseif (is_author()){
			// 			echo '<h1 class="page-title color__primary">Posts by '.get_the_author().'</h1>';
			// 		} else {
			// 			the_archive_title( '<h1 class="page-title color__primary">', '</h1>' );
			// 		} 

			echo do_shortcode( '[searchandfilter slug="event-search"]');
					?>
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

				$start_date = get_field('start_date');
				$start_date_obj = DateTime::createFromFormat( 'd/m/Y', $start_date );
				$start_month = $start_date_obj->format('M');
				$start_day = $start_date_obj->format('d');
				$start_year = $start_date_obj->format('Y');
				$end_date = get_field('end_date');
				$location = get_field('location');
				
				$date_string = $start_month.' '.$start_day;
				if ($end_date && $end_date != $start_date) {
					$end_date_obj = DateTime::createFromFormat( 'd/m/Y', $end_date ); 
					$end_month = $end_date_obj->format('M');
					$end_day = $end_date_obj->format('d');
					if ($start_month == $end_month ) {
						$date_string .= ' - '.$end_day.', '.$start_year;
					} else {
						$end_year = $end_date_obj->format('Y');
						$date_string .= $start_year == $end_year ? ' - '.$end_month.' '.$end_day.', '.$end_year : ', '.$start_year.' - '.$end_month.' '.$end_day.', '.$end_year;
					}
				} else {
					$date_string .= ', '.$start_year;
				}
				?>

				<div class="col-12 m-col-12 ncff-event-list">
					<!-- <div> -->
					<div class="date-cube">
						<?php echo '<span class="month">'.$start_date_obj->format('M').'</span><br /><span class="day">'.$start_date_obj->format('d').'</span>'; ?>
					</div>
					<!-- </div> -->
					<div class="ncff-event-list__text-area">
					<h2 class="ncff-event-list__title"><a class="unstyle-link" href="<?php echo get_the_permalink(  ); ?>"><?php echo get_the_title(); ?></a></h2>
					<p class="ncff-event-list__date"><?php echo $date_string; ?></p>
					<p class="ncff-event-list__location"><?php echo $location; ?>, NC</p>
					</div>

				
				<?php 

// Load field value.
// $date_string = get_field( 'start_date' );

// Create DateTime object from value (formats must match).
// $date = DateTime::createFromFormat( 'Ymd', $date_string );

// Output current date in custom format.
?>
<!-- <p>Event start date: <?php //echo $date->format( 'j M Y' ); ?></p> -->
<?php 

// Increase by 1 day and output again.

?>

				</div> 

				
				

			<?php endwhile; ?>
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
			<!-- <button data-cat="<?php //echo $query_vars['cat']; ?>" data-tag="<?php //echo $query_vars['tag'] ?>" data-paged="<?php //echo $paged; ?>" class="ncff-recent__btn background__primary " id="load-more-ncff-cats">LOAD MORE</button> -->
			</div>
			
			<?php  //print_r($wp_query->query_vars); //the_posts_navigation();
			 ?>
			</div>

		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<div class="wp-block-column">
		<?php get_sidebar('category');  ?>
		</div>
    </div>
        <?php //get_template_part( 'template-parts/newsletter'); ?>

	</main><!-- #main -->

<?php

get_footer();
