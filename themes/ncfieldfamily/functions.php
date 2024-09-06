<?php 

function ncff_scripts() {
    wp_enqueue_style('parent-theme', get_template_directory_uri().'/style.css');
    wp_enqueue_script( 'ncff-main', get_stylesheet_directory_uri().'/assets/js/main.js', 'jQuery', null, true );

}
add_action('wp_enqueue_scripts', 'ncff_scripts');

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

function load_more_recent() {
    $args = array(
		'post_type'			=> 'post',
		'posts_per_page'	=> 3,
		'post_status'       => 'publish',
		'paged'				=> $_POST['page']
	);
    $recent_query = new WP_Query($args);
    if ($recent_query->have_posts(  )):
        while ($recent_query->have_posts(  )):
            $recent_query->the_post();
            $ID = get_the_ID(); 
            $primary_cat = get_post_meta($ID,'_yoast_wpseo_primary_category', TRUE );?>
            <div class="ncff-recent__container">
                <div class="ncff-recent__img-container">
                    <?php echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail($ID, 'full').'</a>'; ?>
                </div>
                <div class="ncff-recent__text-container">
                <p class="ncff-featured__cat"><?php echo get_the_category_by_ID($primary_cat); ?></p>
                <h2 class="ncff-recent__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                <?php echo the_excerpt(  ); ?>
                </div>
            </div> <!-- container -->
        <?php endwhile;
    endif;
	wp_reset_postdata();
	wp_die();
}
add_action('wp_ajax_loadMoreRecent', 'load_more_recent');
add_action('wp_ajax_nopriv_loadMoreRecent', 'load_more_recent');

function load_more_popular() {
    $args = array(
        'posts_per_page'        => 4,
        'post_type'             => 'post',
        'paginated'             => 1,
        'paged'				    => $_POST['page'],
        'post_status'           => 'publish',
        'orderby'               => 'meta_value_num',
        'meta_key'              => 'wpb_post_views_count'
    );
    $pop_query = new WP_Query($args);
    if ($pop_query->have_posts(  )):
        while ($pop_query->have_posts(  )):
            $pop_query->the_post();
            $ID = get_the_ID(); 
            $visited = get_post_meta( $ID, 'wpb_post_views_count', TRUE); 
            $primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
            $cat = get_the_category($ID); 
            $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name; ?>
            <div class="col-12 m-col-3 s-col-6">
            <div class="ncff-popular__container nc-panel">
                <div class="ncff-popular__img-container">
                    <?php echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail( ).'</a>'; ?>
                </div>
                <div class="ncff-popular__text-container">
                <p class="ncff-featured__cat"><?php echo $cat_name; ?></p>
                <h3 class="ncff-popular__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                </div>
                </div> <!-- container -->
            </div> <!-- col-12 -->
        <?php endwhile;
    endif;
	wp_reset_postdata();
	wp_die();
}
add_action('wp_ajax_loadMorePopular', 'load_more_popular');
add_action('wp_ajax_nopriv_loadMorePopular', 'load_more_popular');

