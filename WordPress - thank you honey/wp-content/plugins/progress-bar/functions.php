<?php
/**
 * WP Progress Bar Functions
 *
 * Helper functions in the global scope.
 *
 * @package WP_Progress_Bar
 */

/**
 * Brightness.
 * Calculates a brighter or darker color based on the hex value given.
 *
 * @since 1.1
 * @link http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/
 * @param string $hex REQUIRED the hex color value.
 * @param string $percent REQUIRED how much the offset should be.
 * Usage: wppb_brightness('ff0000','0.2').
 */
function wppb_brightness( $hex, $percent ) {
	// Work out if hash given.
	$hash = '';
	$rgb = $hex;
	if ( stristr( $hex, '#' ) ) {
		$hex = str_replace( '#', '', $hex );
		$hash = '#';
	}

	// Check if we actually have a hex value or if it's an rgb value.
	if ( false === strpos( $hex, 'rgb(' ) ) {
		// Hex to RGB.
		$rgb = [ hexdec( substr( $hex, 0, 2 ) ), hexdec( substr( $hex, 2, 2 ) ), hexdec( substr( $hex, 4, 2 ) ) ];
	} else {
		// Convert $rgb to an array of values.
		$rgb = explode( ',', str_replace( [ 'rgb(', ')' ], '', $hex ) );
	}

	// Calculate.
	for ( $i = 0; $i < 3; $i++ ) {
		// See if brighter or darker.
		if ( $percent > 0 ) {
			// Lighter.
			$rgb[ $i ] = round( $rgb[ $i ] * $percent ) + round( 255 * ( 1 - $percent ) );
		} else {
			// Darker.
			$positive_percent = $percent - ( $percent * 2 );
			$rgb[ $i ] = round( $rgb[ $i ] * $positive_percent );
		}
		// In case rounding up causes us to go to 256.
		if ( $rgb[ $i ] > 255 ) {
			$rgb[ $i ] = 255;
		}
	}

	// RBG to Hex.
	$hex = '';
	for ( $i = 0; $i < 3; $i++ ) {
		// Convert the decimal digit to hex.
		$hex_digit = dechex( $rgb[ $i ] );
		// Add a leading zero if necessary.
		if ( strlen( $hex_digit ) === 1 ) {
			$hex_digit = '0' . $hex_digit;
		}
		// Append to the hex string.
		$hex .= $hex_digit;
	}
	return $hash . $hex;
}

/**
 * WPPB Check position.
 * Does a check for a slash or a currency symbol and deals with them appropriately.
 * Originally added by [RavanH](https://github.com/RavanH) in 1.0.4
 * Abstracted to a function in 2.0.
 *
 * @since 2.0
 * @param string $progress The progress to check.
 * @return array An array containing both the progress and the width.
 */
function wppb_check_pos( $progress ) {
	$pos = strpos( $progress, '/' );
	if ( $pos === false ) {
		$width = $progress . '%';
		$progress = $progress . ' %';
	} else {
		/**
		 * Allow the currency symbol to be filetered.
		 * Defaults to $.
		 *
		 * @since 2.2.0
		 * @param string $currency The currency symbol.
		 *
		 * Usage:
		 * add_filter( 'wppb.currency_symbol' function( $currency_symbol ) { return '€'; } );
		 */
		$currency = apply_filters( 'wppb.currency_symbol', '$' );
		$has_currency_symbol = strpos( $progress, $currency );
		if ( $has_currency_symbol !== false ) {
			// If there's a currency symbol in the progress, it will break the math. Let's strip it out so we can add it back later.
			$progress = str_replace( $currency, '', $progress );
		}
		$xofy = explode( '/', $progress );
		if ( ! $xofy[1] ) {
			$xofy[1] = 100;
		}
		$percentage = $xofy[0] / $xofy[1] * 100;
		$width = $percentage . '%';
		if ( $has_currency_symbol === false ) {
			$progress = number_format_i18n( $xofy[0] ) . ' / ' . number_format_i18n( $xofy[1] );
		} else {
			// If there's a currency symbol in the progress, display it manually.
			$progress = $currency . number_format_i18n( $xofy[0] ) . ' / ' . $currency . number_format_i18n( $xofy[1] );
		}
	}
	return [ $progress, $width ]; // Pass both the progress and the width back.
}

/**
 * WPPB Get Progress Bar.
 * Gets all the parameters passed to the shortcode and constructs the progress bar.
 *
 * @param mixed $location - Inside, Outside, null (default: null).
 * @param mixed $text - Any custom text (default: null).
 * @param string $progress - The progress to display (required).
 * @param mixed $option - Any applicable options (default: null).
 * @param string $width - The width of the progress bar, based on $progress (required).
 * @param mixed $fullwidth - Any value (default: null).
 * @param mixed $color - Custom color for the progress bar (default: null).
 * @param mixed $gradient - Custom gradient value, in decimals (default: null).
 * @param mixed $gradient_end Gradient end color, based on the endcolor parameter or $gradient (default: null).
 * @since 2.0
 * @throws Exception If $progress or $width are empty.
 */
