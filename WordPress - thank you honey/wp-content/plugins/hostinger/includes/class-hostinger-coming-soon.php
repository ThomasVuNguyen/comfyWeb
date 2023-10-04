<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Coming_Soon {
	public function __construct() {
		add_action( 'wp_footer', [ $this, 'register_styles' ] );
		add_action( 'template_redirect', [ $this, 'coming_soon' ] );
	}

	public function coming_soon(): void {
		if ( ! is_user_logged_in() && ! is_admin() && ! current_user_can( 'update_plugins' ) ) {
			include_once HOSTINGER_ABSPATH . 'includes/views/hostinger-coming-soon.php';
			die;
		}
	}

	public function register_styles(): void {
		wp_enqueue_style( 'hostinger_main_styles', HOSTINGER_ASSETS_URL . '/css/main.css', [], '1.0.0' );
		wp_enqueue_style( 'hostinger_coming_soon', HOSTINGER_ASSETS_URL . '/css/coming-soon.css', [], '1.0.0' );
	}
}

new Hostinger_Coming_Soon();
