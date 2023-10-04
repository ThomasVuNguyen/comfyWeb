<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portfolio View
 */
$portfolio_view_categories = get_the_category();
if ($portfolio_view_categories) {
	$portfolio_view_category = $portfolio_view_categories[mt_rand(0, count($portfolio_view_categories) - 1)];
} else {
	$portfolio_view_category = '';
}
if (has_post_thumbnail()) {
	$portfolio_view_imgclass = 'nx-has-img';
} else {
	$portfolio_view_imgclass = 'nx-no-img';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('nx-list-item'); ?>>
	<div class="single-nx-list-item <?php echo esc_attr($portfolio_view_imgclass); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<div class="nx-single-list-img">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium_large'); ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="nx-single-list-details">
			<?php if ($portfolio_view_category) : ?>
				<a href="<?php echo esc_url(get_category_link($portfolio_view_category)); ?>" class="nx-list-categories"><?php echo esc_html($portfolio_view_category->name); ?></a>
			<?php endif; ?>
			<?php the_title('<h2 class="nx-list-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
			<?php the_excerpt(); ?>
			<a class="portfolio-view-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE', 'portfolio-view'); ?> <i class="fas fa-long-arrow-alt-right"></i></a>

		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->