<?php
/**
 * Loader Nexter Helper Function
 *
 * @package	Nexter
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Global Color Palette*/
function nxt_global_color_palette(){
	$globalPalettes = [
		'color1' => '#162d9e',
		'color2' => '#fc4032',
		'color3' => '#3A4F66',
		'color4' => '#192a3d',
		'color5' => '#e1e8ed',
		'color6' => '#f2f5f7',
		'color7' => '#FAFBFC',
		'color8' => '#ffffff',
	];
	$colors = [];
	
	if ( isset( $globalPalettes ) ) {
		$i = 1;
		foreach ( $globalPalettes as $key => $color ) {

			$colors[] = array(
				'name'  => __('Theme Color ', 'nexter') . $i,
				'slug'  => '--nxt-global-color-' . $i,
				'color' => 'var(--nxt-global-color-'.$i.')',
			);
			
			$i++;
		}
	}
	
	return $colors;
}

add_filter('nexter_theme_dynamic_css', 'nxt_global_color_palette_css', 10);
add_filter('nxt_gutenberg_dynamic_style_css', 'nxt_global_color_palette_css', 10);
function nxt_global_color_palette_css( $dynamic_css ){
	$colors = [
		'color1' => '#2872fa',
		'color2' => '#1559ed',
		'color3' => '#3A4F66',
		'color4' => '#192a3d',
		'color5' => '#e1e8ed',
		'color6' => '#f2f5f7',
		'color7' => '#FAFBFC',
		'color8' => '#ffffff',
	];
	if( !empty($colors) ){
		$i = 1;
		$css_output = ':root{';
		foreach($colors as $key => $val){
			$css_output .= '--nxt-global-color-'.$i.':'.$val.';';
			$i++;
		}
		$css_output .= '}';
		
		$ij = 1;
		foreach($colors as $key => $val){
			$css_output .= ':root .has---nxt-global-color-'.$ij.'-background-color, :root .has-nxt-global-color-'.$ij.'-background-color{background-color : var(--nxt-global-color-'.$ij.');}';
			$css_output .= ':root .has---nxt-global-color-'.$ij.'-color, :root .has-nxt-global-color-'.$ij.'-color, :root .has-nxt-global-color-'.$ij.'-color > .wp-block-navigation-item__content{color : var(--nxt-global-color-'.$ij.');}';
			$css_output .= ':root .has---nxt-global-color-'.$ij.'-border-color, :root .has-nxt-global-color-'.$ij.'-border-color{border-color : var(--nxt-global-color-'.$ij.');}';
			$ij++;
		}
		$dynamic_css .= nexter_minify_css_generate($css_output);
	}
	
	return $dynamic_css;
}

/**
 * Get Nexter Builder Posts List
 */
function nexter_builders_posts_list() {
    $args = array( 'post_type' => 'nxt_builder', 'post_status' => 'publish', 'posts_per_page' => -1 );
    $get_list_posts = new WP_Query( $args );	
	$array_list = array();
	if($get_list_posts){
		$array_list["none"] = '';
		if ( $get_list_posts->have_posts() ) {
			while ( $get_list_posts->have_posts() ) {
				
				$get_list_posts->the_post();
				$post = $get_list_posts->post;
					
				$array_list[$post->ID] = $post->post_title;
			}
		}
	}
	return $array_list;
}

/*
 * Get the content load 
 *
 * @since 1.0.0
 */
if( ! function_exists('nexter_content_load') ){
	
	function nexter_content_load( $post_id ) {
		
		if(!empty( $post_id ) && $post_id != 'none' ){
			$page_builder_base_instance = Nexter_Builder_Compatibility::get_instance();
			$page_builder_instance = $page_builder_base_instance->get_active_page_builder( $post_id );
			$page_builder_instance->render_content( $post_id );
		}
	}
}

/**
 * Get current post id
 */
if ( ! function_exists( 'nexter_get_post_id' ) ) {

	function nexter_get_post_id( $pass_post_id = '' ) {

		if ( Nexter_Customizer_Options::$post_id == null ) {
			global $post;

			$post_id = 0;
			if ( is_home() ) {
				$post_id = get_option( 'page_for_posts' );
			} elseif ( is_archive() ) {
				global $wp_query;
				$post_id = $wp_query->get_queried_object_id();
			} elseif ( isset( $post->ID ) && !is_search() && !is_category() ) {
				$post_id = $post->ID;
			}

			Nexter_Customizer_Options::$post_id = $post_id;
		}

		return apply_filters( 'nexter_get_post_id', Nexter_Customizer_Options::$post_id, $pass_post_id );
	}
}

