<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hostinger_Admin_Menu {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

	public function admin_menu(): void {
		$icon = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjEiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyMSAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0wLjAwMDE5OTY1MyAxMS4yMzY4VjAuMDAwMzk4MjM1TDUuNjcxMzMgMy4wMjQzNlY4LjA4NjkxTDEzLjE3ODggOC4wOTA1M0wxOC45NDE5IDExLjIzNjhIMC4wMDAxOTk2NTNaTTE0LjcxNCA3LjE2MDQ3VjBMMjAuNTM4IDIuOTQ4NzJWMTAuNTQzN0wxNC43MTQgNy4xNjA0N1pNMTQuNzE0IDIwLjg5NDJWMTUuODc1M0w3LjE0ODYyIDE1Ljg3QzcuMTU1NjggMTUuOTAzNCAxLjI4OTg0IDEyLjY3MzUgMS4yODk4NCAxMi42NzM1TDIwLjUzOCAxMi43NjM4VjI0TDE0LjcxNCAyMC44OTQyWk0wIDIwLjg5NDFMMC4wMDAyMDE3NjkgMTMuNTUxNEw1LjY3MTMzIDE2Ljg1NDZWMjMuODQyN0wwIDIwLjg5NDFaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K';
		add_menu_page(
			__( 'Hostinger', 'hostinger' ),
			__( 'Hostinger', 'hostinger' ),
			'manage_options',
			'hostinger',
			[ $this, 'render' ],
			$icon,
			1
		);
	}

	public function render(): void {
		require_once HOSTINGER_ABSPATH . 'includes/admin/onboarding/class-hostinger-onboarding.php';
		$onboarding = new Hostinger_Onboarding();
		include_once __DIR__ . '/views/hostinger-onboarding-view.php';
	}
}

return new Hostinger_Admin_Menu();
