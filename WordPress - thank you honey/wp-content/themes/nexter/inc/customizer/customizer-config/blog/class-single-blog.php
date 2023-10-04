<?php
/**
 * Single Blog Options for Nexter Theme.
 *
 * @package     Nexter
 * @since       Nexter 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Single_Blog' ) ) {

	class Nexter_Single_Blog extends Nexter_Customizer_Config {

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
		 * Register Single Blog Options Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(
				array(
					'name'      => NXT_OPTIONS . '[heading-single-blog]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-blog-single',
					'priority'  => 4,
					'title'     => __( 'Single Blog', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				
				/* Display Meta Info*/
				array(
					'name'      => NXT_OPTIONS . '[s-display-post-title]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-blog-single',
					'priority'  => 6,
					'default' 	=> 'on',
					'title'     => __( 'Display Post Title', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'      => NXT_OPTIONS . '[s-display-post-fea-image]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-blog-single',
					'priority'  => 6,
					'default' 	=> 'on',
					'title'     => __( 'Display Featured Image', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'      => NXT_OPTIONS . '[s-display-post-meta]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-blog-single',
					'priority'  => 6,
					'default' 	=> 'on',
					'title'     => __( 'Display Post Meta Info', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'      => NXT_OPTIONS . '[s-display-post-nav]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-blog-single',
					'priority'  => 6,
					'default' 	=> 'on',
					'title'     => __( 'Display Post Navigation', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'      => NXT_OPTIONS . '[s-display-author-info]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-blog-single',
					'priority'  => 6,
					'default' 	=> 'off',
					'title'     => __( 'Display Author Info', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'      => NXT_OPTIONS . '[s-display-post-tags]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-blog-single',
					'priority'  => 6,
					'default' 	=> 'on',
					'title'     => __( 'Display Post Tags', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'      => NXT_OPTIONS . '[s-display-comment-box]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-blog-single',
					'priority'  => 6,
					'default' 	=> 'on',
					'title'     => __( 'Display Comment Box', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[s-blog-primary-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-blog-single',
					'default'  => '#ff5a6e',
					'priority' => 6,
					'title'    => __( 'Primary Color', 'nexter' ),
				),
				/*Display Meta Info*/
				
				/** Start
				 * Title Typography
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-s-blog-title-typo]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-blog-single',
					'priority'  => 7,
					'title'     => __( 'Title Typography', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'        => NXT_OPTIONS . '[s-blog-title-font-family]',
					'type'        => 'control',
					'control'     => 'nxt-font-control',
					'section'     => 'section-blog-single',
					'font-type'   => 'nxt-font-family',
					'font_inherit' => __( 'Inherit', 'nexter' ),
					'default'     => '',
					'priority'    => 8,
					'title'       => __( 'Font Family', 'nexter' ),
					'connect'     => NXT_OPTIONS . '[s-blog-title-font-weight]',
					'variant'     => NXT_OPTIONS . '[s-blog-title-font-variant]',
				),
				array(
					'name'              => NXT_OPTIONS . '[s-blog-title-font-variant]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-blog-single',
					'font-type'         => 'nxt-font-variant',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_variant' ),
					'default'           => '',
					'font_inherit'       => __( 'Default', 'nexter' ),					
					'priority'          => 10,
					'title'             => __( 'Font Variant', 'nexter' ),
					'variant'           => NXT_OPTIONS . '[s-blog-title-font-family]',
				),
				array(
					'name'              => NXT_OPTIONS . '[s-blog-title-font-weight]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-blog-single',
					'font-type'         => 'nxt-font-weight',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => '',
					'font_inherit'       => __( 'Default', 'nexter' ),					
					'priority'          => 10,
					'title'             => __( 'Font Weight', 'nexter' ),
					'connect'           => NXT_OPTIONS . '[s-blog-title-font-family]',
				),
				array(
					'name'     => NXT_OPTIONS . '[s-blog-title-transform]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-blog-single',
					'transport'         => 'postMessage',
					'default'  => '',
					'priority' => 12,
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
					'name'        => NXT_OPTIONS . '[font-size-s-blog-title]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-blog-single',
					'default'     => '',
					'priority'    => 15,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 1,
					),
					'units'       => array(
						'px' => 'px',
					),
				),
				array(
					'name'              => NXT_OPTIONS . '[s-blog-title-line-height]',
					'type'              => 'control',
					'control'           => 'nxt-slider',
					'section'           => 'section-blog-single',
					'transport'         => 'postMessage',
					'default'           => '',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_number_val' ),
					'priority'          => 17,
					'title'             => __( 'Line Height', 'nexter' ),
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				array(
					'name'              => NXT_OPTIONS . '[s-blog-title-letter-spacing]',
					'default'           => '',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_number_val' ),
					'type'              => 'control',
					'control'           => 'nxt-slider',
					'section'           => 'section-blog-single',
					'title'             => __( 'Letter Spacing', 'nexter' ),
					'transport'         => 'postMessage',
					'priority'          => 17,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 0.01,
						'max'  => 3,
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[s-blog-title-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-blog-single',
					'default'  => '',
					'transport'         => 'postMessage',
					'priority' => 20,
					'title'    => __( 'Title Color', 'nexter' ),
				),
				/** End
				 * Title Typography
				 */
				 
				/** Start
				 * Post Meta Typography
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-s-post-meta-typo]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-blog-single',
					'priority'  => 22,
					'title'     => __( 'Post Meta Typography', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'        => NXT_OPTIONS . '[s-post-meta-font-family]',
					'type'        => 'control',
					'control'     => 'nxt-font-control',
					'section'     => 'section-blog-single',
					'font-type'   => 'nxt-font-family',
					'font_inherit' => __( 'Inherit', 'nexter' ),
					'default'     => '',
					'priority'    => 23,
					'title'       => __( 'Font Family', 'nexter' ),
					'connect'     => NXT_OPTIONS . '[s-post-meta-font-weight]',
					'variant'     => NXT_OPTIONS . '[s-post-meta-font-variant]',
				),
				array(
					'name'              => NXT_OPTIONS . '[s-post-meta-font-variant]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-blog-single',
					'font-type'         => 'nxt-font-variant',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_variant' ),
					'default'           => '',
					'font_inherit'       => __( 'Default', 'nexter' ),					
					'priority'          => 24,
					'title'             => __( 'Font Variant', 'nexter' ),
					'variant'           => NXT_OPTIONS . '[s-post-meta-font-family]',
				),
				array(
					'name'              => NXT_OPTIONS . '[s-post-meta-font-weight]',
					'type'              => 'control',
					'control'           => 'nxt-font-control',
					'section'           => 'section-blog-single',
					'font-type'         => 'nxt-font-weight',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_font_weight' ),
					'default'           => '',
					'font_inherit'       => __( 'Default', 'nexter' ),					
					'priority'          => 24,
					'title'             => __( 'Font Weight', 'nexter' ),
					'connect'           => NXT_OPTIONS . '[s-post-meta-font-family]',
				),
				array(
					'name'     => NXT_OPTIONS . '[s-post-meta-transform]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-blog-single',
					'transport'         => 'postMessage',
					'default'  => '',
					'priority' => 25,
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
					'name'        => NXT_OPTIONS . '[font-size-s-post-meta]',
					'type'        => 'control',
					'control'     => 'nxt-responsive',
					'section'     => 'section-blog-single',
					'default'     => '',
					'priority'    => 26,
					'title'       => __( 'Font Size', 'nexter' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
					),
				),
				array(
					'name'              => NXT_OPTIONS . '[s-post-meta-line-height]',
					'type'              => 'control',
					'control'           => 'nxt-slider',
					'section'           => 'section-blog-single',
					'transport'         => 'postMessage',
					'default'           => '',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_number_val' ),
					'priority'          => 27,
					'title'             => __( 'Line Height', 'nexter' ),
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),
				array(
					'name'              => NXT_OPTIONS . '[s-post-meta-letter-spacing]',
					'default'           => '',
					'sanitize_callback' => array( 'Nexter_Customizer_Sanitizes_Callbacks', 'sanitize_number_val' ),
					'type'              => 'control',
					'control'           => 'nxt-slider',
					'section'           => 'section-blog-single',
					'title'             => __( 'Letter Spacing', 'nexter' ),
					'transport'         => 'postMessage',
					'priority'          => 27,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 0,
						'step' => 0.01,
						'max'  => 3,
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[s-post-meta-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-blog-single',
					'default'  => '',
					'transport'         => 'postMessage',
					'priority' => 28,
					'title'    => __( 'Post Meta Color', 'nexter' ),
				),
				/** End
				 * Post Meta Typography
				 */
			);

			return array_merge( $configurations, $options );
		}
		
		/*
		 * Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function dynamic_css( $theme_css ){
			
			
			$style =array();
			
			$single_title_fontsize   = nexter_get_option('font-size-s-blog-title');
			$single_title_lineheight = nexter_get_option('s-blog-title-line-height');
			$single_title_fontfamily = nexter_get_option('s-blog-title-font-family');
			$single_title_fontweight = nexter_get_option('s-blog-title-font-weight');
			$single_title_transform  = nexter_get_option('s-blog-title-transform');
			$single_title_letter_space = nexter_get_option('s-blog-title-letter-spacing');
			$single_title_color      = nexter_get_option('s-blog-title-color');
			
			$post_meta_fontsize   = nexter_get_option('font-size-s-post-meta');
			$post_meta_lineheight = nexter_get_option('s-post-meta-line-height');
			$post_meta_fontfamily = nexter_get_option('s-post-meta-font-family');
			$post_meta_fontweight = nexter_get_option('s-post-meta-font-weight');
			$post_meta_transform  = nexter_get_option('s-post-meta-transform');
			$post_meta_letter_space = nexter_get_option('s-post-meta-letter-spacing');
			$post_meta_color      = nexter_get_option('s-post-meta-color');
				
			$post_primary_color      = nexter_get_option('s-blog-primary-color');
		
			$style = array(
				'.single-post-title h1' => array(
					'font-family' => nexter_get_font_family_css($single_title_fontfamily),
					'font-weight' => esc_attr($single_title_fontweight),
					'font-size' => nexter_responsive_size_css($single_title_fontsize, 'desktop'),
					'line-height' => esc_attr($single_title_lineheight),
					'text-transform' => esc_attr($single_title_transform),
					'letter-spacing' => (!empty($single_title_letter_space) ? esc_attr($single_title_letter_space) . 'px' : ''),
					'color' => esc_attr($single_title_color)
				),
				'.nxt-meta-info' => array(
					'font-family' => nexter_get_font_family_css($post_meta_fontfamily),
					'font-weight' => esc_attr($post_meta_fontweight),
					'font-size' => nexter_responsive_size_css($post_meta_fontsize, 'desktop'),
					'line-height' => esc_attr($post_meta_lineheight),
					'letter-spacing' => (!empty($post_meta_letter_space) ? esc_attr($post_meta_letter_space) . 'px' : ''),
					'text-transform' => esc_attr($post_meta_transform)						
				),
				'.nxt-meta-info,.nxt-meta-info a' => array(
					'color' => esc_attr($post_meta_color)
				),
				'.nxt-meta-info a:focus, .nxt-meta-info a:hover, .nxt-post-next-prev .prev:hover span:last-child, .nxt-post-next-prev .next:hover span:last-child, .author-meta-title:hover' => array(
					'color' => esc_attr($post_primary_color)
				),
				'.nxt-post-tags ul li a:hover' => array(
					'background' => esc_attr($post_primary_color),
					'border-color' => esc_attr($post_primary_color),
				),
				'input:focus, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="reset"]:focus, input[type="search"]:focus, textarea:focus' => array(
					'border-color' => esc_attr($post_primary_color),
				),
				'.nxt-btn, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' => array(
					'background' => esc_attr($post_primary_color),
					'border-color' => esc_attr($post_primary_color),
				),
			);
			//Tablet Css
			$tablet_style =array(
				'.single-post-title h1' => array(
					'font-size' => nexter_responsive_size_css($single_title_fontsize, 'tablet'),
				),
				'.nxt-meta-info' => array(
					'font-size' => nexter_responsive_size_css($post_meta_fontsize, 'tablet' )
				),
			);
			
			if(!empty($tablet_style)){
				$theme_css['tablet'] = array_merge_recursive($theme_css['tablet'],$tablet_style);
			}
			
			//Mobile Css
			$mobile_style =array(
				'.single-post-title h1' => array(
					'font-size' => nexter_responsive_size_css($single_title_fontsize, 'mobile'),
				),
				'.nxt-meta-info' => array(
					'font-size' => nexter_responsive_size_css($post_meta_fontsize, 'mobile')
				),
			);
			
			if(!empty($mobile_style)){
				$theme_css['mobile'] = array_merge_recursive($theme_css['mobile'],$mobile_style);
			}
			
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			return $theme_css;
		}
		
	}
}

new Nexter_Single_Blog;