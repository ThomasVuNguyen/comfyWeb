<?php
/**
 * Customizer Control: Slider Responsive
 * Type : nxt-responsive-slider
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Nexter_Control_Responsive_Slider extends WP_Customize_Control {

	/**
	 * Control Type
	 */
	public $type = 'nxt-responsive-slider';

	/**
	 * @suffix
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

		$val = maybe_unserialize( $this->value() );

		if ( ! is_array( $val ) || is_numeric( $val ) ) {

			$val = array(
				'desktop' => $val,
				'tablet'  => '',
				'mobile'  => '',
			);
		}

		$this->json['value']  = $val;
		$this->json['link']   = $this->get_link();
		$this->json['label']  = esc_html( $this->label );
		$this->json['id']     = $this->id;
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
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
				<ul class="nxt-resp-slider-devices">
					<?php $devices = ['desktop' => 'desktop', 'tablet' => 'tablet', 'mobile' => 'smartphone']; 
					foreach($devices as $key => $val){ 
						$active = '';
						if($key == 'desktop' ){
							$active = ' active';
						}
					?>
						<li class="<?php echo esc_attr($key); echo esc_attr($active); ?>">
							<button type="button" class="preview-<?php echo esc_attr($key); echo esc_attr($active);?>" data-device="<?php echo esc_attr($key); ?>">
								<i class="dashicons dashicons-<?php echo esc_attr($val); ?>"></i>
							</button>
						</li>
					<?php }	?>
				</ul>
			<# } #>
			
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } 

			value_md = '';
			value_sm  = '';
			value_xs  = '';
			default_md = '';
			default_sm  = '';
			default_xs  = '';

			if ( data.value['desktop'] ) { 
				value_md = data.value['desktop'];
			} 

			if ( data.value['tablet'] ) { 
				value_sm = data.value['tablet'];
			} 

			if ( data.value['mobile'] ) { 
				value_xs = data.value['mobile'];
			}

			if ( data.default['desktop'] ) { 
				default_md = data.default['desktop'];
			} 

			if ( data.default['tablet'] ) { 
				default_sm = data.default['tablet'];
			} 

			if ( data.default['mobile'] ) { 
				default_xs = data.default['mobile'];
			} #>
			
			<div class="wrapper">
				<div class="nxt-slider-wrap desktop active">
					<input type="range" value="{{ value_md }}" data-reset="{{ default_md }}" {{{ data.inputAttrs }}} />
					<div class="nxt-slider-field">
						<input type="number" data-id='desktop' class="nxt-responsive-slider-number" value="{{ value_md }}" {{{ data.inputAttrs }}} ><#
						if ( data.suffix ) {
						#><span class="nxt-slider-unit">{{ data.suffix }}</span><#
						} #>
					</div>
				</div>
				<div class="nxt-slider-wrap tablet">
					<input type="range" value="{{ value_sm }}" data-reset="{{ default_sm }}" {{{ data.inputAttrs }}} />
					<div class="nxt-slider-field">
						<input type="number" data-id='tablet' class="nxt-responsive-slider-number" value="{{ value_sm }}" {{{ data.inputAttrs }}} ><#
						if ( data.suffix ) {
						#><span class="nxt-slider-unit">{{ data.suffix }}</span><#
						} #>
					</div>
				</div>
				<div class="nxt-slider-wrap mobile">
					<input type="range" value="{{ value_xs }}" data-reset="{{ default_xs }}" {{{ data.inputAttrs }}} />
					<div class="nxt-slider-field">
						<input type="number" data-id='mobile' class="nxt-responsive-slider-number" value="{{ value_xs }}" {{{ data.inputAttrs }}} ><#
						if ( data.suffix ) {
						#><span class="nxt-slider-unit">{{ data.suffix }}</span><#
						} #>
					</div>
				</div>
				<div class="nxt-reset-slider-resp">
					<span class="dashicons dashicons-image-rotate"></span>
				</div>
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