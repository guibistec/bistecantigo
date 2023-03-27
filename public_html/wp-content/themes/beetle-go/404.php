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

				<section class="no-results not-found clear-after">

					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', MOKAINE_THEME_NAME ); ?></h1>

					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', MOKAINE_THEME_NAME ); ?></p>

					<?php get_search_form(); ?>

				</section><!-- error-404 -->

			</div><!-- column -->					

			<?php if ( $sidebar_page ) : ?>

				<?php get_sidebar(); ?>

			<?php endif; ?>

		</div><!-- post-area -->

	</div><!-- row-content -->

</div><!-- row -->

<?php get_footer(); ?>