<?php
/**
 * Main class that handles Adobe fonts.
 *
 * @package JupiterX\Framework\API\Fonts
 *
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adobe fonts loader class.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @package JupiterX\Framework\API\Fonts
 */
final class _JupiterX_Load_Adobe_Fonts {


	/**
	 * Construct the class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'jupiterx_font_types', [ $this, 'add_font_type' ] );
	}
	/**
	 * Add new font type.
	 *
	 * @param array $types Current font types.
	 *
	 * @return array Combined types.
	 */
	public function add_font_type( $types ) {
		$types['adobe'] = 'Adobe Fonts' . jupiterx_get_pro_badge();

		return $types;
	}
}

new _JupiterX_Load_Adobe_Fonts();
