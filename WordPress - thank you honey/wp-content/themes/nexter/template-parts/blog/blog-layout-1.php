<?php
/**
 * Template for Single Blog
 *
 * @package	Nexter
 * @since	1.0.0
 */

$offset_class='';
?>
<div class="nxt-blog-single-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() && (nexter_get_option('s-display-post-fea-image') == 'on' || empty(nexter_get_option('s-display-post-fea-image')))) {
			get_template_part('template-parts/blog/format', 'image');
			$offset_class='nxt-offset-top';
		} ?>
		
		<div class="nxt-single-post-title <?php echo esc_attr($offset_class); ?>">
			<?php 
				if( nexter_get_option('s-display-post-title') == 'on' || empty(nexter_get_option('s-display-post-title')) ){
				get_template_part('template-parts/blog/post', 'title');
				} ?>
			<?php if( nexter_get_option('s-display-post-meta') == 'on' || empty(nexter_get_option('s-display-post-meta')) ){
				get_template_part('template-parts/blog/blog', 'post-meta');
			} ?>
		</div>
		
		<div class="nxt-single-post-content">
			<?php the_content(); ?>
		</div>
		<?php if (get_the_tags() && (nexter_get_option('s-display-post-tags') == 'on' || empty(nexter_get_option('s-display-post-tags')))){ ?>
		<div class="nxt-tags-share-post">
			<div class="nxt-row">
				<div class="nxt-col">
					<?php get_template_part('template-parts/blog/post', 'tags' ); ?>
				</div>			
			</div>		
		</div>
		<?php } ?>
		<?php if( nexter_get_option('s-display-post-nav') == 'on' || empty(nexter_get_option('s-display-post-nav')) ){
			get_template_part('template-parts/blog/post', 'navigation' ); 
		} ?>
		
		<?php if( nexter_get_option('s-display-author-info') == 'on' || empty(nexter_get_option('s-display-author-info')) ){ ?>
			<div class="nxt-row">
				<div class="nxt-col">
					<?php get_template_part('template-parts/blog/user', 'meta' ); ?>
				</div>
			</div>
		<?php } ?>
		
		<?php 
			if( nexter_get_option('s-display-comment-box') == 'on' || empty(nexter_get_option('s-display-comment-box')) ){
				get_template_part('template-parts/blog/blog', 'comments'); 
			} ?>
	</article>
</div>