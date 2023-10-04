<?php
/**
 * Nexter Theme Options Customizer Config.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Nexter Customizer Config
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Nexter_Customizer_Config' ) ) {

	class Nexter_Customizer_Config {

		public function __construct() {
			add_filter( 'nexter_customizer_configurations', array( $this, 'register_configuration' ), 30, 2 );
		}
		
		/**
		 * Register Customizer Configurations.
		 *
		 * @param Array	all controls $configurations Theme Customizer.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			return $configurations;
		}

	}
}
new Nexter_Customizer_Config;