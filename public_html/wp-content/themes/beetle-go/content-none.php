<div class="no-results not-found clear-after">

	<h1 class="page-title"><?php _e( 'Nothing Found', MOKAINE_THEME_NAME ); ?></h1>

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php if ( get_page_template_slug( get_the_ID() ) == 'template-portfolio.php' ) : ?>

				<p><?php printf( __( 'Ready to publish your first portfolio item? <a href="%1$s">Get started here</a>.', MOKAINE_THEME_NAME ), esc_url( admin_url( 'edit.php?post_type=portfolio' ) ) ); ?></p>

			<?php else : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', MOKAINE_THEME_NAME ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php endif; ?>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', MOKAINE_THEME_NAME ); ?></p>

			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', MOKAINE_THEME_NAME ); ?></p>
			
			<?php get_search_form(); ?>

		<?php endif; ?>

</div><!-- no-results -->
