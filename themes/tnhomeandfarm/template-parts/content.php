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
				
			

				
               // CUSTOM BREADCRUMB
				$cats = get_the_category(); 
    			$primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
				$cat_obj = $primary_cat ? get_category($primary_cat) : $cats[0];
				//term_id, name, parent, get_term_link()
				
				echo '<p id="breadcrumbs"><span><span><a href="'.site_url().'">Home</a></span> » ';
				if ($cat_obj->parent > 0): 
					$parent_obj = get_category($cat_obj->parent);
					echo '<span><span><a href="'.get_category_link( $parent_obj->term_id ).'">'.$parent_obj->name.'</a></span> » </span>';
				endif; 
				echo '<span class="breadcrumb_last"><a href="'.get_category_link($cat_obj->term_id).'"><strong>'.$cat_obj->name.'</strong></a></span></span></p>';

            	the_title( '<h1 class="entry-title">', '</h1>' );
				ag_sites_posted_by();
				 echo ' | ';
				ag_sites_posted_on_updated();
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
			echo '<div class="category-wrap "><ul>';
		  foreach($posttags as $tag) {
			echo '<li class="background__primary"><a href="'.get_term_link($tag->term_id).'">'.$tag->name.'</a></li>'; 
		  }
		  echo '</ul></div>';
		} 
	
			
		?>
		
	</div><!-- .entry-content -->
	<div class="wp-block-column sticky">
		<?php get_sidebar(); ?>
	</div>
	</div>
	<?php // you might also like section
		get_template_part('template-parts/content-related-articles');
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
?>
	<footer class="entry-footer">
		<?php // ag_sites_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php else: ?>
	<?php $cat = get_the_category(get_the_ID()); ?>
	<div class="col-12 m-col-12  archive-item">
	
	<div class="archive-item__img-container object-fit-image">
	<a href="<?php echo esc_url( get_permalink() ); ?>">
	<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
	</a></div>
	<div class="archive-item__text-container">
		<?php echo '<span class="posted-on"><time class="entry-date published updated" datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time></span>';
		echo '<h2><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h2>';
		echo '<p class="archive-item__excerpt">'.get_the_excerpt(  ).'</p>';
		?>
	</div>
	
</div>
<?php endif; 

