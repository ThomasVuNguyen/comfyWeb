<?php
/**
 * Theme Page Builder Compatibility 
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! class_exists( 'Nexter_Builder_Compatibility' ) ) {

	class Nexter_Builder_Compatibility {

		/**
		 * Instance
		 */
		private static $instance;
		
		protected $template_post_ids = array();
		
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
			add_filter( 'nexter_template_load_ids', array($this,'nexter_template_list_ids'), 10, 1 );
		}
		
		public function nexter_template_list_ids( $post_ids ){
			if( !empty( $this->template_post_ids ) ){
				$post_ids = array_unique(array_merge($this->template_post_ids, $post_ids));
			}
			return $post_ids;
		}
		
		/**
		 * get activate page builder
		 * @since 2.0.2
		 */
		public function get_active_page_builder( $post_id ) {
			global $wp_post_types;
			
				$post = get_post( $post_id );
				
				array_push($this->template_post_ids, $post_id);
				
				//Activate Visual Composer
				$vc_status = get_post_meta( $post_id, '_wpb_vc_js_status', true );
				if ( class_exists( 'Vc_Manager' ) && ( $vc_status == 'true' || has_shortcode( $post->post_content, 'vc_row' ) ) ) {
					return Nexter_Visual_Composer_Builder::get_instance();
				}
				
				//Activate Elementor
				if ( class_exists( '\Elementor\Plugin' ) && $this->check_elementor_build($post_id) ) {
					return Nexter_Elementor_Builder::get_instance();
				}
				
				//Activate Beaver
				if ( class_exists( 'FLBuilderModel' )){
					if(apply_filters( 'fl_builder_do_render_content', true, FLBuilderModel::get_post_id() ) && get_post_meta( $post_id, '_fl_builder_enabled', true ) ) {
						return Nexter_Beaver_Builder::get_instance();
					}
				}
				
			$has_rest_support = $wp_post_types[ NXT_BUILD_POST ]->show_in_rest;
			
			if ( $has_rest_support ) {
				return new Nexter_Gutenberg_Editor();
			}
			
			return self::get_instance();
		}

		/**
		 * Check Elementor Builder
		 * @since 2.0.3
		 */
		public function check_elementor_build( $post_id ) {
			if(class_exists( '\Elementor\Plugin' ) ){
				if ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) ) {
					return ( 'builder' === Elementor\Plugin::$instance->db->get_edit_mode( $post_id ) );
				} else {
					$document = Elementor\Plugin::$instance->documents->get( $post_id );
					if ( $document ) {
						return $document->is_built_with_elementor();
					} else {
						return false;
					}
				}
			}else{
				return false;
			}
		}

		/**
		 * post Render content.
		 */
		public function render_content( $post_id ) {

			$cur_post = get_post( $post_id, OBJECT );
			ob_start();
				echo apply_filters('the_content', wp_kses_post($cur_post->post_content) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$output =  ob_get_clean();
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

	}

	Nexter_Builder_Compatibility::get_instance();
}