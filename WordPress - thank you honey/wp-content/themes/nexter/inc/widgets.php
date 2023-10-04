<?php
/**
 * Widget and sidebars related functions
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! function_exists( 'nexter_widgets_register' ) ) {

	/**
	 * Register widget area.
	 */
	function nexter_widgets_register() {

		/**
		 * Register Sidebar 1
		 */
		register_sidebar( array(
			'name' => __( 'Sidebar 1', 'nexter' ),
			'id' => 'sidebar-1',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
		/**
		 * Register Sidebar 2
		 */
		register_sidebar( array(
			'name' => __( 'Sidebar 2', 'nexter' ),
			'id' => 'sidebar-2',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
		/**
		 * Register Sidebar 3
		 */
		register_sidebar( array(
			'name' => __( 'Sidebar 3', 'nexter' ),
			'id' => 'sidebar-3',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
		/**
		 * Register Sidebar 4
		 */
		register_sidebar( array(
			'name' => __( 'Sidebar 4', 'nexter' ),
			'id' => 'sidebar-4',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
		/**
		 * Register Sidebar 5
		 */
		register_sidebar( array(
			'name' => __( 'Sidebar 5', 'nexter' ),
			'id' => 'sidebar-5',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
	}
	add_action( 'widgets_init', 'nexter_widgets_register' );
}