/* Get Registered Sidebar List */
if ( ! function_exists( 'nexter_get_sidebar_list' ) ) {
	
	function nexter_get_sidebar_list() {
		$options=array();		
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			$options[ucwords( $sidebar['id'] )] = ucwords( $sidebar['name'] );
		}
		$options['custom'] = __( 'Custom Sidebar', 'nexter' );
		return $options;
	}	
}

/**
 * Nexter Get Theme Options
 */
if ( ! function_exists( 'nexter_get_option' ) ) {

	function nexter_get_option($option, $default = '', $deprecate = '') {

		if ( !empty($deprecate) ) {
			$default = $deprecate;
		}

		$nxt_theme_options = Nexter_Customizer_Options::get_options();

		$nxt_theme_options = apply_filters( 'nexter_get_theme_option_array', $nxt_theme_options, $option, $default );

		$value = ( isset( $nxt_theme_options[ $option ] ) && $nxt_theme_options[ $option ] !== '' ) ? $nxt_theme_options[ $option ] : $default;

		/**
		 * Filter nexter_get_option_{$option}
		 */
		return apply_filters( "nexter_get_option_{$option}", $value, $option, $default );
	}
}

/**
 * Get Array find value of key
 */
if ( ! function_exists( 'nexter_get_array_value_of_key' ) ){

	function nexter_get_array_value_of_key( $array, $key, $default = null ) {

		if ( ! is_array( $array ) && ! ( is_object( $array ) && $array instanceof ArrayAccess ) ) {
			return $default;
		}
		
		$value = '';
		if ( isset( $array[ $key ] ) ) {
			$value = $array[ $key ];
		}
		
		return empty( $value ) && $default !== null ? $default : $value;
	}

}

/**
 * Foreground Color
 */
if ( ! function_exists( 'nexter_get_foreground_color' ) ) {

	function nexter_get_foreground_color( $hex ) {


		if ( empty( $hex ) || $hex == 'transparent' || $hex == 'false' || $hex == '#' ) {
			return 'transparent';
		}

		$hex = str_replace( '#', '', $hex );

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r   = hexdec( substr( $hex, 0, 2 ) );
			$g   = hexdec( substr( $hex, 2, 2 ) );
			$b   = hexdec( substr( $hex, 4, 2 ) );
		}

		$hex = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;

		return 128 <= $hex ? '#333' : '#fff';
	}
}

/**
 * Convert HEX Color to RGBA Color
 */
