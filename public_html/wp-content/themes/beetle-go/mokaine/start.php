<?php

global $mokaine;

/* Helper functions */
require_once( 'includes/helper.php' );

/* Custom post types */
require_once( 'includes/custom-types.php' );

/* Extra functions */
require_once( 'includes/extras.php' );

/* CSS options saved in redux */
require_once( 'includes/css.php' );

/* Widgets */
require_once( 'includes/register-widgets.php' );

/* Image resizer */
require_once( 'includes/aq_resizer.php' );

/* Framework */
if ( ! class_exists( 'ReduxFramework' ) ) {
    require_once( 'framework/framework.php' );
}
if ( ! isset( $redux_demo ) ) {
    require_once( 'framework/config.php' );
}

/* Metaboxes */
require_once( 'meta/meta-start.php' );

/* TGM plugin activation */
require_once( 'tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once( 'tgm-plugin-activation/required-plugins.php' );

/* Theme update notifier */
$enable_updates = isset( $mokaine['enable-updates'] ) ? $mokaine['enable-updates'] : null;
if ( $enable_updates ) {
	require_once( 'includes/update-theme.php' );
}

/* Shortcode panel */
if( is_edit_page() ) {
	require_once ( 'shortcodes/shortcode-functions.php' );		
}

/* Shortcode processing */
require_once ( 'shortcodes/shortcode-processing.php' );

/* Add shortcode button */
function mokaine_buttons() {
     echo '<a data-effect="mfp-zoom-in" class="button button-primary mokaine-shortcode-generator" href="#mokaine-sc-generator"><span class="wp-shortcode-buttons-icon"></span> '. __('Mokaine Shortcodes', MOKAINE_THEME_NAME ).'</a>';
}
add_action( 'media_buttons', 'mokaine_buttons', 100 );

/* Enqueue admin panel scripts and styles */
function mokaine_admin_scripts() {

	wp_register_script( 'admin_mokaine_js', get_template_directory_uri() . '/mokaine/includes/js/custom.js', false, MOKAINE_THEME_VERSION );
	wp_enqueue_style( 'admin_mokaine_css', get_template_directory_uri() . '/mokaine/includes/css/custom.css', false, MOKAINE_THEME_VERSION );	

	$passed_data = array( 'expandedString' =>  __( '[-] Show less options', MOKAINE_THEME_NAME ), 'closedString' => __( '[+] Show more options', MOKAINE_THEME_NAME ) );

	wp_localize_script( 'admin_mokaine_js', 'passed_data', $passed_data );

	wp_enqueue_script( array( 'jquery-ui-sortable', 'admin_mokaine_js' ) );

}

add_action( 'admin_enqueue_scripts', 'mokaine_admin_scripts', '999' );