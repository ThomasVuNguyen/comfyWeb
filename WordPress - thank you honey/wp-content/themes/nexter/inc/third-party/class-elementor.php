<?php
/**
 * Nexter Elementor Compatibility
 *
 * @package Nexter
 * @since 1.0.0
 */

if ( ! class_exists( 'Nexter_Elementor_Builder' ) ) {

	class Nexter_Elementor_Builder extends Nexter_Builder_Compatibility {

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
		 * Render content for post.
		 */
		public function render_content( $post_id ) {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Load enqueue styles and scripts.
		 */
		public function enqueue_scripts( $post_id ) {

			if ( $post_id !== '' ) {
				if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
					$css_file = new \Elementor\Core\Files\CSS\Post( $post_id );
				} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
					$css_file = new \Elementor\Post_CSS_File( $post_id );
				}
				$css_file->enqueue();
			}
		}

	}

}