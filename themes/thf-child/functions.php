<?php

$before_widget = NULL;
$after_widget = NULL;
register_sidebar(array(
  'name' => __( 'Home Leaderboard' ),
		'before_widget' => $before_widget,
		'after_widget' => $after_widget,
		'before_title' => $before_title,
		'after_title' => $after_title
));
register_sidebar(array(
  'name' => __( 'Category Leaderboard' ),
		'before_widget' => $before_widget,
		'after_widget' => $after_widget,
		'before_title' => $before_title,
		'after_title' => $after_title
));
register_sidebar(array(
	'id' => 'category-sidebar',
	'name' => 'Category Sidebar',
	'before_widget' => '<div class="sidebar-widget">',
	'after_widget' => '</div>',
	'before_title' => '<span class="sidebar-widget-header"><h3 class="sidebar-widget-header">',
	'after_title' => '</h3></span>',
));
register_sidebar(array(
	'id' => 'article-ad',
	'name' => 'Article Small Rectangle Ad',
	'description' => 'Small 180x150 ad at beginning of article content',
	'before_widget' => '<div style="float:left; min-width:200px;">',
	'after_widget' => '</div>',
	'before_title' => $before_title,
	'after_title' => $after_title
));
register_sidebar(array(
	'id' => 'sidebar-events-widget',
	'name' => 'Events Sidebar',
	'before_widget' => '<div class="sidebar-widget">',
	'after_widget' => '</div>',
	'before_title' => '<span class="sidebar-widget-header"><h3 class="sidebar-widget-header">',
	'after_title' => '</h3></span>',
));
register_sidebar(array(
	'id' => 'mobile-ad',
	'name' => 'Mobile Ad',
	'before_widget' => '<div class="mobile-ad" style="clear: both;"></div>',
	'after_widget' => $after_widget,
	'before_title' => $before_title,
	'after_title' => $after_title,
));
register_sidebar(array(
	'id' => 'yia',
	'name' => 'Youth In Agriculture Sidebar',
	'before_widget' => '<div class="sidebar-widget yia">',
	'after_widget' => '</div>',
	'before_title' => '<span class="sidebar-widget-header"><h3 class="sidebar-widget-header">',
	'after_title' => '</h3></span>',
));

function is_subcategory (){
    $cat = get_query_var('cat');
    $category = get_category($cat);
    $category->parent;
    return ( $category->parent == '0' ) ? false : true;
}

// Remove URL / Website from Comments
function crunchify_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','crunchify_disable_comment_url');


// Change the ACF Options Page Title
if( function_exists('acf_set_options_page_title') )
{
    acf_set_options_page_title( __('Site Options & Help') );
}
// Change the ACF Options Menu Title
if( function_exists('acf_set_options_page_menu') )
{
    acf_set_options_page_menu( __('Site Options & Help') );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'sidebar-related-posts-thumb', 100, 66, true ); //(cropped)
	add_image_size( 'event-full', 620 );
	add_image_size( 'event-thumb', 120, '80', true );
}

function pa_category_top_parent_id ($catid) {

 while ($catid) {
  $cat = get_category($catid); // get the object for the catid
  $catid = $cat->category_parent; // assign parent ID (if exists) to $catid
  // the while loop will continue whilst there is a $catid
  // when there is no longer a parent $catid will be NULL so we can assign our $catParent
  $catParent = $cat->cat_ID;
 }

return $catParent;
}



/////////////////////////////////////


// Pagination


/////////////////////////////////////





if ( !function_exists( 'pagination' ) ) {


function pagination($pages = '', $range = 4)


{


     $showitems = ($range * 2)+1;





     global $paged;


     if(empty($paged)) $paged = 1;





     if($pages == '')


     {


         global $wp_query;


         $pages = $wp_query->max_num_pages;


         if(!$pages)


         {


             $pages = 1;


         }


     }





     if(1 != $pages)


     {


         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";

		  //  if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' class=\"custom-pager-first\">&laquo; First</a>";


         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class=\"custom-pager-prev\">&lsaquo; Previous</a>";





         for ($i=1; $i <= $pages; $i++)


         {


             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))


             {


                 echo ($paged == $i)? "<span class=\"current pagenum\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive pagenum\">".$i."</a>";


             }


         }





         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\" class=\"custom-pager-next\">Next &rsaquo;</a>";


         // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' class=\"custom-pager-last\">Last &raquo;</a>";


         echo "</div>\n";


     }


}


}





/////////////////////////////////////

// Custom Theme Options

/////////////////////////////////////


