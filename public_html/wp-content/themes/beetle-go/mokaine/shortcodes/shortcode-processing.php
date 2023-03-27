<?php
/** ---------------------------------------------------------
 * Section
 */

function mokaine_section_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'background_color' => '', 'text_color' => '', 'title' => '', 'extra_class' => '' ), $atts ) );

	$output = $background_data = $text_color_class = $title_data = null;
	
	if ( $background_color ) {
		$background_data = ' style="background-color:' . $background_color . ';"';
	}

	if ( $text_color == 'light' ) {
		$text_color_class = " text-light";
	}
	
	if ( $title ) {
		$title_data = '<div class="section-title"><h3>' . $title . '</h3></div>';
	}
	
	$output = '
	<section class="row section' . $text_color_class . ' ' . $extra_class . '"' . $background_data . '>
		<div class="row-content buffer even clear-after">
			' . $title_data . do_shortcode( $content ) . '
		</div>
	</section>';
	
    return $output;

}

add_shortcode( 'section', 'mokaine_section_sc' );


/** ---------------------------------------------------------
 * Columns
 */

function mokaine_columns_sc( $atts, $content = null, $tag ) {
	extract( shortcode_atts( array( 'centered_text' => '', 'last' => '', 'extra_class' => '' ), $atts ) );

	$output = $class_centered_text = $class_last = null;

	/* Replace some shortcode tags */
	if ( strpos( $tag, 'onehalf' ) !== false ) {
	    $tag = str_replace( 'onehalf', ' half', $tag );
	}
	if ( strpos( $tag, 'onethird' ) !== false ) {
	    $tag = str_replace( 'onethird', ' third', $tag );
	}
	if ( strpos( $tag, 'onefourth' ) !== false ) {
	    $tag = str_replace( 'onefourth', ' fourth', $tag );
	}
	if ( strpos( $tag, 'onesixth' ) !== false ) {
	    $tag = str_replace( 'onesixth', ' sixth', $tag );
	}
	if ( strpos( $tag, 'onewhole' ) !== false ) {
	    $tag = str_replace( 'onewhole', ' full', $tag );
	}

	if( $centered_text == 'true' ) {
		$class_centered_text = ' centertxt';
	}

	if( $last == 'true' ) {
		$class_last = ' last';
	}
	
	$output = '
	<div class="column ' . $tag . $class_last . $class_centered_text . ' ' . $extra_class . '">
	' . do_shortcode( $content ) . '
	</div>';
	
	return $output;

}

add_shortcode( 'onehalf', 'mokaine_columns_sc' );
add_shortcode( 'onethird', 'mokaine_columns_sc' );
add_shortcode( 'twothirds', 'mokaine_columns_sc' );
add_shortcode( 'onefourth', 'mokaine_columns_sc' );
add_shortcode( 'threefourths', 'mokaine_columns_sc' );
add_shortcode( 'onesixth', 'mokaine_columns_sc' );
add_shortcode( 'fivesixths', 'mokaine_columns_sc' );
add_shortcode( 'onewhole', 'mokaine_columns_sc' );

/** ---------------------------------------------------------
 * Button
 */

function mokaine_button_sc( $atts ) {
	extract( shortcode_atts( array( 'text' => '', 'url' => '', 'color' => '', 'style' => '', 'open_new_tab' => '', 'extra_class' => '' ), $atts) );

	$output = $target_data = $style_class = null;

	if ( $text ) {
		
		if ( $open_new_tab == 'true' ) {
			$target_data = ' target="_blank"';
		}

		if ( $style == 'transparent' ) {
			$style_class = ' transparent';
		}
		
		$output = '<a class="button ' . $color . $style_class . ' ' . $extra_class . '" href="' . $url . '"' . $target_data . '>' . $text . '</a>';
		
	}	

	return $output;

}

add_shortcode( 'button', 'mokaine_button_sc' );

/** ---------------------------------------------------------
 * Icon
 */

function mokaine_icon_sc( $atts ) {
	extract( shortcode_atts( array( 'color' => '', 'type' => '', 'extra_class' => '' ), $atts ) );

	$output = $color_class = null;

	if ( $type ) {

		if ( $color && $color != 'none' ) {
			$color_class = $color;
		} 
		
		$output = '<i class="' . $type . ' ' . $color_class . ' ' . $extra_class . '"></i>';

	}
	
	return $output;

}

add_shortcode( 'icon', 'mokaine_icon_sc' );

/** ---------------------------------------------------------
 * Services
 */

