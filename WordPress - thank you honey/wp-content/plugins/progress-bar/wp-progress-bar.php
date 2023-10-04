<?php
/**
 * Plugin Name: Progress Bar
 * Plugin URI: https://github.com/jazzsequence/progress-bar
 * Description: A simple progress bar shortcode that can be styled with CSS.
 * Version: 2.2.3
 * Author: Chris Reynolds
 * Author URI: https://progressbar.jazzsequence.com/
 * License: GPL3
 */

/*
	Progress Bar
	Copyright (C) 2013-2023 | Chris Reynolds (chris@jazzsequence.com)

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	http://www.opensource.org/licenses/gpl-3.0.html
*/

require plugin_dir_path( __FILE__ ) . 'wppb-widget.php';
require plugin_dir_path( __FILE__ ) . 'functions.php';

/**
 * Declare the WPPB version.
 *
 * @return string
 */
function wppb_version() : string {
	return '2.2.3';
}

/**
 * Initializes the plugin by loading the CSS and JavaScript files.
 *
 * @since 0.1
 */
function wppb_init() {
	$wppb_path = plugin_dir_url( __FILE__ );
	$version = wppb_version();
	if ( ! is_admin() ) { // Don't load this if we're in the backend.
		wp_enqueue_style( 'wppb_css', $wppb_path . 'css/wppb.css', [], $version );
		wp_enqueue_script( 'wppb_animate', $wppb_path . 'js/wppb_animate.js', [ 'jquery' ], $version, true );
	}
}
add_action( 'init', 'wppb_init' );

/**
 * Progress Bar
 * simple shortcode that displays a progress bar
 *
 * @since 0.1
 * @param array $atts Array of shortcode attributes.
 *
 * Parameters:
 * - `progress` REQUIRED displays the actual progress bar in % or in x/y
 *    usage: [wppb progress=50] or [wppb progress=500/1000]
 * - `option` OPTIONAL calls various options. These can be user-input (uses CSS
 *            classes, so anything a user adds to their CSS could potentially
 *            be used as an option) or any of the pre-defined options/styles.
 *            Included options (as of 1.0.1): candystripes,
 *            animated-candystripes, red
 *    usage: [wppb progress=50 option="red candystripes"]
 *    usage: [wppb progress=50 option=animated-candystripes]
 * - `percent` OPTIONAL displays the percentage either on the bar itself, or
 *             after the progress bar, depending on which parameter is used.
 *             Options are 'after' and 'inside'.
 *    usage: [wppb progress=50 percent=after]
 * - `fullwidth` OPTIONAL if present (really, if this is in the shortcode at
 *               all), will stretch the progress bar to 100% width
 *    usage: [wppb progress=50 fullwidth=true]
 * - `color` OPTIONAL sets a color for the progress bar that overrides the
 *           default color. can be used as a starting color for `gradient`
 *    usage: [wppb progress=50 color=ff0000]
 *    usage: [wppb progress=50 color=ff0000 gradient=.1]
 * - `gradient` OPTIONAL (uses `color`) adds an end color that is the number of
 *              degrees offset from the `color` parameter and uses it for a
 *              gradient
 *              `color` parameter is REQUIRED for `gradient`
 * @uses wppb_check_pos
 * usage: [wppb progress=50 color=ff0000 gradient=.1]
 */
function wppb( $atts ) {
	// Set default values for shortcode attributes.
	$atts = shortcode_atts( [
		'progress' => '', // The progress in % or x/y.
		'option' => '', // What options you want to use (candystripes, animated-candystripes, red).
		'percent' => '', // Whether you want to display the percentage and where you want that to go (after, inside) (deprecated).
		'location' => '', // Replaces $percent.
		'fullwidth' => '', // Determines if the progress bar should be full width or not.
		'color' => '', // This will set a static color value for the progress bar, or a starting point for the gradient.
		'gradient' => '', // Will set a positive or negative end result based on the color, e.g. gradient=1 will be 100% brighter, gradient=-0.2 will be 20% darker.
		'endcolor' => '', // Defines an end color for a custom gradient.
		'text' => '', // Allows you to define custom text instead of a percent.
	], $atts );

	// Get the values of the shortcode attributes.
	$progress = isset( $atts['progress'] ) ? $atts['progress'] : '';
	$option = isset( $atts['option'] ) ? $atts['option'] : '';
	$percent = isset( $atts['percent'] ) ? $atts['percent'] : '';
	$location = isset( $atts['location'] ) ? $atts['location'] : '';
	$fullwidth = isset( $atts['fullwidth'] ) ? $atts['fullwidth'] : '';
	$color = isset( $atts['color'] ) ? $atts['color'] : '';
	$gradient = isset( $atts['gradient'] ) ? $atts['gradient'] : '';
	$endcolor = isset( $atts['endcolor'] ) ? $atts['endcolor'] : '';
	$text = isset( $atts['text'] ) ? $atts['text'] : '';

	// Check the progress for a slash, indicating a fraction instead of a percent.
	$wppb_check_results = wppb_check_pos( $progress );
	$width = $wppb_check_results[1];

	// If percent is set instead of location, set the location value to be the same as percent.
	if ( $percent !== '' && $location === '' ) {
		$location = $percent;
	} elseif ( $location !== '' ) {
		$location = $location;
	}

	// If there's custom text and no location has been defined, make the location inside.
	if ( $text !== '' && $location === '' ) {
		$location = 'inside';
	}

	// Sanitize any text content.
	if ( $text !== '' ) {
		$text = wp_strip_all_tags( $text );
	}

	// Figure out gradient stuff.
	$gradient_end = null;
	if ( $endcolor !== '' ) {
		$gradient_end = $endcolor;
	}
	if ( $gradient !== '' && $color !== '' ) { // If a color AND gradient is set (gradient won't work without the starting color).
		$gradient_end = wppb_brightness( $color, $gradient );
	}

	if ( $fullwidth !== '' ) {
		$fullwidth = true;
	}

	$progress = $wppb_check_results[0];

	// Get the progress bar.
	return wppb_get_progress_bar( $location, $text, $progress, $option, $width, $fullwidth, $color, $gradient, $gradient_end );
}
add_shortcode( 'wppb', 'wppb' );
