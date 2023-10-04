<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portfolio View
 */
$portfolio_view_blog_layout = get_theme_mod('portfolio_view_blog_layout', 'rightside');
if ($portfolio_view_blog_layout == 'fullwidth' || !is_active_sidebar('sidebar-1')) {
	$portfolio_view_grid = 4;
} else {
	$portfolio_view_grid = 6;
}
$portfolio_view_categories = get_the_category();
if ($portfolio_view_categories) {
	$portfolio_view_category = $portfolio_view_categories[mt_rand(0, count($portfolio_view_categories) - 1)];
} else {
	$portfolio_view_category = '';
}
?>
<div class="col-lg-<?php echo esc_attr($portfolio_view_grid); ?> grid-item mb-5">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="grid-item-post">
			<div class="grid-item-details">
				<?php if ($portfolio_view_category) : ?>
					<div class="grid-item-topmeta">
						<a class="catimg-top" href="<?php echo esc_url(get_category_link($portfolio_view_category)); ?>"><?php echo esc_html($portfolio_view_category->name); ?></a>
					</div>
				<?php endif; ?>
				<?php the_title('<h2 class="grid-item-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
				<?php if ('post' === get_post_type()) :
				?>
					<div class="entry-meta grid-meta">
						<?php
						portfolio_view_posted_by();
						?>
						<span class="grid-meta-date"><?php echo get_the_date(); ?></span>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</div>
			<?php if (has_post_thumbnail()) : ?>
				<div class="grid-item-img">
					<a class="grid-item-img-link" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>