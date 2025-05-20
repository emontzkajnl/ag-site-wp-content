<?php
/*
Template Name: Page Digital Magazine
*/
?>

<?php get_header(); ?>
<div id="content-wrapper">
<div id="content-main" class="content-full">
<div id="home-main" class="home-full">

<div id="dm-container">
<div id="magazine-content">
<div id="post-area">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						    <header class="article-header">							
							    	<h1 class="story-title"><?php the_title(); ?></h1>
<?php do_action( 'addthis_widget', get_permalink(), get_the_title(), 'above' );?>

						    </header> <!-- end article header -->
					
						    <section class="post-content clearfix" itemprop="articleBody">
							    <?php the_content(); ?>
							</section> <!-- end article section -->

	  <?php wp_reset_query(); ?>
	<div class="mag-grid">
	<h3 class="home-widget-header category-title">Read Past Issues</h3>
	  <?php 
		$args = array( 'post_type' => 'magazine', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			echo '<div class="mag-cover">';
			echo '<a href="';
			the_permalink();
			echo '">';
			the_post_thumbnail( array(180,243) );
			echo '</a>';
			echo '<a href="';
			the_permalink();
			echo '">';
			the_title();
			echo '</a>';
			echo '</div>';
		endwhile;
	  ?>
	</div>

	<div class="clear"></div>




						    <footer class="article-footer">
			
							    <?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
							
						    </footer> <!-- end article footer -->
						    
						    <!-- ?php comments_template(); ? -->
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>		
					
					    <?php else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Oops, Post Not Found!", "shrivity"); ?></h1>
    					    	</header>
    					    	<section class="post-content">
    					    		<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "shrivity"); ?></p>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <p><?php _e("This is the error message in the page.php template.", "shrivity"); ?></p>
    					    	</footer>
    					    </article>
					
					    <?php endif; ?>
</div><!-- end post-area -->
<?php get_sidebar(); ?>
</div><!-- end magazine-content -->
</div><!-- end dm-container -->		
    				</div> <!-- end #main -->
    
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->
			</div> <!-- end #main wrapper -->

<?php get_footer(); ?>