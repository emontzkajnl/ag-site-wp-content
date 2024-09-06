<?php 
$cat = get_the_category(); ?>
<div class="col-12 m-col-12 l-col-6 custom-article-list">
<a href="<?php echo esc_url( get_permalink() ); ?>">
<div class="two-thirds-container">
<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
</div></a>
<?php echo '<h2><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h2>';?>
</div>