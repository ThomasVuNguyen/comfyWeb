<?php
/**
 * Handles TGMPA functionalities.
 *
 * @since 1.5.0
 *
 * @package Jupiter\Framework\Admin\TGMPA
 */

add_action( 'tgmpa_register', 'jupiterx_register_tgmpa_plugins' );
/**
 * Register the required plugins.
 *
 * @since 1.5.0
 *
 * @SuppressWarnings(PHPMD.ElseExpression)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
function jupiterx_register_tgmpa_plugins() {
	if ( ! jupiterx_is_premium() ) :
		$free_plugins = [
			[
				'name' => esc_html__( 'Jupiter X Core', 'jupiterx-lite' ),
				'slug' => 'jupiterx-core',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
			],
			[
				'name' => esc_html__( 'Elementor', 'jupiterx-lite' ),
				'slug' => 'elementor',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
			],
			[
				'name' => esc_html__( 'Advanced Custom Fields', 'jupiterx-lite' ),
				'slug' => 'advanced-custom-fields',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
			],
			[
				'name' => esc_html__( 'Lazy Load', 'jupiterx-lite' ),
				'slug' => 'lazy-load',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
				'label_type' => esc_html__( 'Optional', 'jupiterx-lite' ),
			],
			[
				'name' => esc_html__( 'Woocommerce', 'jupiterx-lite' ),
				'slug' => 'woocommerce',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
				'label_type' => esc_html__( 'Optional', 'jupiterx-lite' ),
			],
			[
				'name' => esc_html__( 'Menu Icons by ThemeIsle', 'jupiterx-lite' ),
				'slug' => 'menu-icons',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
				'label_type' => esc_html__( 'Optional', 'jupiterx-lite' ),
			],
			[
				'name' => __( 'WunderWP', 'jupiterx-lite' ),
				'slug' => 'wunderwp',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
				'label_type' => __( 'Optional', 'jupiterx-lite' ),
			],
			[
				'name' => __( 'Growmatik', 'jupiterx-lite' ),
				'slug' => 'marketing-automation-and-personalization',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
				'label_type' => __( 'Optional', 'jupiterx-lite' ),
			],
			[
				'name' => __( 'LayerSlider WP', 'jupiterx-lite' ),
				'slug' => 'LayerSlider',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
				'label_type' => __( 'Optional', 'jupiterx-lite' ),
			],
			[
				'name' => __( 'WPBakery Page Builder (Modified Version)', 'jupiterx-lite' ),
				'slug' => 'js_composer_theme',
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
				'label_type' => __( 'Optional', 'jupiterx-lite' ),
			],
		];

		$plugins = apply_filters( 'jupiterx_tgmpa_plugins', $free_plugins );
	endif;

	if ( empty( $plugins ) ) {
		return;
	}

	$config = [
		'id'           => 'jupiterx',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	];

	tgmpa( $plugins, $config );
}

add_filter( 'tgmpa_plugin_action_links', 'jupiterx_tgmpa_go_pro_link' );
add_filter( 'tgmpa_network_admin_plugin_action_links', 'jupiterx_tgmpa_go_pro_link' );
/**
 * Change go pro action links in TGMPA.
 *
 * @param array $action_links List of action links.
 *
 * @since 1.10.0
 *
 * @return array $action_links Modified list of action links.
 */
function jupiterx_tgmpa_go_pro_link( $action_links ) {
	if ( isset( $action_links['pro'] ) ) {
		$action_links['pro'] = '<a href="' . esc_url( jupiterx_upgrade_link( 'plugins' ) ) . '" class="jupiterx-tgmpa-pro-plugin-action-link" target="_blank">' . esc_html__( 'Go Pro', 'jupiterx-lite' ) . '<span class="screen-reader-text">' . esc_html__( 'Buy Jupiter X', 'jupiterx-lite' ) . '</span></a>';
	}

	return $action_links;
}

if ( ! function_exists( 'jupiterx_filter_tgmpa_plugins' ) ) {
	/**
	 * Hide optional plugins in TGMPA page but load plugins for POST, DELETE type requests.
	 *
	 * @since 1.18.0
	 *
	 * @param array $plugins Array of plugins.
	 * @param array $includes Array of plugins that shouldn't be excluded.
	 * @return array
	 */
	function jupiterx_filter_tgmpa_plugins( $plugins, $includes = [] ) {
		if ( ! jupiterx_is_premium() ) {
			return array_filter( $plugins, function ( $plugin ) use ( $includes ) {
				if ( in_array( $plugin['slug'], $includes, true ) ) {
					return true;
				}

				return empty( $plugin['label_type'] ) || 'Optional' !== $plugin['label_type'];
			} );
		}

		return array_filter( $plugins, function ( $plugin ) use ( $includes ) {
			if ( in_array( $plugin['slug'], $includes, true ) ) {
				return true;
			}

			return ! empty( $plugin['required'] );
		} );
	}
}

/**
 * Hide Optional plugins in TGMPA table.
 *
 * @since 1.18.0
 */
add_action( 'before_tgmpa_plugins_table_render', function () {
	if ( empty( $GLOBALS['tgmpa'] ) || ! class_exists( 'TGM_Plugin_Activation' ) ) {
		return;
	}

	$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

	if ( empty( $instance ) ) {
		return;
	}

	$instance->plugins = jupiterx_filter_tgmpa_plugins( $instance->plugins, [
		'wunderwp',
	] );
});

/**
 * Exclude Optional plugins in TGMPA notice
 *
 * @since 1.18.0
 */
add_filter( 'jupiterx_tgmpa_filter_admin_notice_plugins', function ( $plugins ) {
	return jupiterx_filter_tgmpa_plugins( $plugins );
} );
