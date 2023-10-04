<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Admin_Redirect {
	private string $platform;
	public const PLATFORM_HPANEL = 'hpanel';

	public function __construct() {

		if ( ! Hostinger_Settings::get_setting( 'first_login_at' ) ) {
			Hostinger_Settings::update_setting( 'first_login_at', date( 'Y-m-d H:i:s' ) );
		}

		if ( ! isset( $_GET['platform'] ) ) {
			return;
		}

		$this->platform = $_GET['platform'];
		$this->loginRedirect();
	}

	private function loginRedirect(): void {
		$allowed_segments = [
			Hostinger_Settings::BUSINESS_BEGINNER_SEGMENT,
			Hostinger_Settings::LEARNER_SEGMENT,
		];
		if ( $this->platform === self::PLATFORM_HPANEL && in_array( Hostinger_Settings::get_setting( 'user_segment' ), $allowed_segments, true ) ) {
			add_action( 'init', static function () {
				$redirect_url = admin_url( 'admin.php?page=hostinger' );
				wp_redirect( $redirect_url );
				exit;
			} );
		}
	}
}

new Hostinger_Admin_Redirect();
