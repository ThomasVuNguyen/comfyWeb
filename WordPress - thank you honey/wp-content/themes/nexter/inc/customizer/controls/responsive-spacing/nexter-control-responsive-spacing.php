<?php
/**
 * Customizer Control: Background
 * Type : nxt-responsive-spacing
 *
 * @package	Nexter
 * @since	1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Nexter_Control_Responsive_Spacing' ) && class_exists( 'WP_Customize_Control' ) ) :

	class Nexter_Control_Responsive_Spacing extends WP_Customize_Control {

		/**
		 * Control Type
		 */
		public $type = 'nxt-responsive-spacing';

		/**
		 * Linked/Unlinked Choices
		 */
		public $linked = '';

		/**
		 * Unit Type
		 */
		public $unit = array( 'px' => 'px' );
		
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
					'md'      => array(
						'top'    => $val,
						'right'  => '',
						'bottom' => $val,
						'left'   => '',
					),
					'sm'       => array(
						'top'    => $val,
						'right'  => '',
						'bottom' => $val,
						'left'   => '',
					),
					'xs'       => array(
						'top'    => $val,
						'right'  => '',
						'bottom' => $val,
						'left'   => '',
					),
					'md-unit' => 'px',
					'sm-unit'  => 'px',
					'xs-unit'  => 'px',
				);
			}

			/* Control Units */
			$units = array(
				'md-unit' => 'px',
				'sm-unit'  => 'px',
				'xs-unit'  => 'px',
			);

			foreach ( $units as $key_unit => $unit_value ) {
				if ( ! isset( $val[ $key_unit ] ) ) {
					$val[ $key_unit ] = $unit_value;
				}
			}

			$this->json['value']	= $val;
			$this->json['choices']	= $this->choices;
			$this->json['link']	= $this->get_link();
			$this->json['id']	= $this->id;
			$this->json['label']	= esc_html( $this->label );
			$this->json['linked']	= $this->linked;
			$this->json['unit']	= $this->unit;
			$this->json['inputAttrs']	= '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}
			$this->json['inputAttrs']	= maybe_serialize( $this->input_attrs() );

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
			$linked_title = __( 'Linked/Unlinked', 'nexter' );
		?>
			<label class="nxt-resp-spacing" for="" >

				<# if ( data.label ) { #>
					<span class="customize-control-title">{{{ data.label }}}</span>
				<# } #>
				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } 

				md_unit_val = 'px';
				sm_unit_val  = 'px';
				xs_unit_val  = 'px';

				if ( data.value['md-unit'] ) { 
					md_unit_val = data.value['md-unit'];
				} 

				if ( data.value['sm-unit'] ) { 
					sm_unit_val = data.value['sm-unit'];
				} 

				if ( data.value['xs-unit'] ) { 
					xs_unit_val = data.value['xs-unit'];
				}
				
				
				value_md = '';
				value_sm  = '';
				value_xs  = '';

				if ( data.value['md'] ) { 
					value_md = data.value['md'];
				} 

				if ( data.value['sm'] ) { 
					value_sm = data.value['sm'];
				} 

				if ( data.value['xs'] ) { 
					value_xs = data.value['xs'];
				}
				#>

				<div class="nxt-resp-spacing-wrap">
					<div class="nxt-spacing-inner-wrap">
						<ul class="nxt-spacing-devices desktop active">
							<# if ( data.linked ) { #>
							<li class="nxt-spacing-input-link-unlink">
									<span class="dashicons dashicons-admin-links nxt-spacing-linked wp-ui-highlight" title="<?php echo esc_html( $linked_title ); ?>" data-element-connect="{{ data.id }}"></span>
									<span class="dashicons dashicons-editor-unlink nxt-spacing-unlinked" title="<?php echo esc_html( $linked_title ); ?>" data-element-connect="{{ data.id }}"></span>
								</li><#
							}
							_.each( data.choices, function( label, val ) {
							#><li {{{ data.inputAttrs }}} class="nxt-spacing-input-item">
								<input type="number" class="nxt-spacing-input nxt-spacing-desktop" value="{{ value_md[ val ] }}" data-id= "{{ val }}">
								<span class="nxt-spacing-label">{{{ data.choices[ val ] }}}</span>
							</li><#
							}); #>
							<ul class="nxt-spacing-units-devices nxt-spacing-desktop-responsive-units">
								<#_.each( data.unit, function( key_unit ) { 
									unit_active = '';
									if ( md_unit_val === key_unit ) { 
										unit_active = 'active';
									}
								#><li class="single-unit {{ unit_active }}" data-unit="{{ key_unit }}" >
									<span class="unit-text">{{{ key_unit }}}</span>
								</li><# 
								});#>
							</ul>
						</ul>

						<ul class="nxt-spacing-devices tablet">
							<# if ( data.linked ) { #>
							<li class="nxt-spacing-input-link-unlink">
								<span class="dashicons dashicons-admin-links nxt-spacing-linked wp-ui-highlight" title="<?php echo esc_html( $linked_title ); ?>" data-element-connect="{{ data.id }}"></span>
								<span class="dashicons dashicons-editor-unlink nxt-spacing-unlinked" title="<?php echo esc_html( $linked_title ); ?>" data-element-connect="{{ data.id }}"></span>
							</li><#
							}
							_.each( data.choices, function( label, val ) { 
							#><li {{{ data.inputAttrs }}} class="nxt-spacing-input-item">
								<input type="number" class="nxt-spacing-input nxt-spacing-tablet" value="{{ value_sm[ val ] }}" data-id="{{ val }}">
								<span class="nxt-spacing-label">{{{ data.choices[ val ] }}}</span>
							</li><# 
							}); #>
							<ul class="nxt-spacing-units-devices nxt-spacing-tablet-responsive-units">
								<#_.each( data.unit, function( key_unit ) { 
									unit_active = '';
									if ( sm_unit_val === key_unit ) { 
										unit_active = 'active';
									}
								#><li class="single-unit {{ unit_active }}" data-unit="{{ key_unit }}" >
									<span class="unit-text">{{{ key_unit }}}</span>
								</li><# 
								});#>
							</ul>
						</ul>

						<ul class="nxt-spacing-devices mobile"><# 
							if ( data.linked ) { #>
							<li class="nxt-spacing-input-link-unlink">
								<span class="dashicons dashicons-admin-links nxt-spacing-linked wp-ui-highlight" title="<?php echo esc_html( $linked_title ); ?>" data-element-connect="{{ data.id }}"></span>
								<span class="dashicons dashicons-editor-unlink nxt-spacing-unlinked" title="<?php echo esc_html( $linked_title ); ?>" data-element-connect="{{ data.id }}"></span>
							</li><#
							}
							_.each( data.choices, function( label, val ) { 
							#><li {{{ data.inputAttrs }}} class="nxt-spacing-input-item">
								<input type="number" class="nxt-spacing-input nxt-spacing-mobile" value="{{ value_xs[ val ] }}" data-id="{{ val }}">
								<span class="nxt-spacing-label">{{{ data.choices[ val ] }}}</span>
							</li><# 
							}); #>
							<ul class="nxt-spacing-units-devices nxt-spacing-mobile-responsive-units">
								<#_.each( data.unit, function( key_unit ) { 
									unit_active = '';
									if ( xs_unit_val === key_unit ) { 
										unit_active = 'active';
									}
								#><li class="single-unit {{ unit_active }}" data-unit="{{ key_unit }}" >
									<span class="unit-text">{{{ key_unit }}}</span>
								</li><# 
								});#>
							</ul>
						</ul>
					</div>

					<div class="nxt-spacing-units-devices-wrap">
						<div class="nxt-spacing-unit-inner">
							<input type="hidden" class="nxt-spacing-unit-hidden nxt-spacing-desktop-unit" value="{{md_unit_val}}" data-device="md">
							<input type="hidden" class="nxt-spacing-unit-hidden nxt-spacing-tablet-unit" value="{{sm_unit_val}}" data-device="sm">
							<input type="hidden" class="nxt-spacing-unit-hidden nxt-spacing-mobile-unit" value="{{xs_unit_val}}" data-device="xs">
						</div>
						<ul class="nxt-resp-spacing-btns">
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
						<?php } ?>
						</ul>
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
endif;