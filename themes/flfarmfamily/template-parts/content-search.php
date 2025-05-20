<?php $cat = get_the_category(get_the_ID()); 
    $primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
    $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name;
	$cat_link = $primary_cat ? get_category_link( $primary_cat ) : get_category_link( $cat[0]->term_id );
    // $primary_cat ? $primary_cat : $cat; ?>
	<div class="col-12 l-col-6 xl-col-4">
        <div class="fff-archive__container">
        <a class="object-fit-image" style="display: block; height: 265px;" href="<?php echo esc_url( get_permalink() ); ?>">
	<?php echo the_post_thumbnail(get_the_ID(), 'medium-thumb'); ?></a>
    <div class="fff-archive__text-container">
        <p class="fff-category"><?php echo '<a class="unstyle-link" href="'.$cat_link.'">'.$cat_name.'</a>'; ?></p>
        <h3 class="fff-archive__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
    </div>
        </div>
	
	
</div>