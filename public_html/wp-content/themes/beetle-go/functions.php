<?php
/**
 * Beetle functions and definitions
 */

/* Set default theme constants */
define( 'MOKAINE_THEME_NAME', 'beetle' );
define( 'MOKAINE_THEME_VERSION', wp_get_theme()->Version );

/* Make theme available for translation */
load_theme_textdomain( 'beetle', get_template_directory() . '/languages' );

/* Sets up theme defaults and registers support for various WordPress features */
function beetle_setup() {

	/* Set content_width global variable */
	if ( !isset( $content_width ) ) $content_width = 900;

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Enable support for Post Thumbnails on posts and pages */
	add_theme_support( 'post-thumbnails' );

	/* This theme uses wp_nav_menu() in one location */
	register_nav_menus( array(
		'primary' => __( 'Header Menu', MOKAINE_THEME_NAME ),
	) );

	/* Dropdown arrows */
	class beetle_walker_menu extends Walker_Nav_Menu {
	    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
	        $id_field = $this->db_fields['id'];
	        if ( !empty( $children_elements[$element->$id_field] ) && $element->menu_item_parent == 0 ) { 
	            $element->title =  $element->title . '<span class="sub-arrow"><i class="icon-chevron-down"></i></span>'; 
				$element->classes[] = 'sf-with-ul';
	        }
			
			if ( !empty( $children_elements[$element->$id_field] ) && $element->menu_item_parent != 0 ) { 
	            $element->title =  $element->title . '<span class="sub-arrow sub-sub"><i class="icon-chevron-right"></i></span>'; 
	        }

	        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	    }
	}

	/* Switch default core markup for search form, comment form, and comments to output valid HTML5 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/* Enable support for Post Formats. See http://codex.wordpress.org/Post_Formats */
	add_theme_support( 'post-formats', array(
		'image', 'gallery', 'video', 'audio',
	) );

	/* Set Thumbnail Sizes */
	add_image_size( 'intro', 1400 );
	add_image_size( 'thumb', 640 );
	add_image_size( 'thumb-cropped', 640, 480, true );
	add_image_size( 'thumb-square-cropped', 640, 640, true );
	add_image_size( 'experience-image', 120, 120, true );

}

add_action( 'after_setup_theme', 'beetle_setup' );

/* Enqueue scripts and styles */
function beetle_scripts() {
	wp_enqueue_style( 'beetle-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	global $mokaine;
	$token = isset( $mokaine['dribbble-token'] ) ? $mokaine['dribbble-token'] : null;
	$passed_data = array( 'dribbbleToken' =>  $token );
	$googlemaps_api = isset( $mokaine['google-maps-api-key'] ) ? esc_attr( '?key=' . $mokaine['google-maps-api-key'] ) : '';

	wp_register_script( 'beetle-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), MOKAINE_THEME_VERSION, true );
	wp_register_script( 'beetle-init', get_template_directory_uri() . '/js/beetle.js', array( 'beetle-plugins' ), MOKAINE_THEME_VERSION, true );
	wp_register_script('google-map', 'https://maps.googleapis.com/maps/api/js' . $googlemaps_api, null, null, true );
	wp_register_script( 'beetle-map', get_template_directory_uri() . '/js/map.js', null, MOKAINE_THEME_VERSION, true );

	wp_localize_script( 'beetle-init', 'passed_data', $passed_data );

	wp_enqueue_script( array( 'jquery', 'beetle-plugins', 'beetle-init' ) );

	// wp_enqueue_script( array( 'google-map', 'beetle-map' ) ); 
	// this part has been included in section-intro.php

	wp_register_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700,400italic,700italic' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_register_style( 'linecon', get_template_directory_uri() . '/css/linecon.css' );

	wp_enqueue_style( 'googlefonts' );
	wp_enqueue_style( 'font-awesome' ); 
	wp_enqueue_style( 'linecon' ); 

}

add_action( 'wp_enqueue_scripts', 'beetle_scripts' );

/* Hook for using single-item.php on portfolio items */
function single_portfolio_template() {

	global $post;

	if ( is_mokaine_portfolio_post() && is_single() ) {

        if ( file_exists( get_template_directory() . '/single-item.php' ) ) {

			include( get_template_directory() . '/single-item.php' );
			exit;

		}

	}

}

add_action( 'template_redirect', 'single_portfolio_template' );

/* Require Mokaine stuff */
require_once( 'mokaine/start.php' );