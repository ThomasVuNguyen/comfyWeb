<?php
/**
 * Add Jupiter User meta options.
 *
 * @package JupiterX\Framework\Admin\Custom_Fields
 *
 * @since   1.0.0
 */

acf_add_local_field_group( [
	'key'      => 'group_jupiterx_user',
	'title'    => __( 'Social Networks', 'jupiterx-lite' ),
	'location' => [
		[
			[
				'param' => 'user_form',
				'operator' => '==',
				'value' => 'edit',
			],
		],
	],
] );

// Email.
acf_add_local_field( [
	'key'           => 'field_jupiterx_user_email',
	'parent'        => 'group_jupiterx_user',
	'label'         => __( 'Email', 'jupiterx-lite' ),
	'name'          => 'jupiterx_user_email',
	'type'          => 'true_false',
	'message'       => __( 'Show Email icon', 'jupiterx-lite' ),
	'default_value' => true,
] );

// Facebook.
acf_add_local_field( [
	'key'         => 'field_jupiterx_user_facebook',
	'parent'      => 'group_jupiterx_user',
	'label'       => __( 'Facebook', 'jupiterx-lite' ),
	'name'        => 'jupiterx_user_facebook',
	'type'        => 'text',
	'placeholder' => 'https://www.facebook.com/username',
] );

// Twitter.
acf_add_local_field( [
	'key'         => 'field_jupiterx_user_twitter',
	'parent'      => 'group_jupiterx_user',
	'label'       => __( 'Twitter', 'jupiterx-lite' ),
	'name'        => 'jupiterx_user_twitter',
	'type'        => 'text',
	'placeholder' => 'https://twitter.com/username',
] );
