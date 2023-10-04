<?php
/**
 * Footer Disable Options for Nexter Theme.
 *
 * @package     Nexter
 * @since       Nexter 1.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Site_Footer' ) ) {

	class Nexter_Site_Footer extends Nexter_Customizer_Config {

		/**
		 * Register Footer Disable Customizer Configurations.
		 * @return Array Nexter Customizer Options with updated Options.
		 * @since 1.0.9
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			
			$options = array(
				/** Start
				 * Options Footer
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-footer-mode]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-footer-mode',
					'priority'  => 5,
					'title'     => __( 'Footer', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[nxt-footer-disable-opt]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-footer-mode',
					'priority'  => 10,
					'default' 	=> 'off',
					'title'     => __( 'Disable Footer', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				/** End
				 * Options Footer
				 */
			);

			return array_merge( $configurations, $options );
		}
	}
}

new Nexter_Site_Footer;