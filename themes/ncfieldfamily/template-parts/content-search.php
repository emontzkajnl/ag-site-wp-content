<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

    $cat = get_the_category(get_the_ID()); 
    $primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
    $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name;
?>

<div class="col-12 m-col-6 l-col-4">
<div class="ncff-popular__container nc-panel">
        <a class="object-fit-image" style="display: block; height: 185px;" href="<?php echo esc_url( get_permalink() ); ?>">
	<?php echo the_post_thumbnail(get_the_ID(), 'medium-thumb'); ?></a>
    <div class="ncff-popular__text-container">
        <p class="ncff-featured__cat"><?php echo $cat_name; ?></p>
        <h3 class="ncff-popular__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
    </div>
</div>
</div>
