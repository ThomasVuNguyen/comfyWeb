<?php
/**
 * Body Color Styling Options for Nexter Theme.
 *
 * @package     Nexter
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Body_General_Colors' ) ) {

	class Nexter_Body_General_Colors extends Nexter_Customizer_Config {
		
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
		 * Register Body Color Customizer Configurations.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$options = array(

				/** Start
				 * Options Body Styling Color
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-body-color]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-body-colors',
					'priority'  => 4,
					'title'     => __( 'Body Color', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'     => NXT_OPTIONS . '[body-color]',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'section'  => 'section-body-colors',
					'default'  => '#888',
					'transport' => 'postMessage',
					'priority' => 5,
					'title'    => __( 'Text Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[link-color]',
					'section'  => 'section-body-colors',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'default'  => '#8072fc',
					'priority' => 5,
					'title'    => __( 'Link Color', 'nexter' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[link-hover-color]',
					'section'  => 'section-body-colors',
					'default'  => '#ff5a6e',
					'type'     => 'control',
					'control'  => 'nxt-color',
					'priority' => 10,
					'title'    => __( 'Link Hover Color', 'nexter' ),
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
			
			$body_color         = nexter_get_option('body-color','#888');
            $a_link_color       = nexter_get_option('link-color','#8072fc');
            $a_link_hover_color = nexter_get_option('link-hover-color','#ff5a6e');
			
			$style =array();
			
			$style  = array(
                'body,blockquote' => array(
                    'color' => esc_attr($body_color),
				),
				'blockquote' => array(
					'border-color' => nexter_hexa_to_rgba($a_link_color, 0.15)
				),
				
				'a, .page-title,.wp-block-navigation .wp-block-navigation__container' => array(
                    'color' => esc_attr($a_link_color)
                ),
				'a:hover, a:focus,.wp-block-navigation .wp-block-navigation-item__content:hover, .wp-block-navigation .wp-block-navigation-item__content:focus' => array(
                    'color' => esc_attr($a_link_hover_color)
                ),
				
				//widget area
				'.widget-area ul li:not(.page_item):not(.menu-item):before, .widget-area ul li.page_item a:before, .widget-area ul li.menu-item a:before' => array(
                    'border-color' => esc_attr($a_link_color)
                ),
				'.widget-area ul li:not(.page_item):not(.menu-item):hover:before, .widget-area ul li.page_item a:hover:before, .widget-area ul li.menu-item a:hover:before' => array(
                    'border-color' => esc_attr($a_link_hover_color)
                ),
				'.widget_calendar #today' => array(
                    'background' => esc_attr($a_link_color)
                ),
				
				//Pagination
				'.nxt-paginate .current, .nxt-paginate a:not(.next):not(.prev):hover, .nxt-paginate .next:hover, .nxt-paginate .prev:hover' => array(
                    'background' => esc_attr($a_link_hover_color)
                ),
				
				//Button 
				'button:focus, .menu-toggle:hover, button:hover, .nxt-btn:hover, .button:hover, input[type=reset]:hover, input[type=reset]:focus, input#submit:hover, input#submit:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus,.button:focus' => array(
                    'background' => esc_attr($a_link_hover_color),
                    'border-color' => esc_attr($a_link_hover_color),
                ),
				
				//tagcloud
                '.tagcloud a:hover, .tagcloud a:focus, .tagcloud a.current-item' => array(
                    'color' => nexter_get_foreground_color($a_link_color),
                    'border-color' => esc_attr($a_link_color),
                    'background-color' => esc_attr($a_link_color)
                ),
				
				 //Input Tag Typography
                'input:focus, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="reset"]:focus, input[type="search"]:focus, textarea:focus' => array(
                    'border-color' => esc_attr($a_link_color)
                ),
                'input[type="radio"]:checked, input[type=reset], input[type="checkbox"]:checked, input[type="checkbox"]:hover:checked, input[type="checkbox"]:focus:checked, input[type=range]::-webkit-slider-thumb' => array(
                    'border-color' => esc_attr($a_link_color),
                    'background-color' => esc_attr($a_link_color),
                    'box-shadow' => 'none'
                ),
                
                //Next Prev Single Post
                '.single .nav-links .nav-previous, .single .nav-links .nav-next' => array(
                    'color' => esc_attr($a_link_color)
                ),
                
                //Blog Post Meta
                '.entry-meta, .entry-meta *' => array(
                    'line-height' => '1.42',
                    'color' => esc_attr($a_link_color)
                ),
                '.entry-meta a:hover, .entry-meta a:hover *, .entry-meta a:focus, .entry-meta a:focus *' => array(
                    'color' => esc_attr($a_link_hover_color)
                ),
                
                //Page Links And Nav
                '.page-links .page-link, .single .post-navigation a' => array(
                    'color' => esc_attr($a_link_color)
                ),
                '.page-links > .page-link, .page-links .page-link:hover, .post-navigation a:hover' => array(
                    'color' => esc_attr($a_link_hover_color)
                ),
            );
			
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
			
			$body_color         = nexter_get_option('body-color','#888');
            $a_link_color       = nexter_get_option('link-color','#8072fc');
            $a_link_hover_color = nexter_get_option('link-hover-color','#ff5a6e');
			
			$style =array();
			
			$style  = array(
                'body :where(.editor-styles-wrapper),.edit-post-visual-editor.editor-styles-wrapper' => array(
                    'color' => esc_attr($body_color),
				),
				'.editor-styles-wrapper a:not(.button-link-wrap):not(.wp-block-navigation-item__content), .editor-styles-wrapper .page-title,.wp-block-navigation .wp-block-navigation__container' => array(
                    'color' => esc_attr($a_link_color)
                ),
				'.editor-styles-wrapper a:hover:not(.button-link-wrap), .editor-styles-wrapper a:focus:not(.button-link-wrap)' => array(
                    'color' => esc_attr($a_link_hover_color)
                ),
				'.wp-block-navigation-item .wp-block-navigation-item__content' => array(
                    'color' => 'inherit'
                ),
				//tagcloud
                '.edit-post-visual-editor .tagcloud a:hover, .edit-post-visual-editor .tagcloud a:focus, .edit-post-visual-editor .tagcloud a.current-item' => array(
                    'color' => nexter_get_foreground_color($a_link_color),
                    'border-color' => esc_attr($a_link_color),
                    'background-color' => esc_attr($a_link_color)
                ),
				
                //Page Links And Nav
                '.edit-post-visual-editor .page-links .page-link,.edit-post-visual-editor .single .post-navigation a' => array(
                    'color' => esc_attr($a_link_color)
                ),
                '.edit-post-visual-editor .page-links > .page-link,.edit-post-visual-editor .page-links .page-link:hover,.edit-post-visual-editor .post-navigation a:hover' => array(
                    'color' => esc_attr($a_link_hover_color)
                ),
            );
			
			if( !empty($style)){
				$theme_css[]= $style;
			}
			
			return $theme_css;
		}
		
	}
}

new Nexter_Body_General_Colors;