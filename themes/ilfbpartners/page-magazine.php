<?php
/*
Template Name: Page Digital Magazine
*/
get_header();
?>


<main id="primary" class="site-main container">
<?php if (! is_mobile()): ?>
<!-- /51853864/partners_desktop_leaderboard -->
<div id='div-gpt-ad-1692784329715-0' style='min-width: 728px; min-height: 90px;'>
  <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1692784329715-0'); });
  </script>
</div>
<?php else: ?>
<!-- /51853864/partners_mobile_leaderboard -->
<div id='div-gpt-ad-1692784622292-0' style='min-width: 320px; min-height: 50px;'>
  <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1692784622292-0'); });
  </script>
</div>
<?php endif; ?>
    <div class="row">

    <?php
    $mag_args = array(
        'post_type'         => 'magazine',
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
    );
    $mag_list = new WP_Query($mag_args);
    if ($mag_list->have_posts()): 
    $first = $mag_list->posts[0];
    $first_id = $first->ID;
    $calameo = get_post_meta($first_id, 'calameo_id');
        // echo 'first id: '.$first_id;
    // echo '<pre>';
    // print_r($first);
    // echo '</pre>';
    // while ( have_posts() ) :
        // the_post();
        // get_template_part( 'template-parts/content', get_post_type() );
        echo '<h1 class="entry-title">'.$first->post_title.'</h1>';
        echo '<p>'.$first->post_content.'</p>';
        // $calameo = get_post_meta(get_the_ID(  ), 'calameo_id');
        echo '<div class="col-12 m-col-12 mag-container"><iframe style="margin: 0 auto;" src="//v.calameo.com/?bkcode=' . $calameo[0] . '&amp;page=1" width="100%" height="800" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></div>'; 
        ?>
        

        <?php
        

        ?>
            <h2 class="col-12 m-col-12">Previous Magazines</h2>
            <?php while ($mag_list->have_posts()): $mag_list->the_post();
            get_template_part( 'template-parts/content', 'magazine' );
            endwhile; 
        endif;
         // the_post_navigation(
        // 	array(
        // 		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'ag-sites' ) . '</span> <span class="nav-title">%title</span>',
        // 		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'ag-sites' ) . '</span> <span class="nav-title">%title</span>',
        // 	)
        // );

        // If comments are open or we have at least one comment, load up the comment template.
        // if ( comments_open() || get_comments_number() ) :
        // 	comments_template();
        // endif;

    // endwhile; // End of the loop.
    ?>
    </div>
</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
