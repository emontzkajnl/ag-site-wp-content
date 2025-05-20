		<?php get_header(); ?>

<?php
$location = get_field('location');
$startdate = get_field('start_date');
$enddate = get_field('end_date');
// $date_next_week = date('Y-m-d H:i:s', $time_next_week);
$starttime = get_field('start_time');
$endtime = get_field('end_time');
$day = date("l", strtotime($startdate));
$phone = get_field('phone_number');
$link = get_field('event_url');
if (!empty($link) && strpos($link, 'http') !== 0) {
	$link = 'http://' . $link;
}
$region = '';
$subregion = '';
$eventtype = get_the_terms( get_the_ID(), 'event_type' );
$season = get_the_terms( get_the_ID(), 'season' );
$region = get_the_terms( get_the_ID(), 'region' );
?>

	<div id="content-wrapper">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="content-main">

			<div id="home-main">

				<div id="post-area" itemscope itemtype="http://schema.org/Article" <?php post_class(); ?>>

					<h3 class="story-cat"><?php the_category() ?></h3>

					<h1 class="story-title" itemprop="name"><?php the_title(); ?></h1>

					<div id="post-info">
						<div class="calendar-date">
						<time datetime="<?php echo date("Y-m-d", strtotime($startdate)); ?>" class="icon">
						  <em><?php echo date("l", strtotime($startdate)); ?></em>
						  <strong><?php echo date("F", strtotime($startdate)); ?> <?php echo date("Y", strtotime($startdate)); ?></strong>
						  <span><?php echo date("j", strtotime($startdate)); ?></span>
						</time>
						</div>

						<h2>Date: <?php echo date("F j", strtotime($startdate)); ?><?php if ($enddate) { echo ' - ' . date("F j", strtotime($enddate)); } ?>, <?php echo date("Y", strtotime($startdate)); ?></h2>
						<?php if ($endtime) { ?><h2>Time: <?php echo $starttime; ?><?php if ($endtime) { echo ' - ' . $endtime; } ?></h2><?php } ?>
						<h2>Location: <?php echo $location; ?>, TN</h2>
						<h3>Phone: <?php echo $phone; ?></h3>
						<?php if (!empty($link)) { ?>
						<h3><strong><a href="<?php echo $link; ?>" target="_blank" alt="<?php the_title(); ?>">Event Website</a></strong></h3>
						<?php } ?>
						<h3>Season: <?php echo $season[0]->name; ?></h3>
						<h3>Event type: <?php echo $eventtype[0]->name; ?></h3>
						<h3>Region: <?php echo $region[0]->name; ?> - <?php echo $region[1]->name; ?></h3>


					</div><!--post-info-->


					<div id="content-area">

						<?php the_content(); ?>
						
						
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

							<div class="event-image-full" itemscope itemtype="http://schema.org/Article">

								<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-full' ); ?>

								<img itemprop="image" class="pin-featured" src="<?php echo $thumb['0']; ?>" />
							
							</div>
						
						<?php } ?>
						
						

<!-- 
						<div class="post-tags">

							<span class="post-tags-header"><?php _e( 'Tags', 'mvp-text' ); ?></span><?php the_tags('','','') ?>

						</div><!~~post-tags~~>
 -->
	
<?php do_action('addthis_widget',get_permalink($post->ID), get_the_title($post->ID), array(
    'type' => 'custom',
    'size' => '32', // size of the icons.  Either 16 or 32
    'services' => 'facebook,twitter,pinterest_share,google_plusone_share,email,print', // the services you want to always appear
    'preferred' => '0', // the number of auto personalized services
    'more' => true, // if you want to have a more button at the end
    'counter' => 'bubble_style' // if you want a counter and the style of it
    )); 
?>
					</div><!--content-area-->

<?php $socialbox = get_option('mvp_social_box'); if ($socialbox == "true") { ?>


					<?php } ?>

				</div><!--post-area-->


				<?php $prev_next = get_option('mvp_prev_next'); if ($prev_next == "true") { ?>

				<div class="prev-next-wrapper">

					<div class="prev-post">

						<?php previous_post_link('%link','<div class="custom-nav-post">' . '&larr; '.__('Previous Story', 'mvp-text'). '</div> %title', TRUE); ?>

					</div><!--prev-post-->

					<div class="next-post">

						<?php next_post_link('%link','<div class="custom-nav-post">' .__('Next Story', 'mvp-text'). ' &rarr; ' . '</div> %title', TRUE); ?>

					</div><!--next-post-->

				</div><!--prev-next-wrapper-->

				<?php } ?>

				<?php // getRelatedPosts(); ?>

				<?php // comments_template(); ?>

			</div><!--home-main-->

		</div><!--content-main-->

		<?php // get_sidebar(); ?>
		<div id="sidebar-wrapper">
			<?php dynamic_sidebar( 'events-sidebar' ); ?>
		</div>
		<?php endwhile; endif; ?>

	</div><!--content-wrapper-->

</div><!--main-wrapper-->

<?php get_footer(); ?>