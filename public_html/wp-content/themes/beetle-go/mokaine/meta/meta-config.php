<?php
/**
 * Config Metaboxes
 */
function config_metaboxes( array $meta_boxes ) {

    $prefix = '_mokaine_';
    $portfolio_cpt = array();

    /* Define Portfolio items types */
    if ( $portfolios = get_mokaine_portfolio_pages() ) {
        foreach ( $portfolios as $page )
            $portfolio_cpt[] = 'portfolio';
    }

    /* Intro Composer */
    $meta_boxes['intro_composer'] = array(
        'id' => 'intro_composer',
        'title' => __( 'Compose Intro', MOKAINE_THEME_NAME ),
        'object_types' => array('mokaine_intro'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'id' => $prefix . 'single_slide',
                'type' => 'group',
                'options' => array(
                    'group_title' => __( 'Slide {#}', MOKAINE_THEME_NAME ), // since version 1.1.4, {#} gets replaced by row number
                    'add_button' => __( 'Add Another Slide', MOKAINE_THEME_NAME ),
                    'remove_button' => __( 'Remove Slide', MOKAINE_THEME_NAME ),
                    'sortable' => true, // beta
                ),
                // Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
                'fields'      => array(
                    array(
                        'name' => __( 'Slide type', MOKAINE_THEME_NAME ),
                        'description' => __( 'What kind of slide is this?', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_type',
                        'type' => 'select',
                        'default' => 'image_bg',
                        'options' => array(
                            'image_bg' => __( 'Image Background', MOKAINE_THEME_NAME ),
                            'device_mockup' => __( 'Device Mockup', MOKAINE_THEME_NAME ),
                            'intro_map' => __( 'Map', MOKAINE_THEME_NAME )
                        )
                    ),
                    array(
                        'name' => __( 'Select image', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_select_image',
                        'description' => __( 'Upload the image or type the image URL', MOKAINE_THEME_NAME ),                        
                        'type' => 'file',
                        'preview_size' => array( 150, 150 )
                        // 'options' => array(
                        //     'url' => false
                        // )
                    ), 
                    array(
                        'name' => __( 'Background color', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_bg_color',
                        'type' => 'colorpicker',
                        'default' => '#363842'
                    ),  
                    array(
                        'name' => __( 'Slide font color', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_font_color',
                        'type' => 'select',
                        'default' => 'font_light',
                        'options' => array(
                            'font_light' => __( 'Light', MOKAINE_THEME_NAME ),
                            'font_dark' => __( 'Dark', MOKAINE_THEME_NAME )
                        )
                    ),
                    array(
                        'name' => __( 'Slide title', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_title',
                        'type' => 'text',
                    ),  
                    array(
                        'name' => __( 'Slide subtitle', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_subtitle',
                        'type' => 'textarea_code',
                        'description' => __( 'HTML is allowed', MOKAINE_THEME_NAME ),
                        'attributes'  => array(
                            'rows' => 3
                        )                                                
                    ),   
                    array(
                        'name' => __( 'Credits box', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_credits_box',
                        'type' => 'textarea_code',
                        'description' => __( 'HTML is allowed', MOKAINE_THEME_NAME ),
                        'attributes'  => array(
                            'rows' => 3
                        )                       
                    ), 
                    array(
                        'name' => __( 'Show button', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_button_show',
                        'type' => 'checkbox',
                        'description' => __( 'Disable if you want to hide the button', MOKAINE_THEME_NAME )                        
                    ),   
                    array(
                        'name' => __( 'Button text', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_button_text',
                        'type' => 'text'
                    ),   
                    array(
                        'name' => __( 'Button link', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_button_link',
                        'type' => 'text_url'
                    ), 
                    array(
                        'name' => __( 'Button style', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_button_style',
                        'type' => 'select',
                        'options' => array(
                            'solid' => __( 'Solid', MOKAINE_THEME_NAME ),
                            'transparent' => __( 'Transparent', MOKAINE_THEME_NAME )                                                     
                        )                
                    ),   
                    array(
                        'name' => __( 'Button color', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_button_color',
                        'type' => 'select',
                        'default' => 'white',
                        'options' => array(
                            'red' => __( 'Red', MOKAINE_THEME_NAME ),
                            'orange' => __( 'Orange', MOKAINE_THEME_NAME ),
                            'yellow' => __( 'Yellow', MOKAINE_THEME_NAME ),
                            'green' => __( 'Green', MOKAINE_THEME_NAME ),
                            'mint' => __( 'Mint', MOKAINE_THEME_NAME ),
                            'aqua' => __( 'Aqua', MOKAINE_THEME_NAME ),
                            'blue' => __( 'Blue', MOKAINE_THEME_NAME ),
                            'purple' => __( 'Purple', MOKAINE_THEME_NAME ), 
                            'pink' => __( 'Pink', MOKAINE_THEME_NAME ),
                            'white' => __( 'White', MOKAINE_THEME_NAME ),
                            'grey' => __( 'Grey', MOKAINE_THEME_NAME ), 
                            'dark-grey' => __( 'Dark grey', MOKAINE_THEME_NAME )                                                       
                        )
                    ), 
                    array(
                        'name' => __( 'Open link in a new tab?', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_button_new_tab',
                        'type' => 'checkbox',
                        'description' => __( 'Check this if you want to open the link in a new page', MOKAINE_THEME_NAME )                        
                    ),   
                    array(
                        'name' => __( 'Mockup layout', MOKAINE_THEME_NAME ),
                        'description' => __( 'Specify the caption position', MOKAINE_THEME_NAME ),                        
                        'id' => $prefix . 'slide_mockup_layout',
                        'type' => 'select',
                        'default' => 'top_caption',
                        'options' => array(
                            'top_caption' => 'Top Caption',
                            'left_caption' => 'Left Caption',
                            'right_caption' => 'Right Caption'             
                        )
                    ),
                    array(
                        'name' => __( 'Map Latitude', MOKAINE_THEME_NAME ),
                        'description' => __( 'Specify the latitude for the pin (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'map_latitude',
                        'type' => 'text_small',
                        'default' => '40.714353' 
                    ),  
                    array(
                        'name' => __( 'Map Longitude', MOKAINE_THEME_NAME ),
                        'description' => __( 'Specify the longitude for the pin (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'map_longitude',
                        'type' => 'text_small',
                        'default' => '-74.005973' 
                    ),   
                    array(
                        'name' => __( 'Map zoom level', MOKAINE_THEME_NAME ),
                        'description' => __( 'The initial resolution at which to display the map', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'map_zoom',
                        'type' => 'text_small',
                        'default' => '7' 
                    ),
                    array(
                        'name' => __( 'Map style', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'map_style',
                        'type' => 'select',
                        'description' => __( 'Choose a style preset for your map', MOKAINE_THEME_NAME ),                        
                        'default' => 'default',
                        'options' => array(
                            'default' => __( 'Default', MOKAINE_THEME_NAME ),
                            'invert' => __( 'Reversed colors', MOKAINE_THEME_NAME )                                                          
                        )
                    ),  
                    array(
                        'name' => __( 'Image marker', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'map_marker',
                        'description' => __( 'Set a different image for the marker. Default marker URL:<br><strong>' . get_template_directory_uri() . '/mokaine/includes/img/marker-red.png</strong>', MOKAINE_THEME_NAME ),                        
                        'type' => 'file'
                    ),     
                    array(
                        'name' => __( 'Tooltip content', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'map_tooltip',
                        'type' => 'text',
                        'description' => __( 'Type here what you want to show in the tooltip', MOKAINE_THEME_NAME )                        
                    ),                                                                                                 
                    array(
                        'name' => __( 'Extra class', MOKAINE_THEME_NAME ),
                        'id' => $prefix . 'slide_extra_class',
                        'type' => 'text',
                        'description' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
                    ),
                    array(
                        'name' => __( '<span class="intro-more-options">[+] Show more options</span>', MOKAINE_THEME_NAME ),
                        'type' => 'title',
                        'id' => $prefix . 'slide_more_options_trigger'
                    )                                                                                                                                                                                                                                                               
                )
            )
        )
    );

    /* Call Intro */
    $meta_boxes['select_intro'] = array(
        'id' => 'select_intro',
        'title' => __( 'Intro settings', MOKAINE_THEME_NAME ),
        'object_types' => array( 'page' ),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __( 'Select Intro', MOKAINE_THEME_NAME ),
                'desc' => __( 'None', MOKAINE_THEME_NAME ),
                'description' => __( 'Pick an <a href="'. admin_url( 'edit.php?post_type=mokaine_intro' ) .'">precomposed intro</a> or use the <strong>Featured image</strong> to show into the intro area', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'select_intro_parse',
                'type' => 'pw_select',
                'sanitization_cb' => 'pw_select2_sanitise',
                'options' => cmb_get_post_options( array( 'post_type' => 'mokaine_intro', 'posts_per_page' => -1 ) ),
            ),
            array(
                'name' => __( 'Full height', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_full_height',
                'type' => 'checkbox',
                'description' => __( 'When checked, this setting overwrites any height value', MOKAINE_THEME_NAME )                        
            ),    
            array(
                'name' => __( 'Autoplay', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_autoplay',
                'type' => 'text_small',
                'description' => __( 'Ms (milliseconds) value (e.g. type &quot;5000&quot; for 5 seconds). Leave it blank to disable autoplay', MOKAINE_THEME_NAME ),
                //'default' => '5000',
                'attributes' => array(
                    'type' => 'number',
                    'step' => 100,
                    'pattern' => '\d*',                    
                )                                         
            ),   
            array(
                'name' => __( 'Show arrows', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_navigation',
                'type' => 'checkbox',
                'description' => __( 'Arrows show up just in case intro has two or more slide', MOKAINE_THEME_NAME )                        
            ), 
            array(
                'name' => __( 'Show bullets', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_pagination',
                'type' => 'checkbox',
                'description' => __( 'Bullets show up just in case intro has two or more slide', MOKAINE_THEME_NAME )                        
            ), 
            array(
                'name' => __( 'Show scroll arrow', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_scroll_arrow',
                'type' => 'checkbox',
                'description' => __( 'Disabled if &lsquo;Show bullets&rsquo; is enabled', MOKAINE_THEME_NAME )                        
            ),   
            array(
                'name' => __( 'Darken layer', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_darken',
                'type' => 'checkbox',
                'description' => __( 'Enable to make images darker. It has no effect on &lsquo;Device mockup&rsquo; slides', MOKAINE_THEME_NAME )                        
            )                                                                                            
        )      
    );

    /* Featured image as intro on single posts */
    $meta_boxes['featured_as_intro'] = array(
        'id' => 'featured_as_intro',
        'title' => __( 'Intro settings', MOKAINE_THEME_NAME ),
        'object_types' => array_merge( $portfolio_cpt, array( 'post' ) ),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __( 'Use the Featured image as intro', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'set_featured_as_intro',
                'type' => 'checkbox',
                'description' => __( 'When checked, the featured image shows up into the intro area', MOKAINE_THEME_NAME )
            ),
            array(
                'name' => __( 'Full height', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_single_full_height',
                'type' => 'checkbox',
                'description' => __( 'Enable if you have a full page intro', MOKAINE_THEME_NAME )                        
            ),    
            array(
                'name' => __( 'Show scroll arrow', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_single_scroll_arrow',
                'type' => 'checkbox',
                'description' => __( 'Enable to show the mouse icon at the bottom of the intro', MOKAINE_THEME_NAME )                        
            ),   
            array(
                'name' => __( 'Darken layer', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'intro_single_darken',
                'type' => 'checkbox',
                'description' => __( 'Enable to make images darker', MOKAINE_THEME_NAME )                        
            )                                                                                            
        )      
    );

    /* Define Portfolio Template Columns & Style */
    $meta_boxes['layout_settings_portfolio'] = array(
        'id' => 'layout_settings_portfolio',
        'title' => __( 'Layout settings', MOKAINE_THEME_NAME ),
        'object_types' => array('page'),
        'show_on' => array( 'key' => 'page-template', 'value' => 'template-portfolio.php' ),
        'context' => 'side',
        'priority' => 'default',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __( 'Columns number', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'portfolio_columns_number',
                'type' => 'select',
                'description' => __( 'Select the number of column you wish to show', MOKAINE_THEME_NAME ),                        
                'default' => 'columns-3',
                'options' => array(
                    'columns-2' => __( '2 Columns', MOKAINE_THEME_NAME ),                    
                    'columns-3' => __( '3 Columns', MOKAINE_THEME_NAME ),
                    'columns-4' => __( '4 Columns', MOKAINE_THEME_NAME )                                                                         
                )
            ),
            array(
                'name' => __( 'Items per page', MOKAINE_THEME_NAME ),
                'description' => __( 'Set the number of items to show on portfolio pages. Type <strong>-1</strong> to disable pagination and show all items', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'items_per_page',
                'type' => 'text_small',
                'default' => '10',
                'attributes' => array(
                    'type' => 'number',
                    'step' => 1,
                    'pattern' => '\d*',
                )  
            ),   
            array(
                'name' => __( 'Mosaic layout', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'portfolio_mosaic',
                'type' => 'checkbox',
                'description' => __( 'Check to preserve thumbnails original height', MOKAINE_THEME_NAME )                        
            ),
            array(
                'name' => __( 'Lightbox', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'portfolio_lightbox',
                'type' => 'checkbox',
                'description' => __( 'Check to enable a lightbox gallery', MOKAINE_THEME_NAME )                        
            )                                                                                            
        )     
    );

    /* Define Blog Template Columns & Style */
    $meta_boxes['layout_settings_blog'] = array(
        'id' => 'layout_settings_blog',
        'title' => __( 'Layout settings', MOKAINE_THEME_NAME ),
        'object_types' => array('page'),
        'show_on' => array( 'key' => 'page-template', 'value' => 'template-blog.php' ),
        'context' => 'side',
        'priority' => 'default',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __( 'Blog style', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'blog_style',
                'type' => 'select',
                'description' => __( 'Select the style you want for this page', MOKAINE_THEME_NAME ),                        
                'default' => 'list-style',
                'options' => array(
                    'list-style' => __( 'List style', MOKAINE_THEME_NAME ),
                    'masonry-style' => __( 'Masonry style', MOKAINE_THEME_NAME )                                                                       
                )
            ),         
            array(
                'name' => __( 'Posts per page', MOKAINE_THEME_NAME ),
                'description' => __( 'Set the number of posts to show on blog pages. Type <strong>-1</strong> to disable pagination and show all posts', MOKAINE_THEME_NAME ),
                'id' => $prefix . 'posts_per_page',
                'type' => 'text_small',
                'default' => '8',
                'attributes' => array(
                    'type' => 'number',
                    'step' => 1,
                    'pattern' => '\d*',
                )   
            ),                                                                                          
        )     
    );

    /* Portfolio widgets */
    global $mokaine;

    $widget_field = array();

    if ( isset( $mokaine['portfolio-widgets'] ) && ! empty( $mokaine['portfolio-widgets'] ) ) {

        $widgets = $mokaine['portfolio-widgets'];

        foreach ( $widgets as $widget ) {

            $widget_slug = '_' . strtolower( trim( preg_replace('/[^A-Za-z0-9-]+/', '_', $widget ) ) );
            
            $widget_field[] =
                array(
                    'name' => $widget,
                    'id' => $prefix . 'portfolio_widgets' . $widget_slug,
                    'type' => 'wysiwyg',
                    'options' => array(
                        'wpautop' => false,
                        'media_buttons' => false,
                        'textarea_rows' => get_option('default_post_edit_rows', 3),
                        'teeny' => true,
                        'tinymce' => true
                    ),
                    'description' => __( 'If you leave it empty, the widget will not show up', MOKAINE_THEME_NAME )
                );

        }

    } else {

        $widget_field[] = 
            array(
                'desc' => __( 'You have not set any Portfolio sidebar widget yet. <a href="'. admin_url( 'admin.php?page=_options&tab=5' ) .'">Click here</a> to get started!', MOKAINE_THEME_NAME ),
                'type' => 'title',
                'id' => $prefix . 'test_title'
            );      

    }

    $meta_boxes['portfolio_widgets'] = array(
        'id' => 'portfolio_widgets',
        'title' => __( 'Portfolio sidebar widgets', MOKAINE_THEME_NAME ),
        'object_types' => $portfolio_cpt,
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array_merge(
            array(
                array(
                    'name' => __( 'Enable portfolio sidebar', MOKAINE_THEME_NAME ),
                    'id' => $prefix . 'sidebar_portfolio_post',
                    'type' => 'checkbox',
                    'description' => __( 'Enable to display the portfolio sidebar on this item', MOKAINE_THEME_NAME )
                )
            ),
            $widget_field
        )
    );    

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'config_metaboxes' );

/* See https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Adding-your-own-field-types#example-3-posts-or-other-post_type-dropdown-store-post_id */
function cmb_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type' => 'mokaine_intro',
        'posts_per_page' => -1
    ) );

    $intros = get_posts( $args );

    $intro_options = array();
    if ( $intros ) {
        foreach ( $intros as $intro ) {
           $intro_options[] = array(
               'name' => $intro->post_title,
               'value' => $intro->ID
           );
        }
    }

    // Set a new array for featured image
    $thumb_image = array(
        'name' => __( 'Use the Featured image', MOKAINE_THEME_NAME ),
        'value' => 'featured_image'
    );

    // Unshift array: http://php.net/manual/en/function.array-unshift.php
    array_unshift( $intro_options, $thumb_image );

    return $intro_options;
}