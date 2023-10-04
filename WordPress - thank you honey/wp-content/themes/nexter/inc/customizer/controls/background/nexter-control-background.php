<?php
/**
 * Customizer Control: Background
 * Type : nxt-background
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! class_exists( 'Nexter_Control_Background' ) && class_exists( 'WP_Customize_Control' ) ) :

	class Nexter_Control_Background extends WP_Customize_Control {

		/**
		 * Control Type
		 */
		public $type = 'nxt-background';

		/**
		 * Refresh parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['default'] = $this->setting->default;
			if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			}
			
			$this->json['label'] = esc_html( $this->label );
			$this->json['value'] = $this->value();
			$this->json['link']  = $this->get_link();
			$this->json['id']    = $this->id;

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
			<# if ( data.label || data.description ) { #>
				<label>
					<# if ( data.label ) { #>
						<span class="customize-control-title">{{{ data.label }}}</span>
					<# } #>
					<# if ( data.description ) { #>
						<span class="description customize-control-description">{{{ data.description }}}</span>
					<# } #>
				</label>
			<# } #>
			<div class="nxt-control-background">
				<!--Background Type -->
				<div class="nxt-bg-type-inner nxt-d-flex nxt-align-center">
					<div class="nxt-bg-title"><?php esc_html_e( 'Background Type', 'nexter' ); ?></div>
					<div class="nxt-bg-type-list">
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="color" name="_customize-bg-{{{ data.id }}}-type123" id="{{ data.id }}type-color" <# if ( 'color' === data.value['bg-type'] ) { #> checked="checked" <# } #>>
							<label class="nxt-check-btn" for="{{ data.id }}type-color"><span class="dashicons dashicons-admin-customizer"></span></label>
						</input>
						
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="image" name="_customize-bg-{{{ data.id }}}-type123" id="{{ data.id }}type-image" <# if ( 'image' === data.value['bg-type'] ) { #> checked="checked" <# } #>>
							<label class="nxt-check-btn" for="{{ data.id }}type-image"><svg class="dashicons" viewBox="0 0 18 15" xmlns="http://www.w3.org/2000/svg"><path d="M16.083.263h-14.446c-.798 0-1.445.648-1.445 1.447v11.579c0 .8.646 1.447 1.445 1.447h14.446c.798 0 1.445-.648 1.445-1.447v-11.579c0-.8-.646-1.447-1.445-1.447zm-4.334 2.171c2.389 0 2.386 3.618 0 3.618-2.385 0-2.39-3.618 0-3.618zm-9.39 10.855l4.334-5.789 2.965 3.961 2.091-2.514 3.611 4.342h-13.001z" class="tpgb-svg-fill" fill-rule="nonzero"></path></svg></label>
						</input>
					</div>
				</div>
				
				<!-- background color -->
				<div class="nxt-bg-extra nxt-bg-color nxt-d-flex nxt-align-center <# if ( data.value['bg-type'] === 'color' ) { #><# } else { #> hidden <# } #>">
					<div class="nxt-bg-title"><?php esc_html_e( 'Background Color', 'nexter' ); ?></div>
					<input type="text" data-default-color="{{ data.default['bg-color'] }}" data-alpha="true" value="{{ data.value['bg-color'] }}" class="nxt-color-control"/>
				</div>
				
				<!-- background image -->
				<div class="nxt-bg-image <# if ( data.value['bg-type'] === 'image' ) { #><# } else { #> hidden <# } #>">
					<div class="nxt-bg-title"><?php esc_html_e( 'Background Image', 'nexter' ); ?></div>
					<div class="attachment-media-view bg-image-upload">
						<# if ( data.value['bg-image'] ) { #>
							<div class="thumbnail thumbnail-image"><img src="{{ data.value['bg-image'] }}" alt="" /></div>
						<# } else { #>
							<div class="placeholder"><?php esc_html_e( 'No File Selected', 'nexter' ); ?></div>
						<# } #>
						<div class="actions">
							<button class="button bg-image-upload-remove-button<# if ( ! data.value['bg-image'] ) { #> hidden <# } #>"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="trash-alt" class="bg-img-remove-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z"></path></svg></button>
							<button type="button" class="button bg-image-upload-button"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="upload" class="bg-img-upload-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M452 432c0 11-9 20-20 20s-20-9-20-20 9-20 20-20 20 9 20 20zm-84-20c-11 0-20 9-20 20s9 20 20 20 20-9 20-20-9-20-20-20zm144-48v104c0 24.3-19.7 44-44 44H44c-24.3 0-44-19.7-44-44V364c0-24.3 19.7-44 44-44h124v-99.3h-52.7c-35.6 0-53.4-43.1-28.3-68.3L227.7 11.7c15.6-15.6 40.9-15.6 56.6 0L425 152.4c25.2 25.2 7.3 68.3-28.3 68.3H344V320h124c24.3 0 44 19.7 44 44zM200 188.7V376c0 4.4 3.6 8 8 8h96c4.4 0 8-3.6 8-8V188.7h84.7c7.1 0 10.7-8.6 5.7-13.7L261.7 34.3c-3.1-3.1-8.2-3.1-11.3 0L109.7 175c-5 5-1.5 13.7 5.7 13.7H200zM480 364c0-6.6-5.4-12-12-12H344v24c0 22.1-17.9 40-40 40h-96c-22.1 0-40-17.9-40-40v-24H44c-6.6 0-12 5.4-12 12v104c0 6.6 5.4 12 12 12h424c6.6 0 12-5.4 12-12V364z"></path></svg></button>
						</div>
					</div>
				</div>
				
				<!-- background position -->
				<div class="nxt-bg-extra nxt-bg-position nxt-d-flex nxt-align-center <# if ( data.value['bg-type'] === 'image' && data.value['bg-image'] ) { #><# } else { #> hidden <# } #>">
					<div class="nxt-bg-title"><?php esc_html_e( 'Background Position', 'nexter' ); ?></div>
					<select {{{ data.inputAttrs }}}>
						<option value="left top"<# if ( 'left top' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Left Top', 'nexter' ); ?></option>
						<option value="left center"<# if ( 'left center' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Left Center', 'nexter' ); ?></option>
						<option value="left bottom"<# if ( 'left bottom' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Left Bottom', 'nexter' ); ?></option>
						
						<option value="center top"<# if ( 'center top' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Center Top', 'nexter' ); ?></option>
						<option value="center center"<# if ( 'center center' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Center Center', 'nexter' ); ?></option>
						<option value="center bottom"<# if ( 'center bottom' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Center Bottom', 'nexter' ); ?></option>
						
						<option value="right top"<# if ( 'right top' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Right Top', 'nexter' ); ?></option>
						<option value="right center"<# if ( 'right center' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Right Center', 'nexter' ); ?></option>
						<option value="right bottom"<# if ( 'right bottom' === data.value['bg-position'] ) { #> selected <# } #>><?php esc_html_e( 'Right Bottom', 'nexter' ); ?></option>
					</select>
				</div>
				
				<!-- background size -->
				<div class="nxt-bg-extra nxt-bg-size nxt-d-flex nxt-align-center <# if ( data.value['bg-type'] === 'image' && data.value['bg-image'] ) { #><# } else { #> hidden <# } #>">
					<div class="nxt-bg-title"><?php esc_html_e( 'Background Size', 'nexter' ); ?></div>
					<select {{{ data.inputAttrs }}}>
						<option value="auto"<# if ( 'auto' === data.value['bg-size'] ) { #> selected <# } #>><?php esc_html_e( 'Auto', 'nexter' ); ?></option>
						<option value="cover"<# if ( 'cover' === data.value['bg-size'] ) { #> selected <# } #>><?php esc_html_e( 'Cover', 'nexter' ); ?></option>
						<option value="contain"<# if ( 'contain' === data.value['bg-size'] ) { #> selected <# } #>><?php esc_html_e( 'Contain', 'nexter' ); ?></option>
						<option value="repeat-y"<# if ( 'repeat-y' === data.value['bg-size'] ) { #> selected <# } #>><?php esc_html_e( 'Repeat-Y', 'nexter' ); ?></option>
					</select>
				</div>
				
				<!-- background repeat -->
				<div class="nxt-bg-extra nxt-bg-repeat nxt-d-flex nxt-align-center <# if ( data.value['bg-type'] === 'image' && data.value['bg-image'] ) { #><# } else { #> hidden <# } #>">
					<div class="nxt-bg-title"><?php esc_html_e( 'Background Repeat', 'nexter' ); ?></div>
					<select {{{ data.inputAttrs }}}>
						<option value="no-repeat"<# if ( 'no-repeat' === data.value['bg-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'No Repeat', 'nexter' ); ?></option>
						<option value="repeat"<# if ( 'repeat' === data.value['bg-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'Repeat All', 'nexter' ); ?></option>
						<option value="repeat-x"<# if ( 'repeat-x' === data.value['bg-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'Repeat-X', 'nexter' ); ?></option>
						<option value="repeat-y"<# if ( 'repeat-y' === data.value['bg-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'Repeat-Y', 'nexter' ); ?></option>
					</select>
				</div>
				
				<!-- background attachment -->
				<div class="nxt-bg-extra nxt-bg-attachment nxt-d-flex nxt-align-center <# if ( data.value['bg-type'] === 'image' && data.value['bg-image'] ) { #><# } else { #> hidden <# } #>">
					<div class="nxt-bg-title"><?php esc_html_e( 'Background Attachment', 'nexter' ); ?></div>
					<select {{{ data.inputAttrs }}}>
						<option value="inherit"<# if ( 'inherit' === data.value['bg-attachment'] ) { #> selected <# } #>><?php esc_html_e( 'Inherit', 'nexter' ); ?></option>
						<option value="scroll"<# if ( 'scroll' === data.value['bg-attachment'] ) { #> selected <# } #>><?php esc_html_e( 'Scroll', 'nexter' ); ?></option>
						<option value="fixed"<# if ( 'fixed' === data.value['bg-attachment'] ) { #> selected <# } #>><?php esc_html_e( 'Fixed', 'nexter' ); ?></option>
					</select>
				</div>
				<input class="background-hidden-val" type="hidden" {{{ data.link }}}>
			<?php
		}

		/**
		 * Render the control's content.
		 */
		protected function render_content() {}
	}
endif;