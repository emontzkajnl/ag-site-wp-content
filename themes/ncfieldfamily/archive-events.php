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
	<header class="page-header">
				<?php
					if( function_exists('the_ad_placement') ) { 
						the_ad_placement('top-leaderboard');
					}
				
				?>
			</header><!-- .page-header -->
			<!-- set up two columns -->
			<h1>North Carolina Events Calendar</h1>
			<div class="wp-block-columns ag-site-sidebar-layout">
			<div class="wp-block-column">
		<?php if ( have_posts() ) : ?>


			<!-- <div class="wp-block-column"> -->
			<!-- <div class="col-12 m-col-9"> -->
				
			<?php 

			echo do_shortcode( '[searchandfilter slug="event-search"]');
					?>
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

				$now = strtotime('now');
				$is_date_valid = true;
				$start_date = get_field('start_date');
				$start_date_obj = strtotime($start_date);
				$start_month = date('M', $start_date_obj);
				$start_day = date('d', $start_date_obj);
				$start_year = date('Y', $start_date_obj);
				$end_date = get_field('end_date');
				$location = get_field('location');
				
				$date_string = $start_month.' '.$start_day;
				if ($end_date && $start_date != $end_date) {
					$end_date_obj = strtotime($end_date);
					if ($start_date_obj != $end_date_obj) {
						$end_month = date('M', $end_date_obj);
						$end_day = date('d', $end_date_obj);
						if ($start_month == $end_month ) {
							$date_string .= ' - '.$end_day.', '.$start_year;
						} else {
							$end_year = date('Y', $end_date_obj);
							$date_string .= $start_year == $end_year ? ' - '.$end_month.' '.$end_day.', '.$end_year : ', '.$start_year.' - '.$end_month.' '.$end_day.', '.$end_year;
						}
					} 
				} else {
					$date_string .= ', '.$start_year;
				}
				if ($end_date) {
					if ($end_date_obj < $now) {$is_date_valid = false;}
				} elseif ($start_date_obj < $now) {
					$is_date_valid = false;
				} else {
					$is_date_valid = true;
				}
				 if ($is_date_valid):
				?>

				<div class="col-12 m-col-12 ncff-event-list">
					<!-- <div> -->
					<div class="date-cube">
						<?php echo '<span class="month">'.$start_month.'</span><br /><span class="day">'.$start_day.'</span>'; ?>
					</div>
					<!-- </div> -->
					<div class="ncff-event-list__text-area">
					<h2 class="ncff-event-list__title"><a class="unstyle-link" href="<?php echo get_the_permalink(  ); ?>"><?php echo get_the_title(); ?></a></h2>
					<p class="ncff-event-list__date"><?php echo $date_string; ?></p>
					<p class="ncff-event-list__location"><?php echo $location; ?>, NC</p>
					</div>

				</div> <!-- event list-->

			<?php endif; // end if date valid
			endwhile; ?>
			</div><!-- row -->

		<?php else : ?>
			<div class="entry-content">
				<div class="on-page-search">
				<p><?php esc_html_e( 'Sorry, we can\'t find what you\'re looking for. Try searching below:', 'ag-sites' ); ?></p>
					<?php
						get_search_form();
						?>
				</div>
			</div>
			

		<?php endif; ?>
		</div> <!-- wp-block-column -->
		<div class="wp-block-column">
		<?php get_sidebar('category');  ?>
		</div> <!-- wp-block-column -->
    </div><!-- wp-block-columns -->
        <?php //get_template_part( 'template-parts/newsletter'); ?>

	</main><!-- #main -->

<?php

get_footer();
