<?php
/**
 * Whole Site Text Selection Options for Nexter Theme.
 *
 * @package     Nexter
 * @since       Nexter 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Site_Text_Selection_Style' ) ) {

	class Nexter_Site_Text_Selection_Style extends Nexter_Customizer_Config {
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'nxt_render_theme_css', array( $this, 'dynamic_css' ) );
			parent::__construct();
		}
		
		/**
		 * Register Whole Site Text Selection Style Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(

				/** Start
				 * Options Site Text Selection Color
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-text-selection]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-selected-text-style',
					'priority'  => 5,
					'title'     => __( 'Selection Text/Content', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'     => NXT_OPTIONS . '[selected-text-bg-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-selected-text-style',
					'transport' => 'postMessage',
					'default'  => '#ff5a6e',
					'priority' => 10,
					'title'    => __( 'Selected Text Background Color', 'nexter' ),					
				),
				array(
					'name'     => NXT_OPTIONS . '[selected-text-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-selected-text-style',
					'transport' => 'postMessage',
					'default'  => '#fff',
					'priority' => 15,
					'title'    => __( 'Selected Text Color', 'nexter' ),
				),
			);

			return array_merge( $configurations, $options );
		}
		
		/*
		 * Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function dynamic_css( $theme_css ){
			
			$selected_text_bg_color = nexter_get_option('selected-text-bg-color');
			$selected_text_color = nexter_get_option('selected-text-color');
			
			$style =array();
			
			$style = array(
				'::selection' => array(
					'color' => esc_attr($selected_text_color),
                    'background' => esc_attr($selected_text_bg_color)
				),
			);
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			return $theme_css;
		}
	}
}

new Nexter_Site_Text_Selection_Style;