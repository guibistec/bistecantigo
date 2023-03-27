<?php

/**
 * Functions to build the shortcode panel
 *
 * NOTES
 * ---------------------------------------------------------------
 * Shortcode arrays allow 4 different 'types':
 * 1) 'heading': outputs <optgroups>
 * 2) 'self_closing': outputs self closing shortcodes (e.g. [shortcode])
 * 3) 'enclosing': outputs enclosing shortcodes (e.g. [shortcode][/shortcode])
 * 4) 'custom': for custom shortcodes to be builded in mokaine-shortcode.js
 *
 * For outputting textarea/input content inside an enclosing shortcode, use 'content_inside' option inside 'attr'
 * ---------------------------------------------------------------
 *
 */

/** ---------------------------------------------------------
 * Enqueue scripts
 */

function enqueue_shortcodes_scripts() {

	wp_enqueue_style( 'mokaine-shortcode-css', get_template_directory_uri() . '/mokaine/shortcodes/includes/css/mokaine-shortcode.css' ); 
	wp_enqueue_style( 'chosen', get_template_directory_uri() . '/mokaine/shortcodes/includes/css/chosen/chosen.css' ); 
	wp_enqueue_style( 'noUi-Slider-css', get_template_directory_uri() . '/mokaine/shortcodes/includes/css/jquery.nouislider.css' ); 
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' ); 
	wp_enqueue_style( 'linecon', get_template_directory_uri() . '/css/linecon.css' );
		 
	wp_enqueue_script( 'chosen', get_template_directory_uri() . '/mokaine/shortcodes/includes/js/chosen.jquery.min.js','jquery','1.1.0 ', TRUE );
	wp_enqueue_script( 'noUi-Slider-js', get_template_directory_uri() . '/mokaine/shortcodes/includes/js/jquery.nouislider.all.js','jquery','7.0.9 ', TRUE );
	
	wp_enqueue_style( 'magnific', get_template_directory_uri() . '/mokaine/shortcodes/includes/css/magnific-popup.css' ); 
	wp_enqueue_script( 'magnific', get_template_directory_uri() . '/mokaine/shortcodes/includes/js/magnific-popup.js','jquery','0.9.7 ', TRUE );
	
	wp_enqueue_script( 'mokaine-shortcode-js', get_template_directory_uri() . '/mokaine/shortcodes/includes/js/mokaine-shortcode.js','jquery',MOKAINE_THEME_VERSION , TRUE );
	
}

add_action( 'admin_enqueue_scripts','enqueue_shortcodes_scripts' );


/** ---------------------------------------------------------
 * Shortcodes definitions
 */

