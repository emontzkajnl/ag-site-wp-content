<?php
/**
 * The template for displaying all single magazine posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ag_Sites
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
		while ( have_posts() ) :
			the_post();
			// get_template_part( 'template-parts/content', get_post_type() );
            echo '<h1 class="entry-title">'.get_the_title(  ).'</h1>';
            echo the_content();
            $calameo = get_post_meta(get_the_ID(  ), 'calameo_id');
            echo '<div class="col-12 m-col-12 mag-container"><iframe style="margin: 0 auto;" src="//v.calameo.com/?bkcode=' . $calameo[0] . '&amp;page=1" width="100%" height="800" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></div>'; 
            ?>
            

            <?php
            $mag_args = array(
                'post_type'         => 'magazine',
                'posts_per_page'    => -1,
                'post_status'       => 'publish',

            );
            $mag_list = new WP_Query($mag_args);

            if ($mag_list->have_posts()): ?>
                <h2 class="col-12 m-col-12">Previous Magazines</h2>
                <?php while ($mag_list->have_posts()): $mag_list->the_post();
                get_template_part( 'template-parts/content', 'magazine' );
                endwhile; 
            endif;


		endwhile; // End of the loop.
		?>
        </div>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
