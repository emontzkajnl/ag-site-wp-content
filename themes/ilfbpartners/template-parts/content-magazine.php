<?php //if ($first_mag == false): ?>
<div class="col-12 m-col-3 l-col-2 mag custom-article-list">
	<a href="<?php echo esc_url( get_permalink() ); ?>">
	<?php echo get_the_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
    </a>
	
	<?php 
	
	echo '<h3><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h3>';?>
	
</div>
<?php //endif; $first_mag = false; ?>