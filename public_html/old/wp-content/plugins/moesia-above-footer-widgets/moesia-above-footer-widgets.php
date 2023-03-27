<?php
/**
 * Plugin Name: Moesia Above Footer Widgets
 * Plugin URI: http://athemes.com
 * Description: This plugin adds a new widget area right above the footer. You can use it to display a call to action, an ad, etc.
 * Version: 1.00
 * Author: aThemes
 * License: GPLv2 or later
 */

/*  Copyright 2015  athemes.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}

//Register a new sidebar
function moesia_above_footer_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Above footer', 'moesia' ),
        'id'            => 'sidebar-above-footer',
        'description'   => __( 'This widget area is here because you are using a Moesia Extension', 'moesia' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'moesia_above_footer_widgets_init' );

//Plugin customizer options
require_once plugin_dir_path( __FILE__ ) . 'lib/af-customizer.php';

//Hook the sidebar
function moesia_af_render_sidebar() {
    if ( is_active_sidebar( 'sidebar-above-footer' ) ) {
        if ( ( get_theme_mod('moesia_af_front') && is_front_page() ) || ( get_theme_mod('moesia_af_home') && ( is_home() || is_archive() ) ) || ( ( get_theme_mod('moesia_af_singular') && is_singular() ) ) ) {
            echo '<div class="af-widget-area" style="background-color:' . esc_attr(get_theme_mod('moesia_af_bg', '#fff')) . '; color:' . esc_attr(get_theme_mod('moesia_af_color', '#aaa')) . '"><div class="container">';
            dynamic_sidebar( 'sidebar-above-footer' );
            echo '</div></div>';
            ?>
            <style>
                .af-widget-area .widget {
                    padding: 30px 0;
                }
                .af-widget-area .widget-title {
                    padding: 0;
                    border: 0;
                }
                <?php if ( get_theme_mod('moesia_af_center') ) { ?>
                    .af-widget-area {
                        text-align: center;
                    }
                <?php } ?>
            </style>
            <?php
        }
    }
}
add_action( 'tha_footer_before', 'moesia_af_render_sidebar' );