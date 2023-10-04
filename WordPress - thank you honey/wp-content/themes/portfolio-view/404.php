<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Portfolio View
 */

get_header();
?>
<div class="container">

	<main id="primary" class="site-main xmain-404 shadow mt-5 mb-5">

		<section class="error-404 not-found pb-5 pt-5 text-center">
			<header class="page-header pb-3">
				<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'portfolio-view'); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'portfolio-view'); ?></p>

				<?php
				get_search_form();

				?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div>

<?php
get_footer();
