<?php
/**
 * Template Name: Home
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

get_header(); ?>
	<div class="<?php echo esc_attr( visualcomposerstarter_get_content_container_class() ); ?>">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12">
					<?php
						// Start the loop.
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'page' );
						endwhile; // End the loop.
						?>
				</div>
			</div>
<!-- 
			<div class="row most-recent-article-wrapper">
				<div class="col-md-9 most-recent-column">
					<h1>Most Recent</h1>
					<?php if ( have_posts() ) :
						$args = array(
							 'post_type'         => 'post',
							 'posts_per_page'    => 4
						);
						$the_query = new WP_Query( $args );

						// The Loop
						if ( $the_query->have_posts() ) {
							 
							 while ( $the_query->have_posts() ) {
								  $the_query->the_post();
								  echo '<div class="row most-recent-article equal padded-row"><div class="col-md-6 no-padding"><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail( $post_id, 'curated-image' ) . '</a></div><div class="col-md-6 no-padding flexcontainer"><div class="most-recent-content-wrapper"><span class="post-category">' . get_the_category() . '</span><h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>' . get_the_date() . '</div></div></div>';
							 }
						}
						/* Restore original Post Data */
						wp_reset_postdata();
					?>
					<?php
					// If no content, include the "No posts found" template.
					else :
						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
					<div id="connect-with-us" class="row equal">
						<div class="col-sm-12 col-md-6 text-center flexcontainer">
							<div class="connect-with-us-content">
								<h3>Connect With Us</h3>
								<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'vct_footer_area_social_link_facebook', '' ) ); ?>"><button class="btn btn-primary">FACEBOOK</button></a><br>
								<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'vct_footer_area_social_link_instagram', '' ) ); ?>"><button class="btn btn-primary">INSTAGRAM</button></a><br>
								<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'vct_footer_area_social_link_twitter', '' ) ); ?>"><button class="btn btn-primary">TWITTER</button></a>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 text-center">
							<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/ad-placeholder.jpg">
						</div>
					</div>
				</div>
<!~~ 
				<div id="sidebarinfo" class="col-md-3">
					<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/ad-placeholder.jpg">
					<?php if( get_field('magazine_image', 'option') ): ?>
    					<img class="img-fluid" src="<?php the_field('magazine_image', 'option'); ?>" />
					<?php endif; ?>
					<?php if( get_field('magazine_text', 'option') ): ?>
    					<?php the_field('magazine_text', 'option'); ?>
					<?php endif; ?>
					<?php if( get_field('latest_issue', 'option') ): ?>
    					<a href="<?php the_field('latest_issue', 'option'); ?>"><button class="btn btn-primary">READ LATEST ISSUE</button></a>
					<?php endif; ?>
				</div>
 ~~>
			</div>
 -->

		</div><!--.content-wrapper-->
	</div><!--.<?php echo esc_html( visualcomposerstarter_get_content_container_class() ); ?>-->
<?php get_footer();
