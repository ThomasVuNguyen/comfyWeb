<?php
/**
 * Nexter Elementor Pro Compatibility
 *
 * @package Nexter
 * @since 1.0.14
 */
namespace Elementor;

//If check 'Elementor' Exits or not
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport; // phpcs:ignore PHPCompatibility.Keywords.NewKeywords.t_namespaceFound, PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ns_separatorFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound

// @codingStandardsIgnoreStart PHPCompatibility.Keywords.NewKeywords.t_useFound
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;
use Elementor\TemplateLibrary\Source_Local;
// @codingStandardsIgnoreEnd PHPCompatibility.Keywords.NewKeywords.t_useFound

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Nexter_Elementor_Pro_Builder' ) ) {

	class Nexter_Elementor_Pro_Builder {

		/**
		 * Instance
		 */
		private static $instance;
		
		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		/**
		 * Constructor
		 *
		 * @since 1.0.14
		 */
		public function __construct() {
			// Update locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'nxt_register_locations' ) );
			
			// overright theme templates.
			add_action( 'nexter_header', array( $this, 'nxt_do_header' ), 0 );
			add_action( 'nexter_footer', array( $this, 'nxt_do_footer' ), 0 );
			add_action( 'nexter_404_page_template', array( $this, 'nxt_do_404_page_template' ), 0 );
			add_action( 'nexter_pages_hooks_template', array( $this, 'nxt_do_pages_hooks_template' ),0 );
		}
		
		/**
		 * Elementor Register Locations
		 *
		 * @since 1.0.14
		 * @param object $manager Location manager.
		 */
		public function nxt_register_locations( $manager ) {
			$manager->register_all_core_location();
		}
		
		/*
		 * Overright Elementor Header Template
		 * @since 1.0.14
		 */
		public function nxt_do_header(){
			$header_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $header_location ) {
				remove_action( 'nexter_header', 'nexter_header_template' );
			}
		}
		
		/*
		 * Overright Elementor Footer Template
		 * @since 1.0.14
		 */
		public function nxt_do_footer(){
			$footer_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
			if ( $footer_location ) {
				remove_action( 'nexter_footer', 'nexter_footer_template' );
			}
		}
		
		/*
		 * Overright Elementor 404 Page Template
		 * @since 1.0.14
		 */
		public function nxt_do_404_page_template(){
			if ( is_404() ) {
				$single_404_location = Module::instance()->get_locations_manager()->do_location( 'single' );
				if ( $single_404_location ) {
					remove_action( 'nexter_404_page_template', 'nexter_404_page_template_load' );
				}
			}
		}
		
		/*
		 * Overright Elementor Singular/Archives Template
		 * @since 1.0.14
		 */
		public function nxt_do_pages_hooks_template(){
			//Archive Template
			$archive_location = Module::instance()->get_locations_manager()->do_location( 'archive' );
			if ( $archive_location ) {
				remove_action( 'nexter_pages_hooks_template', array( \Nexter_Builder_Pages_Conditional::get_instance(), 'nexter_pages_hooks_template_content' ) );
			}
			
			//Single Template
			$single_location = Module::instance()->get_locations_manager()->do_location( 'single' );
			if ( $single_location ) {
				remove_action( 'nexter_pages_hooks_template', array( \Nexter_Builder_Pages_Conditional::get_instance(), 'nexter_pages_hooks_template_content' ) );
			}
		}
		
	}
	
	Nexter_Elementor_Pro_Builder::get_instance();
}