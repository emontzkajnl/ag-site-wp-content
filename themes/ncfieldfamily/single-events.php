<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			<div class="wp-block-columns ag-site-sidebar-layout">
			<div class="wp-block-column">
		<?php
		echo '<p class="back-to-event-list"><a class="unstyle-link" href="'.get_post_type_archive_link('events').'">< BACK TO EVENT LIST</a></p>';
		while ( have_posts() ) :
			the_post();
			$ID = get_the_ID();
			$start_time = get_field('start_time');
			$end_time = get_field('end_time');
			$start_date = get_field('start_date');
			$start_date_obj = DateTime::createFromFormat( 'd/m/Y', $start_date );
			$start_month = $start_date_obj->format('M');
			$start_day = $start_date_obj->format('d');
			$start_year = $start_date_obj->format('Y');
			$end_date = get_field('end_date');
			$location = get_field('location');
			$phone = get_field('phone_number');
			$event_url = get_field('event_url');
			$region = get_the_terms( $ID, 'region' );
			$region_parent = $region[0]->parent > 1 ? get_term( $region[0]->parent )->name.' - ' : '';
			$season = get_the_terms( $ID, 'season');
			$event_type = get_the_terms( $ID, 'event_type');

			
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
			<div class="es-title-container">
				<div class="date-cube">
					<?php echo '<span class="month">'.$start_date_obj->format('M').'</span><br /><span class="day">'.$start_date_obj->format('d').'</span>'; ?>
				</div>
				<h1><?php echo get_the_title(); ?></h1>
			</div>
			<!-- <hr> -->
			<p class="event-meta">
			<?php echo $season ? '<span class="event-cat">SEASON</span> '.$season[0]->name : '';  ?>
			<?php echo $event_type ? '<span class="event-cat">EVENT TYPE</span> '.$event_type[0]->name : '';  ?>
			<?php echo $region ? '<span class="event-cat">REGION</span> '.$region_parent.$region[0]->name : '';  ?>
			</p>
			<!-- <hr> -->
			<div class="event-meta-section">
				<p class="event-cat">Date & Time</p>
				<p><?php echo $date_string; ?></p>
				<p><?php echo $start_time.' - '.$end_time; ?></p>
			</div>
			<div class="event-meta-section">
				<p class="event-cat">Location</p>
				<?php echo $location ? '<p>'.$location.', NC</p>' : '' ; ?>
				<?php echo $phone ? '<p>'.$phone.'</p>' : '' ; ?>
				<?php echo $event_url ? '<p><a href="'.$event_url.'">EVENT WEBSITE</a></p>' : '' ; ?>
			</div>
			<div>
				<p class="event-cat">About</p>
				<?php the_content();
				$posttags = get_the_tags();
				if ($posttags) {
					echo '<ul class="post-tags">';
					foreach($posttags as $tag) {
					echo '<a href="'.get_term_link($tag->term_id).'"><li>'.$tag->name.'</li></a>'; 
					}
					echo '</ul>';
				} 
				echo get_the_post_thumbnail( ); ?>

			</div>
			
			


		<?php endwhile; // End of the loop.
		?>
		</div>
		<div class="wp-block-column">
		<?php get_sidebar('category');  ?>
		</div>
		

	</main><!-- #main -->
	<?php if( have_rows('events', 'options') ): ?>
	<div class="featured-events">
		<div class="container">
		<h2 class="featured-events__title">Featured Events</h2>
		<div class="row">
		<?php 
		
			while( have_rows('events', 'options') ) : the_row();
				$f_event = get_sub_field('event');
				$FID = $f_event->ID; ?>
			<div class="col-12 m-col-3 s-col-6">
				<div class="ncff-popular__container nc-panel">	
				<div class="ncff-popular__img-container">
                <?php echo '<a href="'.get_the_permalink($FID).'">'.get_the_post_thumbnail( $FID, 'small-thumb').'</a>'; ?>
				</div>
				<div class="ncff-popular__text-container">
				<h3 class="ncff-popular__title"><a class="unstyle-link" href="<?php echo get_the_permalink($FID); ?>"><?php echo $f_event->post_title; ?></a></h3>
				
            </div>
				</div>
			</div>
			<?php endwhile;
		
		?>
		</div>
	</div>
<?php endif;

get_footer();
