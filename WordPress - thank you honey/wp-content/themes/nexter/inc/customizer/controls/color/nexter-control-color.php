<?php
/**
 * Customizer Control: Color
 * Type : nxt-color
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Nexter_Control_Color extends WP_Customize_Control {

	/**
	 * Control Type
	 */
	public $type = 'nxt-color';

	/**
	 * Suffix
	 */
	public $suffix = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['value']  = $this->value();
		$this->json['link']   = $this->get_link();
		$this->json['id']     = $this->id;
		$this->json['label']  = esc_html( $this->label );
		$this->json['suffix'] = $this->suffix;

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
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
		<div class="customize-control-content nxt-colorpicker">
			
			<# var defaultValue = '#RRGGBB', defaultAttr = '';

			if ( data.defaultValue ) {
				if ( '#' !== data.defaultValue.substring( 0, 1 ) ) {
					defaultValue = '#' + data.defaultValue;
				} else {
					defaultValue = data.defaultValue;
				}
				defaultAttr = ' data-default-color=' + defaultValue;
			} #>
			<# if ( data.label ) { #>
				<label>
					<span class="customize-control-title">{{{ data.label }}}</span>
				</label>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		
			<input type="text" class="nxt-color-picker-alpha color-picker-hex" data-alpha="true" placeholder="{{ defaultValue }}" {{ defaultAttr }} value="{{data.value}}" />
		</div>
		<?php
	}
}