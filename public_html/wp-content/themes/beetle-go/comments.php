<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">
			<?php
			printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', MOKAINE_THEME_NAME ),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', MOKAINE_THEME_NAME ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', MOKAINE_THEME_NAME ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', MOKAINE_THEME_NAME ) ); ?></div>
			</nav><!-- comment-nav-above -->

		<?php endif; // check for comment navigation ?>

		<ul class="comment-list plain">
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'avatar_size' => 60,
				'short_ping' => true,
			) );
			?>
		</ul><!-- comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', MOKAINE_THEME_NAME ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', MOKAINE_THEME_NAME ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', MOKAINE_THEME_NAME ) ); ?></div>
			</nav><!-- comment-nav-below -->

		<?php endif; // check for comment navigation ?>

	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>

		<p class="no-comments"><?php _e( 'Comments are closed.', MOKAINE_THEME_NAME ); ?></p>

	<?php endif; ?>

	<?php

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

    comment_form(
    	array(
    		'comment_field' => '<textarea id="comment" class="plain buffer" name="comment" rows="7" placeholder="' . esc_attr( __( 'Please, be kind!', MOKAINE_THEME_NAME ) ) . '" aria-required="true"></textarea>',
    		'fields' => array(
				'author' => '<span class="pre-input"><i class="linecon-icon-user"></i></span><input id="author" class="author" name="author" type="text" placeholder="' . esc_attr( __( 'Your Name', MOKAINE_THEME_NAME ) ) . '" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" ' . $aria_req . '>',
				'email' => '<span class="pre-input"><i class="linecon-icon-email"></i></span><input id="email" class="email" name="email" type="text" placeholder="' . esc_attr( __( 'Your@Email.com', MOKAINE_THEME_NAME ) ) . '" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" ' . $aria_req . '>',
				'url' => '<span class="pre-input"><i class="linecon-icon-globe"></i></span><input id="url" class="url" name="url" type="text" placeholder="' . esc_attr( __( 'Your Website or Profile', MOKAINE_THEME_NAME ) ) . '" value="' . esc_url( $commenter[ 'comment_author_url' ] ) . '">'
			)
    	),
    	$post->ID
    );
    ?>

</div><!-- comments -->