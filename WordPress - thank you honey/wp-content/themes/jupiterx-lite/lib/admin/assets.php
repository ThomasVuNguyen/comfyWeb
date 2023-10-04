<?php
/**
 * Manage admin assets.
 *
 * @package JupiterX\Framework\Admin
 *
 * @since 1.3.0
 */

jupiterx_add_smart_action( 'admin_enqueue_scripts', 'jupiterx_enqueue_admin_scripts' );
/**
 * Enqueue admin scripts.
 *
 * @since 1.3.0
 */
function jupiterx_enqueue_admin_scripts() {
	wp_enqueue_style( 'jupiterx-admin-icons', JUPITERX_ASSETS_URL . 'dist/css/icons-admin.css', [], JUPITERX_VERSION );
	wp_enqueue_style( 'jupiterx-common', JUPITERX_ASSETS_URL . 'dist/css/common' . JUPITERX_MIN_CSS . '.css', [], JUPITERX_VERSION );

	if ( jupiterx_is_screen( 'widgets' ) ) {
		wp_enqueue_script( 'wp-color-picker-alpha', JUPITERX_ASSETS_URL . 'dist/js/wp-color-picker-alpha' . JUPITERX_MIN_JS . '.js', [ 'wp-color-picker' ], JUPITERX_VERSION, true );
		wp_enqueue_script( 'jupiterx-modal', JUPITERX_ASSETS_URL . 'dist/js/jupiterx-modal' . JUPITERX_MIN_JS . '.js', [], JUPITERX_VERSION, true );
		wp_enqueue_script( 'jupiterx-gsap', JUPITERX_ADMIN_URL . 'control-panel/assets/lib/gsap/gsap' . JUPITERX_MIN_JS . '.js', [], '1.19.1', true );
		wp_enqueue_style( 'jupiterx-modal', JUPITERX_ASSETS_URL . 'dist/css/jupiterx-modal' . JUPITERX_MIN_CSS . '.css', [], JUPITERX_VERSION );

		jupiterx_wpcolorpickeralpha_localize();
	}

	wp_enqueue_script( 'jupiterx-common', JUPITERX_ASSETS_URL . 'dist/js/common' . JUPITERX_MIN_JS . '.js', [ 'jquery', 'wp-util', 'updates' ], JUPITERX_VERSION, true );
	wp_localize_script(
		'jupiterx-common',
		'jupiterxUtils',
		[
			'proBadge'    => jupiterx_get_pro_badge(),
			'proBadgeUrl' => jupiterx_get_pro_badge_url(),
			'helpLinks'   => jupiterx_is_help_links(),
			'nonce'       => wp_create_nonce( 'jupiterx-nonce' ),
		]
	);
	wp_localize_script(
		'jupiterx-common',
		'jupiterx_admin_textdomain',
		[
			'add_custom_sidebar_modal_title' => esc_html__( 'Add New Custom Sidebar', 'jupiterx-lite' ),
			'add_custom_sidebar'             => esc_html__( 'Add Custom Sidebar', 'jupiterx-lite' ),
			'delete_custom_sidebar'          => esc_html__( 'Delete Custom Sidebar', 'jupiterx-lite' ),
			'deleting'                       => esc_html__( 'Deleting', 'jupiterx-lite' ),
			'learn_pro_features'             => __( 'Learn more about Pro features', 'jupiterx-lite' ),
			'pro_upgrade_title'              => __( 'Jupiter X is upgraded', 'jupiterx-lite' ),
			'pro_upgrade_text'               => __( 'Congrats! you have successfully upgraded to Jupiter X Pro. Now you can enjoy working with Jupiter X at its maximum potential.', 'jupiterx-lite' ),
			'activated_title'                => __( 'Jupiter X is activated', 'jupiterx-lite' ),
			'activated_text'                 => __( 'Congrats! Jupiter X is activated successfully. Now you can enjoy working with Jupiter at its maximum potential.', 'jupiterx-lite' ),
			'register_fail_title'            => __( 'Oops! Registration was unsuccessful.', 'jupiterx-lite' ),
			'register_fail_text'             => __( 'Your API key could not be verified. There is no such API key or it is used in another site', 'jupiterx-lite' ),
			'plugin_remove_title'            => __( 'Plugin removed', 'jupiterx-lite' ),
			'plugin_removed_text'            => __( 'You have successfully removed Jupiter X Pro plugin.', 'jupiterx-lite' ),
			'uninstall_pro_title'            => __( 'Uninstalling Jupiter X Pro Plugin', 'jupiterx-lite' ),
			// translators: 1: Pro Plugin notice. 2. Plugins page. 3. Installed Plugin. 4. Delete plugin. 5. Pro plugin name. 6. plugin.
			'important_notice_title'         => __( 'Important Notice!', 'jupiterx-lite' ),
			'important_notice_text'          => sprintf(
				'%1$s<br><br><small>%2$s <strong>%3$s</strong>, %4$s <strong>%5$s</strong> %6$s.</small>',
				__( 'Since Jupiter X v1.6.0, you will no longer need Jupiter X Pro plugin to be able to use premium features as we have moved those features to theme itself for a better user experience. Click the button down below to deactivate and delete the plugin from your site', 'jupiterx-lite' ),
				__( 'If the button does not work, please go to', 'jupiterx-lite' ),
				__( 'Plugins &gt; Installed Plugins', 'jupiterx-lite' ),
				__( 'deactivate and delete the', 'jupiterx-lite' ),
				__( 'Jupiter X Pro', 'jupiterx-lite' ),
				__( 'plugin', 'jupiterx-lite' )
			),
			'done'                           => __( 'Done', 'jupiterx-lite' ),
		]
	);

	wp_add_inline_style( 'jupiterx-common', '
#toplevel_page_jupiterx .menu-icon-generic div.wp-menu-image {
	background: url(' . esc_url( JUPITERX_ADMIN_ASSETS_URL ) . 'images/jupiterx-admin-menu-icon.svg) no-repeat 7px 6px !important;
	background-size: 22px auto !important;
	opacity: 0.6;
}
#toplevel_page_jupiterx .menu-icon-generic div.wp-menu-image:before {
	content: " ";
}' );

	if ( jupiterx_is_white_label() && jupiterx_get_option( 'white_label_cpanel_logo' ) ) {
		wp_add_inline_style( 'jupiterx-common', '
span.jupiterx-cp-jupiterx-logo {
	height: 55px;
	margin-top: 0;
	background: url( ' . esc_url( jupiterx_get_option( 'white_label_cpanel_logo' ) ) . ') no-repeat center center;
	background-size: 100%;
}' );
	}

	if ( 'jupiterx' === jupiterx_get( 'page' ) ) {
		wp_enqueue_style( 'jupiterx-welcome', JUPITERX_ASSETS_URL . 'dist/css/welcome' . JUPITERX_MIN_CSS . '.css', [], JUPITERX_VERSION );
		wp_enqueue_script( 'jupiterx-welcome', JUPITERX_ASSETS_URL . 'dist/js/welcome' . JUPITERX_MIN_CSS . '.js', [ 'jquery', 'wp-util' ], JUPITERX_VERSION, true );

		wp_localize_script(
			'jupiterx-welcome',
			'jupiterxWelcome',
			[
				'controlPanelUrl' => admin_url( 'admin.php?page=jupiterx' ),
				'isPremium' => jupiterx_is_premium(),
				'i18n' => [
					'defaultText'    => __( 'Install and activate all required plugins', 'jupiterx-lite' ),
					'installText' => __( 'Installing required plugins', 'jupiterx-lite' ),
					'activateText'   => __( 'Activating required plugins', 'jupiterx-lite' ),
					'redirecting'   => __( 'Redirecting', 'jupiterx-lite' ),
					'failedInstallText'   => __( 'An error occurred while downloading the plugin(s). ', 'jupiterx-lite' ),
					'failedActivateText'   => __( 'An error occurred while installing & activating the plugin(s). ', 'jupiterx-lite' ),
					'failedActionLinks'   => sprintf(
						// translators: 1: Site health url. 2. Team support url.
						__( 'Please check your<a href="%1$s" target="_blank"> site health </a> or contact our <a href="%2$s" target="_blank">support team</a>.', 'jupiterx-lite' ),
						esc_url( admin_url( 'site-health.php' ) ),
						esc_url( 'https://themes.artbees.net/docs/the-new-support-platform/' )
					),
				],
			]
		);
	}
}

