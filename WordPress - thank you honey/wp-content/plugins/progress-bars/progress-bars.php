<?php

/**
 * Plugin Name:     Progress Bar
 * Plugin URI:         https://essential-blocks.com
 * Description:     Make your website interactive with stunning progress bar
 * Version:         1.2.6
 * Author:          WPDeveloper
 * Author URI:         https://wpdeveloper.net
 * License:         GPL-3.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:     progress-bars
 *
 * @package         progress-bars
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */

require_once __DIR__ . '/includes/font-loader.php';
require_once __DIR__ . '/includes/post-meta.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/lib/style-handler/style-handler.php';

function create_block_progress_bar_block_init() {
    $dir = dirname( __FILE__ );

    define( 'PROGRESS_BARS_BLOCKS_VERSION', "1.2.6" );
    define( 'PROGRESS_BARS_BLOCKS_ADMIN_URL', plugin_dir_url( __FILE__ ) );
    define( 'PROGRESS_BARS_BLOCKS_ADMIN_PATH', dirname( __FILE__ ) );

    $script_asset_path = PROGRESS_BARS_BLOCKS_ADMIN_PATH . "/dist/index.asset.php";
    if ( ! file_exists( $script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` for the "progress-bars/progress-bar-block" block first.'
        );
    }
    $index_js         = PROGRESS_BARS_BLOCKS_ADMIN_URL . 'dist/index.js';
    $script_asset     = require $script_asset_path;
    $all_dependencies = array_merge( $script_asset['dependencies'], [
        'wp-blocks',
        'wp-i18n',
        'wp-element',
        'wp-block-editor',
        'progress-bars-blocks-controls-util',
        'essential-blocks-eb-animation'
    ] );

    wp_register_script(
        'progress-bars-block-editor-js',
        $index_js,
        $all_dependencies,
        $script_asset['version']
    );

    $load_animation_js = PROGRESS_BARS_BLOCKS_ADMIN_URL . 'assets/js/eb-animation-load.js';
    wp_register_script(
        'essential-blocks-eb-animation',
        $load_animation_js,
        [],
        PROGRESS_BARS_BLOCKS_VERSION,
        true
    );

    $animate_css = PROGRESS_BARS_BLOCKS_ADMIN_URL . 'assets/css/animate.min.css';
    wp_register_style(
        'essential-blocks-animation',
        $animate_css,
        [],
        PROGRESS_BARS_BLOCKS_VERSION
    );

    $style_css = PROGRESS_BARS_BLOCKS_ADMIN_URL . 'dist/style.css';
    wp_register_style(
        'progress-bars-block-frontend-style',
        $style_css,
        [ 'essential-blocks-animation' ],
        filemtime( PROGRESS_BARS_BLOCKS_ADMIN_PATH . '/dist/style.css' )
    );

    $frontend_js_path = include_once dirname( __FILE__ ) . "/dist/frontend/index.asset.php";
    $frontend_js      = "dist/frontend/index.js";
    wp_register_script(
        'eb-progress-bar-frontend',
        plugins_url( $frontend_js, __FILE__ ),
        $frontend_js_path['dependencies'],
        $frontend_js_path['version'],
        true
    );

    if ( ! WP_Block_Type_Registry::get_instance()->is_registered( 'essential-blocks/progress-bar' ) ) {
        register_block_type(
            Progress_Bar_Helper::get_block_register_path( 'progress-bars/progress-bar-block', PROGRESS_BARS_BLOCKS_ADMIN_PATH ),
            [
                'editor_script'   => 'progress-bars-block-editor-js',
                'editor_style'    => 'progress-bars-block-frontend-style',
                'style'           => 'progress-bars-block-frontend-style',
                'render_callback' => function ( $attribs, $content ) {
                    if ( ! is_admin() ) {
                        wp_enqueue_script( 'eb-progress-bar-frontend' );
                        wp_enqueue_script( 'essential-blocks-eb-animation' );
                    }
                    return $content;
                }
            ]
        );
    }
}

add_action( 'init', 'create_block_progress_bar_block_init', 99 );