function ncff_comments($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard"><?php 
            if ( $args['avatar_size'] != 0 ) {
                //echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
        </div><?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>
        <div class="comment-meta commentmetadata">
            <a class="unstyle-link" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                printf( 
                    __('%1$s at %2$s'), 
                    get_comment_date(),  
                    get_comment_time() 
                ); ?>
            </a><?php 
            edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
        </div>

        <?php comment_text(); ?>

        <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}



if ( ! function_exists( 'ncff_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ncff_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'ag-sites' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline unstyle-link"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

//Insert ads after third paragraph of single post content.
add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
	if (get_post_type() == '') {return $content;}
	ob_start();
	if( function_exists('the_ad_placement') ) { the_ad_placement('in-content'); }
	$ad_code = ob_get_contents();
	// $ad_code = '<div class="advertisement">Advertisement</div>';
	// $ad_code .= '<div style="width: 100%; text-align: center;"><div id="div-gpt-ad-1694457127306-0" style="min-width: 300px; min-height: 250px; display: inline-block;">';
	// $ad_code .= '<script>googletag.cmd.push(function() { googletag.display("div-gpt-ad-1694457127306-0"); });</script></div></div>';
	ob_end_clean();
	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $ad_code, 2, $content );
	}
return $content;
}
// Parent Function that makes the magic happen
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	// $p_id = $paragraph_id;
	$closing_p = '</p>';
	//create array seperated by paragraphs
	$paragraphs = explode( $closing_p, $content );

	// if (str_contains( $paragraphs[2], 'infobox' )) {
	// 	$paragraph_id = 1;
	// }
	// $has_infobox = false;
	foreach ($paragraphs as $index => $paragraph) {

			$paragraphs[$index] .= $closing_p;

		if ( $paragraph_id == $index ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}

/*  AddToAny Instagram */
function addtoany_add_share_services( $services ) {
    $services['example_share_service'] = array(
        'name'        => 'Instagram',
        'icon_url'    => site_url('/wp-content/plugins/add-to-any/icons/instagram.svg'),
        'icon_width'  => 32,
        'icon_height' => 32,
        'href'        => 'https://www.instagram.com/ncfieldfamily'
    );
    return $services;
}
add_filter( 'A2A_SHARE_SAVE_services', 'addtoany_add_share_services', 10, 1 );

function load_more_ncff_cats() {
	// error_log(var_dump($_POST, true));
	$args = array(
		'post_type'			=> 'post',
		// 'cat'				=> $_POST['cat'],
		'posts_per_page'	=> 12,
		'post_status'       => 'publish',
		'paged'				=> $_POST['page']
	);
	if ($_POST['cat']) {
		$args['cat'] = $_POST['cat'];
	} else { // this is a tag page
		$args['tag'] = $_POST['tag'];
	}
	$cat_query = new WP_Query($args);
	// var_dump(print_r($cat_query, true));
	if($cat_query->have_posts()): 
		// echo '<h2>max pages is '.$cat_query->max_num_pages.'</h2>';
		echo '<div class="row">';
		while($cat_query->have_posts()): $cat_query->the_post(); 
        $cat = get_the_category(get_the_ID()); 
        $primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
        $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name; ?>
        <div class="col-12 m-col-6 l-col-4">
            <div class="ncff-popular__container nc-panel">
            <a class="object-fit-image" style="display: block; height: 185px;" href="<?php echo esc_url( get_permalink() ); ?>">
	        <?php echo get_the_post_thumbnail(get_the_ID(), 'medium-thumb'); ?></a>
            <div class="ncff-popular__text-container">
        <p class="ncff-featured__cat"><?php echo $cat_name; ?></p>
        <h3 class="ncff-popular__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
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
add_action('wp_ajax_loadMoreNcffCats', 'load_more_ncff_cats');
add_action('wp_ajax_nopriv_loadMoreNcffCats', 'load_more_ncff_cats');

// EVENTS CUSTOM POST TYPE

if ( ! function_exists('events') ) {

    // Register Custom Post Type
    function events() {
    
        $labels = array(
            'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Events', 'text_domain' ),
            'name_admin_bar'        => __( 'Events', 'text_domain' ),
            'archives'              => __( 'Event Archives', 'text_domain' ),
            'attributes'            => __( 'Event Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Event:', 'text_domain' ),
            'all_items'             => __( 'All Events', 'text_domain' ),
            'add_new_item'          => __( 'Add New Event', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Event', 'text_domain' ),
            'edit_item'             => __( 'Edit Event', 'text_domain' ),
            'update_item'           => __( 'Update Event', 'text_domain' ),
            'view_item'             => __( 'View Event', 'text_domain' ),
            'view_items'            => __( 'View Events', 'text_domain' ),
            'search_items'          => __( 'Search Events', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Main Event Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set event image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove event image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into event', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this event', 'text_domain' ),
            'items_list'            => __( 'Events list', 'text_domain' ),
            'items_list_navigation' => __( 'Events list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter Events List', 'text_domain' ),
        );
        $rewrite = array(
            'slug'                  => 'nc-events',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Event', 'text_domain' ),
            'description'           => __( 'North Carolina Events', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'            => array( 'region_taxonomy', 'event_type_taxonomy', 'season_taxonomy', 'post_tag'  ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'events', $args );
    
    }
    add_action( 'init', 'events', 0 );
}

    // EVENT REGIONS TAXONOMY

if ( ! function_exists( 'region_taxonomy' ) ) {

    // Register Custom Taxonomy
    function region_taxonomy() {
    
        $labels = array(
            'name'                       => _x( 'Regions', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Region', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Regions', 'text_domain' ),
            'all_items'                  => __( 'All Regions', 'text_domain' ),
            'parent_item'                => __( 'Parent Region', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Region:', 'text_domain' ),
            'new_item_name'              => __( 'New Region Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Region', 'text_domain' ),
            'edit_item'                  => __( 'Edit Region', 'text_domain' ),
            'update_item'                => __( 'Update Region', 'text_domain' ),
            'view_item'                  => __( 'View Item', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate regions with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove regions', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used regions', 'text_domain' ),
            'popular_items'              => __( 'Popular Items', 'text_domain' ),
            'search_items'               => __( 'Search regions', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No items', 'text_domain' ),
            'items_list'                 => __( 'Items list', 'text_domain' ),
            'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => false,
        );
        register_taxonomy( 'region', array( 'events' ), $args );
    
    }
    add_action( 'init', 'region_taxonomy', 0 );
    
    }
    
    if ( ! function_exists( 'event_type_taxonomy' ) ) {
    
    // Register Custom Taxonomy
    function event_type_taxonomy() {
    
        $labels = array(
            'name'                       => _x( 'Event Types', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Event Type', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Event Types', 'text_domain' ),
            'all_items'                  => __( 'All Event Types', 'text_domain' ),
            'parent_item'                => __( 'Parent Event Types', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Event:', 'text_domain' ),
            'new_item_name'              => __( 'New Event Type Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Event Type', 'text_domain' ),
            'edit_item'                  => __( 'Edit Event Type', 'text_domain' ),
            'update_item'                => __( 'Update Event Type', 'text_domain' ),
            'view_item'                  => __( 'View Event Type', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate event types with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove event types', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Event Types', 'text_domain' ),
            'search_items'               => __( 'Search Event Types', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No Event Types', 'text_domain' ),
            'items_list'                 => __( 'Event Types list', 'text_domain' ),
            'items_list_navigation'      => __( 'Event Types list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => false,
        );
        register_taxonomy( 'event_type', array( 'events' ), $args );
    
    }
    add_action( 'init', 'event_type_taxonomy', 0 );
    
    }
    
    if ( ! function_exists( 'season_taxonomy' ) ) {
    
    // Register Custom Taxonomy
    function season_taxonomy() {
    
        $labels = array(
            'name'                       => _x( 'Seasons', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Season', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Seasons', 'text_domain' ),
            'all_items'                  => __( 'All Seasons', 'text_domain' ),
            'parent_item'                => __( 'Parent Season', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Season:', 'text_domain' ),
            'new_item_name'              => __( 'New Season Name', 'text_domain' ),
            'add_new_item'               => __( 'Add Season Item', 'text_domain' ),
            'edit_item'                  => __( 'Edit Season', 'text_domain' ),
            'update_item'                => __( 'Update Season', 'text_domain' ),
            'view_item'                  => __( 'View Season', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate seasons with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove seasons', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Seasons', 'text_domain' ),
            'search_items'               => __( 'Search Seasons', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No Seasons', 'text_domain' ),
            'items_list'                 => __( 'Seasons list', 'text_domain' ),
            'items_list_navigation'      => __( 'Seasons list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => false,
        );
        register_taxonomy( 'season', array( 'events' ), $args );
    
    }
    add_action( 'init', 'season_taxonomy', 0 );
    
    }
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title' 	=> 'Featured Events Block',
            'menu_title'	=> 'Featured Events Block',
            'menu_slug'		=> 'featured-events',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));
    }

    function ncff_remove_comment_url($arg) {
        $arg['url'] = '';
        return $arg;
        }
         
        add_filter('comment_form_default_fields', 'ncff_remove_comment_url');


  
        
function register_shortcodes() {
    add_shortcode( 'list_ncff_magazines', 'ncff_magazine_function' );
}
function ncff_magazine_function() {
    $args = array(
        'post_type'     => 'magazine',
        'offset'        => 1,
        'numberposts'   => 100,
        'post_status'   => 'publish'
    );
    $mags = get_posts($args);
    $html = '<h2>Previous Magazines</h2><div class="row">';
    foreach ($mags as $key => $value) {
        $ID = $value->ID;
        $html .= '<div class="col-12 m-col-3 l-col-2 mag custom-article-list">';
        $html .= '<a href="'.esc_url( get_permalink($ID) ).'">';
        $html .= get_the_post_thumbnail($ID, array(180,243) ).'</a>';
        $html .= '<h3><a class="title-link" href="'.esc_url( get_permalink($ID) ).'">'.get_the_title($ID).'</a></h3>';
        $html .= '</div>';
        
    }
    $html .= '</div>'; //row
    return $html;
}
add_action('init', 'register_shortcodes');
        