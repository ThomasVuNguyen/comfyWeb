<?php
/**
 * Customizer Control: Responsive Number Field
 * Type : nxt-responsive
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Nexter_Control_Responsive extends WP_Customize_Control {

	/**
	 * Type Control
	 */
	public $type = 'nxt-responsive';

	/**
	 * Default Responsive True
	 */
	public $responsive = true;

	/**
	 * Units Default
	 */
	public $units = array();
	
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

		$val = maybe_unserialize( $this->value() );

		if ( ! is_array( $val ) || is_numeric( $val ) ) {

			$val = array(
				'desktop'      => $val,
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => '',
				'tablet-unit'  => '',
				'mobile-unit'  => '',
			);
		}

		$this->json['value']      = $val;
		$this->json['link']       = $this->get_link();
		$this->json['label']      = esc_html( $this->label );
		$this->json['id']         = $this->id;
		$this->json['choices']    = $this->choices;
		$this->json['units']      = $this->units;
		$this->json['responsive'] = $this->responsive;

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

		<label class="customizer-text" >
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>

				<# if ( data.responsive ) { #>
				<ul class="nxt-responsive-devices">
					<li class="desktop active">
						<button type="button" class="preview-desktop active" data-device="desktop">
							<i class="dashicons dashicons-desktop"></i>
						</button>
					</li>
					<li class="tablet">
						<button type="button" class="preview-tablet" data-device="tablet">
							<i class="dashicons dashicons-tablet"></i>
						</button>
					</li>
					<li class="mobile">
						<button type="button" class="preview-mobile" data-device="mobile">
							<i class="dashicons dashicons-smartphone"></i>
						</button>
					</li>
				</ul>
				<# } #>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } 

			value_md = value_sm  = value_xs  = '';

			if ( data.value['desktop'] ) { 
				value_md = data.value['desktop'];
			} 

			if ( data.value['tablet'] ) { 
				value_sm = data.value['tablet'];
			} 

			if ( data.value['mobile'] ) { 
				value_xs = data.value['mobile'];
			} #>

			<div class="nxt-responsive-control-wrap">

				<# if ( data.responsive ) { #>
					<input type="number" {{{ data.inputAttrs }}} class="nxt-responsive-number desktop active" data-id='desktop' value="{{ value_md }}"/>
					<select class="nxt-responsive-unit desktop" data-id='desktop-unit' <# if ( _.size( data.units ) === 1 ) { #> disabled="disabled" <# } #>>
						<# _.each( data.units, function( value, key ) { #>
							<option value="{{{ key }}}" <# if ( data.value['desktop-unit'] === key ) { #> selected="selected" <# } #>>{{{ data.units[ key ] }}}</option>
						<# }); #>
					</select>

					<input type="number" {{{ data.inputAttrs }}} class="nxt-responsive-number tablet" data-id='tablet' value="{{ value_sm }}"/>
					<select class="nxt-responsive-unit tablet" data-id='tablet-unit' <# if ( _.size( data.units ) === 1 ) { #> disabled="disabled" <# } #>>
						<# _.each( data.units, function( value, key ) { #>
							<option value="{{{ key }}}" <# if ( data.value['tablet-unit'] === key ) { #> selected="selected" <# } #>>{{{ data.units[ key ] }}}</option>
						<# }); #>
					</select>

					<input type="number" {{{ data.inputAttrs }}} class="nxt-responsive-number mobile" data-id='mobile' value="{{ value_xs }}"/>
					<select class="nxt-responsive-unit mobile" data-id='mobile-unit' <# if ( _.size( data.units ) === 1 ) { #> disabled="disabled" <# } #>>
						<# _.each( data.units, function( value, key ) { #>
							<option value="{{{ key }}}" <# if ( data.value['mobile-unit'] === key ) { #> selected="selected" <# } #>>{{{ data.units[ key ] }}}</option>
						<# }); #>
					</select>

				<# } else { #>
					<input type="number" {{{ data.inputAttrs }}} class="nxt-responsive-number nxt-non-resp desktop active" data-id='desktop' value="{{ value_md }}"/>
					<select class="nxt-responsive-unit nxt-non-resp desktop" data-id='desktop-unit' <# if ( _.size( data.units ) === 1 ) { #> disabled="disabled" <# } #>>
						<# _.each( data.units, function( value, key ) { #>
							<option value="{{{ key }}}" <# if ( data.value['desktop-unit'] === key ) { #> selected="selected" <# } #>>{{{ data.units[ key ] }}}</option>
						<# }); #>
					</select>
				<# } #>
			</div>
		</label>
		<?php
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {}
	
}