jupiterx_add_smart_action( 'admin_print_footer_scripts', 'jupiterx_print_admin_templates' );
jupiterx_add_smart_action( 'jupiterx_print_templates', 'jupiterx_print_admin_templates' );
/**
 * Print admin JS templates.
 *
 * @since 1.3.0
 */
function jupiterx_print_admin_templates() {
	?>
	
	<script type="text/html" id="tmpl-jupiterx-progress-bar">
		<div class="progress">
			<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%"></div>
		</div>
	</script>
	
	<?php
}

add_action( 'admin_init', 'jupiterx_admin_scripts' );
/**
 * Register admin scripts.
 *
 * @since 1.11.0
 */
function jupiterx_admin_scripts() {
	wp_register_style( 'jupiterx-templates', JUPITERX_ASSETS_URL . 'dist/css/templates' . JUPITERX_MIN_CSS . '.css', [ 'jupiterx-modal' ], JUPITERX_VERSION );
	wp_register_script( 'jupiterx-templates', JUPITERX_ASSETS_URL . 'dist/js/templates' . JUPITERX_MIN_JS . '.js', [ 'jquery', 'underscore', 'jupiterx-modal' ], JUPITERX_VERSION, true );
	wp_localize_script( 'jupiterx-templates', 'jupiterxTemplates', [
		'siteUrl'           => home_url(),
		'adminAjaxUrl'      => admin_url( 'admin-ajax.php' ),
		'nonce'             => wp_create_nonce( 'jupiterx-nonce' ),
		'proBadgeUrl'       => jupiterx_get_pro_badge_url(),
		'isPremium'         => jupiterx_is_premium(),
		'upgradeLink'       => esc_url( jupiterx_upgrade_link( 'templates' ) ),
		'template'          => jupiterx_get_option( 'template_installed_id', null ),
		'api'               => 'https://themes.artbees.net/wp-json/templates/v1',
		'i18n'              => [
			'all'                   => esc_html__( 'All', 'jupiterx-lite' ),
			'empty'                 => esc_html__( 'No template found.', 'jupiterx-lite' ),
			'emptyInfo'             => esc_html__( 'Clear some filters and try again.', 'jupiterx-lite' ),
			'loadMore'              => esc_html__( 'Load More', 'jupiterx-lite' ),
			'import'                => esc_html__( 'Import', 'jupiterx-lite' ),
			'preview'               => esc_html__( 'Preview', 'jupiterx-lite' ),
			'confirm'               => esc_html__( 'Confirm', 'jupiterx-lite' ),
			'cancel'                => esc_html__( 'Cancel', 'jupiterx-lite' ),
			'discard'               => esc_html__( 'Discard', 'jupiterx-lite' ),
			'install'               => esc_html__( 'Install', 'jupiterx-lite' ),
			'yes'                   => esc_html__( 'Yes', 'jupiterx-lite' ),
			'askContinue'           => esc_html__( 'Are you sure to continue?', 'jupiterx-lite' ),
			'installTitle'          => esc_html__( 'Important Notice', 'jupiterx-lite' ),
			'installText'           => __( 'You are about to install <strong>{template}</strong> template. Installing a new template will remove all current data on your website. Are you sure you want to proceed?', 'jupiterx-lite' ),
			'mediaTitle'            => esc_html__( 'Include Images and Videos?', 'jupiterx-lite' ),
			'mediaText'             => sprintf(
				/* translators: Learn more URL */
				__( 'Would you like to import images and videos as preview? <br> Notice that all images are <strong>strictly copyrighted</strong> and you need to acquire the license in case you want to use them on your project. <a href="%s" target="_blank">Learn More</a>', 'jupiterx-lite' ),
				'https://themes.artbees.net/docs/installing-a-template'
			),
			'mediaConfirm'          => esc_html__( 'Do not include', 'jupiterx-lite' ),
			'mediaCancel'           => esc_html__( 'Include', 'jupiterx-lite' ),
			'progressTitle'         => esc_html__( 'Installing in progress...', 'jupiterx-lite' ),
			'progressBackup'        => esc_html__( 'Backup database', 'jupiterx-lite' ),
			'progressPackage'       => esc_html__( 'Downloading package', 'jupiterx-lite' ),
			'progressPlugins'       => esc_html__( 'Installing required plugins...', 'jupiterx-lite' ),
			'progressInstall'       => esc_html__( 'Installing in progress...', 'jupiterx-lite' ),
			'completedTitle'        => esc_html__( 'All Done!', 'jupiterx-lite' ),
			'completedText'         => esc_html__( 'Template is successfully installed.', 'jupiterx-lite' ),
			'errorTitle'            => esc_html__( 'Something went wrong!', 'jupiterx-lite' ),
			'errorText'             => esc_html__( 'There is an error while installing the template, please contact support.', 'jupiterx-lite' ),
			'customTitle'           => esc_html__( 'Choose how you want to import this template:', 'jupiterx-lite' ),
			'customMediaText'       => esc_html__( 'Include media (Copyrighted).', 'jupiterx-lite' ),
			'completeImportTitle'   => esc_html__( 'Full import ', 'jupiterx-lite' ),
			'completeImportText'    => esc_html__( 'Your current content, settings, widgets, etc. will be removed and the database will be reset. New page contents and settings will be replaced.', 'jupiterx-lite' ),
			'completeImportWarning' => esc_html__( 'All your current content, settings, widgets, etc. will be removed and the new content will be replaced.', 'jupiterx-lite' ),
			'partialImportTitle'    => esc_html__( 'Content import', 'jupiterx-lite' ),
			'partialImportText'     => esc_html__( 'Keep your current content, settings, widgets, etc. Only the new page contents will be imported.', 'jupiterx-lite' ),
			'plugins_used'          => __( 'Plugins Used', 'jupiterx-lite' ),
		],
	] );
}
