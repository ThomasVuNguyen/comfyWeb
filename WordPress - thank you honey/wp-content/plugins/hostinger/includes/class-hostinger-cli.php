<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_CLI {
	/**
	 * Load required files and hooks to make the CLI work.
	 */
	public function __construct() {
		$this->includes();
		$this->hooks();
	}

	public function includes(): void {
		require_once HOSTINGER_ABSPATH . 'includes/cli/class-hostinger-maintenance-command.php';
	}

	/**
	 * Sets up and hooks WP CLI to our CLI code.
	 */
	private function hooks(): void {
		WP_CLI::add_hook( 'after_wp_load', 'Hostinger_Maintenance_Command::define_command' );
	}
}

new Hostinger_CLI();
