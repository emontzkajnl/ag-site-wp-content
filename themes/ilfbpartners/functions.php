<?php
function ilfb_scripts() {
    wp_enqueue_style('parent-theme', get_template_directory_uri().'/style.css');

}
add_action('wp_enqueue_scripts', 'ilfb_scripts');


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

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function ilfb_customizer_styles() {
    ?>
    <style type="text/css">
    .main-navigation ul li a {color: <?php echo get_option('primary_color_display'); ?>; font-family: <?php echo  get_theme_mod('sans_serif_font'); ?>;}
    .social-cube, .reply a, .comment-form input[type="submit"] {background-color: <?php echo get_option('primary_color_display'); ?>;}
    .comment-list li {border-left: 2px solid <?php echo get_option('primary_color_display'); ?>;}
    .reply a, .cat-text {font-family: <?php echo  get_theme_mod('sans_serif_font'); ?>;}
    .site-footer .header-social li a {color: <?php echo get_option('footer_background_display'); ?>;}
    </style>
<?php }

add_action('wp_head', 'ilfb_customizer_styles');

function add_bugherd() { ?>
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=teuegp8jpfr4o7pmcgn2dw" async="true"></script>
<?php }

if ( is_user_logged_in() ) {
    add_action( 'wp_head', 'add_bugherd');
}

function mycustom_comment_form_title_reply( $defaults ) {  
    $defaults['title_reply'] = __( 'Leave a Comment' );  
    return $defaults;
    }
add_filter( 'comment_form_defaults', 'mycustom_comment_form_title_reply' );

// Previous parent theme images sizes (Braxton)
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 660, 400, true );
    add_image_size( 'post-thumb', 660, 400, true );
    add_image_size( 'medium-thumb', 400, 242, true );
    add_image_size( 'small-thumb', 270, 164, true );
}

// shortcode ui is no longer supported, create shortcode here:

function infobox_func($atts, $content = null ) {
    $ib = shortcode_atts( array(
        'alignment'     => '',
        'title'         => ''
    ), $atts);
    $html = '<div class="infobox '.$ib['alignment'].'">';
    $html .= '<span class="infobox-header"><h3>'.$ib['title'].'</h3></span>';
    $html .= '<div class="infobox-content">'.$content.'</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'infobox', 'infobox_func' );

function add_comment_fields($fields) {
    unset($fields['url']);
    $fields['zip'] = '<p class="comment-form-zip"><label for="zip">' . __( 'Zip Code (internal use only)' ) . '</label>' .
        '<input id="zip" name="zip" type="text" size="30" /></p>';
    return $fields;
}
add_filter('comment_form_default_fields','add_comment_fields');

function my_theme_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}
 
	return $title;
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

function capital_meta_title( $title ) {
    $title = ucwords( $title );
    return $title;
}

add_filter( 'wpseo_title', 'capital_meta_title' );

function remove_mag_from_search_results($query) {
    if ($query->is_main_query() && $query->is_search() ) {
        $query->set('post_type', array('post'));
    }
    return $query;
}
add_action( 'pre_get_posts', 'remove_mag_from_search_results');

//Insert ads after third paragraph of single post content.
add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
	if (get_post_type() == '') {return $content;}
	// ob_start();
	// if( function_exists('the_ad_placement') ) { the_ad_placement('in-content'); }
	// $ad_code = ob_get_contents();
	$ad_code = '<div class="advertisement">Advertisement</div>';
	$ad_code .= '<div style="width: 100%; text-align: center;"><div id="div-gpt-ad-1694457127306-0" style="min-width: 300px; min-height: 250px; display: inline-block;">';
	$ad_code .= '<script>googletag.cmd.push(function() { googletag.display("div-gpt-ad-1694457127306-0"); });</script></div></div>';
	// ob_end_clean();
	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $ad_code, 5, $content );
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
	$has_infobox = false;
	foreach ($paragraphs as $index => $paragraph) {

		// if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
			// $paragraphs[$index] .= 'index is'.$index;
			if (str_contains( $paragraphs[$index], 'infobox') && $index < $paragraph_id) {
				$paragraphs[$index - 1] .= $insertion;
				$has_infobox = true;
			}
			if (!$has_infobox && $index == $paragraph_id) {
				$paragraphs[$index] .= $insertion;
			}
		// }

		// if ( $paragraph_id == $index ) {
		// 	$paragraphs[$index] .= $insertion;
		// }
	}
	
	return implode( '', $paragraphs );
}