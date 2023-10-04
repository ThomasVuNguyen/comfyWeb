<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.2.0
	 */
	public function load_plugin_textdomain(): void {
		load_plugin_textdomain(
			'hostinger',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

}
