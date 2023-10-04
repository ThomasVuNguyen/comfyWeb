<?php
echo '<div class="nxt-panel-welcome-page">';
	echo '<div class="nxt-panel-row">';
		echo '<div class="nxt-br-4 nxt-panel-col nxt-panel-col-65" '.( !apply_filters('nexter_remove_branding',false) ? '' : 'style="flex-direction: column;"').'>';
			/*Welcome User Info*/
			$nxt_pro_info = '';
			if(defined('NXT_PRO_EXT')){
				$nxt_pro_info = 'nxt-pro-info-active';
			}
			$is_pro_activated = false;
			if(defined('NXT_PRO_EXT') && class_exists('Nexter_Pro_Ext_Activate')){
				$active_status = Nexter_Pro_Ext_Activate::nexter_ext_pro_activate_msg();
				if(!empty($active_status) && isset($active_status['status']) && $active_status['status']=='valid'){
					$is_pro_activated = true;
				}
			}
			$user = wp_get_current_user();
			echo '<div class="nxt-free-pro-info nxt-p-15 '.esc_attr($nxt_pro_info).'">';
				if ( $user ){
					echo '<img src="'.esc_url( get_avatar_url( $user->ID ) ).'" class="nxt-avatar-img" />';
				}
				echo '<a href="'.esc_url('https://www.youtube.com/c/POSIMYTHInnovations/?sub_confirmation=1').'" target="_blank" rel="noopener noreferrer" class="nxt-info-btn wt-video-tutorial">'.esc_html__('Watch Video Tutorials','nexter').'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" ><circle cx="8" cy="8" r="8" fill="#fff"/><path d="M11 8l-4.5 2.598V5.402L11 8z" fill="#1f35a2"/></svg></a>';
				echo '<a href="'.esc_url('https://www.facebook.com/groups/139678088029161/').'" target="_blank" rel="noopener noreferrer" class="nxt-info-btn join-community">'.esc_html__('Join Community','nexter').'<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" ><path d="M7 0a7 7 0 1 0 0 14A7 7 0 1 0 7 0zm0 13.125C3.623 13.125.875 10.377.875 7S3.623.875 7 .875 13.125 3.623 13.125 7 10.377 13.125 7 13.125zm0-8.094c.362 0 .656-.294.656-.656S7.362 3.719 7 3.719s-.656.293-.656.656.293.656.656.656zm1.313 4.594h-.875V6.563A.44.44 0 0 0 7 6.125h-.875a.44.44 0 0 0-.437.438.44.44 0 0 0 .438.438h.438v2.625h-.875a.44.44 0 0 0-.437.438.44.44 0 0 0 .438.438h2.625c.242 0 .438-.196.438-.437a.44.44 0 0 0-.437-.437z" fill="#fff"/></svg></a>';
				if(!empty($is_pro_activated)){
					echo '<a class="nxt-info-btn pro-activated-now"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/diamond.svg').'" />'.esc_html__('PRO ACTIVATED','nexter').'</a>';
				}else{
					echo '<a href="'.esc_url('https://nexterwp.com/pricing/').'" target="_blank" rel="noopener noreferrer" class="nxt-info-btn upgrade-now">'.esc_html__('Upgrade Now','nexter').'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" ><g clip-path="url(#A)" fill-rule="evenodd"><path d="M4.863 13.042l.024-.063h0l-.794-.786c.122.264.177.531.051.811-.08.177-.2.316-.371.408l-2.084 1.117-.362.194c-.012.006-.024.011-.038.017l-.023.009c-.012-.04.006-.066.024-.092l.014-.023 1.303-2.38c.219-.399.702-.556 1.116-.365l.082.035.031.013-.789-.797c-.444.122-.807.356-1.034.768l-.568 1.037-.511.932-.652 1.177-.283.51v.125c.216.33.313.354.673.162l.657-.351 2.767-1.482a1.48 1.48 0 0 0 .719-.849l.047-.126zm-.77-.848h0 0z" fill="#fc4032"/><path d="M15.924 1.271h0 0l-.015.16c-.351 2.48-1.26 4.727-2.806 6.705a10.35 10.35 0 0 1-2.147 2.056c-.082.059-.107.117-.102.218l.101 1.99h0 0 0 0 0 0 0 0 0v.001.001.001.001l.032.656c.006.121-.032.223-.119.31l-1.254 1.254-1.253 1.254c-.04.04-.083.079-.143.09h0 0l-.098.002-.098.002c-.179-.023-.257-.1-.304-.309L7.7 15.58h0 0 0 0 0 0 0 0 0l-.141-.644-.259-1.207h0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0l-.183-.85c-.036-.169-.055-.177-.201-.094l-1.158.644c-.222.121-.363.101-.546-.08l-.308-.309-.524-.53-.299-.299-.258-.258-.218-.218h0 0 0l-.611-.605-.052-.051h0l-.257-.258c-.145-.151-.175-.297-.083-.484l.028-.058h0 0 0 0 0 0 0 0 0l.602-1.196c.083-.157.083-.164-.086-.2l-1.22-.263h-.001-.001-.001L.356 8.28C.178 8.242.031 8.173 0 7.968v-.188c.057-.092.128-.172.205-.249l.304-.303 2.047-2.05a.55.55 0 0 1 .459-.175l1.364.069h0l1.209.061c.101.005.158-.025.22-.103C7.764 2.534 10.317.99 13.396.292a12.63 12.63 0 0 1 1.82-.261c.008-.001.016 0 .025.001.027.003.055.005.067-.033h.219.001c.046.04.097.035.148.03.025-.002.049-.005.074-.002.105.017.157.093.209.168l.037.052V.25.656l-.001.002c-.037.031-.048.061.001.092h0v.156h0c-.055.116-.064.241-.072.365zm-9.806 9.114v-.001l.323.323h0 0 0 0 0l.887.891c.061.062.099.044.157.009l.485-.294h0l.819-.5.076-.048h0c.843-.527 1.688-1.057 2.435-1.716 1.175-1.036 2.049-2.301 2.732-3.704.038-.078.019-.118-.035-.172l-3.169-3.17c-.059-.059-.101-.08-.185-.038-1.536.767-2.885 1.776-3.986 3.099-.884 1.063-1.597 2.242-2.283 3.439-.044.077-.026.115.03.17l1.136 1.139c.079.081.118.07.191-.005l1.544-1.548c.148-.146.353-.15.49-.022.144.135.146.343 0 .501l-.215.218-.082.081-.668.666-.683.681h0v.001zm7.903-6.156l.332.334h0c.006-.005.012-.009.017-.013s.014-.01.016-.015c.477-1.193.782-2.428.897-3.709.01-.115-.04-.11-.115-.103l-.009.001a12.99 12.99 0 0 0-3.612.838c-.136.053-.107.087-.026.167l1.558 1.556.275.275.667.67h0 0 0 0zm-3.835 6.517l.028.604v.002.002.002l.073 1.529a.18.18 0 0 1-.053.153l-1.433 1.43-.485.485-.034-.143h0l-.056-.238-.236-1.089-.236-1.089c-.018-.08-.019-.137.071-.19l2.302-1.431c.007-.005.015-.008.028-.014l.03-.013h0zM1.11 7.6c-.024.02-.048.041-.053.08h0l.039.011.095.025.65.139h0 0l1.74.378c.114.025.163.001.218-.097l1.379-2.243c.027-.033.044-.052.026-.082l-.045-.008-.553-.028-1.521-.079c-.07-.004-.106.033-.145.073l-.011.011-1.799 1.8c-.007.007-.014.013-.022.019h0zm2.875 1.61l.271.274h0l.834.841c.048.048.046.077-.002.124l-.817.817c-.047.048-.075.051-.123.001l-.751-.75c-.047-.046-.044-.082-.018-.133l.419-.813h0l.186-.361zm2.498 2.978l.302-.17h0l-.272-.27-.829-.829c-.053-.054-.078-.023-.102.007l-.016.019-.293.292-.503.5c-.058.056-.065.088-.003.148l.75.75c.051.052.088.05.145.017l.821-.464z" fill="#1f35a2"/><path d="M10.149 4.064c-1.06-.012-1.896.803-1.904 1.855-.008.99.83 1.852 1.807 1.859 1.066.007 1.901-.808 1.902-1.857.001-1.009-.812-1.846-1.805-1.857zm-.058.688a1.17 1.17 0 0 0-1.158 1.167c.002.645.519 1.171 1.152 1.173a1.18 1.18 0 0 0 1.187-1.175 1.18 1.18 0 0 0-1.181-1.164z" fill="#fc4032"/></g><defs><clipPath id="A"><path fill="#fff" d="M0 0h15.996v16H0z"/></clipPath></defs></svg></a>';
				}
			echo '</div>';
			echo '<div class="nxt-welcome-user-info nxt-p-15 nxt-mb-8">';
				echo '<div class="nxt-user-info">';
					echo '<div class="nxt-welcom-author-name">'.esc_html__('Welcome, ','nexter').'<span>'.esc_html($user->display_name).'</span></div>';
				echo '</div>';
				echo '<div class="nxt-sec-subtitle nxt-mt-8">'.esc_html__('Congratulations on installing Nexter Theme. Get ready to explore the next generation of WordPress.','nexter').'</div>';
				$nxt_pro_ext = '';
				if(defined('NXT_PRO_EXT')){
					$nxt_pro_ext = 'nxt-pro-ext-active';
				}
				echo '<div class="nxt-free-pro-info-wrap '.esc_attr($nxt_pro_ext).'">';
					if(!defined('NXT_PRO_EXT')){
						echo '<div class="nxt-free-pro-info-list">';
							echo '<div class="nxt-free-pro-head">'.esc_html__("Free Version",'nexter').'</div>';
							echo '<ul class="nxt-panel-list">';
								echo '<li>'.esc_html__("Basic Theme Builder",'nexter').'</li>';
								echo '<li>'.esc_html__("4 Performance Features",'nexter').'</li>';
								echo '<li>'.esc_html__("5 Security Features",'nexter').'</li>';
							echo '</ul>';
						echo '</div>';
					}
					echo '<div class="nxt-free-pro-info-list">';
						echo '<div class="nxt-free-pro-head nxt-pro-info">'.esc_html__("Pro Version",'nexter').'</div>';
						echo '<ul class="nxt-panel-list">';
							echo '<li>'.esc_html__("Advanced Theme Builder",'nexter').'</li>';
							if(!defined('NXT_PRO_EXT')){
								echo '<li>'.esc_html__("10+ Performance Features",'nexter').'</li>';
								echo '<li>'.esc_html__("7+ Security Features",'nexter').'</li>';
							}else{
								echo '<li>'.esc_html__("Display Conditions",'nexter').'</li>';
								echo '<li>'.esc_html__("Advance Hooks",'nexter').'</li>';
								echo '<li>'.esc_html__("Advance Security",'nexter').'</li>';
								echo '<li>'.esc_html__("Advance Performance",'nexter').'</li>';
								echo '<li>'.esc_html__("Branded WP Admin",'nexter').'</li>';
								echo '<li>'.esc_html__("Self-Host Google Fonts",'nexter').'</li>';
								echo '<li>'.esc_html__("Custom Upload Fonts",'nexter').'</li>';
								echo '<li>'.esc_html__("White Label Theme",'nexter').'</li>';
							}
						echo '</ul>';
					echo '</div>';
				echo '</div>';
				if(!defined('NXT_PRO_EXT')){
					echo '<div class="text-center">';
						echo '<a href="'.esc_url('https://nexterwp.com/free-vs-pro-compare/').'" class="nxt-panel-btn-outline-2 nxt-mt-8 nxt-ml-0" title="'.esc_attr__('Check Full Comparisons','nexter').'" target="_blank" rel="noopener noreferrer" >'.esc_html__('Check Full Comparisons','nexter').'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="8" fill="none" ><path d="M1 3.5a.5.5 0 1 0 0 1v-1zm16.354.854a.5.5 0 0 0 0-.707L14.172.464a.5.5 0 0 0-.707.707L16.293 4l-2.828 2.828a.5.5 0 0 0 .707.707l3.182-3.182zM1 4.5h16v-1H1v1z" fill="#1f35a2"/></svg></a>';
					echo '</div>';
				}
			echo '</div>';
			/*Welcome User Info*/
			echo '<div class="nxt-panel-row nxt-pro-info-new">';
				echo '<div class="nxt-panel-col nxt-panel-col-50">';
					/*product info*/
					if(current_user_can( 'install_plugins' )){
					echo '<div class="nxt-panel-sec nxt-p-20 nxt-welcome-product-info nxt-mb-8">';
						echo '<div class="nxt-sec-title">'.esc_html__('Related Products','nexter').'</div>';
						echo '<ul class="nxt-product-info-list">';
							$tpgb_build_button = $tpae_build_button ='';
							$tpgb_plugin_process = $tpae_plugin_process = $tpgb_plugin_status = $tpae_plugin_status = '';
							$installed_plugins = get_plugins();
							
							$tpgb_plugin_file = 'the-plus-addons-for-block-editor/the-plus-addons-for-block-editor.php';
							$tpgb_plugin_slug = 'the-plus-addons-for-block-editor';
							if(!defined("TPGB_VERSION")){
								if ( isset( $installed_plugins[ $tpgb_plugin_file ] ) ) {
									$tpgb_build_button = esc_html__('Activate Plugin','nexter');
									$tpgb_plugin_process = esc_html__('Activating..','nexter');
									$tpgb_plugin_status = 'nxt-active-builder-plugin';
								}else{
									$tpgb_build_button = esc_html__('Install Plugin','nexter');
									$tpgb_plugin_process = esc_html__('Installing..','nexter');
									$tpgb_plugin_status = 'nxt-install-builder-plugin';
								}
							}else if(defined("TPGB_VERSION")){
								$tpgb_build_button = esc_html__('Activated','nexter');
								$tpgb_plugin_process = esc_html__('Activated','nexter');
								$tpgb_plugin_status = 'nxt-activated-builder-plugin';
							}
							echo '<li>
								<div class="nxt-prod-info-inner">
									<span class="nxt-prod-icon"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/tpag-icon.svg').'" /></span>
									<span class="nxt-prod-wrap nxt-import-data-content">
										<span class="nxt-prod-title">'.esc_html__('The Plus Addons For Block Editor','nexter').'</span>
										<a href="#" data-builder="gutenberg" data-builder-process="'.esc_attr($tpgb_plugin_process).'" data-slug="'.esc_attr($tpgb_plugin_slug).'" data-file="'.$tpgb_plugin_file.'" class="nxt-prod-btn '.esc_attr($tpgb_plugin_status).'">'.esc_html($tpgb_build_button).'</a>
									</span>
									<a href="'.esc_url('http://theplusblocks.com').'" target="_blank" rel="noopener noreferrer" class="nxt-pro-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#000" ><circle cx="12" cy="12" r="11.7" stroke-width=".6"/><g stroke-width=".75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 12.5v3a1 1 0 0 1-1 1H8.5a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3m2-1.5h3v3"/><path d="M11 13l5.5-5.5"/></g></svg></a>
								</a>
							</li>';

							$tpae_plugin_file = 'the-plus-addons-for-elementor-page-builder/theplus_elementor_addon.php';
							$tpae_plugin_slug = 'the-plus-addons-for-elementor-page-builder';
							if(!defined("L_THEPLUS_VERSION")){
								if ( isset( $installed_plugins[ $tpae_plugin_file ] ) ) {
									$tpae_build_button = esc_html__('Activate Plugin','nexter');
									$tpae_plugin_process = esc_html__('Activating..','nexter');
									$tpae_plugin_status = 'nxt-active-builder-plugin';
								}else{
									$tpae_build_button = esc_html__('Install Plugin','nexter');
									$tpae_plugin_process = esc_html__('Installing..','nexter');
									$tpae_plugin_status = 'nxt-install-builder-plugin';
								}
							}else if(defined("L_THEPLUS_VERSION")){
								$tpae_build_button = esc_html__('Activated','nexter');
								$tpae_plugin_process = esc_html__('Activated','nexter');
								$tpae_plugin_status = 'nxt-activated-builder-plugin';
							}
							echo '<li>
								<div class="nxt-prod-info-inner">
									<span class="nxt-prod-icon nxt-tpae-icon"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/tpae-icon.svg').'" /></span>
									<span class="nxt-prod-wrap nxt-import-data-content">
										<span class="nxt-prod-title">'.esc_html__('The Plus Addons For Elementor','nexter').'</span>
										<a href="#" data-builder="elementor" data-builder-process="'.esc_attr($tpae_plugin_process).'" data-slug="'.esc_attr($tpae_plugin_slug).'" data-file="'.$tpae_plugin_file.'" class="nxt-prod-btn '.esc_attr($tpae_plugin_status).'">'.esc_html($tpae_build_button).'</a>
									</span>
									<a href="'.esc_url('http://theplusaddons.com/').'" target="_blank" class="nxt-pro-link" rel="noopener noreferrer" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#000" ><circle cx="12" cy="12" r="11.7" stroke-width=".6"/><g stroke-width=".75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 12.5v3a1 1 0 0 1-1 1H8.5a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3m2-1.5h3v3"/><path d="M11 13l5.5-5.5"/></g></svg></a>
								</div>
							</li>';
							echo '<li>
								<div class="nxt-prod-info-inner">
									<span class="nxt-prod-icon nxt-webdesign-icon"><img src="'.esc_url(NXT_THEME_URI.'/assets/images/panel-icon/webdesign-kit.svg').'" /></span>
									<span class="nxt-prod-wrap nxt-import-data-content">
										<span class="nxt-prod-title">'.esc_html__('Wdesignkit','nexter').'</span>
										<a href="#" target="_blank" class="nxt-prod-btn" rel="noopener noreferrer" >'.esc_html__('Coming Soon','nexter').'</a>
									</span>
									<a href="'.esc_url('https://wdesignkit.com/').'" target="_blank" rel="noopener noreferrer" class="nxt-pro-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#000" ><circle cx="12" cy="12" r="11.7" stroke-width=".6"/><g stroke-width=".75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 12.5v3a1 1 0 0 1-1 1H8.5a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3m2-1.5h3v3"/><path d="M11 13l5.5-5.5"/></g></svg></a>
								</div>
							</li>';
						echo '</ul>';
					echo '</div>';
					}
					/*product info*/
					/*Share a review*/
					echo '<div class="nxt-panel-sec nxt-welcome-whats-new nxt-p-20 nxt-mt-8">';
						echo '<div class="nxt-sec-top-icon nxt-extra-icon nxt-mb-8">';
							echo '<img src="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/share-review.svg').'" alt="sys-requirement">';
						echo '</div>';
						echo '<div class="nxt-sec-title">'.esc_html__('Share a Review','nexter').'</div>';
						echo '<div class="nxt-sec-subtitle nxt-mb-8">'.esc_html__('More than coffee, your amazing words keeps us motivated to do better. If you love what we do, then feel free to write a review.','nexter').'</div>';
						echo '<a href="'.esc_url('https://wordpress.org/support/theme/nexter/reviews/?filter=5').'" class="nxt-panel-btn nxt-full-btn" title="'.esc_attr__('Write A Review','nexter').'" target="_blank" rel="noopener noreferrer" >'.esc_html__('Write a Review','nexter').'</a>';
					echo '</div>';
					/*Share a review*/
				echo '</div>';
				echo '<div class="nxt-panel-col nxt-panel-col-50">';
					/*Whats New*/
					echo '<div class="nxt-panel-sec nxt-welcome-whats-new nxt-p-20 nxt-mb-8">';
						echo '<div class="nxt-sec-top-icon nxt-extra-icon nxt-mb-8">';
							echo '<img src="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/whats-new.svg').'" alt="sys-requirement">';
						echo '</div>';
						echo '<div class="nxt-sec-title">'.esc_html__('Whats New ?','nexter').'</div>';
						echo '<div class="nxt-sec-subtitle nxt-mb-8">'.esc_html__('Check complete list of new changes done in NexterWP Theme','nexter').'</div>';
						echo '<a href="'.( (!defined('NXT_PRO_EXT')) ? esc_url('https://roadmap.nexterwp.com/updates?filter=Free+Theme') : esc_url('https://roadmap.nexterwp.com/updates')).'" class="nxt-panel-btn nxt-full-btn" title="'.esc_attr__('Check Updates','nexter').'" target="_blank" rel="noopener noreferrer" >'.esc_html__('Check Updates','nexter').'</a>';
					echo '</div>';
					/*Whats New*/
					/*Need Help*/
					echo '<div class="nxt-panel-sec nxt-welcome-whats-new nxt-p-20 nxt-mt-8">';
						echo '<div class="nxt-sec-top-icon nxt-extra-icon nxt-mb-8">';
							echo '<img src="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/need-help.svg').'" alt="sys-requirement">';
						echo '</div>';
						echo '<div class="nxt-sec-title">'.esc_html__('Need Help?','nexter').'</div>';
						echo '<div class="nxt-sec-subtitle nxt-mb-8">'.esc_html__('Facing issue? Feel free to raise a ticket, our team will get back to you typically under 24 working hours (9 AM to 6 PM +5:30 GMT)','nexter').'</div>';
						echo '<a href="'.( (!defined('NXT_PRO_EXT')) ? esc_url('https://wordpress.org/support/theme/nexter/') : esc_url('https://store.posimyth.com/helpdesk/')).'" class="nxt-panel-btn nxt-full-btn" title="'.esc_attr__('Raise Ticket','nexter').'" target="_blank" rel="noopener noreferrer" >'.esc_html__('Raise Ticket','nexter').'</a>';
					echo '</div>';
					/*Need Help*/
				echo '</div>';
			echo '</div>';
			if(!apply_filters('nexter_remove_branding',false)){
				/*Welcome FAQ*/
				echo '<div class="nxt-panel-sec nxt-p-20 nxt-welcome-faq nxt-mt-8">';
					echo '<div class="nxt-sec-title">'.esc_html__('Frequently Asked Questions','nexter').'</div>';
					echo '<div class="nxt-sec-subtitle nxt-mb-12">'.esc_html__('You might have one, we have tried to answer them all','nexter').'</div>';
					
					echo '<div class="nxt-faq-section">';
						echo '<div class="faq-title"><span>'.esc_html__('What is a Nexter Theme?','nexter').'</span><span class="faq-icon-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#22379c" ><circle cx="12" cy="12" r="11.5"/><path d="M7 10l5 5 5-5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>';
						/* translators: %s: Nexter Builder */
						echo '<div class="faq-content">'.esc_html__('Nexter is a powerful theme for your WordPress website, which will help you customize every pixel of your site without using a single line of code. Nexter comes with some of the most extensive addition like complete Theme Builder, Google reCAPTCHA, White label WP-Admin, and much more (link this to features page). You get an experience of a blazing-fast website as we reduce the need to install other plugins.  We call it the next generation of WordPress themes, as building full fledge blog sites, e-commerce stores will never get this easy.','nexter').'</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo '</div>';

					echo '<div class="nxt-faq-section">';
						echo '<div class="faq-title"><span>'.esc_html__('Why do I need Nexter Extension Plugin?','nexter').'</span><span class="faq-icon-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#22379c" ><circle cx="12" cy="12" r="11.5"/><path d="M7 10l5 5 5-5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>';
						/* translators: faq content: description */
						echo '<div class="faq-content">'.sprintf( __( 'Nexter Extension is an important plugin, which is required after activating the Theme. To unlock the complete features of the Theme, you must keep it activated.', 'nexter' ) ).'</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo '</div>';
					
				
					
					echo '<div class="nxt-faq-section">';
						echo '<div class="faq-title"><span>'.esc_html__('Which Page Builder should I use with Nexter Theme?','nexter').'</span><span class="faq-icon-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#22379c" ><circle cx="12" cy="12" r="11.5"/><path d="M7 10l5 5 5-5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>';
						echo '<div class="faq-content">'.esc_html__('I. Nexter Theme is compatible with most of the popular page builders like Elementor, Gutenberg (Default WordPress Block Editor), Beaver Builder and Brizy (more on the way). Apart from that, we at POSIMYTH Innovations bring some expectational addons for Elementor and Gutenberg Editor. Next is designed with love to work in sync with the addons mentioned below','nexter').'</br>'.esc_html__('II. We recommend installing','nexter').'</br>'.esc_html__('1. The Plus Addons for Elementor (120+ Elementor Widgets)','nexter').'</br>'.esc_html__('2. The Plus Addons for Gutenberg (80+ Gutenberg Blocks)','nexter').'</div>';
					echo '</div>';
					
					echo '<div class="nxt-faq-section">';
						echo '<div class="faq-title"><span>'.esc_html__('What is Nexter Builder?','nexter').'</span><span class="faq-icon-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#22379c" ><circle cx="12" cy="12" r="11.5"/><path d="M7 10l5 5 5-5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>';
						echo '<div class="faq-content">'.esc_html__('Nexter Builder is one of the most powerful features of this Theme, using this you can customize your Header & Footer, Archive Pages, Search Page, Action & Filter Hooks, Breadcrumbs, Listing Pages, Single Page, Coming Soon, Maintenance Page, 404 Page, Add Code Snippets and much more. Using this you can take your site to the next level to achieve your dream design.','nexter').'</div>';
					echo '</div>';
				echo '</div>';
				/*Welcome FAQ*/
			}
		echo '</div>';
		echo '<div class="nxt-panel-col nxt-panel-col-35">';
			/*Stay Updated*/
			echo '<div class="nxt-panel-sec nxt-welcome-stay-update nxt-p-20 nxt-mb-8 ">';
				echo '<div class="nxt-sec-top-icon nxt-extra-icon nxt-mb-8">';
					echo '<img src="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/stay-update.svg').'" alt="sys-requirement">';
				echo '</div>';
				echo '<div class="nxt-sec-title">'.esc_html__('Stay Updated','nexter').' <span class="nxt-span-text"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" ><path d="M10.934 1.962L6.434.087C6.319.039 6.125 0 6.001 0s-.318.039-.433.087l-4.5 1.875c-.42.173-.694.583-.694 1.017C.375 9.028 4.809 12 5.998 12c1.2 0 5.627-3.005 5.627-9.021 0-.434-.274-.844-.691-1.017zM8.25 4.687a.56.56 0 0 1-.135.366l-2.25 2.625c-.157.185-.366.175-.427.175-.149 0-.292-.059-.398-.165L3.915 6.564c-.111-.088-.165-.234-.165-.398 0-.3.241-.562.563-.562a.56.56 0 0 1 .398.165l.696.696L7.261 4.3a.56.56 0 0 1 .428-.196c.431.021.562.41.562.583z" fill="#fff"/></svg>'.esc_html__('No Spam Guarantee','nexter').'</span></div>';
				echo '<div class="nxt-stay-email-wrap">';
					echo '<input type="email" name="stay-update-email" id="stay-update-email" placeholder="'.esc_html__('Email Address','nexter').'" class="nxt-email-input" required />';
					echo '<button class="nxt-send-email-update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#fff" stroke-linejoin="round" ><path d="M22 2L11 13" stroke-linecap="round"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></button>';
				echo '</div>';
				echo '<div class="nxt-sec-subtitle">'.esc_html__('We share WordPress News, Speed & Security Tips, Product Updates and more. Our mails will delight you','nexter').'</div>';
			echo '</div>';
			/*Stay Updated*/
			/*Welcome System Requirement*/
			$check_right_req = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="none" ><path d="M2.297 9.135L7.162 14l12-12" stroke="#14c38e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
			$check_wrong_req = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fc4032" ><rect x="13.508" width="3.524" height="18.927" rx="1.762" transform="rotate(45 13.508 0)"/><rect width="3.524" height="18.927" rx="1.762" transform="matrix(-.7071 .707107 .707107 .7071 2.49219 0)"/></svg>';
			
			echo '<div class="nxt-panel-sec nxt-welcome-sys-req nxt-p-20 nxt-mb-8 nxt-mt-8">';
				echo '<div class="nxt-sec-top-icon nxt-extra-icon nxt-mb-8">';
					echo '<img src="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/sys-requirement.svg').'" alt="sys-requirement">';
				echo '</div>';
				echo '<div class="nxt-sec-title">'.esc_html__('System Requirements','nexter').'</div>';
				echo '<div class="nxt-sec-subtitle nxt-mb-8">'.esc_html__('Configuration needed to work smoothly','nexter').'</div>';
				$php_check_req ='';
				if (version_compare(phpversion(), '7.0', '>')) {
					$php_check_req = '<span class="check-req-right">'.$check_right_req.'</span>';
				}else{
					$php_check_req = '<span class="check-req-wrong">'.$check_wrong_req.'</span>';
				}
				echo '<div class="sys-req-label">'.$php_check_req.'<span>'.esc_html__('PHP Version : ','nexter').esc_html(phpversion()).'</span></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				
				$memory_check_req ='';
				$memory_limit = ini_get('memory_limit');
				if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
					if ($matches[2] == 'M') {
						$memory_limit = $matches[1] * 1024 * 1024;
					} else if ($matches[2] == 'K') {
						$memory_limit = $matches[1] * 1024;
					}
				}
				
				if ($memory_limit >= 256 * 1024 * 1024) {
					$memory_check_req = '<span class="check-req-right">'.$check_right_req.'</span>';
				}else{
					$memory_check_req = '<span class="check-req-wrong">'.$check_wrong_req.'</span>';
				}
				echo '<div class="sys-req-label">'.$memory_check_req.'<span>'.esc_html__('Memory Limit : ','nexter').esc_html(ini_get('memory_limit')).'</br>'.esc_html__(' Required 256M','nexter').'</span></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				
				$gzip_check_req = '';
				$accept_ecoding = isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? sanitize_text_field(wp_unslash($_SERVER['HTTP_ACCEPT_ENCODING'])) : '';
				if (isset($accept_ecoding) && substr_count($accept_ecoding, 'gzip') ) {
					$gzip_check_req = '<span class="check-req-right">'.$check_right_req.'</span>';
				}else{
					$gzip_check_req = '<span class="check-req-wrong">'.$check_wrong_req.'</span>';
				}
				echo '<div class="sys-req-label nxt-bm-0">'.$gzip_check_req.'<span>'.esc_html__('Gzip Enabled','nexter').'</span></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				if ( ! class_exists( 'WP_Debug_Data' ) ) {
					require_once ABSPATH . 'wp-admin/includes/class-wp-debug-data.php';
				}
				$info = WP_Debug_Data::debug_data();
				echo '<div class="sys-copy-download-btn" data-clipboard-text="'.esc_attr( WP_Debug_Data::format( $info, 'debug' ) ).'">';
					echo '<a href="#" class="nxt-copy-btn nxt-panel-btn-outline-2 nxt-mt-8 nxt-ml-0" title="'.esc_attr__('Copy Info','nexter').'" >'.esc_html__('Copy Info','nexter').'</a>';
					echo '<a href="#" class="nxt-download-btn nxt-panel-btn nxt-ml-10" title="'.esc_attr__('Download','nexter').'" target="_blank" rel="noopener noreferrer" >'.esc_html__('Download','nexter').'</a>';
				echo '</div>';
			echo '</div>';
			/*Welcome System Requirement*/
			/*Request Feature*/
			echo '<div class="nxt-panel-sec nxt-welcome-whats-new nxt-p-20 nxt-mb-8 nxt-mt-8">';
				echo '<div class="nxt-sec-top-icon nxt-extra-icon nxt-mb-8">';
					echo '<img src="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/req-feature.svg').'" alt="sys-requirement">';
				echo '</div>';
				echo '<div class="nxt-sec-title">'.esc_html__('Request Feature','nexter').'</div>';
				echo '<div class="nxt-sec-subtitle nxt-mb-8">'.esc_html__('We hear you! Improve your Nexter Theme with your amazing ideas.','nexter').'</div>';
				echo '<a href="'.esc_url('https://roadmap.nexterwp.com/boards/feature-requests').'" class="nxt-panel-btn nxt-full-btn" title="'.esc_attr__('Suggest Feature','nexter').'" target="_blank" rel="noopener noreferrer" >'.esc_html__('Suggest Feature','nexter').'</a>';
			echo '</div>';
			/*Request Feature*/
			/*subscribe now*/
			echo '<div class="nxt-panel-sec nxt-welcome-subscribe-now nxt-p-20 nxt-mt-8">';
			echo '<div class="nxt-sec-top-icon nxt-extra-icon nxt-mb-8">';
				echo '<img src="'.esc_url(NXT_THEME_URI.'assets/images/panel-icon/posimyth-icon.svg').'" alt="sys-requirement">';
			echo '</div>';
			echo '<div class="nxt-sec-title nxt-text-white">'.esc_html__('POSIMYTH Innovations - WordPress Tutorials','nexter').'</div>';
			echo '<div class="nxt-sec-subtitle nxt-mb-8" style="color:#E9EBF5;">'.esc_html__('Watch step-by-step tutorials on WordPress to create website from scratch using Elementor & Gutenberg','nexter').'</div>';
			echo '<a href="'.esc_url('https://www.youtube.com/c/POSIMYTHInnovations/?sub_confirmation=1').'" class="nxt-panel-btn nxt-full-btn" title="'.esc_attr__('SUBSCRIBE NOW','nexter').'" target="_blank" rel="noopener noreferrer" >'.esc_html__('SUBSCRIBE NOW','nexter').'</a>';
		echo '</div>';
		/*subscribe now*/
		echo '</div>';
	echo '</div>';
	
echo '</div>';
