<?php get_header(); ?>

<?php
global $mokaine, $more;
$sidebar_blog_page = $mokaine['enable-sidebar-blog-page'];

if ( $sidebar_blog_page ) {
    $post_class = 'nine';
} else {
    $post_class = 'twelve'; 
}
?>

<div class="row">

	<div class="row-content buffer-left buffer-right buffer-bottom clear-after">

		<div class="post-area list-style clear-after">

			<div class="column <?php esc_attr_e( $post_class ) ?>">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'listed', 'article' ); ?>

					<?php endwhile; ?>

					<?php mokaine_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</div><!-- column -->

			<?php if ( $sidebar_blog_page ) : ?>

				<?php get_sidebar(); ?>

			<?php endif; ?>

		</div><!-- post-area -->

	</div><!-- row-content -->

</div><!-- row -->


<?php get_footer(); ?>