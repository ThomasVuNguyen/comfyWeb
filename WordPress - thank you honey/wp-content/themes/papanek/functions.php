<?php

function papanek_fse_styles() {

    wp_enqueue_style(

        'fse-style',

        get_stylesheet_uri(),

        array(),

        wp_get_theme()->get( 'Version' )

    );

}

add_action( 'wp_enqueue_scripts', 'papanek_fse_styles' );


if ( ! function_exists( 'papanek_fse_setup' ) ) {

    function papanek_fse_setup() {

        add_theme_support( 'wp-block-styles' );

        add_editor_style( 'style.css' );

    }

}

add_action( 'after_setup_theme', 'papanek_fse_setup' );


remove_theme_support( 'core-block-patterns' );


add_filter( 'should_load_remote_block_patterns', '__return_false' );


function papanek_register_block_styles() {

    /* BLOCK: COVER */

    register_block_style( 'core/cover', array(

        'name'  	=> 'papanek-rounded-borders',

        'label' 	=> esc_html__( 'Rounded Borders', 'papanek' ),

    ) );

}

add_action( 'init', 'papanek_register_block_styles' );


function papanek_register_pattern_categories() {

    if ( function_exists( 'register_block_pattern_category' ) ) {

        register_block_pattern_category(

            'how-we-work',

            array(

                'label' => __( 'How We Work', 'papanek' ),

                'description' => __( 'Patterns about how we work', 'papanek' ),

            )

        );

        register_block_pattern_category(

            'full-page',

            array(

                'label' => __( 'Full Page', 'papanek' ),

                'description' => __( 'Full page patterns', 'papanek' ),

            )

        );

    }

}

add_action( 'init', 'papanek_register_pattern_categories' );