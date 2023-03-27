<?php get_header(); ?>

<?php
global $mokaine;

$portfolio_navigator = $mokaine['enable-portfolio-navigator'];
$sidebar_portfolio_post = get_post_meta( $post->ID, '_mokaine_sidebar_portfolio_post', true );
$portfolio_related = $mokaine['enable-portfolio-related-items'];

// Set item class
$post_class = 'twelve';

if ( $sidebar_portfolio_post ) {
	$post_class = 'nine';
} else {
	$post_class = 'twelve';	
}	

if ( $portfolio_navigator ) {
	$row_extra_class = ' post-navigator';
} else {
	$row_extra_class = ' no-post-navigator';
}
?>

<div class="row<?php esc_attr_e( $row_extra_class ) ?>">

	<div class="row-content buffer-left buffer-right buffer-bottom clear-after">

		<?php if ( $portfolio_navigator ) : ?>

			<?php mokaine_single_post_nav(); ?>

		<?php endif; ?>		

		<div class="post-area clear-after">

			<div class="column <?php esc_attr_e( $post_class ) ?>">

				<?php while ( have_posts() ) : the_post(); ?>			

					<?php get_template_part( 'full', 'item' ); ?>

				<?php endwhile; ?>

				<?php if ( $portfolio_related ) : ?>

					<div class="related clear-after">

						<?php
						$tags = wp_get_post_terms( $post->ID, 'project-tags', array( 'fields' => 'slugs' ) );

						if ( $tags ) {
							$args = array(
								'post_type' => get_post_type(),
								'tax_query' => array(
									array(
										'taxonomy' => 'project-tags',
										'field' => 'slug',
										'terms' => $tags
									)
								),
								'post__not_in' => array( $post->ID ),
								'showposts' => 3,
								'meta_key' => '_thumbnail_id',  // only items with featured image
								'orderby' => 'rand'								
							);

						$related_posts_query = new wp_query( $args );
						?>

							<?php if( $related_posts_query->have_posts() ) : ?>

								<h4><?php _e( 'Related Posts', MOKAINE_THEME_NAME ); ?></h4>

								<?php while ( $related_posts_query->have_posts() ) : ?>

									<?php $related_posts_query->the_post(); ?>

									<div class="item">

										<figure>

											<?php echo resized_thumbnail( 640, 640, true, false, true ); ?>

										</figure>

										<a class="overlay" href="<?php the_permalink(); ?>">

											<div class="overlay-content">

												<div class="post-type"><i class="linecon-icon-search"></i></div>

												<h2><?php echo get_the_title(); ?></h2>

											</div>

										</a>

									</div>

								<?php endwhile; ?>

							<?php endif; ?>
														
							<?php wp_reset_query(); ?>

						<?php } ?>

					</div>

				<?php endif; ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
				?>

			</div><!-- column -->

			<?php if ( $sidebar_portfolio_post ) : ?>

				<aside role="complementary" class="sidebar column three last">

					<?php
					// Portfolio widgets
					$widgets = $mokaine['portfolio-widgets'];
					?>

					<?php if ( $widgets ) : ?>

					    <?php $widget_fields = array(); ?>

					    <?php foreach ( $widgets as $widget ) : ?>

					        <?php
					        $widget_slug = '_' . strtolower( trim( preg_replace('/[^A-Za-z0-9-]+/', '_', $widget ) ) );
					        $widget_meta = get_post_meta( $post->ID, '_mokaine_portfolio_widgets' . $widget_slug, true );
					        ?>

					        <?php if ( $widget_meta != '' ) : ?>

								<aside class="widget">

									<h4 class="widget-title"><?php echo $widget; ?></h4>

									<?php echo do_shortcode( $widget_meta ); ?>

								</aside>

					    	<?php endif; ?>

						<?php endforeach; ?>

					<?php endif; ?>

				</aside><!-- sidebar -->

			<?php endif; ?>


		</div><!-- post-area -->

	</div><!-- row-content -->

</div><!-- row -->

<?php get_footer(); ?>