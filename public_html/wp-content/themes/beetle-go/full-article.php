<?php 
$intro_featured = get_post_meta( $post->ID, '_mokaine_set_featured_as_intro', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php mokaine_meta_header(); ?>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php if ( !$intro_featured && has_post_thumbnail() ) : ?>

		<figure class="featured-image">	

			<?php the_post_thumbnail(); ?>		

		</figure>

	<?php endif; ?>

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- entry-content -->

	<div class="entry-footer buffer-top buffer-bottom">

		<?php mokaine_meta_footer(); ?>

		<?php edit_post_link( __( 'Edit', MOKAINE_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

	</div><!-- entry-footer -->

</article>