if ( ! function_exists( 'my_wp_head' ) ) {


function my_wp_head() {

	$main_accent_color = get_field('main_accent_color', 'option');

	$main_body_background = get_field('main_body_background', 'option');

	$main_footer_color = get_field('main_footer_color', 'option');

	$current_theme = get_bloginfo('stylesheet_directory');

	$bloginfo = get_template_directory_uri();


	$primarytheme = get_option('mvp_primary_theme');


	$mainmenu = get_option('mvp_menu_color');


	$link = get_option('mvp_link_color');


	$wallad = get_option('mvp_wall_ad');


	$slider_headline = get_option('mvp_slider_headline');


	$menu_font = get_option('mvp_menu_font');


	$headline_font = get_option('mvp_headline_font');


	$header_font = get_option('mvp_header_font');


	$google_slider = preg_replace("/ /","+",$slider_headline);


	$google_menu = preg_replace("/ /","+",$menu_font);


	$google_headlines = preg_replace("/ /","+",$headline_font);


	$google_header = preg_replace("/ /","+",$header_font);


	echo "


<style type='text/css'>





@import url(https://fonts.googleapis.com/css?family=$google_slider:100,200,300,400,500,600,700,800,900|$google_menu:100,200,300,400,500,600,700,800,900|$google_headlines:100,200,300,400,500,600,700,800,900|$google_header:100,200,300,400,500,600,700,800,900&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese);



#body-wrapper, #site {background: $main_body_background !important;}


#nav-wrapper, .pagination span, .pagination a {


	background: $main_accent_color !important;

	}

div.wpcf7-response-output {
	background: $main_accent_color url($current_theme/images/check.png) no-repeat !important;
	background-position-x: left !important;
	background-position-y: 50% !important;
	background-position: left 7px center !important;
	padding:20px 20px 20px 70px;
	color:#fff !important;
	font-size:18px !important;
	border: 0px !important;
	font-family:'Lato', sans-serif !important;
	width:90%;
}

input[type='submit'] {background: $main_accent_color !important; border:none !important; padding:10px !important; width: auto !important; color:#fff !important; cursor:pointer;}

.pagination .current, .pagination a:hover {
background-color: $main_accent_color !important;
}

#footer-wrapper {background: $main_footer_color;}


#main-nav .menu li a:hover,


#main-nav .menu li.current-menu-item a,


#search-button:hover,


.home-widget h3.widget-cat,


span.post-tags-header,


.post-tags a:hover,


.tag-cloud a:hover {


	background: $main_accent_color;


	}





#main-nav .menu-item-home a:hover {


	background: $primarytheme !important;


	}





#top-story-left h3,


#top-story-right h3 {


	border-bottom: 3px solid $primarytheme;


	}





a, a:visited,


ul.top-stories li:hover h2,


ul.top-stories li:hover h2,


#top-story-middle:hover h2,


#top-story-wrapper:hover #feat2-main-text h2,


#feat1-left-wrapper:hover .feat1-left-text h2,


#feat1-right-wrapper:hover .feat1-right-text h2,


ul.split-columns li:hover h2,


.home-widget ul.wide-widget li:hover h2,


.home-widget ul.home-list li:hover h2,


h3.story-cat,


h3.story-cat a,


.sidebar-widget ul.home-list li:hover h2,


.sidebar-widget ul.wide-widget li:hover h2,


.sidebar-widget ul.split-columns li:hover h2,


#footer-nav .menu li a:hover,


.footer-widget ul.home-list li:hover h2,


.footer-widget ul.wide-widget li:hover h2,


.footer-widget ul.split-columns li:hover h2,


.prev,


.next {


	color: $link;


	}





#wallpaper {


	background: url($wallad) no-repeat 50% 0;


	}





.featured-text h2,


.featured-text h2 a,


.feat1-main-text h2,


.feat1-main-text h2 a {


	font-family: '$slider_headline', serif;


	}





#main-nav .menu li a,


#main-nav .menu li:hover ul li a {


	font-family: '$menu_font', sans-serif;


	}





#top-story-left h2,


#top-story-right h2,


.feat1-left-text h2,


.feat1-right-text h2,


#feat2-main-text h2,


#middle-text h2,


ul.split-columns li h2,


.home-widget .wide-text h2,


.home-widget .home-list-content h2,


h1.story-title,


.sidebar-widget .wide-text h2,


.sidebar-widget ul.split-columns li h2,


.footer-widget .wide-text h2,


.footer-widget ul.split-columns li h2,


#post-404 h1 {


	font-family: '$headline_font', serif;


	}





#top-story-left h3,


#top-story-right h3,


#middle-text h3,


h1.home-widget-header,


#woo-content h1.page-title,


h3.home-widget-header,


h1.archive-header,


h3.story-cat,


h3.story-cat a,


#content-area h1,


#content-area h2,


#content-area h3,


#content-area h4,


#content-area h5,


#content-area h6,


h4.post-header,


h3.sidebar-widget-header,


h3.footer-widget-header {


	font-family: '$header_font', sans-serif;


	}

@media screen and (max-width: 767px) and (min-width: 480px) {





	.sidebar-widget .home-list-content h2 {


		font-family: '$headline_font', serif;


		}





	}