if ( ! function_exists( 'nexter_hexa_to_rgba' ) ) {

	function nexter_hexa_to_rgba( $color, $opacity = false ) {

		$default = 'rgb(0,0,0)';

		if ( empty( $color ) ) {
			return $default;
		}

		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		if ( strlen( $color ) == 6 ) {
			$hexa = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hexa = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		$rgb = array_map( 'hexdec', $hexa );

		if ( $opacity ) {
			if ( 1 < abs( $opacity ) ) {
				$opacity = 1.0;
			}
			$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
		} else {
			$output = 'rgb(' . implode( ',', $rgb ) . ')';
		}

		return $output;
	}
}

/**
 * Get Responsive Device Css
 */
if ( ! function_exists( 'nexter_responsive_size_css' ) ) {

	function nexter_responsive_size_css( $value, $device = 'desktop', $default = '' ) {

		$font_size = '';

		if ( isset( $value[ $device ] ) && isset( $value[ $device . '-unit' ] ) ) {
			if ( $default != '' ) {
				$font_size = nexter_get_option_css_value( $value[ $device ], $value[ $device . '-unit' ], $default );
			} else {
				$font_size = nexter_get_font_size_css( $value[ $device ], $value[ $device . '-unit' ] );
			}
		} elseif ( is_numeric( $value ) ) {
			$font_size = nexter_get_option_css_value( $value );
		} else {
			$font_size = ( ! is_array( $value ) ) ? $value : '';
		}

		return $font_size;
	}
}

/**
 * Get CSS value
 */
if ( ! function_exists( 'nexter_get_option_css_value' ) ) {
	function nexter_get_option_css_value($value = '', $type = 'px', $default = '') {

		if ( empty($default) && empty($value) ) {
			return $value;
		}

		$css_value = '';
		if(!empty($type)){
			if($type == 'px' || $type == '%'){
				$value   = ( $value != '' ) ? $value : $default;
				$css_value = esc_attr( $value ) . $type;
			}else if($type == 'rem'){
				if ( is_numeric( $value ) || strpos( $value, 'px' ) ) {
						$value = intval( $value );
						$body_font_size = nexter_get_option( 'font-size-body' );
						if ( is_array( $body_font_size ) ) {
							$desktop_font_size = ( isset( $body_font_size['desktop'] ) && $body_font_size['desktop'] != '' ) ? $body_font_size['desktop'] : 15;
						} else {
							$desktop_font_size = ( $body_font_size != '' ) ? $body_font_size : 15;
						}

						if ( !empty($desktop_font_size) ) {
							$css_value = esc_attr( $value ) . 'px;font-size:' . ( esc_attr( $value ) / esc_attr( $desktop_font_size ) ) . $type;
						}
					} else {
						$css_value = esc_attr( $value );
					}
			}else if($type == 'font'){
				if ($value != 'inherit'){
					$css_value   = nexter_get_font_family_css( $value );
				} else if ($default != ''){
					$css_value = $default;
				}
			}else if($type == 'url'){
				$css_value = $type . '(' . esc_url( $value ) . ')';
			}else{
				$value = ( $value != '' ) ? $value : $default;
				if ( $value != '' ) {
					$css_value = esc_attr( $value ) . $type;
				}
			}
		}else{
			$value = ( $value != '' ) ? $value : $default;
			if ( $value != '' ) {
				$css_value = esc_attr( $value ) . $type;
			}
		}

		return $css_value;
	}
}

/**
 * Get Font Size Css
 */
if ( ! function_exists( 'nexter_get_font_size_css' ) ) {

	function nexter_get_font_size_css($value, $unit = 'px', $device = 'desktop') {

		if ( $value == '' || $value == 0 ) {
			return '';
		}

		$style = '';
		if(!empty($unit)){
			if($unit == 'em' || $unit == '%'){
				$style = esc_attr( $value ) . $unit;
			}else if($unit == 'px'){
				if ( is_numeric( $value ) || strpos( $value, 'px' ) ) {
					$value	= intval( $value );
					$style = esc_attr( $value ) . 'px';
				} else {
					$style = esc_attr( $value );
				}
			}
		}

		return $style;
	}
}

/**
 * Get Font family Css
 */
if ( ! function_exists( 'nexter_get_font_family_css' ) ) {

	function nexter_get_font_family_css( $value = '' ) {
		$default_fonts = Nexter_Font_Families_Listing::get_default_fonts_load();
		
		if ( isset( $default_fonts[ $value ] ) && isset( $default_fonts[ $value ]['fallback'] ) ) {
			$value .= ',' . $default_fonts[ $value ]['fallback'];
		}

		return $value;
	}
}

/**
 * Get Body Font Family
 */
if ( ! function_exists( 'nexter_get_body_fontfamily' ) ) {
	function nexter_get_body_fontfamily() {
		$font = nexter_get_option( 'body-font-family' );
		if ( $font == 'inherit' ) {
			$font = '-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen-Sans, Ubuntu, Cantarell, Helvetica Neue, sans-serif';
		}
		return apply_filters( 'nexter_get_body_fontfamily', $font );
	}
}

/**
 * Get Background Color/Image Options Css 
 */
if ( ! function_exists( 'nexter_get_background_css' ) ) {

	function nexter_get_background_css( $background ) {

		$bg_css = array();

		$bg_type = isset( $background['bg-type'] ) ? $background['bg-type'] : '';
		$bg_color = isset( $background['bg-color'] ) ? $background['bg-color'] : '';
		$bg_image   = isset( $background['bg-image'] ) ? $background['bg-image'] : '';

		if ( $bg_type === 'image' && !empty($bg_image)) {
			$bg_css = array( 'background-image' => 'url(' . esc_url( $bg_image ) . ')' );
			
			if ( isset( $background['bg-size'] ) ) {
				$bg_css['background-size'] = esc_attr( $background['bg-size'] );
			}
			
			if ( isset( $background['bg-position'] ) ) {
				$bg_css['background-position'] = esc_attr( $background['bg-position'] );
			}
			
			if ( isset( $background['bg-repeat'] ) ) {
				$bg_css['background-repeat'] = esc_attr( $background['bg-repeat'] );
			}

			if ( isset( $background['bg-attachment'] ) ) {
				$bg_css['background-attachment'] = esc_attr( $background['bg-attachment'] );
			}
			
		} elseif ( !empty($bg_color) && $bg_type === 'color' ) {
			$bg_css = array( 'background-color' => esc_attr( $bg_color ) );
		}

		return $bg_css;
	}
}

/**
 * Generate Parse Css of value
 */
if ( ! function_exists( 'nexter_generate_css' ) ) {
	function nexter_generate_css($css_data = array(), $min_media = '', $max_media = '') {

		$output = '';
		if ( is_array( $css_data ) && count( $css_data ) > 0 ) {

			foreach ( $css_data as $selector => $properties ) {

				if ( ! count( $properties ) ) {
					continue; 
				}
				
				$loop = 0;
				$generate_css   = $selector . '{';
				foreach ( $properties as $property => $value ) {

					if ( $value === '' ) {
						continue; 
					}
					$loop++;
					$generate_css .= $property .':'. $value .';';
				}

				$generate_css .= '}';

				if ( $loop > 0 ) {
					$output .= $generate_css;
				}
			}

			if ( $output != '' && ( $min_media !== '' || $max_media !== '' ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_and = '';
				
				if ( $min_media !== '' && $max_media !== '' ) {
					$media_and = ' and ';
				}
				if ( $min_media !== '' ) {
					$min_media_css = '(min-width:'. $min_media .'px)';
				}
				if ( $max_media !== '' ) {
					$max_media_css = '(max-width:'. $max_media .'px)';
				}
				
				$media_css .= $min_media_css . $media_and . $max_media_css . '{' . $output . '}';

				return $media_css;
			}
		}

		return $output;
	}
}

/**
 * Nexter Minify Css
 */
if ( ! function_exists( 'nexter_minify_css_generate' ) ) {
	function nexter_minify_css_generate( $css = '' ) {

		// Minify css for faster page loading
		if ( ! empty( $css ) ) {
			$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css ); //remove comment code css
			$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css ); //remove white space trim css
			$css = str_replace( ', ', ',', $css ); //remove space after comma
			$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css); //remove space after colon
			$css = preg_replace( '/;(?=\s*})/', '', $css); //remove last semi-colon css property
		}

		return $css;
	}
}

