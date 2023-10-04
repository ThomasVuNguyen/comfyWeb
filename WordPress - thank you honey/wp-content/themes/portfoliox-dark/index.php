<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PortfolioX Dark
 */
$portfoliox_dark_blog_container = get_theme_mod( 'portfoliox_dark_blog_container', 'container' );
$portfoliox_dark_blog_layout = get_theme_mod( 'portfoliox_dark_blog_layout', 'fullwidth' );
$portfoliox_dark_blog_style = get_theme_mod( 'portfoliox_dark_blog_style', 'grid' );

if ( is_active_sidebar( 'sidebar-1' ) && $portfoliox_dark_blog_layout != 'fullwidth' ) {
	$portfoliox_dark_blog_column = 'col-lg-9';
}else{
	$portfoliox_dark_blog_column = 'col-lg-12';
}
get_header();
?>

		<div class="<?php echo esc_attr($portfoliox_dark_blog_container); ?> mt-5 mb-5 pt-5 pb-5">
			<div class="row">
			<?php if ( is_active_sidebar( 'sidebar-1' ) && $portfoliox_dark_blog_layout == 'leftside' ): ?>
				<div class="col-lg-3">
					<?php get_sidebar(); ?>
				</div>
				<?php endif; ?>
				<div class="<?php echo esc_attr($portfoliox_dark_blog_column); ?>">
					<main id="primary" class="site-main">
					<?php
						if ( have_posts() ) :

							if ( is_home() && ! is_front_page() ) :
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							endif;
							
					if( $portfoliox_dark_blog_style == 'grid' ):
					?>
					<div class="row" data-masonry='{"percentPosition": true }'>
						<?php
					endif;				
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;
					if( $portfoliox_dark_blog_style == 'grid' ):
					?>
					</div>
					<?php
					endif;
					the_posts_pagination();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>

					</main><!-- #main -->
				</div>
				<?php if ( is_active_sidebar( 'sidebar-1' ) && $portfoliox_dark_blog_layout == 'rightside' ): ?>
				<div class="col-lg-3">
					<?php get_sidebar(); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>

<?php
get_footer();
