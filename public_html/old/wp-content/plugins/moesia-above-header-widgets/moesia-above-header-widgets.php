<?php
/**
 * Plugin Name: Moesia Above Header Widgets
 * Plugin URI: http://athemes.com
 * Description: This plugin adds a new widget area right below the nav bar. You can use it to display a call to action, an ad, etc.
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
function moesia_above_header_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Above Header', 'moesia' ),
        'id'            => 'sidebar-above-header',
        'description'   => __( 'This widget area is here because you are using a Moesia Extension', 'moesia' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'moesia_above_header_widgets_init' );

//Plugin customizer options
require_once plugin_dir_path( __FILE__ ) . 'lib/ah-customizer.php';

//Hook the sidebar
function moesia_render_sidebar_ah() {
    if ( is_active_sidebar( 'sidebar-above-header' ) ) {
        if ( ( get_theme_mod('moesia_ah_front') && is_front_page() ) || ( get_theme_mod('moesia_ah_home') && ( is_home() || is_archive() ) ) || ( ( get_theme_mod('moesia_ah_singular') && is_singular() ) ) ) {
            echo '<div class="ah-widget-area" style="background-color:' . esc_attr(get_theme_mod('moesia_ah_bg', '#fff')) . '; color:' . esc_attr(get_theme_mod('moesia_ah_color', '#aaa')) . '"><div class="container">';
            dynamic_sidebar( 'sidebar-above-header' );
            echo '</div></div>';
            ?>
            <style>
                .ah-widget-area .widget {
                    padding: 30px 0;
                }
                .ah-widget-area .widget-title {
                    padding: 0;
                    border: 0;
                }
                <?php if ( get_theme_mod('moesia_ah_center') ) { ?>
                    .ah-widget-area {
                        text-align: center;
                    }
                <?php } ?>
            </style>
            <?php
        }
    }
}
add_action( 'tha_header_before', 'moesia_render_sidebar_ah' );