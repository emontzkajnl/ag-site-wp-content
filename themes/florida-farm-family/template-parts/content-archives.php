<?php
/**
 * The template part for displaying Archive content
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

?>
<?php
// Insert Ad after 6 posts
if( $wp_query->current_post === 4 ) {
   echo '<div style="width:100%; text-align:center;">';
	if( function_exists('the_ad_placement') ) { 
		echo '<div style="margin:45px auto; width:300px; text-align:center;">';
		the_ad_placement('in-content');
		echo '</div>';
	}
   echo '</div>';
}
?>
<div class="col-md-6" id="post-<?php the_ID(); ?>">
	<div class="archive-image">
		<?php visualcomposerstarter_post_thumbnail('curated-image'); ?>
	</div>
	<div class="archive-wrapper">
		<div class="archive-title">
			<?php the_title( sprintf( '<h2 class="archive-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</div>
	</div>
</div>