<?php
/**
 * Customizer Control: Heading
 * Type : nxt-heading
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Nexter_Control_Heading extends WP_Customize_Control {

	/**
	 * Control Type
	 */
	public $type = 'nxt-heading';

	/**
	 * @caption
	 */
	public $caption = '';

	/**
	 * @separator
	 */
	public $separator = true;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;
		$this->json['separator']   = $this->separator;
		$this->json['caption']     = $this->caption;
	}
	
	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>

		<# if ( data.caption ) { #>
			<span class="customize-control-caption">{{{ data.caption }}}</span>
		<# } #>

		<# if ( data.separator ) { #>
			<hr />
		<# } #>

		<# if ( data.label || data.description ) { #>
			<label class="customizer-text">
				<# if ( data.label ) { #>
					<span class="customize-control-title">{{{ data.label }}}</span>
				<# } #>
				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
			</label>
		<# } #>
		
		<?php
	}
}