/**
 * Nexter Theme options Get post meta value
 */
if ( ! function_exists( 'nexter_get_option_meta' ) ) {

	function nexter_get_option_meta( $meta_key, $default = '', $meta = false, $post_id = '' ) {

		$post_id = ( !empty($post_id) ) ? $post_id : nexter_get_post_id();

		$value = nexter_get_option( $meta_key, $default );

		if ( is_singular() || ( is_home() && ! is_front_page() ) ) {

			$value = get_post_meta( $post_id, $meta_key, true );

			if ( empty( $value ) || $value == 'default' ) {

				if ( $meta == true ) {
					return false;
				}

				$value = nexter_get_option( $meta_key, $default );
			}
		}

		return apply_filters( "nexter_get_option_meta_{$meta_key}", $value, $default, $default );
	}
}

/*
 * Get Dimension Responsive Value
 */
if ( !function_exists( 'nexter_dimension_responsive_css' ) ){
	function nexter_dimension_responsive_css( $option, $alignment = '', $device = 'md', $default = '' ){

		if (isset($option[ $device ][ $alignment ]) && isset($option[ $device . '-unit' ])) {
			$dimensions = nexter_get_option_css_value( $option[ $device ][ $alignment ], $option[ $device . '-unit' ], $default );
		} else if (is_numeric( $option ) ) {
			$dimensions = nexter_get_option_css_value( $option );
		} else {
			$dimensions = ( ! is_array( $option ) ) ? $option : '';
		}

		return $dimensions;
	}
}