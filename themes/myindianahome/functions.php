<?php 

function mih_scripts() {
    wp_enqueue_style('parent-theme', get_template_directory_uri().'/style.css');
    wp_enqueue_script( 'mih-main', get_stylesheet_directory_uri().'/assets/js/main.js', 'jQuery', null, true );
	wp_localize_script( 'mih-main', 'params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'currentpage'	=> 1,
		'currentRecentPage'	=> 1,
		'currentRecipePage'	=> 1
	) );
}
add_action('wp_enqueue_scripts', 'mih_scripts');

if ( ! function_exists( 'mih_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function mih_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'ag-sites' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline unstyle-link"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

function  load_more_mih_cats() {
	$args = array(
		'post_type'			=> 'post',
		'posts_per_page'	=> 8,
		'post_status'       => 'publish',
		'paged'				=> $_POST['page']
	);
	if ($_POST['cat']) {
		$args['cat'] = $_POST['cat'];
	} else { // this is a tag page
		$args['tag'] = $_POST['tag'];
	}
	$cat_query = new WP_Query($args);
	if($cat_query->have_posts()): 
		// echo '<h2>max pages is '.$cat_query->max_num_pages.'</h2>';
		echo '<div class="row">';
		while($cat_query->have_posts()): $cat_query->the_post(); 
		$cat = get_the_category(get_the_ID()); 
		$primary_cat = get_post_meta(get_the_ID() ,'_yoast_wpseo_primary_category', TRUE ); 
		$cat_name = $primary_cat ? get_the_category_by_ID($primary_cat) : $cat[0]->name; ?>
		<div class="col-12 l-col-6">
			<div class="mih-archive__container ">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php echo the_post_thumbnail(get_the_ID(), 'medium-large'); ?></a>
		<div class="mih-archive__text-container">
			<p class="mih-archive__cat"><?php echo $cat_name; ?></p>
			<h3 class="mih-archive__title"><a class="unstyle-link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
			<p class="mih-archive__excerpt"><?php echo get_the_excerpt(  ); ?></p>
		</div><!-- mih-archive__text-container -->
		</div><!-- mih-archive__container -->
		</div><!-- col-12 -->

		<?php endwhile;
		echo '</div>'; // .row
	endif;
	wp_reset_postdata(  );
	// wp_reset_query();
	wp_die( );
}

add_action('wp_ajax_loadMoreMihCats', 'load_more_mih_cats');
add_action('wp_ajax_nopriv_loadMoreMihCats', 'load_more_mih_cats');

function load_more_recipes() {
	$args = array(
		'paged'             => $_POST['page'],
		'posts_per_page'    => 4,
		'post_type'         => 'post',
		'category_name'     => 'recipes',
		'post_status'       => 'publish'
	);
	$recipe_query = new WP_Query($args);
	if ($recipe_query->have_posts()):
		echo '<div class="row">';
		while ($recipe_query->have_posts()):
    $recipe_query->the_post(); ?>
    <div class="col-12 l-col-3 m-col-6">
    <div class="mih-directories__panel">
        <div class="mih-directories__img-container">
        <?php echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail($ID, 'full').'</a>'; ?>
        </div>
        <div class="mih-directories__text-container">
            <div class="mih-directories__title">
                <h3><a href="<?php echo get_the_permalink(); ?> " class="unstyle-link"><?php echo get_the_title(); ?></a></h3>
            </div>
        </div>
    </div>
    </div>
    <?php endwhile;
    echo '</div>'; 
		endif;
		wp_reset_postdata(  );
		wp_die( );
}

add_action('wp_ajax_loadMoreRecipes', 'load_more_recipes');
add_action('wp_ajax_nopriv_loadMoreRecipes', 'load_more_recipes');

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

// alignment title 

function infobox_shortcode($atts, $content = null) {
	$a = shortcode_atts( array(
		'alignment'		=> '',
		'title'			=> ''
	), $atts);
	$output = do_shortcode($content);
	$html = '<div class="infobox '.$a['alignment'].'">';
	$html .= $a['title'] ? '<span class="infobox-header"><h3>'.$a['title'].'</h3></span>' : '';
	$html .= '<div class="infobox-content">'.$output.'</div></div>';
	return $html; 
	
}
add_shortcode( 'infobox', 'infobox_shortcode' );

function mih_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mih_excerpt_length', 999);

//Insert ads after third paragraph of single post content.
add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
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

