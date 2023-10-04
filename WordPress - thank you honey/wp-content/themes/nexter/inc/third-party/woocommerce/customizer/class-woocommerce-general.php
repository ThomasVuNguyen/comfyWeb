<?php
/**
 * Woocommerce General Options for Nexter Theme.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Woocommece_Customize_General' ) ) {

	class Nexter_Woocommece_Customize_General extends Nexter_Customizer_Config {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'nxt_render_theme_css', array( $this, 'dynamic_css' ) );
			parent::__construct();
		}
		
		/**
		 * Register Woo General Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(
				
				/** Start
				 * Options Woocommerce/Base Color
				 */
				 array(
					'name'      => NXT_OPTIONS . '[heading-woocommerce]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-woocommerce-general',
					'priority'  => 4,
					'title'     => __( 'Woocommerce', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'     => NXT_OPTIONS . '[woo-primary-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-woocommerce-general',
					'default'  => '#222',
					'priority' => 4,
					'title'    => __( 'Primary Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[woo-secondary-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-woocommerce-general',
					'default'  => '#8072fc',
					'priority' => 4,
					'title'    => __( 'Secondary Color', 'nexter' ),
				),
				/** End
				 * Options Woocommerce/Base Color
				 */
				 
				/** Start
				 * Options Woocommerce/Container
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-woo-container]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-woocommerce-general',
					'priority'  => 4,
					'title'     => __( 'Container', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),

				array(
					'name'     => NXT_OPTIONS . '[woo-layout-container]',
					'default'  => '',
					'title'    => __( 'Container', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-woocommerce-general',					
					'priority' => 5,
					'choices'  => array(
						''	=> __( 'Default', 'nexter' ),
						'container'	=> __( 'Container', 'nexter' ),
						'container-fluid'	=> __( 'Full Width', 'nexter' ),
					),
				),
				array(
					'name'        => NXT_OPTIONS . '[woo-container-width]',
					'default'     => nexter_get_option( 'woo-container-width' ),
					'title'       => __( 'Container Width', 'nexter' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'nxt-responsive-slider',
					'section'     => 'section-woocommerce-general',
					'priority'    => 5,
					'input_attrs' => array(
						'min'  => 300,
						'step' => 1,
						'max'  => 2000,
					),
					'conditional' => array( NXT_OPTIONS . '[woo-layout-container]', '==', 'container' ),
				),
				array(
					'name'           => NXT_OPTIONS . '[woo-fluid-spacing]',
					'default'        => nexter_get_option( 'woo-fluid-spacing' ),
					'type'           => 'control',
					'control'        => 'nxt-responsive-spacing',
					'section'        => 'section-woocommerce-general',
					'transport'      => 'postMessage',
					'priority'       => 5,
					'title'          => __( 'Spacing(Padding)', 'nexter' ),
					'linked' => true,
					'unit'   => array( 'px', 'em' ),
					'choices'        => array(
						'left'   => __( 'Left', 'nexter' ),
						'right'  => __( 'Right', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[woo-layout-container]', '==', 'container-fluid' ),
				),
				/** End
				 * Options Woocommerce/Container
				 */
				
				/** Start
				 * Options Woocommerce/Sidebar
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-woo-sidebar-opt]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-woocommerce-general',
					'priority'  => 7,
					'title'     => __( 'Side Bar', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				/*
				 * Woocommerce Sidebar
				 */
				array(
					'name'     => NXT_OPTIONS . '[woo-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-woocommerce-general',
					'default'  => 'default',
					'priority' => 8,
					'title'    => __( 'Woocommerce Sidebar', 'nexter' ),
					'choices'  => array(
						'default'       => __( 'Default', 'nexter' ),
						'no-sidebar'    => __( 'No Sidebar', 'nexter' ),
						'left-sidebar'  => __( 'Left Sidebar', 'nexter' ),
						'right-sidebar' => __( 'Right Sidebar', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[woo-display-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-woocommerce-general',
					'default'  => 'Sidebar-1',
					'priority' => 9,
					'title'    => __( 'Display Sidebar', 'nexter' ),
					'choices'  => nexter_get_sidebar_list(),
					'conditional' => array(
						'conditions' => array(
							array( NXT_OPTIONS . '[woo-sidebar-layout]', '!=', 'no-sidebar' ),
							array( NXT_OPTIONS . '[woo-sidebar-layout]', '!=', 'default' ),
						),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[woo-custom-sidebar]',
					'default'  => 'none',
					'title'    => __( 'Custom Sidebar Sections', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-woocommerce-general',
					'priority' => 15,
					'choices'  => nexter_builders_posts_list(),
					'conditional' => array( NXT_OPTIONS . '[woo-display-sidebar]', '==', 'custom' ),
				),
				/*
				 * Single Product Sidebar
				*/
				array(
					'name'     => NXT_OPTIONS . '[single-product-sidebar-divider]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'section'  => 'section-woocommerce-general',
					'priority' => 20,
					'settings' => array(),
				),				
				array(
					'name'     => NXT_OPTIONS . '[single-product-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-woocommerce-general',
					'default'  => 'default',
					'priority' => 20,
					'title'    => __( 'Single Product', 'nexter' ),
					'choices'  => array(
						'default'       => __( 'Default', 'nexter' ),
						'no-sidebar'    => __( 'No Sidebar', 'nexter' ),
						'left-sidebar'  => __( 'Left Sidebar', 'nexter' ),
						'right-sidebar' => __( 'Right Sidebar', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[single-product-display-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-woocommerce-general',
					'default'  => 'Sidebar-1',
					'priority' => 20,
					'title'    => __( 'Display Sidebar', 'nexter' ),
					'choices'  => nexter_get_sidebar_list(),					
					'conditional' => array(
						'conditions' => array(
							array( NXT_OPTIONS . '[single-product-sidebar]', '!=', 'no-sidebar' ),
							array( NXT_OPTIONS . '[single-product-sidebar]', '!=', 'default' ),
						),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[single-product-custom-sidebar]',
					'default'  => 'none',
					'title'    => __( 'Custom Sidebar Sections', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-woocommerce-general',
					'priority' => 20,
					'choices'  => nexter_builders_posts_list(),
					'conditional' => array( NXT_OPTIONS . '[single-product-display-sidebar]', '==', 'custom' ),
				),
				/** End
				 * Options Woocommerce/Sidebar
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
		 * @since 1.0.0
		 */
		public static function dynamic_css( $theme_css ){
			
			$woo_layout_container = nexter_get_option('woo-layout-container');
            $woo_cont_width = nexter_get_option('woo-container-width');
			
			$woo_layout_css = ['dk'=> [],'tb'=>[],'mb'=>[]];
            if (!empty($woo_layout_container) && $woo_layout_container == 'container' && !empty($woo_cont_width['desktop'])) {
                $woo_layout_css['dk'] = array(
                    '.nxt-woocommerce .nxt-container' => array(
                        'max-width' => nexter_get_option_css_value( $woo_cont_width['desktop'], 'px' )
                    )
                );
				$woo_layout_css['tb'] = array(
                    '.nxt-woocommerce .nxt-container' => array(
                        'max-width' => nexter_get_option_css_value( $woo_cont_width['tablet'], 'px' )
                    )
                );
				$woo_layout_css['mb'] = array(
                    '.nxt-woocommerce .nxt-container' => array(
                        'max-width' => nexter_get_option_css_value( $woo_cont_width['mobile'], 'px' )
                    )
                );
            }

			if(!empty($woo_layout_container) && $woo_layout_container == 'container-fluid'){
				$theme_css = self::dimension_value('woo-fluid-spacing', '.woocommerce .site-content .nxt-container-fluid,.woocommerce .site-content .nxt-container-fluid .nxt-row .nxt-col', 'padding', $theme_css );
				$theme_css = self::dimension_value('woo-fluid-spacing', '.woocommerce .site-content .nxt-container-fluid .site-main > .nxt-row,.woocommerce ul.products, .woocommerce-page ul.products,.nxt-prodcut-nav.nxt-row', 'margin', $theme_css, 'minus' );
			}
			
			$theme_css['container_m'][]= array_merge($woo_layout_css['mb']);
			$theme_css['container_t'][]= array_merge($woo_layout_css['tb']);
			$theme_css['container_d'][]= array_merge($woo_layout_css['dk']);
			
			$woo_primary	= nexter_get_option('woo-primary-color','#888');
            $woo_secondary	= nexter_get_option('woo-secondary-color','#8072fc');
			
			$style  = array(
				'.woocommerce ul.products li.product a' => array(
                    'color' => esc_attr($woo_primary),
				),
				'.woocommerce a:hover,.woocommerce a:focus a' => array(
                    'color' => esc_attr($woo_secondary),
				),
                '.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button' => array(
                    'background' => esc_attr($woo_primary),
					'color' => nexter_get_foreground_color( $woo_primary ),
				),
				'.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover' => array(
                    'background' => esc_attr($woo_secondary),
					'color' => nexter_get_foreground_color( $woo_secondary ),
				),
				'.woocommerce ul.products li.product .nxt-prodcut-thumb-wrap .button' => array(
                    'background' => esc_attr($woo_secondary),
				),
				'.woocommerce ul.products li.product .nxt-shop-summary-wrap .woocommerce-loop-product__title, .woocommerce table.shop_table td.product-name a, .woocommerce table.shop_table th.product-name a' => array(
                    'color' => esc_attr($woo_primary),
				),
				'.woocommerce ul.products li.product:hover .nxt-shop-summary-wrap .woocommerce-loop-product__title, .woocommerce table.shop_table td.product-name a:hover, .woocommerce table.shop_table th.product-name a:hover' => array(
                    'color' => esc_attr($woo_secondary),
				),
				'.woocommerce ul.products li.product .onsale' => array(
                    'background' => esc_attr($woo_secondary),
					'color' => nexter_get_foreground_color( $woo_secondary ),
				),
				'.badge.onsale.perc:after, .badge.onsale.perc:before' => array(
                    'border-color' => 'transparent transparent transparent '.esc_attr($woo_secondary),
				),
				'.badge.onsale.perc:after' => array(
                    'border-color' => esc_attr($woo_secondary).' transparent transparent',
				),
				'.woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, .woocommerce-info a.showcoupon' => array(
                    'color' => esc_attr($woo_primary),
				),
				'.woocommerce ul.products .nxt-shop-summary-wrap .star-rating, .woocommerce ul.cart_list li a:hover, .woocommerce ul.product_list_widget li a:hover, .woocommerce-info a.showcoupon:hover' => array(
                    'color' => esc_attr($woo_secondary),
				),
				'.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span' => array(
                    'background' => esc_attr($woo_primary),
					'color' => nexter_get_foreground_color( $woo_primary ),
				),
				'.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce #order_review button, .woocommerce-page #order_review button' => array(
                    'background' => esc_attr($woo_secondary),
					'color' => nexter_get_foreground_color( $woo_secondary ),
				),
				'.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt' => array(
                    'background' => esc_attr($woo_primary),
					'color' => nexter_get_foreground_color( $woo_primary ),
				),
				'.woocommerce div.product form.cart .button, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-message a.button' => array(
                    'background' => esc_attr($woo_secondary),
					'color' => nexter_get_foreground_color( $woo_secondary ),
				),
				'.woocommerce p.stars a' => array(
					'color' => $woo_secondary,
				),
				'.woocommerce input:focus, .woocommerce input[type="text"]:focus, .woocommerce input[type="email"]:focus, .woocommerce input[type="url"]:focus, .woocommerce input[type="password"]:focus, .woocommerce input[type="reset"]:focus, .woocommerce input[type="search"]:focus, .woocommerce textarea:focus, #add_payment_method table.cart td.actions .coupon .input-text:focus, .woocommerce-cart table.cart td.actions .coupon .input-text:focus, .woocommerce-checkout table.cart td.actions .coupon .input-text:focus' => array(
					'border-color' => $woo_secondary,
				),
				'.woocommerce-message,.woocommerce-info' => array(
					'border-top-color' => $woo_secondary,
				),
				'.woocommerce-message::before,.woocommerce-info::before' => array(
					'color' => $woo_secondary,
				),
				'.woocommerce-MyAccount-content a,.woocommerce-form-login a' => array(
					'color' => $woo_primary,
				),
				'.woocommerce-MyAccount-content a:hover, .woocommerce-account .woocommerce-MyAccount-navigation ul li a' => array(
					'color' => $woo_secondary,
				),
				'.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a' => array(
                    'background' => esc_attr($woo_secondary),
					'color' => nexter_get_foreground_color( $woo_secondary ),
				),
				'.woocommerce-account .woocommerce-MyAccount-navigation ul' => array(
                    'border-color' => esc_attr($woo_secondary),
				),
				'.woocommerce-account .woocommerce-MyAccount-navigation ul li' => array(
                    'border-bottom-color' => esc_attr($woo_secondary),
				),
			);
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			return $theme_css;
		}
		
	}
}

new Nexter_Woocommece_Customize_General;