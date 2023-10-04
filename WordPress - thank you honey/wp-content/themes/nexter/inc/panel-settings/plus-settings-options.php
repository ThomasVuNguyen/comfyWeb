<?php 
/**
 * Nexter Settings Panel
 *
 * @package	Nexter
 * @since	1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}
/**
 * White Label Content
 */
function nexter_white_label_content(){
	echo '<div class="nxt-pro-note-title"><p style="margin-bottom:50px;">'.esc_html__('White Label our plugin and setup client\'s branding all around. You can update name, description, Icon and even hide the menu from dashboard. Get our pro version to have access of this feature.','nexter').'</p></div>
		<div style="text-align:center;">
			<img style="width:55%;" src="'.esc_url(NXT_THEME_URI .'assets/images/white-lable.png').'" alt="'.esc_attr__('White Label','nexter').'" class="panel-plus-white-lable" />
		</div>';
}
add_action('nexter_white_label_notice', 'nexter_white_label_content' );

/**
 * Activate Content
 */
function nexter_activate_content(){
	echo '<div class="nxt-active-notice-pro">
			<img style="width:55%;" src="'.esc_url(NXT_THEME_URI .'assets/images/activate.png').'" alt="'.esc_attr__('Activate','nexter').'" class="panel-plus-activate" />
			<div class="nxt-pro-active-msg">Have you already bought a <a href="'.esc_url('https://nexterwp.com/pricing/').'" target="_blank" rel="noreferrer noopener">PRO</a> version? Visit store <a href="'.esc_url('https://store.posimyth.com/downloads/').'" target="_blank" rel="noreferrer noopener">https://store.posimyth.com/downloads/</a> to download latest pro plugin</div>
		</div>';
}
add_action('nexter_activate_notice', 'nexter_activate_content' );

/**
 * Performance Notice Content
 */
function nexter_site_performance_notice_content(){
	echo '<div class="nxt-pro-note-title"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/free-notice.svg').'" alt="free-pro-notice"/><p style="margin-bottom:40px;">'.esc_html__('Sorry! You have to install & activate “Nexter Extension” plugin to use available option.','nexter').'</p></div>
		<div class="nxt-pro-note-link">'.wp_kses_post(nexter_ext_plugin_load_notice()).'</div>';
}
add_action('nexter_site_performance_notice', 'nexter_site_performance_notice_content' );

/**
 * Security Notice Content
 */
function nexter_site_security_notice_content(){
	echo '<div class="nxt-pro-note-title"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/free-notice.svg').'" alt="free-pro-notice"/><p style="margin-bottom:40px;">'.esc_html__('Sorry! You have to install & activate “Nexter Extension” plugin to use available option.','nexter').'</p></div>
		<div class="nxt-pro-note-link">'.wp_kses_post(nexter_ext_plugin_load_notice()).'</div>';
}
add_action('nexter_site_security_notice', 'nexter_site_security_notice_content' );

/**
 * Nexter Extensions load Notice
 */
function nexter_ext_plugin_load_notice() {
	$plugin = 'nexter-extension/nexter-extension.php';
	$output = '';
	$installed_plugins = get_plugins();
	if ( isset( $installed_plugins[ $plugin ] ) ) {
		if ( ! current_user_can( 'activate_plugins' ) ) { return; }
		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
		$output .= sprintf( '<a href="%s">%s</a>', $activation_url, esc_html__( 'Activate Nexter Extensions', 'nexter' ) );
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) { return; }
		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=nexter-extension' ), 'install-plugin_nexter-extension' );
		$output .= sprintf( '<a href="%s">%s</a>', $install_url, esc_html__( 'Install Nexter Extension', 'nexter' ) );
	}
	return wp_kses_post($output);
}

/*
 * Extra options Config
 * @since 1.1.0
 */
function nexter_extension_option_config(){
	$config = [
		'google-recaptcha' => [
			'title' => esc_html__( 'Google reCAPTCHA', 'nexter' ),
			'description' => esc_html__( 'Stop Spammers and Bad bots from visiting your site. Add Google reCAPTCHA on your WP-Admin, comments etc.', 'nexter' ),
			'type' => 'free',
			'svg' => NXT_THEME_URI.'assets/images/panel-icon/google-recaptch.svg',
			'priority' => 5,
			'button' => true,
		],
		'wp-replace-url' => [
			'title' => esc_html__( 'Replace URL', 'nexter' ),
			'description' => esc_html__( 'Facing HTTPS issues or moved staging to live?  Replace your olddomain.com with newdomain.com from completely from database.', 'nexter' ),
			'type' => 'free',
			'svg' => NXT_THEME_URI.'assets/images/panel-icon/replace-url.svg',
			'priority' => 7,
			'button' => false,
		],
		'wp-duplicate-post' => [
			'title' => esc_html__( 'Duplicate Post', 'nexter' ),
			'description' => esc_html__( 'This option gives you to duplicate any post types including taxonomies & custom fields.', 'nexter' ),
			'type' => 'free',
			'svg' => NXT_THEME_URI.'assets/images/panel-icon/duplicate-post.svg',
			'priority' => 8,
			'button' => true,
		],
	];

	return apply_filters('nexter-extension-extra-option-config', $config );
}

/**
 * Extra Options Import Export Customizer
 * @since 1.0.11
 */
function nexter_extra_options_content(){
	$config_option = nexter_extension_option_config();

	$extension = get_option( 'nexter_extra_ext_options' );
	echo '<div class="nxt-extra-opt-wrap nxt-mt-50">';
		echo '<div class="nxt-panel-row">';
			if( !empty($config_option) ){
				$columns = array_column($config_option, 'priority');
				array_multisort($columns, SORT_ASC, $config_option);

				foreach($config_option as $name => $data){
					echo '<div class="nxt-panel-col nxt-panel-col-33">';
						echo '<div class="nxt-panel-sec nxt-'.esc_attr($name).' nxt-p-20">';
							echo '<div class="nxt-extra-icon"><img src="'.esc_url($data['svg']).'" alt="'.esc_attr($name).'" /></div>';
							echo '<div class="nxt-extra-title">';
								echo wp_kses_post($data['title']);
								echo '<span class="nxt-desc-icon" >';
									echo '<img src="'.esc_url( NXT_THEME_URI.'assets/images/panel-icon/desc-icon.svg').'" alt="'.esc_attr($name).'" /> ';
									echo '<div class="nxt-tooltip">'.wp_kses_post($data['description']).'</div>';
								echo '</span>';
							echo '</div>';
							if($data['button'] == true){
								if( !empty($extension) && !empty($extension[ $name ]) && !empty($extension[ $name ]['switch'])){
									echo '<button class="nxt-ext-btn nxt-ext-deactivate" data-ext="'.esc_attr($name).'" data-enable-disable="deactive"><span>'.esc_html__( 'Deactivate', 'nexter' ).'</span></button>';
									echo '<button class="nxt-ext-btn nxt-ext-settings" data-ext="'.esc_attr($name).'"><span><img src ="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/setting.svg').'" alt="Setting" /></span></button>';
								}else{
									echo '<button class="nxt-ext-btn nxt-ext-active" data-ext="'.esc_attr($name).'" data-enable-disable="active"><span>'.esc_html__( 'Enable', 'nexter' ).'</span></button>';
								}
							}else{
								if($name == 'branded-wp-admin'){
									echo '<button class="nxt-ext-coming-soon" data-ext="'.esc_attr($name).'"><span>'.esc_html__( 'Coming Soon', 'nexter' ).'</span></button>';
								}else{
									echo '<button class="nxt-ext-btn nxt-ext-settings" data-ext="'.esc_attr($name).'"><span>'.esc_html__( 'Settings', 'nexter' ).'</span></button>';
								}
							}
						echo '</div>';
					echo '</div>';
				}
			}
		echo '</div>';
	echo '</div>';
	?>
	<div class="nxt-customizer-import-export">
		<div class="nxt-sec-title nxt-ie-heading-title"><?php echo esc_html__( 'Import & Export of Theme Customizer Settings', 'nexter' ); ?></div>
		<div class="nxt-customizer-export-wrap">
			<h3 class="nxt-cust-ie-title"><span><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="file-download" class="svg-inline--fa fa-file-download" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="25"><path fill="currentColor" d="M369.9 97.98L286.02 14.1c-9-9-21.2-14.1-33.89-14.1H47.99C21.5.1 0 21.6 0 48.09v415.92C0 490.5 21.5 512 47.99 512h288.02c26.49 0 47.99-21.5 47.99-47.99V131.97c0-12.69-5.1-24.99-14.1-33.99zM256.03 32.59c2.8.7 5.3 2.1 7.4 4.2l83.88 83.88c2.1 2.1 3.5 4.6 4.2 7.4h-95.48V32.59zm95.98 431.42c0 8.8-7.2 16-16 16H47.99c-8.8 0-16-7.2-16-16V48.09c0-8.8 7.2-16.09 16-16.09h176.04v104.07c0 13.3 10.7 23.93 24 23.93h103.98v304.01zM208 216c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v88.02h-52.66c-11 0-20.59 6.41-25 16.72-4.5 10.52-2.38 22.62 5.44 30.81l68.12 71.78c5.34 5.59 12.47 8.69 20.09 8.69s14.75-3.09 20.09-8.7l68.12-71.75c7.81-8.2 9.94-20.31 5.44-30.83-4.41-10.31-14-16.72-25-16.72H208V216zm42.84 120.02l-58.84 62-58.84-62h117.68z"></path></svg></span><?php echo esc_html__( 'Export Settings', 'nexter' ); ?></h3>
			<p><?php echo esc_html__( 'Export all your theme customizer settings using below button.', 'nexter' ); ?></p>
			<form method="post">
				<input type="hidden" name="nxt_customizer_export_action" value="nxt_export_cust" />
				<p style="margin-bottom:0">
					<?php wp_nonce_field( 'nexter_export_cust_nonce', 'nexter_export_cust_nonce' ); ?>
					<?php submit_button( __( 'Export Settings', 'nexter' ), 'nxt-cust-ie-btn', 'submit', false, array( 'id' => '' ) ); ?>
				</p>
			</form>
		</div>
		<div class="nxt-customizer-import-wrap">
			<h3 class="nxt-cust-ie-title"><span><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="file-upload" class="svg-inline--fa fa-file-upload fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="25"><path fill="currentColor" d="M369.9 97.98L286.02 14.1c-9-9-21.2-14.1-33.89-14.1H47.99C21.5.1 0 21.6 0 48.09v415.92C0 490.5 21.5 512 47.99 512h288.02c26.49 0 47.99-21.5 47.99-47.99V131.97c0-12.69-5.1-24.99-14.1-33.99zM256.03 32.59c2.8.7 5.3 2.1 7.4 4.2l83.88 83.88c2.1 2.1 3.5 4.6 4.2 7.4h-95.48V32.59zm95.98 431.42c0 8.8-7.2 16-16 16H47.99c-8.8 0-16-7.2-16-16V48.09c0-8.8 7.2-16.09 16-16.09h176.04v104.07c0 13.3 10.7 23.93 24 23.93h103.98v304.01zm-180.1-247.32l-68.12 71.75c-7.81 8.2-9.94 20.31-5.44 30.83 4.41 10.31 14 16.72 25 16.72H176V424c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-88.02h52.66c11 0 20.59-6.41 25-16.72 4.5-10.52 2.38-22.62-5.44-30.81l-68.12-71.78c-10.69-11.19-29.51-11.2-40.19.02zm-38.75 87.29l58.84-62 58.84 62H133.16z"></path></svg></span><?php echo esc_html__( 'Import Settings', 'nexter' ); ?></h3>
			<p><?php echo esc_html__( 'Import file to get all your customizer settings.', 'nexter' ); ?></p>
			<form method="post" enctype="multipart/form-data">
				<p><input type="file" name="nxt_import_file"/></p>
				<p style="margin-bottom:0">
					<input type="hidden" name="nxt_customizer_import_action" value="nxt_import_cust" />
					<?php wp_nonce_field( 'nexter_import_cust_nonce', 'nexter_import_cust_nonce' ); ?>
					<?php submit_button( __( 'Import', 'nexter' ), 'nxt-cust-ie-btn', 'submit', false, array( 'id' => '' ) ); ?>
				</p>
			</form>
			<?php 
				$imported = ( isset($_GET['status_customizer']) && !empty($_GET['status_customizer']) ) ? sanitize_text_field($_GET['status_customizer']) : '';
				if(!empty($imported) && $imported=='success'){
					echo '<div class="nxt-import-success-msg">'.esc_html__( 'Success! All Settings are Imported. Check that in Theme Customer.', 'nexter' ).'</div>';
				}
			?>
		</div>
	</div>
	<?php
}
add_action('nexter_extra_options_render', 'nexter_extra_options_content' );

