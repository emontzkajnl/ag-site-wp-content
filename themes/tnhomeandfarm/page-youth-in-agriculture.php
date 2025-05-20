<?php 
/*
Template Name: Youth In Agriculture
*/
?>

<?php get_header(); ?>

<main id="primary" class="site-main container">
<header class="page-header">
	<?php if( function_exists('the_ad_placement') ) { 
		the_ad_placement('top-leaderboard');
	} ?>
</header>
<div class="yia-header" style="width:100%; background:none; border-top:#557f40 3px solid; border-bottom:#557f40 3px solid; padding:3em 0; text-align:center; margin-top:3em;">
	<img src="https://tnhomeandfarm.com/wp-content/uploads/2023/02/yia-logo-horizontal-1.svg" alt="Youth In Agriculture" style="width:70%; height:auto;" />
</div>
<div class="wp-block-columns ag-site-sidebar-layout">
	<div class="wp-block-column">
		<div class="entry-content">
		<style> .entry-title {text-align:center;} </style>
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' ); 
			
			the_content();
			?>
			
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="thf-contests__container">
	
								<?php $recent = new WP_Query(array( 'tag' => 'youth-in-ag', 'posts_per_page' => 10 )); 
								if ($recent->have_posts()) : 
								while($recent->have_posts()) : $recent->the_post(); ?>
									<?php $cat = get_the_category(get_the_ID()); ?>
									<div class="col-12 m-col-12  archive-item">
									
									<div class="archive-item__img-container object-fit-image">
									<a href="<?php echo esc_url( get_permalink() ); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
									</a></div>
									<div class="archive-item__text-container">
										<?php echo '<span class="posted-on"><time class="entry-date published updated" datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time></span>';
										echo '<h2><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h2>';
										echo '<p class="archive-item__excerpt">'.get_the_excerpt(  ).'</p>';
										?>
									</div>
									
								</div>
								<?php endwhile; endif; ?>
	
				</div><!-- .row -->
			<?php endwhile; endif; ?>

		</div><!-- .entry-content -->
	</div>
	<div class="wp-block-column">
		<?php get_sidebar('category'); ?>
	</div>

</div>
<div id="ce30b646002d285c3b01c34c4a46fd4e6" style="margin-bottom:2rem;"></div>
</main>
<?php get_footer(); ?>