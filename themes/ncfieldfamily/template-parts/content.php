<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

?>
<?php if ( is_singular() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-content '); ?>>
	<?php if( function_exists('the_ad_placement') ) { 
			the_ad_placement('top-leaderboard');
		} ?>


	
	<div class="ag-site-sidebar-layout wp-block-columns">
	<div class="wp-block-column">
	<header class="entry-header">
		<?php
		
		$categories = get_the_terms( get_the_ID(  ), 'category' );
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				
				if ($categories) : ?>
					<div class="ncff-category-wrap">
						<ul>
							<?php foreach ($categories as $category): ?>
								<li><a class="ncff-featured__cat" href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					
				<?php endif;

				the_title( '<h1 class="entry-title">', '</h1>' );
				if (has_excerpt(  )) {
                echo '<p class="ncff-excerpt">'.get_the_excerpt(  ).'</p>';
				}
				ncff_posted_by();
				 echo ' | ';
				ag_sites_posted_on();
				if (function_exists( 'ADDTOANY_SHARE_SAVE_KIT' )) {
					echo do_shortcode('[addtoany url="' . esc_url(get_the_permalink(get_the_ID())).'" ]');
				}
				if (get_field('subheading')) {echo '<h2 class="post-excerpt">'.get_field('subheading').'</h2>';}
				// if ( function_exists('yoast_breadcrumb') ) {
				// 	yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
				//   }
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ag-sites' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		
		$posttags = get_the_tags();
		if ($posttags) {
			echo '<ul class="post-tags">';
		  foreach($posttags as $tag) {
			echo '<a href="'.get_term_link($tag->term_id).'"><li>'.$tag->name.'</li></a>'; 
		  }
		  echo '</ul>';
		} ?>
		</div><!-- .entry-content -->
		<div class="wp-block-column sticky">
			<?php get_sidebar(); ?>
		</div>
		</div>
		<div class="offwhite-bkgrnd">
		<?php get_template_part('template-parts/content-related-articles'); ?>
		</div>
		
		
		<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
		

	

	<footer class="entry-footer">
		<?php // ag_sites_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php else: // not singular ?>
	<?php $cat = get_the_category(get_the_ID()); 
    $primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
    $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name;
    // $primary_cat ? $primary_cat : $cat; ?>
	<div class="col-12 m-col-6 l-col-4">
        <div class="ncff-popular__container nc-panel">
        <a class="object-fit-image" style="display: block; height: 185px;" href="<?php echo esc_url( get_permalink() ); ?>">
	<?php echo the_post_thumbnail(get_the_ID(), 'medium-thumb'); ?></a>
    <div class="ncff-popular__text-container">
        <p class="ncff-featured__cat"><?php echo $cat_name; ?></p>
        <h3 class="ncff-popular__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
    </div>
        </div>
	
	
	<?php 
	// echo '<p class="cat-text"><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
	// echo '<h3><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h3>';?>
	
</div>
<?php endif; 

