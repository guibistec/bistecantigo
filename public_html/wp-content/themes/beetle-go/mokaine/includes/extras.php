<?php
/**
 * Extra functions
 */

/* Enable/disable SVG images support https://wordpress.org/support/topic/add-code-to-htaccess-through-theme-activation */
function enable_svg_support( $oldname, $oldtheme = false ) {
  require_once( ABSPATH . '/wp-admin/includes/file.php' );
  require_once( ABSPATH . '/wp-admin/includes/misc.php' );
  $rules = array();
  $rules[] = 'AddType image/svg+xml svg';
  $rules[] = 'AddType image/svg+xml svgz';
  $rules[] = 'AddEncoding x-gzip .svgz';

  $htaccess_file = ABSPATH . '.htaccess';
  insert_with_markers( $htaccess_file, 'Svg images support', ( array ) $rules );
}

function disable_svg_support( $newname, $newtheme ) {
  require_once( ABSPATH . '/wp-admin/includes/file.php' );
  require_once( ABSPATH . '/wp-admin/includes/misc.php' );
  $htaccess_file = ABSPATH . '.htaccess';
  insert_with_markers( $htaccess_file, 'Svg images support', '' );
}

add_action( 'after_switch_theme', 'enable_svg_support', 10 , 2 ); // Theme activation
add_action( 'switch_theme', 'disable_svg_support', 10 , 2 ); // Theme deactivation

/* Display navigation to next/previous set of posts when applicable */
function mokaine_paging_nav() {
	// Don't print empty markup if there's only one page
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', MOKAINE_THEME_NAME ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<i class="icon-chevron-left"></i><span class="label">Older posts</span>', MOKAINE_THEME_NAME ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( '<span class="label">Newer posts</span><i class="icon-chevron-right"></i>', MOKAINE_THEME_NAME ) ); ?></div>
			<?php endif; ?>

		</div><!-- nav-links -->
	</nav><!-- navigation -->
	<?php
}

/* Display navigation to next/previous post on single posts when applicable */
function mokaine_single_post_nav() {
	// Don't print empty markup if there's nowhere to navigate
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( is_mokaine_portfolio_post() ) {

		$back = get_permalink( get_mokaine_portfolio_post_page( get_the_ID() ) );

	} else {

		// get parent page with blog list
		if ( get_option( 'show_on_front' ) == 'page' && get_option( 'page_for_posts' ) ) { // if in Settings -> Reading -> A static page & in Posts page a page has been selected
			$back = get_permalink( get_option( 'page_for_posts' ) );
		}
		else {
			$back = esc_url( home_url() );
		}

	}
	
	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<div id="post-nav">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', MOKAINE_THEME_NAME ); ?></h1>
		<div class="nav-links">
			<ul class="clear-after reset plain">
				<li id="prev-items" class="post-nav sides">
					<?php previous_post_link( '%link',  _x( '<i class="icon-chevron-left"></i><span class="label">%title</span><span class="label label-mobile">Prev</span>', 'Previous post link', MOKAINE_THEME_NAME ) ); ?>
				</li>
				<li id="all-items" class="post-nav mid">
					<?php echo '<a href="' . esc_url( $back ) . '"><i class="linecon-icon-images"></i></a>'; ?>
				</li>
				<li id="next-items" class="post-nav sides">
					<?php next_post_link( '%link', _x( '<span class="label">%title</span><span class="label label-mobile">Next</span><i class="icon-chevron-right"></i>', 'Next post link', MOKAINE_THEME_NAME ) ); ?>				
				</li>								
			</ul>
		</div><!-- nav-links -->
	</div><!-- post-nav -->
	<?php
}

/* Prints HTML with meta information for the current category and post-date/time */
function mokaine_meta_header() {

	$category_list = get_the_category_list( __( ', ', MOKAINE_THEME_NAME ) );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', MOKAINE_THEME_NAME ),
		$time_string
	);

	if ( ! mokaine_categorized_blog() ) :

		echo '<h5 class="meta-post"><span class="posted-on">' . $posted_on . '</span></h5>';

	else :

		if ( is_single() ) :

			echo '<h5 class="meta-post"><span class="posted-in"> ' . $category_list . '</span> &ndash; <span class="posted-on">' . $posted_on . '</span></h5>';

		else :

			echo '<h5 class="meta-post"><span class="posted-in"> ' . $category_list . '</span></h5>';

		endif;

	endif;

}

