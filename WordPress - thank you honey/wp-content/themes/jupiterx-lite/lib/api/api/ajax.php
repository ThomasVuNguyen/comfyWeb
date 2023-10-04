<?php
/**
 * This class handles AJAX.
 *
 * @since 1.3.0
 *
 * @package JupiterX\Framework\Admin\Setup_Wizard
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AJAX class.
 *
 * @since 1.3.0
 *
 * @package JupiterX\Framework\Admin\Setup_Wizard
 */
final class JupiterX_API_Ajax {

	/**
	 * Successful return status.
	 */
	const OK = true;

	/**
	 * Error return status.
	 */
	const ERROR = false;

	/**
	 * Class constructor.
	 *
	 * @since 1.3.0
	 */
	public function __construct() {
		add_action( 'wp_ajax_jupiterx_api', [ $this, 'ajax' ] );
	}

	/**
	 * Main AJAX function.
	 *
	 * @since 1.3.0
	 *
	 * @SuppressWarnings(PHPMD.ElseExpression)
	 */
	public function ajax() {
		check_ajax_referer( 'jupiterx-nonce', 'nonce' );

		if ( ! current_user_can( 'edit_others_posts' ) || ! current_user_can( 'edit_others_pages' ) ) {
			wp_send_json_error( 'You do not have access to this section', 'jupiterx-lite' );
		}

		if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] ) {
			$method = filter_input( INPUT_GET, 'method' );
		} else {
			$method = filter_input( INPUT_POST, 'method' );
		}

		if ( ! isset( $method ) || ( ! method_exists( $this, $method ) && ! has_action( "jupiterx_api_ajax_{$method}" ) ) ) {
			wp_send_json_success( [
				'status' => self::ERROR,
			] );
		}

		$action = "jupiterx_api_ajax_{$method}";

		if ( has_action( $action ) ) {
			do_action( $action );
		} else {
			// Run AJAX type.
			call_user_func( [ $this, $method ] );
		}
	}
}

new JupiterX_API_Ajax();
