<?php if (get_the_tags()){ ?>
<div class="nxt-post-tags">	
	<?php  the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?>
</div>
<?php } ?>