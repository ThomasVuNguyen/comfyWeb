<?php
	$featured_image=get_the_post_thumbnail(get_the_ID(), 'full', array('title' => ''));
if(!empty($featured_image)){
?>
	<div class="nxt-post-thumb">	
		<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_post_thumbnail(get_the_ID(), 'full', array('title' => '')); ?></a>
	</div>
<?php } ?>