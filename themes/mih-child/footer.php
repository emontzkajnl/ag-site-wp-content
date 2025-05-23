		<div id="footer-wrapper">

			<div id="footer-top">

				<div id="footer-nav">

					<?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>

				</div><!--footer-nav-->

				<?php if(get_option('mvp_footer_leader')) { ?>

				<div id="footer-leaderboard">

					<?php $ad970 = get_option('mvp_footer_leader'); if ($ad970) { echo stripslashes($ad970); } ?>

				</div><!--footer-leaderboard-->

				<?php } ?>

				<div id="footer-widget-wrapper">

					<?php $footer_info = get_option('mvp_footer_info'); if ($footer_info == "true") { ?>

					<div class="footer-widget">

						<?php if(get_option('mvp_logo_footer')) { ?>

						<div id="logo-footer">

							<img src="<?php echo get_option('mvp_logo_footer'); ?>" alt="<?php bloginfo( 'name' ); ?>" />

						</div><!--logo-footer-->

						<?php } else { ?>

						<div id="logo-footer">

							<img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-footer.png" alt="<?php bloginfo( 'name' ); ?>" />

						</div><!--logo-footer-->

						<?php } ?>

						<?php echo get_option('mvp_footer_text'); ?>

						<div id="footer-social">

							<ul>

								<?php if(get_option('mvp_facebook')) { ?>

								<li class="fb-item">

									<a href="<?php echo get_option('mvp_facebook'); ?>" alt="Facebook" class="fb-but2" target="_blank"></a>

								</li>

								<?php } ?>

								<?php if(get_option('mvp_twitter')) { ?>

								<li class="twitter-item">

									<a href="<?php echo get_option('mvp_twitter'); ?>" alt="Twitter" class="twitter-but2" target="_blank"></a>

								</li>

								<?php } ?>

								<?php if(get_option('mvp_pinterest')) { ?>

								<li class="pinterest-item">

									<a href="<?php echo get_option('mvp_pinterest'); ?>" alt="Pinterest" class="pinterest-but2" target="_blank"></a>

								</li>

								<?php } ?>

								<?php if(get_option('mvp_google')) { ?>

								<li class="google-item">

									<a href="<?php echo get_option('mvp_google'); ?>" alt="Google Plus" class="google-but2" target="_blank"></a>

								</li>

								<?php } ?>

								<?php if(get_option('mvp_instagram')) { ?>

								<li class="instagram-item">

									<a href="<?php echo get_option('mvp_instagram'); ?>" alt="Instagram" class="instagram-but2" target="_blank"></a>

								</li>

								<?php } ?>

								<?php if(get_option('mvp_youtube')) { ?>

								<li class="youtube-item">

									<a href="<?php echo get_option('mvp_youtube'); ?>" alt="YouTube" class="youtube-but2" target="_blank"></a>

								</li>

								<?php } ?>

								<?php if(get_option('mvp_linkedin')) { ?>

								<li class="linkedin-item">

									<a href="<?php echo get_option('mvp_linkedin'); ?>" alt="Linkedin" class="linkedin-but2" target="_blank"></a>

								</li>

								<?php } ?>

								<?php if(get_option('mvp_rss')) { ?>

								<li><a href="<?php echo get_option('mvp_rss'); ?>" alt="RSS Feed" class="rss-but2"></a></li>

								<?php } else { ?>

								<li><a href="<?php bloginfo('rss_url'); ?>" alt="RSS Feed" class="rss-but2"></a></li>

								<?php } ?>

							</ul>

						</div><!--footer-social-->

						<div id="copyright">

							<p><?php echo get_option('mvp_copyright'); ?></p>

						</div><!--copyright-->

					</div><!--footer-widget-->

					<?php } ?>

					<?php if ( ! dynamic_sidebar( 'footer-widget' ) ) : ?>

					<div class="footer-widget">

						<h3 class="footer-widget-header">Latest News</h3>

						<ul class="home-list">

							<?php $recent = new WP_Query(array('posts_per_page' => '6' )); while($recent->have_posts()) : $recent->the_post();?>

							<li>

								<a href="<?php the_permalink(); ?>" rel="bookmark">

								<div class="home-list-content">

									<h2><?php the_title(); ?></h2>

								</div><!--home-list-content-->

								</a>

							</li>

							<?php endwhile; ?>

						</ul>

					</div><!--footer-widget-->

					<div class="footer-widget">

						<h3 class="footer-widget-header">Tags</h3>

						<div class="tag-cloud">

						<?php wp_tag_cloud(array('smallest' => 12, 'largest' => 12, 'unit' => 'px', 'number' => '30', 'orderby' => 'count', 'order' => 'DESC' )); ?>

						</div>

					</div><!--footer-widget-->

					<?php endif; ?>

 					<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>

					<?php endif; ?>

				</div><!--footer-widget-wrapper-->

					<?php if (is_tablet()) : ?>
						<!-- MIH_LB_728x90 -->
						<div class="ad-outer" style="position:fixed; bottom:0px; z-index:9999; margin:150px auto 0px; width:100%;">
							<div id='div-gpt-ad-1410467031555-1' style='width:728px; height:90px; margin:0px auto;'>
								<script type='text/javascript'>
								googletag.cmd.push(function() { googletag.display('div-gpt-ad-1410467031555-1'); });
								</script>
							</div>
						</div>
					<?php elseif(is_mobile()) : ?>
						<!-- MIH_MB_320x50 -->
						<div class="ad-outer">
							<div id='div-gpt-ad-1426098005402-0' style='width:320px; height:50px; margin: 0px auto;'>
								<script type='text/javascript'>
								googletag.cmd.push(function() { googletag.display('div-gpt-ad-1426098005402-0'); });
								</script>
							</div>
						</div>
					<?php endif; ?>

			</div><!--footer-top-->

		</div><!--footer-wrapper-->

	</div><!--body-wrapper-->

</div><!--site-->

<script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=azkovfxbtss2jj00zi0u9w';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script>

<?php wp_footer(); ?>

</body>

</html>