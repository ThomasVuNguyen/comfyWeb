<?php
/**
 * Nexter Theme Options Wp Customizer
 *
 * @package	Nexter
 * @since	1.0.0
 */
if ( ! class_exists( 'Nexter_Customizer' ) ) {

	class Nexter_Customizer {

		private static $instance;

		private static $configuration;

		private static $conditional_data = array();

		
		/**
		 * Include Customizer Panels and Sections
		 */
		public function include_config_panels() {
			require NXT_THEME_DIR . 'inc/customizer/customizer-register-panels-sections.php';
		}
		
		/**
		 * Include Customizer Controls
		 */
		private function include_register_controls(){
		
			$customize_config_url = NXT_THEME_DIR . 'inc/customizer/customizer-config';
			require $customize_config_url.'/nexter-customizer-config.php';
			
			/*
			 * Register Controls
			 */
			require $customize_config_url .'/general/class-body-style.php';
			require $customize_config_url .'/general/class-layout-container.php';
			require $customize_config_url .'/general/class-header.php';
			require $customize_config_url .'/general/class-footer.php';
			require $customize_config_url .'/general/class-layout-sidebar.php';
			require $customize_config_url .'/general/class-text-selection.php';
			require $customize_config_url .'/general/class-maintenance-mode.php';
			
			require $customize_config_url .'/styling-colors/class-body-colors.php';
			require $customize_config_url .'/styling-colors/class-heading-colors.php';
			
			require $customize_config_url .'/typography/class-heading-typography.php';
			require $customize_config_url .'/typography/class-body-typography.php';
			
			require $customize_config_url .'/blog/class-single-blog.php';
		}
		
		/**
		 * Default Values for the Customizer args
		 */
		private function customizer_configuration_defaults_args() {
			
			return apply_filters(
				'nexter_customizer_configuration_defaults_args',
				array(
					'title'                => null,
					'description'          => null,
					'label'                => null,
					'name'                 => null,
					'type'                 => null,
					'default'              => null,
					'selector'             => null,
					'priority'             => null,
					'settings'             => null,
					'capability'           => null,
					'datastore_type'       => 'option',
					'active_callback'      => null,
					'sanitize_callback'    => null,
					'sanitize_js_callback' => null,
					'theme_supports'       => null,
					'transport'            => null,
				)
			);
		}
		
		/**
		 * Get settings and controls Customizer Config
		 */
		private function get_settings_controls_config( $wp_customize ) {
		
			if ( ! is_null( self::$configuration ) ) {
				return self::$configuration;
			}
			return apply_filters( 'nexter_customizer_configurations', array(), $wp_customize );
		}
		
		/**
		 * Register Control Customizer Set Arguments
		 */
		public function register_control_customizer_settings( $wp_customize ) {

			$reg_controls = $this->get_settings_controls_config( $wp_customize );
			foreach ( $reg_controls as $key => $config ) {

				$config = wp_parse_args( $config, $this->customizer_configuration_defaults_args() );
				if(!empty($config['type']) && $config['type']=='control' ){
					unset( $config['type'] );
					$this->add_setting_control( $config, $wp_customize );
				}
			}
		}

		/**
		 * Add Register Setting and Control Customizer
		 */
		private function add_setting_control( $config, $wp_customize ) {

			$wp_customize->add_setting(
				nexter_get_array_value_of_key( $config, 'name' ),
				array(
					'type'              => nexter_get_array_value_of_key( $config, 'datastore_type' ),
					'default'           => nexter_get_array_value_of_key( $config, 'default' ),
					'transport'         => nexter_get_array_value_of_key( $config, 'transport', 'refresh' ),
					'sanitize_callback' => nexter_get_array_value_of_key( $config, 'sanitize_callback', Nexter_Customizer_Control_Base::get_sanitize_call( nexter_get_array_value_of_key( $config, 'control' ) ) ),
				)
			);

			$instance = Nexter_Customizer_Control_Base::get_control_instance( nexter_get_array_value_of_key( $config, 'control' ) );

			$config['type']  = nexter_get_array_value_of_key( $config, 'control' );
			$config['label'] = nexter_get_array_value_of_key( $config, 'title' );
			
			// For nexter-font control font-family and font-weight args 'font-type' converted to 'type'.
			if ( nexter_get_array_value_of_key( $config, 'font-type', false ) !== false ) {
				$config['type'] = nexter_get_array_value_of_key( $config, 'font-type', false );
			}

			if ( $instance !== false ) {
				$wp_customize->add_control(
					new $instance( $wp_customize, nexter_get_array_value_of_key( $config, 'name' ), $config )
				);
			} else {
				$wp_customize->add_control( nexter_get_array_value_of_key( $config, 'name' ), $config );
			}

			if ( nexter_get_array_value_of_key( $config, 'partial', false ) ) {

				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						nexter_get_array_value_of_key( $config, 'name' ),
						array(
							'selector'            => nexter_get_array_value_of_key( $config['partial'], 'selector' ),
							'container_inclusive' => nexter_get_array_value_of_key( $config['partial'], 'container_inclusive' ),
							'render_callback'     => nexter_get_array_value_of_key( $config['partial'], 'render_callback' ),
						)
					);
				}
			}

			if ( nexter_get_array_value_of_key( $config, 'conditional', false ) !== false ) {
				$key = nexter_get_array_value_of_key( $config, 'name' );
				$dependency = nexter_get_array_value_of_key( $config, 'conditional' );
				self::$conditional_data[ $key ] = $dependency;
			}
		}

		/**
		 * Print Footer Scripts
		 */
		public function print_footer_scripts() {
			$default_font = json_encode( Nexter_Font_Families_Listing::get_default_fonts_load() );
			$custom_font = json_encode( Nexter_Font_Families_Listing::get_custom_fonts_load() );
			$google_font = json_encode( Nexter_Font_Families_Listing::get_local_google_fonts_load() );
			
			if ( ! empty( $custom_font ) ) {
				$font_load = 'var NxtLoadFontFamily = { system: ' . $default_font . ', custom: ' . $custom_font . ', google: ' . $google_font . ' };';
			} else {
				$font_load = 'var NxtLoadFontFamily = { system: ' . $default_font . ', google: ' . $google_font . ' };';
			}
			$scripts  = '<script type="text/javascript">'; 
				$scripts .= $font_load;
			$scripts .= '</script>';

			echo $scripts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Register Custom Section, Panel and Control
		 */
		function customize_register_panel_section_controls( $wp_customize ) {

			/* Register Section and Panel Type */
			$wp_customize->register_panel_type( 'Nexter_Customizer_Panel' );
			$wp_customize->register_section_type( 'Nexter_Customizer_Section' );
			
			$customizer_uri  = NXT_THEME_DIR . 'inc/customizer/';
			require $customizer_uri . 'customizer-panel-section/nexter-customizer-panel.php';
			require $customizer_uri . 'customizer-panel-section/nexter-customizer-section.php';
			
			/*Include Customizer Controls */
			require $customizer_uri . 'include-controls.php';

			/* Add Customizer Controls */
			Nexter_Customizer_Control_Base::add_control(
				'nxt-color',
				array(
					'callback'          => 'Nexter_Control_Color',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_alpha_rgba_color' ),
				)
			);
			
			Nexter_Customizer_Control_Base::add_control(
				'color',
				array(
					'callback'          => 'WP_Customize_Color_Control',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_hex_color' ),
				)
			);
			
			Nexter_Customizer_Control_Base::add_control(
				'image',
				array(
					'callback'          => 'WP_Customize_Image_Control',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			Nexter_Customizer_Control_Base::add_control(
				'number',
				array(
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_number' ),
				)
			);
			
			Nexter_Customizer_Control_Base::add_control(
				'nxt-multi-checkbox',
				array(
					'callback'         => 'Nexter_Control_MultiCheckbox',
					'santize_callback' => '',
				)
			);

			Nexter_Customizer_Control_Base::add_control(
				'nxt-heading',
				array(
					'callback'          => 'Nexter_Control_Heading',
					'sanitize_callback' => '',
				)
			);
			
			Nexter_Customizer_Control_Base::add_control(
				'nxt-font-control',
				array(
					'callback'          => 'Nexter_Control_Typography',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			Nexter_Customizer_Control_Base::add_control(
				'nxt-switcher',
				array(
					'callback'         => 'Nexter_Control_Switcher',
					'santize_callback' => '',
				)
			);
			
			Nexter_Customizer_Control_Base::add_control(
				'nxt-slider',
				array(
					'callback'          => 'Nexter_Control_Slider',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_number' ),
				)
			);
			
			//Group Control
			Nexter_Customizer_Control_Base::add_control(
				'nxt-responsive-slider',
				array(
					'callback'          => 'Nexter_Control_Responsive_Slider',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_responsive_slider' ),
				)
			);

			Nexter_Customizer_Control_Base::add_control(
				'nxt-background',
				array(
					'callback'          => 'Nexter_Control_Background',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_background' ),
				)
			);
			
			Nexter_Customizer_Control_Base::add_control(
				'nxt-responsive',
				array(
					'callback'          => 'Nexter_Control_Responsive',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_responsive_typography' ),
				)
			);

			Nexter_Customizer_Control_Base::add_control(
				'nxt-responsive-spacing',
				array(
					'callback'          => 'Nexter_Control_Responsive_Spacing',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_responsive_dimension' ),
				)
			);

			/**
			 * Load sanitization Callbacks
			 */
			require $customizer_uri . 'nexter-sanitization-callbacks.php';
		}

		/**
		 * Add postMessage support default customize option
		 * @since 1.0.0
		 */
		function customize_register( $wp_customize ) {
			
			//Add postMessage
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

			
			//Change Priority Control
			$wp_customize->get_control( 'custom_logo' )->priority      = 5;
			$wp_customize->get_control( 'blogname' )->priority         = 6;
			$wp_customize->get_control( 'blogdescription' )->priority  = 7;

			//Remove Control Customizer
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section( 'background_image' );
			$wp_customize->remove_section( 'header_image' );
			$wp_customize->remove_control('header_image');
			$wp_customize->remove_control('display_header_text');
			
		}
		
		/**
		 * Customizer Controls scripts
		 * @since 1.0.0
		 */
		function controls_scripts() {
			global $wp_version;
			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'nexter-color-picker' );
			
			/**
			 * Localize wp-color-picker & wpColorPickerL10n.
			 *
			 * This is only needed in WordPress version >= 5.5 because wpColorPickerL10n has been removed.
			 *
			 * @see https://github.com/WordPress/WordPress/commit/7e7b70cd1ae5772229abb769d0823411112c748b
			 *
			 * This is should be removed once the issue is fixed from wp-color-picker-alpha repo.
			 * @see https://github.com/kallookoo/wp-color-picker-alpha/issues/35
			 *
			 * @since 2.5.3
			 */
			if ( version_compare( $wp_version, '5.4.99', '>=' ) ) {
				
				$color_picker_strings = array(
					'clear'            => __( 'Clear', 'nexter' ),
					'clearAriaLabel'   => __( 'Clear color', 'nexter' ),
					'defaultString'    => __( 'Default', 'nexter' ),
					'defaultAriaLabel' => __( 'Select default color', 'nexter' ),
					'pick'             => __( 'Select Color', 'nexter' ),
					'defaultLabel'     => __( 'Color value', 'nexter' ),
				);
				wp_localize_script( 'nexter-color-picker', 'wpColorPickerL10n', $color_picker_strings );
			}
			
			//Customizer Assets - Panel/Section
			wp_enqueue_style( 'nexter-extend-customizer-css', NXT_CSS_URI . 'main/customizer/nexter-extend-customizer'. $minified .'.css', null, NXT_VERSION );
			wp_enqueue_script( 'nexter-extend-customizer-js', NXT_JS_URI . 'main/customizer/nexter-extend-customizer'. $minified .'.js', array(), NXT_VERSION, true );

			wp_enqueue_script( 'nexter-customizer-controls', NXT_JS_URI . 'main/customizer/nexter-customizer-controls'. $minified .'.js', array('nexter-color-picker','jquery', 'customize-base'), NXT_VERSION, true );
			wp_localize_script(
				'nexter-customizer-controls',
				'nexterControlBg',
				array(
					'placeholder'  => __( 'Choose a file', 'nexter' ),
				)
			);
			
			wp_enqueue_script( 'nexter-customizer-conditional', NXT_JS_URI . 'main/customizer/nexter-customizer-conditional'. $minified .'.js', array(), NXT_VERSION, true );

			//Customizer Controls
			wp_enqueue_style( 'nexter-customizer-controls-css', NXT_CSS_URI . 'main/customizer/nexter-customizer-controls'. $minified .'.css', null, NXT_VERSION );
			
			wp_localize_script(
				'nexter-customizer-conditional',
				'nexter',
				apply_filters(
					'nexter_theme_customizer_js_localize',
					array(
						'theme'      => array(
							'option' => NXT_OPTIONS,
						),
						'config'     => self::$conditional_data,
					)
				)
			);

		}

		/**
		 * Customizer Preview Css and Js
		 */
		public function customizer_load_preview_css_js() {
			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			Nexter_Customizer_Options::refresh();
			wp_enqueue_script( 'nxt-customizer-preview-js', NXT_JS_URI . 'main/customizer/nxt-customizer-preview'. $minified .'.js', array( 'customize-preview' ), NXT_VERSION, null );
		}
 
		/**
		 * customize_save_after action to refresh cached CSS refresh Customizer saved
		 * @since 1.0.0
		 */
		function nxt_customize_save() {
			Nexter_Customizer_Options::refresh();
			do_action( 'nexter_customizer_save' );
		}
		
		/**
		 * Initiator instance
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
		
			define( 'NXT_CUSTOMIZER_CONTROL_PATH', NXT_THEME_DIR . 'inc/customizer/controls' );
			define( 'NXT_CUSTOMIZER_CONTROL_URI', NXT_THEME_URI . 'inc/customizer/controls' );
			
			$this->include_register_controls();
			
			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'include_config_panels' ), 2 );
				add_action( 'customize_register', array( $this, 'register_control_customizer_settings' ) );
			}
			
			add_action( 'customize_preview_init', array( $this, 'customizer_load_preview_css_js' ) );

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_scripts' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'print_footer_scripts' ) );
			add_action( 'customize_register', array( $this, 'customize_register_panel_section_controls' ), 2 );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_save_after', array( $this, 'nxt_customize_save' ) );
		}

	}
}

Nexter_Customizer::get_instance();