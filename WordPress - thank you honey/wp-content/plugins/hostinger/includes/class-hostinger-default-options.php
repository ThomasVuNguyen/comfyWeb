<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Default_Options {
	public function add_options(): void {
		foreach ( $this->options() as $key => $option ) {
			update_option( $key, $option );
		}
	}

	private function options(): array {
		return [
			'optin_monster_api_activation_redirect_disabled' => 'true',
			'wpforms_activation_redirect'                    => 'true',
			'aioseo_activation_redirect'                     => 'false',
		];
	}
}
