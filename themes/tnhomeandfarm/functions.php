<?php 

function thf_scripts() {
    wp_enqueue_style('parent-theme', get_template_directory_uri().'/style.css');
    wp_enqueue_script( 'thf-main', get_stylesheet_directory_uri().'/assets/js/main.js', 'jQuery', null, true );
}
add_action('wp_enqueue_scripts', 'thf_scripts');

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
            'slug'                  => 'tennessee-events',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Event', 'text_domain' ),
            'description'           => __( 'Tennessee Events', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'            => array( 'region_taxonomy', 'event_type_taxonomy', 'season_taxonomy'  ),
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
    
    
    // ADD Event Start Date Columnn to Event List
    function add_event_date_column( $column ) {
        $column['start_date'] = 'Start Date';
        return $column;
    }
    add_filter( 'manage_events_posts_columns', 'add_event_date_column' );
    
    // ADD Event Start Date to the Start Date Column
    function add_event_date_to_column( $column_name, $post_id ) {
        $key = 'start_date';
          $single = true;
          $start_date = get_post_meta( $post_id, $key, $single ); 
        switch ($column_name) {
            case 'start_date' :
                return $start_date;
                break;
            default:
        }
        return $return;
    }
    add_filter( 'manage_events_posts_custom_column', 'add_event_date_to_column', 10, 3 );

    remove_filter ('acf_the_content', 'wpautop');

    function load_more_recent() {
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
                $cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name;?>
                <div class="jci-recent__item">
                    <div class="jci-recent__img-container">
                        <?php echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail($ID, 'full').'</a>'; ?>
                    </div>
                    <div class="jci-recent__text-container">
                    <p class="jci-recent__category"><?php echo $cat_name; ?></p>
                    <h2 class="jci-recent__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                    <div class="jci-recent__excerpt"><?php echo the_excerpt( ); ?></div>
                    </div>
                </div> <!-- container -->
            <?php endwhile;
        endif;
        // wp_reset_postdata(  );
        wp_die( );
    }
    
    add_action('wp_ajax_loadMoreRecent', 'load_more_recent');
    add_action('wp_ajax_nopriv_loadMoreRecent', 'load_more_recent');

    function load_more_contests() {
        $args = array(
            'posts_per_page'        => 2,
            'post_type'             => 'post',
            'category_name'     => 'contests-giveaways',
            'paged'             	=> $_POST['page'],
            'post_status'           => 'publish',
        );
        $contest_query = new WP_Query($args);
        if ($contest_query->have_posts()): 
            while ($contest_query->have_posts()):
                $contest_query->the_post(); 
                $ID = get_the_ID(); ?>
                   <div class="thf-contests__item ">
        <div class="thf-contests__img-container object-fit-image">
            <a href="<?php echo get_the_permalink(); ?>">
            <?php echo get_the_post_thumbnail( $ID, 'medium_large'); ?>
            </a>
        </div>
        <div class="thf-contests__text-container">
            <h3><a  class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
            <p class="thf-contests__excerpt"><?php echo get_the_excerpt(  ); ?></p>
        </div>
    </div>
            <?php endwhile;
        endif;
        wp_reset_postdata(  );
        wp_die( );
    }
    
    add_action('wp_ajax_loadMoreContests', 'load_more_contests');
    add_action('wp_ajax_nopriv_loadMoreContests', 'load_more_contests');

    function load_more_thf_cats() {
        $args = array(
            'post_type'			=> 'post',
            // 'cat'				=> $_POST['cat'],
            'posts_per_page'	=> 8,
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
            while($cat_query->have_posts()): $cat_query->the_post(); 
            $cat = get_the_category(get_the_ID()); ?>
            <div class="col-12 m-col-12  archive-item">
            
            <div class="archive-item__img-container object-fit-image">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
            </a></div>
            <div class="archive-item__text-container">
                <?php echo '<span class="posted-on">Posted on <time class="entry-date published updated" datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time></span>';
                echo '<h2><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h2>';
                echo '<p class="archive-item__excerpt">'.get_the_excerpt(  ).'</p>';
                ?>
        
        
            </div>
            
        </div>
            <?php endwhile;
            echo '</div>'; // .row
        endif;
        wp_reset_postdata(  );
        // wp_reset_query();
        wp_die( );
    }
    add_action('wp_ajax_loadMoreThfCats', 'load_more_thf_cats');
    add_action('wp_ajax_nopriv_loadMoreThfCats', 'load_more_thf_cats');

    //Insert ads after third paragraph of single post content.
add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
	if (get_post_type() == '') {return $content;}
	ob_start();
	if( function_exists('the_ad_placement') ) { the_ad_placement('in-content'); }
	$ad_code = ob_get_contents();
	ob_end_clean();
	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $ad_code, 2, $content );
	}
return $content;
}
// Parent Function that makes the magic happen
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	//create array seperated by paragraphs
	$paragraphs = explode( $closing_p, $content );

	foreach ($paragraphs as $index => $paragraph) {

			$paragraphs[$index] .= $closing_p;

		if ( $paragraph_id == $index ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}

function thf_order_events($query) {
    if (!is_admin() ){
        if ($query->is_post_type_archive( 'events' ) && $query->is_main_query()):
            // $now = strtotime('now');
            // $meta_query = array(
            //     array(
            //         'key'   => 'start_date',
            //         'value' => $now,
            //         'compare'   => '>'
            //     )
            // );
            // $query->set('meta_query', $meta_query);
            $query->set( 'order', 'ASC' );
            $query->set('meta_key', 'start_date');
            $query->set('orderby', 'meta_value');
            $query->set('posts_per_page', '-1');
        endif;
    }
}
add_action('pre_get_posts', 'thf_order_events');

function infobox_shortcode($atts, $content = null) {
	$a = shortcode_atts( array(
		'alignment'		=> '',
		'title'			=> ''
	), $atts);
	$html = '<div class="infobox '.$a['alignment'].'">';
	$html .= $a['title'] ? '<span class="infobox-header"><h3>'.$a['title'].'</h3></span>' : '';
	$html .= '<div class="infobox-content">'.$content.'</div></div>';
	return $html; 
	
}
add_shortcode( 'infobox', 'infobox_shortcode' );
    
    
    // custom jquery for event form validation
    // wp_register_script( 'custom_js', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), '1.0', TRUE );
    // wp_enqueue_script( 'custom_js' );
     
    // custom validation for event forms
    // wp_register_script( 'validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ) );
    // wp_enqueue_script( 'validation' );
    