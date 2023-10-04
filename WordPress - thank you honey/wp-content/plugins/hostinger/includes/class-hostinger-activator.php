<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Activator {
	public static function activate(): void {
		require_once HOSTINGER_ABSPATH . 'includes/class-hostinger-default-options.php';
		$options = new Hostinger_Default_Options();
		$options->add_options();
	}
}
