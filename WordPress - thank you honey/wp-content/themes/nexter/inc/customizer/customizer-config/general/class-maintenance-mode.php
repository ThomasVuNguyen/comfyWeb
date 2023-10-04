<?php
/**
 * Maintenance Mode Options for Nexter Theme.
 *
 * @package     Nexter
 * @since       Nexter 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Site_Maintenance_Mode' ) ) {

	class Nexter_Site_Maintenance_Mode extends Nexter_Customizer_Config {

		/**
		 * Register Maintenance Mode Or Coming Soon Customizer Configurations.
		 * @return Array Nexter Customizer Options with updated Options.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			
			if ( ! function_exists( 'get_editable_roles' ) ) {
				require_once ABSPATH . 'wp-admin/includes/user.php';	// phpcs:ignore
			}
			$roles = get_editable_roles();
			$user_roles=array();
			foreach ( $roles as $slug => $data ) {
				$user_roles[ $slug ] = $data['name'];
			}
			$options = array(

				/** Start
				 * Options Maintenance Mode
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-maintenance-mode]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-maintenance-mode',
					'priority'  => 5,
					'title'     => __( 'Maintenance Mode', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				array(
					'name'      => NXT_OPTIONS . '[nxt-maintenance-mode-opt]',
					'type'      => 'control',
					'control'   => 'nxt-switcher',
					'section'   => 'section-maintenance-mode',
					'priority'  => 10,
					'default' 	=> 'off',
					'title'     => __( 'Enable Maintenance Mode', 'nexter' ),
					'choices'  => array(
						'off'	=> __( 'OFF', 'nexter' ),
						'on'	=> __( 'ON', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[nxt-maintenance-mode]',
					'default'  => 'maintenance',
					'title'    => __( 'Mode', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-maintenance-mode',
					'priority' => 12,
					'choices'  => array(
						'maintenance'	=> __( 'Maintenance Mode', 'nexter' ),
						'coming_soon'	=> __( 'Coming Soon', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[nxt-maintenance-mode-opt]', '==', 'on' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[nxt-maintenance-access]',
					'default'  => 'logged_in',
					'title'    => __( 'Who Can Access', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-maintenance-mode',
					'priority' => 15,
					'choices'  => array(
						'logged_in'	=> __( 'Logged In', 'nexter' ),
						'custom'	=> __( 'Custom', 'nexter' ),
					),
					'conditional' => array( NXT_OPTIONS . '[nxt-maintenance-mode-opt]', '==', 'on' ),
				),
				array(
					'name'      => NXT_OPTIONS . '[nxt-maintenance-access-custom]',
					'type'      => 'control',
					'control'   => 'nxt-multi-checkbox',
					'section'   => 'section-maintenance-mode',
					'priority'  => 16,
					'default' 	=> 'off',
					'title'     => __( 'Exclude User Roles', 'nexter' ),
					'choices' => $user_roles,
					'conditional' => array( NXT_OPTIONS . '[nxt-maintenance-access]', '==', 'custom' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[nxt-maintenance-template]',
					'default'  => 'none',
					'title'    => __( 'Select Template', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-maintenance-mode',
					'priority' => 25,
					'choices'  => nexter_builders_posts_list(),
					'conditional' => array( NXT_OPTIONS . '[nxt-maintenance-mode-opt]', '==', 'on' ),
				),
			);

			return array_merge( $configurations, $options );
		}
	}
}

new Nexter_Site_Maintenance_Mode;