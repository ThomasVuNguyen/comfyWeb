<?php
/**
 * Nexter Beaver Theme Build Compatibility
 *
 * @package Nexter
 * @since 1.0.0
 */
if ( ! class_exists( 'FLBuilderModel' ) || ! class_exists( 'FLThemeBuilderLoader' ) ) {
	return;
}
if ( ! class_exists( 'Nexter_Beaver_Theme_Build' ) ) {

	class Nexter_Beaver_Theme_Build {

		/**
		 * Instance
		 */
		private static $instance;

		/**
		 * Initiator
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
			add_action( 'after_setup_theme', array( $this, 'nexter_header_footer_support' ) );
			add_action( 'wp', array( $this, 'nexter_header_footer_render' ) );
			add_filter( 'fl_theme_builder_part_hooks', array( $this, 'nexter_register_hooks_list' ) );
		}
		
		/**
		 * Add theme support
		 */
		public function nexter_header_footer_support() {
			add_theme_support( 'fl-theme-builder-headers' );
			add_theme_support( 'fl-theme-builder-footers' );
			add_theme_support( 'fl-theme-builder-parts' );
		}
		
		/**
		 * Compatibility header/footer Beaver template
		 */
		public function nexter_header_footer_render(){
			// Get the header ID
			$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();

			// If beaver build header, remove the nexter header and hook in Theme Builder's.
			if ( ! empty( $header_ids ) ) {
				remove_action( 'nexter_header', 'nexter_header_template' );
				add_action( 'nexter_header', 'FLThemeBuilderLayoutRenderer::render_header' );
			}

			// Get the footer ID.
			$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();

			// If beaver build footer, remove the nexter footer and hook in Theme Builder's.
			if ( ! empty( $footer_ids ) ) {
				remove_action( 'nexter_footer', 'nexter_footer_template' );
				add_action( 'nexter_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
			}
		}
		
		/**
		 * Register hooks list
		 */
		public function nexter_register_hooks_list() {

			return array(
				array(
					'label' => esc_html__( 'Page', 'nexter' ),
					'hooks' => array(
						'nxt_body_top'	=> esc_html__( 'Before Page', 'nexter' ),
						'nxt_body_bottom'	=> esc_html__( 'After Page', 'nexter' ),
					),
				),
				array(
					'label' => esc_html__( 'Header', 'nexter' ),
					'hooks' => array(
						'nxt_header_before'	=> esc_html__( 'Header Before', 'nexter' ),
						'nxt_header_after'	=> esc_html__( 'Header After', 'nexter' ),
					),
				),
				array(
					'label' => esc_html__( 'Content', 'nexter' ),
					'hooks' => array(
						'nxt_content_top'	=> esc_html__( 'Content Top', 'nexter' ),
						'nxt_content_bottom'	=> esc_html__( 'Content Bottom', 'nexter' ),
					),
				),
				array(
					'label' => esc_html__( 'Content', 'nexter' ),
					'hooks' => array(
						'nxt_content_top'	=> esc_html__( 'Content Top', 'nexter' ),
						'nxt_content_bottom'	=> esc_html__( 'Content Bottom', 'nexter' ),
					),
				),
				array(
					'label' => esc_html__( 'Sidebar', 'nexter' ),
					'hooks' => array(
						'nxt_sidebars_before'	=> esc_html__( 'Sidebar Before', 'nexter' ),
						'nxt_sidebars_after'	=> esc_html__( 'Sidebar After', 'nexter' ),
					),
				),
				array(
					'label' => esc_html__( 'Footer', 'nexter' ),
					'hooks' => array(
						'nxt_footer_before'	=> esc_html__( 'Footer Before', 'nexter' ),
						'nxt_footer_after'	=> esc_html__( 'Footer After', 'nexter' ),
					),
				),
				array(
					'label' => esc_html__( 'Posts', 'nexter' ),
					'hooks' => array(
						'nxt_comments_before'	=> esc_html__( 'Comments Before', 'nexter' ),
						'nxt_comments_after'	=> esc_html__( 'Comments After', 'nexter' ),
					),
				),
			);
		}
		
	}
}

Nexter_Beaver_Theme_Build::get_instance();