<div class="nxt-author-meta text-left">
	<div class="nxt-author-details nxt-flex align-items-start nxt-flex-wrap">
		<div class="post-author-avatar">
			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="<?php echo esc_attr__('author','nexter'); ?>" class="author-meta-avatar nxt-flex"><?php echo get_avatar( get_the_author_meta('email'), '100',false ,get_the_author_meta('display_name')); ?></a>
		</div>
		<div class="post-author-bio">
			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="<?php echo esc_attr__('author','nexter'); ?>" class="author-meta-title"><?php the_author_meta('display_name'); ?></a>
			<?php if( get_the_author_meta("description") ){ ?>
				<div class="post-author-desc" itemprop="description"><?php the_author_meta('description'); ?></div>
			<?php } ?>
		</div>
	</div>
</div>
