<?php
/**
 * Container Layout Options for Nexter Theme.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Layout_Container' ) ) {

	class Nexter_Layout_Container extends Nexter_Customizer_Config {
		
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
		 * Register Container Layout Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(

				/** Start
				 * Options Layout/Container
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-site-container]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-site-layout-container',
					'priority'  => 4,
					'title'     => __( 'Container', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				/*Header Container*/
				array(
					'name'     => NXT_OPTIONS . '[site-header-container]',
					'default'  => 'container-block-editor',
					'title'    => __( 'Header', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-site-layout-container',					
					'priority' => 5,
					'choices'  => array(
						'container-block-editor'	=> __( 'Block Editor', 'nexter' ),
						'container'	=> __( 'Container', 'nexter' ),
						'container-fluid'	=> __( 'Full Width', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[site-header-block-width]',
					'default'     => nexter_get_option( 'site-header-block-width' ),
					'title'       => __( 'Block(Normal) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-header-container]', '==', 'container-block-editor' ),
				),
				array(
					'name'        => NXT_OPTIONS . '[site-header-container-width]',
					'default'     => nexter_get_option( 'site-header-container-width' ),
					'title'       => __( 'Container(Wide) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-header-container]', '==', array('container-block-editor','container') ),
				),
				array(
					'name'           => NXT_OPTIONS . '[header-fluid-spacing]',
					'default'        => nexter_get_option( 'header-fluid-spacing' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-site-layout-container',
					'transport'      => 'postMessage',
					'priority'       => 5,
					'title'          => __( 'Spacing(Padding)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em' ),
					'choices'        => array(
						'left'   => __( 'Left', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[site-header-container]', '==', 'container-fluid' ),
				),
				/*Header Container*/
				/*footer Container*/
				array(
					'name'     => NXT_OPTIONS . '[heading-footer-divider]',
					'type'     => 'control',					
					'control'  => 'nxt-heading',
					'section'  => 'section-site-layout-container',
					'priority' => 5,
					'settings' => array(),					
				),
				array(
					'name'     => NXT_OPTIONS . '[site-footer-container]',
					'default'  => 'container-block-editor',
					'title'    => __( 'Footer', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-site-layout-container',					
					'priority' => 5,
					'choices'  => array(
						'container-block-editor'	=> __( 'Block Editor', 'nexter' ),
						'container'	=> __( 'Container', 'nexter' ),
						'container-fluid'	=> __( 'Full Width', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[site-footer-block-width]',
					'default'     => nexter_get_option( 'site-footer-block-width' ),
					'title'       => __( 'Block(Normal) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-footer-container]', '==', 'container-block-editor' ),
				),
				array(
					'name'        => NXT_OPTIONS . '[site-footer-container-width]',
					'default'     => nexter_get_option( 'site-footer-container-width' ),
					'title'       => __( 'Container(Wide) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-footer-container]', '==', array('container-block-editor','container') ),
				),
				array(
					'name'           => NXT_OPTIONS . '[footer-fluid-spacing]',
					'default'        => nexter_get_option( 'footer-fluid-spacing' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-site-layout-container',
					'transport'      => 'postMessage',
					'priority'       => 5,
					'title'          => __( 'Spacing(Padding)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em' ),
					'choices'        => array(
						'left'   => __( 'Left', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[site-footer-container]', '==', 'container-fluid' ),
				),
				/*Footer Container*/
				/*Content/Body Container*/
				array(
					'name'     => NXT_OPTIONS . '[heading-site-layout-divider]',
					'type'     => 'control',					
					'control'  => 'nxt-heading',
					'section'  => 'section-site-layout-container',
					'priority' => 5,
					'settings' => array(),					
				),
				array(
					'name'     => NXT_OPTIONS . '[site-layout-container]',
					'default'  => 'container-block-editor',
					'title'    => __( 'Content/Body', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-site-layout-container',					
					'priority' => 5,
					'choices'  => array(
						'container-block-editor'	=> __( 'Block Editor', 'nexter' ),
						'container'	=> __( 'Container', 'nexter' ),
						'container-fluid'	=> __( 'Full Width', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[layout-block-width]',
					'default'     => nexter_get_option( 'layout-block-width' ),
					'title'       => __( 'Block(Normal) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-layout-container]', '==', 'container-block-editor' ),
				),
				array(
					'name'        => NXT_OPTIONS . '[layout-container]',
					'default'     => nexter_get_option( 'layout-container' ),
					'title'       => __( 'Container Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-layout-container]', '==', array('container-block-editor','container') ),
				),
				array(
					'name'           => NXT_OPTIONS . '[site-fluid-spacing]',
					'default'        => nexter_get_option( 'site-fluid-spacing' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-site-layout-container',
					'transport'      => 'postMessage',
					'priority'       => 5,
					'title'          => __( 'Spacing(Padding)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em' ),
					'choices'        => array(
						'left'   => __( 'Left', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[site-layout-container]', '==', 'container-fluid' ),
				),
				/*Content/Body Container*/
				/*Page Container*/
				array(
					'name'     => NXT_OPTIONS . '[heading-page-divider]',
					'type'     => 'control',					
					'control'  => 'nxt-heading',
					'section'  => 'section-site-layout-container',
					'priority' => 6,
					'settings' => array(),					
				),
				array(
					'name'     => NXT_OPTIONS . '[site-page-container]',
					'default'  => '',
					'title'    => __( 'Page Container', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-site-layout-container',					
					'priority' => 7,
					'choices'  => array(
						''           => __( 'Default', 'nexter' ),
						'container-block-editor' => __( 'Block Editor', 'nexter' ),
						'container'			=> __( 'Container', 'nexter' ),
						'container-fluid'	=> __( 'Full Width', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[site-page-block-width]',
					'default'     => nexter_get_option( 'site-page-block-width' ),
					'title'       => __( 'Block(Normal) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 7,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-page-container]', '==', 'container-block-editor' ),
				),
				array(
					'name'              => NXT_OPTIONS . '[layout-page-container]',
					'default'           => nexter_get_option( 'layout-page-container' ),
					'type'              => 'control',
					'control'           => 'nxt-responsive-slider',
					'section'           => 'section-site-layout-container',
					'title'             => __( 'Container Width', 'nexter' ),
					'transport'         => 'postMessage',
					'priority'          => 8,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-page-container]', '==', array('container-block-editor', 'container') ),
				),
				array(
					'name'           => NXT_OPTIONS . '[page-fluid-spacing]',
					'default'        => nexter_get_option( 'page-fluid-spacing' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-site-layout-container',
					'transport'      => 'postMessage',
					'priority'       => 8,
					'title'          => __( 'Spacing(Padding)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em' ),
					'choices'        => array(
						'left'   => __( 'Left', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[site-page-container]', '==', 'container-fluid' ),
				),
				/*Page Container*/
				/*Post Container*/
				array(
					'name'     => NXT_OPTIONS . '[heading-post-divider]',
					'type'     => 'control',					
					'control'  => 'nxt-heading',
					'section'  => 'section-site-layout-container',
					'priority' => 9,
					'settings' => array(),					
				),
				array(
					'name'     => NXT_OPTIONS . '[site-posts-container]',
					'default'  => '',
					'title'    => __( 'Single Post Container', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-site-layout-container',
					'priority' => 10,
					'choices'  => array(
						''           => __( 'Default', 'nexter' ),
						'container-block-editor' => __( 'Block Editor', 'nexter' ),
						'container'			=> __( 'Container', 'nexter' ),
						'container-fluid'	=> __( 'Full Width', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[site-posts-block-width]',
					'default'     => nexter_get_option( 'site-posts-block-width' ),
					'title'       => __( 'Block(Normal) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 10,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-posts-container]', '==', 'container-block-editor' ),
				),
				array(
					'name'              => NXT_OPTIONS . '[layout-posts-container]',
					'default'           => nexter_get_option( 'layout-posts-container' ),
					'type'              => 'control',
					'control'           => 'nxt-responsive-slider',
					'section'           => 'section-site-layout-container',
					'title'             => __( 'Container Width', 'nexter' ),
					'transport'         => 'postMessage',
					'priority'          => 11,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-posts-container]', '==', array('container-block-editor', 'container') ),
				),
				array(
					'name'           => NXT_OPTIONS . '[post-fluid-spacing]',
					'default'        => nexter_get_option( 'post-fluid-spacing' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-site-layout-container',
					'transport'      => 'postMessage',
					'priority'       => 11,
					'title'          => __( 'Spacing(Padding)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em' ),
					'choices'        => array(
						'left'   => __( 'Left', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[site-posts-container]', '==', 'container-fluid' ),
				),
				/*Post Container*/
				/*Archive Container*/
				array(
					'name'     => NXT_OPTIONS . '[heading-archive-divider]',
					'type'     => 'control',					
					'control'  => 'nxt-heading',
					'section'  => 'section-site-layout-container',
					'priority' => 12,
					'settings' => array(),					
				),
				array(
					'name'     => NXT_OPTIONS . '[site-archive-container]',
					'default'  => '',
					'title'    => __( 'Archive Posts Container', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-site-layout-container',
					'priority' => 13,
					'choices'  => array(
						''           => __( 'Default', 'nexter' ),
						'container-block-editor' => __( 'Block Editor', 'nexter' ),
						'container'			=> __( 'Container', 'nexter' ),
						'container-fluid'	=> __( 'Full Width', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[site-archive-block-width]',
					'default'     => nexter_get_option( 'site-archive-block-width' ),
					'title'       => __( 'Block(Normal) Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-site-layout-container',
					'priority'    => 13,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-archive-container]', '==', 'container-block-editor' ),
				),
				array(
					'name'              => NXT_OPTIONS . '[layout-archive-container]',
					'default'           => nexter_get_option( 'layout-archive-container' ),
					'type'              => 'control',
					'control'           => 'nxt-responsive-slider',
					'section'           => 'section-site-layout-container',
					'title'             => __( 'Container Width', 'nexter' ),
					'transport'         => 'postMessage',
					'priority'          => 14,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[site-archive-container]', '==', array('container-block-editor', 'container') ),
				),
				array(
					'name'           => NXT_OPTIONS . '[archive-fluid-spacing]',
					'default'        => nexter_get_option( 'archive-fluid-spacing' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-site-layout-container',
					'transport'      => 'postMessage',
					'priority'       => 14,
					'title'          => __( 'Spacing(Padding)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em' ),
					'choices'        => array(
						'left'   => __( 'Left', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[site-archive-container]', '==', 'container-fluid' ),
				),
				/** End
				 * Options Layout/Container
				 */
			);

			return array_merge( $configurations, $options );
		}
		
		/*
		 * Dimension value get
		 * @since 1.0.15
		 */
		public static function dimension_value($option='', $selector = '', $attr = '', $theme_css = [], $minus= ''){
			$option_dimension = ['left' => '', 'right' => ''];
			if(empty($option) || empty($selector) || empty($attr)){
				return $theme_css;
			}
			$fluid_pad = nexter_get_option($option);
			
			if(!empty($fluid_pad)){
				$style = ['dk' => [], 'tb' => [], 'mb' => []];
				foreach($option_dimension as $key => $val){
					$md_val = nexter_dimension_responsive_css($fluid_pad, $key, 'md');
					if($md_val!=''){
						$md_val = ($minus=='minus') ? '-'.$md_val : $md_val;
						$style['dk'][$selector][$attr.'-'.$key] = $md_val;
					}
					$sm_val = nexter_dimension_responsive_css($fluid_pad, $key, 'sm');
					if($sm_val!=''){
						$sm_val = ($minus=='minus') ? '-'.$sm_val : $sm_val;
						$style['tb'][$selector][$attr.'-'.$key] = $sm_val;
					}
					$xs_val = nexter_dimension_responsive_css($fluid_pad, $key, 'xs');
					if($xs_val!=''){
						$xs_val = ($minus=='minus') ? '-'.$xs_val : $xs_val;
						$style['mb'][$selector][$attr.'-'.$key] = $xs_val;
					}
				}
				if(!empty($style)){
					if( !empty($style['dk']) ){
						$theme_css[] = $style['dk'];
					}
					if( !empty($style['tb']) ){
						$theme_css['tablet'] = $style['tb'];
					}
					if( !empty($style['mb']) ){
						$theme_css['mobile'] = $style['mb'];
					}
				}
			}
			return $theme_css;
		}

		/*
		 * Dynamic Theme Options Css 
		 * @since 1.0.10
		 */
		public static function dynamic_css( $theme_css ){
			
			$header_container = nexter_get_option('site-header-container','container-block-editor');
            $header_block_width      = nexter_get_option('site-header-block-width');
            $header_container_width  = nexter_get_option('site-header-container-width');
			
			//Header Container
			$header_container_css = ['dk'=> [],'tb'=>[],'mb'=>[]];
            if (!empty($header_container) && $header_container == 'container-block-editor') {
                $header_container_css['dk'] = array(
                    '#nxt-header.site-header .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-header.site-header .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce), .nxt-breadcrumb-wrap .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull)' => array(
                        'max-width' => (!empty($header_block_width)) ? nexter_get_option_css_value( $header_block_width['desktop'], 'px' ) : '',
                    ),
					'#nxt-header.site-header .nxt-container-block-editor .alignwide, #nxt-header .tpgb-container' => array(
                        'max-width' => (!empty($header_container_width)) ? nexter_get_option_css_value( $header_container_width['desktop'], 'px' ) : '',
                    ),
                );
				$header_container_css['tb'] = array(
                    '#nxt-header.site-header .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-header.site-header .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce), .nxt-breadcrumb-wrap .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull)' => array(
                        'max-width' => (!empty($header_block_width)) ? nexter_get_option_css_value( $header_block_width['tablet'], 'px' ) : '',
                    ),
					'#nxt-header.site-header .nxt-container-block-editor .alignwide, #nxt-header .tpgb-container' => array(
                        'max-width' => (!empty($header_container_width)) ? nexter_get_option_css_value( $header_container_width['tablet'], 'px' ) : '',
                    ),
                );
				$header_container_css['mb'] = array(
                    '#nxt-header.site-header .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-header.site-header .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce), .nxt-breadcrumb-wrap .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull)' => array(
                        'max-width' => (!empty($header_block_width)) ? nexter_get_option_css_value( $header_block_width['mobile'], 'px' ) : '',
                    ),
					'#nxt-header.site-header .nxt-container-block-editor .alignwide, #nxt-header .tpgb-container' => array(
                        'max-width' => (!empty($header_container_width)) ? nexter_get_option_css_value( $header_container_width['mobile'], 'px' ) : '',
                    ),
                );
            }
			if (!empty($header_container) && $header_container == 'container' && !empty($header_container_width['desktop'])) {
                $header_container_css['dk'] = array(
					'#nxt-header .nxt-container, #nxt-header .tpgb-container' => array(
                        'max-width' => (!empty($header_container_width)) ? nexter_get_option_css_value( $header_container_width['desktop'], 'px' ) : '',
                    ),
                );
				$header_container_css['tb'] = array(
					'#nxt-header .nxt-container, #nxt-header .tpgb-container' => array(
                        'max-width' => (!empty($header_container_width)) ? nexter_get_option_css_value( $header_container_width['tablet'], 'px' ) : '',
                    ),
                );
				$header_container_css['mb'] = array(
					'#nxt-header .nxt-container, #nxt-header .tpgb-container' => array(
                        'max-width' => (!empty($header_container_width)) ? nexter_get_option_css_value( $header_container_width['mobile'], 'px' ) : '',
                    ),
                );
            }

			if(!empty($header_container) && $header_container == 'container-fluid'){
				$theme_css = self::dimension_value('header-fluid-spacing', '#nxt-header .nxt-container-fluid', 'padding', $theme_css );
				
			}

			$footer_container = nexter_get_option('site-footer-container','container-block-editor');
            $footer_block_width      = nexter_get_option('site-footer-block-width');
            $footer_container_width  = nexter_get_option('site-footer-container-width');
			
			//Footer Container
			$footer_container_css = ['dk'=> [],'tb'=>[],'mb'=>[]];
            if (!empty($footer_container) && $footer_container == 'container-block-editor') {
                $footer_container_css['dk'] = array(
                    '#nxt-footer.site-footer .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-footer.site-footer .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)' => array(
                        'max-width' => (!empty($footer_block_width)) ? nexter_get_option_css_value( $footer_block_width['desktop'], 'px' ) : '',
                    ),
					'#nxt-footer .nxt-container-block-editor .alignwide, #nxt-footer .tpgb-container' => array(
                        'max-width' => (!empty($footer_container_width)) ? nexter_get_option_css_value( $footer_container_width['desktop'], 'px' ) : '',
                    ),
                );
				$footer_container_css['tb'] = array(
                    '#nxt-footer.site-footer .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-footer.site-footer .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)' => array(
                        'max-width' => (!empty($footer_block_width)) ? nexter_get_option_css_value( $footer_block_width['tablet'], 'px' ) : '',
                    ),
					'#nxt-footer .nxt-container-block-editor .alignwide, #nxt-footer .tpgb-container' => array(
                        'max-width' => (!empty($footer_container_width)) ? nexter_get_option_css_value( $footer_container_width['tablet'], 'px' ) : '',
                    ),
                );
				$footer_container_css['mb'] = array(
                    '#nxt-footer.site-footer .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-footer.site-footer .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)' => array(
                        'max-width' => (!empty($footer_block_width)) ? nexter_get_option_css_value( $footer_block_width['mobile'], 'px' ) : '',
                    ),
					'#nxt-footer .nxt-container-block-editor .alignwide, #nxt-footer .tpgb-container' => array(
                        'max-width' => (!empty($footer_container_width)) ? nexter_get_option_css_value( $footer_container_width['mobile'], 'px' ) : '',
                    ),
                );
            }
			if (!empty($footer_container) && $footer_container == 'container' && !empty($footer_container_width['desktop'])) {
                $footer_container_css['dk'] = array(
					'#nxt-footer .nxt-container, #nxt-footer .tpgb-container' => array(
                        'max-width' => (!empty($footer_container_width)) ? nexter_get_option_css_value( $footer_container_width['desktop'], 'px' ) : '',
                    ),
                );
				$footer_container_css['tb'] = array(
					'#nxt-footer .nxt-container, #nxt-footer .tpgb-container' => array(
                        'max-width' => (!empty($footer_container_width)) ? nexter_get_option_css_value( $footer_container_width['tablet'], 'px' ) : '',
                    ),
                );
				$footer_container_css['mb'] = array(
					'#nxt-footer .nxt-container, #nxt-footer .tpgb-container' => array(
                        'max-width' => (!empty($footer_container_width)) ? nexter_get_option_css_value( $footer_container_width['mobile'], 'px' ) : '',
                    ),
                );
            }
			
			if(!empty($footer_container) && $footer_container == 'container-fluid'){
				$theme_css = self::dimension_value('footer-fluid-spacing', '#nxt-footer .nxt-container-fluid', 'padding', $theme_css );
			}

			
			$site_layout_container = nexter_get_option('site-layout-container','container-block-editor');
			$layout_block_width      = nexter_get_option('layout-block-width');
            $layout_container      = nexter_get_option('layout-container');
			
			//Site Layout Default Container
			$site_layout_container_css = ['dk'=> [],'tb'=>[],'mb'=>[]];
			if (!empty($site_layout_container) && $site_layout_container == 'container-block-editor') {
                $site_layout_container_css['dk'] = array(
                    '.site-content .nxt-container-block-editor > .nxt-row article > .entry-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce),.nxt-container-block-editor .site-main > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-blog-single-post),.nxt-container-block-editor .site-main .nxt-blog-single-post > article > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-single-post-content), .nxt-container-block-editor .site-main .nxt-single-post-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-container-block-editor > *:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull):not(.nxt-content-page-template), .nxt-container-block-editor > .nxt-content-page-template > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.content-area)' => array(
                        'max-width' => (!empty($layout_block_width)) ? nexter_get_option_css_value( $layout_block_width['desktop'], 'px' ) : '',
                    ),
					'.site-content .nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_container)) ? nexter_get_option_css_value( $layout_container['desktop'], 'px' ) : '',
                    ),
                );
				$site_layout_container_css['tb'] = array(
                    '.site-content .nxt-container-block-editor > .nxt-row article > .entry-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce),.nxt-container-block-editor .site-main > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-blog-single-post),.nxt-container-block-editor .site-main .nxt-blog-single-post > article > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-single-post-content), .nxt-container-block-editor .site-main .nxt-single-post-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-container-block-editor > *:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull):not(.nxt-content-page-template), .nxt-container-block-editor > .nxt-content-page-template > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.content-area)' => array(
                        'max-width' => (!empty($layout_block_width)) ? nexter_get_option_css_value( $layout_block_width['tablet'], 'px' ) : '',
                    ),
					'.site-content .nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_container)) ? nexter_get_option_css_value( $layout_container['tablet'], 'px' ) : '',
                    ),
                );
				$site_layout_container_css['mb'] = array(
                    '.site-content .nxt-container-block-editor > .nxt-row article > .entry-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce), .nxt-container-block-editor .site-main > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-blog-single-post),.nxt-container-block-editor .site-main .nxt-blog-single-post > article > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-single-post-content), .nxt-container-block-editor .site-main .nxt-single-post-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-container-block-editor > *:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull):not(.nxt-content-page-template), .nxt-container-block-editor > .nxt-content-page-template > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.content-area)' => array(
                        'max-width' => (!empty($layout_block_width)) ? nexter_get_option_css_value( $layout_block_width['mobile'], 'px' ) : '',
                    ),
					'.site-content .nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_container)) ? nexter_get_option_css_value( $layout_container['mobile'], 'px' ) : '',
                    ),
                );
            }
			if (!empty($site_layout_container) && $site_layout_container == 'container' && !empty($layout_container['desktop'])) {
                $site_layout_container_css['dk'] = array(
                    '.site-content .nxt-container' => array(
                        'max-width' => nexter_get_option_css_value( $layout_container['desktop'], 'px' )
                    )
                );
				$site_layout_container_css['tb'] = array(
                    '.site-content .nxt-container' => array(
                        'max-width' => nexter_get_option_css_value( $layout_container['tablet'], 'px' )
                    )
                );
				$site_layout_container_css['mb'] = array(
                    '.site-content .nxt-container' => array(
                        'max-width' => nexter_get_option_css_value( $layout_container['mobile'], 'px' )
                    )
                );
            }
			
			if(!empty($site_layout_container) && $site_layout_container == 'container-fluid'){
				$theme_css = self::dimension_value('site-fluid-spacing', '.site-content .nxt-container-fluid:not(.nxt-archive-cont),.site-content .nxt-container-fluid:not(.nxt-archive-cont) .nxt-row .nxt-col', 'padding', $theme_css );
				$theme_css = self::dimension_value('site-fluid-spacing', '.site-content .nxt-container-fluid:not(.nxt-archive-cont) .nxt-row,.archive-page-header', 'margin', $theme_css, 'minus' );
			}

			$site_page_container = nexter_get_option('site-page-container');
			$page_block_width = nexter_get_option('site-page-block-width');
			$layout_page_container = nexter_get_option('layout-page-container');
			
			//Page Container
			$page_layout_container_css = ['dk'=> [],'tb'=>[],'mb'=>[]];
			if (is_page() && !empty($site_page_container) && $site_page_container == 'container-block-editor') {
                $page_layout_container_css['dk'] = array(
                    '.site-content .nxt-page-cont.nxt-container-block-editor >.nxt-row article >.entry-content >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)' => array(
                        'max-width' => (!empty($page_block_width)) ? nexter_get_option_css_value( $page_block_width['desktop'], 'px' ) : '',
                    ),
					'.site-content .nxt-page-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_page_container)) ? nexter_get_option_css_value( $layout_page_container['desktop'], 'px' ) : '',
                    ),
                );
				$page_layout_container_css['tb'] = array(
                    '.site-content .nxt-page-cont.nxt-container-block-editor >.nxt-row article >.entry-content >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)' => array(
                        'max-width' => (!empty($page_block_width)) ? nexter_get_option_css_value( $page_block_width['tablet'], 'px' ) : '',
                    ),
					'.site-content .nxt-page-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_page_container)) ? nexter_get_option_css_value( $layout_page_container['tablet'], 'px' ) : '',
                    ),
                );
				$page_layout_container_css['mb'] = array(
                    '.site-content .nxt-page-cont.nxt-container-block-editor >.nxt-row article >.entry-content >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)' => array(
                        'max-width' => (!empty($page_block_width)) ? nexter_get_option_css_value( $page_block_width['mobile'], 'px' ) : '',
                    ),
					'.site-content .nxt-page-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_page_container)) ? nexter_get_option_css_value( $layout_page_container['mobile'], 'px' ) : '',
                    ),
                );
            }
			if (is_page() && !empty($site_page_container) && $site_page_container == 'container' ) {
                $page_layout_container_css['dk'] = array(
                    '.nxt-page-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_page_container)) ? nexter_get_option_css_value( $layout_page_container['desktop'], 'px' ) : '',
                    )
                );
				$page_layout_container_css['tb'] = array(
                    '.nxt-page-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_page_container)) ? nexter_get_option_css_value( $layout_page_container['tablet'], 'px' ) : '',
                    )
                );
				$page_layout_container_css['mb'] = array(
                    '.nxt-page-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_page_container)) ? nexter_get_option_css_value( $layout_page_container['mobile'], 'px' ) : '',
                    )
                );
            }

			if(is_page() && !empty($site_page_container) && $site_page_container == 'container-fluid'){
				$theme_css = self::dimension_value('page-fluid-spacing', '.site-content .nxt-container-fluid,.site-content .nxt-container-fluid .nxt-row .nxt-col', 'padding', $theme_css );
				$theme_css = self::dimension_value('page-fluid-spacing', '.site-content .nxt-container-fluid .nxt-row', 'margin', $theme_css, 'minus' );
			}
			
			$site_posts_container = nexter_get_option('site-posts-container');
			$posts_block_width = nexter_get_option('site-posts-block-width');
			$layout_posts_container = nexter_get_option('layout-posts-container');
			
			//Post Container
			$post_layout_container_css = ['dk'=> [],'tb'=>[],'mb'=>[]];
			if (is_single() && !empty($site_posts_container) && $site_posts_container == 'container-block-editor') {
                $post_layout_container_css['dk'] = array(
                    '.site-content > .nxt-post-cont.nxt-container-block-editor .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-blog-single-post),.nxt-container-block-editor .site-main .nxt-blog-single-post > article > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-single-post-content), .nxt-container-block-editor .site-main .nxt-single-post-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-post-cont.nxt-container-block-editor >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull):not(.nxt-content-page-template), .nxt-container-block-editor > .nxt-content-page-template > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.content-area)' => array(
                        'max-width' => (!empty($posts_block_width)) ? nexter_get_option_css_value( $posts_block_width['desktop'], 'px' ) : '',
                    ),
					'.site-content .nxt-post-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_posts_container)) ? nexter_get_option_css_value( $layout_posts_container['desktop'], 'px' ) : '',
                    ),
                );
				$post_layout_container_css['tb'] = array(
                    '.site-content > .nxt-post-cont.nxt-container-block-editor .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-blog-single-post),.nxt-container-block-editor .site-main .nxt-blog-single-post > article > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-single-post-content), .nxt-container-block-editor .site-main .nxt-single-post-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-post-cont.nxt-container-block-editor >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull):not(.nxt-content-page-template), .nxt-container-block-editor > .nxt-content-page-template > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.content-area)' => array(
                        'max-width' => (!empty($posts_block_width)) ? nexter_get_option_css_value( $posts_block_width['tablet'], 'px' ) : '',
                    ),
					'.site-content .nxt-post-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_posts_container)) ? nexter_get_option_css_value( $layout_posts_container['tablet'], 'px' ) : '',
                    ),
                );
				$post_layout_container_css['mb'] = array(
                    '.site-content > .nxt-post-cont.nxt-container-block-editor .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-blog-single-post),.nxt-container-block-editor .site-main .nxt-blog-single-post > article > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.nxt-single-post-content), .nxt-container-block-editor .site-main .nxt-single-post-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-post-cont.nxt-container-block-editor >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull):not(.nxt-content-page-template), .nxt-container-block-editor > .nxt-content-page-template > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull):not(.content-area)' => array(
                        'max-width' => (!empty($posts_block_width)) ? nexter_get_option_css_value( $posts_block_width['mobile'], 'px' ) : '',
                    ),
					'.site-content .nxt-post-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_posts_container)) ? nexter_get_option_css_value( $layout_posts_container['mobile'], 'px' ) : '',
                    ),
                );
            }
			if (is_single() && !empty($site_posts_container) && $site_posts_container == 'container' ) {
                $post_layout_container_css['dk'] = array(
                    '.nxt-post-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_posts_container)) ? nexter_get_option_css_value( $layout_posts_container['desktop'], 'px' ) : '',
                    )
                );
				$post_layout_container_css['tb'] = array(
                    '.nxt-post-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_posts_container)) ? nexter_get_option_css_value( $layout_posts_container['tablet'], 'px' ) : '',
                    )
                );
				$post_layout_container_css['mb'] = array(
                    '.nxt-post-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_posts_container)) ? nexter_get_option_css_value( $layout_posts_container['mobile'], 'px' ) : '',
                    )
                );
            }

			if(is_single() && !empty($site_posts_container) && $site_posts_container == 'container-fluid'){
				$theme_css = self::dimension_value('post-fluid-spacing', '.site-content .nxt-container-fluid,.site-content .nxt-container-fluid .nxt-row .nxt-col', 'padding', $theme_css );
				$theme_css = self::dimension_value('post-fluid-spacing', '.site-content .nxt-container-fluid .nxt-row', 'margin', $theme_css, 'minus' );
			}
			
			$site_archive_container = nexter_get_option('site-archive-container');
			$site_archive_block_width = nexter_get_option('site-archive-block-width');
			$layout_archive_container = nexter_get_option('layout-archive-container');
			
			//Archive Container
			$archive_layout_container_css = ['dk'=> [],'tb'=>[],'mb'=>[]];
			if ((is_home() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page)) && (function_exists( 'is_shop' ) && !is_shop() && !is_woocommerce()) && !empty($site_archive_container) && $site_archive_container == 'container-block-editor') {
                $archive_layout_container_css['dk'] = array(
                    '.site-content >.nxt-container-block-editor.nxt-archive-cont >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull), .nxt-container-block-editor.nxt-archive-cont .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull)' => array(
                        'max-width' => (!empty($site_archive_block_width)) ? nexter_get_option_css_value( $site_archive_block_width['desktop'], 'px' ) : '',
                    ),
					'.site-content .nxt-archive-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_archive_container)) ? nexter_get_option_css_value( $layout_archive_container['desktop'], 'px' ) : '',
                    ),
                );
				$archive_layout_container_css['tb'] = array(
                    '.site-content >.nxt-container-block-editor.nxt-archive-cont >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull), .nxt-container-block-editor.nxt-archive-cont .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull)' => array(
                        'max-width' => (!empty($site_archive_block_width)) ? nexter_get_option_css_value( $site_archive_block_width['tablet'], 'px' ) : '',
                    ),
					'.site-content .nxt-archive-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_archive_container)) ? nexter_get_option_css_value( $layout_archive_container['tablet'], 'px' ) : '',
                    ),
                );
				$archive_layout_container_css['mb'] = array(
                    '.site-content >.nxt-container-block-editor.nxt-archive-cont >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull), .nxt-container-block-editor.nxt-archive-cont .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull)' => array(
                        'max-width' => (!empty($site_archive_block_width)) ? nexter_get_option_css_value( $site_archive_block_width['mobile'], 'px' ) : '',
                    ),
					'.site-content .nxt-archive-cont.nxt-container-block-editor .alignwide, .nxt-container.nxt-with-sidebar' => array(
                        'max-width' => (!empty($layout_archive_container)) ? nexter_get_option_css_value( $layout_archive_container['mobile'], 'px' ) : '',
                    ),
                );
            }
			
			if ((is_home() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page)) && (function_exists( 'is_shop' ) && !is_shop() && !is_woocommerce()) && !empty($site_archive_container) && $site_archive_container == 'container' ) {
                $archive_layout_container_css['dk'] = array(
                    '.nxt-archive-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_archive_container)) ?  nexter_get_option_css_value( $layout_archive_container['desktop'], 'px' ) : '',
                    )
                );
				$archive_layout_container_css['tb'] = array(
                    '.nxt-archive-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_archive_container)) ? nexter_get_option_css_value( $layout_archive_container['tablet'], 'px' ) : '',
                    )
                );
				$archive_layout_container_css['mb'] = array(
                    '.nxt-archive-cont.nxt-container' => array(
                        'max-width' => (!empty($layout_archive_container)) ? nexter_get_option_css_value( $layout_archive_container['mobile'], 'px' ) : '',
                    )
                );
            }
			if((is_home() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page)) && (function_exists( 'is_shop' ) && !is_shop() && !is_woocommerce()) && !empty($site_archive_container) && $site_archive_container == 'container-fluid'){
				$theme_css = self::dimension_value('archive-fluid-spacing', '.site-content .nxt-container-fluid,.site-content .nxt-container-fluid .site-main > .nxt-row > .nxt-col', 'padding', $theme_css );
				$theme_css = self::dimension_value('archive-fluid-spacing', '.site-content .nxt-container-fluid .site-main > .nxt-row,.archive-page-header', 'margin', $theme_css, 'minus' );
			}
			
			$theme_css['container_m']= array_merge($header_container_css['mb'],$footer_container_css['mb'],$site_layout_container_css['mb'],$page_layout_container_css['mb'],$post_layout_container_css['mb'],$archive_layout_container_css['mb']);
			$theme_css['container_t']= array_merge($header_container_css['tb'],$footer_container_css['tb'],$site_layout_container_css['tb'],$page_layout_container_css['tb'],$post_layout_container_css['tb'],$archive_layout_container_css['tb']);
			$theme_css['container_d']= array_merge($header_container_css['dk'],$footer_container_css['dk'],$site_layout_container_css['dk'],$page_layout_container_css['dk'],$post_layout_container_css['dk'],$archive_layout_container_css['dk']);
			
			return $theme_css;
		}
		
		/*
		 * Gutenberg Dynamic Theme Options Css 
		 * @since 1.0.8
		 */
		public static function gutenberg_dynamic_css( $theme_css ){
			
			$site_layout_container = nexter_get_option('site-layout-container');
            $layout_block_width      = nexter_get_option('layout-block-width');
            $layout_container      = nexter_get_option('layout-container');
			
			//Site Layout Default Container
			$site_layout_container_css = ['dk'=> []];
			if (!empty($site_layout_container) && $site_layout_container == 'container-block-editor') {
                $site_layout_container_css['dk'] = array(
                    '.edit-post-visual-editor .wp-block:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not([data-align=wide]):not([data-align=full])' => array(
                        'max-width' => (!empty($layout_block_width)) ? nexter_get_option_css_value( $layout_block_width['desktop'], 'px' ) : '',
                    ),
					'.edit-post-visual-editor .wp-block[data-align="wide"]' => array(
                        'max-width' => (!empty($layout_container)) ? nexter_get_option_css_value( $layout_container['desktop'], 'px' ) : '',
                    ),
                );
			}
			
			if( !empty($site_layout_container_css['dk'])){
				$theme_css[] = $site_layout_container_css['dk'];
			}
			
			return $theme_css;
		}
	}
}

new Nexter_Layout_Container;