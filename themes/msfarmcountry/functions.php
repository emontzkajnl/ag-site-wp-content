<?php 
function mfc_scripts() {
    wp_enqueue_style('parent-theme', get_template_directory_uri().'/style.css');
    wp_enqueue_script( 'main-mfc', get_stylesheet_directory_uri(  ).'/assets/js/main.js' , array('jquery'), NULL, true);
}
add_action('wp_enqueue_scripts', 'mfc_scripts');

function mfc_theme_setup() {
    add_image_size('stm-gm-760-376', 760, 376, true);
    add_image_size('stm-gm-635-345', 635, 345, true);
    add_image_size('stm-gm-350-195', 350, 195, true);
    register_nav_menus(
		array(
			'primary'   => __( 'Top primary menu', 'ag-sites' ),
			'top_bar'   => __( 'Top bar menu', 'ag-sites' ),
			'top_bar_22'   => __( 'Top bar menu 2022', 'ag-sites' ),
			'bottom_menu'   => __( 'Bottom menu', 'ag-sites' ),
		)
	);
}

add_action('after_setup_theme', 'mfc_theme_setup');


function mfc_register_widget() {
    register_widget( 'mfc_left_footer' );
    }
    add_action( 'widgets_init', 'mfc_register_widget' );
    class mfc_left_footer extends WP_Widget {
    function __construct() {
    parent::__construct(
    // widget ID
    'mfc_left_footer',
    // widget name
    __('Hostinger Sample Widget', ' mfc_widget_domain'),
    // widget description
    array( 'description' => __( 'Hostinger Widget Tutorial', 'mfc_widget_domain' ), )
    );
    }
    public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    echo $args['before_widget'];
    //if title is present
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
    //output
    echo __( 'Greetings from Hostinger.com!', 'mfc_widget_domain' );
    echo $args['after_widget'];
    }
    public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) )
    $title = $instance[ 'title' ];
    else
    $title = __( 'Default Title', 'mfc_widget_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
    }
    public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
    }
    }

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


    function mfc_load_more_cats() {
        // error_log(var_dump($_POST, true));
        $args = array(
            'post_type'			=> 'post',
            // 'cat'				=> $_POST['cat'],
            'posts_per_page'	=> 10,
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
            while($cat_query->have_posts()): $cat_query->the_post(); ?>
	<div class="col-12 m-col-12">
		<div class="row mfc-archive">
			<div class="col-12 l-col-4">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<div class="two-thirds-container">
			<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
			</div></a>
			</div>
			<div class="col-12 l-col-8 mfc-archive__text-area">
			<?php 
            $cat = get_the_category(get_the_ID());
			echo '<p class="mfc-cat-title "><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
			echo '<h3 class="mfc-archive__title"><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h3>';
			echo '<p class="mfc-archive__excerpt">'.get_the_excerpt(  ).'</p>'; ?>
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
    add_action('wp_ajax_mfcloadMoreCats', 'mfc_load_more_cats');
    add_action('wp_ajax_nopriv_mfcloadMoreCats', 'mfc_load_more_cats');

    function mfc_load_more_posts() {
        $args = array(
            'post_type'			=> 'post',
            'paged'             => 1,
            'posts_per_page'	=> 6,
            'post_status'       => 'publish',
            'paged'				=> $_POST['page']
        );
        $post_query = new WP_Query($args);
        if($post_query->have_posts()): 
            echo '<div class="row">';
            while($post_query->have_posts()): $post_query->the_post();
            $cat = get_the_category(); 
            $cat = $cat[0];  ?>
            <div class="col-12 m-col-6 mfcrp__item">
                <div class="mfcrp__img">
                    <a href="<?php echo get_the_permalink(); ?>">
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
                    </a>
                </div>
                <?php if ($cat) {
                    echo '<div class="mfc-cat-title"><a href="'.get_category_link( $cat ).'">'.$cat->name.'</a></div>';
                } ?>
                <h3 class="mfcrp__title"><a class="title-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
            </div>
            <?php endwhile;
            echo '</div>'; //row
        endif;
        wp_reset_postdata(  );
        wp_die( );
    }

    add_action('wp_ajax_mfcloadMorePosts', 'mfc_load_more_posts');
    add_action('wp_ajax_nopriv_mfcloadMorePosts', 'mfc_load_more_posts');

    function mfc_comments($comment, $args, $depth) {
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
