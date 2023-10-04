<?php
/**
 * Class: Nexter_Builder_Ele_Archives_Document
 * Name: Nexter Singular Document
 * Slug: nxt_builder-archives
 *
 * @package	Nexter
 * @since	1.0.7
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Nexter_Builder_Ele_Archives_Document extends Nexter_Builder_Ele_Document_Base {

	public function get_name() {
		return 'nxt_builder-archives';
	}

	public static function get_title() {
		return esc_html__( 'Nexter Archives Template', 'nexter' );
	}
	
	public function get_wp_preview_url() {

		$current_post_id   = $this->get_main_id();
		$nxt_document	= new Nexter_Builder_Elementor_Documents();
		
		$category_id = $current_post_id;
		if(method_exists( $nxt_document, 'nexter_preview_post_setting' )){
			$preview_data = $nxt_document->nexter_preview_post_setting( $current_post_id );
			$category_id = (isset($preview_data['preview_id']) && !empty($preview_data['preview_id'])) ? $preview_data['preview_id'] : $current_post_id;
		}
		
		return add_query_arg(
			[
				'preview_nonce'    => wp_create_nonce( 'post_preview_' . $current_post_id ),
				'nxt_build_template' => $current_post_id,
			],
			esc_url( get_category_link( $category_id ) )
		);

	}
}