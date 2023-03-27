<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label>

		<span class="screen-reader-text"><?php _e( 'Search for:', MOKAINE_THEME_NAME ) ?></span>
		<span class="pre-input"><i class="linecon-icon-search"></i></span>
		<input type="search" class="search-field plain buffer" placeholder="<?php _e( 'Search …', MOKAINE_THEME_NAME ) ?>" value="" name="s" title="<?php _e( 'Search for:', MOKAINE_THEME_NAME ) ?>">
	
	</label>

	<input type="submit" class="search-submit" value="Search" />

</form>