<?php
/**
 * Theme update notifier
 */
define( 'THEME_NAME', wp_get_theme()->Name );
define( 'THEME_XML', 'http://version.mokaine.com/beetlego.xml' );

function op_file_contents( $url ) {
	$request = curl_init( $url );
	curl_setopt( $request, CURLOPT_FAILONERROR, true );
	curl_setopt( $request, CURLOPT_FRESH_CONNECT, true );
	curl_setopt( $request, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $request, CURLOPT_TIMEOUT, 5 );
	$content = curl_exec( $request );
	curl_close( $request );
	return $content;
}

function op_get_version() {
	$last_cache = get_option( MOKAINE_THEME_NAME . '_cache' );
	$last_time = get_option( MOKAINE_THEME_NAME . '_cache_last' );
	if ( ! $last_time || ( time() - $last_time ) > 86400 ) { // change 86400 to 1 to instantly see new theme's notification
		update_option( MOKAINE_THEME_NAME . '_cache_last', time() );
		$xml = op_file_contents( THEME_XML );
		if ( $xml )	
			update_option( MOKAINE_THEME_NAME . '_cache', $xml );
	}
	else if ( $last_cache ) {
		$xml = get_option( MOKAINE_THEME_NAME . '_cache' );
	}
	if ( isset( $xml ) )
		return simplexml_load_string( $xml );
}

function op_version_notify() {
	$xml = op_get_version();
	$latestver = $xml->latest;
	$bubble = sprintf(
	    ' <span class="update-plugins" style="margin-top: 0;"><span class="update-count">%s</span></span>',
	    $latestver
	);
	if ( version_compare( $xml->latest, MOKAINE_THEME_VERSION, '>' ) ) // temporary comment this row to check if .xml is working
		add_dashboard_page( THEME_NAME, ( __( 'Theme Update', MOKAINE_THEME_NAME ) ) . $bubble, 'switch_themes', MOKAINE_THEME_NAME, 'op_version_page' );
}

if ( function_exists( 'simplexml_load_string' ) )
	add_action( 'admin_menu', 'op_version_notify' );  

function op_version_page() {
	$xml = op_get_version();
	$latestver = $xml->latest;
	?>
	
	<div class="wrap">
		<h2 style="margin-bottom: .5em;"><strong><?php echo THEME_NAME; ?></strong> <?php _e( 'Update', MOKAINE_THEME_NAME ); ?></h2>
		<p style="font-size: 1.3em;"><?php printf( __( '<strong>%s - Version %s</strong> is available to download (you are currently using <strong>Version %s</strong>).', MOKAINE_THEME_NAME ), THEME_NAME, $latestver, MOKAINE_THEME_VERSION ); ?></p>
		<div style="margin-top: 1em;">
		    <h2><?php _e( 'How do I update?', MOKAINE_THEME_NAME ); ?></h2>
		    <p><?php printf( __( 'Updating a theme is pretty much like installing it. Download a fresh copy from Mokaine.com, extract the .zip package, find the theme folder or the theme zip file. Now, if you do not know how to connect via FTP connection to your server, simply delete the current version of "%s" from WordPress and install the new one (Version %s). Otherwise, connect to your server, navigate to the WordPress themes folder and replace the whole theme folder with the new version.', MOKAINE_THEME_NAME ), THEME_NAME, $latestver ); ?></p>
		    <p><?php _e( 'Your themes path is:', MOKAINE_THEME_NAME ); ?> <code><?php echo get_theme_root(); ?></code></p>
		    <p><?php _e( '<strong>IMPORTANT:</strong> <em>If you made changes to the theme files you will probably lose theme settings when updating. In that case we recommend to backup your theme folder first, look at <strong>changes.txt</strong> file contained into the new theme version package and manually update only the files that have been changed.</em>', MOKAINE_THEME_NAME ); ?></p>
		<h2><?php _e( 'Changelog', MOKAINE_THEME_NAME ); ?></h2>
		<div><?php echo $xml->changes; ?></div>			
		</div>
	</div>
	
	<?php
}
?>