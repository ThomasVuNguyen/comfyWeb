<?php
/**
 * Template for 404
 *
 * @package	Nexter
 * @since	1.0.0
 */

?>
<div class="nexter-404-page">
	
	<header class="page-header">
	
		<img src="<?php echo esc_url(NXT_THEME_URI .'/assets/images/nxt-404-page.svg'); ?>" class="page-404-img" alt="<?php echo esc_attr__('404 page','nexter'); ?>" />
		<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'nexter' ); ?></h1>
		
	</header><!-- .page-header -->

	<div class="page-content text-center">
		<a href="<?php echo esc_url(home_url()); ?>" class="btn-back-home"><?php echo esc_html__('Go Back Home', 'nexter'); ?></a>
	</div><!-- .page-content -->
	
</div>