function nexter_help_actions_render(){
	echo '<div class="nxt-welcome-support-toggle" title="'.esc_attr__('Need Help?','nexter').'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M202.021 0C122.202 0 70.503 32.703 29.914 91.026c-7.363 10.58-5.093 25.086 5.178 32.874l43.138 32.709c10.373 7.865 25.132 6.026 33.253-4.148 25.049-31.381 43.63-49.449 82.757-49.449 30.764 0 68.816 19.799 68.816 49.631 0 22.552-18.617 34.134-48.993 51.164-35.423 19.86-82.299 44.576-82.299 106.405V320c0 13.255 10.745 24 24 24h72.471c13.255 0 24-10.745 24-24v-5.773c0-42.86 125.268-44.645 125.268-160.627C377.504 66.256 286.902 0 202.021 0zM192 373.459c-38.196 0-69.271 31.075-69.271 69.271 0 38.195 31.075 69.27 69.271 69.27s69.271-31.075 69.271-69.271-31.075-69.27-69.271-69.27z"/></svg></div>';

	echo '<div class="nxt-welcome-support-content">';
		echo '<div class="nxt-sup-top">';
				echo '<h3 class="nxt-quick-sup-title">'.esc_html__('Quick support','nexter').'</h3>';
				if(defined('NXT_PRO_EXT') && class_exists('Nexter_Pro_Ext_Activate')){
					$active_status = Nexter_Pro_Ext_Activate::nexter_ext_pro_activate_msg();
					if(!empty($active_status) && isset($active_status['status']) && $active_status['status']=='valid'){
						echo '<a class="nxt-sup-free-btn pro-activated" ><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/diamond.svg').'" />'.esc_html__('PRO ACTIVATED','nexter').'</a>';
					}
				}else{
					echo '<a class="nxt-sup-free-btn">'.esc_html__('FREE','nexter').'</a>';
				}
		echo '</div>';
		echo '<div class="nxt-support-inner">';
			echo '<ul class="nxt-support-list">';
					echo '<li><a href="'.( (!defined('NXT_PRO_EXT')) ? esc_url('https://wordpress.org/support/theme/nexter/') : esc_url('https://store.posimyth.com/helpdesk/')).'"  target="_blank" rel="noopener noreferrer"><span class="support-title-wrap"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/free-support-icon.svg').'" />'.( (!defined('NXT_PRO_EXT')) ? esc_html__('Get Free Support','nexter') : esc_html__('Get Premium Support','nexter') ).'</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" fill="none" stroke="#22379c"><path class="arrow-one" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-two" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-three" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></a></li>';
					echo '<li><a href="'.( (!defined('NXT_PRO_EXT')) ? esc_url('https://roadmap.nexterwp.com/updates?filter=Free+Theme') : esc_url('https://roadmap.nexterwp.com/updates')).'"  target="_blank" rel="noopener noreferrer"><span class="support-title-wrap sup-latest-update"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/support-latest-update.svg').'" />'.esc_html__('Latest Updates','nexter').'</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" fill="none" stroke="#22379c"><path class="arrow-one" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-two" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-three" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></a></li>';
					echo '<li><a href="'.esc_url('https://www.facebook.com/groups/139678088029161/').'" target="_blank" rel="noopener noreferrer"><span class="support-title-wrap"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/support-join-fb.svg').'" />'.esc_html__('Join Facebook Community','nexter').'</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" fill="none" stroke="#22379c"><path class="arrow-one" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-two" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-three" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></a></li>';
					echo '<li><a href="'.esc_url('https://roadmap.nexterwp.com/boards/feature-requests').'" target="_blank" rel="noopener noreferrer"><span class="support-title-wrap"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/support-new-fea.svg').'" />'.esc_html__('Suggest New Features','nexter').'</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" fill="none" stroke="#22379c"><path class="arrow-one" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-two" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-three" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></a></li>';
					echo '<li><a href="'.esc_url('https://roadmap.nexterwp.com/boards/bug').'" target="_blank" rel="noopener noreferrer"><span class="support-title-wrap"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/support-report-bug.svg').'" />'.esc_html__('Report Bug','nexter').'</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" fill="none" stroke="#22379c"><path class="arrow-one" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-two" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path  class="arrow-three" d="M1 15l7-7-7-7" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></a></li>';
			echo '</ul>';
			if( !defined('NXT_PRO_EXT') ){
				echo '<a href="'.esc_url('https://nexterwp.com/pricing/').'" class="sup-upgrade-get-pro"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/sup-upgrade-pro.svg').'" />'.esc_html__('Upgrade to PRO Version','nexter').'</a>';
			}
			echo '<div class="nxt-panel-row" style="justify-content: space-between;">';
					echo '<a href="'.esc_url('https://www.youtube.com/c/POSIMYTHInnovations/?sub_confirmation=1').'" class="nxt-panel-col sup-social-link" title="'.esc_html__('Youtube','nexter').'" target="_blank" rel="noopener noreferrer"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" ><path d="M13.685 4.09c-.161-.604-.633-1.08-1.234-1.242C11.363 2.555 7 2.555 7 2.555s-4.363 0-5.451.293C.948 3.01.476 3.485.315 4.09.024 5.185.024 7.47.024 7.47s0 2.285.292 3.38c.16.604.633 1.06 1.234 1.222 1.088.293 5.451.293 5.451.293s4.363 0 5.451-.293c.6-.162 1.073-.617 1.234-1.222.292-1.095.292-3.38.292-3.38s0-2.285-.292-3.38zM5.573 9.544V5.395L9.22 7.47 5.573 9.544z" fill="#22379b"/></svg></span></a>';
					echo '<a href="'.esc_url('https://twitter.com/posimyth').'" class="nxt-panel-col sup-social-link" title="'.esc_html__('Twitter','nexter').'" target="_blank" rel="noopener noreferrer"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" ><path d="M12.561 4.148l.009.373c0 3.793-2.887 8.164-8.164 8.164A8.11 8.11 0 0 1 0 11.397c.231.027.453.036.693.036 1.341 0 2.576-.453 3.562-1.226-1.261-.027-2.319-.853-2.683-1.99a3.62 3.62 0 0 0 .542.044c.258 0 .515-.036.755-.098A2.87 2.87 0 0 1 .569 5.348v-.036a2.89 2.89 0 0 0 1.297.364C1.093 5.161.586 4.282.586 3.287a2.85 2.85 0 0 1 .391-1.448C2.39 3.58 4.513 4.717 6.893 4.841a3.24 3.24 0 0 1-.071-.657 2.87 2.87 0 0 1 2.869-2.869 2.86 2.86 0 0 1 2.096.906 5.65 5.65 0 0 0 1.821-.693 2.86 2.86 0 0 1-1.261 1.581A5.75 5.75 0 0 0 14 2.665a6.17 6.17 0 0 1-1.439 1.483z" fill="#22379b"/></svg></span></a>';
					echo '<a href="'.esc_url('https://www.facebook.com/nexterwp').'" class="nxt-panel-col sup-social-link" title="'.esc_html__('Facebook','nexter').'" target="_blank" rel="noopener noreferrer"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" ><path d="M10.257 7.875l.389-2.534H8.215V3.697c0-.693.34-1.369 1.428-1.369h1.105V.171S9.746 0 8.787 0C6.785 0 5.476 1.214 5.476 3.41v1.931H3.25v2.534h2.226V14h2.739V7.875h2.042z" fill="#22379b"/></svg></span></a>';
					echo '<a href="'.esc_url('https://www.instagram.com/posimyth').'" class="nxt-panel-col sup-social-link" title="'.esc_html__('Instagram','nexter').'" target="_blank" rel="noopener noreferrer"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" ><path d="M7.003 3.855c-1.739 0-3.142 1.403-3.142 3.142s1.403 3.142 3.142 3.142 3.142-1.403 3.142-3.142-1.403-3.142-3.142-3.142zm0 5.184c-1.124 0-2.043-.916-2.043-2.043s.916-2.043 2.043-2.043 2.043.916 2.043 2.043S8.127 9.04 7.003 9.04zm4.003-5.313a.73.73 0 1 1-1.466 0c0-.405.328-.733.733-.733s.733.328.733.733zm2.081.744c-.046-.982-.271-1.851-.99-2.568S10.511.962 9.529.913C8.518.856 5.485.856 4.473.913c-.979.046-1.848.271-2.568.987S.965 3.486.916 4.468C.859 5.48.859 8.512.916 9.524c.046.982.271 1.851.99 2.568s1.586.941 2.568.99c1.012.057 4.044.057 5.056 0 .982-.046 1.851-.271 2.568-.99s.941-1.586.99-2.568c.057-1.012.057-4.041 0-5.053zm-1.307 6.139c-.213.536-.626.949-1.165 1.165-.807.32-2.721.246-3.612.246s-2.808.071-3.612-.246a2.07 2.07 0 0 1-1.165-1.165c-.32-.807-.246-2.721-.246-3.612s-.071-2.808.246-3.612c.213-.536.626-.949 1.165-1.165.807-.32 2.721-.246 3.612-.246s2.808-.071 3.612.246a2.07 2.07 0 0 1 1.165 1.165c.32.807.246 2.721.246 3.612s.074 2.808-.246 3.612z" fill="#22379b"/></svg></span></a>';
					echo '<a href="'.esc_url('https://nexterwp.com/blog').'" class="nxt-panel-col sup-social-link" title="'.esc_html__('Blogs','nexter').'" target="_blank" rel="noopener noreferrer"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" ><path d="M1.574 4.815a.66.66 0 0 0-.698.61c-.023.361.251.674.612.697 3.284.215 6.171 3.082 6.387 6.388.023.35.311.615.63.615l.044-.002c.361-.023.636-.336.612-.697C8.93 8.485 5.515 5.07 1.574 4.815zM1.75.875c-.483 0-.875.391-.875.875s.392.875.875.875a9.64 9.64 0 0 1 9.625 9.625c0 .484.392.875.875.875s.875-.391.875-.875A11.39 11.39 0 0 0 1.75.875zm.85 8.747c-.943 0-1.725.785-1.725 1.753s.783 1.75 1.725 1.75a1.77 1.77 0 0 0 1.752-1.75c0-.967-.76-1.753-1.752-1.753z" fill="#22379b"/></svg></span></a>';
					echo '<a href="'.esc_url('https://store.posimyth.com/join-affiliate/').'" class="nxt-panel-col sup-social-link" title="'.esc_html__('Join Affliate','nexter').'" target="_blank" rel="noopener noreferrer"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" ><path d="M7.031 11.874c-.653 0-1.241-.079-1.764-.238-.523-.168-1.022-.457-1.498-.868-.121-.103-.215-.219-.28-.35a.87.87 0 0 1-.098-.392.79.79 0 0 1 .224-.56c.159-.168.355-.252.588-.252a.74.74 0 0 1 .476.168c.355.289.705.509 1.05.658.355.149.789.224 1.302.224.345 0 .663-.051.952-.154.289-.112.523-.257.7-.434.177-.187.266-.397.266-.63a1.06 1.06 0 0 0-.252-.714c-.168-.196-.425-.359-.77-.49-.345-.14-.784-.247-1.316-.322-.504-.075-.947-.187-1.33-.336-.383-.159-.705-.355-.966-.588a2.45 2.45 0 0 1-.574-.84c-.131-.327-.196-.691-.196-1.092 0-.607.154-1.125.462-1.554.317-.429.742-.756 1.274-.98s1.12-.336 1.764-.336c.607 0 1.167.093 1.68.28.523.177.947.406 1.274.686.271.215.406.462.406.742 0 .205-.079.392-.238.56s-.345.252-.56.252c-.14 0-.266-.042-.378-.126-.149-.131-.35-.252-.602-.364a4.52 4.52 0 0 0-.798-.294c-.28-.084-.541-.126-.784-.126-.401 0-.742.051-1.022.154-.271.103-.476.243-.616.42s-.21.383-.21.616c0 .28.079.513.238.7.168.177.406.322.714.434a9.02 9.02 0 0 0 1.106.28c.56.103 1.05.224 1.47.364.429.14.784.322 1.064.546a1.98 1.98 0 0 1 .63.826c.14.327.21.728.21 1.204 0 .607-.168 1.129-.504 1.568s-.779.775-1.33 1.008c-.541.233-1.129.35-1.764.35zm1.008.756c0 .243-.084.443-.252.602-.159.168-.359.252-.602.252-.233 0-.429-.084-.588-.252-.159-.159-.238-.359-.238-.602V1.374c0-.243.079-.443.238-.602.168-.168.373-.252.616-.252s.439.084.588.252c.159.159.238.359.238.602V12.63z" fill="#22379c"/></svg></span></a>';
			echo '</div>';
		echo '</div>';
		echo '<a href="'.esc_url('https://posimyth.com/').'" class="nxt-support-bottom" target="_blank" rel="noopener noreferrer">'.esc_html__('Powered by POSIMYTH Innovations','nexter').'</a>';
	echo '</div>';
}
add_action('nexter_help_actions', 'nexter_help_actions_render');

/**
 * Import Data Content
 */
function nexter_import_data_content(){
	echo '<div class="nxt-import-data-content">
			<div class="nxt-import-steps import-step-1 active" data-step="step-1">
				<div class="nxt-import-heading">'.esc_html__('Select Your Page Builder :','nexter').'</div>
				<div class="nxt-select-builder textleft">
					<input type="radio" name="nxt-select-build" id="builder-gutenberg" value="gutenberg" />
					<label class="nxt-builder-select" for="builder-gutenberg">
						<span><img src="'.esc_url(NXT_THEME_URI .'assets/images/gutenberg.png').'" alt="'.esc_attr__('Gutenberg','nexter').'" /></span>
						<span>'.esc_html__('Gutenberg','nexter').'</span>
					</label>
					<input type="radio" name="nxt-select-build" id="builder-elementor" value="elementor" />
					<label class="nxt-builder-select" for="builder-elementor">
						<span><img src="'.esc_url(NXT_THEME_URI .'assets/images/elementor.png').'" alt="'.esc_attr__('Elementor','nexter').'" /></span>
						<span>'.esc_html__('Elementor','nexter').'</span>
					</label>
					<input type="radio" name="nxt-select-build" id="builder-beaver" value="beaver" />
					<label class="nxt-builder-select" for="builder-beaver">
						<span><img src="'.esc_url(NXT_THEME_URI .'assets/images/beaver.png').'" alt="'.esc_attr__('Beaver','nexter').'" /></span>
						<span>'.esc_html__('Beaver','nexter').'</span>
					</label>
				</div>
			</div>
			<div class="nxt-import-step-btn"><a href="#" class="import-step-next" data-step="step-2">'.esc_html__('Next','nexter').'</a></div>
		</div>';
}
add_action('nexter_import_data_render', 'nexter_import_data_content' );