function content_display() {
		
	$mokaine_shortcodes['header_sections'] = array( 
		'type' => 'heading', 
		'title' => __( 'Sections', MOKAINE_THEME_NAME )
	);

	$mokaine_shortcodes['section'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Full Width Section', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'background_color' => array(
				'type' => 'color',
				'title'  => __( 'Background color', MOKAINE_THEME_NAME )
			),
			'text_color' => array(
				'type' => 'select',
				'title' => __( 'Text color', MOKAINE_THEME_NAME ),
				'values' => array(
				    'dark' => 'Dark',
			  		'light' => 'Light'
				)			
			),
			'title' => array(
				'type' => 'text', 
				'title' => __( 'Section title', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),			
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'For better results, use <strong>Full Width Sections</strong> only on <strong>Blank page</strong> templates', MOKAINE_THEME_NAME )
			)					
		)
	);

	$mokaine_shortcodes['header_columns'] = array( 
		'type' => 'heading', 
		'title' => __( 'Columns', MOKAINE_THEME_NAME )
	);

	$mokaine_shortcodes['onehalf'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Half (1/2)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['onethird'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Third (1/3)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['twothirds'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Two Thirds (2/3)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['onefourth'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Fourth (1/4)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['threefourths'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Three Fourths (3/4)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['onesixth'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Sixth (1/6)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['fivesixths'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Five Sixth (5/6)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['onewhole'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Whole (1/1)', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', MOKAINE_THEME_NAME )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the column content', MOKAINE_THEME_NAME )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			),				
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)			
		)
	);

	$mokaine_shortcodes['header_elements'] = array( 
		'type' => 'heading', 
		'title' => __( 'Elements', MOKAINE_THEME_NAME )
	); 

	$mokaine_shortcodes['button'] = array( 
		'type' => 'self_closing',
		'title' => __( 'Button', MOKAINE_THEME_NAME ), 
		'attr' => array(
			'text' => array(
				'type' => 'text', 
				'title' => __( 'Button text', MOKAINE_THEME_NAME ),
				'default' => __( 'Button', MOKAINE_THEME_NAME )
			),	
			// 'size' => array(
			// 	'type' => 'radio', 
			// 	'title' => __( 'Size', MOKAINE_THEME_NAME ), 
			// 	'values' => array(
			// 		'small' => 'Small',
			// 		'medium' => 'Medium',
			// 		'large' => 'Large'
			// 	),
			// 	'default' => 'large'
			// ),	
			'url' => array(
				'type' => 'text', 
				'title' => __( 'Button link', MOKAINE_THEME_NAME )
			),
			'style' => array(
				'type' => 'select',
				'title' => __( 'Button style', MOKAINE_THEME_NAME ),
				'values' => array(
				    'solid' => __( 'Solid', MOKAINE_THEME_NAME ),
			  		'transparent' => __( 'Transparent', MOKAINE_THEME_NAME )
				)			
			),					
			'color' => array(
			    'type' => 'select',
			    'title' => __( 'Button color', MOKAINE_THEME_NAME ),
			    'values' => array(
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
			'open_new_tab' => array(
				'type' => 'checkbox', 
				'title' => __( 'Open link in a new tab?', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if you want to open the link in a new page', MOKAINE_THEME_NAME ),
				//'default' => 'on'			
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			)			
		) 
	);

	$fa_icons = array(
		'icon-glass' => 'icon-glass',
		'icon-music' => 'icon-music',
		'icon-search' => 'icon-search',
		'icon-envelope-o' => 'icon-envelope-o',
		'icon-heart' => 'icon-heart',
		'icon-star' => 'icon-star',
		'icon-star-o' => 'icon-star-o',
		'icon-user' => 'icon-user',
		'icon-film' => 'icon-film',
		'icon-th-large' => 'icon-th-large',
		'icon-th' => 'icon-th',
		'icon-th-list' => 'icon-th-list',
		'icon-check' => 'icon-check',
		'icon-remove' => 'icon-remove',
		'icon-search-plus' => 'icon-search-plus',
		'icon-search-minus' => 'icon-search-minus',
		'icon-power-off' => 'icon-power-off',
		'icon-signal' => 'icon-signal',
		'icon-cog' => 'icon-cog',
		'icon-trash-o' => 'icon-trash-o',
		'icon-home' => 'icon-home',
		'icon-file-o' => 'icon-file-o',
		'icon-clock-o' => 'icon-clock-o',
		'icon-road' => 'icon-road',
		'icon-download' => 'icon-download',
		'icon-arrow-circle-o-down' => 'icon-arrow-circle-o-down',
		'icon-arrow-circle-o-up' => 'icon-arrow-circle-o-up',
		'icon-inbox' => 'icon-inbox',
		'icon-play-circle-o' => 'icon-play-circle-o',
		'icon-repeat' => 'icon-repeat',
		'icon-refresh' => 'icon-refresh',
		'icon-list-alt' => 'icon-list-alt',
		'icon-lock' => 'icon-lock',
		'icon-flag' => 'icon-flag',
		'icon-headphones' => 'icon-headphones',
		'icon-volume-off' => 'icon-volume-off',
		'icon-volume-down' => 'icon-volume-down',
		'icon-volume-up' => 'icon-volume-up',
		'icon-qrcode' => 'icon-qrcode',
		'icon-barcode' => 'icon-barcode',
		'icon-tag' => 'icon-tag',
		'icon-tags' => 'icon-tags',
		'icon-book' => 'icon-book',
		'icon-bookmark' => 'icon-bookmark',
		'icon-print' => 'icon-print',
		'icon-camera' => 'icon-camera',
		'icon-font' => 'icon-font',
		'icon-bold' => 'icon-bold',
		'icon-italic' => 'icon-italic',
		'icon-text-height' => 'icon-text-height',
		'icon-text-width' => 'icon-text-width',
		'icon-align-left' => 'icon-align-left',
		'icon-align-center' => 'icon-align-center',
		'icon-align-right' => 'icon-align-right',
		'icon-align-justify' => 'icon-align-justify',
		'icon-list' => 'icon-list',
		'icon-outdent' => 'icon-outdent',
		'icon-indent' => 'icon-indent',
		'icon-video-camera' => 'icon-video-camera',
		'icon-image' => 'icon-image',
		'icon-pencil' => 'icon-pencil',
		'icon-map-marker' => 'icon-map-marker',
		'icon-adjust' => 'icon-adjust',
		'icon-tint' => 'icon-tint',
		'icon-edit' => 'icon-edit',
		'icon-share-square-o' => 'icon-share-square-o',
		'icon-check-square-o' => 'icon-check-square-o',
		'icon-arrows' => 'icon-arrows',
		'icon-step-backward' => 'icon-step-backward',
		'icon-fast-backward' => 'icon-fast-backward',
		'icon-backward' => 'icon-backward',
		'icon-play' => 'icon-play',
		'icon-pause' => 'icon-pause',
		'icon-stop' => 'icon-stop',
		'icon-forward' => 'icon-forward',
		'icon-fast-forward' => 'icon-fast-forward',
		'icon-step-forward' => 'icon-step-forward',
		'icon-eject' => 'icon-eject',
		'icon-chevron-left' => 'icon-chevron-left',
		'icon-chevron-right' => 'icon-chevron-right',
		'icon-plus-circle' => 'icon-plus-circle',
		'icon-minus-circle' => 'icon-minus-circle',
		'icon-times-circle' => 'icon-times-circle',
		'icon-check-circle' => 'icon-check-circle',
		'icon-question-circle' => 'icon-question-circle',
		'icon-info-circle' => 'icon-info-circle',
		'icon-crosshairs' => 'icon-crosshairs',
		'icon-times-circle-o' => 'icon-times-circle-o',
		'icon-check-circle-o' => 'icon-check-circle-o',
		'icon-ban' => 'icon-ban',
		'icon-arrow-left' => 'icon-arrow-left',
		'icon-arrow-right' => 'icon-arrow-right',
		'icon-arrow-up' => 'icon-arrow-up',
		'icon-arrow-down' => 'icon-arrow-down',
		'icon-share' => 'icon-share',
		'icon-expand' => 'icon-expand',
		'icon-compress' => 'icon-compress',
		'icon-plus' => 'icon-plus',
		'icon-minus' => 'icon-minus',
		'icon-asterisk' => 'icon-asterisk',
		'icon-exclamation-circle' => 'icon-exclamation-circle',
		'icon-gift' => 'icon-gift',
		'icon-leaf' => 'icon-leaf',
		'icon-fire' => 'icon-fire',
		'icon-eye' => 'icon-eye',
		'icon-eye-slash' => 'icon-eye-slash',
		'icon-warning' => 'icon-warning',
		'icon-plane' => 'icon-plane',
		'icon-calendar' => 'icon-calendar',
		'icon-random' => 'icon-random',
		'icon-comment' => 'icon-comment',
		'icon-magnet' => 'icon-magnet',
		'icon-chevron-up' => 'icon-chevron-up',
		'icon-chevron-down' => 'icon-chevron-down',
		'icon-retweet' => 'icon-retweet',
		'icon-shopping-cart' => 'icon-shopping-cart',
		'icon-folder' => 'icon-folder',
		'icon-folder-open' => 'icon-folder-open',
		'icon-arrows-v' => 'icon-arrows-v',
		'icon-arrows-h' => 'icon-arrows-h',
		'icon-bar-chart' => 'icon-bar-chart',
		'icon-twitter-square' => 'icon-twitter-square',
		'icon-facebook-square' => 'icon-facebook-square',
		'icon-camera-retro' => 'icon-camera-retro',
		'icon-key' => 'icon-key',
		'icon-cogs' => 'icon-cogs',
		'icon-comments' => 'icon-comments',
		'icon-thumbs-o-up' => 'icon-thumbs-o-up',
		'icon-thumbs-o-down' => 'icon-thumbs-o-down',
		'icon-star-half' => 'icon-star-half',
		'icon-heart-o' => 'icon-heart-o',
		'icon-sign-out' => 'icon-sign-out',
		'icon-linkedin-square' => 'icon-linkedin-square',
		'icon-thumb-tack' => 'icon-thumb-tack',
		'icon-external-link' => 'icon-external-link',
		'icon-sign-in' => 'icon-sign-in',
		'icon-trophy' => 'icon-trophy',
		'icon-github-square' => 'icon-github-square',
		'icon-upload' => 'icon-upload',
		'icon-lemon-o' => 'icon-lemon-o',
		'icon-phone' => 'icon-phone',
		'icon-square-o' => 'icon-square-o',
		'icon-bookmark-o' => 'icon-bookmark-o',
		'icon-phone-square' => 'icon-phone-square',
		'icon-twitter' => 'icon-twitter',
		'icon-facebook' => 'icon-facebook',
		'icon-github' => 'icon-github',
		'icon-unlock' => 'icon-unlock',
		'icon-credit-card' => 'icon-credit-card',
		'icon-rss' => 'icon-rss',
		'icon-hdd-o' => 'icon-hdd-o',
		'icon-bullhorn' => 'icon-bullhorn',
		'icon-bell' => 'icon-bell',
		'icon-certificate' => 'icon-certificate',
		'icon-hand-o-right' => 'icon-hand-o-right',
		'icon-hand-o-left' => 'icon-hand-o-left',
		'icon-hand-o-up' => 'icon-hand-o-up',
		'icon-hand-o-down' => 'icon-hand-o-down',
		'icon-arrow-circle-left' => 'icon-arrow-circle-left',
		'icon-arrow-circle-right' => 'icon-arrow-circle-right',
		'icon-arrow-circle-up' => 'icon-arrow-circle-up',
		'icon-arrow-circle-down' => 'icon-arrow-circle-down',
		'icon-globe' => 'icon-globe',
		'icon-wrench' => 'icon-wrench',
		'icon-tasks' => 'icon-tasks',
		'icon-filter' => 'icon-filter',
		'icon-briefcase' => 'icon-briefcase',
		'icon-arrows-alt' => 'icon-arrows-alt',
		'icon-group' => 'icon-group',
		'icon-link' => 'icon-link',
		'icon-cloud' => 'icon-cloud',
		'icon-flask' => 'icon-flask',
		'icon-cut' => 'icon-cut',
		'icon-copy' => 'icon-copy',
		'icon-paperclip' => 'icon-paperclip',
		'icon-save' => 'icon-save',
		'icon-square' => 'icon-square',
		'icon-reorder' => 'icon-reorder',
		'icon-list-ul' => 'icon-list-ul',
		'icon-list-ol' => 'icon-list-ol',
		'icon-strikethrough' => 'icon-strikethrough',
		'icon-underline' => 'icon-underline',
		'icon-table' => 'icon-table',
		'icon-magic' => 'icon-magic',
		'icon-truck' => 'icon-truck',
		'icon-pinterest' => 'icon-pinterest',
		'icon-pinterest-square' => 'icon-pinterest-square',
		'icon-google-plus-square' => 'icon-google-plus-square',
		'icon-google-plus' => 'icon-google-plus',
		'icon-money' => 'icon-money',
		'icon-caret-down' => 'icon-caret-down',
		'icon-caret-up' => 'icon-caret-up',
		'icon-caret-left' => 'icon-caret-left',
		'icon-caret-right' => 'icon-caret-right',
		'icon-columns' => 'icon-columns',
		'icon-sort' => 'icon-sort',
		'icon-sort-down' => 'icon-sort-down',
		'icon-sort-up' => 'icon-sort-up',
		'icon-envelope' => 'icon-envelope',
		'icon-linkedin' => 'icon-linkedin',
		'icon-undo' => 'icon-undo',
		'icon-legal' => 'icon-legal',
		'icon-dashboard' => 'icon-dashboard',
		'icon-comment-o' => 'icon-comment-o',
		'icon-comments-o' => 'icon-comments-o',
		'icon-bolt' => 'icon-bolt',
		'icon-sitemap' => 'icon-sitemap',
		'icon-umbrella' => 'icon-umbrella',
		'icon-paste' => 'icon-paste',
		'icon-lightbulb-o' => 'icon-lightbulb-o',
		'icon-exchange' => 'icon-exchange',
		'icon-cloud-download' => 'icon-cloud-download',
		'icon-cloud-upload' => 'icon-cloud-upload',
		'icon-user-md' => 'icon-user-md',
		'icon-stethoscope' => 'icon-stethoscope',
		'icon-suitcase' => 'icon-suitcase',
		'icon-bell-o' => 'icon-bell-o',
		'icon-coffee' => 'icon-coffee',
		'icon-cutlery' => 'icon-cutlery',
		'icon-file-text-o' => 'icon-file-text-o',
		'icon-building-o' => 'icon-building-o',
		'icon-hospital-o' => 'icon-hospital-o',
		'icon-ambulance' => 'icon-ambulance',
		'icon-medkit' => 'icon-medkit',
		'icon-fighter-jet' => 'icon-fighter-jet',
		'icon-beer' => 'icon-beer',
		'icon-h-square' => 'icon-h-square',
		'icon-plus-square' => 'icon-plus-square',
		'icon-angle-double-left' => 'icon-angle-double-left',
		'icon-angle-double-right' => 'icon-angle-double-right',
		'icon-angle-double-up' => 'icon-angle-double-up',
		'icon-angle-double-down' => 'icon-angle-double-down',
		'icon-angle-left' => 'icon-angle-left',
		'icon-angle-right' => 'icon-angle-right',
		'icon-angle-up' => 'icon-angle-up',
		'icon-angle-down' => 'icon-angle-down',
		'icon-desktop' => 'icon-desktop',
		'icon-laptop' => 'icon-laptop',
		'icon-tablet' => 'icon-tablet',
		'icon-mobile-phone' => 'icon-mobile-phone',
		'icon-circle-o' => 'icon-circle-o',
		'icon-quote-left' => 'icon-quote-left',
		'icon-quote-right' => 'icon-quote-right',
		'icon-spinner' => 'icon-spinner',
		'icon-circle' => 'icon-circle',
		'icon-reply' => 'icon-reply',
		'icon-github-alt' => 'icon-github-alt',
		'icon-folder-o' => 'icon-folder-o',
		'icon-folder-open-o' => 'icon-folder-open-o',
		'icon-smile-o' => 'icon-smile-o',
		'icon-frown-o' => 'icon-frown-o',
		'icon-meh-o' => 'icon-meh-o',
		'icon-gamepad' => 'icon-gamepad',
		'icon-keyboard-o' => 'icon-keyboard-o',
		'icon-flag-o' => 'icon-flag-o',
		'icon-flag-checkered' => 'icon-flag-checkered',
		'icon-terminal' => 'icon-terminal',
		'icon-code' => 'icon-code',
		'icon-reply-all' => 'icon-reply-all',
		'icon-star-half-o' => 'icon-star-half-o',
		'icon-location-arrow' => 'icon-location-arrow',
		'icon-crop' => 'icon-crop',
		'icon-code-fork' => 'icon-code-fork',
		'icon-unlink' => 'icon-unlink',
		'icon-question' => 'icon-question',
		'icon-info' => 'icon-info',
		'icon-exclamation' => 'icon-exclamation',
		'icon-superscript' => 'icon-superscript',
		'icon-subscript' => 'icon-subscript',
		'icon-eraser' => 'icon-eraser',
		'icon-puzzle-piece' => 'icon-puzzle-piece',
		'icon-microphone' => 'icon-microphone',
		'icon-microphone-slash' => 'icon-microphone-slash',
		'icon-shield' => 'icon-shield',
		'icon-calendar-o' => 'icon-calendar-o',
		'icon-fire-extinguisher' => 'icon-fire-extinguisher',
		'icon-rocket' => 'icon-rocket',
		'icon-maxcdn' => 'icon-maxcdn',
		'icon-chevron-circle-left' => 'icon-chevron-circle-left',
		'icon-chevron-circle-right' => 'icon-chevron-circle-right',
		'icon-chevron-circle-up' => 'icon-chevron-circle-up',
		'icon-chevron-circle-down' => 'icon-chevron-circle-down',
		'icon-html5' => 'icon-html5',
		'icon-css3' => 'icon-css3',
		'icon-anchor' => 'icon-anchor',
		'icon-unlock-alt' => 'icon-unlock-alt',
		'icon-bullseye' => 'icon-bullseye',
		'icon-ellipsis-h' => 'icon-ellipsis-h',
		'icon-ellipsis-v' => 'icon-ellipsis-v',
		'icon-rss-square' => 'icon-rss-square',
		'icon-play-circle' => 'icon-play-circle',
		'icon-ticket' => 'icon-ticket',
		'icon-minus-square' => 'icon-minus-square',
		'icon-minus-square-o' => 'icon-minus-square-o',
		'icon-level-up' => 'icon-level-up',
		'icon-level-down' => 'icon-level-down',
		'icon-check-square' => 'icon-check-square',
		'icon-pencil-square' => 'icon-pencil-square',
		'icon-external-link-square' => 'icon-external-link-square',
		'icon-share-square' => 'icon-share-square',
		'icon-compass' => 'icon-compass',
		'icon-toggle-down' => 'icon-toggle-down',
		'icon-toggle-up' => 'icon-toggle-up',
		'icon-toggle-right' => 'icon-toggle-right',
		'icon-eur' => 'icon-eur',
		'icon-gbp' => 'icon-gbp',
		'icon-usd' => 'icon-usd',
		'icon-inr' => 'icon-inr',
		'icon-jpy' => 'icon-jpy',
		'icon-rub' => 'icon-rub',
		'icon-krw' => 'icon-krw',
		'icon-btc' => 'icon-btc',
		'icon-file' => 'icon-file',
		'icon-file-text' => 'icon-file-text',
		'icon-sort-alpha-asc' => 'icon-sort-alpha-asc',
		'icon-sort-alpha-desc' => 'icon-sort-alpha-desc',
		'icon-sort-amount-asc' => 'icon-sort-amount-asc',
		'icon-sort-amount-desc' => 'icon-sort-amount-desc',
		'icon-sort-numeric-asc' => 'icon-sort-numeric-asc',
		'icon-sort-numeric-desc' => 'icon-sort-numeric-desc',
		'icon-thumbs-up' => 'icon-thumbs-up',
		'icon-thumbs-down' => 'icon-thumbs-down',
		'icon-youtube-square' => 'icon-youtube-square',
		'icon-youtube' => 'icon-youtube',
		'icon-xing' => 'icon-xing',
		'icon-xing-square' => 'icon-xing-square',
		'icon-youtube-play' => 'icon-youtube-play',
		'icon-dropbox' => 'icon-dropbox',
		'icon-stack-overflow' => 'icon-stack-overflow',
		'icon-instagram' => 'icon-instagram',
		'icon-flickr' => 'icon-flickr',
		'icon-adn' => 'icon-adn',
		'icon-bitbucket' => 'icon-bitbucket',
		'icon-bitbucket-square' => 'icon-bitbucket-square',
		'icon-tumblr' => 'icon-tumblr',
		'icon-tumblr-square' => 'icon-tumblr-square',
		'icon-long-arrow-down' => 'icon-long-arrow-down',
		'icon-long-arrow-up' => 'icon-long-arrow-up',
		'icon-long-arrow-left' => 'icon-long-arrow-left',
		'icon-long-arrow-right' => 'icon-long-arrow-right',
		'icon-apple' => 'icon-apple',
		'icon-windows' => 'icon-windows',
		'icon-android' => 'icon-android',
		'icon-linux' => 'icon-linux',
		'icon-dribbble' => 'icon-dribbble',
		'icon-skype' => 'icon-skype',
		'icon-foursquare' => 'icon-foursquare',
		'icon-trello' => 'icon-trello',
		'icon-female' => 'icon-female',
		'icon-male' => 'icon-male',
		'icon-gittip' => 'icon-gittip',
		'icon-sun-o' => 'icon-sun-o',
		'icon-moon-o' => 'icon-moon-o',
		'icon-archive' => 'icon-archive',
		'icon-bug' => 'icon-bug',
		'icon-vk' => 'icon-vk',
		'icon-weibo' => 'icon-weibo',
		'icon-renren' => 'icon-renren',
		'icon-pagelines' => 'icon-pagelines',
		'icon-stack-exchange' => 'icon-stack-exchange',
		'icon-arrow-circle-o-right' => 'icon-arrow-circle-o-right',
		'icon-arrow-circle-o-left' => 'icon-arrow-circle-o-left',
		'icon-toggle-left' => 'icon-toggle-left',
		'icon-dot-circle-o' => 'icon-dot-circle-o',
		'icon-wheelchair' => 'icon-wheelchair',
		'icon-vimeo-square' => 'icon-vimeo-square',
		'icon-try' => 'icon-try',
		'icon-plus-square-o' => 'icon-plus-square-o',
		'icon-space-shuttle' => 'icon-space-shuttle',
		'icon-slack' => 'icon-slack',
		'icon-envelope-square' => 'icon-envelope-square',
		'icon-wordpress' => 'icon-wordpress',
		'icon-openid' => 'icon-openid',
		'icon-institution' => 'icon-institution',
		'icon-mortar-board' => 'icon-mortar-board',
		'icon-yahoo' => 'icon-yahoo',
		'icon-google' => 'icon-google',
		'icon-reddit' => 'icon-reddit',
		'icon-reddit-square' => 'icon-reddit-square',
		'icon-stumbleupon-circle' => 'icon-stumbleupon-circle',
		'icon-stumbleupon' => 'icon-stumbleupon',
		'icon-delicious' => 'icon-delicious',
		'icon-digg' => 'icon-digg',
		'icon-pied-piper' => 'icon-pied-piper',
		'icon-pied-piper-alt' => 'icon-pied-piper-alt',
		'icon-drupal' => 'icon-drupal',
		'icon-joomla' => 'icon-joomla',
		'icon-language' => 'icon-language',
		'icon-fax' => 'icon-fax',
		'icon-building' => 'icon-building',
		'icon-child' => 'icon-child',
		'icon-paw' => 'icon-paw',
		'icon-spoon' => 'icon-spoon',
		'icon-cube' => 'icon-cube',
		'icon-cubes' => 'icon-cubes',
		'icon-behance' => 'icon-behance',
		'icon-behance-square' => 'icon-behance-square',
		'icon-steam' => 'icon-steam',
		'icon-steam-square' => 'icon-steam-square',
		'icon-recycle' => 'icon-recycle',
		'icon-car' => 'icon-car',
		'icon-cab' => 'icon-cab',
		'icon-tree' => 'icon-tree',
		'icon-spotify' => 'icon-spotify',
		'icon-deviantart' => 'icon-deviantart',
		'icon-soundcloud' => 'icon-soundcloud',
		'icon-database' => 'icon-database',
		'icon-file-pdf-o' => 'icon-file-pdf-o',
		'icon-file-word-o' => 'icon-file-word-o',
		'icon-file-excel-o' => 'icon-file-excel-o',
		'icon-file-powerpoint-o' => 'icon-file-powerpoint-o',
		'icon-file-photo-o' => 'icon-file-photo-o',
		'icon-file-zip-o' => 'icon-file-zip-o',
		'icon-file-sound-o' => 'icon-file-sound-o',
		'icon-file-movie-o' => 'icon-file-movie-o',
		'icon-file-code-o' => 'icon-file-code-o',
		'icon-vine' => 'icon-vine',
		'icon-codepen' => 'icon-codepen',
		'icon-jsfiddle' => 'icon-jsfiddle',
		'icon-support' => 'icon-support',
		'icon-circle-o-notch' => 'icon-circle-o-notch',
		'icon-ra' => 'icon-ra',
		'icon-ge' => 'icon-ge',
		'icon-git-square' => 'icon-git-square',
		'icon-git' => 'icon-git',
		'icon-hacker-news' => 'icon-hacker-news',
		'icon-tencent-weibo' => 'icon-tencent-weibo',
		'icon-qq' => 'icon-qq',
		'icon-wechat' => 'icon-wechat',
		'icon-send' => 'icon-send',
		'icon-send-o' => 'icon-send-o',
		'icon-history' => 'icon-history',
		'icon-circle-thin' => 'icon-circle-thin',
		'icon-header' => 'icon-header',
		'icon-paragraph' => 'icon-paragraph',
		'icon-sliders' => 'icon-sliders',
		'icon-share-alt' => 'icon-share-alt',
		'icon-share-alt-square' => 'icon-share-alt-square',
		'icon-bomb' => 'icon-bomb',
		'icon-soccer-ball-o' => 'icon-soccer-ball-o',
		'icon-tty' => 'icon-tty',
		'icon-binoculars' => 'icon-binoculars',
		'icon-plug' => 'icon-plug',
		'icon-slideshare' => 'icon-slideshare',
		'icon-twitch' => 'icon-twitch',
		'icon-yelp' => 'icon-yelp',
		'icon-newspaper-o' => 'icon-newspaper-o',
		'icon-wifi' => 'icon-wifi',
		'icon-calculator' => 'icon-calculator',
		'icon-paypal' => 'icon-paypal',
		'icon-google-wallet' => 'icon-google-wallet',
		'icon-cc-visa' => 'icon-cc-visa',
		'icon-cc-mastercard' => 'icon-cc-mastercard',
		'icon-cc-discover' => 'icon-cc-discover',
		'icon-cc-amex' => 'icon-cc-amex',
		'icon-cc-paypal' => 'icon-cc-paypal',
		'icon-cc-stripe' => 'icon-cc-stripe',
		'icon-bell-slash' => 'icon-bell-slash',
		'icon-bell-slash-o' => 'icon-bell-slash-o',
		'icon-trash' => 'icon-trash',
		'icon-copyright' => 'icon-copyright',
		'icon-at' => 'icon-at',
		'icon-eyedropper' => 'icon-eyedropper',
		'icon-paint-brush' => 'icon-paint-brush',
		'icon-birthday-cake' => 'icon-birthday-cake',
		'icon-area-chart' => 'icon-area-chart',
		'icon-pie-chart' => 'icon-pie-chart',
		'icon-line-chart' => 'icon-line-chart',
		'icon-lastfm' => 'icon-lastfm',
		'icon-lastfm-square' => 'icon-lastfm-square',
		'icon-toggle-off' => 'icon-toggle-off',
		'icon-toggle-on' => 'icon-toggle-on',
		'icon-bicycle' => 'icon-bicycle',
		'icon-bus' => 'icon-bus',
		'icon-ioxhost' => 'icon-ioxhost',
		'icon-angellist' => 'icon-angellist',
		'icon-cc' => 'icon-cc',
		'icon-shekel' => 'icon-shekel',
		'icon-meanpath' => 'icon-meanpath'
	);

	$linecons = array(
		'linecon-icon-images' => 'linecon-icon-images',
		'linecon-icon-arrow-up' => 'linecon-icon-arrow-up',
		'linecon-icon-arrow-right' => 'linecon-icon-arrow-right',
		'linecon-icon-arrow-left' => 'linecon-icon-arrow-left',
		'linecon-icon-arrow-down' => 'linecon-icon-arrow-down',
		'linecon-icon-search' => 'linecon-icon-search',
		'linecon-icon-camera' => 'linecon-icon-camera',
		'linecon-icon-video' => 'linecon-icon-video',
		'linecon-icon-picture' => 'linecon-icon-picture',
		'linecon-icon-gallery' => 'linecon-icon-gallery',
		'linecon-icon-home' => 'linecon-icon-home',
		'linecon-icon-outline-left-arrow' => 'linecon-icon-outline-left-arrow',
		'linecon-icon-outline-left-dir' => 'linecon-icon-outline-left-dir',
		'linecon-icon-outline-left-right-arrow' => 'linecon-icon-outline-left-right-arrow',
		'linecon-icon-outline-right-arrow' => 'linecon-icon-outline-right-arrow',
		'linecon-icon-outline-right-dir' => 'linecon-icon-outline-right-dir',
		'linecon-icon-outline-enlarge' => 'linecon-icon-outline-enlarge',
		'linecon-icon-outline-close' => 'linecon-icon-outline-close',
		'linecon-icon-multiview' => 'linecon-icon-multiview',
		'linecon-icon-load' => 'linecon-icon-load',
		'linecon-icon-link-two' => 'linecon-icon-link-two',
		'linecon-icon-link-one' => 'linecon-icon-link-one',
		'linecon-icon-reload' => 'linecon-icon-reload',
		'linecon-icon-user' => 'linecon-icon-user',
		'linecon-icon-users' => 'linecon-icon-users',
		'linecon-icon-vertical-tag' => 'linecon-icon-vertical-tag',
		'linecon-icon-checked' => 'linecon-icon-checked',
		'linecon-icon-clip' => 'linecon-icon-clip',
		'linecon-icon-download' => 'linecon-icon-download',
		'linecon-icon-equalizer' => 'linecon-icon-equalizer',
		'linecon-icon-flag' => 'linecon-icon-flag',
		'linecon-icon-gear' => 'linecon-icon-gear',
		'linecon-icon-outline-menu' => 'linecon-icon-outline-menu',
		'linecon-icon-horizontal-tag' => 'linecon-icon-horizontal-tag',
		'linecon-icon-archive' => 'linecon-icon-archive',
		'linecon-icon-bag' => 'linecon-icon-bag',
		'linecon-icon-battery-25' => 'linecon-icon-battery-25',
		'linecon-icon-battery-50' => 'linecon-icon-battery-50',
		'linecon-icon-battery-75' => 'linecon-icon-battery-75',
		'linecon-icon-battery-charged' => 'linecon-icon-battery-charged',
		'linecon-icon-battery-dead' => 'linecon-icon-battery-dead',
		'linecon-icon-bin' => 'linecon-icon-bin',
		'linecon-icon-brush' => 'linecon-icon-brush',
		'linecon-icon-connections' => 'linecon-icon-connections',
		'linecon-icon-compass' => 'linecon-icon-compass',
		'linecon-icon-comments' => 'linecon-icon-comments',
		'linecon-icon-comment-two' => 'linecon-icon-comment-two',
		'linecon-icon-comment-one' => 'linecon-icon-comment-one',
		'linecon-icon-clock' => 'linecon-icon-clock',
		'linecon-icon-cart' => 'linecon-icon-cart',
		'linecon-icon-calendar' => 'linecon-icon-calendar',
		'linecon-icon-calc' => 'linecon-icon-calc',
		'linecon-icon-bulb' => 'linecon-icon-bulb',
		'linecon-icon-crown' => 'linecon-icon-crown',
		'linecon-icon-cup' => 'linecon-icon-cup',
		'linecon-icon-diamond' => 'linecon-icon-diamond',
		'linecon-icon-doc' => 'linecon-icon-doc',
		'linecon-icon-email' => 'linecon-icon-email',
		'linecon-icon-eye' => 'linecon-icon-eye',
		'linecon-icon-film' => 'linecon-icon-film',
		'linecon-icon-flame' => 'linecon-icon-flame',
		'linecon-icon-flash' => 'linecon-icon-flash',
		'linecon-icon-folder' => 'linecon-icon-folder',
		'linecon-icon-map' => 'linecon-icon-map',
		'linecon-icon-lock' => 'linecon-icon-lock',
		'linecon-icon-inbox' => 'linecon-icon-inbox',
		'linecon-icon-heart' => 'linecon-icon-heart',
		'linecon-icon-graph' => 'linecon-icon-graph',
		'linecon-icon-globe' => 'linecon-icon-globe',
		'linecon-icon-money' => 'linecon-icon-money',
		'linecon-icon-news' => 'linecon-icon-news',
		'linecon-icon-phone-one' => 'linecon-icon-phone-one',
		'linecon-icon-phone-two' => 'linecon-icon-phone-two',
		'linecon-icon-pin' => 'linecon-icon-pin',
		'linecon-icon-pocket' => 'linecon-icon-pocket',
		'linecon-icon-wifi' => 'linecon-icon-wifi',
		'linecon-icon-unlock' => 'linecon-icon-unlock',
		'linecon-icon-scissors' => 'linecon-icon-scissors',
		'linecon-icon-scroll' => 'linecon-icon-scroll',
		'linecon-icon-stamp' => 'linecon-icon-stamp',
		'linecon-icon-star' => 'linecon-icon-star',
		'linecon-icon-target' => 'linecon-icon-target',
		'linecon-icon-tshirt' => 'linecon-icon-tshirt',
		'linecon-icon-tumbler' => 'linecon-icon-tumbler',
		'linecon-icon-pencil' => 'linecon-icon-pencil',
		'linecon-icon-paperfly' => 'linecon-icon-paperfly',
		'linecon-icon-control-eject' => 'linecon-icon-control-eject',
		'linecon-icon-control-fastforward' => 'linecon-icon-control-fastforward',
		'linecon-icon-control-next' => 'linecon-icon-control-next',
		'linecon-icon-control-pause' => 'linecon-icon-control-pause',
		'linecon-icon-control-play' => 'linecon-icon-control-play',
		'linecon-icon-cassette' => 'linecon-icon-cassette',
		'linecon-icon-control-prev' => 'linecon-icon-control-prev',
		'linecon-icon-control-rec' => 'linecon-icon-control-rec',
		'linecon-icon-control-rewind' => 'linecon-icon-control-rewind',
		'linecon-icon-control-shuffle' => 'linecon-icon-control-shuffle',
		'linecon-icon-control-stop' => 'linecon-icon-control-stop',
		'linecon-icon-crop' => 'linecon-icon-crop',
		'linecon-icon-desktop' => 'linecon-icon-desktop',
		'linecon-icon-disk' => 'linecon-icon-disk',
		'linecon-icon-headphones' => 'linecon-icon-headphones',
		'linecon-icon-laptop' => 'linecon-icon-laptop',
		'linecon-icon-layout' => 'linecon-icon-layout',
		'linecon-icon-leaf' => 'linecon-icon-leaf',
		'linecon-icon-microphone' => 'linecon-icon-microphone',
		'linecon-icon-megaphone' => 'linecon-icon-megaphone',
		'linecon-icon-music' => 'linecon-icon-music',
		'linecon-icon-speaker-on' => 'linecon-icon-speaker-on',
		'linecon-icon-speaker-off' => 'linecon-icon-speaker-off',
		'linecon-icon-smartphone' => 'linecon-icon-smartphone',
		'linecon-icon-select' => 'linecon-icon-select',
		'linecon-icon-resize' => 'linecon-icon-resize',
		'linecon-icon-umbrella' => 'linecon-icon-umbrella',
		'linecon-icon-weather-changeable' => 'linecon-icon-weather-changeable',
		'linecon-icon-weather-cloudy' => 'linecon-icon-weather-cloudy',
		'linecon-icon-weather-rainy' => 'linecon-icon-weather-rainy',
		'linecon-icon-weather-snowy' => 'linecon-icon-weather-snowy',
		'linecon-icon-weather-stormy' => 'linecon-icon-weather-stormy',
		'linecon-icon-weather-sunny' => 'linecon-icon-weather-sunny',	
		'linecon-icon-tablet' => 'linecon-icon-tablet',
		'linecon-icon-arrow-down-simple' => 'linecon-icon-arrow-down-simple',
		'linecon-icon-arrow-left-simple' => 'linecon-icon-arrow-left-simple',
		'linecon-icon-arrow-right-simple' => 'linecon-icon-arrow-right-simple',
		'linecon-icon-arrow-up-simple' => 'linecon-icon-arrow-up-simple',		
		'linecon-icon-close' => 'linecon-icon-close',
		'linecon-icon-plus' => 'linecon-icon-plus'	  
	);

	$mokaine_shortcodes['icon'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Icon', MOKAINE_THEME_NAME ), 
		'attr' => array(
			'color' => array(
			    'type' => 'select',
			    'title' => __( 'Icon color', MOKAINE_THEME_NAME ),
			    'values' => array(
			    	'none' => __( 'None', MOKAINE_THEME_NAME ),
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
			'type' => array(
				'type' => 'icon', 
				'title' => __( 'Icon set', MOKAINE_THEME_NAME ),
				'values' => array(
					'fa-icons' => array(
						'title' => __( 'Font Awesome', MOKAINE_THEME_NAME ),
						'iconopt' => $fa_icons
					),
					'linecons'  => array(
						'title' => __( 'Linecons', MOKAINE_THEME_NAME ),
						'iconopt' => $linecons
					)
				)
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			)
		) 
	);

	$mokaine_shortcodes['cta'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'CTA - Call To Action', MOKAINE_THEME_NAME ), 
		'disabled' => true,
		'attr' => array( 
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'CTA slogan', MOKAINE_THEME_NAME ),
				'default' => __( 'Introducing Beetle, a new flat WordPress theme.', MOKAINE_THEME_NAME )
			),
			'button_text' => array(
				'type' => 'text', 
				'title' => __( 'Button text', MOKAINE_THEME_NAME ),
				'default' => __( 'Button', MOKAINE_THEME_NAME )
			),
			'button_url' => array(
				'type' => 'text', 
				'title' => __( 'Button link', MOKAINE_THEME_NAME )
			),
			'button_style' => array(
				'type' => 'select',
				'title' => __( 'Button style', MOKAINE_THEME_NAME ),
				'values' => array(
				    'solid' => __( 'Solid', MOKAINE_THEME_NAME ),
			  		'transparent' => __( 'Transparent', MOKAINE_THEME_NAME )
				)
			),	
			'button_color' => array(
			    'type' => 'select',
			    'title' => __( 'Button color', MOKAINE_THEME_NAME ),
			    'values' => array(
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
			'open_new_tab' => array(
				'type' => 'checkbox', 
				'title' => __( 'Open link in a new tab?', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if you want to open the link in a new page', MOKAINE_THEME_NAME )
			),
			'animation' => array(
				'type' => 'checkbox', 
				'title' => __( 'Enable animation', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to enable a reveal animation', MOKAINE_THEME_NAME )
			)					
		)
	);

	$mokaine_shortcodes['slogan'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Slogan', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array(
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),
			'title' => array(
				'type' => 'text', 
				'title' => __( 'Title', MOKAINE_THEME_NAME ),
				'default' => __( 'A title for your slogan', MOKAINE_THEME_NAME )
			),		
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Content', MOKAINE_THEME_NAME ),
				'default' => __( 'Introducing Beetle, a new flat WordPress theme.', MOKAINE_THEME_NAME )
			),
			'animation' => array(
				'type' => 'checkbox', 
				'title' => __( 'Enable animation', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to enable a reveal animation', MOKAINE_THEME_NAME )
			)			
		)
	);

	$mokaine_shortcodes['skills_ring'] = array( 
		'type' =>'self_closing', 
		'title' => __( 'Skills ring', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array( 
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),
			'percent' => array(
				'type' => 'percent',
				'desc' => __( 'The percent number of your ring (from 1 to 100)', MOKAINE_THEME_NAME ),
				'title' => __( 'Percent', MOKAINE_THEME_NAME )
			),
			'label' => array(
				'type' => 'text',
				'desc' => __( 'The label to display under the number', MOKAINE_THEME_NAME ),
				'title' => __( 'Ring label', MOKAINE_THEME_NAME )
			),
			'color' => array(
				'type' => 'color',
				'title'  => __( 'Ring color', MOKAINE_THEME_NAME )
			),
			'animation_time' => array(
				'type' => 'text', 
				'title' => __( 'Animation time', MOKAINE_THEME_NAME ),
				'desc' => __( 'The number of milliseconds it should take to finish counting (e.g. type "2000" for 2 seconds)', MOKAINE_THEME_NAME ),
				'default' => 2000
			)
		)
	);	

	$mokaine_shortcodes['milestone'] = array( 
		'type' =>'self_closing', 
		'title' => __( 'Milestone', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array( 
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),
			'label' => array(
				'type' => 'text',
				'desc' => __( 'The label to show under the number', MOKAINE_THEME_NAME ),
				'title' => __( 'Label', MOKAINE_THEME_NAME ),
				'default' => __( 'Visitors', MOKAINE_THEME_NAME ),
			),			
			'count_from' => array(
				'type' => 'text',
				'desc' => __( 'The number to start counting from', MOKAINE_THEME_NAME ),
				'title' => __( 'Start number', MOKAINE_THEME_NAME ),
				'default' => 0
			),
			'count_to' => array(
				'type' => 'text',
				'desc' => __( 'The number to stop counting at', MOKAINE_THEME_NAME ),
				'title' => __( 'End number', MOKAINE_THEME_NAME ),
				'default' => 750
			),
			'animation_time' => array(
				'type' => 'text', 
				'title' => __( 'Animation time', MOKAINE_THEME_NAME ),
				'desc' => __( 'The number of milliseconds it should take to finish counting (e.g. type "2000" for 2 seconds)', MOKAINE_THEME_NAME ),
				'default' => 2000
			),
			'refresh_interval' => array(
				'type' => 'text', 
				'title' => __( 'Refresh interval', MOKAINE_THEME_NAME ),
				'desc' => __( 'The number of milliseconds to wait between refreshing the counter', MOKAINE_THEME_NAME ),
				'default' => 25
			),					
			'icon_color' => array(
			    'type' => 'select',
			    'title' => __( 'Icon color', MOKAINE_THEME_NAME ),
			    'values' => array(
			    	'none' => __( 'None', MOKAINE_THEME_NAME ),
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
			'icon_type' => array(
				'type' => 'icon', 
				'title' => __( 'Icon set', MOKAINE_THEME_NAME ),
				'values' => array(
					'fa-icons' => array(
						'title' => __( 'Font Awesome', MOKAINE_THEME_NAME ),
						'iconopt' => $fa_icons
					),
					'linecons'  => array(
						'title' => __( 'Linecons', MOKAINE_THEME_NAME ),
						'iconopt' => $linecons
					)
				)
			)
		)
	);	

	$mokaine_shortcodes['service'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Service', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'icon_size' => array(
				'type' => 'radio', 
				'title' => __( 'Icon size', MOKAINE_THEME_NAME ), 
				'values' => array(
					'small' => __( 'Small', MOKAINE_THEME_NAME ), 
					'big' => __( 'Big', MOKAINE_THEME_NAME )
				),
				'default' => 'small'
			), 	
			'icon_color' => array(
			    'type' => 'select',
			    'title' => __( 'Icon color', MOKAINE_THEME_NAME ),
			    'values' => array(
			    	'none' => __( 'None', MOKAINE_THEME_NAME ),
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
			'icon_type' => array(
				'type' => 'icon', 
				'title' => __( 'Icon set', MOKAINE_THEME_NAME ),
				'values' => array(
					'fa-icons' => array(
						'title' => __( 'Font Awesome', MOKAINE_THEME_NAME ),
						'iconopt' => $fa_icons
					),
					'linecons'  => array(
						'title' => __( 'Linecons', MOKAINE_THEME_NAME ),
						'iconopt' => $linecons
					)
				)
			),
			'title' => array(
				'type' => 'text',
				'title' => __( 'Title', MOKAINE_THEME_NAME )
			),
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Content', MOKAINE_THEME_NAME )
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'For better results, we recommend to nest each <strong>service</strong> element into <strong>columns</strong> shortcodes.', MOKAINE_THEME_NAME )
			)		
		)
	);

	$mokaine_shortcodes['team_member'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Team Member', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'image_url' => array(
				'type' => 'image',
				'title' => __( 'Image', MOKAINE_THEME_NAME ),
				'desc' => __( 'Min. recommended size: 320x320px', MOKAINE_THEME_NAME )
			),
			'name' => array(
				'type' => 'text',
				'title' => __( 'Name', MOKAINE_THEME_NAME )
			),
			'role' => array(
				'type' => 'text',
				'title' => __( 'Role', MOKAINE_THEME_NAME )
			),
			'social' => array(
				'type' => 'textarea',
				'title' => __( 'Social buttons', MOKAINE_THEME_NAME ),
				'desc' => __( 'Enter any social media links with a comma separated list (e.g. Facebook,http://facebook.com, Twitter,http://twitter.com)', MOKAINE_THEME_NAME )
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'For better results, we recommend to nest each <strong>team member</strong> items into <strong>columns</strong> shortcodes.', MOKAINE_THEME_NAME )
			)
		)
	);

	$mokaine_shortcodes['map'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Map', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'latitude' => array(
				'type' => 'text',
				'title'  => __( 'Map Latitude', MOKAINE_THEME_NAME ),
				'desc' => __( 'Set the latitude (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', MOKAINE_THEME_NAME ),
				'default' => 40.714353
			),
			'longitude' => array(
				'type' => 'text',
				'title'  => __( 'Map Longitude', MOKAINE_THEME_NAME ),
				'desc' => __( 'Set the longitude (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', MOKAINE_THEME_NAME ),
				'default' => -74.005973
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'Don&lsquo;t leave latitude and longitude empty or the map does not show up', MOKAINE_THEME_NAME )
			),	
			'zoom' => array(
				'type' => 'text',
				'title' => __( 'Map zoom level', MOKAINE_THEME_NAME ),
				'desc' => __( 'The initial resolution at which to display the map', MOKAINE_THEME_NAME ),
				'default' => 3
			),	
			'style' => array(
				'type' => 'select',
				'title' => __( 'Map style', MOKAINE_THEME_NAME ),
				'desc' => __( 'Choose a style preset for your map', MOKAINE_THEME_NAME ),                        
				'values' => array(
	                'default' => __( 'Default', MOKAINE_THEME_NAME ),
	                'invert' => __( 'Reversed colors', MOKAINE_THEME_NAME ) 
				)			
			),
			'height' => array(
				'type' => 'text',
				'title'  => __( 'Map height', MOKAINE_THEME_NAME ),
				'desc' => __( 'Map height in em', MOKAINE_THEME_NAME ),
				'default' => 22.222
			),
			'marker' => array(
				'type' => 'image',
				'title' => __( 'Image marker', MOKAINE_THEME_NAME ),
	            'desc' => __( 'Set a different image for the marker. Default marker URL:<br><strong>' . get_template_directory_uri() . '/mokaine/includes/img/marker-red.png</strong>', MOKAINE_THEME_NAME ) 
			),		
			'tooltip' => array(
				'type' => 'text',
				'title'  => __( 'Tooltip content', MOKAINE_THEME_NAME ),
	            'desc' => __( 'Type here what you want to show in the tooltip', MOKAINE_THEME_NAME ),
	            'default' => __( 'I live here', MOKAINE_THEME_NAME )                        
			),	
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', MOKAINE_THEME_NAME ),
				'desc' => __( 'Type a custom class name for CSS purposes', MOKAINE_THEME_NAME )
			)					
		)
	);

	$mokaine_shortcodes['timeline'] = array( 
		'type' => 'custom', 
		'title' => __( 'Timeline', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array(
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),		
			'aside_title' => array(
				'type' => 'text', 
				'title' => __( 'Aside title', MOKAINE_THEME_NAME ),
				'default' => __( 'Title of the aside section', MOKAINE_THEME_NAME ),
				'skip' => true
			),	
			'aside_content' => array(
				'type' => 'textarea',
				'title' => __( 'Aside content', MOKAINE_THEME_NAME ),
				'default' => __( 'Lorem ipsum ...', MOKAINE_THEME_NAME ),
				'skip' => true
			)		
		)
	); 

	$mokaine_shortcodes['mockup'] = array( 
		'type' => 'custom', 
		'title' => __( 'Mockup Carousel', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array(
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),
			'device' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup device', MOKAINE_THEME_NAME ),
				'values' => array(
				    'iphone' => __( 'iPhone', MOKAINE_THEME_NAME ),
			  		'ipad' => __( 'iPad', MOKAINE_THEME_NAME ),
			  		'desktop' => __( 'Desktop', MOKAINE_THEME_NAME )
				)
			),
			// adding new options here or changing some lines in the array below may break some js functions
			'color' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup color', MOKAINE_THEME_NAME ),
				'desc' => __( 'Note: This option has no effect on "Desktop" mockups', MOKAINE_THEME_NAME ),				
				'values' => array(
				    'black' => __( 'Black', MOKAINE_THEME_NAME ),
			  		'white' => __( 'White', MOKAINE_THEME_NAME )
				)
			),
			'arrows_color' => array(
				'type' => 'select', 
				'title'  => __( 'Arrows color', MOKAINE_THEME_NAME ),
				'values' => array(
				    'dark' => __( 'Dark', MOKAINE_THEME_NAME ),
			  		'white' => __( 'White', MOKAINE_THEME_NAME )
				)
			),
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', MOKAINE_THEME_NAME ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', MOKAINE_THEME_NAME )
			),	
			'rewind_speed' => array(
				'type' => 'text', 
				'title' => __( 'Rewind speed', MOKAINE_THEME_NAME ),
				'desc' => __( 'Rewind speed in milliseconds value (e.g. type "1000" for 1 seconds)', MOKAINE_THEME_NAME )
			),				
			'mockup_screens' => array(
				'type' => 'special',
				'title' => __( 'Screen', MOKAINE_THEME_NAME ),
				'desc' => __( 'iPhone image size: <strong>375x667px (min)</strong> or <strong>750x1334px (max)</strong><br>iPad image size: <strong>504x378px (min)</strong> or <strong>1008x756px (max)</strong><br>Desktop image size: <strong>574x315px (min)</strong> or <strong>1148x630px (max)</strong>', MOKAINE_THEME_NAME )
			)
		)
	); 

	$mokaine_shortcodes['mockup_half'] = array( 
		'type' => 'custom', 
		'title' => __( 'Half Mockup Carousel', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array(	
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),	
			'device' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup device', MOKAINE_THEME_NAME ),
				'values' => array(
				    'iphone' => __( 'iPhone', MOKAINE_THEME_NAME ),
			  		'ipad' => __( 'iPad', MOKAINE_THEME_NAME ),
			  		'desktop' => __( 'Desktop', MOKAINE_THEME_NAME )
				)
			),
			// adding new options here or changing some lines in the array below may break some js functions
			'color' => array(
				'type' => 'select', 
				'title'  => __( 'Device color', MOKAINE_THEME_NAME ),
				'desc' => __( 'Note: This option has no effect on "Desktop" mockups', MOKAINE_THEME_NAME ),			
				'values' => array(
				    'black' => __( 'Black', MOKAINE_THEME_NAME ),
			  		'white' => __( 'White', MOKAINE_THEME_NAME )
				)
			),
			'layout' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup position', MOKAINE_THEME_NAME ),
				'values' => array(
				    'left' => __( 'Align left', MOKAINE_THEME_NAME ),
			  		'right' => __( 'Align right', MOKAINE_THEME_NAME )
				)
			),		
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', MOKAINE_THEME_NAME ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', MOKAINE_THEME_NAME )
			),
			'aside_title' => array(
				'type' => 'text', 
				'title' => __( 'Aside title', MOKAINE_THEME_NAME ),
				'default' => __( 'Title of the aside section', MOKAINE_THEME_NAME ),
				'skip' => true
			),	
			'aside_content' => array(
				'type' => 'textarea',
				'title' => __( 'Aside content', MOKAINE_THEME_NAME ),
				'default' => __( 'Lorem ipsum ...', MOKAINE_THEME_NAME ),
				'skip' => true
			),								
			'mockup_screens' => array(
				'type' => 'special',
				'title'  => __( 'Screen', MOKAINE_THEME_NAME ),
				'desc' => __( 'iPhone image size: <strong>375x667px (min)</strong> or <strong>750x1334px (max)</strong><br>iPad image size: <strong>504x378px (min)</strong> or <strong>1008x756px (max)</strong><br>Desktop image size: <strong>574x315px (min)</strong> or <strong>1148x630px (max)</strong>', MOKAINE_THEME_NAME )
			)
		)
	); 

	$mokaine_shortcodes['testimonial'] = array( 
		'type' => 'custom', 
		'title' => __( 'Testimonial Slider', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array(
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),	
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', MOKAINE_THEME_NAME ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', MOKAINE_THEME_NAME ),
				'default' => 5000
			),
			'pagination' => array(
				'type' => 'checkbox', 
				'title' => __( 'Show bullets', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if you want to show pagination bullets', MOKAINE_THEME_NAME ),
			),
			'transition' => array(
				'type' => 'select', 
				'title'  => __( 'Transition Style', MOKAINE_THEME_NAME ),
				'desc' => __( 'CSS transition style for the slider', MOKAINE_THEME_NAME ),			
				'values' => array(
					'none' => __( 'None', MOKAINE_THEME_NAME ),                    
					'fade' => __( 'Fade', MOKAINE_THEME_NAME ),
					'backSlide' => __( 'Back Slide', MOKAINE_THEME_NAME ),
					'goDown' => __( 'Go Down', MOKAINE_THEME_NAME ),
					'fadeUp' => __( 'Fade Up', MOKAINE_THEME_NAME ),
					'scaleDown' => __( 'Scale Down', MOKAINE_THEME_NAME ),
					'scaleDownRight' => __( 'Scale Down Right', MOKAINE_THEME_NAME ),                    
					'scaleUpLeft' => __( 'Scale Up Left', MOKAINE_THEME_NAME ),
					'fadeTop' => __( 'Fade top', MOKAINE_THEME_NAME ),
					'overlap' => __( 'Overlap', MOKAINE_THEME_NAME )
				)
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered Text', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this to center the content', MOKAINE_THEME_NAME )
			),
			'testimonials' => array(
				'type' => 'special',
				'desc' => __( 'Min. recommended size: 160x160px', MOKAINE_THEME_NAME )
			)		
		)
	); 

	$mokaine_shortcodes['custom_carousel'] = array( 
		'type' => 'custom', 
		'title' => __( 'Custom Carousel', MOKAINE_THEME_NAME ),
		'disabled' => true,
		'attr' => array(
			'info' => array(
				'type' => 'gopro',
				'head' => __( 'Unlock this feature!', MOKAINE_THEME_NAME ),
				'call' => __( '<p class="pro-message">This shortcode is not available in Beetle Go. Purchase <strong>Beetle Pro</strong> to unlock it!</p><div><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>', MOKAINE_THEME_NAME )
			),	
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', MOKAINE_THEME_NAME ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', MOKAINE_THEME_NAME ),
				'default' => 5000
			),
			'pagination' => array(
				'type' => 'checkbox', 
				'title' => __( 'Show bullets', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if you want to show pagination bullets', MOKAINE_THEME_NAME ),
			),
			'transition' => array(
				'type' => 'select', 
				'title'  => __( 'Transition style', MOKAINE_THEME_NAME ),
				'desc' => __( 'CSS transition style for the slider', MOKAINE_THEME_NAME ),			
				'values' => array(
					'none' => __( 'None', MOKAINE_THEME_NAME ),                    
					'fade' => __( 'Fade', MOKAINE_THEME_NAME ),
					'backSlide' => __( 'Back Slide', MOKAINE_THEME_NAME ),
					'goDown' => __( 'Go Down', MOKAINE_THEME_NAME ),
					'fadeUp' => __( 'Fade Up', MOKAINE_THEME_NAME ),
					'scaleDown' => __( 'Scale Down', MOKAINE_THEME_NAME ),
					'scaleDownRight' => __( 'Scale Down Right', MOKAINE_THEME_NAME ),                    
					'scaleUpLeft' => __( 'Scale Up Left', MOKAINE_THEME_NAME ),
					'fadeTop' => __( 'Fade top', MOKAINE_THEME_NAME ),
					'overlap' => __( 'Overlap', MOKAINE_THEME_NAME )
				)
			)	
		)
	); 

	$mokaine_shortcodes['social'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Social Widget', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'title' => array(
				'type' => 'text', 
				'title' => __( 'Widget title', MOKAINE_THEME_NAME )
			),
			'links' => array(
				'type' => 'textarea',
				'title' => __( 'Social buttons', MOKAINE_THEME_NAME ),
				'desc' => __( 'Enter any social media links with a comma separated list (e.g. Facebook,http://facebook.com, Twitter,http://twitter.com)', MOKAINE_THEME_NAME )
			),
		)
	);

	$mokaine_shortcodes['text_widget'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Text Widget', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'title' => array(
				'type' => 'text', 
				'title' => __( 'Widget title', MOKAINE_THEME_NAME )
			),
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Content', MOKAINE_THEME_NAME )
			),
		)
	);	
		 
	$mokaine_shortcodes['header_fetch'] = array( 
		'type' => 'heading', 
		'title' => __( 'Blog / Portfolio / Dribbble', MOKAINE_THEME_NAME )
	);

	/* Mokaine Blog fetching */
	$blog_types = get_categories();

	$blog_options = array( 'all' => __( 'All', MOKAINE_THEME_NAME ) );

	foreach ( $blog_types as $type ) {
		$blog_options[ $type->slug ] = $type->name;
	}

	$mokaine_shortcodes['blog'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Blog', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'style' => array(
			    'type' => 'select',
			    'title' => __( 'Blog style', MOKAINE_THEME_NAME ),
			    'values' => array(
			        'list' => __( 'List style', MOKAINE_THEME_NAME ),
			        'masonry' => __( 'Masonry style', MOKAINE_THEME_NAME )                                                     
			    )
			), 		
			'articles' => array(
				'type' => 'text', 
				'title' => __( 'Articles to show', MOKAINE_THEME_NAME ),
			    'desc' => __( 'The number of articles you want to show', MOKAINE_THEME_NAME ),				
				'default' => 8,
			),
			'category' => array(
				'type' => 'multi-select',
				'title' => 'Blog categories',
				'desc' => __( 'Select the categories you want to show for your blog. <br/>You can select multiple categories too (ctrl + click on PC and command + click on Mac).', MOKAINE_THEME_NAME ),
				'values' => $blog_options
			),		
			'button_text' => array(
				'type' => 'text', 
				'title' => __( 'Button text', MOKAINE_THEME_NAME ),
				'default' => __( 'Button', MOKAINE_THEME_NAME )
			),
			'button_url' => array(
				'type' => 'text', 
				'title' => __( 'Button link', MOKAINE_THEME_NAME )
			),
			'button_style' => array(
				'type' => 'select',
				'title' => __( 'Button style', MOKAINE_THEME_NAME ),
				'values' => array(
				    'solid' => __( 'Solid', MOKAINE_THEME_NAME ),
			  		'transparent' => __( 'Transparent', MOKAINE_THEME_NAME )
				)			
			),	
			'button_color' => array(
			    'type' => 'select',
			    'title' => __( 'Button color', MOKAINE_THEME_NAME ),
			    'values' => array(
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
			'open_new_tab' => array(
				'type' => 'checkbox', 
				'title' => __( 'Open link in a new tab?', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if you want to open the link in a new page', MOKAINE_THEME_NAME )				
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest the <strong>blog</strong> shortcode into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)							
		)
	);

	/* Mokaine Portfolio fetching */
	$portfolio_options = array();

	if ( $pages = get_mokaine_portfolio_pages() ) {

		foreach ( $pages as $page ) {
			$portfolio_options[ $page->ID ] = $page->post_title;
		}

		$mokaine_shortcodes['portfolio'] = array( 
			'type' => 'self_closing', 
			'title' => __( 'Portfolio', MOKAINE_THEME_NAME ), 
			'attr' => array( 
				'columns' => array(
				    'type' => 'select',
				    'title' => __( 'Columns', MOKAINE_THEME_NAME ),
				    'values' => array(
				        '2' => __( '2 Columns', MOKAINE_THEME_NAME ),
				        '3' => __( '3 Columns', MOKAINE_THEME_NAME ),
				        '4' => __( '4 Columns', MOKAINE_THEME_NAME )                                                     
				    )
				), 			
				'items' => array(
					'type' => 'text', 
					'title' => __( 'Items to show', MOKAINE_THEME_NAME ),
					'desc' => __( 'The number of items you want to show', MOKAINE_THEME_NAME ),	
					'default' => 8,
				),	
				'lightbox' => array(
					'type' => 'checkbox', 
					'desc' => __( 'Check to enable a lightbox gallery', MOKAINE_THEME_NAME ),
					'title' => __( 'Lightbox', MOKAINE_THEME_NAME )
				),		
				'button_text' => array(
					'type' => 'text', 
					'title' => __( 'Button text', MOKAINE_THEME_NAME ),
					'default' => __( 'Button', MOKAINE_THEME_NAME )
				),
				'button_url' => array(
					'type' => 'text', 
					'title' => __( 'Button link', MOKAINE_THEME_NAME )
				),
				'button_style' => array(
					'type' => 'select',
					'title' => __( 'Button style', MOKAINE_THEME_NAME ),

					'values' => array(
					    'solid' => __( 'Solid', MOKAINE_THEME_NAME ),
				  		'transparent' => __( 'Transparent', MOKAINE_THEME_NAME ),
					)			
				),	
				'button_color' => array(
				    'type' => 'select',
				    'title' => __( 'Button color', MOKAINE_THEME_NAME ),
				    'values' => array(
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
				'open_new_tab' => array(
					'type' => 'checkbox', 
					'desc' => __( 'Check this if you want to open the link in a new page', MOKAINE_THEME_NAME ),
					'title' => __( 'Open link in a new tab?', MOKAINE_THEME_NAME )
				),
				'info' => array(
					'type' => 'infobox',
					'title' => __( 'Note:', MOKAINE_THEME_NAME ),
					'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest the <strong>portfolio</strong> shortcode into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
				)								
			)
		);

	}

	/* Mokaine Dribbble fetching */
	$mokaine_shortcodes['dribbble'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Dribbble Portfolio', MOKAINE_THEME_NAME ), 
		'attr' => array( 
			'username' => array(
				'type' => 'text', 
				'title' => __( 'Dribbble username', MOKAINE_THEME_NAME ),
				'desc' => __( 'E.g. &lsquo;frankiefreesbie&lsquo; (spot it from the url &lsquo;https://dribbble.com/frankiefreesbie&lsquo;)', MOKAINE_THEME_NAME ),
			),
			'columns' => array(
				'type' => 'select', 
				'title' => __( 'Columns', MOKAINE_THEME_NAME ),
				'values' => array(
				    '3' => 3,
			  		'4' => 4
				)	
			),		
			'items' => array(
				'type' => 'text', 
				'title' => __( 'Items to show', MOKAINE_THEME_NAME ),
				'desc' => __( 'The number of dribbble items you want to show', MOKAINE_THEME_NAME ),
				'default' => 8,
			),
			'button_text' => array(
				'type' => 'text', 
				'title' => __( 'Button text', MOKAINE_THEME_NAME ),
				'default' => __( 'Button', MOKAINE_THEME_NAME )
			),
			'button_url' => array(
				'type' => 'text', 
				'title' => __( 'Button link', MOKAINE_THEME_NAME )
			),
			'button_style' => array(
				'type' => 'select',
				'title' => __( 'Button style', MOKAINE_THEME_NAME ),
				'values' => array(
				    'solid' => __( 'Solid', MOKAINE_THEME_NAME ),
			  		'transparent' => __( 'Transparent', MOKAINE_THEME_NAME )
				)			
			),	
			'button_color' => array(
			    'type' => 'select',
			    'title' => __( 'Button color', MOKAINE_THEME_NAME ),
			    'values' => array(
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
			'open_new_tab' => array(
				'type' => 'checkbox', 
				'title' => __( 'Open link in a new tab?', MOKAINE_THEME_NAME ),
				'desc' => __( 'Check this if you want to open the link in a new page', MOKAINE_THEME_NAME )				
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', MOKAINE_THEME_NAME ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest the <strong>dribbble</strong> shortcode into a <strong>Full Width Section</strong> shortcode.', MOKAINE_THEME_NAME )
			)			
		)
	);
		
	/* The HTML inside the popup */
	$html_options = $shortcode_html = null;
	?>

	<div id="mokaine-sc-heading">
		<div id="mokaine-sc-generator" class="mfp-hide mfp-with-anim">				
			<div class="shortcode-content">
				<div id="mokaine-sc-header">
					<div class="label"><strong><?php echo __( 'Mokaine Shortcodes', MOKAINE_THEME_NAME ) ?></strong></div>			
					<div class="content">
						<select id="mokaine-shortcodes" data-placeholder="<?php echo __( 'Choose a shortcode', MOKAINE_THEME_NAME ) ?>">
						    <option val=""></option>

						    <?php							
							foreach( $mokaine_shortcodes as $shortcode => $options ) {

								/* If shortcode 'type' => 'heading' output <optgroup> */
								if( $options['type'] == 'heading' ) {	

									$shortcode_html .= '<optgroup label="' . $options['title'] . '">';

								} else {

									/* If shortcode is disabled */
									$locked_option = $locked_panel = '';
									if ( isset( $options['disabled'] ) && $options['disabled'] == true ) {
										$locked_option = 'locked-option';
										$locked_panel = ' locked-panel';
									}

									$shortcode_html .= '<option value="' . $shortcode . '" class="' . $locked_option . '">' . $options['title'] . '</option>';
									$html_options .= '<div class="shortcode-options' . $locked_panel . '" id="options-' . $shortcode . '" data-name="' . $shortcode . '" data-type="' . $options['type'] . '">';
									
									if( !empty( $options['attr'] ) ) {

										foreach( $options['attr'] as $name => $attr_option ) {
											$html_options .= mokaine_option_element( $name, $attr_option, $options, $options['type'], $shortcode );
										}

									}
					
									$html_options .= '</div>'; 

								}
								
							}
							?> 

							<?php echo $shortcode_html ?>

						</select>
					</div>
				</div> 			

				<?php echo $html_options; ?>
		
			<code class="shortcode_storage">
				<span id="shortcode-storage-opening"></span>
				<span id="shortcode-storage-content"></span>
				<span id="shortcode-storage-closing"></span>
			</code>
			<a class="btn" id="add-shortcode"><?php echo __( 'Add Shortcode', MOKAINE_THEME_NAME ); ?></a>
		</div>
	</div>	
		
<?php 
}

add_action( 'admin_footer','content_display' );


/** ---------------------------------------------------------
 * Option element function
 */
function mokaine_option_element( $name, $attr_option, $options, $type, $shortcode ) {
	
	$option_element = null;

	/* Default */
	( isset( $attr_option['default'] ) ) ? $default = $attr_option['default'] : $default = '';
	
	/* Desc */
	( isset( $attr_option['desc'] ) && !empty( $attr_option['desc'] ) ) ? $desc = '<p class="description">' . $attr_option['desc'] . '</p>' : $desc = '';

	/* Skip processing */
	( isset( $attr_option['skip'] ) && $attr_option['skip'] == true ) ? $skip_class = 'skip-processing' : $skip_class = '';	

	/* Disable inputs */
	( isset( $options['disabled'] ) && $options['disabled'] == true ) ? $disable_input = ' disabled' : $disable_input = '';	

	/* Define type cases */
	switch( $attr_option['type'] ) {

		case 'text':		
		default:

		    $option_element .= '
			<div class="label label-text label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-text content-' . $name . '"><input type="text" data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '" class="attr ' . $skip_class . '" value="' . $default . '"' . $disable_input . '>' . $desc . '</div>';
		    
		    break;			

		case 'textarea':

			$option_element .= '
			<div class="label label-textarea label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' .$attr_option['title'].'</strong></label></div>
			<div class="content content-textarea content-' . $name . '"><textarea data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '" class="' . $skip_class . '"' . $disable_input . '>' . $default . '</textarea> ' . $desc . '</div>';
			
			break;	
		
		case 'radio':
		    
			$option_element .= '
			<div class="label label-radio label-' . $name . '"><strong>' . $attr_option['title'] . '</strong></div>
			<div class="content content-radio content-' . $name . '">';

		    foreach( $attr_option['values'] as $val => $title ) {
		    				
				$option_element .= '
				<label for="' . $shortcode . '-' . $name . '-' . $val . '">
					<input class="attr" type="radio" data-attrname="' . $name . '" name="' . $shortcode .'-' . $name . '" value="' . $val . '" id="' . $shortcode . '-' . $name . '-' . $val . '"' . ( $default == $val ? ' checked="checked"' : '' ) . $disable_input . '>
					<span>' . $title . '</span>
				</label>';
		    
		    }
			
			$option_element .= $desc . '</div>';
			
		    break;
			
		case 'checkbox':
			
			$option_element .= '
			<div class="label label-checkbox label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-checkbox"><input type="checkbox" data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '"' . ( $default == 'on' ? ' checked="checked"' : '' ) . $disable_input . '>' . $desc . '</div>';
			
			break;	
		
		case 'select':

			$option_element .= '
			<div class="label label-select label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-select content-' . $name . '">
			<select id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '" class="' . $skip_class . '"' . $disable_input . '>';

				$values = $attr_option['values'];

				foreach( $values as $val => $title ) {
			    	$option_element .= '<option value="' . $val . '">' . $title . '</option>';
				}

			$option_element .= '</select>' . $desc . '</div>';

			break;
		
		case 'multi-select':
			
			$option_element .= '
			<div class="label label-multiselect label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-multiselect content-' . $name . '">
				<select multiple="multiple" id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '"' . $disable_input . '>';

					$values = $attr_option['values'];

					foreach( $values as $val => $title ) {
				    	$option_element .= '<option value="' . $val . '">' . $title . '</option>';
					}

				$option_element .= '</select>' . $desc . '</div>';
			
			break;

		case 'icon':

			$option_element .= '
			<div class="label label-icons label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-icons content-' . $name . '">
				<select id="' . $shortcode . '-' . $name . '" data-attrname="icon-select" class="skip-processing"' . $disable_input . '>';

				$values = $attr_option['values'];

				/* Output font options */
				foreach( $values as $val => $set ) {
			    	$option_element .= '<option value="' . $val . '">' . $set['title'] . '</option>';
				}

				$option_element .= '</select>' . $desc . '</div>';
				$option_element .= '<div class="clear no-line"></div>';
				$option_element .= '<div class="icons-container" data-attrname="' . $name . '">';

				/* Output icons */
				foreach( $values as $val => $set ) {

					$option_element .= '<div class="icon-option ' . $val . '">';

						foreach( $set['iconopt'] as $iconopt ) {
					    	$option_element .= '<i class="' . $iconopt . '"></i>';
						}

					$option_element .= '</div>';

				}

				$option_element .= '</div>';
			
			break;	

		case 'color':
				
	        $option_element .= '<div class="label label-color label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>';

			if( get_bloginfo( 'version' ) >= '3.5' ) {

			   $option_element .= '<div class="content content-color content-' . $name . '"><input type="text" id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '" class="popup-colorpicker" data-default-color="" value=""></div>';

	        } else {

	           $option_element .= __( 'You&lsquo;re using an outdated version of WordPress. Please update to use this feature.', MOKAINE_THEME_NAME );

	        }	

			break;		

		case 'image':

		    $option_element .= '
			<div class="label label-image label-' . $name . '"><label><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-image content-' . $name . '">
				<input type="hidden" id="options-item">
				<img class="image-screenshot" id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '" src="">
				<a data-update="' . __( 'Select File', MOKAINE_THEME_NAME ) . '" data-choose="' . __( 'Choose a file', MOKAINE_THEME_NAME ) . '" href="javascript:void(0);" class="image-upload button-secondary" rel-id="">' . __( 'Upload', MOKAINE_THEME_NAME ) . '</a>
				<a href="javascript:void(0);" class="image-upload-remove" style="display: none;">' . __( 'Remove Upload', MOKAINE_THEME_NAME ) . '</a>
				' . $desc . '
			</div>';

		    break;		

		case 'infobox':

			$option_element .= '
			<div class="info"><div class="info-title">' . $attr_option['title'] . '</div>
			<div class="info-content">' . $desc . '</div></div>';

			break;  

		case 'gopro':

			$option_element .= '
			<div class="go-pro-sc"><div class="go-pro-sc-title">' . $attr_option['head'] . '</div>
			<div class="info-content">' . $attr_option['call'] . '</div></div>';

			break;  			

		case 'percent':

		    $option_element .= '
			<div class="label label-slider label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content dd-percent content-slider content-' . $name . '"><input type="text" data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '" class="attr percent" value=""' . $disable_input . '>
				<div class="percent-slider"></div>' . $desc . '
			</div>';

		    break;				
			
		case 'special':	
			
			if( $name == 'testimonials' ) {
				$option_element .= '
				<div class="shortcode-dynamic-items testimonials" data-name="' . $name . '">
					<div class="shortcode-dynamic-item">
						<div class="field">
							<div class="label label-text label-' . $name . '"><label><strong>' . __( 'Author', MOKAINE_THEME_NAME ) . '</strong></label></div>
							<div class="content content-text content-' . $name . '"><input class="shortcode-dynamic-item-input skip-processing" type="text" name="" value=""' . $disable_input . '></div>
						</div>
						<div class="field">
							<div class="label label-textarea label-' . $name . '"><label><strong>' . __( 'Quote', MOKAINE_THEME_NAME ) . '</strong></label></div>
							<div class="content content-textarea content-' . $name . '"><textarea class="quote" name="quote" data-attrname="content_inside"' . $disable_input . '></textarea></div>
						</div>
						<div class="label label-image label-' . $name . '"><label><strong>' . __( 'Image', MOKAINE_THEME_NAME ) . '</strong></label></div>
						<div class="content content-image content-' . $name . '">
							<input type="hidden" id="options-item">
							<img class="image-screenshot skip-processing" data-attrname="' . $name . '" src="">
							<a data-update="' . __( 'Select File', MOKAINE_THEME_NAME ) . '" data-choose="' . __( 'Choose a file', MOKAINE_THEME_NAME ) . '" href="javascript:void(0);" class="image-upload button-secondary" rel-id="">' . __( 'Upload', MOKAINE_THEME_NAME ) . '</a>
							<a href="javascript:void(0);" class="image-upload-remove" style="display: none;">' . __( 'Remove Upload', MOKAINE_THEME_NAME ) . '</a>
							' . $desc . '
						</div>

					</div>
				</div>
				<a href="#" class="btn blue remove-list-item">' .__( 'Remove Testimonial', MOKAINE_THEME_NAME ). '</a> <a href="#" class="btn blue add-list-item">' .__( 'Add Testimonial', MOKAINE_THEME_NAME ).'</a>';
				
			} 

			else if( $name == 'mockup_screens' ) {
				$option_element .= '
				<div class="shortcode-dynamic-items mockup-screens" data-name="' . $name . '">
					<div class="shortcode-dynamic-item">
						<div class="label label-image label-' . $name . '"><label><strong>' . __( 'Screen', MOKAINE_THEME_NAME ) . '</strong></label></div>
						<div class="content content-image content-' . $name . '">
							<input type="hidden" id="options-item">
							<img class="image-screenshot skip-processing" data-attrname="' . $name . '" src="">
							<a data-update="' . __( 'Select File', MOKAINE_THEME_NAME ) . '" data-choose="' . __( 'Choose a file', MOKAINE_THEME_NAME ) . '" href="javascript:void(0);" class="image-upload button-secondary" rel-id="">' . __( 'Upload', MOKAINE_THEME_NAME ) . '</a>
							<a href="javascript:void(0);" class="image-upload-remove" style="display: none;">' . __( 'Remove Upload', MOKAINE_THEME_NAME ) . '</a>
							' . $desc . '
						</div>
					</div>
				</div>
				<a href="#" class="btn blue remove-list-item">' . __( 'Remove Screen', MOKAINE_THEME_NAME ) . '</a> <a href="#" class="btn blue add-list-item">' . __( 'Add Screen', MOKAINE_THEME_NAME ) . '</a>';
			}
			
		break;
				  

    }
	
	$option_element .= '<div class="clear"></div>';
	
    return $option_element;

}