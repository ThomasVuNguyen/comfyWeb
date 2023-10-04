<?php

defined( 'ABSPATH' ) || exit;

class Hostinger {
	protected string $plugin_name = 'Hostinger';
	protected string $version;

	public function bootstrap(): void {
		$this->version = $this->get_plugin_version();

		require_once HOSTINGER_ABSPATH . 'includes/class-hostinger-bootstrap.php';
		$bootstrap = new Hostinger_Bootstrap();
		$bootstrap->run();
	}

	public function run(): void {
		$this->bootstrap();
	}

	/**
	 * Define constant
	 *
	 * @param string $name Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( string $name, $value ): void {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	private function get_plugin_version(): string {
		if ( defined( 'HOSTINGER_VERSION' ) ) {
			return HOSTINGER_VERSION;
		}

		return '1.0.0';
	}
}
