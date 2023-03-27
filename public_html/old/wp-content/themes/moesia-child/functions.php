
<?php
/* child theme */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
/* logo na tela de login */
function logo_bistec(){
	echo '<style type="text/css">
		h1 a {background-image:url("/novo/wp-content/themes/moesia-child/img/logo_bistec.png") !important;}
		</style>';
}
add_action('login_head','logo_bistec');