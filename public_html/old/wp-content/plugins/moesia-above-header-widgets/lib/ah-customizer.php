<?php

if ( ! defined('ABSPATH') ) {
    die('Please do not load this file directly!');
}

//Plugin customizer options
function moesia_above_header_customizer( $wp_customize ) {

    $wp_customize->add_panel( 'moesia_ext_panel', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Moesia Extensions', 'moesia'),
        'description'    => '',
    ) );

    $wp_customize->add_section(
        'moesia_ah',
        array(
            'title' => __('Above header extension', 'moesia'),
            'priority' => 10,
            'panel'  => 'moesia_ext_panel',            
        )
    );
    //Front page
    $wp_customize->add_setting(
        'moesia_ah_front',
        array(
            'sanitize_callback' => 'moesia_ah_sanitize_checkbox',
            'default' => 0,         
        )       
    );
    $wp_customize->add_control(
        'moesia_ah_front',
        array(
            'type' => 'checkbox',
            'label' => __('Show widget area on front page?', 'moesia'),
            'section' => 'moesia_ah',
            'priority' => 10,           
        )
    );
    //Home page
    $wp_customize->add_setting(
        'moesia_ah_home',
        array(
            'sanitize_callback' => 'moesia_ah_sanitize_checkbox',
            'default' => 0,         
        )       
    );
    $wp_customize->add_control(
        'moesia_ah_home',
        array(
            'type' => 'checkbox',
            'label' => __('Show widget area on blog index/archives/etc?', 'moesia'),
            'section' => 'moesia_ah',
            'priority' => 11,           
        )
    );
    //Singular
    $wp_customize->add_setting(
        'moesia_ah_singular',
        array(
            'sanitize_callback' => 'moesia_ah_sanitize_checkbox',
            'default' => 0,         
        )       
    );
    $wp_customize->add_control(
        'moesia_ah_singular',
        array(
            'type' => 'checkbox',
            'label' => __('Show widget area on single posts and pages?', 'moesia'),
            'section' => 'moesia_ah',
            'priority' => 12,           
        )
    );
    $wp_customize->add_setting(
        'moesia_ah_bg',
        array(
          'default'           => '#fff',
          'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    //Center text
    $wp_customize->add_setting(
        'moesia_ah_center',
        array(
            'sanitize_callback' => 'moesia_ah_sanitize_checkbox',
            'default' => 0,         
        )       
    );
    $wp_customize->add_control(
        'moesia_ah_center',
        array(
            'type' => 'checkbox',
            'label' => __('Center the text inside the widget area?', 'moesia'),
            'section' => 'moesia_ah',
            'priority' => 13,           
        )
    );
    //BG color
    $wp_customize->add_setting(
        'moesia_ah_bg',
        array(
          'default'           => '#fff',
          'sanitize_callback' => 'sanitize_hex_color',
        )
    );    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
          $wp_customize,
          'moesia_ah_bg',
          array(
            'label' => __('Background color', 'moesia'),
            'section' => 'moesia_ah',
            'priority' => 14
          )
        )
    );
    //Color
    $wp_customize->add_setting(
        'moesia_ah_color',
        array(
          'default'           => '#aaa',
          'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
          $wp_customize,
          'moesia_ah_color',
          array(
            'label' => __('Color', 'moesia'),
            'section' => 'moesia_ah',
            'priority' => 15
          )
        )
    );                    
}
add_action( 'customize_register', 'moesia_above_header_customizer' );

//Customizer sanitization
function moesia_ah_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}