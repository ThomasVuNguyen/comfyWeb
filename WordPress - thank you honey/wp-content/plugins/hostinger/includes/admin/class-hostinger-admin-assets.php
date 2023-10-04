<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hostinger_Admin_Assets {
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}

	public function admin_styles(): void {
		wp_enqueue_style( 'hostinger_main_styles', HOSTINGER_ASSETS_URL . '/css/main.css', [], HOSTINGER_VERSION );
	}

	public function admin_scripts(): void {
		wp_enqueue_script( 'hostinger_main_scripts', HOSTINGER_ASSETS_URL . '/js/main.js', [ 'jquery' ], HOSTINGER_VERSION, false );
	}
}

new Hostinger_Admin_Assets();
