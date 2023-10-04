<div class="nxt-meta-info nxt-flex nxt-flex-wrap align-items-center">
	<?php get_template_part('template-parts/archive/meta', 'date'); ?>
	<?php if ( ! empty( get_the_category() ) ) { ?>
	<span class="nxt-meta-category"><span><?php echo esc_html__('in ', 'nexter'); ?></span><?php echo get_the_category_list( __( ', ', 'nexter' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	<?php } ?>
	<span class="nxt-meta-author"><?php echo esc_html__('by ', 'nexter'); ?><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="<?php echo esc_attr__('author','nexter'); ?>" class="fn"><?php echo esc_html(get_the_author()); ?></a> </span>
    <?php if ( ! is_single() ) {
	echo '<span class="nxt-meta-comments">';
        comments_popup_link( esc_html__('No Comments', 'nexter'), esc_html__('1 Comment', 'nexter'), esc_html__('% Comments', 'nexter'));
	echo '</span>';
    } ?>
</div>