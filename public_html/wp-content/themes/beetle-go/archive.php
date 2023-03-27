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

					<h1 class="page-title">

						<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Posts published by %s', MOKAINE_THEME_NAME ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Posts published on %s', MOKAINE_THEME_NAME ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Posts published on %s', MOKAINE_THEME_NAME ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', MOKAINE_THEME_NAME ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Posts published on %s', MOKAINE_THEME_NAME ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', MOKAINE_THEME_NAME ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', MOKAINE_THEME_NAME );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', MOKAINE_THEME_NAME );

						else :
							_e( 'Archives', MOKAINE_THEME_NAME );

						endif;
						?>

					</h1>

					<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
					?>

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'listed', is_mokaine_portfolio_post() ? 'item' : 'article' );

					endwhile;

					mokaine_paging_nav();
					?>

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