function mokaine_service_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'icon_size' => '', 'icon_color' => '', 'icon_type' => '', 'title' => '' ), $atts ) );

	$output = $icon_color_class = $title_data = $content_data = null;

	$icon_size_class = 'small-icon';
	$content_size_class = 'xs';
	if ( $icon_size == 'big' ) {
		$icon_size_class = 'big-icon';
		$content_size_class = 's';
	}

	if ( $icon_color && $icon_color != 'none' ) {
		$icon_color_class = $icon_color;
	}

	if ( $title ) {
		$title_data = '<h4>' . $title . '</h4>';
	}

	if ( $content ) {
		$content_data = '<p class="text-' . $content_size_class . '">' . do_shortcode( $content ) . '</p>';
	}

	if ( $icon_type ) {

		$output = '
		<div class="' . $icon_size_class . ' ' . $icon_color_class . '"><i class="icon ' . $icon_type . '"></i></div>
		<div class="' . $icon_size_class . '-text clear-after">' . $title_data . $content_data . '</div>';

	}

	return $output;

}

add_shortcode( 'service', 'mokaine_service_sc' );

/** ---------------------------------------------------------
 * Team Member
 */

function mokaine_team_member_sc( $atts ) {
	extract( shortcode_atts( array( 'image_url' => '', 'name' => '', 'role' => '', 'social' => '' ), $atts ) );

	$output = null;

	if ( $name ) {

		$output = '<figure class="about-us">';

		if ( $image_url ) {
			
			$output .= '<img src="' . aq_resize( $image_url, 640, 640, true, true, true ) . '" alt="' . $name . '">';

		} else {

			$output .= '<img src="' . get_template_directory_uri() . '/mokaine/includes/img/team-member-default.jpg" alt="' . $name . '">';

		}

		$output .= '<figcaption>';
		$output .= '<h4>' . $name . '</h4>';
		
		if ( $role ) {

			$output .= '<p>' . $role . '</p>';

		}

		/* Social links */
		if ( $social ) {

			$social_arr = explode( ',', $social );
			
			$output .= '<div><ul class="meta-social inline">';	

			for ( $i = 0; $i < count( $social_arr ); $i = $i + 2 ) {

				/* Open in a new page if the link points to another domain */
				$target = null;
	     	    $url_host = parse_url( $social_arr[ $i + 1 ], PHP_URL_HOST );
			    $base_url_host = parse_url( get_template_directory_uri(), PHP_URL_HOST );
			    if( $url_host != $base_url_host || empty( $url_host ) ) {
			    	$target = 'target="_blank"';
			    }
	         		
				$social_name = strtolower( str_replace( ' ', '-', trim( $social_arr[ $i ] ) ) );
				$social_url = trim( $social_arr[ $i + 1 ] );
				$output .= '<li><a ' . $target . ' href="' . $social_url . '" class="' . $social_name . '-share border-box"><i class="icon-' . $social_name . ' icon-lg"></i></a></li>';  
	        }

			$output .= '</ul></div>';

		}

		$output .= '</figcaption>';
		$output .= '</figure>';

	}
	
	return str_replace( '\r\n', '', $output );

}

add_shortcode( 'team_member', 'mokaine_team_member_sc' );

/** ---------------------------------------------------------
 * Map
 */

function mokaine_map_sc( $atts ) {
	extract( shortcode_atts( array( 'latitude' => '', 'longitude' => '', 'zoom' => '', 'style' => '', 'height' => '', 'marker' => '', 'tooltip' => '', 'extra_class' => '' ), $atts ) );
	
	/* Load Google Maps scripts */
	wp_enqueue_script( array( 'google-map', 'beetle-map' ) );

	$output = null;

	if ( $latitude && $longitude ) {

		$zoom_data = 3;
		if ( $zoom ) {
			$zoom_data = $zoom; 
		}

		$style_data = 'default';
		if ( $style ) {
			$style_data = $style; 
		}

		$height_data = 22.222;
		if ( $height ) {
			$height_data = $height; 
		}

		$output .= '
		<section class="row section">
			<div class="map ' . $extra_class . '" data-maplat="' . $latitude . '" data-maplon="' . $longitude . '" data-mapzoom="' . $zoom_data . '" data-color="' . $style_data . '" data-height="' . $height_data . '" data-img="' . $marker . '" data-info="' . $tooltip . '"></div>
		</section>';
	
	}
	
	return $output;

}

add_shortcode( 'map', 'mokaine_map_sc' );

/** ---------------------------------------------------------
 * Social
 */

