<?php
/**
 * Body Style Options for Nexter Theme.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Body_Style' ) ) {

	class Nexter_Body_Style extends Nexter_Customizer_Config {
		
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
		 * Register Body Style Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(

				/** Start
				 * Options Body Background Color
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-body-bgcolor]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-body-style',
					'priority'  => 5,
					'title'     => __( 'Body Background', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'     => NXT_OPTIONS . '[body-bgcolor]',
					'type'     => 'control',
					'control'  => 'nxt-background',
					'default'  => array('background-color'=>'#fff'),
					'section'  => 'section-body-style',
					'priority' => 10,
					'title'    => __( 'Background', 'nexter' ),
				),
				/** End
				 * Options Body Background Color
				 */
				 
				 /** Start
				 * Options Content Background Color
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-content-bgcolor]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-body-style',
					'priority'  => 12,
					'title'     => __( 'Content Background', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'     => NXT_OPTIONS . '[content-bgcolor]',
					'type'     => 'control',
					'control'  => 'nxt-background',
					'default'  => array('background-color'=>'#fff'),
					'section'  => 'section-body-style',
					'priority' => 14,
					'title'    => __( 'Content Background', 'nexter' ),
				),
				/** End
				 * Options Content Background Color
				 */
				 
				array(
					'name'      => NXT_OPTIONS . '[heading-body-frame]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-body-style',
					'priority'  => 15,
					'title'     => __( 'Body Frame', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),				
				array(
					'name'           => NXT_OPTIONS . '[body-frame-padding]',
					'default'        => nexter_get_option( 'body-frame-padding' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-body-style',
					'transport'      => 'postMessage',
					'priority'       => 20,
					'title'          => __( 'Body Frame (Space)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
						'bottom' => __( 'Bottom', 'nexter' ),
						'left'   => __( 'Left', 'nexter' ),
					),
				),
				array(
					'name'      => NXT_OPTIONS . '[fixed-body-frame]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-body-style',
					'priority'  => 25,
					'default' 	=> 'off',
					'title'     => __( 'Fixed Body Frame', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[body-frame-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-body-style',
					'default'  => '#888',
					'priority' => 30,
					'title'    => __( 'Frame Color', 'nexter' ),
					'conditional' => array( NXT_OPTIONS . '[fixed-body-frame]', '==', 'on' ),
				),
			);

			return array_merge( $configurations, $options );
		}
		
		/*
		 * Dynamic Theme Options Css 
		 * @since 1.0.0
		 */
		public static function dynamic_css( $theme_css ){
			
			$body_bgcolor           = nexter_get_option('body-bgcolor');
            $content_bgcolor           = nexter_get_option('content-bgcolor');
			
			$body_frame_padding     = nexter_get_option('body-frame-padding');
            $fixed_body_frame       = nexter_get_option('fixed-body-frame');
            $fixed_body_frame_color = nexter_get_option('body-frame-color');
			
			$option_frame = ['top' => 'height', 'bottom' => 'height', 'left' => 'width', 'right' => 'width'];
			$style = [];
			foreach($option_frame as $key => $val){
				$style['body']['padding-'.$key] = nexter_dimension_responsive_css($body_frame_padding, $key, 'md');
			}
			
			$body_content_bg_css  = array(
                'body' => nexter_get_background_css($body_bgcolor),
                '#content.site-content' => nexter_get_background_css($content_bgcolor)
            );
			
			$fixed_body_frame_css = [];
            if ($fixed_body_frame == 'on') {
                $fixed_body_frame_css = array(
                    '.nxt-body-frame' => array(
                        'background-color' => esc_attr($fixed_body_frame_color)
                    ),
                );
				foreach( $option_frame as $key => $val ){
					$fixed_body_frame_css['.nxt-body-frame.frame-'.$key] = [
						$val => nexter_dimension_responsive_css($body_frame_padding, $key, 'md')
					];
				}
            }
			
			$style = array_merge_recursive($style,$body_content_bg_css, $fixed_body_frame_css);
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			//Tablet Css
			$tablet_css = [];
			$tablet_fixed_css = [];
			
			foreach($option_frame as $key => $val){
				$tablet_css['body']['padding-'.$key] = nexter_dimension_responsive_css($body_frame_padding, $key, 'sm');
				if ($fixed_body_frame == 'on') {
					$tablet_fixed_css['.nxt-body-frame.frame-'.$key] = [
						$val => nexter_dimension_responsive_css($body_frame_padding, $key, 'sm')
					];
				}
			}
			
			if($tablet_css){
				$theme_css['tablet'] = array_merge_recursive($theme_css['tablet'],$tablet_css,$tablet_fixed_css);
			}
			
			//Mobile Css
			$mobile_css = [];
			$mobile_fixed_css = [];
			
			foreach($option_frame as $key => $val){
				$mobile_css['body']['padding-'.$key] = nexter_dimension_responsive_css($body_frame_padding, $key, 'xs');
				if ($fixed_body_frame == 'on') {
					$mobile_fixed_css['.nxt-body-frame.frame-'.$key] = [
						$val => nexter_dimension_responsive_css($body_frame_padding, $key, 'xs')
					];
				}
			}
			
			if($mobile_css){
				$theme_css['mobile'] = array_merge_recursive($theme_css['mobile'],$mobile_css,$mobile_fixed_css);
			}
			
			return $theme_css;
		}
	}
}

new Nexter_Body_Style;


