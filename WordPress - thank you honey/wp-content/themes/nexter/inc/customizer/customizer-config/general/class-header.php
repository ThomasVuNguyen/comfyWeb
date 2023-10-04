<?php
/**
 * Header Disable Options for Nexter Theme.
 *
 * @package     Nexter
 * @since       Nexter 1.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Site_Header' ) ) {

	class Nexter_Site_Header extends Nexter_Customizer_Config {

		/**
		 * Register Header Disable Customizer Configurations.
		 * @return Array Nexter Customizer Options with updated Options.
		 * @since 1.0.9
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			
			$options = array(
				/** Start
				 * Options Header
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-header-mode]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-header-mode',
					'priority'  => 5,
					'title'     => __( 'Header', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[nxt-header-disable-opt]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-header-mode',
					'priority'  => 10,
					'default' 	=> 'off',
					'title'     => __( 'Disable Header', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				/** End
				 * Options Header
				 */
			);

			return array_merge( $configurations, $options );
		}
	}
}

new Nexter_Site_Header;