</style>


	";


}


}


add_action( 'wp_head', 'my_wp_head' );

// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
function custom_colors() {
   echo '<style type="text/css">
			#mvp-featured-headline, #mvp-featured-image.postbox, #mvp-photo-credit.postbox, #mvp-video-embed {display:none; !important}
         </style>';
}

add_action('admin_head', 'custom_colors');

// Adds CF7 fallback date fields for event form
// add_filter( 'wpcf7_support_html5_fallback', '__return_true' );


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

// ADD Evebt Start Date to the Start Date Column
function add_event_date_to_column( $column_name, $user_id ) {
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


// custom jquery for event form validation
wp_register_script( 'custom_js', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), '1.0', TRUE );
wp_enqueue_script( 'custom_js' );
 
// custom validation for event forms
wp_register_script( 'validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ) );
wp_enqueue_script( 'validation' );



// 
// add_action( 'pre_get_posts', 'sort_events' );
// function sort_events( $query ){
// 
//     if( 'events' == $query->get( 'post_type' ) ) //Apply only for 'product' post types
//         return;
// 
//     $query->set( 'order', 'asc' );
//     $query->set( 'orderby', 'meta_value' );
//     $query->set( 'meta_key', 'start_date' );
// }

// MOBILE MENU FROM OLD BRAXTON VERSION
class select_menu_walker extends Walker_Nav_Menu{
	 function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}
	 function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$classes[] = 'menu-item-' . $object->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $object->ID, $object, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
		$sel_val =  ' value="'   . esc_attr( $object->url        ) .'"';
		//check if the menu is a submenu
		switch ($depth){
		  case 0:
			   $dp = "";
			   break;
		  case 1:
			   $dp = "-";
			   break;
		  case 2:
			   $dp = "--";
			   break;
		  case 3:
			   $dp = "---";
			   break;
		  case 4:
			   $dp = "----";
			   break;
		  default:
			   $dp = "";
		}
		$output .= $indent . '<option'. $sel_val . $id . $value . '>'.$dp;
		$item_output = $args->before;
		//$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
		//$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
	}
	function end_el( &$output, $object, $depth = 0, $args = array() ) {
		$output .= "</option>\n";
	}
}


/////////////////////////////////////
// Comments
/////////////////////////////////////

if ( !function_exists( 'mvp_comment' ) ) {
	function mvp_comment( $comment, $args, $depth ) {
		
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
				<div class="comment-inner">
					<div class="comment-avatar">
						<?php echo get_avatar( $comment, 46 ); ?>
					</div>
					<div class="commentmeta">
						<p class="comment-meta-1">
							<?php printf( __( '%s ', 'mvp-text'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						</p>
						<p class="comment-meta-2">
							<?php echo get_comment_date(); ?> <?php _e( 'at', 'mvp-text'); ?> <?php echo get_comment_time(); ?>
							<?php edit_comment_link( __( 'Edit', 'mvp-text'), '(' , ')'); ?>
						</p>
					</div>
					<div class="text">
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<p class="waiting_approval"><?php _e( 'Your comment is awaiting moderation.', 'mvp-text' ); ?></p>
						<?php endif; ?>
	
						<div class="c">
							<?php comment_text(); ?>
						</div>
					</div><!-- .text  -->
					<div class="clear"></div>
					<div class="comment-reply"><span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span></div>
				</div><!-- comment-inner  -->
			</div><!-- comment-wrapper  -->
		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'mvp-text' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mvp-text' ), ' ' ); ?></p>
		<?php
				break;
		endswitch;
	}
}

//Insert ads after third paragraph of single post content.
add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
	ob_start();
	if( function_exists('the_ad_placement') ) { the_ad_placement('in-content'); }
	$ad_code = ob_get_contents();
	ob_end_clean();
	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $ad_code, 3, $content );
	}
return $content;
}
// Parent Function that makes the magic happen
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}
add_filter( 'redirection_role', function( $role ) {
	return 'edit_posts';  // Add your chosen capability or role here
} );


/**
 * Fix the "Current post is not identical to main post."
 * and "Current query is not identical to main query." warnings in Advanced Ads
 * caused by custom queries not using wp_reset_postdata() or wp_reset_query()
 * 
 * @source https://wpadvancedads.com/manual/ad-debug-mode/
 * @source https://developer.wordpress.org/reference/classes/wp_query/
 * @source https://developer.wordpress.org/reference/functions/query_posts/
 * 
 * Developers should not use this and rather add wp_reset_postdata() or wp_reset_query() to their code
 * We are using wp_reset_postdata() because it is less invasive and doesn’t reset the whole query
 */
add_filter( 'advanced-ads-ad-select-args', function( $args ) {
	// reset post data
	wp_reset_postdata();
	return $args;
});




?>