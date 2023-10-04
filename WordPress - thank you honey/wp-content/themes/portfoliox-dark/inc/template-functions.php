<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package PortfolioX Dark
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function portfoliox_dark_body_classes($classes)
{
	// dark color added class
	$classes[] = 'dark-mood';
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'portfoliox_dark_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function portfoliox_dark_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'portfoliox_dark_pingback_header');
