<?php

/** ---------------------------------------------------------
 * Register Portfolios
 */
function portfolio_register() {  
	
	$custom_slug = null;
			
	$args = array(
		'labels' => array(
		 	'name' => __( 'Portfolio', 'taxonomy general name', MOKAINE_THEME_NAME),
			'singular_name' => __( 'Portfolio Item', MOKAINE_THEME_NAME),
			'search_items' =>  __( 'Search Portfolio Items', MOKAINE_THEME_NAME),
			'all_items' => __( 'All Items', MOKAINE_THEME_NAME),
			'parent_item' => __( 'Parent Portfolio Item', MOKAINE_THEME_NAME),
			'edit_item' => __( 'Edit Portfolio Item', MOKAINE_THEME_NAME),
			'update_item' => __( 'Update Portfolio Item', MOKAINE_THEME_NAME),
			'add_new_item' => __( 'Add New Portfolio Item', MOKAINE_THEME_NAME)
		),
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-portfolio',
		'public' => true,
		'query_var' => true,
		'has_archive' => false,
		'exclude_from_search' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'tags', 'post-formats', 'comments' ),
		'rewrite' => array( 'slug' => $custom_slug, 'with_front' => false )
	);
  	
	register_post_type( 'portfolio', $args );
	
}  

add_action( 'init', 'portfolio_register' );

$attributes_labels = array(
	'name' => __( 'Item Tags', MOKAINE_THEME_NAME),
	'singular_name' => __( 'Item Tag', MOKAINE_THEME_NAME),
	'search_items' =>  __( 'Search Item Tags', MOKAINE_THEME_NAME),
	'all_items' => __( 'All Item Tags', MOKAINE_THEME_NAME),
	'parent_item' => __( 'Parent Item Tag', MOKAINE_THEME_NAME),
	'edit_item' => __( 'Edit Item Tag', MOKAINE_THEME_NAME),
	'update_item' => __( 'Update Item Tag', MOKAINE_THEME_NAME),
	'add_new_item' => __( 'Add New Item Tag', MOKAINE_THEME_NAME),
	'new_item_name' => __( 'New Item Tag', MOKAINE_THEME_NAME),
    'menu_name' => __( 'Item Tags', MOKAINE_THEME_NAME)
); 	

register_taxonomy( 'project-tags',
	array( 'portfolio' ),
	array('hierarchical' => true,
    'labels' => $attributes_labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'project-tags' )
));

/** ---------------------------------------------------------
 * Register Intro
 */
function intro_register() {  
    
	$labels = array(
	 	'name' => __( 'Intros', 'taxonomy general name', MOKAINE_THEME_NAME ),
		'singular_name' => __( 'Intro', MOKAINE_THEME_NAME ),
		'search_items' =>  __( 'Search Intros', MOKAINE_THEME_NAME ),
		'all_items' => __( 'All Intros', MOKAINE_THEME_NAME ),
		'parent_item' => __( 'Parent Intro', MOKAINE_THEME_NAME ),
		'edit_item' => __( 'Edit Intro', MOKAINE_THEME_NAME ),
		'update_item' => __( 'Update Intro', MOKAINE_THEME_NAME ),
		'add_new_item' => __( 'Add New Intro', MOKAINE_THEME_NAME ),
	    'menu_name' => __( 'Intro Composer', MOKAINE_THEME_NAME )
	 );
	 
	 $args = array(
			'labels' => $labels,
			'singular_label' => __( 'Intro', MOKAINE_THEME_NAME ),
			'public' => false,
			'show_ui' => true,
			'hierarchical' => false,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-slides',
			'exclude_from_search' => true,
			'supports' => 'title' 
       );  
   
    register_post_type( 'mokaine_intro' , $args );  
}  

add_action('init', 'intro_register'); 