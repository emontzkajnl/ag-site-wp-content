<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

?>

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
