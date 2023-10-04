<?php
/**
 * Body Typography Styling Options for Nexter Theme.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Body_Typography' ) ) {

	class Nexter_Body_Typography extends Nexter_Customizer_Config {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'nxt_render_theme_css', array( $this, 'dynamic_css' ),1 );
			add_filter( 'nxt_gutenberg_render_theme_css', array( $this, 'gutenberg_dynamic_css' ),1 );
			parent::__construct();
		}
		
		/**
		 * Register Body Typography Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(

				/** Start
				 * Options Body Typography
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-body-typo]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-body-typography',
					'priority'  => 4,
					'title'     => __( 'Body', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'        => NXT_OPTIONS . '[body-font-family]',
					'type'        => 'control',
					'control'     => 'nxt-font-control',
					'section'     => 'section-body-typography',
					'font-type'   => 'nxt-font-family',
					'font_inherit' => __( 'Default System Font', 'nexter' ),
					'default'     => nexter_get_option( 'body-font-family' ),
					'priority'    => 5,
					'title'       => __( 'Font Family', 'nexter' ),
					'connect'     => NXT_OPTIONS . '[body-font-weight]',
					'variant'     => NXT_OPTIONS . '[body-font-variant]',
				),
				array(
					'name'              => NXT_OPTIONS . '[body-font-variant]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-body-typography',
					'font-type'         => 'nxt-font-variant',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_variant' ),
					'default'           => nexter_get_option( 'body-font-variant' ),
					'font_inherit'       => __( 'Default', 'nexter' ),					
					'priority'          => 10,
					'title'             => __( 'Font Variant', 'nexter' ),
					'variant'           => NXT_OPTIONS . '[body-font-family]',
				),
				array(
					'name'              => NXT_OPTIONS . '[body-font-weight]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-body-typography',
					'font-type'         => 'nxt-font-weight',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => nexter_get_option( 'body-font-weight' ),
					'font_inherit'       => __( 'Default', 'nexter' ),					
					'priority'          => 10,
					'title'             => __( 'Font Weight', 'nexter' ),
					'connect'           => NXT_OPTIONS . '[body-font-family]',
				),
				array(
					'name'     => NXT_OPTIONS . '[body-transform]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-body-typography',
					'transport'         => 'postMessage',
					'default'  => nexter_get_option( 'body-transform' ),
					'priority' => 15,
					'title'    => __( 'Text Transform', 'nexter' ),
					'choices'  => array(
						''           => __( 'Default', 'nexter' ),
						'none'       => __( 'None', 'nexter' ),
						'capitalize' => __( 'Capitalize', 'nexter' ),
						'uppercase'  => __( 'Uppercase', 'nexter' ),
						'lowercase'  => __( 'Lowercase', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[font-size-body]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-body-typography',
					'default'     => nexter_get_option( 'font-size-body' ),
					'priority'    => 20,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[body-line-height]',
					'default'     => nexter_get_option( 'body-line-height' ),
					'title'       => __( 'Line Height', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-body-typography',
					'priority'    => 25,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				/** End
				 * Options Body Typography
				 */
				
				/**
				 * Options Paragraph (P) Margin Bottom
				 */
				array(
					'name'              => NXT_OPTIONS . '[paragraph-mb]',
					'type'              => 'control',
					'control'           => 'nxt-slider',
					'default'           => '',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_number_val' ),
					'transport'         => 'postMessage',
					'section'           => 'section-body-typography',
					'priority'          => 25,
					'title'             => __( 'Paragraph (P) Margin Bottom', 'nexter' ),
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 0.5,
						'step' => 0.01,
						'max'  => 5,
					),
				),

			);

			return array_merge( $configurations, $options );
		}
		
		/*
		 * Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function dynamic_css( $theme_css ){
		
			$body_fontfamily = nexter_get_body_fontfamily();
            $body_fontweight = nexter_get_option('body-font-weight');
            $body_fontsize   = nexter_get_option('font-size-body');
            $body_lineheight = nexter_get_option('body-line-height');
            $body_transform  = nexter_get_option('body-transform');
            $paragraphy_mb   = nexter_get_option('paragraph-mb');
			
			$style =array();
			
			$style  = array(
                'body, button, input, select,optgroup, textarea' => array(
                    'font-family' => nexter_get_font_family_css($body_fontfamily),
                    'font-weight' => esc_attr($body_fontweight),
                    'font-size' => nexter_responsive_size_css($body_fontsize, 'desktop'),
                    'line-height' => (!empty($body_lineheight['desktop'])) ? nexter_get_option_css_value( $body_lineheight['desktop'], '' ) : '',
                    'text-transform' => esc_attr($body_transform)
                ),
				'p, .entry-content p' => array(
                    'margin-bottom' => nexter_get_option_css_value($paragraphy_mb, 'em')
                ),
            );
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			//Tablet css
			$tablet_style = array(
				'body, button, input, select,optgroup, textarea' => array(
                    'font-size' => nexter_responsive_size_css($body_fontsize, 'tablet'),
					'line-height' => (!empty($body_lineheight['tablet'])) ? nexter_get_option_css_value( $body_lineheight['tablet'], '' ) : ((!empty($body_lineheight['desktop'])) ? nexter_get_option_css_value( $body_lineheight['desktop'], '' ) : ''),
                ),
			);
			
			
			if( !empty($tablet_style)){
				$theme_css['tablet'] = (!empty($theme_css['tablet']) && isset($theme_css['tablet'])) ? $theme_css['tablet'] : [];
				$theme_css['tablet']= array_merge_recursive($theme_css['tablet'],$tablet_style);
			}
			
			//Mobile css
			$mobile_style = array(
				'body, button, input, select,optgroup, textarea' => array(
                    'font-size' => nexter_responsive_size_css($body_fontsize, 'mobile'),
					'line-height' => (!empty($body_lineheight['mobile'])) ? nexter_get_option_css_value( $body_lineheight['mobile'], '' ) : ((!empty($body_lineheight['tablet'])) ? nexter_get_option_css_value( $body_lineheight['tablet'], '' ) : ((!empty($body_lineheight['desktop'])) ? nexter_get_option_css_value( $body_lineheight['desktop'], '' ) : '' ) ),
                ),
			);
			
			if( !empty($mobile_style)){
				$theme_css['mobile'] = (!empty($theme_css['mobile']) && isset($theme_css['mobile'])) ? $theme_css['mobile'] : [];
				$theme_css['mobile']= array_merge_recursive($theme_css['mobile'],$mobile_style);
			}
			
			return $theme_css;
		}
		
		/*
		 * Gutenberg Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function gutenberg_dynamic_css( $theme_css ){
		
			$body_fontfamily = nexter_get_body_fontfamily();
            $body_fontweight = nexter_get_option('body-font-weight');
            $body_fontsize   = nexter_get_option('font-size-body');
            $body_lineheight = nexter_get_option('body-line-height');
            $body_transform  = nexter_get_option('body-transform');
            $paragraphy_mb   = nexter_get_option('paragraph-mb');
			
			$style =array();
			
			$style  = array(
                '.edit-post-visual-editor' => array(
                    'font-family' => nexter_get_font_family_css($body_fontfamily),
                    'font-weight' => esc_attr($body_fontweight),
                    'font-size' => nexter_responsive_size_css($body_fontsize, 'desktop'),
                    'line-height' => (!empty($body_lineheight['desktop'])) ? nexter_get_option_css_value( $body_lineheight['desktop'], '' ) : '',
                    'text-transform' => esc_attr($body_transform)
                ),
				'.edit-post-visual-editor p, .edit-post-visual-editor .entry-content p' => array(
                    'margin-bottom' => nexter_get_option_css_value($paragraphy_mb, 'em')
                ),
            );
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			//Tablet css
			$tablet_style = array(
				'.edit-post-visual-editor' => array(
                    'font-size' => nexter_responsive_size_css($body_fontsize, 'tablet'),
					'line-height' => (!empty($body_lineheight['tablet'])) ? nexter_get_option_css_value( $body_lineheight['tablet'], '' ) : ((!empty($body_lineheight['desktop'])) ? nexter_get_option_css_value( $body_lineheight['desktop'], '' ) : ''),
                ),
			);
			
			$theme_css['tablet'] = array();
			if( !empty($tablet_style)){
				$theme_css['tablet']= array_merge_recursive($theme_css['tablet'],$tablet_style);
			}
			
			//Mobile css
			$mobile_style = array(
				'.edit-post-visual-editor' => array(
                    'font-size' => nexter_responsive_size_css($body_fontsize, 'mobile'),
					'line-height' => (!empty($body_lineheight['mobile'])) ? nexter_get_option_css_value( $body_lineheight['mobile'], '' ) : ((!empty($body_lineheight['tablet'])) ? nexter_get_option_css_value( $body_lineheight['tablet'], '' ) : ((!empty($body_lineheight['desktop'])) ? nexter_get_option_css_value( $body_lineheight['desktop'], '' ) : '' ) ),
                ),
			);
			
			$theme_css['mobile'] = array();
			if( !empty($mobile_style)){
				$theme_css['mobile']= array_merge_recursive($theme_css['mobile'],$mobile_style);
			}
			
			return $theme_css;
		}
		
	}
}

new Nexter_Body_Typography;