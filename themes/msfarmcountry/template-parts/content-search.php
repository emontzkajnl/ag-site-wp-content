<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

?>

<?php $cat = get_the_category(get_the_ID()); ?>
	<div class="col-12 m-col-12">
		<div class="row mfc-archive">
			<div class="col-12 l-col-4">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<div class="two-thirds-container">
			<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
			</div></a>
			</div>
			<div class="col-12 l-col-8 mfc-archive__text-area">
			<?php 
			echo '<p class="mfc-cat-title "><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
			echo '<h3 class="mfc-archive__title"><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h3>';
			echo '<p class="mfc-archive__excerpt">'.get_the_excerpt(  ).'</p>'; ?>
			</div>
		</div>
	</div>