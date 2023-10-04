<?php
/**
 * Nexter Customizer Theme Control: panel.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*
 * Customizer Add Panels
 * @link https://gist.github.com/OriginalEXE/9a6183e09f4cae2f30b006232bb154af
 */
if ( class_exists( 'WP_Customize_Panel' ) ) {

	class Nexter_Customizer_Panel extends WP_Customize_Panel {

		/**
		 * Panel
		 */
		public $panel;

		/**
		 * Control type.
		 */
		public $type = 'nxt_panel';

		/**
		 * Get panel args for JS.
		 */
		public function json() {

			$array                   = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel' ) );
			$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content']        = $this->get_content();
			$array['active']         = $this->active();
			$array['instanceNumber'] = $this->instance_number;

			return $array;
		}
	}

}