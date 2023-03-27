<?php get_header(); ?>

<?php
$sidebar_page = $mokaine['enable-sidebar-page'];

if ( $sidebar_page ) {
    $post_class = 'nine';
} else {
    $post_class = 'twelve'; 
}
?>

<div class="row">

	<div class="row-content buffer-left buffer-right buffer-bottom clear-after">

		<div class="post-area clear-after">			

			<div class="column <?php esc_attr_e( $post_class ) ?> list-style">

				<?php if ( have_posts() ) : ?>

					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', MOKAINE_THEME_NAME ), '<span>' . get_search_query() . '</span>' ); ?></h1>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'listed', 'search' ); ?>

					<?php endwhile; ?>

					<?php mokaine_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</div><!-- column -->

			<?php if ( $sidebar_page ) : ?>

				<?php get_sidebar(); ?>

			<?php endif; ?>

		</div><!-- post-area -->

	</div><!-- row-content -->

</div><!-- row -->

<?php get_footer(); ?>