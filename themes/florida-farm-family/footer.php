<?php
/**
 * Footer
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

if ( visualcomposerstarter_is_the_footer_displayed() ) : ?>
	<?php visualcomposerstarter_hook_before_footer(); ?>
<!-- 
	<div id="prefooter" class="container-fluid">
		<div class="row">
			<div class="col-md-8 flexcontainer">
				<h3>
					Stay up to date with Florida Farm &amp; Family
				</h3>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-primary">subscribe to the newsletter</button>
			</div>
		</div>
	</div>
 -->
	<footer id="footer">
		<?php
		if ( get_theme_mod( 'vct_footer_area_widget_area', false ) ) :
			$footer_columns = get_theme_mod( 'vct_footer_area_widgetized_columns', 1 );
			$footer_columns_width = 12 / $footer_columns;
			?>
			<div class="footer-widget-area">
				<div class="<?php echo esc_attr( visualcomposerstarter_get_content_container_class() ); ?>">
					<div class="row">
						<div class="col-md-<?php echo esc_attr( $footer_columns_width ); ?> moreGutter">
							<?php if ( is_active_sidebar( 'footer' ) ) : ?>
								<?php dynamic_sidebar( 'footer' ); ?>
							<?php endif; ?>
						</div>
						<?php for ( $i = 2; $i <= $footer_columns; $i ++ ) : ?>
							<div class="col-md-<?php echo esc_attr( $footer_columns_width ); ?> moreGutter">
								<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
									<?php dynamic_sidebar( 'footer-' . $i ); ?>
								<?php endif; ?>
							</div>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="footer-bottom">
			<div class="<?php echo esc_attr( visualcomposerstarter_get_content_container_class() ); ?>">
				<?php if ( get_theme_mod( 'vct_footer_area_social_icons', false ) ) : ?>
				<?php endif; ?>
					<p class="copyright">
						<?php /* translators: 1. date, 2. blog name */
						printf( esc_html__( 'Copyright &copy; %1$s %2$s', 'visual-composer-starter' ), esc_html( date( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) ); ?>
						<?php /* translators: 1. link opening tag, 2. link opening tag, 3. link closing tag */
						printf( esc_html__( '  |  Journal Communications, Inc. All rights reserved.', 'visual-composer-starter' ), '<a href="http://visualcomposer.com/?utm_campaign=vc-theme&utm_source=vc-theme-front&utm_medium=vc-theme-footer" target="_blank">', '<a href="https://wordpress.org" target="_blank">', '</a>' ); ?>
					</p>
					<?php if ( has_nav_menu( 'secondary' ) ) : ?>
						<div class="footer-menu">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'secondary',
							) );
							?>
						</div>
					<?php endif; ?>
				<?php do_action( 'visualcomposerstarter_after_footer_copyright' ); ?>
			</div>
		</div>
	</footer>
	<?php visualcomposerstarter_hook_after_footer(); ?>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
