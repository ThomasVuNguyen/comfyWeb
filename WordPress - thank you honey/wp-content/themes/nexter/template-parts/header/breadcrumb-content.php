<?php
/**
 * Breadcrumb
 *
 * The Header part of breadcrumb For Nexter.
 *
 * @package	Nexter
 * @since	1.0.0
 */

$header_container = nexter_get_option( 'site-header-container' );
$header_container = (!empty($header_container)) ? 'nxt-'.esc_attr($header_container) : 'nxt-container-block-editor';
?>
<div class="nxt-breadcrumb-wrap">
	<div class="<?php echo esc_attr($header_container); ?>">
		<?php do_action( 'nexter_breadcrumb_content' ); ?>
	</div>
</div> <!-- Nexter Breadcrumb -->