function mokaine_social_sc( $atts ) {
	extract( shortcode_atts( array( 'title' => '', 'links' => '' ), $atts ) );

	$output = $title_data = null;

	if ( $title ) {
		$title_data = '<h4 class="widget-title">' . $title . '</h4>';
	}

	if ( $links ) {

		$social_arr = explode( ',', $links );

		$output = '<div class="widget">';
		$output .= $title_data;
		$output .= '<ul class="meta-social inline">';	

		for ( $i = 0; $i < count( $social_arr ); $i = $i + 2 ) {

			/* Open in a new page if the link points to another domain */
			$target = null;
     	    $url_host = parse_url( $social_arr[ $i + 1 ], PHP_URL_HOST );
		    $base_url_host = parse_url( get_template_directory_uri(), PHP_URL_HOST );
		    if( $url_host != $base_url_host || empty( $url_host ) ) {
		    	$target = 'target="_blank"';
		    }
		
			$social_name = strtolower( str_replace( ' ', '-', trim( $social_arr[ $i ] ) ) );
			$social_url = trim( $social_arr[ $i + 1 ] );
			$output .= '<li><a ' . $target . ' href="' . $social_url . '" class="' . $social_name . '-share border-box"><i class="icon-' . $social_name . ' icon-lg"></i></a></li>';	

		}

		$output .= '</ul></div>';

	}
			
	return str_replace( '\r\n', '', $output );

}

add_shortcode( 'social', 'mokaine_social_sc' );

/** ---------------------------------------------------------
 * Text Widget
 */

function mokaine_text_widget_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'title' => '' ), $atts ) );

	$output = $title_data = null;

	if ( $title ) {
		$title_data = '<h4 class="widget-title">' . $title . '</h4>';
	}

	$output = '<aside class="widget">' . $title_data . '<p>' . do_shortcode( $content ) . '</p></aside>';	
			
	return $output;

}

add_shortcode( 'text_widget', 'mokaine_text_widget_sc' );

/** ---------------------------------------------------------
 * Dribbble
 */

function mokaine_dribbble_sc( $atts ) {
	extract( shortcode_atts( array( 'username' => '', 'items' => '', 'columns' => '', 'button_text' => '', 'button_url' => '', 'button_color' => '', 'button_style' => '', 'open_new_tab' => '' ), $atts ) );
	
	$output = $button_data = $target_data = $button_style_class = null;

	if ( $username ) {

		if ( $columns == 4 ) {
			$columns_class = ' dribbble-four-cols';
			$columns_data = 4;		
		} else {
			$columns_class = ' dribbble-three-cols';	
			$columns_data = 3;			
		}

		if ( $items ) {
			$items_data = $items;		
		} else {
			$items_data = $columns_data;			
		}			

		if ( $button_text ) {
			
			if ( $open_new_tab == 'true' ) {
				$target_data = ' target="_blank"';
			}

			if ( $button_style == 'transparent' ) {
				$button_style_class = ' transparent';
			}
			
			$button_data = '<div class="more-btn"><a class="button ' . $button_color . $button_style_class . '" href="' . $button_url . '"' . $target_data . '>' . $button_text . '</a></div>';
			
		}	
		
		$output = '<div class="dribbble-items preload' . $columns_class . '" data-username="' . $username . '" data-elements="' . $items_data . '"></div>' . $button_data;

	}

	return $output;

}

add_shortcode( 'dribbble', 'mokaine_dribbble_sc' );

/** ---------------------------------------------------------
 * Blog
 */

function mokaine_blog_sc( $atts ) {
	extract( shortcode_atts( array( 'category' => '', 'articles' => '', 'style' => '', 'button_text' => '', 'button_url' => '', 'button_color' => '', 'button_style' => '', 'open_new_tab' => '' ), $atts ) );

	global $mokaine, $more;

	$blog_content = $sizer = $button_data = $target_data = $button_style_class = null;

	/* Handle big post */
	$big_post_option = $mokaine['enable-first-post-big'];

	/* Set dynamic posts_per_page and offset values */
	$latest_post = get_posts('numberposts=1');
	$latest_id = $latest_post[0]->ID;

	if ( $articles ) {
		if ( has_post_thumbnail( $latest_id ) && $big_post_option && $style == 'masonry' ) {
			$articles_data = $articles -1;
		} else {
			$articles_data = $articles;
		}		
	} else {
		$articles_data = 4;			
	}

	if( $category == 'all' || $category == '' ) {
		$category = null;
	}	

	if ( $style != 'masonry' ) {

		$style_class = 'list-style';
		$buffer = 'buffer-left buffer-right buffer-bottom clear-after';	

	} else {

		$style_class = 'masonry-style grid-items preload';
		$buffer = 'buffer clear-after';
		$sizer = '<div class="shuffle-sizer three"></div>';

	}

    $blog_sc_args = array(
        'post_type' => 'post',
        'posts_per_page' => $articles_data,
        'category_name' => $category
    );

    query_posts( $blog_sc_args );


    if ( $button_text ) {
    	
    	if ( $open_new_tab == 'true' ) {
    		$target_data = ' target="_blank"';
    	}

    	if ( $button_style == 'transparent' ) {
    		$button_style_class = ' transparent';
    	}
    	
    	$button_data = '<div class="more-btn"><a class="button ' . $button_color . $button_style_class . '" href="' . $button_url . '"' . $target_data . '>' . $button_text . '</a></div>';
    	
    }   

	ob_start(); 

	?>

	<div class="blog-section <?php echo $style_class; ?> clear-after">

		<?php

	    if ( have_posts() ) :

	        while ( have_posts() ) : the_post();

	            $more = 0;

	            if ( $style != 'masonry' ) {

					get_template_part( 'listed', 'article' );

				} else {

					get_template_part( 'listed', 'article-masonry' );

				}

	        endwhile;

	        echo $sizer;

	    else :

	        get_template_part( 'content', 'none' );

	    endif;

	    ?>

    </div>


    <?php

    wp_reset_query();

    $blog_content = ob_get_contents();
    $blog_content .= $button_data;

    ob_end_clean();
    
    return $blog_content;

}

