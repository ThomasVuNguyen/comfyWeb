<?php
/**
 * Template Footer
 *
 * The Footer For Nexter.
 *
 * @package	Nexter
 * @since	1.0.0
 */
$footer_container = nexter_get_option( 'site-footer-container' );
$footer_container = (!empty($footer_container)) ? 'nxt-'.esc_attr($footer_container) : 'nxt-container-block-editor';
?>
<div class="nxt-footer-wrap" >
	<div class="<?php echo esc_attr($footer_container); ?>">
		<?php do_action( 'nexter_footer_content' ); ?>			
	</div> <!-- Nexter Container -->
</div> <!-- Footer Content -->