<?php
/**
 * Nexter Enqueue Styles And Scripts
 *
 * @package	Nexter
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Load_Enqueue_Styles_Scripts' ) ) {

	class Nexter_Load_Enqueue_Styles_Scripts {
		
		/** 
		 * Constructor
		 */
		public function __construct() {
			if( !defined( 'NEXTER_EXT' ) && empty( get_option( 'nexter-extension-load-notice' ) ) ) {
				add_action( 'admin_notices', array( $this, 'nexter_extension_load_notice' ) );
				add_action( 'wp_ajax_nexter_ext_dismiss_notice', array( $this, 'nexter_ext_dismiss_notice_ajax' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 1 );
			add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_assets_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_admin' ), 1 );
			
		}
		
		/**
		 * Check Local Google Font
		 * @since 1.1.0
		 */
		public function check_nxt_ext_local_google_font( $style = false){
			$check = false;
			$nxt_ext = get_option( 'nexter_extra_ext_options' );
			if( !empty($nxt_ext) && isset($nxt_ext['local-google-font']) && !empty($nxt_ext['local-google-font']['switch']) && !empty($nxt_ext['local-google-font']['values']) ){
				$check = true;
				if($style==true){
					return $nxt_ext['local-google-font']['style'];
				}
			}
			
			return $check;
		}

		
		/**
		 * Theme Load Css And Js
		 */
		public function enqueue_scripts(){
		
			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			//Font Load 
			if(!$this->check_nxt_ext_local_google_font()){
				Nexter_Get_Fonts::enqueue_load_fonts();
			}
			
			//Load Style
			wp_enqueue_style( 'nexter-style', get_stylesheet_uri() );

			//Custom Font Load Font Face Style
			$custom_fonts_face = Nexter_Get_Fonts::get_custom_fonts_face();
			if( !empty( $custom_fonts_face ) ){
				wp_add_inline_style( 'nexter-style',nexter_minify_css_generate($custom_fonts_face) );
			}

			//Load Scripts
			wp_enqueue_script( 'nexter-frontend-js', NXT_JS_URI . 'main/nexter-frontend'. $minified .'.js', array(), NXT_VERSION, true); //Nexter Frontend js
			
			wp_localize_script('nexter-frontend-js', 'nexter_load_js', array(
				'url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('ajax-nonce'),
				'isRtl'       => is_rtl(),
			));
			wp_enqueue_script( 'nexter-frontend-js' );
			
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
		
		/**
		 * Enqueue Gutenberg assets style.
		 */
		public function gutenberg_assets_styles(){
			// Use minified libraries if SCRIPT_DEBUG is turned off
			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			
			wp_enqueue_style( 'nexter-block-editor-styles', NXT_CSS_URI .'admin/block-editor'. $minified .'.css', false, NXT_VERSION, 'all' );
			
			if(!$this->check_nxt_ext_local_google_font()){
				Nexter_Get_Fonts::enqueue_load_fonts();
			}

			$custom_fonts_face = Nexter_Get_Fonts::get_custom_fonts_face();
			if( !empty( $custom_fonts_face ) ){
				wp_add_inline_style( 'nexter-block-editor-styles',nexter_minify_css_generate($custom_fonts_face) );
			}
			
			wp_add_inline_style( 'nexter-block-editor-styles', apply_filters( 'nexter_block_editor_dynamic_style', Nexter_Gutenberg_Dynamic_Css::render_theme_css() ) );
		}
		
		/**
		 * Theme Load Admin Css And Js
		 * @since 1.0.8
		 */
		public function enqueue_scripts_admin( $hook_suffix ){
			// Use minified libraries if SCRIPT_DEBUG is turned off
			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			
			wp_enqueue_style( 'nxt-admin-css', NXT_CSS_URI .'admin/nexter-admin'. $minified .'.css', array(), NXT_VERSION );
			
			wp_enqueue_script( 'nexter-admin-js', NXT_JS_URI . 'admin/nexter-admin'. $minified .'.js', array(), NXT_VERSION, false );
			
			wp_enqueue_style( 'nxt-duplicate-post-css', NXT_CSS_URI .'admin/nxt-duplicate-post'. $minified .'.css', array(), NXT_VERSION );
			wp_enqueue_script( 'nexter-duplicate-post-js', NXT_JS_URI . 'admin/nexter-duplicate-post'. $minified .'.js', array(), NXT_VERSION, true); 
			//Duplicate Post js
			
			$nexter_admin_localize = array(
			  'ajaxurl' => admin_url('admin-ajax.php'),
			  'ajax_nonce' => wp_create_nonce('nexter_admin_nonce'),
			  'nexter_path' => NXT_THEME_URI.'assets/',
			  'is_pro' => (defined('NXT_PRO_EXT')) ? true : false,
			);
			
			wp_localize_script( 'nexter-admin-js', 'nexter_admin_config', $nexter_admin_localize );
			
			if(! did_action('wp_enqueue_media')){
				wp_enqueue_media();
			}
			
			if ( ! is_customize_preview() ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_register_script( 'nexter-panel-setting', NXT_JS_URI . 'admin/nexter-panel-settings'. $minified .'.js', array('wp-util', 'updates','wp-color-picker'), NXT_VERSION, false );
			}
			
			$js_handle = apply_filters( 'nexter_admin_script_handles', array( 'jquery', 'wp-color-picker' ) );
			if ( is_customize_preview() === true ) {
				$js_handle[] = 'customize-base';
			}
			wp_register_script( 'nexter-color-picker', NXT_JS_URI . 'extra/wp-color-picker-alpha'. $minified .'.js', $js_handle, NXT_VERSION, true );
			
			wp_enqueue_style( 'nxt-metabox-editor-style', NXT_CSS_URI .'admin/metabox-editor-style'. $minified .'.css', array() );
			
		}
		
		/**
		 * Nexter Extension Load Notice
		 */
		public function nexter_extension_load_notice(){
			$plugin = 'nexter-extension/nexter-extension.php';	
			if ( $this->nexter_extension_activate() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) { return; }
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$admin_notice = '<h4 class="nxt-notice-head">' . esc_html__( 'Activate Nexter Extension Now !!!', 'nexter' ) . '</h4>';
				$admin_notice .= '<p>' . esc_html__( 'Finally, You are Done Installing Nexter Theme & Extension as Well. Now It’s Time to Press the Pedal. Activate Nexter Extension and Get Over With it.', 'nexter' ). '</p>';
				$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Nexter Extension', 'nexter' ) ) . '</p>';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) { return; }
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=nexter-extension' ), 'install-plugin_nexter-extension' );
				$admin_notice = '<h4 class="nxt-notice-head">' . esc_html__( 'It’s Time to Install Nexter Extension', 'nexter' ) . '</h4>';
				$admin_notice .= '<p>' . esc_html__( 'Now You’ve Already Installed Nexter Theme, You Need to Install Nexter Extension in Order to Get the Most of out From it. Nexter Extension is an Ultimate Solution to Your Page Building Experience Using Templates.', 'nexter' ) .sprintf( ' <a href="%s" target="_blank" rel="noopener noreferrer" >%s</a>', esc_url('https://nexterwp.com'), esc_html__( 'Visit Here', 'nexter' ) ). esc_html__( ' to Learn More About Nexter Extension.', 'nexter' ) . '</p>';
				$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Nexter Extension', 'nexter' ) ) . '</p>';
			}
			echo '<div class="notice notice-info nexter-ext-notice is-dismissible">'.wp_kses_post($admin_notice).'</div>';
		}
		
		/**
		 * Check Activate Or Not Nexter Extension
		 */
		public function nexter_extension_activate(){
			$file_path = 'nexter-extension/nexter-extension.php';
			$installed_plugins = get_plugins();
			
			return isset( $installed_plugins[ $file_path ] );
		}
		
		/**
		 * Nexter Notice Dismiss Ajax
		 */
		public function nexter_ext_dismiss_notice_ajax(){
			check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
			
			update_option( 'nexter-extension-load-notice', 1 );
		}
		
	}
	new Nexter_Load_Enqueue_Styles_Scripts();
}