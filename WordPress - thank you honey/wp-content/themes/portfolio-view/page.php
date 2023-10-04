<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portfolio View
 */
$portfolio_view_page_container = get_theme_mod('portfolio_view_page_container', 'container');
get_header();
?>

<div class="<?php echo esc_attr($portfolio_view_page_container); ?> mt-5 mb-5 pt-5 pb-5">
	<div class="row">
		<div class="col-lg-12">
			<main id="primary" class="site-main">

				<?php
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/content', 'page');

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div>
	</div>
</div>

<?php
get_footer();
