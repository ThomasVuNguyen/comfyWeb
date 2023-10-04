<?php
/**
 * Heading Color Styling Options for Nexter Theme.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Heading_Colors' ) ) {

	class Nexter_Heading_Colors extends Nexter_Customizer_Config {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'nxt_render_theme_css', array( $this, 'dynamic_css' ) );
			add_filter( 'nxt_gutenberg_render_theme_css', array( $this, 'gutenberg_dynamic_css' ),1 );
			parent::__construct();
		}
		
		/**
		 * Register Heading Color Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$options = array(

				/** Start
				 * Options Heading Styling Color
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-colors]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-heading-colors',
					'priority'  => 4,
					'title'     => __( 'Heading (H1-H6) Color', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'     => NXT_OPTIONS . '[heading-color-h1]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-heading-colors',
					'default'  => '#313131',
					'transport' => 'postMessage',
					'priority' => 5,
					'title'    => __( 'Heading (H1) Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[heading-color-h2]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-heading-colors',
					'default'  => '#313131',
					'transport' => 'postMessage',
					'priority' => 10,
					'title'    => __( 'Heading (H2) Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[heading-color-h3]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-heading-colors',
					'default'  => '#313131',
					'transport' => 'postMessage',
					'priority' => 15,
					'title'    => __( 'Heading (H3) Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[heading-color-h4]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-heading-colors',
					'default'  => '#313131',
					'transport' => 'postMessage',
					'priority' => 20,
					'title'    => __( 'Heading (H4) Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[heading-color-h5]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-heading-colors',
					'default'  => '#808285',
					'transport' => 'postMessage',
					'priority' => 25,
					'title'    => __( 'Heading (H5) Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[heading-color-h6]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-heading-colors',
					'default'  => '#808285',
					'transport' => 'postMessage',
					'priority' => 30,
					'title'    => __( 'Heading (H6) Color', 'nexter' ),
				),
				
				/** End
				 * Options Body Styling Color
				 */
			);

			return array_merge( $configurations, $options );
		}
		
		/*
		 * Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function dynamic_css( $theme_css ){
			
			$heading_selector = [ 'h1' => 'h1, h1 a',
								'h2' => 'h2, h2 a',
								'h3' => 'h3, h3 a, .archive-post-title a',
								'h4' => 'h4, h4 a',
								'h5' => 'h5, h5 a',
								'h6' => 'h6, h6 a'
							];
			$style = [];			
			foreach($heading_selector as $key => $selector){
				$color	= nexter_get_option('heading-color-'.$key);
				$style[$selector]  = [
					'color' => esc_attr($color)
				];
			}
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			return $theme_css;
		}
		
		/*
		 * Gutenberg Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function gutenberg_dynamic_css( $theme_css ){
			
			$heading_selector = [ 'h1' => '.edit-post-visual-editor h1, .editor-styles-wrapper .block-editor-block-list__block h1, .editor-styles-wrapper .block-editor-block-list__block h1 a',
								'h2' => '.edit-post-visual-editor h2, .editor-styles-wrapper .block-editor-block-list__block h2, .editor-styles-wrapper .block-editor-block-list__block h2 a',
								'h3' => '.edit-post-visual-editor h3, .editor-styles-wrapper .block-editor-block-list__block h3, .editor-styles-wrapper .block-editor-block-list__block h3 a',
								'h4' => '.edit-post-visual-editor h4, .editor-styles-wrapper .block-editor-block-list__block h4, .editor-styles-wrapper .block-editor-block-list__block h4 a',
								'h5' => '.edit-post-visual-editor h5, .editor-styles-wrapper .block-editor-block-list__block h5, .editor-styles-wrapper .block-editor-block-list__block h5 a',
								'h6' => '.edit-post-visual-editor h6, .editor-styles-wrapper .block-editor-block-list__block h6, .editor-styles-wrapper .block-editor-block-list__block h6 a'
							];
			$style = [];			
			foreach($heading_selector as $key => $selector){
				$color	= nexter_get_option('heading-color-'.$key);
				$style[$selector]  = [
					'color' => esc_attr($color)
				];
			}
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			return $theme_css;
		}
		
	}
}

new Nexter_Heading_Colors;