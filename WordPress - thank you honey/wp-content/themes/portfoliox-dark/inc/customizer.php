<?php

/**
 * PortfolioX Dark Theme Customizer
 *
 * @package PortfolioX Dark
 */



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function portfoliox_dark_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    //select sanitization function
    function portfoliox_dark_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
    function portfoliox_dark_sanitize_image($file, $setting)
    {
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon'
        );
        //check file type from file name
        $file_ext = wp_check_filetype($file, $mimes);
        //if file has a valid mime type return it, otherwise return default
        return ($file_ext['ext'] ? $file : $setting->default);
    }

    $wp_customize->add_setting('portfoliox_dark_site_tagline_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_site_tagline_show', array(
        'label'      => __('Hide Site Tagline Only? ', 'portfoliox-dark'),
        'section'    => 'title_tagline',
        'settings'   => 'portfoliox_dark_site_tagline_show',
        'type'       => 'checkbox',

    ));

    $wp_customize->add_panel('portfoliox_dark_settings', array(
        'priority'       => 50,
        'title'          => __('PortfolioX Dark Theme settings', 'portfoliox-dark'),
        'description'    => __('All PortfolioX dark theme settings', 'portfoliox-dark'),
    ));
    $wp_customize->add_section('portfoliox_dark_header', array(
        'title' => __('PortfolioX Header Settings', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'description'     => __('PortfolioX dark theme header settings', 'portfoliox-dark'),
        'panel'    => 'portfoliox_dark_settings',

    ));
    $wp_customize->add_setting('portfoliox_dark_main_menu_style', array(
        'default'        => 'style1',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_dark_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_main_menu_style', array(
        'label'      => __('Main Menu Style', 'portfoliox-dark'),
        'description' => __('You can set the menu style one or two. ', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_header',
        'settings'   => 'portfoliox_dark_main_menu_style',
        'type'       => 'select',
        'choices'    => array(
            'style1' => __('Style One', 'portfoliox-dark'),
            'style2' => __('Style Two', 'portfoliox-dark'),
        ),
    ));

    //portfoliox Home intro
    $wp_customize->add_section('portfoliox_dark_intro', array(
        'title' => __('Portfolio Intro Settings', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Portfoli profile Intro Settings', 'portfoliox-dark'),
        'panel'    => 'portfoliox_dark_settings',

    ));
    $wp_customize->add_setting('portfoliox_dark_intro_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  1,
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_intro_show', array(
        'label'      => __('Show Home Intro? ', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_intro_show',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('portfoliox_dark_intro_img', array(
        'capability'        => 'edit_theme_options',
        'default'           => get_template_directory_uri() . '/assets/img/hero.png',
        'sanitize_callback' => 'portfoliox_dark_sanitize_image',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'portfoliox_dark_intro_img',
        array(
            'label'    => __('Upload Profile Image', 'portfoliox-dark'),
            'description'    => __('Image size should be 450px width & 460px height for better view.', 'portfoliox-dark'),
            'section'  => 'portfoliox_dark_intro',
            'settings' => 'portfoliox_dark_intro_img',
        )
    ));
    $wp_customize->add_setting('portfoliox_dark_intro_subtitle', array(
        'default' => __('WELCOME TO MY WORLD', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_intro_subtitle', array(
        'label'      => __('Intro Subtitle', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_intro_subtitle',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfoliox_dark_intro_title', array(
        'default' => __('Hi, I\'m Jone Doe', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_intro_title', array(
        'label'      => __('Intro Title', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_intro_title',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfoliox_dark_intro_designation', array(
        'default' => __('a Designer', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_intro_designation', array(
        'label'      => __('Designation', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_intro_designation',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfoliox_dark_intro_desc', array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_intro_desc', array(
        'label'      => __('Intro Description', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_intro_desc',
        'type'       => 'textarea',
    ));
    $wp_customize->add_setting('portfoliox_dark_btn_text_one', array(
        'default' => __('Hire me', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('portfoliox_dark_btn_text_one', array(
        'label'      => __('Button one text', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_btn_text_one',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('portfoliox_dark_btn_url_one', array(
        'default' => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_btn_url_one', array(
        'label'      => __('Button one url', 'portfoliox-dark'),
        'description'      => __('Keep url empty for hide this button', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_btn_url_one',
        'type'       => 'url',
    ));
    $wp_customize->add_setting('portfoliox_dark_btn_text_two', array(
        'default'     => __('Download CV', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('portfoliox_dark_btn_text_two', array(
        'label'      => __('Button two text', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_btn_text_two',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('portfoliox_dark_btn_url_two', array(
        'default' => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_btn_url_two', array(
        'label'      => __('Button two url', 'portfoliox-dark'),
        'description'      => __('Keep url empty for hide this button', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_intro',
        'settings'   => 'portfoliox_dark_btn_url_two',
        'type'       => 'text',
    ));

    //portfoliox blog settings
    $wp_customize->add_section('portfoliox_dark_blog', array(
        'title' => __('PortfolioX Blog Settings', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'description'     => __('PortfolioX dark theme blog settings', 'portfoliox-dark'),
        'panel'    => 'portfoliox_dark_settings',

    ));
    $wp_customize->add_setting('portfoliox_dark_blog_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_dark_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_blog_container', array(
        'label'      => __('Container type', 'portfoliox-dark'),
        'description' => __('You can set standard container or full width container. ', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_blog',
        'settings'   => 'portfoliox_dark_blog_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'portfoliox-dark'),
            'container-fluid' => __('Full width Container', 'portfoliox-dark'),
        ),
    ));
    $wp_customize->add_setting('portfoliox_dark_blog_layout', array(
        'default'        => 'fullwidth',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_dark_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_blog_layout', array(
        'label'      => __('Select Blog Layout', 'portfoliox-dark'),
        'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_blog',
        'settings'   => 'portfoliox_dark_blog_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'portfoliox-dark'),
            'leftside' => __('Left Sidebar', 'portfoliox-dark'),
            'fullwidth' => __('No Sidebar', 'portfoliox-dark'),
        ),
    ));
    $wp_customize->add_setting('portfoliox_dark_blog_style', array(
        'default'        => 'list',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_dark_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_blog_style', array(
        'label'      => __('Select Blog Style', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_blog',
        'settings'   => 'portfoliox_dark_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'grid' => __('Grid Style', 'portfoliox-dark'),
            'list' => __('List Style', 'portfoliox-dark'),
            'classic' => __('Classic Style', 'portfoliox-dark'),
        ),
    ));
    //portfoliox page settings
    $wp_customize->add_section('portfoliox_dark_page', array(
        'title' => __('PortfolioX Page Settings', 'portfoliox-dark'),
        'capability'     => 'edit_theme_options',
        'description'     => __('PortfolioX dark theme blog settings', 'portfoliox-dark'),
        'panel'    => 'portfoliox_dark_settings',

    ));
    $wp_customize->add_setting('portfoliox_dark_page_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_dark_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_page_container', array(
        'label'      => __('Page Container type', 'portfoliox-dark'),
        'description' => __('You can set standard container or full width container for page. ', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_page',
        'settings'   => 'portfoliox_dark_page_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'portfoliox-dark'),
            'container-fluid' => __('Full width Container', 'portfoliox-dark'),
        ),
    ));
    $wp_customize->add_setting('portfoliox_dark_page_header', array(
        'default'        => 'show',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfoliox_dark_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfoliox_dark_page_header', array(
        'label'      => __('Show Page header', 'portfoliox-dark'),
        'section'    => 'portfoliox_dark_page',
        'settings'   => 'portfoliox_dark_page_header',
        'type'       => 'select',
        'choices'    => array(
            'show' => __('Show all pages', 'portfoliox-dark'),
            'hide-home' => __('Hide Only Front Page', 'portfoliox-dark'),
            'hide' => __('Hide All Pages', 'portfoliox-dark'),
        ),
    ));




    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'portfoliox_dark_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'portfoliox_dark_customize_partial_blogdescription',
            )
        );
    }
}
add_action('customize_register', 'portfoliox_dark_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function portfoliox_dark_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function portfoliox_dark_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfoliox_dark_customize_preview_js()
{
    wp_enqueue_script('portfoliox-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), PORTFOLIOX_VERSION, true);
}
add_action('customize_preview_init', 'portfoliox_dark_customize_preview_js');
