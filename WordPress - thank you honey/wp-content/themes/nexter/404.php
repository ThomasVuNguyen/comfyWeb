<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Nexter
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php do_action( 'nexter_404_page_template' ); ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
