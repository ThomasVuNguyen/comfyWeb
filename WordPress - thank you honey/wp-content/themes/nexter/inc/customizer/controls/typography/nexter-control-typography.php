<?php
/**
 * Customizer Control: Typography
 *
 * @package	Nexter
 * @since	1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Nexter_Control_Typography extends WP_Customize_Control {

	/**
	 * Used to connect controls
	 */
	public $connect = false;

	/**
	 * Used to connect variant controls
	 */
	public $variant = false;

	/**
	 * Used to set the mode controls
	 */
	public $mode = 'html';

	/**
	 * Set the default font inherit
	 */
	public $font_inherit = '';

	/**
	 * Set the default fonts
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->font_inherit         = __( 'Inherit', 'nexter' );
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control's content.
	 *
	 * @access protected
	 */
	protected function render_content() {
		
		if($this->type == 'nxt-font-family'){
			$this->render_font( $this->font_inherit );
		}else if($this->type == 'nxt-font-variant'){
			$this->render_font_variant( $this->font_inherit );
		}else if($this->type == 'nxt-font-weight'){
			$this->render_font_weight( $this->font_inherit );
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		
		$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		
		$typo_uri = NXT_CUSTOMIZER_CONTROL_URI . '/typography/';
		wp_enqueue_style( 'select2', $typo_uri . 'select2'. $minified .'.css', null );
		wp_enqueue_script( 'nexter-select2', $typo_uri . 'select2'. $minified .'.js', array( 'jquery' ), NXT_VERSION, true );
		wp_enqueue_script( 'nexter-typography', $typo_uri . 'typography'. $minified .'.js', array( 'jquery', 'customize-base' ), NXT_VERSION, true );
	}
	
	/**
	 * Render title and description for a control.
	 */
	protected function render_title_desc() {
		if ( ! empty( $this->label ) ) {
			echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}
		if ( ! empty( $this->description ) ) {
			echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}
	}

	/**
	 * Render a font family control
	 */
	protected function render_font( $default ) {
		echo '<label class="typo-font-family">';
			$this->render_title_desc();
		echo '</label>';
		echo '<select '.(($this->connect) ? 'data-field-control="' . esc_attr( $this->connect ) . '" data-inherit="' . esc_attr( $this->font_inherit ) . '"' : '').' '.(($this->variant) ? 'data-field-variant="' . esc_attr( $this->variant ) . '"  data-inherit="' . esc_attr( $this->font_inherit ) . '"' : '' ).' ';
		$this->link();
		echo '>';
			echo '<option value="inherit" ' . selected( 'inherit', $this->value(), false ) . '>' . esc_attr( $default ) . '</option>';
			echo '<optgroup label="'.esc_attr__('Other System Fonts','nexter').'">';

			foreach ( Nexter_Font_Families_Listing::get_default_fonts_load() as $name => $variants ) {
				echo '<option value="' . esc_attr( $name ) . '" ' . selected( $name, $this->value(), false ) . '>' . esc_attr( $name ) . '</option>';
			}
			echo '</optgroup>';
			
			$custom_font_load = Nexter_Font_Families_Listing::get_custom_fonts_load();
			if(!empty($custom_font_load)){
				echo '<optgroup label="'.esc_attr__('Custom Fonts','nexter').'">';

				foreach ( $custom_font_load as $name => $variants ) {
					echo '<option value="' . esc_attr( $name ) . '" ' . selected( $name, $this->value(), false ) . '>' . esc_attr( $name ) . '</option>';
				}
				echo '</optgroup>';
			}

			// Add Custom Font List Customizer
			do_action( 'nexter_customizer_font_list', $this->value() );

			echo '<optgroup label="'.esc_attr__('Google Fonts','nexter').'">';
			
			foreach ( Nexter_Font_Families_Listing::get_local_google_fonts_load() as $name => $single_font ) {
				$category = nexter_get_array_value_of_key( $single_font, '1' );
				echo '<option value="\'' . esc_attr( $name ) . '\', ' . esc_attr( $category ) . '" ' . selected( $name, $this->value(), false ) . '>' . esc_attr( $name ) . '</option>';
			}
			echo '</optgroup>';
		echo '</select>';
	}

	/**
	 * Render a font weight control
	 */
	protected function render_font_weight( $default ) {
		echo '<label class="typo-font-weight">';
			$this->render_title_desc();
		echo '</label>';
		echo '<select '.(($this->connect) ? 'data-field-control="' . esc_attr( $this->connect ) . '" data-inherit="' . esc_attr( $this->font_inherit ) . '"' : '').' ';
		$this->link();
		echo '>';
			if ( $this->value() == 'normal' ) {
				echo '<option value="normal" ' . selected( 'normal', $this->value(), false ) . '>' . esc_attr( $default ) . '</option>';
			} else {
				echo '<option value="inherit" ' . selected( 'inherit', $this->value(), false ) . '>' . esc_attr( $default ) . '</option>';
			}
			$selected       = '';
			$select_value = $this->value();
			$all_weights      = array(
				'100'       => __( '100', 'nexter' ),
				'100italic' => __( '100 Italic', 'nexter' ),
				'200'       => __( '200', 'nexter' ),
				'200italic' => __( '200 Italic', 'nexter' ),
				'300'       => __( '300', 'nexter' ),
				'300italic' => __( '300 Italic', 'nexter' ),
				'400'       => __( '400', 'nexter' ),
				'italic'    => __( '400 Italic', 'nexter' ),
				'500'       => __( '500', 'nexter' ),
				'500italic' => __( '500 Italic', 'nexter' ),
				'600'       => __( '600', 'nexter' ),
				'600italic' => __( '600 Italic', 'nexter' ),
				'700'       => __( '700', 'nexter' ),
				'700italic' => __( '700 Italic', 'nexter' ),
				'800'       => __( '800', 'nexter' ),
				'800italic' => __( '800 Italic', 'nexter' ),
				'900'       => __( '900', 'nexter' ),
				'900italic' => __( '900 Italic', 'nexter' ),
			);

			foreach ( $all_weights as $key => $value ) {
				if ( $key == $select_value ) {
					$selected = ' selected = "selected" ';
				} else {
					$selected = '';
				}
				// Exclude all italic values.
				if ( strpos( $key, 'italic' ) === false ) {
					echo '<option value="' . esc_attr( $key ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $value ) . '</option>';
				}
			}
		echo '</select>';
	}

	/**
	 * Render a font variant control
	 */
	protected function render_font_variant( $default ) {
		echo '<label class="typo-font-variant">';
			$this->render_title_desc();
		echo '</label>';
		
		echo '<select '.(($this->variant) ? 'data-field-variant="' . esc_attr( $this->variant ) . '"  data-inherit="' . esc_attr( $this->font_inherit ) . '"' : '' ).' ';
		$this->link();
		echo ' multiple >';
			$values = explode( ',', $this->value() );
			foreach ( $values as $key => $value ) {
				echo '<option value="' . esc_attr( $value ) . '" selected="selected" >' . esc_html( $value ) . '</option>';
			}
			echo '<input class="typo-variant-hidden-value" type="hidden" value="' . esc_attr( $this->value() ) . '">';
		echo '</select>';
	}
}