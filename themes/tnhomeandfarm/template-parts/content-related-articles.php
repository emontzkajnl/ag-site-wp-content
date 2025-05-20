<?php
$categories = get_the_terms( get_the_ID(  ), 'category' );

if ($categories) {
    $cat_ids = [];
    foreach($categories as $c){
        $cat_ids[] = $c->term_id;
    }
    $today = getdate();
    $rel_args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 4,
        'orderby'           => 'rand',
        'category__in'      => $cat_ids, 
        'post__not_in'      => array(get_the_ID()),
        'date_query'        => array(
            array(
                'after'     => $today[ 'month' ] . ' 1st, ' . ($today[ 'year' ] - 3)
            )
        )
    );
    $rel_articles = new WP_Query($rel_args);
    if ($rel_articles->have_posts( )): ?>
    <div class="related-articles tan-bkgrnd">
        <h2 class="comment-reply-title font__serif">Stories You Might Also Like</h2>
        
        <ul class="row">
        <?php while ($rel_articles->have_posts()): $rel_articles->the_post(); ?>
        <li class="col-12 l-col-3 m-col-6">
            <a href="<?php echo get_the_permalink(); ?>">
                <div class="two-thirds-container">
                    <?php echo get_the_post_thumbnail( ); ?>
                </div>
            </a>
                <?php $yoast_primary_key = get_post_meta( get_the_ID( ), '_yoast_wpseo_primary_category', TRUE );  
                // if ($yoast_primary_key) { echo '<p class="cat-text"><a href="'.get_category_link( $yoast_primary_key ).'">'.get_cat_name($yoast_primary_key).'</a></p>'; } ?>
                <h3 class="related-articles__title"><a class="title-link" href="<?php echo get_the_permalink(  ); ?>"><?php echo get_the_title(); ?></a></h3>
        </li>
        <?php endwhile;
        echo '</ul></div>';
    endif;
    wp_reset_postdata( );
}