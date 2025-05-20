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
	'id' => 'mobile-ad',
	'name' => 'Mobile Ad',
	'description' => 'Displays ad mid-content on mobile only',
	'before_widget' => '<div style="float:left; width:100&percnt;;">',
	'after_widget' => '</div>',
	'before_title' => $before_title,
	'after_title' => $after_title
));

function is_subcategory (){
    $cat = get_query_var('cat');
    $category = get_category($cat);
    $category->parent;
    return ( $category->parent == '0' ) ? false : true;
}



/////////////////////////////////////

// Register Widgets

/////////////////////////////////////


if ( !function_exists( 'mvp_sidebars_init' ) ) {

	function mvp_sidebars_init() {

		register_sidebar(array(
			'id' => 'homepage-widget',
			'name' => 'Homepage Widget Area',
			'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="home-widget-header top-border-teal"><div class="arrow teal"></div>',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'sidebar-home-widget',
			'name' => 'Sidebar Home Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="sidebar-widget-header"><h3 class="sidebar-widget-header">',
			'after_title' => '</h3></span>',
		));

		register_sidebar(array(
			'id' => 'sidebar-widget',
			'name' => 'Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="sidebar-widget-header"><h3 class="sidebar-widget-header">',
			'after_title' => '</h3></span>',
		));

		register_sidebar(array(
			'id' => 'sidebar-woo-widget',
			'name' => 'WooCommerce Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="sidebar-widget-header"><h3 class="sidebar-widget-header">',
			'after_title' => '</h3></span>',
		));

		register_sidebar(array(
			'id' => 'footer-widget',
			'name' => 'Footer Widget Area',
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="footer-widget-header">',
			'after_title' => '</h3>',
		));
	}
}
add_action( 'widgets_init', 'mvp_sidebars_init' );



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
	$main_body_background = get_field('main_body_background', 'option');
	$main_accent_color = get_field('main_accent_color', 'option');
	$main_nav_background = get_field('main_nav_background', 'option');
	$main_menu_text = get_field('main_menu_text', 'option');
	$main_menu_hover_background = get_field('main_menu_hover_background', 'option');
	$main_footer_background = get_field('main_footer_background', 'option');
	$main_footer_text = get_field('main_footer_text', 'option');
	$bloginfo = get_template_directory_uri();
	$primarytheme = get_option('mvp_primary_theme');
	$mainmenu = $main_nav_background;
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
#nav-wrapper {
	background: $main_nav_background !important;
	}
#main-nav .menu > li:hover, #main-nav .menu li ul  {
	background:$main_menu_hover_background url('/wp-content/uploads/down-arrow.png') no-repeat !important;
	color: $main_menu_text;
}
#main-nav .menu > li:hover, #main-nav .menu li ul li:hover {
	background:#cdcdcd;
}
#main-nav .menu > li > a:hover {
	background:$main_menu_hover_background url('/wp-content/uploads/down-arrow.png') no-repeat !important;
	color: $main_menu_text;
	padding: 21px 20px 21px 12px;
	background-position-x: right !important;
	background-position-y: 50% !important;
	background-position: right 7px center !important;
}
#main-nav .menu li:hover ul li a {
	font-family: '$menu_font', sans-serif;
	}
/* clear the content if a is only child */
#main-nav .menu li > a:only-child, #main-nav .menu li a:only-child:hover {
	background-image:none !important;
}
#main-nav .menu > li:hover, #main-nav .menu li ul {
	background-image:none !important;
}
#main-nav .menu li > a:only-child {
	padding: 21px 16px 21px 16px;
}

.pagination span, .pagination a {
	background: #ccc;
	}

input[type='submit'] {background: #f68b1f !important; border:none !important; padding:10px !important; width: auto !important; color:#fff !important; cursor:pointer;}

.pagination .current, .pagination a:hover {
background-color: #999 !important;
}

#footer-wrapper {background: $main_footer_background;}

.home-widget h3.widget-cat,
span.post-tags-header,
.post-tags a:hover,
.tag-cloud a:hover {
	background: $main_accent_color;
	}

#top-story-left h3,
#top-story-right h3 {
	font-size:20px;
	line-height:1.9em;
	color:#333;
	font-weight:700;
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
			case 'comment' :
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

?>