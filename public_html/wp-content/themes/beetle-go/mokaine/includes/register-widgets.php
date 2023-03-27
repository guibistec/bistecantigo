<?php
/**
 * Register widget area
 */

function mokaine_widgets_init() {

	global $mokaine;

	if ( isset( $mokaine['footer-layout'] ) ) {

		$footer_layout = $mokaine['footer-layout'];

	} else {

		$footer_layout = 'footer-1';

	}

	if ( function_exists( 'register_sidebar' ) ) {

		register_sidebar( array(
			'name'          => __( 'Sidebar', MOKAINE_THEME_NAME ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

	 	register_sidebar( array(
	 		'name'          => __( 'Footer One', MOKAINE_THEME_NAME ),
	 		'id'            => 'footer-1',
	 		'description'   => '',
	 		'before_widget' => '<div id="%1$s" class="widget %2$s">',
	 		'after_widget'  => '</div>',
	 		'before_title'  => '<h4 class="widget-title">',
	 		'after_title'   => '</h4>',
	 	) );	

	 	if ( $footer_layout != 'footer-9' ) {

		 	register_sidebar( array(
		 		'name'          => __( 'Footer Two', MOKAINE_THEME_NAME ),
		 		'id'            => 'footer-2',
		 		'description'   => '',
		 		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		 		'after_widget'  => '</div>',
		 		'before_title'  => '<h4 class="widget-title">',
		 		'after_title'   => '</h4>',
		 	) );	

		 	register_sidebar( array(
		 		'name'          => __( 'Footer Three', MOKAINE_THEME_NAME ),
		 		'id'            => 'footer-3',
		 		'description'   => '',
		 		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		 		'after_widget'  => '</div>',
		 		'before_title'  => '<h4 class="widget-title">',
		 		'after_title'   => '</h4>',
		 	) );

		}

	 	if ( $footer_layout == 'footer-1' ) {

		 	register_sidebar( array(
		 		'name'          => __( 'Footer Four', MOKAINE_THEME_NAME ),
		 		'id'            => 'footer-4',
		 		'description'   => '',
		 		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		 		'after_widget'  => '</div>',
		 		'before_title'  => '<h4 class="widget-title">',
		 		'after_title'   => '</h4>',
		 	) );

		}

	}

}

add_action( 'widgets_init', 'mokaine_widgets_init' );