<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lean-blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-wrapper">
		<footer class="entry-footer">
			<?php lean_blog_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<div class="bottom-wrapper">
			<div class="featured-image">
				<?php lean_blog_post_thumbnail(); ?>
			</div>

			<div class="entry-container">
				<header class="entry-header">
					<?php
						if ( is_singular() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif; ?>
				</header><!-- .entry-header -->

				<div class="entry-meta">
						<?php lean_blog_posted_by(); ?>
						<?php lean_blog_posted_on(); ?>
					</div>

				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div><!-- .entry-content -->
			</div>
		</div><!-- .bottom-wrapper -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
