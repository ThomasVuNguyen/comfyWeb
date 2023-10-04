<?php
/**
 * Nexter Get Fonts Load Render
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Nexter Get Fonts Data
 */
final class Nexter_Get_Fonts {

	/**
	 * Get Load generate fonts.
	 */
	private static $fonts = array();

	/**
	 * Add fonts rendered load
	 */
	public static function include_font_rendered( $fontname, $weights = [] ) {

		if ( $fontname == 'inherit' ) {
			return;
		}
		
		if ( ! is_array( $weights ) ) {
			$weights = explode( ',', str_replace( 'italic', 'i', $weights ) );
		}

		if ( is_array( $weights ) ) {
			$search_key = array_search( 'inherit', $weights );
			if ( $search_key !== false ) {

				unset( $weights[ $search_key ] );

				if ( ! in_array( 400, $weights ) ) {
					$weights[] = 400;
				}
			}
		} else if ( $weights == 'inherit' ) {
			$weights = 400;
		}

		if ( isset( self::$fonts[ $fontname ] ) ) {
			foreach ( (array) $weights as $val ) {
				if ( ! in_array( $val, self::$fonts[ $fontname ]['variants'] ) ) {
					self::$fonts[ $fontname ]['variants'][] = $val;
				}
			}
		} else {
			self::$fonts[ $fontname ] = array( 'variants' => (array) $weights );
		}
	}

	/**
	 * Get Fonts
	 */
	public static function get_load_fonts() {
		
		$options_fonts = [ 'body-font', 's-blog-title-font', 's-post-meta-font' ];
			
		foreach($options_fonts as $font){
			$fontfamily  = nexter_get_option( $font.'-family' );
			$fontweight  = nexter_get_option( $font.'-weight' );
			$fontvariant = nexter_get_option( $font.'-variant' );

			self::include_font_rendered( $fontfamily, $fontweight );
			self::include_font_rendered( $fontfamily, $fontvariant );
		}
		
		// Render headings font.
		$font_loop = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
		foreach( $font_loop as $val ){
			$fontfamily = nexter_get_option( 'font-family-'.$val );
			$fontweight = nexter_get_option( 'font-weight-'.$val );
			self::include_font_rendered( $fontfamily, $fontweight );
		}
		
		return apply_filters( 'nexter_include_fonts', self::$fonts );
	}

	/**
	 * Google Font URL
	 * Combine multiple google font in one URL
	 *
	 * @link https://shellcreeper.com/?p=1476
	 * @return string
	 */
	public static function generate_google_fonts_url( $fonts, $subsets = array() ) {

		/* URL */
		$base_url  = 'https://fonts.googleapis.com/css';
		$font_args = array();
		$family    = array();

		$fonts = apply_filters( 'nexter_google_fonts_load', $fonts );

		/* Format Each Font Family in Array */
		foreach ( $fonts as $font_name => $font_weight ) {
			$font_name = str_replace( ' ', '+', $font_name );
			if ( ! empty( $font_weight ) ) {
				if ( is_array( $font_weight ) ) {
					$font_weight = implode( ',', $font_weight );
				}
				$font_family = explode( ',', $font_name );
				$font_family = str_replace( "'", '', nexter_get_array_value_of_key( $font_family, 0 ) );
				$family[]    = trim( $font_family . ':' . urlencode( trim( $font_weight ) ) );
			} else {
				$family[] = trim( $font_name );
			}
		}

		/* Only return URL if font family defined. */
		if ( ! empty( $family ) ) {

			/* Make Font Family a String */
			$family = implode( '|', $family );

			/* Add font family in args */
			$font_args['family'] = $family;

			/* Add font subsets in args */
			if ( ! empty( $subsets ) ) {

				/* format subsets to string */
				if ( is_array( $subsets ) ) {
					$subsets = implode( ',', $subsets );
				}

				$font_args['subset'] = urlencode( trim( $subsets ) );
			}

			$font_args['display'] = self::get_fonts_property_display();

			return add_query_arg( $font_args, $base_url );
		}

		return '';
	}
	
