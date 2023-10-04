<?php
/**
 * Nexter Control Base Customizer Configuration.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base Control Class for Registering Customizer.
 */
if ( ! class_exists( 'Nexter_Customizer_Control_Base' ) ) {

	class Nexter_Customizer_Control_Base {

		/**
		 * Registered Controls.
		 */
		private static $controls;

		/**
		 * Register control to WordPress Customizer.
		 */
		public static function add_control( $name, $atts ) {
			global $wp_customize;
			self::$controls[ $name ] = $atts;

			if ( isset( $atts['callback'] ) && $atts['callback'] !== 'Nexter_Control_Typography' ) {
				$wp_customize->register_control_type( $atts['callback'] );
			}
		}


		/**
		 * Returns control instance
		 */
		public static function get_control_instance( $type ) {
			$control_class = [];
			
			if ( isset( self::$controls[ $type ] ) ) {
				$control_class = self::$controls[ $type ];
			}
			
			if ( isset( $control_class['callback'] ) ) {
				return class_exists( $control_class['callback'] ) ? $control_class['callback'] : false;
			}

			return false;
		}
		
		/**
		 * Returns Sanitize callback for control
		 */
		public static function get_sanitize_call( $control ) {

			if ( isset( self::$controls[ $control ]['sanitize_callback'] ) ) {
				return self::$controls[ $control ]['sanitize_callback'];
			}

			return false;
		}
	}
}

new Nexter_Customizer_Control_Base;