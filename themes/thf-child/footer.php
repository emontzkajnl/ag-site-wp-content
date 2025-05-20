		<div id="footer-wrapper">

		<?php if (is_page('youth-in-agriculture')) { ?>
			<div class="yia-bottom-leaderboard" style="margin:30px 0;">
				<?php the_ad_group(3467); ?>
			</div>
		<?php } ?>

		<div style="background:#00465a; width:100%; float:left;">
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
								<!-- Add flickr not supported in theme -->
								<li class="flickr-item">
									<a href="" alt="Flickr" class="flickr-but2" target="_blank"></a>
								</li>
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

					<div class="footer-widget">
						<h3 class="footer-widget-header"><?php echo the_field('footer_widget_middle_title','options'); ?></h3>
						<?php echo the_field('footer_widget_middle_content','options'); ?>
					</div><!--footer-widget-->

					<div class="footer-widget">
						<h3 class="footer-widget-header"><?php echo the_field('footer_widget_right_title','options'); ?></h3>
						<?php echo the_field('footer_widget_right_content','options'); ?>
					</div><!--footer-widget-->

				</div><!--footer-widget-wrapper-->

		</div><!--footer-top-->
		</div><!--footer-background-->
		</div><!--footer-wrapper-->


	</div><!--body-wrapper-->

</div><!--site-->

<?php wp_footer(); ?>
</body>

</html>