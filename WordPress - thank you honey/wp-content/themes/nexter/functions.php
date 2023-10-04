<?php
/**
 * Nexter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nexter
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define Nexter Constants
 */
define( 'NXT_VERSION', '2.0.4' );
define( 'NXT_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'NXT_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'NXT_JS_URI', get_template_directory_uri() .'/assets/js/' );
define( 'NXT_CSS_URI', get_template_directory_uri() .'/assets/css/' );
define( 'NXT_OPTIONS', 'nxt-theme-options' );
if(!defined('NXT_BUILD_POST')){
	define( 'NXT_BUILD_POST', 'nxt_builder' );
}

if ( ! function_exists( 'nexter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nexter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Nexter, use a find and replace
		 * to change 'nexter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'nexter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	
	
		/*Default Global Color Palette*/
		$globalColorsPalette = nxt_global_color_palette();
		
		add_theme_support('editor-color-palette', apply_filters('nxt-global-color-palette', $globalColorsPalette));
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'nexter' ),
		) );
		
		// Gutenberg wide images.
		add_theme_support( 'align-wide' );
			
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'nexter_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 180,
			'width'       => 60,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		
		// WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'editor-styles' );
		$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		//add editor Style Admin css
		add_editor_style( 'assets/css/admin/editor-style'. $minified .'.css' );
	}
endif;
add_action( 'after_setup_theme', 'nexter_setup' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function nexter_skip_link_focus_fix() {
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'nexter_skip_link_focus_fix' ); 

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nexter_content_width() {	
	$GLOBALS['content_width'] = apply_filters( 'nexter_content_width', 1200 );
}
add_action( 'after_setup_theme', 'nexter_content_width', 0 );


require_once NXT_THEME_DIR . 'inc/widgets.php';
require_once NXT_THEME_DIR . 'inc/panel-settings/nexter-google-captcha.php';
require_once NXT_THEME_DIR . 'inc/panel-settings/plus-settings-options.php';
require_once NXT_THEME_DIR . 'inc/panel-settings/nxt-post-duplicator.php';
require_once NXT_THEME_DIR . 'inc/panel-settings/nxt-replace-url.php';

require_once NXT_THEME_DIR . 'inc/core-function/nxt-core-hooks.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-builder-compatibility.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-nxt-theme-builder-load.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-elementor.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-elementor-pro.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-gutenberg.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-visual-composer.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-beaver.php';
require_once NXT_THEME_DIR . 'inc/third-party/class-beaver-build-theme.php';

if ( is_admin() ) {
	require_once NXT_THEME_DIR . 'inc/plugins/class-tgm-plugin-activation.php';
	require_once NXT_THEME_DIR . 'inc/plugins/tgm-plugin-activate.php';
	
}
require NXT_THEME_DIR .'inc/core-function/nxt-helper-function.php';
require NXT_THEME_DIR .'inc/core-function/nxt-core-function.php';

require_once NXT_THEME_DIR . 'inc/customizer/nexter-font-families-list.php';
require_once NXT_THEME_DIR . 'inc/customizer/nexter-render-fonts-load.php';

//Metabox Options
if(class_exists( 'CMB2_Bootstrap_290' )){
	require_once NXT_THEME_DIR . 'inc/custom-metabox/nexter-sidebar-settings.php';
}

//Load Enqueue Styles And Scripts
require_once NXT_THEME_DIR .'inc/nexter-enqueue-style-script.php';

/**
 * Implement the Custom Header feature.
 */
require NXT_THEME_DIR . 'inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require NXT_THEME_DIR . 'inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require NXT_THEME_DIR . 'inc/template-functions.php';

/* 
 * Nexter Theme Options
 */
require_once NXT_THEME_DIR . 'inc/nexter-theme-options.php';

/**
 * Nexter Dynamic Css
 */
require_once NXT_THEME_DIR . 'inc/nexter-gutenberg-dynamic-css.php';
require_once NXT_THEME_DIR . 'inc/nexter-dynamic-css.php';
function nexter_dynamic_enqueue_scripts() {
	echo '<style type="text/css">'.wp_strip_all_tags(Nexter_Dynamic_Css::render_theme_css()).'</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'nexter_dynamic_enqueue_scripts' );

/**
 * Customizer Options
 */
require NXT_THEME_DIR . 'inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Woocommerce Compatibility
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once NXT_THEME_DIR . 'inc/third-party/woocommerce/nexter-woocommerce-config.php';
}