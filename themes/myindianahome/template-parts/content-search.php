<?php $cat = get_the_category(get_the_ID()); 
    $primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
    $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name;
    // $primary_cat ? $primary_cat : $cat; ?>
	<div class="col-12 l-col-6 archive">
        <div class="mih-archive__container ">
        <a class="object-fit-image" style="display: block; height: 325px;" href="<?php echo esc_url( get_permalink() ); ?>">
	<?php echo the_post_thumbnail(get_the_ID(), 'medium-large'); ?></a>
    <div class="mih-archive__text-container">
        <p class="mih-archive__cat"><?php echo $cat_name; ?></p>
        <h3 class="mih-archive__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
		<p class="mih-archive__excerpt"><?php echo get_the_excerpt(  ); ?></p>
    </div>
        </div>
</div>