function wppb_get_progress_bar( $location = false, $text = false, $progress = '', $option = false, $width = '', $fullwidth = false, $color = false, $gradient = false, $gradient_end = false ) {
	// Sanitize user input.
	$location = sanitize_html_class( esc_attr( $location ) );
	$text = sanitize_text_field( esc_attr( $text ) );
	$width = floatval( $width );
	$fullwidth = sanitize_html_class( esc_attr( $fullwidth ) );
	$color = esc_attr( wppb_sanitize_color( $color ) );
	$gradient = esc_attr( wppb_sanitize_color( $gradient ) );
	$gradient_end = esc_attr( wppb_sanitize_color( $gradient_end ) );
	$option = esc_attr( wppb_sanitize_option( $option ) );

	// Throw an exception if $progress or $width are empty.
	try {
		$message = esc_html__( 'You must pass at least a progress value to wppb_get_progress_bar.', 'wp-progress-bar' );

		/*
		 * If $progress is empty, throw an exception. This is because this
		 * function was written poorly the first time around and had required
		 * parameters after optional ones. Changing now would break old
		 * implementations.
		 */
		if ( $progress === '' ) {
			throw new Exception( $message );
		}
	} catch ( Exception $e ) {
		// Display the message if an exception is thrown.
		return new WP_Error( 'progress_bar.exception', $e->getMessage() );
	}

	// Here's the HTML output of the progress bar.
	$wppb_output = "<div class=\"wppb-wrapper $location"; // Adding $location to the wrapper class, so I can set a width for the wrapper based on whether it's using div.wppb-wrapper.after or div.wppb-wrapper.inside or just div.wppb-wrapper.
	if ( $fullwidth ) {
		$wppb_output .= ' full';
	}
	$wppb_output .= '">';
	if ( $location && $text ) { // If $location is not empty and there's custom text, add this.
		$wppb_output .= "<div class=\"$location\">$text</div>";
	} elseif ( $location && ! $text ) { // If the $location is set but there's no custom text.
		$wppb_output .= "<div class=\"$location\">";
		$wppb_output .= $progress;
		$wppb_output .= '</div>';
	} elseif ( ! $location && $text ) { // If the location is not set, but there is custom text.
		$wppb_output .= "<div class=\"inside\">$text</div>";
	}
	$wppb_output .= '<div class="wppb-progress';
	if ( $fullwidth ) {
		$wppb_output .= ' full';
	} else {
		$wppb_output .= ' fixed';
	}
	$wppb_output .= '">';
	$wppb_output .= '<span';
	if ( $option ) {
		$wppb_output .= " class=\"{$option}\"";
	}
	if ( $color ) { // If color is set.
		$wppb_output .= " style=\"width: $width%; background: {$color};";
		if ( $gradient_end ) {
			$wppb_output .= "background: -moz-linear-gradient(top, {$color} 0%, $gradient_end 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,{$color}), color-stop(100%,$gradient_end)); background: -webkit-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -o-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -ms-linear-gradient(top, {$gradient} 0%,$gradient_end 100%); background: linear-gradient(top, {$color} 0%,$gradient_end 100%); \"";
		}
	} else {
		$wppb_output .= " style=\"width: $width%;";
	}
	if ( $gradient && $color ) {
		$wppb_output .= "background: -moz-linear-gradient(top, {$color} 0%, $gradient_end 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,{$color}), color-stop(100%,$gradient_end)); background: -webkit-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -o-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -ms-linear-gradient(top, {$gradient} 0%,$gradient_end 100%); background: linear-gradient(top, {$color} 0%,$gradient_end 100%); \"";
	} else {
		$wppb_output .= '"';
	}
	$wppb_output .= '><span></span></span>';
	$wppb_output .= '</div>';
	$wppb_output .= '</div>';
	// Now return the progress bar.
	return $wppb_output;
}

/**
 * WPPB Sanitize Color.
 * Sanitizes a color value and returns empty if a value is not a valid color.
 *
 * @since 2.2.2
 * @param string $color The color to sanitize.
 * @return string The sanitized color.
 */
