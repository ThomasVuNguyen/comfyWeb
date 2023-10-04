<?php
/**
 * Recommends plugins for use with the theme via the TGMA
 * @package	Nexter
 * @since	1.0.0
 */

add_action( 'tgmpa_register', 'nexter_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function nexter_register_required_plugins() {
	/*
	 * Recommends Plugins arrays
	 */
	$plugins = array(
		array(
			'name'         => 'Nexter Extension',
			'slug'         => 'nexter-extension',
			'required'     => false,
			'force_activation'   => false,
		),
		array(
			'name'         => 'Elementor',
			'slug'         => 'elementor',
			'required'     => false,
			'force_activation'   => false,
		),
		array(
			'name'         => 'The Plus Addons for Block Editor',
			'slug'         => 'the-plus-addons-for-block-editor',
			'required'     => false,
			'force_activation'   => false,
		),
		array(
			'name'         => 'The Plus Addons for Elementor Page Builder Lite',
			'slug'         => 'the-plus-addons-for-elementor-page-builder',
			'required'     => false,
			'force_activation'   => false,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'nexter',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
