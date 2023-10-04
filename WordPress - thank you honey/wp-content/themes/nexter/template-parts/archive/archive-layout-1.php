<?php
/**
 * Template for Archive Layout
 *
 * @package	Nexter
 * @since	1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('nxt-archive-list nxt-col-md-12 nxt-col-sm-12'); ?>>
	<div class="nxt-post-list-content">
		<?php if ( has_post_thumbnail() ) {
			get_template_part('template-parts/archive/format', 'image');			
		} ?>
		<div class="nxt-post-title">
			<?php 
				get_template_part('template-parts/archive/post', 'title');
				get_template_part('template-parts/archive/blog', 'post-meta');
			 ?>
		</div>
		<?php get_template_part('template-parts/archive/post', 'excerpt'); ?>
		
		<?php get_template_part('template-parts/archive/post', 'read-more'); ?>
	</div>
</article>