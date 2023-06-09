<?php
/*******************************************************************************
 * Copyright (c) 2019, Code Atlantic LLC
 ******************************************************************************/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class PUM_Newsletter_Provider
 *
 * @deprecated 1.7.0
 */
abstract class PUM_Newsletter_Provider extends PUM_Abstract_Provider {


	public function __construct() {
		parent::__construct();

		remove_filter( 'pum_settings_fields', array( $this, 'register_settings' ) );
		add_filter( 'pum_settings_fields', array( $this, 'process_deprecated_settings_fields' ) );
		//add_filter( 'pum_newsletter_settings', array( $this, 'register_settings' ) );
	}

	/**
	 * Process deprecated settings field registration from extensions that haven't updated.
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	public function process_deprecated_settings_fields( $fields ) {
		$fields['subscriptions'][ $this->id ] = $this->register_settings();

		return $fields;
	}

}