class Nexter_Settings_Panel {
	
	/**
     * Option key, and option page slug
     */
    private $key = 'nexter_settings_opts';
	
	/**
     * Array of meta boxes/fields
     * @var array
     */
    protected $option_metabox = array();
    
	/**
     * Setting Name/Title
     * @var string
     */
    protected $setting_name = '';

	/**
     * Array of recaptch version
     * @var string
     */

	protected $nxtrecpVer,$nxtrecpForm,$recaptheme;

	/**
     * Constructor
     * @since 1.0.0
     */
    public function __construct() {
		
		if(defined('NXT_PRO_EXT')){
			$options = get_option( 'nexter_white_label' );
			$this->setting_name = (!empty($options['brand_name'])) ? $options['brand_name'].esc_html__(' Settings', 'nexter') : esc_html__('Nexter Settings', 'nexter');
		}else{
			$this->setting_name = esc_html__('Nexter Settings', 'nexter');
		}
		
        $this->fields = array();

		$this->nxtrecpVer  = array( 
			'v2' => [ 
				'title' => sprintf( '%s 2', __( 'Version', 'nexter' ) ) , 
				'desc' => sprintf( '%s 2', __( 'reCAPTCHA v2 is added below the form fields, where user has to check the box to verify the human authenticity and if found suspicious it prompts verification challenge.', 'nexter' ) ) , 
			],
			'invisible'	=> [
				'title' => sprintf( '%s', __( 'v2 (Invisible)', 'nexter' ) ),
				'desc' => sprintf( '%s 3', __( 'Invisible reCAPTCHA is a better version of v2, where no checkbox verification is required. It works on a score of user interaction and if found suspicious it asks to submit a challenge.', 'nexter' ) ),
			],
			'v3' => [
				'title' => sprintf( '%s 3', __( 'Version', 'nexter' ) ),
				'desc' => sprintf( '%s 3', __( 'reCAPTCHA v3 is a user-friendly spam protection. It verifies the visitor on his score, which is based on overall website interaction. It is shown at the bottom left-side of the website.', 'nexter' ) ),
			],
		);

		$this->nxtrecpForm  = array(
			'login_form'				=> sprintf( '%s', __( 'Login Form', 'nexter' ) ),
			'registration_form'			=> sprintf( '%s', __('Registration Form', 'nexter' ) ),
			'reset_pwd_form'			=> sprintf( '%s', __( 'Reset Password Form', 'nexter' ) ),
			'comments_form'				=> sprintf( '%s', __( 'Comments Form', 'nexter' ) ),
		);

		$this->recaptheme = array(
			'light'        => sprintf( '%s', __( 'Light', 'nexter' ) ),
			'dark'        => sprintf( '%s', __('Dark', 'nexter' ) ),
		);
    }
	
	/**
     * Initiate hooks
	 * @since 1.0.11
     */
	public function hooks() {
        add_action('admin_init', array( $this,'init' ) );
        add_action('admin_menu', array( $this, 'nxt_add_menu_page' ));
		
		add_action( 'wp_ajax_nexter_import_data_step', [ $this, 'nexter_import_data_step_2' ] );
		add_action( 'wp_ajax_nexter_import_data_step_3', [ $this, 'nexter_import_data_step_3'] );
		add_action( 'wp_ajax_nexter_import_activate_builder', [ $this, 'nexter_import_activate_builder_ajax'] );
		
		add_action( 'admin_init', [ $this, 'nxt_customizer_export_data' ] );
		add_action( 'admin_init', [ $this, 'nxt_customizer_import_data' ] );

		
		
		if ( current_user_can( 'manage_options' ) ) {
			add_action( 'wp_ajax_nexter_extra_ext_active', [ $this, 'nexter_extra_ext_active_ajax'] );
			add_action( 'wp_ajax_nexter_extra_ext_deactivate', [ $this, 'nexter_extra_ext_deactivate_ajax'] );
			add_action( 'wp_ajax_nexter_ext_wp_replace_url_settings', [ $this, 'nexter_ext_wp_replace_url_settings_ajax'] );
			add_action( 'wp_ajax_nexter_ext_wp_duplicate_post_settings', [ $this, 'nexter_ext_wp_duplicate_post_settings_ajax'] );
			add_action( 'wp_ajax_nexter_ext_save_data', [ $this, 'nexter_ext_save_data_ajax']);
			add_action( 'wp_ajax_nexter_ext_google_recaptcha', [ $this, 'nexter_ext_google_recaptcha'] );
		}

		// Add Extra attr to script tag
		add_filter( 'script_loader_tag', [ $this,'nxt_async_attribute' ], 10, 2 );
    }
	
