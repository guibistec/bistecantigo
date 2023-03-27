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

	<div class="row-content buffer-left buffer-right buffer-bottom">

		<div class="post-area clear-after">

			<div class="column <?php esc_attr_e( $post_class ) ?> list-style">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- column -->

			<?php if ( $sidebar_page ) : ?>

				<?php get_sidebar(); ?>

			<?php endif; ?>

		</div><!-- post-area -->

	</div><!-- row-content -->

</div><!-- row -->

<?php get_footer(); ?>