function wppb_sanitize_color( $color = '' ) {
	if ( '' === $color ) {
		return $color;
	}

	// Remove whitespace.
	$color = trim( $color );

	// Compare $color against wppb_css_color_names to see if it's a valid CSS color name. If so, return it.
	if ( in_array( strtolower( $color ), wppb_css_color_names(), true ) ) {
		return $color;
	}

	// Check if $color contains a hexadecimal or rgb value. If neither, return an empty string..
	if ( false === strpos( $color, '#' ) && false === strpos( $color, 'rgb(' ) && false === strpos( $color, 'rgba(' ) ) {
		// If the string is not a valid hexadecimal value, return an empty string.
		if ( ! ctype_xdigit( $color ) && ( strlen( $color ) !== 3 || strlen( $color ) !== 6 ) ) {
			return '';
		}
	}

	// If $color contains a hex value, sanitize it.
	if ( false !== strpos( $color, '#' ) ) {
		$color = sanitize_hex_color( $color );
	}

	// If $color contains an rgb/rgba value, sanitize it.
	if ( false !== strpos( $color, 'rgb(' ) || false !== strpos( $color, 'rgba(' ) ) {
		$color = sanitize_text_field( $color );
	}

	// If $color is a hex, add a #.
	if ( false === strpos( $color, '#' ) && ctype_xdigit( $color ) ) {
		$color = '#' . $color;
	}

	// Return the sanitized color.
	return $color;
}

/**
 * WPPB Sanitize Option.
 * Sanitizes the option parameter.
 *
 * @since 2.2.2
 * @param string $option The option to sanitize.
 * @return string The sanitized option.
 */
function wppb_sanitize_option( string $option ) {
	// Break the option into an array separated by spaces.
	$option_array = explode( ' ', $option );

	// Loop through each item in the array and use sanitize_html_class to sanitize it.
	foreach ( $option_array as $key => $value ) {
		$option_array[ $key ] = sanitize_html_class( $value );
	}

	// Convert the array back into a string and return it.
	return implode( ' ', $option_array );
}

/**
 * Return an array of valid CSS color names.
 *
 * @since 2.2.2
 * @return array An array of valid CSS color names.
 */
function wppb_css_color_names() {
	return [
		'aliceblue',
		'antiquewhite',
		'aqua',
		'aquamarine',
		'azure',
		'beige',
		'bisque',
		'black',
		'blanchedalmond',
		'blue',
		'blueviolet',
		'brown',
		'burlywood',
		'cadetblue',
		'chartreuse',
		'chocolate',
		'coral',
		'cornflowerblue',
		'cornsilk',
		'crimson',
		'cyan',
		'darkblue',
		'darkcyan',
		'darkgoldenrod',
		'darkgray',
		'darkgreen',
		'darkkhaki',
		'darkmagenta',
		'darkolivegreen',
		'darkorange',
		'darkorchid',
		'darkred',
		'darksalmon',
		'darkseagreen',
		'darkslateblue',
		'darkslategray',
		'darkturquoise',
		'darkviolet',
		'deeppink',
		'deepskyblue',
		'dimgray',
		'dodgerblue',
		'feldspar',
		'firebrick',
		'floralwhite',
		'forestgreen',
		'fuchsia',
		'gainsboro',
		'ghostwhite',
		'gold',
		'goldenrod',
		'gray',
		'green',
		'greenyellow',
		'honeydew',
		'hotpink',
		'indianred ',
		'indigo ',
		'ivory',
		'khaki',
		'lavender',
		'lavenderblush',
		'lawngreen',
		'lemonchiffon',
		'lightblue',
		'lightcoral',
		'lightcyan',
		'lightgoldenrodyellow',
		'lightgrey',
		'lightgreen',
		'lightpink',
		'lightsalmon',
		'lightseagreen',
		'lightskyblue',
		'lightslateblue',
		'lightslategray',
		'lightsteelblue',
		'lightyellow',
		'lime',
		'limegreen',
		'linen',
		'magenta',
		'maroon',
		'mediumaquamarine',
		'mediumblue',
		'mediumorchid',
		'mediumpurple',
		'mediumseagreen',
		'mediumslateblue',
		'mediumspringgreen',
		'mediumturquoise',
		'mediumvioletred',
		'midnightblue',
		'mintcream',
		'mistyrose',
		'moccasin',
		'navajowhite',
		'navy',
		'oldlace',
		'olive',
		'olivedrab',
		'orange',
		'orangered',
		'orchid',
		'palegoldenrod',
		'palegreen',
		'paleturquoise',
		'palevioletred',
		'papayawhip',
		'peachpuff',
		'peru',
		'pink',
		'plum',
		'powderblue',
		'purple',
		'red',
		'rosybrown',
		'royalblue',
		'saddlebrown',
		'salmon',
		'sandybrown',
		'seagreen',
		'seashell',
		'sienna',
		'silver',
		'skyblue',
		'slateblue',
		'slategray',
		'snow',
		'springgreen',
		'steelblue',
		'tan',
		'teal',
		'thistle',
		'tomato',
		'turquoise',
		'violet',
		'violetred',
		'wheat',
		'white',
		'whitesmoke',
		'yellow',
		'yellowgreen',
	];
}
