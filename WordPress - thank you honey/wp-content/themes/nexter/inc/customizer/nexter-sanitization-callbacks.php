<?php
/**
 * Customizer Sanitizations Callbacks
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Nexter Customizer Sanitizations Callbacks
 */
if ( ! class_exists( 'Nexter_Customizer_Sanitizes_Callbacks' ) ) {

	class Nexter_Customizer_Sanitizes_Callbacks {

		/**
		 * Instance
		 */
		private static $instance;

		/**
		 * initial
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() { }
		
		/**
		 * Integer Number value
		 */
		public static function sanitize_number_val( $val ) {
			return is_numeric( $val ) ? $val : '';
		}
		
		/**
		 * Number(min/max/step) Sanitize
		 */
		public static function sanitize_number( $val, $setting ) {

			$attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			if ( isset( $attrs ) ) {
				//Min value
				$attrs['min']  = isset( $attrs['min'] ) ? $attrs['min'] : 0;
				
				//Max value
				if ( isset( $attrs['max'] ) && $val > $attrs['max'] ) {
					$val = $attrs['max'];
				} elseif ( $val < $attrs['min'] ) {
					$val = $attrs['min'];
				}
				
				//Step value
				$attrs['step'] = isset( $attrs['step'] ) ? $attrs['step'] : 1;				
				$step = $val / $attrs['step'];

				$step = round( $step );

				$val = $step * $attrs['step'];

				$val = number_format( (float) $val, 2, '.', '' );
				
				if ( $val == (int) $val ) {
					$val = (int) $val;
				}
			}

			return is_numeric( $val ) ? $val : 0;
		}

		

		/**
		 * Responsive Dimensions Sanitize
		 */
		public static function sanitize_responsive_dimension( $val ) {

			$dimension = array(
				'md'	=> array(	'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
				'sm'	=> array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
				'xs'	=> array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
				'md-unit'	=> 'px',
				'sm-unit'	=> 'px',
				'xs-unit'	=> 'px',
			);

			if ( isset( $val['md'] ) ) {
				$dimension['md'] = array_map( function ( $value ) {
									return ( is_numeric( $value ) && $value >= 0 ) ? $value : '';
								},
								$val['md']
							);

				$dimension['sm'] = array_map( function ( $value ) {
									return ( is_numeric( $value ) && $value >= 0 ) ? $value : '';
								},
								$val['sm']
							);

				$dimension['xs'] = array_map( function ( $value ) {
									return ( is_numeric( $value ) && $value >= 0 ) ? $value : '';
								},
								$val['xs']
							);

				if ( isset( $val['md-unit'] ) ) {
					$dimension['md-unit'] = $val['md-unit'];
				}
				if ( isset( $val['sm-unit'] ) ) {
					$dimension['sm-unit'] = $val['sm-unit'];
				}
				if ( isset( $val['xs-unit'] ) ) {
					$dimension['xs-unit'] = $val['xs-unit'];
				}

				return $dimension;

			} else {
				foreach ( $val as $key => $value ) {
					$val[ $key ] = is_numeric( $val[ $key ] ) ? $val[ $key ] : '';
				}
				return $val;
			}

		}

		/**
		 * Responsive Slider Sanitize
		 */
		public static function sanitize_responsive_slider( $val, $setting ) {

			$attributes = [];
			if ( isset( $setting->manager->get_control( $setting->id )->input_attrs ) ) {
				$attributes = $setting->manager->get_control( $setting->id )->input_attrs;
			}

			$device = [ 'desktop' => '', 'tablet'  => '', 'mobile'  => '' ];
			
			if ( is_array( $val ) ) {
				$device['desktop'] = is_numeric( $val['desktop'] ) ? $val['desktop'] : '';
				$device['tablet']  = is_numeric( $val['tablet'] ) ? $val['tablet'] : '';
				$device['mobile']  = is_numeric( $val['mobile'] ) ? $val['mobile'] : '';
			} else {
				$device['desktop'] = is_numeric( $val ) ? $val : '';
			}

			foreach ( $device as $key => $value ) {
			
					$value              = isset( $attributes['min'] ) && ( ! empty( $value ) ) && ( $attributes['min'] > $value ) ? $attributes['min'] : $value;
					$value              = isset( $attributes['max'] ) && ( ! empty( $value ) ) && ( $attributes['max'] < $value ) ? $attributes['max'] : $value;
					
					$device[ $key ] = $value;
			}

			return $device;
		}

		/**
		 * Typography Sanitize
		 */
		public static function sanitize_responsive_typography( $val ) {

			$device = array(
				'desktop'      => '',
				'tablet'       => '',
				'mobile'       => '',
				'desktop-unit' => '',
				'tablet-unit'  => '',
				'mobile-unit'  => '',
			);
			if ( is_array( $val ) ) {
				$device['desktop']      = ( isset( $val['desktop'] ) && is_numeric( $val['desktop'] ) ) ? $val['desktop'] : '';
				$device['tablet']       = ( isset( $val['tablet'] ) && is_numeric( $val['tablet'] ) ) ? $val['tablet'] : '';
				$device['mobile']       = ( isset( $val['mobile'] ) && is_numeric( $val['mobile'] ) ) ? $val['mobile'] : '';
				$device['desktop-unit'] = ( isset( $val['desktop-unit'] ) && in_array( $val['desktop-unit'], array( '', 'px', 'em', 'rem', '%' ) ) ) ? $val['desktop-unit'] : 'px';
				$device['tablet-unit']  = ( isset( $val['tablet-unit'] ) && in_array( $val['tablet-unit'], array( '', 'px', 'em', 'rem', '%' ) ) ) ? $val['tablet-unit'] : 'px';
				$device['mobile-unit']  = ( isset( $val['mobile-unit'] ) && in_array( $val['mobile-unit'], array( '', 'px', 'em', 'rem', '%' ) ) ) ? $val['mobile-unit'] : 'px';
			} else {
				$device['desktop'] = is_numeric( $val ) ? $val : '';
			}
			return $device;
		}

		/**
		 * HEX Color Sanitize
		 */
		public static function sanitize_hex_color( $color ) {

			if ( empty( $color ) || is_array( $color ) ) {
				return '';
			}

			// 3 or 6 hex digits, or the empty string.
			if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
				return $color;
			}

			return '';
		}
		
		/**
		 * Checkbox Sanitize
		 */
		public static function sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && $checked == true ) ? true : false );
		}

		/**
		 * Rgba Color Sanitize
		 */
		public static function sanitize_alpha_rgba_color( $color ) {

			if ( empty( $color ) || is_array( $color ) ) {
				return '';
			}
			
			/* Hex sanitize */
			if ( false === strpos( $color, 'rgba' ) ) {
				return self::sanitize_hex_color( $color );
			}

			/* rgba sanitize */
			$color = str_replace( ' ', '', $color );
			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			
			return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
		}

		/**
		 * Select Multiple Choices Sanitize
		 */
		public static function sanitize_multi_choices( $input, $setting ) {

			// Get list of choices from the control
			$choices    = $setting->manager->get_control( $setting->id )->choices;
			$input_keys = $input;

			foreach ( $input_keys as $key => $value ) {
				if ( ! array_key_exists( $value, $choices ) ) {
					unset( $input[ $key ] );
				}
			}

			return ( is_array( $input ) ? $input : $setting->default );
		}

		/**
		 * Font Weight Sanitize
		 */
		public static function sanitize_font_weight( $input ) {

			$valid = array( 'normal', 'bold', '100', '200', '300', '400', '500', '600', '700', '800', '900' );

			if ( in_array( $input, $valid ) ) {
				return $input;
			} else {
				return 'normal';
			}
		}

		/**
		 * Font Variant Sanitize
		 */
		public static function sanitize_font_variant( $input ) {

			if ( is_array( $input ) ) {
				$input = implode( ',', $input );
			}
			return sanitize_text_field( $input );
		}

		/**
		 * Background Obj(array) Sanitize
		 */
		public static function sanitize_background( $bg_obj ) {

			$bg_array = array( 'bg-type' => '','bg-color' => '', 'bg-image' => '', 'bg-size' => 'auto', 'bg-position' => 'center center', 'bg-repeat' => 'repeat',   'bg-attachment' => 'scroll' );

			if ( is_array( $bg_obj ) ) {

				foreach ( $bg_array as $key => $value ) {

					if ( isset( $bg_obj[ $key ] ) ) {

						if ( $key === 'bg-image' ) {
							$bg_array[ $key ] = esc_url_raw( $bg_obj[ $key ] );
						} else {
							$bg_array[ $key ] = esc_attr( $bg_obj[ $key ] );
						}
					}
				}
			}

			return $bg_array;
		}

	}
}

Nexter_Customizer_Sanitizes_Callbacks::get_instance();