	public static function get_custom_fonts_face(){
		$nxt_ext = get_option( 'nexter_extra_ext_options' );

		$font_faces = '';
		//custom upload font load
		if( !empty($nxt_ext) && isset($nxt_ext['custom-upload-font']) && !empty($nxt_ext['custom-upload-font']['switch']) && !empty($nxt_ext['custom-upload-font']['values']) ){
			$font_data = [];
			$upload_font_list = $nxt_ext['custom-upload-font']['values'];
			foreach ( $upload_font_list as $fonts ) {
				foreach ( $fonts as $key => $val ) {
					//simple font
					if( !empty($val['simplefont']) && !empty($val['simplefont']['font_name']) ){
						$simple_font_variation = [];
						if(!empty($val['simplefont']['lists'])){
							foreach($val['simplefont']['lists'] as $key_variant => $val_variation){
								if( !empty($val_variation) && !empty($val_variation['id']) && !empty($val_variation['variation']) ){

									$font_name = $val['simplefont']['font_name'];
									$font_url = wp_get_attachment_url( $val_variation['id'] );
									if( !empty($font_url)){
										$font_data[$font_name]['type'] = 'simple';
										$font_data[$font_name]['weight'] = $val_variation['variation'];
										$font_data[$font_name]['font-style'] = 'normal';
										$font_data[$font_name]['url'] = $font_url;
									}
								}
								
							}
						}
					}
					if( !empty($val['variablefont']) && !empty($val['variablefont']['font_name']) ){
						$simple_font_variation = [];
						if(!empty($val['variablefont']['lists'])){
							foreach($val['variablefont']['lists'] as $key_variant => $val_variation){
								if( !empty($val_variation) && !empty($val_variation['id']) ){
									$font_name = $val['variablefont']['font_name'];
									$font_url = wp_get_attachment_url( $val_variation['id'] );
									if( !empty($font_url)){
										$font_data[$font_name]['type'] = 'variable';
										$font_data[$font_name]['weight'] = '100 900';
										$font_data[$font_name]['font-style'] = ($key_variant === 'italic') ? 'italic' : 'normal';
										$font_data[$font_name]['url'] = $font_url;
									}
								}
							}
						}
					}
				}
			}
			
			if(!empty($font_data)){
				foreach( $font_data as $font_name => $font_value){
					if(!empty( $font_value['url'] )){
						$format = self::check_format_font_url($font_value['url']);
						$font_faces .= '@font-face {';
						$font_faces .= 'font-family: ' . esc_html($font_name) . ';';
						$font_faces .= "font-style: " . esc_html($font_value['font-style']) . ";";
						$font_faces .= "font-weight: " . esc_attr($font_value['weight']) . ";";
						$font_faces .= "font-display: swap;";
						$font_faces .= "src: url('" . esc_url($font_value['url']) . "') format('" . $format . "');";
						$font_faces .= '}';
					}
				}
			}
		}
		return $font_faces;
	}

	/*
	 * Font Url check Format
	 * @since 1.1.0
	 */
	private static function check_format_font_url($url) {
		$array = [
			'woff2' => 'woff2',
			'ttf' => 'truetype'
		];

		$d = strrpos($url,".");
		$extension = ($d===false) ? "" : substr($url,$d+1);

		if (! isset($array[$extension])) {
			return $extension;
		}

		return $array[$extension];
	}

	/**
	 * Load Fonts wp_enqueue_style google font url
	 */
	public static function enqueue_load_fonts() {

		$font_list = apply_filters( 'nexter_enqueue_load_fonts', self::get_load_fonts() );

		$google_fonts = [];
		$font_subset  = [];

		$default_fonts = Nexter_Font_Families_Listing::get_default_fonts_load();
		$custom_fonts = Nexter_Font_Families_Listing::get_custom_fonts_load();

		foreach ( $font_list as $fontname => $font ) {
			if ( ! empty( $fontname ) && ! isset( $default_fonts[ $fontname ] ) && ! isset( $custom_fonts[ $fontname ] ) ) {

				$google_fonts[ $fontname ] = $font['variants'];

				$subset = apply_filters( 'nexter_font_subset', '', $fontname );
				if ( ! empty( $subset ) ) {
					$font_subset[] = $subset;
				}
			}
		}
		$gfont_url = self::generate_google_fonts_url( $google_fonts, $font_subset );
		
		wp_enqueue_style( 'nxt-google-fonts', $gfont_url, array(), NXT_VERSION, 'all' );
	}
	
	/**
	 * Get the value for google font property display
	 */
	public static function get_fonts_property_display() {
		return apply_filters( 'nexter_fonts_property_display', 'fallback' );
	}
}