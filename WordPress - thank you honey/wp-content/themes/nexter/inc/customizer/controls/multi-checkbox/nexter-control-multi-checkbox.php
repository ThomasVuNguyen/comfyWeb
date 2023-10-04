<?php
/**
 * Customizer Control: Multi Select Checkbox
 * Type : nxt-multi-checkbox
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Nexter_Control_MultiCheckbox' ) && class_exists( 'WP_Customize_Control' ) ) {

	class Nexter_Control_MultiCheckbox extends WP_Customize_Control {

		/**
		 * Control Type
		 */
		public $type = 'nxt-multi-checkbox';

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		*/
		public function to_json() {
			parent::to_json();

			if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			} else {
				$this->json['default'] = $this->setting->default;
			}
			$this->json['value']       = $this->value();
			$this->json['choices']     = $this->choices;
			$this->json['link']        = $this->get_link();
			$this->json['id']          = $this->id;

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
			
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<div class="nxt-multi-checkbox-outer-wrapper">
					<ul class="nxt-multi-checkbox-wrap">
						<# for ( key in data.choices ) { #>
							<li>
								<label>
									<input {{{ data.inputAttrs }}} type="checkbox" value="{{ key }}"<# if ( _.contains( data.value, key ) ) { #> checked<# } #> />
									{{ data.choices[ key ] }}
								</label>
							</li>
						<# } #>
					</ul>
			</div>
			<?php
		}

		/**
		 * Render the control's content.
		 *
		 */
		public function render_content() {}
        
	}
}