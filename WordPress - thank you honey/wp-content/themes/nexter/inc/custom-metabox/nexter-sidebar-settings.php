<?php
add_action( 'cmb2_admin_init', 'nexter_nxt_sidebar_settings' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function nexter_nxt_sidebar_settings() {
	$prefix ='nxt-';
	
	/* Start
	 * Sidebar Page/Posts Settings
	 */
	$sidebar_fields = new_cmb2_box( array(
		'id'         => 'nxt_sidebar_settings',
		'title'      => esc_html__('Sidebar Settings', 'nexter'),
		'object_types' => array( 'page','post' ),
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => true,
	) );
	
	$sidebar_fields->add_field( array(
        'name'             => esc_html__( 'Display Sidebar', 'nexter' ),
        'id'               => $prefix . 'post-page-sidebar',
        'desc'             => '',
        'type'				=> 'select',
		'default'			=> 'default',
		'options' => array(
			'default' => esc_html__('Customizer Default', 'nexter'),
			'no-sidebar' => esc_html__('No Sidebar', 'nexter'),
			'left-sidebar' => esc_html__('Left Sidebar', 'nexter'),
			'right-sidebar' => esc_html__('Right Sidebar', 'nexter'),
		),
    ) );
	global $pagenow;
	if ( 'widgets.php' !== $pagenow && 'customize.php' !== $pagenow ) {
		$sidebar_fields->add_field( array(
			'name'             => esc_html__( 'Display Sidebar', 'nexter' ),
			'id'               => $prefix . 'post-page-display-sidebar',
			'desc'             => '',
			'type'				=> 'select',
			'default'			=> 'default',
			'options' => nexter_get_sidebar_list(),
			'attributes' => array(
				'data-conditional-id'    => $prefix.'post-page-sidebar',
				'data-conditional-value' => wp_json_encode( array( 'left-sidebar','right-sidebar','custom' ) ),
			),
		) );
		$sidebar_fields->add_field( array(
			'name'    => esc_html__('Custom Sidebar','nexter'),
			'id'      => $prefix . 'post-page-custom-sidebar',
			'desc'    => '',
			'type'    => 'pw_select',
			'options' => nexter_builders_posts_list(),
			'attributes' => array(
				'data-conditional-id'    => $prefix.'post-page-display-sidebar',
				'data-conditional-value' => 'custom',
			),
		) );
	}
	/* End
	 * Sidebar Page/Posts Settings
	 */
}