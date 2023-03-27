<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', MOKAINE_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- entry-footer -->

</article>
