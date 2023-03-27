<?php
/**
 * CSS options saved in redux https://github.com/ghost1227/historical-redux2/issues/152
 */

function css_options() {

    global $mokaine;

    $custom_css = isset ( $mokaine['custom-css'] ) ? $mokaine['custom-css'] : null;
    $base_font_size = $mokaine['base-font-size'];
    $base_font_size_sm = $mokaine['base-font-size-smaller'];
    $img_radius = $mokaine['img-radius'];
    $h_one_size = $mokaine['h1-font-size'];
    $h_two_size = $mokaine['h2-font-size'];
    $h_three_size = $mokaine['h3-font-size'];
    $h_four_size = $mokaine['h4-font-size'];
    $h_five_size = $mokaine['h5-font-size'];
    $h_six_size = $mokaine['h6-font-size'];
    $body_height = $mokaine['body-line-height'];
    $headings_height = $mokaine['headings-line-height'];
    $primary_color = $mokaine['primary-color'];
    $secondary_color = $mokaine['secondary-color'];

    /* CSS to output */
    $theCSS = 'body { font-size: ' . $base_font_size .'px; line-height: ' . $body_height .'; }';
    $theCSS .= '@media handheld, only screen and (max-width:48em) { body { font-size: ' . $base_font_size_sm . 'px; } }';
    $theCSS .= 'h1, h2, h3, h4, h5, h6 { line-height: ' . $headings_height . '; }';
    $theCSS .= 'h1 { font-size: ' . $h_one_size . 'em; }';
    $theCSS .= 'h2 { font-size: ' . $h_two_size . 'em; }';
    $theCSS .= 'h3 { font-size: ' . $h_three_size . 'em; }';
    $theCSS .= 'h4 { font-size: ' . $h_four_size . 'em; }';
    $theCSS .= 'h5 { font-size: ' . $h_five_size . 'em; }';
    $theCSS .= 'h6 { font-size: ' . $h_six_size . 'em; }';
    $theCSS .= '#menu-toggle:hover, .sidebar a:hover, .single #post-nav a:hover, .paging-navigation a:hover, .load-more a:hover, .entry-title a:hover, .text-light .blog-excerpt-inner .entry-title a:hover, .text-light .blog-excerpt-inner h5.meta-post a:hover, .meta-post a:hover, .portfolio-section ul.cats li.active, .comment-author b.fn a:hover, .comment-metadata a:hover, .wpcf7-form p span { color: ' . $primary_color . '; }';
    $theCSS .= '.mobile nav#site-navigation ul li > a:hover { color: ' . $primary_color . ' !important; }';
    $theCSS .= '::selection { background: ' . $primary_color . '; }';
    $theCSS .= '::-moz-selection { background: ' . $primary_color . '; }';
    $theCSS .= 'nav#site-navigation ul.sub-menu > li > a:hover, .reply a:hover { background-color: ' . $primary_color . '; }';
    $theCSS .= 'div.wpcf7-validation-errors { border-color: ' . $primary_color . '; }';
    $theCSS .= '.portfolio-section .overlay, .related .overlay, .blog.masonry-style article a figure .blog-overlay, .blog-section.masonry-style article a figure .blog-overlay { background-color: ' . $secondary_color . '; }';
    $theCSS .= 'textarea:not([type="button"]):focus, textarea:not([type="button"]):active, input:not([type="button"]):focus, input:not([type="button"]):active { border-color: ' . $secondary_color . '; }';
    $theCSS .= '.blog .list-style article figure img, .archive article figure img, .blog-section.list-style article figure img, .search article figure img, .related img, .related .overlay, .portfolio-section figure img, .portfolio-section .overlay, .dribbble-items figure img, .dribbble-items .overlay, .blog.masonry-style article.three, .blog.masonry-style article.four, .blog-section.masonry-style article.three, .blog-section.masonry-style article.four, .blog.masonry-style article.three .blog-excerpt.no-thumb, .blog.masonry-style article.four .blog-excerpt.no-thumb, .blog-section.masonry-style article.three .blog-excerpt.no-thumb, .blog-section.masonry-style article.four .blog-excerpt.no-thumb, .blog.masonry-style article.six figure img, .blog.masonry-style article.six figure .blog-overlay, .blog.masonry-style article.eight figure img, .blog.masonry-style article.eight figure .blog-overlay, .blog-section.masonry-style article.six figure img, .blog-section.masonry-style article.six figure .blog-overlay, .blog-section.masonry-style article.eight figure img, .blog-section.masonry-style article.eight figure .blog-overlay, .blog.masonry-style article figure .gradient, .blog-section.masonry-style article figure .gradient, .featured-image img, .entry-content img, .comment-author img, #author-bio img { -webkit-border-radius: ' . $img_radius . 'em; -moz-border-radius: ' . $img_radius . 'em; border-radius: ' . $img_radius . 'em; }';

    if ( $img_radius > 1 ) {
        $theCSS .= '.comment-author img';
    }

    $theCSS .= '.blog.masonry-style article.three figure img, .blog.masonry-style article.three figure .blog-overlay, .blog.masonry-style article.four figure img, .blog.masonry-style article.four figure .blog-overlay, .blog-section.masonry-style article.three figure img, .blog-section.masonry-style article.three figure .blog-overlay, .blog-section.masonry-style article.four figure img, .blog-section.masonry-style article.four figure .blog-overlay  { -webkit-border-radius: ' . $img_radius . 'em ' . $img_radius . 'em 0 0; -moz-border-radius: ' . $img_radius . 'em ' . $img_radius . 'em 0 0; border-radius: ' . $img_radius .'em ' . $img_radius . 'em 0 0; }';
    $theCSS .= '.blog.masonry-style article.three .blog-excerpt.w-thumb, .blog.masonry-style article.four .blog-excerpt.w-thumb, .blog-section.masonry-style article.three .blog-excerpt.w-thumb, .blog-section.masonry-style article.four .blog-excerpt.w-thumb, .blog.masonry-style article.three .blog-excerpt, .blog.masonry-style article.four .blog-excerpt, .blog-section.masonry-style article.three .blog-excerpt, .blog-section.masonry-style article.four .blog-excerpt { -webkit-border-radius: 0 0 ' . $img_radius . 'em ' . $img_radius . 'em; -moz-border-radius: 0 0 ' . $img_radius . 'em ' . $img_radius . 'em; border-radius: 0 0 ' . $img_radius . 'em ' . $img_radius . 'em; }';

    /* Fix */
    $theCSS .= '.text-light .entry-title a, .text-light h5.meta-post a:hover { color: #FFF; }';      

    /* Output custom CSS code typed by the user in the option panel */
    if( $custom_css ) {
        $theCSS .= $custom_css;
    }        

    /* Add CSS to style.css */
    wp_add_inline_style( 'beetle-style', $theCSS );
}

add_action( 'wp_enqueue_scripts', 'css_options' );