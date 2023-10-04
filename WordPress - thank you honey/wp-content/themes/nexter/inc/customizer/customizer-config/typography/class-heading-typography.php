<?php
/**
 * Heading Typography Styling Options for Nexter Theme.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Heading_Typography' ) ) {

	class Nexter_Heading_Typography extends Nexter_Customizer_Config {
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'nxt_render_theme_css', array( $this, 'dynamic_css' ) );
			add_filter( 'nxt_gutenberg_render_theme_css', array( $this, 'gutenberg_dynamic_css' ),1 );
			parent::__construct();
		}
		
		/**
		 * Register Content Typography Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(
				
				/** Start
				 * Options Heading H1 Typography
				 */				 
				array(
					'name'      => NXT_OPTIONS . '[heading-section-h1]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-heading-h1-typo',
					'priority'  => 4,
					'title'     => __( 'Heading H1', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[font-family-h1]',
					'type'      => 'control',
					'control'   => 'nxt-font-control',
					'section'   => 'section-heading-h1-typo',
					'font-type' => 'nxt-font-family',
					'default'   => nexter_get_option( 'font-family-h1' ),
					'title'     => __( 'Font Family', 'nexter' ),					
					'priority'  => 4,
					'connect'   => NXT_OPTIONS . '[font-weight-h1]',
				),
				array(
					'name'              => NXT_OPTIONS . '[font-weight-h1]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-heading-h1-typo',
					'font-type'         => 'nxt-font-weight',
					'title'             => __( 'Font Weight', 'nexter' ),
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => nexter_get_option( 'font-weight-h1' ),					
					'priority'          => 4,
					'connect'           => NXT_OPTIONS . '[font-family-h1]',
				),
				array(
					'name'     => NXT_OPTIONS . '[transform-h1]',					
					'default'  => nexter_get_option( 'transform-h1' ),
					'title'    => __( 'Text Transform', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-heading-h1-typo',
					'transport' => 'postMessage',
					'priority' => 4,
					'choices'  => array(
						''           => __( 'Inherit', 'nexter' ),
						'none'       => __( 'None', 'nexter' ),
						'capitalize' => __( 'Capitalize', 'nexter' ),
						'uppercase'  => __( 'Uppercase', 'nexter' ),
						'lowercase'  => __( 'Lowercase', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[font-size-h1]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-heading-h1-typo',
					'default'     => nexter_get_option( 'font-size-h1' ),
					'transport'   => 'postMessage',
					'priority'    => 5,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[line-height-h1]',
					'default'     => nexter_get_option( 'line-height-h1' ),
					'title'       => __( 'Line Height', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-heading-h1-typo',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				/** End
				 * Options Heading H1 Typography
				 */
				 
				/** Start
				 * Options Heading H2 Typography
				 */
				array(
					'name'     => NXT_OPTIONS . '[heading-section-h2]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'section'  => 'section-heading-h2-typo',
					'priority' => 4,
					'title'    => __( 'Heading H2', 'nexter' ),
					'settings' => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[font-family-h2]',
					'type'      => 'control',
					'control'   => 'nxt-font-control',
					'section'   => 'section-heading-h2-typo',
					'font-type' => 'nxt-font-family',
					'default'   => nexter_get_option( 'font-family-h2' ),
					'title'     => __( 'Font Family', 'nexter' ),					
					'priority'  => 4,
					'connect'   => NXT_OPTIONS . '[font-weight-h2]',
				),
				array(
					'name'              => NXT_OPTIONS . '[font-weight-h2]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-heading-h2-typo',
					'font-type'         => 'nxt-font-weight',
					'title'             => __( 'Font Weight', 'nexter' ),
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => nexter_get_option( 'font-weight-h2' ),					
					'priority'          => 4,
					'connect'           => NXT_OPTIONS . '[font-family-h2]',
				),
				array(
					'name'     => NXT_OPTIONS . '[transform-h2]',					
					'default'  => nexter_get_option( 'transform-h2' ),
					'title'    => __( 'Text Transform', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-heading-h2-typo',
					'transport' => 'postMessage',
					'priority' => 4,
					'choices'  => array(
						''           => __( 'Inherit', 'nexter' ),
						'none'       => __( 'None', 'nexter' ),
						'capitalize' => __( 'Capitalize', 'nexter' ),
						'uppercase'  => __( 'Uppercase', 'nexter' ),
						'lowercase'  => __( 'Lowercase', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[font-size-h2]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-heading-h2-typo',
					'default'     => nexter_get_option( 'font-size-h2' ),
					'transport'   => 'postMessage',
					'priority'    => 5,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[line-height-h2]',
					'default'     => nexter_get_option( 'line-height-h2' ),
					'title'       => __( 'Line Height', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-heading-h2-typo',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				/** End
				 * Options Heading H2 Typography
				 */
				 
				/** Start
				 * Options Heading H3 Typography
				 */
				array(
					'name'     => NXT_OPTIONS . '[heading-section-h3]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'section'  => 'section-heading-h3-typo',
					'priority' => 4,
					'title'    => __( 'Heading H3', 'nexter' ),
					'settings' => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[font-family-h3]',
					'type'      => 'control',
					'control'   => 'nxt-font-control',
					'section'   => 'section-heading-h3-typo',
					'font-type' => 'nxt-font-family',
					'default'   => nexter_get_option( 'font-family-h3' ),
					'title'     => __( 'Font Family', 'nexter' ),
					'priority'  => 4,
					'connect'   => NXT_OPTIONS . '[font-weight-h3]',
				),
				array(
					'name'              => NXT_OPTIONS . '[font-weight-h3]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-heading-h3-typo',
					'font-type'         => 'nxt-font-weight',
					'title'             => __( 'Font Weight', 'nexter' ),
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => nexter_get_option( 'font-weight-h3' ),
					'priority'          => 4,
					'connect'           => NXT_OPTIONS . '[font-family-h3]',
				),
				array(
					'name'     => NXT_OPTIONS . '[transform-h3]',
					'default'  => nexter_get_option( 'transform-h3' ),
					'title'    => __( 'Text Transform', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-heading-h3-typo',
					'transport' => 'postMessage',
					'priority' => 4,
					'choices'  => array(
						''           => __( 'Inherit', 'nexter' ),
						'none'       => __( 'None', 'nexter' ),
						'capitalize' => __( 'Capitalize', 'nexter' ),
						'uppercase'  => __( 'Uppercase', 'nexter' ),
						'lowercase'  => __( 'Lowercase', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[font-size-h3]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-heading-h3-typo',
					'priority'    => 5,
					'default'     => nexter_get_option( 'font-size-h3' ),
					'transport'   => 'postMessage',
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[line-height-h3]',
					'default'     => nexter_get_option( 'line-height-h3' ),
					'title'       => __( 'Line Height', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-heading-h3-typo',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				/** End
				 * Options Heading H3 Typography
				 */
				 
				/** Start
				 * Options Heading H4 Typography
				 */
				array(
					'name'     => NXT_OPTIONS . '[heading-section-h4]',
					'type'     => 'control',
					'title'    => __( 'Heading H4', 'nexter' ),
					'section'  => 'section-content-typo',
					'control'  => 'nxt-heading',
					'priority' => 4,
					'settings' => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[font-family-h4]',
					'type'      => 'control',
					'control'   => 'nxt-font-control',
					'section'   => 'section-heading-h4-typo',
					'font-type' => 'nxt-font-family',
					'default'   => nexter_get_option( 'font-family-h4' ),
					'title'     => __( 'Font Family', 'nexter' ),
					'priority'  => 4,
					'connect'   => NXT_OPTIONS . '[font-weight-h4]',
				),
				array(
					'name'              => NXT_OPTIONS . '[font-weight-h4]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-heading-h4-typo',
					'font-type'         => 'nxt-font-weight',
					'title'             => __( 'Font Weight', 'nexter' ),
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => nexter_get_option( 'font-weight-h4' ),
					'priority'          => 4,
					'connect'           => NXT_OPTIONS . '[font-family-h4]',
				),
				array(
					'name'     => NXT_OPTIONS . '[transform-h4]',
					'default'  => nexter_get_option( 'transform-h4' ),
					'title'    => __( 'Text Transform', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-heading-h4-typo',
					'transport' => 'postMessage',
					'priority' => 4,
					'choices'  => array(
						''           => __( 'Inherit', 'nexter' ),
						'none'       => __( 'None', 'nexter' ),
						'capitalize' => __( 'Capitalize', 'nexter' ),
						'uppercase'  => __( 'Uppercase', 'nexter' ),
						'lowercase'  => __( 'Lowercase', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[font-size-h4]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-heading-h4-typo',
					'default'     => nexter_get_option( 'font-size-h4' ),
					'transport'   => 'postMessage',
					'priority'    => 4,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[line-height-h4]',
					'default'     => nexter_get_option( 'line-height-h4' ),
					'title'       => __( 'Line Height', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-heading-h4-typo',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				/** End
				 * Options Heading H4 Typography
				 */
				 
				/** Start
				 * Options Heading H5 Typography
				 */
				array(
					'name'     => NXT_OPTIONS . '[heading-section-h5]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'section'  => 'section-heading-h5-typo',
					'priority' => 4,
					'title'    => __( 'Heading H5', 'nexter' ),
					'settings' => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[font-family-h5]',
					'type'      => 'control',
					'control'   => 'nxt-font-control',
					'section'   => 'section-heading-h5-typo',
					'font-type' => 'nxt-font-family',
					'default'   => nexter_get_option( 'font-family-h5' ),
					'title'     => __( 'Font Family', 'nexter' ),
					'priority'  => 4,
					'connect'   => NXT_OPTIONS . '[font-weight-h5]',
				),
				array(
					'name'              => NXT_OPTIONS . '[font-weight-h5]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-heading-h5-typo',
					'font-type'         => 'nxt-font-weight',
					'title'             => __( 'Font Weight', 'nexter' ),
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => nexter_get_option( 'font-weight-h5' ),
					'priority'          => 4,
					'connect'           => NXT_OPTIONS . '[font-family-h5]',
				),
				array(
					'name'     => NXT_OPTIONS . '[transform-h5]',
					'default'  => nexter_get_option( 'transform-h5' ),
					'title'    => __( 'Text Transform', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-heading-h5-typo',
					'transport' => 'postMessage',
					'priority' => 4,
					'choices'  => array(
						''           => __( 'Inherit', 'nexter' ),
						'none'       => __( 'None', 'nexter' ),
						'capitalize' => __( 'Capitalize', 'nexter' ),
						'uppercase'  => __( 'Uppercase', 'nexter' ),
						'lowercase'  => __( 'Lowercase', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[font-size-h5]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-heading-h5-typo',
					'default'     => nexter_get_option( 'font-size-h5' ),
					'transport'   => 'postMessage',
					'priority'    => 5,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[line-height-h5]',
					'default'     => nexter_get_option( 'line-height-h5' ),
					'title'       => __( 'Line Height', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-heading-h5-typo',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				/** End
				 * Options Heading H5 Typography
				 */
				 
				/** Start
				 * Options Heading H6 Typography
				 */
				array(
					'name'     => NXT_OPTIONS . '[heading-section-h6]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'title'    => __( 'Heading H6', 'nexter' ),
					'section'  => 'section-heading-h6-typo',
					'priority' => 4,
					'settings' => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[font-family-h6]',
					'type'      => 'control',
					'control'   => 'nxt-font-control',
					'section'   => 'section-heading-h6-typo',
					'font-type' => 'nxt-font-family',
					'default'   => nexter_get_option( 'font-family-h6' ),
					'title'     => __( 'Font Family', 'nexter' ),
					'priority'  => 4,
					'connect'   => NXT_OPTIONS . '[font-weight-h6]',
				),
				array(
					'name'              => NXT_OPTIONS . '[font-weight-h6]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-heading-h6-typo',
					'font-type'         => 'nxt-font-weight',
					'title'             => __( 'Font Weight', 'nexter' ),
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => nexter_get_option( 'font-weight-h6' ),
					'priority'          => 4,
					'connect'           => NXT_OPTIONS . '[font-family-h6]',
				),
				array(
					'name'     => NXT_OPTIONS . '[transform-h6]',
					'default'  => nexter_get_option( 'transform-h6' ),
					'title'    => __( 'Text Transform', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-heading-h6-typo',
					'transport' => 'postMessage',
					'priority' => 4,
					'choices'  => array(
						''           => __( 'Inherit', 'nexter' ),
						'none'       => __( 'None', 'nexter' ),
						'capitalize' => __( 'Capitalize', 'nexter' ),
						'uppercase'  => __( 'Uppercase', 'nexter' ),
						'lowercase'  => __( 'Lowercase', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[font-size-h6]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-heading-h6-typo',
					'default'     => nexter_get_option( 'font-size-h6' ),
					'transport'   => 'postMessage',
					'priority'    => 5,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[line-height-h6]',
					'default'     => nexter_get_option( 'line-height-h6' ),
					'title'       => __( 'Line Height', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-heading-h6-typo',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				/** End
				 * Options Heading H6 Typography
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
			
			$opt_val = [];
			$style	 = [];
			$tablet_style = [];
			$mobile_style = [];
			foreach($heading_selector as $key => $selector){
				$opt_val[$key.'-size']   = nexter_get_option('font-size-'.$key );
				$opt_val[$key.'-height'] = nexter_get_option('line-height-'.$key);
				$opt_val[$key.'-family'] = nexter_get_option('font-family-'.$key);
				$opt_val[$key.'-weight'] = nexter_get_option('font-weight-'.$key);
				$opt_val[$key.'-transform'] = nexter_get_option('transform-'.$key);
				
				$style[$selector]  = [
						'font-size' => nexter_responsive_size_css($opt_val[$key.'-size'], 'desktop'),
						'line-height' => (!empty($opt_val[$key.'-height']['desktop'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['desktop'], '' ) : '',
						'font-family' => nexter_get_option_css_value($opt_val[$key.'-family'], 'font'),
						'font-weight' => nexter_get_option_css_value($opt_val[$key.'-weight'], 'font'),
						'text-transform' => esc_attr($opt_val[$key.'-transform']),
					];
				
				$tablet_style[$selector] = [
						'font-size' => nexter_responsive_size_css($opt_val[$key.'-size'], 'tablet'),
						'line-height' => (!empty($opt_val[$key.'-height']['tablet'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['tablet'], '' ) : ((!empty($opt_val[$key.'-height']['desktop'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['desktop'], '' ) : ''),
					];
				$mobile_style[$selector] = [
						'font-size' => nexter_responsive_size_css($opt_val[$key.'-size'], 'mobile'),
						'line-height' => (!empty($opt_val[$key.'-height']['mobile'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['mobile'], '' ) : ((!empty($opt_val[$key.'-height']['tablet'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['tablet'], '' ) : ((!empty($opt_val[$key.'-height']['desktop'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['desktop'], '' ) : '') ),
					];
			}
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			if( !empty($tablet_style)){
				$theme_css['tablet']= array_merge_recursive($theme_css['tablet'],$tablet_style);
			}
			
			if( !empty($mobile_style)){
				$theme_css['mobile']= array_merge_recursive($theme_css['mobile'],$mobile_style);
			}
			
			return $theme_css;
		}
		
		/*
		 * Gutenberg Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function gutenberg_dynamic_css( $theme_css ){
			
			$heading_selector = [ 'h1' => '.edit-post-visual-editor h1,.editor-styles-wrapper .block-editor-block-list__block h1,.editor-styles-wrapper .block-editor-block-list__block h1 a',
					   'h2' => '.edit-post-visual-editor h2,.editor-styles-wrapper .block-editor-block-list__block h2, .editor-styles-wrapper .block-editor-block-list__block h2 a',
					   'h3' => '.edit-post-visual-editor h3,.editor-styles-wrapper .block-editor-block-list__block h3, .editor-styles-wrapper .block-editor-block-list__block h3 a, .archive-post-title a',
					   'h4' => '.edit-post-visual-editor h4,.editor-styles-wrapper .block-editor-block-list__block h4, .editor-styles-wrapper .block-editor-block-list__block h4 a',
					   'h5' => '.edit-post-visual-editor h5, .editor-styles-wrapper .block-editor-block-list__block h5, .editor-styles-wrapper .block-editor-block-list__block h5 a',
					   'h6' => '.edit-post-visual-editor h6,.editor-styles-wrapper .block-editor-block-list__block h6, .editor-styles-wrapper .block-editor-block-list__block h6 a'
					];
					   
			$opt_val = [];		   
			$style = [];
			$tablet_style = [];
			$mobile_style = [];
			
			foreach($heading_selector as $key => $selector){
				$opt_val[$key.'-size']   = nexter_get_option('font-size-'.$key );
				$opt_val[$key.'-height'] = nexter_get_option('line-height-'.$key);
				$opt_val[$key.'-family'] = nexter_get_option('font-family-'.$key);
				$opt_val[$key.'-weight'] = nexter_get_option('font-weight-'.$key);
				$opt_val[$key.'-transform'] = nexter_get_option('transform-'.$key);
				
				$style[$selector]  = [
						'font-size' => nexter_responsive_size_css($opt_val[$key.'-size'], 'desktop'),
						'line-height' => (!empty($opt_val[$key.'-height']['desktop'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['desktop'], '' ) : '',
						'font-family' => nexter_get_option_css_value($opt_val[$key.'-family'], 'font'),
						'font-weight' => nexter_get_option_css_value($opt_val[$key.'-weight'], 'font'),
						'text-transform' => esc_attr($opt_val[$key.'-transform']),
					];
				
				$tablet_style[$selector] = [
						'font-size' => nexter_responsive_size_css($opt_val[$key.'-size'], 'tablet'),
						'line-height' => (!empty($opt_val[$key.'-height']['tablet'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['tablet'], '' ) : ((!empty($opt_val[$key.'-height']['desktop'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['desktop'], '' ) : ''),
					];
				$mobile_style[$selector] = [
						'font-size' => nexter_responsive_size_css($opt_val[$key.'-size'], 'mobile'),
						'line-height' => (!empty($opt_val[$key.'-height']['mobile'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['mobile'], '' ) : ((!empty($opt_val[$key.'-height']['tablet'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['tablet'], '' ) : ((!empty($opt_val[$key.'-height']['desktop'])) ? nexter_get_option_css_value( $opt_val[$key.'-height']['desktop'], '' ) : '')),
					];
			}
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			if( !empty($tablet_style)){
				$theme_css['tablet'] = (!empty($theme_css['tablet']) && isset($theme_css['tablet'])) ? $theme_css['tablet'] : [];
				$theme_css['tablet']= array_merge_recursive($theme_css['tablet'],$tablet_style);
			}
			
			if( !empty($mobile_style)){
				$theme_css['mobile'] = (!empty($theme_css['mobile']) && isset($theme_css['mobile'])) ? $theme_css['mobile'] : [];
				$theme_css['mobile']= array_merge_recursive($theme_css['mobile'],$mobile_style);
			}
			
			return $theme_css;
		}
		
	}
}

new Nexter_Heading_Typography;