add_shortcode( 'blog', 'mokaine_blog_sc' );

/** ---------------------------------------------------------
 * Portfolio
 */

function mokaine_portfolio_sc( $atts ) {
	extract( shortcode_atts( array( 'columns' => '', 'items' => '', 'lightbox' => '', 'button_text' => '', 'button_url' => '', 'button_color' => '', 'button_style' => '', 'open_new_tab' => '' ), $atts ) );

	$portfolio_content = $button_data = $target_data = $button_style_class = null;

	global $grid_class, $sc_lightbox;

	if ( $columns ) {
		$columns_data = $columns;		
	} else {
		$columns_data = 3;			
	}

	if ( $items ) {
		$items_data = $items;		
	} else {
		$items_data = $columns_data;			
	}		

	if ( $lightbox == 'true' ) {
		$lightbox_data = ' lightbox';		
	} else {
		$lightbox_data = null;			
	}

	$sc_lightbox = $lightbox;	

	switch ( $columns_data ) {
	    case '4' :
	        $grid_class = 'three';
	        break;
	    case '3' :
	        $grid_class = 'four';
	        break;
	    case '2' :
	        $grid_class = 'six';
	        break;
	}

	$sizer = '<div class="shuffle-sizer ' . $grid_class . '"></div>';

    $portfolio_sc_args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => $items_data
    );

    $wp_query = new WP_Query( $portfolio_sc_args );

    
    if ( $button_text ) {
    	
    	if ( $open_new_tab == 'true' ) {
    		$target_data = ' target="_blank"';
    	}

    	if ( $button_style == 'transparent' ) {
    		$button_style_class = ' transparent';
    	}
    	
    	$button_data = '<div class="more-btn"><a class="button ' . $button_color . $button_style_class . '" href="' . $button_url . '"' . $target_data . '>' . $button_text . '</a></div>';
    	
    }     

	ob_start(); 

	?>

	<div class="portfolio-section clear-after">

		<div class="grid-items preload<?php echo $lightbox_data; ?>">

			<?php

		    if ( $wp_query->have_posts() ) :

		        while ( $wp_query->have_posts() ) : $wp_query->the_post();

					get_template_part( 'listed', 'item' );

		        endwhile;

		        echo $sizer;

		    else :

		        get_template_part( 'content', 'none' );

		    endif;

		    ?>

		</div>

    </div>


    <?php

    wp_reset_postdata();

    $portfolio_content = ob_get_contents();
    $portfolio_content .= $button_data;

    ob_end_clean();
    
    return $portfolio_content;

}

add_shortcode( 'portfolio', 'mokaine_portfolio_sc' );

/** ---------------------------------------------------------
 * Current year
 */

function mokaine_year_sc() {

	$year = date('Y');

	return $year;

}

add_shortcode( 'current_year', 'mokaine_year_sc' );


/** ---------------------------------------------------------
 * Remove empty <p> tags in shortcodes https://gist.github.com/bitfade/4555047
 * http://themeforest.net/forums/thread/how-to-add-shortcodes-in-wp-themes-without-being-rejected/98804?page=4#996848
 */
 
function the_content_filter( $content ) {

	/* Array of shortcodes requiring the fix */
	$block = join( '|', array( 'section', 'onehalf', 'onethird', 'twothirds', 'onefourth', 'threefourths', 'onesixth', 'fivesixth', 'onewhole','service', 'map', 'text_widget', 'blog', 'portfolio', 'dribbble' ) );
 
	/* Opening tag */
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]" , $content );
		
	/* Closing tag */
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );
 
	return $rep;
 
}

add_filter( 'the_content', 'the_content_filter' );