<?php
// Image Sizes //
add_image_size( 'curated-image', 1166, 776, true );
add_image_size( 'curated-image-vertical', 814, 1084, true );

// Add Button to Text Editor
include "fb-infobox.php";

// Redirection plugin roles
add_filter( 'redirection_role', function( $role ) {
  return 'edit_posts';  // Add your chosen capability or role here
} );

// Top Parent
function pa_category_top_parent_id ($catid) {
 while ($catid) {
  $cat = get_category($catid); // get the object for the catid
  $catid = $cat->category_parent; // assign parent ID (if exists) to $catid
  // the while loop will continue while there is a $catid
  // when there is no longer a parent $catid will be NULL so we can assign our $catParent
  $catParent = $cat->cat_ID;
 }
return $catParent;
}

// FFM Ad Widget
class ffm_ad_widget extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'ffm_ad_widget', 
  
// Widget name will appear in UI
__('FFM Ad Widget', 'ffm_ad_widget_domain'), 
// Widget description
array( 'description' => __( 'Add an Ad', 'ffm_ad_widget_domain' ), ) 
);
}
// Front End
public function widget( $args, $instance ) {
// $title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
// if ( ! empty( $title ) )
// echo $args['before_title'] . $title . $args['after_title'];
// This is where you run the code and display the output
$ffmad = '
<div class="ffm-med-rec" style="margin:0 auto 30px;">
	<div class="ad-header">Advertisement</div>
	<div id="div-gpt-ad-1607722108783-0" class="adspace-top-leaderboard" style="text-align:center;">';
	if( function_exists('the_ad_placement') ) { the_ad_placement('right-rail'); }
$ffmod .= '	
	</div>
</div>';
echo __( $ffmad, 'ffm_ad_widget_domain' );
echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'ffm_ad_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
// Class wpb_widget ends here
} 
// Register and load the widget
function ffm_ad_load_widget() {
    register_widget( 'ffm_ad_widget' );
}
add_action( 'widgets_init', 'ffm_ad_load_widget' );

// FFM Magazine Widget
class ffm_mag_widget extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'ffm_mag_widget', 
  
// Widget name will appear in UI
__('FFM Magazine Widget', 'ffm_mag_widget_domain'), 
// Widget description
array( 'description' => __( 'Add the current Magazine', 'ffm_mag_widget_domain' ), ) 
);
}
// Front End
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
// This is where you run the code and display the output
echo __( 'FFM Magazine', 'ffm_mag_widget_domain' );
echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'ffm_mag_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
// Class wpb_widget ends here
} 
// Register and load the widget
function ffm_mag_load_widget() {
    register_widget( 'ffm_mag_widget' );
}
add_action( 'widgets_init', 'ffm_mag_load_widget' );

//Insert ads after second paragraph of single post content.
add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
	$ad_code = '<div style="100%; text-align:center;">' . do_shortcode('[in-content-ad-narrow]') . '</div>';
	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $ad_code, 4, $content );
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

/**
* Registers an editor stylesheet for the theme.
*/
function wpdocs_theme_add_editor_styles() {
add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

add_filter( 'redirection_role', function( $role ) {
	return 'edit_posts';  // Add your chosen capability or role here
} );