/* Prints HTML with meta information on masonry blog pages */
function mokaine_meta_header_big_masonry_post() {

	$categories = get_the_category();
	$separator = ', ';
	$output = '';

	if( $categories ) {

	    foreach( $categories as $category ) {
	        $output .= $category->cat_name . $separator;
	    }

		echo '<h5 class="meta-post"><span class="posted-in"> ' . trim( $output, $separator ) . '</span></h5>';

	}

}

/* Prints HTML with meta information for the current portfolio category */
function mokaine_meta_header_portfolio() {

	// Get item category                   
	$terms = get_the_terms( get_the_ID(), 'project-tags' );

	$list_terms = NULL;

	if ( ! empty( $terms ) ) {

	    foreach ( $terms as $term ) {

	        $list_terms[] .= $term->name;

	    }

	    $joined_terms = join( ", ", $list_terms );

	    echo '<h5 class="meta-post"><span class="posted-in"> ' . $joined_terms . '</span></h5>';

	}

}

/* Prints HTML with meta information for the current author and tags */
function mokaine_meta_footer() {

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', __( ', ', MOKAINE_THEME_NAME ) );

	if ( '' != $tag_list ) {
		$meta_text = __( 'This article was tagged %1$s.', MOKAINE_THEME_NAME );
	}

	printf(
		$meta_text,
		$tag_list
	);

}

/* Returns true if a blog has more than 1 category */
function mokaine_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mokaine_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mokaine_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mokaine_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mokaine_categorized_blog should return false.
		return false;
	}
}

/* Flush out the transients used in mokaine_categorized_blog */
function mokaine_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'mokaine_categories' );
}
add_action( 'edit_category', 'mokaine_category_transient_flusher' );
add_action( 'save_post', 'mokaine_category_transient_flusher' );

/* Return Post Formats icons */
function mokaine_icons() {
	if ( get_post_format() == 'image' ) {
	    echo 'picture';
	}
	else if ( get_post_format() == 'gallery' ) {
	    echo 'gallery';
	}
	else if ( get_post_format() == 'video' ) {
	    echo 'video';
	}
	else if ( get_post_format() == 'audio' ) {
	    echo 'speaker-on';
	}
	else {
	    echo 'doc';    
	}
}

/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link */
function mokaine_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mokaine_page_menu_args' );

/* Adds custom classes to the array of body classes */
function mokaine_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'mokaine_body_classes' );

/* Filters wp_title to print a neat <title> tag based on what is being viewed */
function mokaine_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', MOKAINE_THEME_NAME ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'mokaine_wp_title', 10, 2 );

/* Sets the authordata global when viewing an author archive */
function mokaine_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'mokaine_setup_author' );


/* Image resizer function */
function resized_thumbnail( $width, $height, $crop, $single, $upscale ) {

	global $post;

	$output = null;

	$thumb = get_post_thumbnail_id( $post->ID );
	$img_url = wp_get_attachment_url( $thumb, 'full' ); //get full URL to image (use "large" or "medium" if the images too big)
	$img_alt = get_post_meta( $thumb, '_wp_attachment_image_alt', true );
	$img_alt_data = ( $img_alt != '' ) ? $img_alt : get_the_title();
	$image = aq_resize( $img_url, $width, $height, true, false, true ); //resize & crop the image

	$output = '<img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" class="attachment-thumb-' . $image[1] . '-' . $image[2] . ' wp-post-image" alt="' . $img_alt_data . '">';

	return $output;

}

/* Add shortcode functionality to widgets */
add_filter( 'widget_text', 'do_shortcode' );

/* Go Pro Info Box */
function gopro_edit_form_advanced() {
    echo '<div class="go-pro-panel postbox"><div class="thebox inside"><h3>Supercharge Beetle Go with new features!</h3><div class="pro-message"><strong>Beetle Pro</strong> provides many powerful features to <strong>build a unique portfolio</strong>. Click on the button below to discover them all!</div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div></div>';
}
add_action( 'edit_form_advanced', 'gopro_edit_form_advanced' );
add_action( 'edit_page_form', 'gopro_edit_form_advanced' );