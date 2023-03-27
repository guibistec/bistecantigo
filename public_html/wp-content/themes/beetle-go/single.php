<?php get_header(); ?>

<?php
global $mokaine;

$blog_navigator = $mokaine['enable-blog-navigator'];
$sidebar_blog_post = $mokaine['enable-sidebar-blog-post'];
$author_bio = $mokaine['enable-author-bio'];
$blog_related = $mokaine['enable-blog-related-posts'];

// Set article class
$post_class = 'twelve';

if ( $sidebar_blog_post ) {
	$post_class = 'nine';
} else {
	$post_class = 'twelve';	
}

if ( $blog_navigator ) {
	$row_extra_class = ' post-navigator';
} else {
	$row_extra_class = ' no-post-navigator';
}
?>

<div class="row<?php esc_attr_e( $row_extra_class ) ?>">

	<div class="row-content buffer-left buffer-right buffer-bottom clear-after">

		<?php if ( $blog_navigator ) : ?>

			<?php mokaine_single_post_nav(); ?>

		<?php endif; ?>

		<div class="post-area clear-after">

			<div class="column <?php esc_attr_e( $post_class ) ?>">

				<?php while ( have_posts() ) : the_post(); ?>			

					<?php get_template_part( 'full', 'article' ); ?>

				<?php endwhile; ?>

				<?php if ( $author_bio ) : ?>

					<div id="author-bio">

						<?php
						if ( function_exists( 'get_avatar' ) ) {
							echo get_avatar( get_the_author_meta( 'email' ), 80 ); 
						}
						?>

						<div id="author-info">
							<h3><?php _e( 'About', MOKAINE_THEME_NAME ); ?> <?php the_author_link(); ?></h3>
							<p><?php the_author_meta( 'description' ); ?></p>
						</div>
												
					</div>

				<?php endif; ?>

				<?php if ( $blog_related ) : ?>

					<?php
					$categories = get_the_category( $post->ID );

					if ( $categories ) :

						$category_ids = array();

						foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;
				
						$args = array(
							'category__in' => $category_ids,
							'post__not_in' => array( $post->ID ),
							'showposts' => 3, // number of related posts that will be shown
							'meta_key' => '_thumbnail_id',  // only posts with featured image
							'orderby' => 'rand'
						);

					endif;

					$related_posts_query = new wp_query( $args );
					?>

					<?php if( $related_posts_query->have_posts() ) : ?>

						<div class="related clear-after">

							<h4><?php _e( 'Related Articles', MOKAINE_THEME_NAME ); ?></h4>

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

						</div>

					<?php endif; ?>
												
					<?php wp_reset_query(); ?>

				<?php endif; ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
				?>

			</div><!-- column -->

			<?php if ( $sidebar_blog_post ) : ?>

				<?php get_sidebar(); ?>

			<?php endif; ?>

		</div><!-- post-area -->

	</div><!-- row-content -->

</div><!-- row -->

<?php get_footer(); ?>