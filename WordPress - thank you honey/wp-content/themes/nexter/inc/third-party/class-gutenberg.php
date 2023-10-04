<?php
/**
 * Nexter Gutenberg Compatibility
 *
 * @package Nexter
 * @since	1.0.0
 */

if ( ! class_exists( 'Nexter_Gutenberg_Editor' ) ) {

	class Nexter_Gutenberg_Editor extends Nexter_Builder_Compatibility {
		
		public function __construct() {}
		
		/**
		 * Render content for post.
		 */
		public function render_content( $post_id ) {

			$output       = '';
			$current_post = get_post( $post_id, OBJECT );
			
			if ( has_blocks( $current_post ) ) {
				$blocks = parse_blocks( $current_post->post_content );
				foreach ( $blocks as $block ) {
					$output .= render_block( $block );
				}
			} else {
				$output = $current_post->post_content;
			}

			ob_start();
			echo do_shortcode( $output );
			echo ob_get_clean();	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		
		/**
		 * Load enqueue styles and scripts.
		 */
		public function enqueue_scripts( $post_id ) {

			if ( $post_id !== '' ) {
				/*The Plus Addon*/
				if ( class_exists( 'Tp_Core_Init_Blocks' ) ) {
					$css_file = Tp_Core_Init_Blocks::get_instance();
					if ( !empty($css_file) && is_callable( array( $css_file, 'enqueue_post_css' ) ) ) {
						$css_file->enqueue_post_css( $post_id );
					}
				}
				
				/*Ultimate Addon*/
				if ( class_exists( 'UAGB_Post_Assets' ) ) {
					$ultimate_instance = new UAGB_Post_Assets( $post_id );
					if ( !empty($ultimate_instance) && is_callable( array( $ultimate_instance, 'enqueue_scripts' ) ) ) {
						$ultimate_instance->enqueue_scripts();
					}
				}
				
				/*Gutentor blocks*/
				if ( class_exists( 'Gutentor_Dynamic_CSS' ) ) {
					$gutentor_instance = Gutentor_Dynamic_CSS::instance();
					if ( !empty($gutentor_instance) && is_callable( array( $gutentor_instance, 'get_singular_dynamic_css' ) ) ) {
						global $post;
						$post = get_post( $post_id, OBJECT );
						$style = $gutentor_instance->get_singular_dynamic_css( $post );
						echo '<style>'.$style.'</style>';
						wp_reset_postdata();
					}
				}
				
				/*GenerateBlocks*/
				if( class_exists( 'GenerateBlocks_Enqueue_CSS' ) ){
					$generate_instance = GenerateBlocks_Enqueue_CSS::get_instance();
					if( !empty($generate_instance) && function_exists('generateblocks_get_frontend_block_css') ){
						global $post;
						$post = get_post( $post_id, OBJECT );
						$css = generateblocks_get_frontend_block_css();
						if ( empty( $css ) ) {
							return;
						}
						printf(
							'<style>%s</style>',
							wp_strip_all_tags( $css ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						);
						wp_reset_postdata();
					}
				}
				
				/*Essential Blocks*/
				if(class_exists('EbStyleHandler')){
					$essential_instance = EbStyleHandler::init();
					if ( !empty($essential_instance) && is_callable( array( $essential_instance, 'enqueue_frontend_css' ) ) ) {
						global $post;
						$post = get_post( $post_id, OBJECT );
						$style = $essential_instance->enqueue_frontend_css( $post );
						wp_reset_postdata();
					}
				}
			}
		}

	}

}