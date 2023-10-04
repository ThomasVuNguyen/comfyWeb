<?php
/**
 * Add Jupiter Post Options > Header meta options.
 *
 * @package JupiterX\Framework\Admin\Custom_Fields
 *
 * @since   1.0.0
 */

$key    = 'field_jupiterx_post_header';
$parent = 'group_jupiterx_post';

// Header tab.
acf_add_local_field( [
	'key'    => "{$key}_tab",
	'parent' => $parent,
	'label'  => __( 'Header', 'jupiterx-lite' ),
	'type'   => 'tab',
] );

acf_add_local_field( [
	'key'       => "{$key}_layout_builder_notice",
	'parent'    => $parent,
	'label'     => '',
	'name'      => '',
	'type'      => 'message',
	'message'   => sprintf(
		/* translators: field name & Meta box name */
		__( '%1$s <a class="jupiterx-acf-notice-link" href="%2$s" target="_blank"><strong>%3$s<span class=" dashicons dashicons-external"></span></strong></a> %4$s', 'jupiterx-lite' ),
		__( 'It’s recommended to use the new ', 'jupiterx-lite' ),
		esc_url( admin_url( 'admin.php?page=jupiterx#/layout-builder' ) ),
		__( 'Layout Builder', 'jupiterx-lite' ),
		__( 'feature.', 'jupiterx-lite' )
	),
	'new_lines' => 'wpautop',
	'esc_html'  => 0,
	'wrapper'   => [
		'class'     => 'jupiterx-meta-instruction',
	],
	'required'  => 0,
] );

// Header.
acf_add_local_field( [
	'key'           => $key,
	'parent'        => $parent,
	'label'         => __( 'Header', 'jupiterx-lite' ),
	'name'          => 'jupiterx_header',
	'type'          => 'true_false',
	'wrapper'       => [ 'width' => '50' ],
	'default_value' => 1,
	'ui'            => 1,
] );

// Overlap Content.
acf_add_local_field( [
	'key'               => "{$key}_overlap",
	'parent'            => $parent,
	'label'             => __( 'Overlap Content', 'jupiterx-lite' ),
	'name'              => 'jupiterx_header_overlap',
	'type'              => 'button_group',
	'conditional_logic' => [
		[
			[
				'field'    => $key,
				'operator' => '==',
				'value'    => '1',
			],
		],
	],
	'wrapper'           => [ 'width' => '50' ],
	'choices'           => [
		'global' => __( 'Global', 'jupiterx-lite' ),
		'1'      => __( 'Yes', 'jupiterx-lite' ),
		''       => __( 'No', 'jupiterx-lite' ),
	],
	'default_value'     => 'global',
] );

// Type.
acf_add_local_field( [
	'key'               => "{$key}_type",
	'parent'            => $parent,
	'label'             => __( 'Type', 'jupiterx-lite' ),
	'name'              => 'jupiterx_header_type',
	'type'              => 'button_group',
	'conditional_logic' => [
		[
			[
				'field'    => $key,
				'operator' => '==',
				'value'    => '1',
			],
		],
	],
	'wrapper'           => [ 'width' => '50' ],
	'choices'           => [
		'global'  => __( 'Global', 'jupiterx-lite' ),
		'_custom' => __( 'Custom', 'jupiterx-lite' ),
	],
	'default_value'     => 'global',
] );

// Template.
acf_add_local_field( [
	'key'               => "{$key}_header_template",
	'parent'            => $parent,
	'label'             => __( 'Template', 'jupiterx-lite' ),
	'name'              => 'jupiterx_header_template',
	'type'              => 'jupiterx_template',
	'conditional_logic' => [
		[
			[
				'field'    => $key,
				'operator' => '==',
				'value'    => '1',
			],
			[
				'field'    => "{$key}_type",
				'operator' => '==',
				'value'    => '_custom',
			],
		],
	],
	'wrapper'           => [ 'width' => '50' ],
	'choices'           => [
		'global' => __( 'Global', 'jupiterx-lite' ),
	],
	'ui'                => 1,
	'ajax'              => 1,
	'default_value'     => 'global',
	'template_type'     => 'header',
] );

// Divider.
acf_add_local_field( [
	'key'               => "{$key}_divider",
	'parent'            => $parent,
	'type'              => 'jupiterx-divider',
] );

// Behavior.
acf_add_local_field( [
	'key'               => "{$key}_behavior",
	'parent'            => $parent,
	'label'             => __( 'Behavior', 'jupiterx-lite' ),
	'name'              => 'jupiterx_header_behavior',
	'type'              => 'button_group',
	'conditional_logic' => [
		[
			[
				'field'    => $key,
				'operator' => '==',
				'value'    => '1',
			],
		],
	],
	'wrapper'           => [ 'width' => '50' ],
	'choices'           => [
		'global' => __( 'Global', 'jupiterx-lite' ),
		'static' => __( 'Static', 'jupiterx-lite' ),
		'fixed'  => __( 'Fixed', 'jupiterx-lite' ),
		'sticky' => __( 'Sticky', 'jupiterx-lite' ),
	],
	'default_value'     => 'global',
] );

// Sticky menu offset.
acf_add_local_field( [
	'key'               => "{$key}_sticky_offset",
	'parent'            => $parent,
	'label'             => __( 'Offset', 'jupiterx-lite' ),
	'name'              => 'jupiterx_header_offset',
	'type'              => 'number',
	'conditional_logic' => [
		[
			[
				'field'    => "{$key}_behavior",
				'operator' => '==',
				'value'    => 'sticky',
			],
		],
	],
	'wrapper'           => [ 'width' => '50' ],
	'default_value'     => 500,
	'required'          => 1,
] );

// Position.
acf_add_local_field( [
	'key'               => "{$key}_position",
	'parent'            => $parent,
	'label'             => __( 'Position', 'jupiterx-lite' ),
	'name'              => 'jupiterx_header_position',
	'type'              => 'button_group',
	'conditional_logic' => [
		[
			[
				'field'    => $key,
				'operator' => '==',
				'value'    => '1',
			],
			[
				'field'    => "{$key}_behavior",
				'operator' => '==',
				'value'    => 'fixed',
			],
		],
	],
	'wrapper'           => [ 'width' => '50' ],
	'choices'           => [
		'global'  => __( 'Global', 'jupiterx-lite' ),
		'top'     => __( 'Top', 'jupiterx-lite' ),
		'bottom'  => __( 'Bottom', 'jupiterx-lite' ),
	],
	'default_value'     => 'global',
] );

// Sticky template.
acf_add_local_field( [
	'key'               => "{$key}_sticky_template",
	'parent'            => $parent,
	'label'             => __( 'Sticky Template', 'jupiterx-lite' ),
	'name'              => 'jupiterx_header_sticky_template',
	'type'              => 'jupiterx_template',
	'conditional_logic' => [
		[
			[
				'field'    => $key,
				'operator' => '==',
				'value'    => '1',
			],
			[
				'field'    => "{$key}_type",
				'operator' => '==',
				'value'    => '_custom',
			],
			[
				'field'    => "{$key}_behavior",
				'operator' => '==',
				'value'    => 'sticky',
			],
		],
	],
	'wrapper'           => [ 'width' => '50' ],
	'choices'           => [
		'global' => __( 'Global', 'jupiterx-lite' ),
	],
	'ui'                => 1,
	'ajax'              => 1,
	'default_value'     => 'global',
	'template_type'     => 'header',
] );
