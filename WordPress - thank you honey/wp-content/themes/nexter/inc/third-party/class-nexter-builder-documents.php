<?php
/**
 * Nexter Builder Elementor Documents
 *
 * @package	Nexter
 * @since	1.0.7
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Nexter_Builder_Elementor_Documents' ) ) {

	class Nexter_Builder_Elementor_Documents {

		/**
		 * Instance
		 */
		private static $instance;
		
		/*
		 * Document Type Singular/Archives
		 */
		protected $doc_type = null;
		
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
			
			add_action( 'elementor/documents/register', [ $this, 'register_elementor_documents' ] );

			add_action( 'elementor/dynamic_tags/before_render', [ $this, 'switch_to_preview_query' ] );
			add_action( 'elementor/dynamic_tags/after_render', [ $this, 'restore_current_query' ] );
			add_filter( 'post_class', array( $this, 'set_post_class' ) );
			add_filter( 'body_class', array( $this, 'set_body_class' ) );
			add_filter( 'the_content', array( $this, 'add_nexter_post_product_wrapper' ), 1000000 );
		}
		
		/**
		 * Add 'product' class to nexter build post
		 */
		public function set_post_class( $classes ) {

			if ( is_singular( NXT_BUILD_POST ) ) {
				$classes[] = 'product';
			}

			return $classes;
		}
		
		/**
		 * Add 'single-product' class to body on nexter build post
		 *
		 * @param array $classes Default classes list.
		 *
		 * @return array
		 */
		public function set_body_class( $classes ) {

			if ( is_singular( NXT_BUILD_POST ) ) {
				$classes[] = 'woocommerce single-product';
			}

			return $classes;
		}
		
		
		/**
		 * Add product wrapper to content
		 *
		 * @param string $content
		 *
		 * @return string
		 */
		public function add_nexter_post_product_wrapper( $content ) {

			if ( is_singular( NXT_BUILD_POST ) && isset( $_GET['elementor-preview'] ) ) {
				$content = sprintf( '<div class="product">%s</div>', $content );
			}

			return $content;
		}
		
		/**
		 * Register appropriate document types for 'nxt_builder' post type
		 *
		 * @param Elementor\Core\Documents_Manager $documents_manager [description]
		 *
		 */
		public function register_elementor_documents( $documents_manager ){
			$document_path = NXT_THEME_DIR. 'inc/third-party/documents/';
			require $document_path. 'class-nxt-builder-document-base.php';
			
			$documents_list = array(
				'singular'    => array(
					'slug'  => 'nxt_builder',
					'name'  => __( 'Singular', 'nexter' ),
					'file'  => 'class-nxt-builder-ele-document-singular.php',
					'class' => 'Nexter_Builder_Ele_Document',
				),
				'archives'   => array(
					'slug'  => 'nxt_builder-archives',
					'name'  => __( 'Archives', 'nexter' ),
					'file'  => 'class-nxt-builder-ele-document-archives.php',
					'class' => 'Nexter_Builder_Ele_Archives_Document',
				),
			);
			
			foreach ( $documents_list as $key => $value ) {
				require $document_path . $value['file'];
				$documents_manager->register_document_type( $value['slug'], $value['class'] );
			}
			
		}
		
		
		/**
		 * Set document type
		 */
		public function set_current_type( $type ) {
			$this->doc_type = $type;
		}

		/**
		 * Get document type
		 */
		public function get_current_type() {
			return $this->doc_type;
		}


		/**
		 * Switch to specific preview query
		 */
		public function switch_to_preview_query() {

			$post_id	= get_the_ID();
			$document	= Elementor\Plugin::instance()->documents->get_doc_or_auto_save( $post_id );

			if ( ! is_object( $document ) ) {
				return null;
			}

			$new_query_args = $this->get_preview_query_args();

			if ( empty( $new_query_args ) ) {
				return null;
			}
			
			Elementor\Plugin::instance()->db->switch_to_query( $new_query_args );
		}
		
		/**
		 * Restore default query
		 */
		public function restore_current_query() {
			Elementor\Plugin::instance()->db->restore_current_query();
		}
		
		public function nexter_preview_post_setting( $main_post_id = ''){
			$NexterPreview = [];
			if( empty( $main_post_id )){
				$post_id = get_the_ID();
			}else{
				$post_id = $main_post_id;
			}
			
			if ( get_post_type() == NXT_BUILD_POST ) {
				$hook_layout = get_post_meta( $post_id, 'nxt-hooks-layout', true );
				$hook_layout_pages = get_post_meta(  $post_id, 'nxt-hooks-layout-pages', true );
				if( $hook_layout == 'pages' && $hook_layout_pages == 'singular'){
					$singular_preview_type = get_post_meta( $post_id, 'nxt-singular-preview-type', true );
					$singular_preview_id = get_post_meta( $post_id, 'nxt-singular-preview-id', true );
					if( !empty($singular_preview_type) && !empty($singular_preview_id)){
						$NexterPreview['type'] = 'singular'; 
						$NexterPreview['preview_type'] = $singular_preview_type; 
						$NexterPreview['preview_id'] = $singular_preview_id; 
					}
				}else if($hook_layout == 'pages' && $hook_layout_pages == 'archives'){
					$archive_preview_type = get_post_meta( $post_id, 'nxt-archive-preview-type', true );
					$archive_preview_id = get_post_meta( $post_id, 'nxt-archive-preview-id', true );
					if( !empty($archive_preview_type) && !empty($archive_preview_id)){
						$NexterPreview['type'] = 'archives'; 
						$NexterPreview['preview_type'] = $archive_preview_type; 
						$NexterPreview['preview_id'] = $archive_preview_id; 
					}
				}
			}
			
			return $NexterPreview;
		}
		
		public function get_preview_query_args() {
			$nexter_data = $this->nexter_preview_post_setting();
			$preview_id = '';
			if( !empty( $nexter_data ) && !empty( $nexter_data['preview_id'] ) ){
				$preview_id = $nexter_data['preview_id'];
			}
			
			$args = [];
			if( isset( $nexter_data['type'] ) && !empty( $nexter_data['type'] ) ){
				switch ( $nexter_data['type'] ) {
					case 'singular':
						$post = get_post( $preview_id );
						if ( ! $post ) {
							break;
						}

						$args = [
							'p' => $post->ID,
							'post_type' => $post->post_type,
						];
						break;
					case 'archives':
						switch ( $nexter_data['preview_type'] ) {
							case 'nxt_author':
								if ( empty( $preview_id ) ) {
									$preview_id = get_current_user_id();
								}

								$args = [
									'author' => $preview_id,
								];
								break;
							default:
								$getterm = get_term( $preview_id );

								if ( $getterm && ! is_wp_error( $getterm ) ) {
									$args = [
										'tax_query' => [
											[
												'taxonomy' => $getterm->taxonomy,
												'terms' => [ $preview_id ],
												'field' => 'id',
											],
										],
									];
								}
								break;
						}
						break;
				}
			}

			if ( empty( $args ) ) {
				$args = [
					'p' => get_the_ID(),
					'post_type' => get_post_type(),
				];
			}

			return $args;
		}
		
	}

}