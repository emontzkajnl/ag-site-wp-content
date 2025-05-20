<?php 

function fff_scripts() {
    wp_enqueue_style('parent-theme', get_template_directory_uri().'/style.css');
    wp_enqueue_script( 'fff-main', get_stylesheet_directory_uri().'/assets/js/main.js', 'jQuery', null, true );

}
add_action('wp_enqueue_scripts', 'fff_scripts');

// add post meta to keep track of popular posts
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function load_more_fff_cats() {
    $args = array(
        'post_type'			=> 'post',
        // 'cat'				=> $_POST['cat'],
        'posts_per_page'	=> 12,
        'post_status'       => 'publish',
        'paged'				=> $_POST['page']
    );
    if ($_POST['cat']) {
        $args['cat'] = $_POST['cat'];
    } elseif ($_POST['tag']) { 
        $args['tag'] = $_POST['tag'];
    } elseif ($_POST['author']) {
        $args['author'] = $_POST['author'];
    } elseif ($_POST['search']) {
        $args['s'] = $_POST['search'];
    }
    $cat_query = new WP_Query($args);
    // var_dump(print_r($cat_query, true));
    if($cat_query->have_posts()): 
        // echo '<h2>max pages is '.$cat_query->max_num_pages.'</h2>';
        echo '<div class="row">';
        while($cat_query->have_posts()): $cat_query->the_post(); 
        $cat = get_the_category(get_the_ID()); 
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
        <?php endwhile;
        echo '</div>'; // .row
    endif;
    wp_reset_postdata(  );
    // wp_reset_query();
    wp_die( );
} 

add_action('wp_ajax_loadMoreCats', 'load_more_fff_cats');
add_action('wp_ajax_nopriv_loadMoreCats', 'load_more_fff_cats');

function load_more_fff_recent() {
    $args = array(
        'posts_per_page'        => 4,
        'post_type'             => 'post',
        'paged'             	=> $_POST['page'],
        'post_status'           => 'publish',
    );
    $recent_query = new WP_Query($args);
    if ($recent_query->have_posts()): 
        while ($recent_query->have_posts()):
            $recent_query->the_post(); 
            $ID = get_the_ID(); 
            $cat = get_the_category($ID); 
            $primary_cat = get_post_meta($ID,'_yoast_wpseo_primary_category', TRUE ); 
            $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name; 
            $cat_link = $primary_cat ? get_category_link($primary_cat) : get_category_link($cat[0]->term_id); ?>
               <div class="fff-recent__item">
                    <div class="fff-recent__img-container">
                        <?php echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail($ID, 'full').'</a>'; ?>
                    </div>
                    <div class="fff-recent__text-container">
                    <p class="fff-category"><?php echo '<a class="unstyle-link" href="'.$cat_link.'">'.$cat_name.'</a>'; ?></p>
                    <h2 class="fff-recent__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                    </div>
                </div> 
        <?php endwhile;
    endif;
    // wp_reset_postdata(  );
    wp_die( );
}

add_action('wp_ajax_loadMoreRecent', 'load_more_fff_recent');
add_action('wp_ajax_nopriv_loadMoreRecent', 'load_more_fff_recent');

function load_more_fff_popular() {
    $args = array(
        'posts_per_page'        => 3,
        'post_type'             => 'post',
        'paginated'             => 1,
        'paged'				    => $_POST['page'],
        'post_status'           => 'publish',
        'orderby'               => 'meta_value_num',
        'meta_key'              => 'wpb_post_views_count'
    );
    $pop_query = new WP_Query($args);
    if ($pop_query->have_posts(  )):
        echo '<div class="row">';
        while ($pop_query->have_posts(  )):
            $pop_query->the_post();
            $ID = get_the_ID(); 
            // $visited = get_post_meta( $ID, 'wpb_post_views_count', TRUE); 
            $primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
            $cat = get_the_category($ID); 
            $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name; 
            $cat_link = $primary_cat ? get_category_link( $primary_cat) : get_category_link( $cat[0]->term_id );
            ?>
            <div class="col-12 m-col-4 s-col-6">
            <div class="fff-popular__container">
                <div class="fff-popular__img-container">
                    <?php echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail( ).'</a>'; ?>
                </div>
                <div class="fff-popular__text-container">
                <p class="fff-featured__cat"><?php echo '<a class="unstyle-link" href="'.$cat_link.'">'.$cat_name.'</a>'; ?></p>
                <h3 class="fff-popular__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                </div>
                </div> <!-- container -->
            </div> <!-- col-12 -->
        <?php endwhile;
        echo '</div>';
    endif;
	wp_reset_postdata();
	wp_die();

}

add_action('wp_ajax_loadMoreFFFPopular', 'load_more_fff_popular');
add_action('wp_ajax_nopriv_loadMoreFFFPopular', 'load_more_fff_popular');

