<?php get_header(); ?>

	<div id="content-wrapper">

		<div id="content-main">

			<div id="home-main" class=" category top-border-orange">
			<div class="arrow orange"></div>

				<h3 class="home-widget-header category-title borders"><?php single_cat_title(); ?></h3>
				<div class="category-descrip"><?php echo category_description(); ?></div>
				<?php if(get_option('mvp_category_layout') == 'large') { ?>

				<div class="home-widget">

					<ul class="wide-widget cat-home-widget infinite-content">

						<?php $mvp_slider_cat = get_option('mvp_slider_cat'); if ($mvp_slider_cat == "true") { ?>

							<?php $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array('posts_per_page' => get_option('mvp_slider_cat_num'), 'cat' => $category_id )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>

							<?php } endwhile; ?>



							<?php if (isset($do_not_duplicate)) { if (have_posts()) : while (have_posts()) : the_post(); if (in_array($post->ID, $do_not_duplicate)) continue; ?>

							<li class="infinite-post ">

								<a href="<?php the_permalink(); ?>" rel="bookmark">

								<div class="wide-img">

									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>

									<span class="wide-shade"><img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/trans.gif" data-original="<?php echo $thumb['0']; ?>" /></span>

								

									<?php } ?>

									<noscript><span class="wide-shade"><img class="wide-shade" src="<?php echo $thumb['0']; ?>" /></span></noscript>

									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>

										<div class="video-button">

											<img src="<?php echo get_template_directory_uri(); ?>/images/video-but.png" alt="<?php the_title(); ?>" />

										</div><!--video-button-->

									<?php endif; ?>

								</div><!--wide-img-->

								<div class="wide-text">

									<h2><?php the_title(); ?></h2>

									<span class="widget-info"><?php the_time(get_option('date_format')); ?></span>

									<p><?php echo excerpt(20); ?></p>

								</div><!--wide-text-->

								</a>

							</li>

							<?php endwhile; endif; } ?>

						<?php } else { ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<li class="infinite-post">

								<a href="<?php the_permalink(); ?>" rel="bookmark">

								<div class="wide-img">

									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>

									<span class="wide-shade"><img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/trans.gif" data-original="<?php echo $thumb['0']; ?>" /></span>

								

									<?php } ?>

									<noscript><span class="wide-shade"><img class="wide-shade" src="<?php echo $thumb['0']; ?>" /></span></noscript>

									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>

										<div class="video-button">

											<img src="<?php echo get_template_directory_uri(); ?>/images/video-but.png" alt="<?php the_title(); ?>" />

										</div><!--video-button-->

									<?php endif; ?>

								</div><!--wide-img-->

								<div class="wide-text">

									<h2><?php the_title(); ?></h2>

									<span class="widget-info"><?php the_time(get_option('date_format')); ?></span>

									<p><?php echo excerpt(20); ?></p>

								</div><!--wide-text-->

								</a>

							</li>

							<?php endwhile; endif; ?>

						<?php } ?>

					</ul>

				<div class="nav-links">

					<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>

				</div><!--nav-links-->

				</div><!--home-widget-->

				<?php } else if(get_option('mvp_category_layout') == 'list') { ?>

				<div class="home-widget">

					<ul class="home-list cat-home-widget infinite-content">

						<?php $mvp_slider_cat = get_option('mvp_slider_cat'); if ($mvp_slider_cat == "true") { ?>

							<?php $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array('posts_per_page' => get_option('mvp_slider_cat_num'), 'cat' => $category_id )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; ?>

							<?php endwhile; ?>



							<?php if (isset($do_not_duplicate)) { if (have_posts()) : while (have_posts()) : the_post(); if (in_array($post->ID, $do_not_duplicate)) continue; ?>

							<li class="infinite-post">

								<a href="<?php the_permalink(); ?>" rel="bookmark">

								<div class="home-list-img">

									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

									<?php // $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium-thumb' ); ?>

									<?php the_post_thumbnail('medium-thumb'); ?>

									<?php } ?>

									<noscript><?php the_post_thumbnail('medium-thumb'); ?></noscript>

									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>

										<div class="video-button">

											<img src="<?php echo get_template_directory_uri(); ?>/images/video-but.png" alt="<?php the_title(); ?>" />

										</div><!--video-button-->

									<?php endif; ?>

								</div><!--home-list-img-->

								<div class="home-list-content category-list">

									<span class="widget-info"><?php the_time(get_option('date_format')); ?></span>

									<h2><?php the_title(); ?></h2>

									<p><?php echo excerpt(19); ?></p>

								</div><!--home-list-content-->

								</a>

							</li>

							<?php endwhile; endif; } ?>

						<?php } else { ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<li class="infinite-post">

								<?php 
								if( $wp_query->current_post === 5 ) {
									if( function_exists('the_ad_placement') ) { 
										echo '<div style="margin:45px auto; width:300px; text-align:center;">';
										the_ad_placement('in-content');
										echo '</div>';
									}
								}
								?>

								<div class="home-list-img">

									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium-thumb' ); ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail('medium-thumb'); ?>
									</a>
								

									<?php } ?>

									<noscript><?php the_post_thumbnail('medium-thumb'); ?></noscript>

									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>

										<div class="video-button">

											<img src="<?php echo get_template_directory_uri(); ?>/images/video-but.png" alt="<?php the_title(); ?>" />

										</div><!--video-button-->

									<?php endif; ?>
								<!-- ADDED BY RICHARD STEVENS -->
								<?php if ( is_subcategory() ) {	?>
									<!-- Don't display category label on subcategory pages -->
								<?php } else { ?>								
									<a href="/<?php $category = get_the_category(); echo $category[1]->slug; ?>" rel="bookmark">
								
	<span class="widget-cat-contain"><h3 class="widget-cat"><?php $category = get_the_category(); echo $category[1]->cat_name; ?></h3></span>
									</a>
								<?php } ?>

								</div><!--home-list-img-->
								<a href="<?php the_permalink(); ?>" rel="bookmark">
								<div class="home-list-content category-list">

									<span class="widget-info"><?php the_time(get_option('date_format')); ?></span>

									<h2><?php the_title(); ?></h2>

									<p><?php echo excerpt(19); ?></p>

								</div><!--home-list-content-->
								</a>


							</li>

							<?php endwhile; endif; ?>

						<?php } ?>

					</ul>

				<div class="nav-links">

					<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>

				</div><!--nav-links-->

				</div><!--home-widget-->

				<?php } else if(get_option('mvp_category_layout') == 'columns') { ?>

				<div class="home-widget">

					<ul class="split-columns cat-home-widget infinite-content">

						<?php $mvp_slider_cat = get_option('mvp_slider_cat'); if ($mvp_slider_cat == "true") { ?>

							<?php $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array('posts_per_page' => get_option('mvp_slider_cat_num'), 'cat' => $category_id )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; ?>

							<?php endwhile; ?>



							<?php if (isset($do_not_duplicate)) { if (have_posts()) : while (have_posts()) : the_post(); if (in_array($post->ID, $do_not_duplicate)) continue; ?>

							<li class="infinite-post">

								<a href="<?php the_permalink(); ?>" rel="bookmark">

								<div class="split-img">

									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium-thumb' );

$url = $thumb['0']; ?>

									<img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/trans.gif" data-original="<?php echo $url; ?>" />

								

									<?php } ?>

									<noscript><?php the_post_thumbnail('medium-thumb'); ?></noscript>

									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>

										<div class="video-button">

											<img src="<?php echo get_template_directory_uri(); ?>/images/video-but.png" alt="<?php the_title(); ?>" />

										</div><!--video-button-->

									<?php endif; ?>

								</div><!--split-img-->

								<div class="split-text">

									<span class="widget-info"><?php the_time(get_option('date_format')); ?></span>

									<h2><?php the_title(); ?></h2>

									<p><?php echo excerpt(19); ?></p>

								</div><!--split-text-->

								</a>

							</li>

							<?php endwhile; endif; } ?>

						<?php } else { ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<li class="infinite-post">

								<a href="<?php the_permalink(); ?>" rel="bookmark">

								<div class="split-img">

									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium-thumb' );

$url = $thumb['0']; ?>

									<img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/trans.gif" data-original="<?php echo $url; ?>" />

								

									<?php } ?>

									<noscript><?php the_post_thumbnail('medium-thumb'); ?></noscript>

									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>

										<div class="video-button">

											<img src="<?php echo get_template_directory_uri(); ?>/images/video-but.png" alt="<?php the_title(); ?>" />

										</div><!--video-button-->

									<?php endif; ?>

								</div><!--split-img-->

								<div class="split-text">

									<span class="widget-info"><?php the_time(get_option('date_format')); ?></span>

									<h2><?php the_title(); ?></h2>

									<p><?php echo excerpt(19); ?></p>

								</div><!--split-text-->

								</a>

							</li>

							<?php endwhile; endif; ?>

						<?php } ?>

					</ul>

				<div class="nav-links">

					<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>

				</div><!--nav-links-->

				</div><!--home-widget-->

				<?php } ?>

			</div><!--home-main-->

		</div><!--content-main-->
		<div id="sidebar-wrapper">
			<?php dynamic_sidebar('Category Sidebar'); ?>
		</div>
	</div><!--content-wrapper-->

</div><!--main-wrapper-->

<?php get_footer(); ?>