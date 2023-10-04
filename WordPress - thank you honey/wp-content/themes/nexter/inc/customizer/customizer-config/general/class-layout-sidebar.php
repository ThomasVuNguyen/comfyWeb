<?php
/**
 * Sidebar Layout Options for Nexter Theme.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Nexter_Layout_SideBar' ) ) {

	class Nexter_Layout_SideBar extends Nexter_Customizer_Config {
		
		/**
		 * Register Sidebar Layout Customizer Configurations.
		 * @return Array Nexter Customizer Options with updated Options.
		 * @since 1.0.0
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$options = array(

				/** Start
				 * Options Layout/Sidebar
				 */
				array(
					'name'      => NXT_OPTIONS . '[heading-sidebar-opt]',
					'type'      => 'control',
					'control'   => 'nxt-heading',
					'section'   => 'section-layout-sidebar',
					'priority'  => 5,
					'title'     => __( 'Side Bar', 'nexter' ),
					'settings'  => array(),
					'separator' => false,
				),
				/*
				 * Default Whole Site Sidebar
				 */
				array(
					'name'     => NXT_OPTIONS . '[whole-site-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'default'  => 'no-sidebar',
					'priority' => 5,
					'title'    => __( 'Site Sidebar Layout', 'nexter' ),
					'choices'  => array(
						'no-sidebar'    => __( 'No Sidebar', 'nexter' ),
						'left-sidebar'  => __( 'Left Sidebar', 'nexter' ),
						'right-sidebar' => __( 'Right Sidebar', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[whole-site-display-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'default'  => 'Sidebar-1',
					'priority' => 5,
					'title'    => __( 'Display Sidebar', 'nexter' ),
					'choices'  => nexter_get_sidebar_list(),
					'conditional' => array( NXT_OPTIONS . '[whole-site-sidebar]', '!=', 'no-sidebar' ),
				),
				array(
					'name'     => NXT_OPTIONS . '[whole-site-custom-sidebar]',
					'default'  => 'none',
					'title'    => __( 'Custom Sidebar Sections', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'priority' => 15,
					'choices'  => nexter_builders_posts_list(),
					'conditional' => array( NXT_OPTIONS . '[whole-site-display-sidebar]', '==', 'custom' ),
				),
				/*
				 * Single Page Sidebar
				*/
				array(
					'name'     => NXT_OPTIONS . '[page-sidebar-divider]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'section'  => 'section-layout-sidebar',
					'priority' => 20,
					'settings' => array(),
				),				
				array(
					'name'     => NXT_OPTIONS . '[single-page-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'default'  => 'default',
					'priority' => 20,
					'title'    => __( 'Pages', 'nexter' ),
					'choices'  => array(
						'default'       => __( 'Default', 'nexter' ),
						'no-sidebar'    => __( 'No Sidebar', 'nexter' ),
						'left-sidebar'  => __( 'Left Sidebar', 'nexter' ),
						'right-sidebar' => __( 'Right Sidebar', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[single-page-display-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'default'  => 'Sidebar-1',
					'priority' => 20,
					'title'    => __( 'Display Sidebar', 'nexter' ),
					'choices'  => nexter_get_sidebar_list(),					
					'conditional' => array(
						'conditions' => array(
							array( NXT_OPTIONS . '[single-page-sidebar]', '!=', 'no-sidebar' ),
							array( NXT_OPTIONS . '[single-page-sidebar]', '!=', 'default' ),
						),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[single-page-custom-sidebar]',
					'default'  => 'none',
					'title'    => __( 'Custom Sidebar Sections', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'priority' => 20,
					'choices'  => nexter_builders_posts_list(),
					'conditional' => array( NXT_OPTIONS . '[single-page-display-sidebar]', '==', 'custom' ),
				),
				/*
				 * Single Post Sidebar
				*/
				array(
					'name'     => NXT_OPTIONS . '[single-post-sidebar-divider]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'section'  => 'section-layout-sidebar',
					'priority' => 25,
					'settings' => array(),
				),
				array(
					'name'     => NXT_OPTIONS . '[single-post-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => 'default',
					'section'  => 'section-layout-sidebar',
					'priority' => 25,
					'title'    => __( 'Blog Posts', 'nexter' ),
					'choices'  => array(
						'default'       => __( 'Default', 'nexter' ),
						'no-sidebar'    => __( 'No Sidebar', 'nexter' ),
						'left-sidebar'  => __( 'Left Sidebar', 'nexter' ),
						'right-sidebar' => __( 'Right Sidebar', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[single-post-display-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'default'  => 'Sidebar-1',
					'priority' => 25,
					'title'    => __( 'Display Sidebar', 'nexter' ),
					'choices'  => nexter_get_sidebar_list(),
					'conditional' => array(
						'conditions' => array(
							array( NXT_OPTIONS . '[single-post-sidebar]', '!=', 'no-sidebar' ),
							array( NXT_OPTIONS . '[single-post-sidebar]', '!=', 'default' ),
						),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[single-post-custom-sidebar]',
					'default'  => 'none',
					'title'    => __( 'Custom Sidebar Sections', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'priority' => 25,
					'choices'  => nexter_builders_posts_list(),
					'conditional' => array( NXT_OPTIONS . '[single-post-display-sidebar]', '==', 'custom' ),
				),
				/*
				 * Archive Sidebar
				*/
				array(
					'name'     => NXT_OPTIONS . '[archive-post-sidebar-divider]',
					'type'     => 'control',
					'control'  => 'nxt-heading',
					'section'  => 'section-layout-sidebar',
					'priority' => 30,
					'settings' => array(),
				),
				array(
					'name'     => NXT_OPTIONS . '[archive-post-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => 'default',
					'section'  => 'section-layout-sidebar',
					'priority' => 30,
					'title'    => __( 'Archives', 'nexter' ),
					'choices'  => array(
						'default'       => __( 'Default', 'nexter' ),
						'no-sidebar'    => __( 'No Sidebar', 'nexter' ),
						'left-sidebar'  => __( 'Left Sidebar', 'nexter' ),
						'right-sidebar' => __( 'Right Sidebar', 'nexter' ),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[archive-post-display-sidebar]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'default'  => 'Sidebar-1',
					'priority' => 30,
					'title'    => __( 'Display Sidebar', 'nexter' ),
					'choices'  => nexter_get_sidebar_list(),
					'conditional' => array(
						'conditions' => array(
							array( NXT_OPTIONS . '[archive-post-sidebar]', '!=', 'no-sidebar' ),
							array( NXT_OPTIONS . '[archive-post-sidebar]', '!=', 'default' ),
						),
					),
				),
				array(
					'name'     => NXT_OPTIONS . '[archive-post-custom-sidebar]',
					'default'  => 'none',
					'title'    => __( 'Custom Sidebar Sections', 'nexter' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-layout-sidebar',
					'priority' => 30,
					'choices'  => nexter_builders_posts_list(),
					'conditional' => array( NXT_OPTIONS . '[archive-post-display-sidebar]', '==', 'custom' ),
				),
			);

			return array_merge( $configurations, $options );
		}
	}
}

new Nexter_Layout_SideBar;