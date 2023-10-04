<?php
/**
 * Class: Nexter_Builder_Ele_Document_Base
 * Name: Document Base
 * Slug: nxt_builder-archives-document
 *
 * @package	Nexter
 * @since	1.0.7
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Nexter_Builder_Ele_Document_Base extends Elementor\Core\Base\Document {

	public function get_name() {
		return 'nxt_builder-archives-document';
	}

	public static function get_properties() {

		$properties = parent::get_properties();

		$properties['admin_tab_group'] = '';
		$properties['support_kit']     = true;

		return $properties;

	}
	/**
	 * Get elements data with new query
	 *
	 * @param null    $data
	 * @param boolean $with_html_content
	 *
	 * @return array
	 */
	public function get_elements_raw_data( $data = null, $with_html_content = false ) {

		Nexter_Theme_Builder_Load()->documents->switch_to_preview_query();

		$editor_data = parent::get_elements_raw_data( $data, $with_html_content );

		Nexter_Theme_Builder_Load()->documents->restore_current_query();

		return $editor_data;

	}

	/**
	 * Render current element
	 *
	 * @param $data
	 *
	 * @return string
	 * @throws Exception
	 */
	public function render_element( $data ) {

		Nexter_Theme_Builder_Load()->documents->switch_to_preview_query();

		$render_html = parent::render_element( $data );

		Nexter_Theme_Builder_Load()->documents->restore_current_query();

		return $render_html;

	}

	/**
	 * Return elements data
	 *
	 * @param string $status
	 *
	 * @return array
	 */
	public function get_elements_data( $status = 'publish' ) {

		if ( ! isset( $_GET[ NXT_BUILD_POST ] ) || ! isset( $_GET['preview'] ) ) {
			return parent::get_elements_data( $status );
		}

		Nexter_Theme_Builder_Load()->documents->switch_to_preview_query();

		$elements = parent::get_elements_data( $status );

		Nexter_Theme_Builder_Load()->documents->restore_current_query();

		return $elements;

	}
	
}