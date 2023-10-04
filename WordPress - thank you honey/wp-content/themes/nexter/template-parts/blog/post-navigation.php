<div class="nxt-row nxt-post-next-prev">
	<div class="nxt-col nxt-col-sm-6 prev">
		<?php $prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
				<a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>" class="post_nav_link text-left" rel="<?php echo esc_attr__('prev','nexter'); ?>">
					<span><?php echo esc_html__('Previous Post','nexter'); ?></span><span><?php echo wp_kses_post($prev_post->post_title); ?></span>
				</a>
		<?php endif; ?>
	</div>
	<div class="nxt-col nxt-col-sm-6 next">
		<?php $next_post = get_next_post();
			if (!empty( $next_post )): ?>
				<a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>" class="post_nav_link text-right" rel="<?php echo esc_attr__('next','nexter'); ?>">
					<span><?php echo esc_html__('Next Post','nexter'); ?></span><span><?php echo wp_kses_post($next_post->post_title); ?></span>
				</a>
		<?php endif; ?>
	</div>
</div>