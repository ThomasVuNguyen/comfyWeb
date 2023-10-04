<?php
/**
 * Nexter Beaver Builder Compatibility
 *
 * @package Nexter
 * @since 1.0.0
 */

if ( ! class_exists( 'Nexter_Beaver_Builder' ) ) {

	class Nexter_Beaver_Builder extends Nexter_Builder_Compatibility {

		/**
		 * Instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Render content for post
		 */
		public function render_content( $post_id ) {
				echo do_shortcode( '[fl_builder_insert_layout id="' . $post_id . '"]' );
		}

		/**
		 * Load enqueue styles and scripts
		 */
		public function enqueue_scripts( $post_id ) {

			if ( $post_id !== '' ) {
				if ( is_callable( 'FLBuilder::enqueue_layout_styles_scripts_by_id' ) ) {
					FLBuilder::enqueue_layout_styles_scripts_by_id( $post_id );
				}
			}
		}

	}
}