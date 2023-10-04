<?php
/**
 * Nexter Theme Page Builder Load
 *
 * @package	Nexter
 * @since	1.0.7
 */

if ( ! class_exists( 'Nexter_Theme_Builder_Load' ) ) {

	class Nexter_Theme_Builder_Load {

		/**
		 * Instance
		 */
		private static $instance;
		
		/**
		 * @var Nexter_Builder_Elementor_Documents
		 */
		public $documents;
		
		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		public function __construct() {
			if (  did_action( 'elementor/loaded' ) && class_exists( '\Elementor\Plugin' ) ) {
				add_action( 'init', array( $this, 'init_elementor' ), -999 );
			}
			/*
			global $pagenow;
			if(in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) && isset($_GET['post']) && NXT_BUILD_POST === get_post_type( $_GET['post'] )){
				add_action( 'init', array( $this, 'init_block_editor' ), 10 );
			}*/
			add_filter( 'preview_post_link', array( $this, 'nxt_preview_post_link' ) , 10, 2);
		}
		
		/*
		 * Initialize Elementor Documents
		 */	
		public function init_elementor(){
			$this->load_files();
			$this->documents     = new Nexter_Builder_Elementor_Documents();
		}
		
		/*
		 * Load Files Elementor Nexter Build Documents
		 */
		public function load_files(){
			require NXT_THEME_DIR.'inc/third-party/class-nexter-builder-documents.php';
		}
		
		
		/*
		 * Nexter Builder Post Preview Link
		 */
		public function nxt_preview_post_link( $link, \WP_Post $post ){
			
			if( isset($post->post_type) && NXT_BUILD_POST != $post->post_type){
				return $link;
			}
			$current_post_id = $post->ID;
			$NexterPreview = [];
			
			$hook_layout = get_post_meta( $current_post_id, 'nxt-hooks-layout', true );
			$hook_layout_pages = get_post_meta(  $current_post_id, 'nxt-hooks-layout-pages', true );
			if( $hook_layout == 'pages' && $hook_layout_pages == 'singular'){
				$singular_preview_type = get_post_meta( $current_post_id, 'nxt-singular-preview-type', true );
				$singular_preview_id = get_post_meta( $current_post_id, 'nxt-singular-preview-id', true );
				if( !empty($singular_preview_type) && !empty($singular_preview_id)){
					$NexterPreview['type'] = 'singular'; 
					$NexterPreview['preview_type'] = $singular_preview_type; 
					$NexterPreview['preview_id'] = $singular_preview_id; 
				}
			}else if($hook_layout == 'pages' && $hook_layout_pages == 'archives'){
				$archive_preview_type = get_post_meta( $current_post_id, 'nxt-archive-preview-type', true );
				$archive_preview_id = get_post_meta( $current_post_id, 'nxt-archive-preview-id', true );
				if( !empty($archive_preview_type) && !empty($archive_preview_id)){
					$NexterPreview['type'] = 'archives'; 
					$NexterPreview['preview_type'] = $archive_preview_type; 
					$NexterPreview['preview_id'] = $archive_preview_id; 
				}
			}
			
			if( isset($NexterPreview) && empty($NexterPreview)){
				return $link;
			}
			
			if( isset($NexterPreview['type']) && $NexterPreview['type']=='singular' ){
				$post_id = (isset($NexterPreview['preview_id']) && !empty($NexterPreview['preview_id'])) ? $NexterPreview['preview_id'] : $current_post_id;
				$link = get_permalink( $post_id );
			}else if( isset($NexterPreview['type']) && $NexterPreview['type']=='archives' ){
				$category_id = (isset($NexterPreview['preview_id']) && !empty($NexterPreview['preview_id'])) ? $NexterPreview['preview_id'] : $current_post_id;
				$link = esc_url( get_category_link( $category_id ) );
			}
			
			return add_query_arg(
				[
					'preview_nonce'    => wp_create_nonce( 'post_preview_' . $current_post_id ),
					'nxt_build_template' => $current_post_id,
				],
				$link
			);
		}
	}

}

if ( ! function_exists( 'nexter_theme_builder_load' ) ) {
	
	function nexter_theme_builder_load() {
		return Nexter_Theme_Builder_Load::get_instance();
	}
}

nexter_theme_builder_load();