		</div><!-- main -->

	</main><!-- site-main -->	

	<?php
	global $mokaine;

	$footer = $mokaine['enable-footer'];
	$footer_layout = $mokaine['footer-layout'];
	$footer_b_l = isset( $mokaine['footer-bottom-left'] ) ? $mokaine['footer-bottom-left'] : null;
	$footer_b_r = isset( $mokaine['footer-bottom-right'] ) ? $mokaine['footer-bottom-right'] : null;
	$analytics = isset( $mokaine['google-analytics'] ) ? $mokaine['google-analytics'] : null;
	$customjs = isset( $mokaine['custom-js'] ) ? $mokaine['custom-js'] : null;
	?>

	<?php if ( $footer ) : ?>

		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="row">

				<div class="row-content buffer-left buffer-right clear-after">

					<section id="top-footer" class="buffer-top">

						<?php if ( $footer_layout == "footer-1" ) : ?>

							<div class="column three">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column three">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>

							<div class="column three">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-3' ); ?>

								<?php endif; ?>

							</div>

							<div class="column three last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-4' ); ?>

								<?php endif; ?>

							</div>

						
						<?php elseif ( $footer_layout == "footer-2" ) : ?>
						
							<div class="column six">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column three">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>

							<div class="column three last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-3' ); ?>

								<?php endif; ?>

							</div>
						
						<?php elseif ( $footer_layout == "footer-3" ) : ?>
						
							<div class="column three">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column three">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>

							<div class="column six last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-3' ); ?>

								<?php endif; ?>

							</div>
							
						<?php elseif ( $footer_layout == "footer-4" ) : ?>
							
							<div class="column six">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column six last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>
						
						<?php elseif ( $footer_layout == "footer-5" ) : ?>
						
							<div class="column four">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column four">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>

							<div class="column four last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-3' ); ?>

								<?php endif; ?>

							</div>
						
						<?php elseif ( $footer_layout == "footer-6" ) : ?>
						
							<div class="column eight">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column four last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>
						
						<?php elseif ( $footer_layout == "footer-7" ) : ?>
						
							<div class="column four">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column eight last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>
						
						<?php elseif ( $footer_layout == "footer-8" ) : ?>
						
							<div class="column three">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>

							</div>

							<div class="column six">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-2' ); ?>

								<?php endif; ?>

							</div>

							<div class="column three last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-3' ); ?>

								<?php endif; ?>

							</div>
						
						<?php else : ?>
												
							<div class="column twelve last">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( 'footer-1' ); ?>

								<?php endif; ?>
							
							</div>

						<?php endif; ?>
						
					</section>

					<?php if ( $footer_b_l || $footer_b_r ) : ?>

						<section id="bottom-footer">

						<?php if ( $footer_b_l ) : ?>

							<div class="keep-left"><?php echo do_shortcode( $footer_b_l ); ?></div>
							
						<?php endif; ?>	

						<?php if ( $footer_b_r ) : ?>

							<div class="keep-right"><?php echo do_shortcode( $footer_b_r ); ?></div>
						
						<?php endif; ?>	

						</section><!-- bottom-footer -->

					<?php endif; ?>	

				</div><!-- row-content -->

			</div><!-- row -->

		</footer><!-- #colophon -->

	<?php endif; ?>

<?php
if ( $analytics ) {
	echo $analytics;
}

if ( $customjs ) {
	echo '<script>jQuery(document).ready(function($) {' . $customjs . ' });</script>';
}
?>

<?php wp_footer(); ?>

</body>

</html>