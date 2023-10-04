<?php
/**
 * Nexter Customizer Theme Options
 *
 * @package	Nexter
 * @since	1.0.0
 */
if ( ! class_exists( 'Nexter_Customizer_Options' ) ) {
	
	class Nexter_Customizer_Options {
		
		private static $instance;
		
		/**
		 * Post id
		 */
		public static $post_id = null;
		
		/**
		 * A static option variable.
		 */
		private static $theme_options;
		
		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'refresh' ) );

		}
		
		/**
		 * Update theme option.
		 */
		public static function refresh() {
			self::$theme_options = wp_parse_args( get_option( NXT_OPTIONS ));
		}
		
		/**
		 * Get theme options
		 */
		public static function get_options() {
			return self::$theme_options;
		}
		
	}
}
Nexter_Customizer_Options::get_instance();