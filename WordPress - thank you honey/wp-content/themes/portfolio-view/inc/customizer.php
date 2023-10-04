<?php

/**
 * Portfolio View Theme Customizer
 *
 * @package Portfolio View
 */


// adctive call back function for header social
if (!function_exists('portfolio_view_header_social_callback')) :
	function portfolio_view_header_social_callback()
	{
		if (get_theme_mod('portfolio_view_header_social_show') == 1) {
			return true;
		} else {
			return false;
		}
	}
endif;

// adctive call back function for header social
if (!function_exists('portfolio_view_menubar_callback')) :
	function portfolio_view_menubar_callback()
	{
		if (get_theme_mod('portfolio_view_menubar_show') == 1) {
			return true;
		} else {
			return false;
		}
	}
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function portfolio_view_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	//select sanitization function
	function portfolio_view_sanitize_select($input, $setting)
	{
		$input = sanitize_key($input);
		$choices = $setting->manager->get_control($setting->id)->choices;
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
	function portfolio_view_sanitize_image($file, $setting)
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

	$wp_customize->add_setting('portfolio_view_hide_tagline', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  ' ',
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_hide_tagline', array(
		'label'      => __('Hide Site Tagline?', 'portfolio-view'),
		'section'    => 'title_tagline',
		'settings'   => 'portfolio_view_hide_tagline',
		'type'       => 'checkbox',
	));

	$wp_customize->add_panel('portfolio_view_settings', array(
		'priority'       => 50,
		'title'          => __('Portfolio View Theme settings', 'portfolio-view'),
		'description'    => __('All Portfolio View theme settings', 'portfolio-view'),
	));
	$wp_customize->add_section('portfolio_view_header', array(
		'title' => __('Portfolio View Header Settings', 'portfolio-view'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Portfolio View theme header settings', 'portfolio-view'),
		'panel'    => 'portfolio_view_settings',

	));

	// Header Menu bar

	$wp_customize->add_setting('portfolio_view_menubar_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_menubar_show', array(
		'label'      => __('Show Menubar Section?', 'portfolio-view'),
		'section'    => 'portfolio_view_header',
		'settings'   => 'portfolio_view_menubar_show',
		'type'       => 'checkbox',
	));

	$wp_customize->add_setting('portfolio_view_menubarlogo_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_menubarlogo_show', array(
		'label'      => __('Show Menubar Logo?', 'portfolio-view'),
		'section'    => 'portfolio_view_header',
		'settings'   => 'portfolio_view_menubarlogo_show',
		'type'       => 'checkbox',
		'active_callback' => 'portfolio_view_menubar_callback',

	));
	$wp_customize->add_setting('portfolio_view_mainmenu_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_mainmenu_show', array(
		'label'      => __('Show Main Menu?', 'portfolio-view'),
		'section'    => 'portfolio_view_header',
		'settings'   => 'portfolio_view_mainmenu_show',
		'type'       => 'checkbox',
		'active_callback' => 'portfolio_view_menubar_callback',

	));
	$wp_customize->add_setting('portfolio_view_menusearch_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_menusearch_show', array(
		'label'      => __('Show Menubar Search Icon?', 'portfolio-view'),
		'section'    => 'portfolio_view_header',
		'settings'   => 'portfolio_view_menusearch_show',
		'type'       => 'checkbox',
		'active_callback' => 'portfolio_view_menubar_callback',
	));

	//Portfolio View Home intro
	$wp_customize->add_section('portfolio_view_intro', array(
		'title' => __('Agency Intro Settings', 'portfolio-view'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Agency Intro section settings', 'portfolio-view'),
		'panel'    => 'portfolio_view_settings',
	));
	$wp_customize->add_setting('portfolio_view_intro_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport'     => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_intro_show', array(
		'label'      => __('Show Agency Intro? ', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_intro_show',
		'type'       => 'checkbox',
	));
	$wp_customize->add_setting('portfolio_view_intro_img', array(
		'capability'        => 'edit_theme_options',
		'default'           => get_template_directory_uri() . '/assets/img/man.png',
		'sanitize_callback' => 'portfolio_view_sanitize_image',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'portfolio_view_intro_img',
		array(
			'label'    => __('Upload Profile Image', 'portfolio-view'),
			'description'    => __('Image size should be 450px width & 460px height for better view.', 'portfolio-view'),
			'section'  => 'portfolio_view_intro',
			'settings' => 'portfolio_view_intro_img',
		)
	));
	$wp_customize->add_setting('portfolio_view_intro_subtitle', array(
		'default' => __('Hello, I\'m James Smith', 'portfolio-view'),
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_intro_subtitle', array(
		'label'      => __('Intro Subtitle', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_intro_subtitle',
		'type'       => 'text',
	));
	$wp_customize->add_setting('portfolio_view_intro_title', array(
		'default' => __('A Web Designer', 'portfolio-view'),
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_intro_title', array(
		'label'      => __('Intro Title', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_intro_title',
		'type'       => 'text',
	));
	$wp_customize->add_setting('portfolio_view_intro_desc', array(
		'default' => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_intro_desc', array(
		'label'      => __('Intro Description', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_intro_desc',
		'type'       => 'textarea',
	));
	$wp_customize->add_setting('portfolio_view_header_social_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  '',
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_header_social_show', array(
		'label'      => __('Show Header Social?', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_header_social_show',
		'type'       => 'checkbox',

	));
	// header social links start
	// Header facebook url
	$wp_customize->add_setting('portfolio_view_hfacebook_link', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_hfacebook_link', array(
		'label'      => __('Header Facebook url', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_hfacebook_link',
		'type'       => 'url',
		'active_callback' => 'portfolio_view_header_social_callback',
	));
	// Header twitter url
	$wp_customize->add_setting('portfolio_view_htwitter_link', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_htwitter_link', array(
		'label'      => __('Header Twitter url', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_htwitter_link',
		'type'       => 'url',
		'active_callback' => 'portfolio_view_header_social_callback',
	));
	// Header linkedin url
	$wp_customize->add_setting('portfolio_view_hlinkedin_link', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_hlinkedin_link', array(
		'label'      => __('Header Linkedin url', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_hlinkedin_link',
		'type'       => 'url',
		'active_callback' => 'portfolio_view_header_social_callback',
	));
	// Header linkedin url
	$wp_customize->add_setting('portfolio_view_hyoutube_link', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_hyoutube_link', array(
		'label'      => __('Header Youtube url', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_hyoutube_link',
		'type'       => 'url',
		'active_callback' => 'portfolio_view_header_social_callback',
	));
	// Header pinterest url
	$wp_customize->add_setting('portfolio_view_hpinterest_link', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_hpinterest_link', array(
		'label'      => __('Header Pinterest url', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_hpinterest_link',
		'type'       => 'url',
		'active_callback' => 'portfolio_view_header_social_callback',
	));
	// Header INSTAGRAM url
	$wp_customize->add_setting('portfolio_view_hinstagram_link', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_hinstagram_link', array(
		'label'      => __('Header Instagram url', 'portfolio-view'),
		'section'    => 'portfolio_view_intro',
		'settings'   => 'portfolio_view_hinstagram_link',
		'type'       => 'url',
		'active_callback' => 'portfolio_view_header_social_callback',
	));

	//Portfolio View PLus blog settings
	$wp_customize->add_section('portfolio_view_blog', array(
		'title' => __('Portfolio View Blog Settings', 'portfolio-view'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Portfolio View theme blog settings', 'portfolio-view'),
		'panel'    => 'portfolio_view_settings',

	));
	$wp_customize->add_setting('portfolio_view_blog_container', array(
		'default'        => 'container',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_view_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_blog_container', array(
		'label'      => __('Container type', 'portfolio-view'),
		'description' => __('You can set standard container or full width container. ', 'portfolio-view'),
		'section'    => 'portfolio_view_blog',
		'settings'   => 'portfolio_view_blog_container',
		'type'       => 'select',
		'choices'    => array(
			'container' => __('Standard Container', 'portfolio-view'),
			'container-fluid' => __('Full width Container', 'portfolio-view'),
		),
	));

	$wp_customize->add_setting('portfolio_view_blog_layout', array(
		'default'        => 'rightside',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_view_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_blog_layout', array(
		'label'      => __('Select Blog Layout', 'portfolio-view'),
		'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'portfolio-view'),
		'section'    => 'portfolio_view_blog',
		'settings'   => 'portfolio_view_blog_layout',
		'type'       => 'select',
		'choices'    => array(
			'rightside' => __('Right Sidebar', 'portfolio-view'),
			'leftside' => __('Left Sidebar', 'portfolio-view'),
			'fullwidth' => __('No Sidebar', 'portfolio-view'),
		),
	));
	$wp_customize->add_setting('portfolio_view_blog_style', array(
		'default'        => 'grid',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_view_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_blog_style', array(
		'label'      => __('Select Blog Style', 'portfolio-view'),
		'section'    => 'portfolio_view_blog',
		'settings'   => 'portfolio_view_blog_style',
		'type'       => 'select',
		'choices'    => array(
			'grid' => __('Grid Style', 'portfolio-view'),
			'list' => __('List Style', 'portfolio-view'),
			'classic' => __('Classic Style', 'portfolio-view'),
		),
	));
	//Portfolio View page settings
	$wp_customize->add_section('portfolio_view_page', array(
		'title' => __('Portfolio View Page Settings', 'portfolio-view'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Portfolio View theme blog settings', 'portfolio-view'),
		'panel'    => 'portfolio_view_settings',

	));
	$wp_customize->add_setting('portfolio_view_page_container', array(
		'default'        => 'container',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_view_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_page_container', array(
		'label'      => __('Page Container type', 'portfolio-view'),
		'description' => __('You can set standard container or full width container for page. ', 'portfolio-view'),
		'section'    => 'portfolio_view_page',
		'settings'   => 'portfolio_view_page_container',
		'type'       => 'select',
		'choices'    => array(
			'container' => __('Standard Container', 'portfolio-view'),
			'container-fluid' => __('Full width Container', 'portfolio-view'),
		),
	));
	$wp_customize->add_setting('portfolio_view_page_header', array(
		'default'        => 'show',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_view_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_view_page_header', array(
		'label'      => __('Show Page header', 'portfolio-view'),
		'section'    => 'portfolio_view_page',
		'settings'   => 'portfolio_view_page_header',
		'type'       => 'select',
		'choices'    => array(
			'show' => __('Show all pages', 'portfolio-view'),
			'hide-home' => __('Hide Only Front Page', 'portfolio-view'),
			'hide' => __('Hide All Pages', 'portfolio-view'),
		),
	));




	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'portfolio_view_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'portfolio_view_customize_partial_blogdescription',
			)
		);
	}
}
add_action('customize_register', 'portfolio_view_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function portfolio_view_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function portfolio_view_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfolio_view_customize_preview_js()
{
	wp_enqueue_script('portfolio-view-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), PORTFOLIO_VIEW_VERSION, true);
}
add_action('customize_preview_init', 'portfolio_view_customize_preview_js');
