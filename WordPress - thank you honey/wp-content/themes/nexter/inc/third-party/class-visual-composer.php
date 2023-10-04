<?php
/**
 * Nexter Visual Composer Compatibility
 *
 * @package Nexter
 * @since 1.0.0
 */

if ( ! class_exists( 'Nexter_Visual_Composer_Builder' ) ) :

	class Nexter_Visual_Composer_Builder extends Nexter_Builder_Compatibility {

		/**
		 * Instance
		 */
		private static $instance;

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
		 * post Render content Vc Addons
		 */
		public function render_content( $post_id ) {

			$cur_post = get_post( $post_id, OBJECT );

			echo do_shortcode( $cur_post->post_content );
		}
		
		/**
		 * Load enqueue styles and scripts.
		 */
		public function enqueue_scripts( $post_id ) {}
	}

endif;