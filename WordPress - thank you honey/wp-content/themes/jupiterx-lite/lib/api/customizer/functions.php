<?php
/**
 * Customizer functions.
 *
 * @package JupiterX\Framework\API\Customizer
 *
 * @since 1.11.0
 */

add_action( 'after_switch_theme', 'jupiterx_update_initial_mods' );
/**
 * Update initial theme mods to remove mods with integer key.
 *
 * @since 1.4.0
 *
 * @return void
 */
function jupiterx_update_initial_mods() {
	$mods = get_theme_mods();

	foreach ( $mods as $key => $value ) {
		if ( is_numeric( $key ) ) {
			unset( $mods[ $key ] );
		}
	}

	$theme_stylesheet_slug = get_option( 'stylesheet' );

	update_option( 'theme_mods_' . $theme_stylesheet_slug, $mods );
}
