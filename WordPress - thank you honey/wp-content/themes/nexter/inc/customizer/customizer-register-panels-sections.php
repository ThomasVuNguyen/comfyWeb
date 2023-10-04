<?php
/**
 * Register customizer panels & sections
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! class_exists( 'Nexter_Customizer_Register_Sections_Panels' ) ) {

	class Nexter_Customizer_Register_Sections_Panels {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'customize_register', 	array( $this, 'register_configuration' ) );
		}
		
		public function register_configuration( $wp_customize ) {
			
			/* Start
			 * Global General Options
			 */
			$general_panel = 'panel-global-general';
			
			$wp_customize->add_panel( new Nexter_Customizer_Panel( $wp_customize, $general_panel, array(
				'title' 			=> esc_html__( 'General', 'nexter' ),
				'priority' 			=> 5,
			) ) );
			
			/**
			 * General => Container
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-site-layout-container', array(
				'title' 			=> esc_html__( 'Container', 'nexter' ),
				'priority' 			=> 5,
				'panel' 			=> $general_panel,
			) ) );
			
			/*
			 * General => Header Disable
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-header-mode', array(
				'title' 			=> esc_html__( 'Header', 'nexter' ),
				'priority' 			=> 10,
				'panel' 			=> $general_panel,
			) ) );
			/* End
			 * Global Header Disable
			 */
			
			/*
			 * General => Footer Disable
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-footer-mode', array(
				'title' 			=> esc_html__( 'Footer', 'nexter' ),
				'priority' 			=> 10,
				'panel' 			=> $general_panel,
			) ) );
			/* End
			 * Global Footer Disable
			 */
			 
			/*
			 * General => Sidebar
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-layout-sidebar', array(
				'title' 			=> esc_html__( 'Sidebar', 'nexter' ),
				'priority' 			=> 10,
				'panel' 			=> $general_panel,
			) ) );
			
			/*
			 * General => Body Style
			 */
			 $wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-body-style', array(
				'title' 			=> esc_html__( 'Body Style', 'nexter' ),
				'priority' 			=> 15,
				'panel' 			=> $general_panel,
			) ) );
			
			/*
			 * General => Selection Text Color
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-selected-text-style', array(
				'title' 			=> esc_html__( 'Selection Text Color', 'nexter' ),
				'priority' 			=> 20,
				'panel' 			=> $general_panel,
			) ) );
			
			/*
			 * General => Maintenance Mode
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-maintenance-mode', array(
				'title' 			=> esc_html__( 'Maintenance Mode', 'nexter' ),
				'priority' 			=> 30,
				'panel' 			=> $general_panel,
			) ) );
			/* End
			 * Global General Options
			 */
			 
			/* Start
			 * Site Identity
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'title_tagline', array(
				'title' 			=> esc_html__( 'Site Identity', 'nexter' ),
				'priority' 			=> 5,
			) ) );
			/* End
			 * Site Identity
			 */
			
			/**
			 *  Start Styling Colors
			 */
			$styling_color_panel = 'panel-styling-colors';
			
			$wp_customize->add_panel( new Nexter_Customizer_Panel( $wp_customize, $styling_color_panel, array(
				'title' 			=> esc_html__( 'Styling Colors', 'nexter' ),
				'priority' 			=> 15,
			) ) );
			
			/*
			 * Styling Colors => Body
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-body-colors', array(
				'title' 			=> esc_html__( 'Body', 'nexter' ),
				'priority' 			=> 1,
				'panel' 			=> $styling_color_panel,
			) ) );
			
			/*
			 * Styling Colors => Headings H1-H6
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-heading-colors', array(
				'title' 			=> esc_html__( 'Headings H1-H6', 'nexter' ),
				'priority' 			=> 5,
				'panel' 			=> $styling_color_panel,
			) ) );
			
			/**
			 *  End Styling Colors
			 */
			
			/**
			 *  Start General Typography 
			 */
			$typography_panel = 'panel-typography';
			
			$wp_customize->add_panel( new Nexter_Customizer_Panel( $wp_customize, $typography_panel, array(
				'title' 			=> esc_html__( 'Typography', 'nexter' ),
				'priority' 			=> 20,
			) ) );
			
			/*
			 * Typography => General
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-general-typo', array(
				'title' 			=> esc_html__( 'General', 'nexter' ),
				'priority' 			=> 1,
				'panel' 			=> $typography_panel,
			) ) );
			
			/*
			 * Typography => General => Body
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-body-typography', array(
				'title' 			=> esc_html__( 'Body', 'nexter' ),
				'priority' 			=> 5,
				'panel' 			=> $typography_panel,
				'section'			=> 'section-general-typo',
			) ) );
			
			/*
			 * Typography => General => Heading H1
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-heading-h1-typo', array(
				'title' 			=> esc_html__( 'Heading H1', 'nexter' ),
				'priority' 			=> 5,
				'panel' 			=> $typography_panel,
				'section'			=> 'section-general-typo',
			) ) );
			
			/*
			 * Typography => General => Heading H2
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-heading-h2-typo', array(
				'title' 			=> esc_html__( 'Heading H2', 'nexter' ),
				'priority' 			=> 10,
				'panel' 			=> $typography_panel,
				'section'			=> 'section-general-typo',
			) ) );
			
			/*
			 * Typography => General => Heading H3
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-heading-h3-typo', array(
				'title' 			=> esc_html__( 'Heading H3', 'nexter' ),
				'priority' 			=> 15,
				'panel' 			=> $typography_panel,
				'section'			=> 'section-general-typo',
			) ) );
			
			/*
			 * Typography => General => Heading H4
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-heading-h4-typo', array(
				'title' 			=> esc_html__( 'Heading H4', 'nexter' ),
				'priority' 			=> 20,
				'panel' 			=> $typography_panel,
				'section'			=> 'section-general-typo',
			) ) );
			
			/*
			 * Typography => General => Heading H5
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-heading-h5-typo', array(
				'title' 			=> esc_html__( 'Heading H5', 'nexter' ),
				'priority' 			=> 25,
				'panel' 			=> $typography_panel,
				'section'			=> 'section-general-typo',
			) ) );
			
			/*
			 * Typography => General => Heading H6
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-heading-h6-typo', array(
				'title' 			=> esc_html__( 'Heading H6', 'nexter' ),
				'priority' 			=> 30,
				'panel' 			=> $typography_panel,
				'section'			=> 'section-general-typo',
			) ) );
			
			/**
			 * End General Typography
			 */
			
			/**
			 * Start Blog Layout
			 */
			$blog_layout_panel = 'panel-blog-layout';
			
			$wp_customize->add_panel( new Nexter_Customizer_Panel( $wp_customize, $blog_layout_panel, array(
				'title' 			=> esc_html__( 'Blog', 'nexter' ),
				'priority' 			=> 25,
			) ) );
			
			/*
			 * Blog => Single Post
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-blog-single', array(
				'title' 			=> esc_html__( 'Single Post', 'nexter' ),
				'priority' 			=> 5,
				'panel' 			=> $blog_layout_panel,
			) ) );
			
			/**
			 * End Blog Layout
			 */
		}
	}
}
new Nexter_Customizer_Register_Sections_Panels;