	/*
	 * Save Nexter Extension Data
	 * @since 1.1.0
	 */
	public function nexter_ext_save_data_ajax(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		
		if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		$ext = ( isset( $_POST['extension_type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['extension_type'] ) ) : '';
		$fonts = ( isset( $_POST['fonts'] ) ) ? wp_unslash( $_POST['fonts'] ) : '';
		$adminHide = ( isset( $_POST['adminHide'] ) ) ? wp_unslash( $_POST['adminHide'] ) : '';
		$recapData = ( isset( $_POST['recapData'] ) ) ? wp_unslash( $_POST['recapData'] ) : '';
		$wpDisableSet = ( isset( $_POST['wpDisableSet'] ) ) ? wp_unslash( $_POST['wpDisableSet'] ) : '';
		$performance = ( isset( $_POST['advanceperfo'] ) ) ? wp_unslash( $_POST['advanceperfo'] ) : '';
		$commdata = ( isset( $_POST['discomment'] ) ) ? wp_unslash( $_POST['discomment'] ) : '';
		$wpDupPostSet = ( isset( $_POST['wpDupPostSet'] ) ) ? wp_unslash( $_POST['wpDupPostSet'] ) : '';
		$wpWLSet = ( isset( $_POST['wpWLSet'] ) ) ? wp_unslash( $_POST['wpWLSet'] ) : '';
		$securData = ( isset( $_POST['securData'] ) ) ? wp_unslash( $_POST['securData'] ) : '';
		$nxtctmLogin = ( isset( $_POST['nxtctmLogin'] ) ) ? wp_unslash( $_POST['nxtctmLogin'] ) : '';

		$option_page = 'nexter_extra_ext_options';
		$get_option = get_option($option_page);

		$perforoption = 'nexter_site_performance';
		$getperoption = get_option($perforoption);

		$secr_opt = 'nexter_site_security';
		$getSecopt = get_option($secr_opt);

		$wlOption = 'nexter_white_label';
		$get_wl_option = get_option($wlOption);

		if( !empty( $ext ) && $ext==='local-google-font' && !empty($fonts)){
			if( !empty( $get_option ) && isset($get_option[ $ext ]) ){
				$get_option[ $ext ]['values'] = json_decode($fonts);
				update_option( $option_page, $get_option );
				Nexter_Font_Families_Listing::get_local_google_font_data();
			}
			wp_send_json_success();
		}else if(!empty( $ext ) && $ext==='custom-upload-font' && !empty($fonts)){
			if( !empty( $get_option ) && isset($get_option[ $ext ]) ){
				$get_option[ $ext ]['values'] = json_decode($fonts, true);
				update_option( $option_page, $get_option );
			}
			wp_send_json_success();
		}else if(!empty( $ext ) && $ext==='disable-admin-setting' && !empty($adminHide)){
			if( !empty( $get_option ) && isset($get_option[ $ext ]) ){
				$get_option[ $ext ]['values'] = json_decode($adminHide);
				update_option( $option_page, $get_option );
			}
			wp_send_json_success();
		}else if( !empty( $ext ) && $ext==='google-recaptcha' && !empty($recapData)){
			if( !empty( $get_option ) && isset($get_option[ $ext ]) ){
				$get_option[ $ext ]['values'] = json_decode($recapData, true);
				update_option( $option_page, $get_option );
			}
			wp_send_json_success();
		}else if( !empty( $ext ) && ( $ext==='advance-performance' && !empty($performance) ) || ($ext==='disable-comments' && !empty($commdata) ) ){
			$advanceData =  json_decode($performance);
			$disableComm = (array) json_decode($commdata);
			
			if( False === $getperoption ){	
				if(!empty($advanceData) ){
					add_option($perforoption,$advanceData);
				}else{
					add_option($perforoption,$disableComm);
				}
			}else{
				$get_option = get_option($perforoption);
				if(!empty($get_option)){
					if( $ext==='advance-performance'){
						$old_comment = [];
						$old_comment['disable_comments'] = (isset($get_option['disable_comments']) ? $get_option['disable_comments'] : '');
						$old_comment['disble_custom_post_comments'] = (isset($get_option['disble_custom_post_comments']) ? $get_option['disble_custom_post_comments'] : [] );

						$new = array_merge($old_comment,$advanceData);
					}else if($ext==='disable-comments'){
						if(isset($get_option['disable_comments'])){
							unset($get_option['disable_comments']);
						}
						if(isset($get_option['disable_comments'])){
							unset($get_option['disble_custom_post_comments']);
						}
						$new = array_merge($get_option,$disableComm);
					}
					update_option( $perforoption, $new );
				}
			}
			wp_send_json_success();
		}else if( !empty( $ext ) && ( $ext==='advance-security' && !empty($securData) ) || ( $ext==='custom-login' && !empty($nxtctmLogin) ) || ( $ext==='wp-right-click-disable' && !empty($wpDisableSet) ) ){

			$securData = (array) json_decode($securData);
			$nxtctmLogin = (array) json_decode($nxtctmLogin);
			$disrightclick = (array) json_decode($wpDisableSet);
		

			if( False === $getSecopt ){	
				if(!empty($securData) ){
					add_option($secr_opt,$securData);
				}else if(!empty($nxtctmLogin)){
					add_option($secr_opt,$nxtctmLogin);
				}else if(!empty($disrightclick)){
					$disValue[ $ext ]['values'] = $disrightclick;
					add_option($secr_opt,$disValue);
				}
			}else{
				$get_option = get_option($secr_opt);
				if(!empty($get_option)){

					if($ext==='advance-security'){

						if( false !== array_search('disable_xml_rpc', $get_option)){
							unset($get_option[array_search('disable_xml_rpc', $get_option)]);
						}
						if( false !== array_search('disable_wp_version', $get_option)){
							unset($get_option[array_search('disable_wp_version', $get_option)]);
						}
						if( false !== array_search('disable_rest_api_links', $get_option)){
							unset($get_option[array_search('disable_rest_api_links', $get_option)]);
						}
						if(isset($get_option['disable_rest_api'])){
							unset($get_option['disable_rest_api']);
						}

						$newArr = array_merge($get_option,$securData);

					}else if($ext==='custom-login'){
						if(isset($get_option['custom_login_url'])){
							unset($get_option['custom_login_url']);
						}
						if(isset($get_option['disable_login_url_behavior'])){
							unset($get_option['disable_login_url_behavior']);
						}
						if(isset($get_option['login_page_message'])){
							unset($get_option['login_page_message']);
						}
						$newArr = array_merge($get_option,$nxtctmLogin);
					}else if( $ext==='wp-right-click-disable' ){
						$oldEntry = [];
						$oldEntry['custom_login_url'] = (isset($get_option['custom_login_url']) ? $get_option['custom_login_url'] : '');
						$oldEntry['disable_login_url_behavior'] = (isset($get_option['disable_login_url_behavior']) ? $get_option['disable_login_url_behavior'] : [] );
						$oldEntry['login_page_message'] = (isset($get_option['login_page_message']) ? $get_option['login_page_message'] : '');

						if( in_array('disable_xml_rpc' , $get_option ,true ) ){
							array_push($oldEntry,'disable_xml_rpc');
						}
						if( in_array('disable_wp_version',$get_option,true ) ){
							array_push($oldEntry,'disable_wp_version');
						}
						if( in_array('disable_rest_api_links' , $get_option ,true ) ){
							array_push($oldEntry,'disable_rest_api_links');
						}
						$oldEntry['disable_rest_api'] = (isset($get_option['disable_rest_api']) ? $get_option['disable_rest_api'] : '');
						
						if(isset($get_option[ $ext ]['values']) && !empty($get_option[ $ext ]['values']) ){
							unset($get_option[ $ext ]['values']);
						}
						$newdata[ $ext ]['values'] =  $disrightclick;
						
						$newArr = array_merge($oldEntry,$newdata);
					}
					update_option( $secr_opt, $newArr );
				}
			}
			wp_send_json_success();

		}else if( !empty( $ext ) && $ext==='wp-duplicate-post' && !empty($wpDupPostSet)){
			if( !empty( $get_option ) && isset($get_option[ $ext ]) ){
				$get_option[ $ext ]['values'] = (array) json_decode($wpDupPostSet);
				update_option( $option_page, $get_option );
			}
			wp_send_json_success();
		}else if(!empty( $ext ) && $ext==='white-label' && !empty($wpWLSet)){
			$whiteLabelData =  (array) json_decode($wpWLSet);
			if( False === $get_wl_option ){
				add_option($wlOption,$whiteLabelData);
			}else{
				update_option( $wlOption, $whiteLabelData );
			}
			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/*
	 * Nexter WP Replace URL Settings
	 * @since 1.1.0
	 */
	public function nexter_ext_wp_replace_url_settings_ajax(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
			wp_send_json_success(
				array(
					'content'	=> __( 'Insufficient permissions.', 'nexter' ),
				)
			);
		}
		$output = '';
		$output .= '<div class="nxt-ext-modal-content">';
			$output .= '<div class="nxt-modal-title-wrap">';
				$output .= '<div class="nxt-modal-title">'.esc_html__( 'Replace URL & Text', 'nexter' ).'</div>';
				//$output .= '<div class="nxt-modal-desc">'.esc_html__( 'This option gives you to replace media url and text. ', 'nexter' ).'</div>';
			$output .= '</div>';
			
			$output .= '<div class="nxt-replace-url-wrap">';
				$output .= '<div class="nxt-replace-url-note"><strong>'.esc_html__('Important:', 'nexter').'</strong>'.esc_html__( ' We strongly recommend that you ', 'nexter' ).'<a href="https://wordpress.org/support/article/wordpress-backups/" target="_blank" rel="noopener noreferrer">'.esc_html__('backup your database', 'nexter').'</a>'.esc_html__( ' before using Replace URL & Text.', 'nexter' ).'</div>';
				$output .= '<label class="nxt-old-title">Old URL/Text<input type="url" class="nxt-old-url" placeholder="http://oldurl.com or old text"/></label>';
				$output .= '<label class="nxt-new-title">New URL/Text<input type="url" class="nxt-new-url" placeholder="http://newurl.com or new text"/></label>';
				$output .= '<span class="nxt-replace-case-wrap"><input type="checkbox" id="case_sensitive_toggle" name="case_sensitive_toggle" value="true"/><label for="case_sensitive_toggle"></label>Case Sensitive</span>';
				
				$output .= '<div class="nxt-replace-note-wrap"><p class="nxt-replace-url-notice"></p></div>';
				
				$output .= '<div class="nxt-replace-url-btn-wrap">';
					$output .= '<button class="nxt-replace-url-btn"><span>Replace</span></button>';
					$output .= '<button class="nxt-replace-url-confirm-btn"><span>Confirm</span></button>';
				$output .= '</div>';

			$output .= '</div>';
		$output .= '</div>';
					
		wp_send_json_success(
			array(
				'content'	=> $output,
			)
		);
	}


	/*
	 * Nexter WP Duplicate Post Settings
	 * @since 1.1.0
	 */
	public function nexter_ext_wp_duplicate_post_settings_ajax(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		$output = '';

		if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
			wp_send_json_success(
				array(
					'content'	=> __( 'Insufficient permissions.', 'nexter' ),
				)
			);
		}
		
		$ext = ( isset( $_POST['extension_type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['extension_type'] ) ) : '';
		$extension_option = get_option( 'nexter_extra_ext_options' );
		if( !empty( $ext ) && $ext == 'wp-duplicate-post' ){

			$all_users=$current_author=$original_date='checked';

			$original_user=$original_author=$current_date='';

			$sSame=$sDraft=$sPublised=$sPending=$sPrivate='';

			$postfixText= 'Copy'; $slugText='copy';
			$wpDupPostSet = (!empty($extension_option) && isset($extension_option['wp-duplicate-post']) && !empty($extension_option['wp-duplicate-post']['values']) ) ? $extension_option['wp-duplicate-post']['values'] : '';

			if(!empty($wpDupPostSet)){
				if(!empty($wpDupPostSet['nxt-duppost-access']) && $wpDupPostSet['nxt-duppost-access']=='original_user'){
					$original_user = 'checked';
					$all_users ='';
				}
				if(!empty($wpDupPostSet['nxt-duppost-author']) && $wpDupPostSet['nxt-duppost-author']=='original_author'){
					$original_author = 'checked';
					$current_author ='';
				}
				if(!empty($wpDupPostSet['nxt-duppost-date']) && $wpDupPostSet['nxt-duppost-date']=='current_date'){
					$current_date = 'checked';
					$original_date ='';
				}
				
				if(!empty($wpDupPostSet['nxt-duppost-status'])){
					if($wpDupPostSet['nxt-duppost-status']=='same'){
						$sSame='selected';
					}else if($wpDupPostSet['nxt-duppost-status']=='draft'){
						$sDraft='selected';
					}else if($wpDupPostSet['nxt-duppost-status']=='publish'){
						$sPublised='selected';
					}else if($wpDupPostSet['nxt-duppost-status']=='pending'){
						$sPending='selected';
					}else if($wpDupPostSet['nxt-duppost-status']=='private'){
						$sPrivate='selected';
					}
				}

				$postfixText = (!empty($wpDupPostSet['nxt-duplicate-postfix'])) ? $wpDupPostSet['nxt-duplicate-postfix'] : '';
				$slugText = (!empty($wpDupPostSet['nxt-duplicate-slug'])) ? $wpDupPostSet['nxt-duplicate-slug'] : '';

			}
			
			$output .= '<div class="nxt-ext-modal-content">';
				$output .= '<div class="nxt-modal-title-wrap">';
					$output .= '<div class="nxt-modal-title">'.esc_html__( 'Duplicate Post', 'nexter' ).'</div>';
					//$output .= '<div class="nxt-modal-desc">'.esc_html__( 'This option gives you to duplicate any post types including taxonomies & custom fields.', 'nexter' ).'</div>';
				$output .= '</div>';

				
				$output .='<div class="nxt-dup-post-row">';
					$output .='<div class="nxt-dup-post-column">';
						$output .='<div class="nxt-wp-duplicate-post-wrap" style="flex-direction: row; align-items: center;">
							<span class="nxt-wp-dppost-set-title">'.esc_html__('Who Can Duplicate','nexter').'</span>
							<div class="nxt-duppost-access">
								<input type="radio" value="all_users" name="nxt-who-dp" id="dp-all-users" '.$all_users.'/>
								<label for="dp-all-users">All Users</label>
								<input type="radio" value="original_user" name="nxt-who-dp" id="dp-original-user" '.$original_user.'/>
								<label for="dp-original-user">Original Author</label>
							</div>
						</div>';

						$output .='<div class="nxt-wp-duplicate-post-wrap" style="flex-direction: row; align-items: center;">
							<span class="nxt-wp-dppost-set-title">'.esc_html__('Post Author','nexter').'</span>
							<div class="nxt-duppost-author">
								<input type="radio" value="current_author" name="nxt-author-dp" id="dp-current-author" '.$current_author.'/>
								<label for="dp-current-author">Current User</label>
								<input type="radio" value="original_author" name="nxt-author-dp" id="dp-original-author" '.$original_author.'/>
								<label for="dp-original-author">Original Author</label>
							</div>
						</div>';

						$output .='<div class="nxt-wp-duplicate-post-wrap" style="flex-direction: row; align-items: center;">
							<span class="nxt-wp-dppost-set-title">'.esc_html__('Post Date','nexter').'</span>
							<div class="nxt-duppost-date">
								<input type="radio" value="original_date" name="nxt-date-dp" id="dp-original-date" '.$original_date.'/>
								<label for="dp-original-date">Duplicate Time</label>
								<input type="radio" value="current_date" name="nxt-date-dp" id="dp-current-date" '.$current_date.'/>
								<label for="dp-current-date">Current Time</label>
							</div>
						</div>';

						$output .='<div class="nxt-wp-duplicate-post-wrap" style="flex-direction: row; align-items: center; ">
							<span class="nxt-wp-dppost-set-title nxt-dis-style-title">'.esc_html__('Post Status','nexter').'</span>
							<select class="duplicate-post-status" style="margin-left: 10px">
								<option value="same" '.$sSame.'>Same as Original</option>
								<option value="draft" '.$sDraft.'>Draft</option>
								<option value="publish" '.$sPublised.'>Published</option>
								<option value="pending" '.$sPending.'>Pending</option>
								<option value="private" '.$sPrivate.'>Private</option>
							</select>
						</div>';

						$output .='<div class="nxt-wp-duplicate-post-wrap" style="flex-direction: row; align-items: center; ">
							<span class="nxt-wp-dppost-set-title">'.esc_html__('Postfix Text','nexter').'</span>
							<input class="nxt-duplicate-postfix" type="text" value="'.esc_attr($postfixText).'"/>
						</div>';
						$output .='<div class="nxt-wp-duplicate-post-wrap" style="flex-direction: row; align-items: center; ">
							<span class="nxt-wp-dppost-set-title">'.esc_html__('Slug Text','nexter').'</span>
							<input class="nxt-duplicate-slug" type="text" value="'.esc_attr($slugText).'"/>
						</div>';


					$output .= '</div>';
				$output .= '</div>';

				$output .= '<button type="button" class="nxt-duplicate-post-set"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>'.esc_html( 'Save', 'nexter' ).'</button>';
			$output .= '</div>';
						
			wp_send_json_success(
				array(
					'content'	=> $output,
				)
			);

		}
	}

	/*
	 * Nexter Google Recaptcha
	 * @since 1.1.0
	 */
	public function nexter_ext_google_recaptcha() {
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
			wp_send_json_success(
				array(
					'content'	=> __( 'Insufficient permissions.', 'nexter' ),
				)
			);
		}
		$ext = ( isset( $_POST['extension_type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['extension_type'] ) ) : '';
		$option = get_option( 'nexter_extra_ext_options' );
		$reoption = ( isset( $option['google-recaptcha'] ) && !empty($option['google-recaptcha']) && isset( $option['google-recaptcha']['values'] ) &&  !empty( $option['google-recaptcha']['values'] ) ) ? $option['google-recaptcha']['values'] : '' ;

		$output = '';
		if( !empty( $ext ) && $ext == 'google-recaptcha' ){
			$output .= '<div class="nxt-ext-modal-content">';
				$output .= '<div class="nxt-modal-title-wrap">';
					$output .= '<div class="nxt-modal-title">'.esc_html__( 'GOOGLE reCAPTCHA', 'nexter' ).'</div>';
					//$output .= '<div class="nxt-modal-desc">'.esc_html__( 'Serve your chosen Google Fonts from your own web server. This will increase the loading speed and makes sure your website complies with the privacy regulations.', 'nexter' ).'</div>';
				$output .= '</div>';
				$output .= '<div class="nxt-recaptch-wrap">';
					$output .= '<div class="nxt-recaptch-inner">';
						$output .= '<label class="upload-font-label">'.esc_html__( 'reCAPTCHA Version', 'nexter' ).'</label>';
						$output .= '<ul class="nxt-check-list">';
							foreach ( $this->nxtrecpVer as $version => $version_name ) {
								$output .= '<li>';
									$output .= '<input type="radio" id="'.$version.'" name="nexter_recaptcha_version" value="'.$version.'" '.( isset($reoption['version']) && !empty($reoption['version']) &&  $reoption['version'] == $version ? 'checked' : '' ).'  >';
									$output .= '<label for="'.$version.'">';
										$output .= $version_name['title'] ;
										$output .= '<span class="nxt-desc-icon" >';
											$output .= '<img src="'.esc_url( NXT_THEME_URI.'assets/images/panel-icon/desc-icon.svg').'" alt="'.esc_attr($version_name['title']).'" /> ';
											$output .= '<div class="nxt-tooltip bottom">'.wp_kses_post($version_name['desc']).'</div>';
										$output .= '</span>';
									$output .= '</label>';
								$output .= '</li>';
								
							}
						$output .= '</ul>'; 
					$output .= '</div>';
					$output .= '<div class="nxt-recaptch-inner nxt-spce-bet">';
						
						$output .= '<div class="nxt-recaptch-field">';
						$output .= '<label class="upload-font-label">'.esc_html__( 'Site Key', 'nexter' );
							$output .= '<span class="nxt-desc-icon" >';
								$output .= '<img src="'.esc_url( NXT_THEME_URI.'assets/images/panel-icon/desc-icon.svg').'" alt="'.esc_html__( 'Site Key', 'nexter' ).'" /> ';
								$output .= '<div class="nxt-tooltip right">';
                                    $output .= esc_html__( 'Copy your Site Key from your Google reCAPTCHA Account. ' , 'nexter' );
                                    $output .= sprintf('<a href="'.esc_url('https://www.google.com/recaptcha/admin#list').'" target="_blank" rel="noopener noreferrer" style="color : #fff;" >'.esc_html__('Get Keys' , 'nexter').'</a>');
                                $output .= '</div>';
							$output .= '</span>';
						$output .= '</label>';
						$output .= '<span class="dashicons dashicons-yes nxt-verify-icon '.( !isset($reoption['keyverify']) || true != $reoption['keyverify'] ? 'hidden' : '' ).' " ></span>';
							$output .= '<input type="text" class="nxt-recap-input" name="nexter_re_public_key" placeholder="'.esc_html('Please Enter Site Key','nexter').'"  value="'.( isset($reoption['siteKey']) && !empty($reoption['siteKey']) ? $reoption['siteKey'] : '' ).'" />';
							$output .= '<input type="hidden"  name="recaptch_verify"  value="'.( isset($reoption['keyverify']) && !empty($reoption['keyverify']) ? $reoption['keyverify'] : '' ).'" />';
						$output .= '</div>'; 

						$output .= '<div class="nxt-recaptch-field">';
							$output .= '<label class="upload-font-label">'.esc_html__( 'Secret Key', 'nexter' );
							$output .= '<span class="nxt-desc-icon" >';
								$output .= '<img src="'.esc_url( NXT_THEME_URI.'assets/images/panel-icon/desc-icon.svg').'" alt="'.esc_html__( 'Site Key', 'nexter' ).'" /> ';
								$output .= '<div class="nxt-tooltip right">';
                                    $output .= esc_html__( 'Copy your Secret Key from your Google reCAPTCHA Account. ' , 'nexter' );
                                    $output .= sprintf('<a href="'.esc_url('https://www.google.com/recaptcha/admin#list').'" target="_blank" rel="noopener noreferrer" style="color : #fff;" >'.esc_html__('Get Keys' , 'nexter').'</a>');
                                $output .= '</div>';
							$output .= '</span>';
							$output .= '</label>'; 
							$output .= '<span class="dashicons dashicons-yes nxt-verify-icon '.( !isset($reoption['keyverify']) || true != $reoption['keyverify'] ? 'hidden' : '' ).' " ></span>';
							$output .= '<input type="text" class="nxt-recap-input" name="nexter_re_private_key" placeholder="'.esc_html('Please Enter Secret Key','nexter').'" value="'.( isset($reoption['secretKey']) && !empty($reoption['secretKey']) ? $reoption['secretKey'] : '' ).'" />';
						$output .= '</div>';
					$output .= '</div>'; 

					if( ( isset($reoption['siteKey']) && !empty($reoption['siteKey']) ) && ( isset($reoption['secretKey']) && !empty($reoption['secretKey']) ) ){
						$output .= '<div class="nxt-recaptch-inner">';
							$output .= '<div class="nxt-recaptch-field">';
								$output .= '<button class="nxt-test-recaptch" id="nxtrecapver">';
									$output .= '<svg width="11" height="14" viewBox="0 0 11 14" stroke="white" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.25 6.56697C10.5833 6.75942 10.5833 7.24054 10.25 7.43299L1.25 12.6291C0.916666 12.8216 0.499999 12.581 0.499999 12.1961L0.5 1.80383C0.5 1.41893 0.916666 1.17836 1.25 1.37082L10.25 6.56697Z" /></svg>';
 									$output .= esc_html__( 'Test reCAPTCHA', 'nexter' );
								$output .=  '</button>';
								$output .= '<div class="nxtcptch-test-results"></div>';
							$output .= '</div>'; 
						$output .= '</div>';
					}

					$output .= '<div class="nxt-recaptch-inner">';
						$output .= '<label class="upload-font-label">'.esc_html__( 'Enable reCAPTCHA for', 'nexter' ).'</label>';
						$output .= '<ul class="nxt-check-list">';
							foreach ( $this->nxtrecpForm as $form => $form_name ) {
								$output .= '<li>';
									$output .= '<input type="checkbox" id="'.esc_attr($form).'" name="nexter_recaptcha_enable" value="'.esc_attr($form).'" '.( isset($reoption['formType']) && !empty($reoption['formType']) && in_array($form,$reoption['formType'])  ? 'checked' : '' ).' >';
									$output .= '<label for="'.esc_attr($form).'">'.esc_html( $form_name).'</label>';
								$output .= '</li>';
							}
						$output .= '</ul>'; 
					$output .= '</div>';
						
					if( isset($reoption['version']) && !empty($reoption['version']) &&  $reoption['version'] == 'v2' ){
						$output .= '<div class="nxt-recaptch-inner">';
							$output .= '<label class="upload-font-label">'.esc_html__( 'reCaptcha Theme', 'nexter' ).'</label>';
							$output .= '<ul class="nxt-check-list">';
								foreach ( $this->recaptheme as $theme => $theme_name ) {
									$output .= '<li>';
										$output .= '<input type="radio" id="'.esc_attr($theme).'" name="nexter_recaptcha_theme" value="'.esc_attr($theme).'" '.( isset($reoption['recapTheme']) && !empty($reoption['recapTheme']) &&  $reoption['recapTheme'] == $theme ? 'checked' : ( isset($reoption['recapTheme']) && empty($reoption['recapTheme']) && $theme == 'light' ? 'checked' : ''  ) ).' >';
										$output .= '<label for="'.esc_attr($theme).'">'.esc_html( $theme_name).'</label>';
									$output .= '</li>';
									
								}
							$output .= '</ul>'; 
						$output .= '</div>';
					}

					if( isset( $reoption['version'] ) && !empty( $reoption['version'] )  && ($reoption['version'] == 'v3' || $reoption['version'] == 'invisible' )){
						$output .= '<div class="nxt-recaptch-inner">';
							$output .= '<div class="nxt-recaptch-field">';
								$output .= '<label class="nxt-hide-recap">';
									$output .= '<input type="checkbox" name="nexter_recaptcha_invisi" value="1"'.( isset($reoption['invisi']) && !empty($reoption['invisi'])  ? 'checked' : '' ).' >';
									$output .= '<span class="nxt-recap-desc">';
										$output .= '<label class="upload-font-label">'.esc_html__( 'Hide reCaptcha Badge', 'nexter' ).'</label>';
										$output .= '<span>'.esc_html__( 'Enable to hide reCAPTCHA Badge for version 3 and invisible reCAPTCHA.', 'nexter' ). '</span>' ;
									$output .= '</span>';
								$output .= '</label>';
							$output .= '</div>';
						$output .= '</div>';
					}
				$output .= '</div>'; 
				$output .= '<button type="button" class="nxt-recaptcha-save"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>'.esc_html( 'Save', 'nexter' ).'</button>';
			$output .= '</div>'; 

			wp_send_json_success(
				array(
					'content'	=> $output,
				)
			);
		}
		wp_send_json_error();
	}

	/**
	 * Add the "async" attribute to our registered script.
	*/
	public function nxt_async_attribute( $tag, $handle ) {
		if ( 'nexter_recaptcha_api' == $handle ) {
			$tag = str_replace( ' src', ' data-cfasync="false" async="async" defer="defer" src', $tag );
		}
		return $tag;
	}

	/*
	 * Nexter Extra Option Active Extension
	 * @since 1.1.0
	 */
	public function nexter_extra_ext_active_ajax(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array( 
					'content' => __( 'Insufficient permissions.', 'nexter' ),
				)
			);
		}
		$type = ( isset( $_POST['extension_type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['extension_type'] ) ) : '';
		self::nxt_extra_active_deactive($type, 'active');
	}

	/*
	 * Nexter Extra Option DeActivate Extension
	 * @since 1.1.0
	 */
	public function nexter_extra_ext_deactivate_ajax(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array( 
					'content' => __( 'Insufficient permissions.', 'nexter' ),
				)
			);
		}
		$type = ( isset( $_POST['extension_type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['extension_type'] ) ) : '';
		self::nxt_extra_active_deactive($type, 'deactive');
	}

	public static function nxt_extra_active_deactive( $data = '', $switch = ''){
		
		if( empty( $data ) && empty($switch) ){
			wp_send_json_error(
				array( 
					'content' => __( 'server not found..', 'nexter' ),
				)
			);
		}else if( !empty( $data ) && !empty( $switch ) ){

			$option_page = 'nexter_extra_ext_options';
			if ( FALSE === get_option($option_page) ){
				$default_value = [ 
					$data => [
						'switch' => ($switch=='active') ? true : false,
					],
				];
				add_option($option_page,$default_value);
			}else{
				$get_option = get_option($option_page);
				if( !empty( $get_option ) ){
					$get_option[ $data ]['switch'] = ($switch=='active') ? true : false;
					update_option( $option_page, $get_option );
				}
			}
			wp_send_json_success(
				array(
					'content'	=> ($switch=='active') ? __( 'Activated', 'nexter' ) : __( 'DeActivate', 'nexter' ),
				)
			);
		}
	}


	public function nexter_import_activate_builder_ajax(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		
		if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['file'] ) || ! sanitize_text_field( wp_unslash( $_POST['file'] ) ) ) {
			wp_send_json_error(
				array(
					'success' => false,
					'content' => __( 'No plugin..', 'nexter' ),
				)
			);
		}

		$file = ( isset( $_POST['file'] ) ) ? sanitize_text_field( wp_unslash( $_POST['file'] ) ) : '';

		$activate = activate_plugin( $file, '', false, true );

		if ( is_wp_error( $activate ) ) {
			wp_send_json_error(
				array(
					'success'	=> false,
					'content'	=> $activate->get_error_message(),
				)
			);
		}

		wp_send_json_success(
			array(
				'success'	=> true,
				'content'	=> __( 'Activated', 'nexter' ),
			)
		);

	}
	
	public function nexter_import_data_step_2(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		
		if(current_user_can( 'install_plugins' ) && isset($_POST['builder']) && !empty($_POST['builder'])){
			$build_thumb = $build_name = $build_button = '';
			$plugin_slug = $plugin_file = '';
			$plugin_process = $plugin_status = '';
			$installed_plugins = get_plugins();
			
			if($_POST['builder'] == 'elementor'){
				$build_thumb = 'tpae';
				$build_name = 'Elementor';
				$plugin_file = 'the-plus-addons-for-elementor-page-builder/theplus_elementor_addon.php';
				$plugin_slug = 'the-plus-addons-for-elementor-page-builder';
				if(!defined("L_THEPLUS_VERSION")){
					if ( isset( $installed_plugins[ $plugin_file ] ) ) {
						$build_button = 'Activate Plugin';
						$plugin_process = 'Activating..';
						$plugin_status = 'nxt-active-builder-plugin';
					}else{
						$build_button = 'Install Plugin';
						$plugin_process = 'Installing..';
						$plugin_status = 'nxt-install-builder-plugin';
					}
				}else if(defined("L_THEPLUS_VERSION")){
					$build_button = 'Activated';
					$plugin_process = 'Activated';
					$plugin_status = 'nxt-activated-builder-plugin';
				}
			}else if($_POST['builder'] == 'gutenberg'){
				$build_thumb = 'tpag';
				$build_name = 'Gutenberg';
				$plugin_file = 'the-plus-addons-for-block-editor/the-plus-addons-for-block-editor.php';
				$plugin_slug = 'the-plus-addons-for-block-editor';
				if(!defined("TPGB_VERSION")){
					if ( isset( $installed_plugins[ $plugin_file ] ) ) {
						$build_button = 'Activate Plugin';
						$plugin_process = 'Activating..';
						$plugin_status = 'nxt-active-builder-plugin';
					}else{
						$build_button = 'Install Plugin';
						$plugin_process = 'Installing..';
						$plugin_status = 'nxt-install-builder-plugin';
					}
				}else if(defined("TPGB_VERSION")){
					$build_button = 'Activated';
					$plugin_process = 'Activated';
					$plugin_status = 'nxt-activated-builder-plugin';
				}
			}
			
			$nxt_ext_file = 'nexter-extension/nexter-extension.php';
			$nxt_build_button = $nxt_plugin_process = $nxt_plugin_status = '';
			if(!defined("NEXTER_EXT_VER")){
				if ( isset( $installed_plugins[ $nxt_ext_file ] ) ) {
					$nxt_build_button = 'Activate Plugin';
					$nxt_plugin_process = 'Activating..';
					$nxt_plugin_status = 'nxt-active-builder-plugin';
				}else{
					$nxt_build_button = 'Install Plugin';
					$nxt_plugin_process = 'Installing..';
					$nxt_plugin_status = 'nxt-install-builder-plugin';
				}
			}else if(defined("NEXTER_EXT_VER")){
				$nxt_build_button = 'Activated';
				$nxt_plugin_process = 'Activated';
				$nxt_plugin_status = 'nxt-activated-builder-plugin';
			}
			
			$output = '<div class="nxt-import-steps import-step-2 active" data-step="step-2">
				<div class="nxt-import-heading">'.esc_html__('Install & Activate Required Plugins.','nexter').'</div>
				<div class="nxt-panel-row">
					<div class="nxt-panel-col nxt-panel-col-50">
						<div class="nxt-builder-install-activate">
							<div class="builder-thumb" style="background-image:url('.esc_url(NXT_THEME_URI .'assets/images/'.$build_thumb.'.png').')"></div>
							<div class="builder-name">'.esc_html__('The Plus Addons For ','nexter').esc_html($build_name).'</div>
						</div>
						<a href="#" class="builder-install-activate-plugin '.esc_attr($plugin_status).'" data-builder="'.esc_attr($_POST['builder']).'" data-builder-process="'.esc_attr($plugin_process).'" data-slug="'.esc_attr($plugin_slug).'" data-file="'.$plugin_file.'">'.esc_html($build_button).'</a>
					</div>
					<div class="nxt-panel-col nxt-panel-col-50">
						<div class="nxt-builder-install-activate nxt-ext-plugin">
							<div class="builder-thumb" style="background-image:url('.esc_url(NXT_THEME_URI .'assets/images/nexter-ext.png').')"></div>
							<div class="builder-name">'.esc_html__('Nexter Extension','nexter').'</div>
						</div>
						<a href="#" class="builder-install-activate-plugin '.esc_attr($nxt_plugin_status).'" data-builder="nexter-extension" data-builder-process="'.esc_attr($nxt_plugin_process).'" data-slug="nexter-extension" data-file="'.$nxt_ext_file.'">'.esc_html($nxt_build_button).'</a>
					</div>
				</div>
			</div>';
			
			echo wp_json_encode( [ 'success'=> true, 'content'=> $output, 'build_status' => $build_button, 'extension_status' => $nxt_build_button] );
			exit;
		}else{
			echo wp_json_encode( [ 'success'=> false, 'content'=> '', 'build_status' => $build_button, 'extension_status' => $nxt_build_button ] );
			exit;
		}
	}
	
	public function nexter_import_data_step_3(){
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		
		$builder = ( isset( $_POST['builder'] ) ) ? sanitize_text_field( wp_unslash( $_POST['builder'] ) ) : '';
		
		$success = true;
		$builder_template = [];
		if(!empty($builder) && $builder=='gutenberg'){
			if(!defined("TPGB_VERSION")){
				$success = false;
			}else{
				$builder_template['template-1'] = [ 
					'thumb' => 'gutenberg-temp-1.png',
					'title' => esc_html__('Builder Template','nexter'),
					'desc' => esc_html__('Header, Footer, Single Posts Template, Archive Template...','nexter'),
					'tag' => 'Free',
				];
				$builder_template['posts'] = [ 
					'thumb' => 'gutenberg-temp-1.png',
					'title' => esc_html__('Basic Posts','nexter'),
					'desc' => esc_html__('Normal basic posts demo','nexter'),
					'tag' => 'Free',
				];
				
				$option_page = 'tpgb_normal_blocks_opts';
				$sub_option = 'enable_normal_blocks';
				$merge_opt = [ 'tp-row','tp-post-title', 'tp-post-author', 'tp-post-comment', 'tp-post-content', 'tp-post-image', 'tp-post-listing', 'tp-post-meta', 'tp-site-logo' ];
				if ( FALSE === get_option($option_page) ){
					$default_value = [ $sub_option => $merge_opt ];
					add_option($option_page,$default_value);
				}else{
					$get_option = get_option($option_page);
					if( !empty( $get_option ) && isset( $get_option[ $sub_option ] ) ){
						$get_sub_opt = $get_option[ $sub_option ];
						
						if( is_array( $get_sub_opt ) && !empty( $get_sub_opt ) ){
							$new_val = array_merge($get_sub_opt,$merge_opt);
							$update_value = array( $sub_option => $new_val);
						}else if(empty( $get_sub_opt ) ){
							$update_value = array( $sub_option => $merge_opt );
						}else{
							$update_value = array( $sub_option => $get_sub_opt);
						}
						update_option( $option_page, $update_value );
					}
				}
				
			}
		}else if(!empty($builder) && $builder=='elementor'){
			if(!defined("L_THEPLUS_VERSION")){
				$success = false;
			}else{
				$builder_template['template-1'] = [ 
					'thumb' => 'gutenberg-temp-1.png',
					'title' => esc_html__('Build Template','nexter'),
					'desc' => esc_html__('Header, Footer, Single Posts Template, Archive Template...','nexter'),
					'tag' => 'Free',
				];
				$builder_template['posts'] = [ 
					'thumb' => 'gutenberg-temp-1.png',
					'title' => esc_html__('Basic Posts','nexter'),
					'desc' => esc_html__('Normal basic posts demo','nexter'),
					'tag' => 'Free',
				];
				
				$option_page = 'theplus_options';
				$sub_option1 = 'check_elements';
				$sub_option2 = 'extras_elements';
				$merge_opt = [ 'tp_blog_listout', 'tp_navigation_menu_lite', 'tp_post_search', 'tp_post_title', 'tp_post_content', 'tp_post_featured_image', 'tp_post_meta', 'tp_post_author', 'tp_post_comment' ];
				if ( FALSE === get_option($option_page) ){
					$default_value = [ $sub_option1 => $merge_opt, $sub_option2 => '' ];
					add_option($option_page,$default_value);
				}else{
					$get_option = get_option($option_page);
					if( !empty( $get_option ) ){
					
						$old_sub_opt1 = $get_option[ $sub_option1 ];
						$old_sub_opt2 = $get_option[ $sub_option2 ];
						$update_value = [];
						if( is_array( $old_sub_opt1 ) && !empty( $old_sub_opt1 ) ){
							$new_val = array_merge($old_sub_opt1,$merge_opt);
							$update_value[ $sub_option1 ] = $new_val;
						}else if(empty( $old_sub_opt1 ) ){
							$update_value[ $sub_option1 ] = $merge_opt;
						}else{
							$update_value[ $sub_option1 ] = $old_sub_opt1;
						}
						$update_value[ $sub_option2 ] = $old_sub_opt2;
						update_option( $option_page, $update_value );
					}
				}
			}
		}
		
		if(!defined("NEXTER_EXT_VER")){
			$success = false;
		}
		
		$output = '<div class="nxt-import-steps import-step-3 active" data-step="step-3">
					<div class="nxt-import-heading">'.esc_html__('Import Demo Data','nexter').'</div>
					<div class="nxt-panel-row nxt-import-demo-data">';
						if(!empty($builder_template)){
							foreach($builder_template as $key => $value){
								$output .= '<div class="nxt-panel-col">';
									$output .= '<div class="nxt-import-template">';
										if(!empty($value['thumb'])){
											$output .= '<img src="'.esc_url(NXT_THEME_URI .'assets/images/'.$value['thumb']).'" class="template-thumb" />';
										}
										$output .= '<div class="nxt-temp-title-wrap">';
											if(!empty($value['title'])){
												$output .= '<div class="template-name">'.esc_html($value['title']);
												if(!empty($value['desc'])){
													$output .= '<span class="nxt-desc-icon" ><img src="'.esc_url( NXT_THEME_URI.'assets/images/panel-icon/desc-icon.svg').'" alt="'.esc_attr__('template-name','nexter').'" /><div class="nxt-tooltip">'.wp_kses_post($value['desc']).'</div></span>';
												}
												$output .= '</div>';
											}
											if(!empty($value['desc'])){
												//$output .= '<div class="template-desc">'.esc_html($value['desc']).'</div>';
											}
											if( !empty($key) ){
												$output .= '<a href="#" class="nxt-template-import-btn" data-builder="'.esc_attr($builder).'" data-tag="'.esc_attr($value['tag']).'" data-template="'.esc_attr($key).'">'.esc_html__('Import','nexter').'</a>';
											}
										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';
							}
						}
		$output .= '</div>
				</div>';
				
		if( $success ){
			wp_send_json_success( [ 'success' => true, 'content' => $output ] );
		}else{
			wp_send_json_error( [ 'success'	=> false, 'content'	=> '' ] );
		}
	}
	
	/**
     * Register nexter setting to WP
     */
    public function init() {
        $option_tabs = self::option_fields();
		
        foreach ($option_tabs as $index => $option_tab) {
            register_setting($option_tab['id'], $option_tab['id']);
        }
    }
	
	/**
     * Add menu options page
     */
    public function nxt_add_menu_page() {
		$option_tabs = self::option_fields();
		global $_registered_pages, $submenu;
		
		unset($submenu['themes.php'][20]);
		unset($submenu['themes.php'][15]);
		
		foreach ($option_tabs as $index => $option_tab) {
			if($index == 0){
				add_theme_page($this->setting_name, $this->setting_name, 'manage_options', $option_tab['id'], array(
					$this,
					'admin_page_display'
				));
			}else{
				if ( ! current_user_can( 'manage_options' ) ) {
					return false;
				}
				if(isset($option_tabs) && $option_tab['id'] != "nexter_white_label" && $option_tab['id'] != "nexter_activate"){
					
					$function_name = array( $this,'admin_page_display');
					$hookname = get_plugin_page_hookname( $option_tab['id'], $option_tabs[0]['id'] );
					if ( ! empty( $function_name ) && ! empty( $hookname ) ) {
						add_action( $hookname, $function_name );
					}
					$_registered_pages[ $hookname ] = true;	// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				}else{
					$label_options=get_option( 'nexter_white_label' );	
					if( ((empty($label_options['nxt_hidden_label']) || $label_options['nxt_hidden_label']!='on') && ($option_tab['id'] == "nexter_white_label" || $option_tab['id'] == "nexter_activate")) || !defined('NXT_PRO_EXT_VER')){
						$function_name = array( $this,'admin_page_display');
						$hookname = get_plugin_page_hookname( $option_tab['id'], $option_tabs[0]['id'] );
						if ( ! empty( $function_name ) && ! empty( $hookname ) ) {
							add_action( $hookname, $function_name );
						}
						$_registered_pages[ $hookname ] = true;	// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					}
				}
			}
		}
    }
	
	/**
     * Theplus Gutenberg Display Page
     * @since  1.0.0
     */
    public function admin_page_display() {
		$option_tabs = self::option_fields();
		$tab_forms   = array();
		
		$output ='';
		
		$output .='<div class="'.esc_attr($this->key).'">';
			
			$output .='<div id="nxt-setting-header-wrapper">';
				$output .='<div class="nxt-head-inner">';
				
					$options = get_option( 'nexter_white_label' );
					if(defined('NXT_PRO_EXT') && (!empty($options['theme_logo']))){
						$output .='<img src="'.esc_url($options['theme_logo']).'" style="max-width:150px;"/>';
					}else{
						$output .='<svg xmlns="http://www.w3.org/2000/svg" width="210" height="67" fill="none" ><g clip-path="url(#A)" fill="#22379c"><path d="M47.566 23.383L36.843.185h-7.184v65.81h7.184V11.979l10.709 23.194.015 30.822h7.184V.185h-7.184v23.199zm61.716 16.761c0 .468-.282.831-.842 1.096L103.893 43l-4.552-1.733c-.562-.257-.841-.628-.841-1.098V.027L91.323 0v40.275c0 2.254 1.366 4.04 4.099 5.357l1.287.613-1.287.616c-2.733 1.317-4.099 3.099-4.099 5.347v13.6h7.196V52.387c0-.485.281-.88.841-1.144l4.532-1.753 4.528 1.753c.56.264.841.65.841 1.144v13.421h7.211v-13.6c0-2.246-1.367-4.028-4.101-5.347l-1.287-.616 1.287-.613c2.731-1.317 4.098-3.103 4.101-5.357V0h-7.191v40.144zm15.087-34.339l8.653-.007v60.196h7.165l.024-60.196h8.641V.185h-24.476l-.007 5.621zm80.957 47.316c3.04-1.026 4.558-2.913 4.554-5.66V6.326c0-1.697-.782-3.151-2.331-4.363S204.846.138 202.716.138h-17.292v65.815h7.184v-10.02h7.323c.06 0 .111.022.167.029a3.53 3.53 0 0 1 .923.225 3.21 3.21 0 0 1 .274.114l.073.034a2.31 2.31 0 0 1 1.11 1.047l.029.053a2.35 2.35 0 0 1 .112.293l.058.201a3.36 3.36 0 0 1 .085.727l-.034 7.298h7.191v-7.126c0-2.751-1.541-4.656-4.581-5.706l-.012-.002zm-2.598-5.175a2.07 2.07 0 0 1-.902 1.665c-.625.478-1.395.726-2.181.703h-7.03V5.797h8.44a1.9 1.9 0 0 1 1.176.376 1.11 1.11 0 0 1 .372.405c.089.164.135.347.134.533l-.009 40.835zM62.653 65.987h20.77v-5.626H69.857V49.088h9.615V43.47h-9.615V5.798h13.566V.18h-20.77v65.808zm94.096-60.182l13.574.007v14.696h-9.613v5.626h9.605v34.239h-13.566v5.621h20.777V.185h-20.777v5.621zM10.876 59.511l-.034 7.49H.092V56.598h7.776c.068 0 .119.024.177.031a3.71 3.71 0 0 1 .97.242 4.25 4.25 0 0 1 .296.119c.024.017.051.027.075.044.508.226.923.619 1.176 1.115l.034.058a2.02 2.02 0 0 1 .119.313 1.29 1.29 0 0 1 .058.221 3.21 3.21 0 0 1 .092.768m-.023-55.293v43.799c0 .684-.313 1.275-.955 1.784a3.6 3.6 0 0 1-2.324.751H.092V2.8H9.06c.45-.009.891.134 1.251.405a1.21 1.21 0 0 1 .391.437 1.2 1.2 0 0 1 .14.569"/></g><defs><clipPath id="A"><path fill="#fff" transform="translate(.092)" d="M0 0h209.803v67H0z"/></clipPath></defs></svg>';
					}
					$output .='<div class="nxt-panel-head-inner">';
						$output .='<h2 class="nxt-head-setting-panel">'.esc_html__('Settings','nexter').'</h2>';
						$output .='<div class="nxt-current-version"> '.esc_html__('Version','nexter').' '.NXT_VERSION.'</div>';
					$output .='</div>';
				$output .='</div>';
				
				$output .='<div class="nxt-nav-tab-wrapper">';
					$output .='<div class="nav-tab-wrapper">';
						ob_start();
						foreach ($option_tabs as $option_tab):
							$tab_slug  = $option_tab['id'];
							$nav_class = 'nav-tab';
							if (isset($_GET['page']) && $tab_slug == $_GET['page']) {
								$nav_class .= ' nav-tab-active'; //add active class to current tab
								$tab_forms[] = $option_tab; //add current tab to forms to be rendered
							}
							$navicon = $nav_url ='';
							
							if($tab_slug == "nexter_settings_welcome" || $tab_slug == "nexter_import_data"){
								wp_enqueue_script( 'nexter-panel-setting' );
							}
							if($tab_slug == "nexter_settings_welcome"){
								$nav_url = menu_page_url($tab_slug, false);
								$navicon = '<svg class="tab-nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.5587 1.50025C11.8129 1.27791 12.1879 1.27791 12.442 1.50025L16.0004 4.64058V3.66683C16.0004 3.11475 15.9462 3.00024 16.5004 3.00024H20.5004C21.0545 3.00024 21.0004 3.11475 21.0004 3.66683V9.16431L23.5004 11.3302C23.7754 11.5719 24.1562 11.8788 23.9027 12.2202C23.6985 12.4952 23.2754 12.4994 23.0004 12.2202L21.0004 10.5002V19.3335C21.0004 21.1752 19.842 22.0002 18.0004 22.0002H6.00036C4.15953 22.0002 3.00037 21.1752 3.00037 19.3335V10.5002L1.00037 12.2202C0.724116 12.4994 0.373216 12.4952 0.129633 12.2202C-0.113992 11.9077 0.224492 11.5719 0.500576 11.3302L11.5587 1.50025ZM20.0004 8.29956V4.00016L17.0004 4.00024V5.81691L20.0004 8.29956ZM4.00037 9.62134V19.3335C4.00037 20.4377 4.8962 21.0002 6.00036 21.0002H9.00037V14.6668C9.00037 13.9293 9.26287 14.0002 10.0004 14.0002H14.0004C14.7379 14.0002 15.0004 13.9293 15.0004 14.6668V21.0002H18.0004C19.1045 21.0002 20.0004 20.4377 20.0004 19.3335V9.62134L12.0004 2.66024L4.00037 9.62134ZM10.0004 15.0002L10.0004 21.0002H14.0004L14.0004 15.0002H10.0004Z"/></svg>';
							}
							if($tab_slug == "nexter_activate"){
								$nav_url = admin_url( 'admin.php?page=' . $tab_slug );
								$navicon = '<svg class="tab-nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1467_14917)"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.23557 10.1611C8.80689 8.83708 8.78125 7.41118 9.16825 6.06646C9.60193 4.55956 10.5287 3.24177 11.8002 2.32407C13.0717 1.40638 14.6143 0.94188 16.1811 1.00494C17.7479 1.068 19.2482 1.65497 20.4418 2.67187C21.6354 3.68878 22.4533 5.07679 22.7645 6.61367C23.0757 8.15054 22.8621 9.74738 22.1581 11.1485C21.4541 12.5496 20.3002 13.674 18.8814 14.3416C17.6152 14.9373 16.2034 15.1385 14.8281 14.9256L14.8211 14.9245C14.8038 14.9218 14.7864 14.92 14.7691 14.9189C14.6223 14.9016 14.4693 14.9493 14.3566 15.0619L11.9091 17.5094L9.11621 17.5094C8.84007 17.5094 8.61621 17.7333 8.61621 18.0094V20.5094H6.11621C5.84007 20.5094 5.61621 20.7333 5.61621 21.0094V23.0094H1.11621L1.11621 18.7165L9.11656 10.7168C9.20828 10.6251 9.25692 10.5067 9.26248 10.3866C9.26718 10.3343 9.2644 10.2808 9.25356 10.2278C9.24945 10.2077 9.24418 10.1876 9.23773 10.1677L9.23557 10.1611ZM19.3052 15.2425C17.9256 15.8916 16.3945 16.1306 14.8927 15.9401L12.4698 18.363C12.376 18.4567 12.2488 18.5094 12.1162 18.5094H9.61621L9.61621 21.0094C9.61621 21.2856 9.39235 21.5094 9.11621 21.5094L6.61621 21.5094V23.5094C6.61621 23.7856 6.39235 24.0094 6.11621 24.0094L0.61621 24.0094C0.340068 24.0094 0.116211 23.7856 0.11621 23.5094V18.5094C0.116211 18.3768 0.168895 18.2496 0.262672 18.1558L8.20956 10.2096C7.79693 8.77129 7.79449 7.23994 8.21146 5.7911C8.70678 4.07001 9.76529 2.5649 11.2175 1.51676C12.6697 0.468629 14.4316 -0.0619008 16.2211 0.0101212C18.0106 0.0821432 19.7242 0.752551 21.0875 1.914C22.4508 3.07545 23.3849 4.66076 23.7403 6.41609C24.0957 8.17142 23.8518 9.99524 23.0477 11.5955C22.2436 13.1958 20.9258 14.48 19.3052 15.2425ZM18.0206 7.29676C17.6301 7.68729 16.9969 7.68729 16.6064 7.29676C16.2158 6.90624 16.2158 6.27307 16.6064 5.88255C16.9969 5.49203 17.6301 5.49203 18.0206 5.88255C18.4111 6.27307 18.4111 6.90624 18.0206 7.29676ZM18.7277 8.00387C17.9466 8.78492 16.6803 8.78492 15.8993 8.00387C15.1182 7.22282 15.1182 5.95649 15.8993 5.17544C16.6803 4.3944 17.9466 4.3944 18.7277 5.17544C19.5087 5.95649 19.5087 7.22282 18.7277 8.00387Z"/></g><defs><clipPath id="clip0_1467_14917"><rect width="24" height="24"/></clipPath></defs></svg>';
							}
							if($tab_slug == "nexter_site_performance"){
								$nav_url = admin_url( 'admin.php?page=' . $tab_slug );
								$navicon = '<svg  class="tab-nav-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM6.01618 11.5059L6.01646 11.5026C6.08964 10.6222 6.35645 9.76657 6.80024 8.99792C7.32721 8.08517 8.08517 7.32721 8.99792 6.80024C9.91066 6.27326 10.946 5.99583 12 5.99583C12.8876 5.99583 13.762 6.19258 14.561 6.56943L14.564 6.57081C14.5847 6.58042 14.6058 6.58868 14.6271 6.5956C14.8614 6.67168 15.1255 6.58646 15.251 6.36903C15.3885 6.13088 15.3076 5.82462 15.0603 5.7044C15.0355 5.69236 15.0107 5.68047 14.9858 5.66873L14.9323 5.64375C14.0152 5.22069 13.015 5 12 5C10.7712 5 9.56413 5.32344 8.5 5.93782C7.43586 6.5522 6.5522 7.43587 5.93782 8.5C5.43033 9.379 5.12135 10.3556 5.0292 11.3613L5.02405 11.4202C5.02177 11.4476 5.01966 11.475 5.0177 11.5025C4.99816 11.7768 5.22292 12 5.49792 12C5.74898 12 5.95486 11.8139 6.00612 11.5729C6.01078 11.551 6.01416 11.5286 6.01618 11.5059ZM17.4723 9.52936L17.471 9.52637C17.4617 9.50552 17.4538 9.48433 17.4472 9.4629C17.375 9.22738 17.4646 8.96468 17.6841 8.84278C17.9245 8.70925 18.2294 8.79524 18.3455 9.04452C18.3571 9.06948 18.3686 9.0945 18.3799 9.11958L18.404 9.17354C18.7102 9.86725 18.9016 10.6062 18.9708 11.3613L18.9759 11.4202C18.9782 11.4476 18.9803 11.475 18.9823 11.5025C19.0018 11.7768 18.7771 12 18.5021 12C18.251 12 18.0451 11.8139 17.9939 11.5729C17.9892 11.551 17.9858 11.5286 17.9838 11.5059L17.9835 11.5026C17.9268 10.8206 17.7539 10.1531 17.4723 9.52936ZM12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13ZM12 14C13.1046 14 14 13.1046 14 12C14 11.5406 13.8451 11.1174 13.5847 10.7797L17.3037 7.06066C17.499 6.8654 17.499 6.54882 17.3037 6.35355C17.1085 6.15829 16.7919 6.15829 16.5966 6.35355L12.7887 10.1615C12.5467 10.0576 12.2801 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14Z"/></svg>';
							}
							if($tab_slug == "nexter_site_security"){
								$nav_url = admin_url( 'admin.php?page=' . $tab_slug );
								$navicon = '<svg class="tab-nav-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.8244 1.53184C11.9376 1.48939 12.0624 1.48939 12.1756 1.53184L20.1756 4.53184C20.3707 4.60502 20.5 4.79158 20.5 5V12C20.5 15.2232 18.3591 17.8501 16.3293 19.6263C15.3038 20.5236 14.2807 21.2267 13.515 21.7052C13.1316 21.9449 12.8114 22.129 12.5859 22.2539C12.4731 22.3163 12.3839 22.3639 12.3223 22.3963C12.2914 22.4125 12.2675 22.4249 12.2509 22.4334L12.2315 22.4432L12.2261 22.446L12.2245 22.4468L12.224 22.447C12.2238 22.4471 12.2236 22.4472 12 22C11.7764 22.4472 11.7762 22.4471 11.776 22.447L11.7755 22.4468L11.7739 22.446L11.7685 22.4432L11.7491 22.4334C11.7325 22.4249 11.7086 22.4125 11.6777 22.3963C11.6161 22.3639 11.5269 22.3163 11.4141 22.2539C11.1886 22.129 10.8684 21.9449 10.485 21.7052C9.71927 21.2267 8.69619 20.5236 7.67075 19.6263C5.64087 17.8501 3.5 15.2232 3.5 12V5C3.5 4.79158 3.62929 4.60502 3.82444 4.53184L11.8244 1.53184ZM12 22L12.2236 22.4472C12.0828 22.5176 11.9172 22.5176 11.7764 22.4472L12 22ZM12 21.4347C11.969 21.4179 11.9351 21.3993 11.8984 21.379C11.6864 21.2616 11.3816 21.0864 11.015 20.8573C10.2807 20.3983 9.30381 19.7264 8.32925 18.8737C6.35913 17.1499 4.5 14.7768 4.5 12V5.3465L12 2.534L19.5 5.3465V12C19.5 14.7768 17.6409 17.1499 15.6707 18.8737C14.6962 19.7264 13.7193 20.3983 12.985 20.8573C12.6184 21.0864 12.3136 21.2616 12.1016 21.379C12.0649 21.3993 12.031 21.4179 12 21.4347ZM12 11C12.5523 11 13 10.5523 13 10C13 9.44772 12.5523 9 12 9C11.4477 9 11 9.44772 11 10C11 10.5523 11.4477 11 12 11ZM11.5 11.937V14.5C11.5 14.7761 11.7239 15 12 15C12.2761 15 12.5 14.7761 12.5 14.5V11.937C13.3626 11.715 14 10.9319 14 10C14 8.89543 13.1046 8 12 8C10.8954 8 10 8.89543 10 10C10 10.9319 10.6374 11.715 11.5 11.937Z"/></svg>';
							}
							
							if($tab_slug == "nexter_extra_options"){
								$nav_url = admin_url( 'admin.php?page=' . $tab_slug );
								$navicon = '<svg class="tab-nav-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 6C9.5 7.10457 8.60457 8 7.5 8C6.39543 8 5.5 7.10457 5.5 6C5.5 4.89543 6.39543 4 7.5 4C8.60457 4 9.5 4.89543 9.5 6ZM10.4585 5.5C10.2205 4.08114 8.9865 3 7.5 3C6.0135 3 4.77952 4.08114 4.54148 5.5H2C1.72386 5.5 1.5 5.72386 1.5 6C1.5 6.27614 1.72386 6.5 2 6.5H4.54148C4.77952 7.91886 6.0135 9 7.5 9C8.9865 9 10.2205 7.91886 10.4585 6.5H22C22.2761 6.5 22.5 6.27614 22.5 6C22.5 5.72386 22.2761 5.5 22 5.5H10.4585ZM13.5 18C13.5 16.8954 12.6046 16 11.5 16C10.3954 16 9.5 16.8954 9.5 18C9.5 19.1046 10.3954 20 11.5 20C12.6046 20 13.5 19.1046 13.5 18ZM8.54148 17.5H2C1.72386 17.5 1.5 17.7239 1.5 18C1.5 18.2761 1.72386 18.5 2 18.5H8.54148C8.77952 19.9189 10.0135 21 11.5 21C12.9865 21 14.2205 19.9189 14.4585 18.5H22C22.2761 18.5 22.5 18.2761 22.5 18C22.5 17.7239 22.2761 17.5 22 17.5H14.4585C14.2205 16.0811 12.9865 15 11.5 15C10.0135 15 8.77952 16.0811 8.54148 17.5ZM1.5 12C1.5 11.7239 1.72386 11.5 2 11.5H16.0415C16.2795 10.0811 17.5135 9 19 9C20.6569 9 22 10.3431 22 12C22 13.6569 20.6569 15 19 15C17.5135 15 16.2795 13.9189 16.0415 12.5H2C1.72386 12.5 1.5 12.2761 1.5 12ZM19 14C17.8954 14 17 13.1046 17 12C17 10.8954 17.8954 10 19 10C20.1046 10 21 10.8954 21 12C21 13.1046 20.1046 14 19 14Z"/></svg>';
							}
							
							if($tab_slug == "nexter_white_label"){
								$nav_url = admin_url( 'admin.php?page=' . $tab_slug );
								$navicon = '<svg class="tab-nav-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.181 7.93281C18.129 8.40131 17.7317 8.76564 17.2493 8.76564C16.7315 8.76564 16.3118 8.3459 16.3118 7.82814C16.3118 7.31037 16.7315 6.89064 17.2493 6.89064C17.4766 6.89064 17.685 6.97153 17.8473 7.10609C18.1078 6.96839 18.3304 6.76804 18.4948 6.52271C18.5204 6.48441 18.5445 6.44522 18.5671 6.40523L18.5495 6.40402L14.7848 6.17983C13.3183 6.0925 11.8758 6.5824 10.7657 7.54479L4.46662 13.006C4.18851 13.2471 4.16305 13.6697 4.4102 13.9425L9.93247 20.0367C10.1721 20.3011 10.579 20.3257 10.8487 20.0919L17.2128 14.5743C18.3167 13.6173 19.0048 12.2685 19.1318 10.8131L19.4277 7.42135C19.4428 7.24906 19.4103 7.08384 19.3412 6.93844C19.3195 6.97426 19.297 7.00963 19.2736 7.04452C19.1842 7.17795 19.0835 7.30267 18.973 7.41745C18.7522 7.64668 18.4919 7.83626 18.2034 7.97648L18.2025 7.97695L18.181 7.93281ZM19.7285 5.69919C19.7241 5.76994 19.717 5.84033 19.7071 5.91022C20.1536 6.28978 20.4167 6.87268 20.3617 7.50283L20.0658 10.8946C19.9793 11.8855 19.6699 12.8341 19.1712 13.6742V20.3438C19.1712 20.8097 18.7934 21.1875 18.3274 21.1875H10.5227V21.1865C10.054 21.2168 9.57687 21.0405 9.23776 20.6662L3.71549 14.572C3.11527 13.9096 3.1771 12.8832 3.8525 12.2976L10.1516 6.83644C11.3131 5.82945 12.7866 5.26585 14.3125 5.23382C14.3399 4.98534 14.4013 4.74224 14.4948 4.5113C14.5546 4.36357 14.6274 4.22081 14.7129 4.08481C14.9692 3.67691 15.3293 3.34443 15.7563 3.12139C16.1833 2.89838 16.6619 2.79282 17.1431 2.81552C17.6243 2.83824 18.0908 2.98841 18.4949 3.25065C18.8991 3.5129 19.2262 3.87781 19.443 4.30804C19.6597 4.73827 19.7583 5.21837 19.7285 5.69919ZM12.0975 20.25H18.2337V14.8985C18.1041 15.0318 17.9685 15.16 17.827 15.2827L12.0975 20.25ZM18.6057 4.72983C18.7249 4.96629 18.7895 5.22574 18.7957 5.48918C18.7333 5.47908 18.6698 5.47202 18.6052 5.46818L15.2531 5.26856C15.2893 5.0259 15.3754 4.79257 15.5067 4.58358C15.6746 4.31633 15.9105 4.0985 16.1903 3.95239C16.4701 3.80626 16.7836 3.7371 17.0989 3.75198C17.4142 3.76686 17.7198 3.86524 17.9846 4.03706C18.2494 4.20888 18.4637 4.44796 18.6057 4.72983ZM6.53345 12.6437C6.72488 12.4694 7.02135 12.4833 7.19564 12.6748L9.05396 14.7159C9.22825 14.9074 9.21434 15.2038 9.02291 15.3781C8.83148 15.5524 8.53501 15.5385 8.36073 15.3471L6.5024 13.3059C6.32812 13.1145 6.34202 12.818 6.53345 12.6437Z"/></svg>';
							}
							
							if($tab_slug == "nexter_import_data"){
								$nav_url = admin_url( 'admin.php?page=' . $tab_slug );
								$navicon = '<svg class="tab-nav-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 1C8.11929 1 7 2.11929 7 3.5V12H6V3.5C6 1.567 7.567 0 9.5 0H15.2574C16.1856 0 17.0759 0.368749 17.7322 1.02513L22.9749 6.26777C23.6313 6.92415 24 7.81438 24 8.74264V20.5C24 22.433 22.433 24 20.5 24H9.5C7.567 24 6 22.433 6 20.5V18H7V20.5C7 21.8807 8.11929 23 9.5 23H20.5C21.8807 23 23 21.8807 23 20.5V9H17.5C16.1193 9 15 7.88071 15 6.5V1H9.5ZM16 1.11285V6.5C16 7.32843 16.6716 8 17.5 8H22.8872C22.7679 7.61664 22.5569 7.26399 22.2678 6.97487L17.0251 1.73223C16.736 1.44311 16.3834 1.23212 16 1.11285ZM10.1716 10.9645L13.3536 14.1464C13.5488 14.3417 13.5488 14.6583 13.3536 14.8536L10.1716 18.0355C9.97631 18.2308 9.65973 18.2308 9.46447 18.0355C9.2692 17.8403 9.2692 17.5237 9.46447 17.3284L11.7929 15H0.5C0.223858 15 0 14.7761 0 14.5C0 14.2239 0.223858 14 0.5 14H11.7929L9.46447 11.6716C9.2692 11.4763 9.2692 11.1597 9.46447 10.9645C9.65973 10.7692 9.97631 10.7692 10.1716 10.9645Z"/></svg>';
							}
							$label_options=get_option( 'nexter_white_label' );
							if( (empty($label_options['nxt_hidden_label']) || $label_options['nxt_hidden_label']!='on') && ($tab_slug == "nexter_white_label" || $tab_slug == "nexter_activate") ){
								echo '<a class="'.esc_attr($nav_class).'" href="'.esc_url($nav_url).'">';
									echo '<span>'.$navicon.'</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo '<span>'.esc_html($option_tab['title']).'</span>';
								echo '</a>';
							}else if(($tab_slug != "nexter_white_label" && $tab_slug != "nexter_activate") || !defined('NXT_PRO_EXT_VER')){
								echo '<a class="'.esc_attr($nav_class).'" href="'.esc_url($nav_url).'">';
									echo '<span>'.$navicon.'</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo '<span>'.esc_html($option_tab['title']).'</span>';
								echo '</a>';
							}
						endforeach;
						$out = ob_get_clean();
						$output .= $out;
					$output .='</div>';
				$output .='</div>';
			
			$output .='</div>';
			
			
		
			/*Content Options*/
			$output .='<div class="nxt-settings-form-wrapper form-'.esc_attr($tab_forms[0]['id']).'">';
			
				if(!empty($tab_forms)){
					ob_start();
					foreach ($tab_forms as $tab_form):
						
						if($tab_form['id']=='nexter_white_label'){
							do_action('nexter_white_label_notice');
						}else if($tab_form['id']=='nexter_activate'){
							do_action('nexter_activate_notice');
						}else if($tab_form['id']=='nexter_import_data'){
							do_action('nexter_import_data_render');
						}else if($tab_form['id']=='nexter_extra_options'){
							do_action('nexter_extra_options_render');
						}else if(!defined('NEXTER_EXT') && $tab_form['id']=='nexter_site_performance'){
							do_action('nexter_site_performance_notice');
						}else if(!defined('NEXTER_EXT') && $tab_form['id']=='nexter_site_security'){
							do_action('nexter_site_security_notice');
						}
						
						if( ( defined('NXT_PRO_EXT') && $tab_form['id']=='nexter_white_label' ) || ( defined('NEXTER_EXT') && ($tab_form['id']=='nexter_site_performance' || $tab_form['id']=='nexter_site_security' )) ){
							do_action('nexter_ext_extra_option' , $tab_form['id'] );
						}else if($tab_form['id']=='nexter_settings_welcome'){
							include_once NXT_THEME_DIR . 'inc/panel-settings/welcome-page.php';
						}
					endforeach;
						do_action('nexter_help_actions');
					$out = ob_get_clean();
					$output .= $out;
				}
			$output .='</div>';
			
		$output .='</div>';
		
		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		
	}
	
	/**
     * Nexter Settings fields configuration
     */
    public function option_fields() {
		// Only need to initiate the array once per page-load
        if (!empty($this->option_metabox)) {
            return $this->option_metabox;
        }
		
		$this->option_metabox[] = array(
            'id' => 'nexter_settings_welcome',
            'title' => esc_html__('Welcome', 'nexter'),
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'nexter_settings_welcome'
                )
            ),
            'show_names' => true,
            'fields' => ''
        );
		
		$this->option_metabox[] = array(
            'id' => 'nexter_import_data',
            'title' => esc_html__('Import', 'nexter'),
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'nexter_import_data'
                )
            ),
            'show_names' => true,
            'fields' => ''
        );
		$this->option_metabox[] = array(
			'id' => 'nexter_extra_options',
			'title' => esc_html__('Extra Options', 'nexter'),
			'show_on' => array(
				'key' => 'options-page',
				'value' => array(
					'nexter_extra_options'
				)
			),
			'show_names' => true,
			'fields' => '',
		);
		
		$performance_options=[];
		if(has_filter('nexter_site_performance_options')) {
			$performance_options = apply_filters('nexter_site_performance_options', $performance_options);
		}
		
		$this->option_metabox[] = array(
			'id' => 'nexter_site_performance',
			'title' => esc_html__('Performance', 'nexter'),
			'show_on' => array(
				'key' => 'options-page',
				'value' => array(
					'nexter_site_performance'
				)
			),
			'show_names' => true,
			'fields' => $performance_options,
		);
		
		$security_options=[];
		if(has_filter('nexter_site_security_options')) {
			$security_options = apply_filters('nexter_site_security_options', $security_options);
		}
		$this->option_metabox[] = array(
			'id' => 'nexter_site_security',
			'title' => esc_html__('Security', 'nexter'),
			'show_on' => array(
				'key' => 'options-page',
				'value' => array(
					'nexter_site_security'
				)
			),
			'show_names' => true,
			'fields' => $security_options,
		);
		$this->option_metabox[] = array(
			'id' => 'nexter_activate',
			'title' => esc_html__('Activate', 'nexter'),
			'show_on' => array(
				'key' => 'options-page',
				'value' => array(
					'nexter_activate'
				)
			),
			'show_names' => true,
			'fields' => '',
		);
		
		$this->option_metabox[] = array(
			'id' => 'nexter_white_label',
			'title' => esc_html__('White Label', 'nexter'),
			'show_on' => array(
				'key' => 'options-page',
				'value' => array(
					'nexter_white_label'
				)
			),
			'show_names' => true,
			'fields' => '',
		);
		
		return $this->option_metabox;
	}
	
	/**
     * Public getter method for retrieving protected/private variables
     * @since  1.0.0
     * @param  string	$field Field to retrieve
     * @return mixed	Field value or exception is thrown
     */
    public function __get($field) {
        
        // Allowed fields to retrieve
        if (in_array($field, array('key','fields','title','options_page'), true)) {
            return $this->{$field};
        }
        if ('option_metabox' === $field) {
            return $this->option_fields();
        }
        /* translators: Invalid property: Fields */
        throw new Exception( sprintf( esc_html__( 'Invalid property: %1$s', 'nexter' ), $field ) );
    }
	
	/**
	 * Export Customizer options.
	 *
	 * @since 1.0.11
	 */
	public static function nxt_customizer_export_data() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		if ( !isset( $_POST['nexter_export_cust_nonce'] ) || !wp_verify_nonce( $_POST['nexter_export_cust_nonce'], 'nexter_export_cust_nonce' ) ) {
			return;
		}
		if ( empty( $_POST['nxt_customizer_export_action'] ) || $_POST['nxt_customizer_export_action'] !== 'nxt_export_cust' ) {
			return;
		}

		// Get Customizer options
		$customizer_options = Nexter_Customizer_Options::get_options();

		$customizer_options = apply_filters( 'nexter_customizer_export_data', $customizer_options );
		nocache_headers();
		
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=nexter-customizer-export-' . gmdate( 'm-d-Y' ) . '.json' );
		header( 'Expires: 0' );
		echo wp_json_encode( $customizer_options );
		die();
	}
	
	/**
	 * Import Customizer options.
	 *
	 * @since 1.0.11
	 */
	public static function nxt_customizer_import_data() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		if ( !isset( $_POST['nexter_import_cust_nonce'] ) || !wp_verify_nonce( $_POST['nexter_import_cust_nonce'], 'nexter_import_cust_nonce' ) ) {
			return;
		}
		if ( empty( $_POST['nxt_customizer_import_action'] ) || $_POST['nxt_customizer_import_action'] !== 'nxt_import_cust' ) {
			return;
		}
		
		$filename = $_FILES['nxt_import_file']['name'];

		if ( empty( $filename ) ) {
			return;
		}
		
		$file_extension  = explode( '.', $filename );
		$extension = end( $file_extension );

		if ( $extension !== 'json' ) {
			wp_die( esc_html__( 'Valid .json file extension', 'nexter' ) );
		}

		$nxt_import_file = $_FILES['nxt_import_file']['tmp_name'];

		if ( empty( $nxt_import_file ) ) {
			wp_die( esc_html__( 'Please upload a file', 'nexter' ) );
		}

		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		
		$get_contants = $wp_filesystem->get_contents( $nxt_import_file );
		$customizer_options      = json_decode( $get_contants, 1 );
		if ( !empty( $customizer_options ) ) {
			update_option( 'nxt-theme-options', $customizer_options );
		}

		wp_safe_redirect(
			add_query_arg(
				array(
					'page'   => 'nexter_extra_options',
					'status_customizer' => 'success',
				),
				admin_url( 'admin.php' )
			),
		);
		exit;
	}
	
}

// Get it started
$Nexter_Settings_Panel = new Nexter_Settings_Panel();
$Nexter_Settings_Panel->hooks();