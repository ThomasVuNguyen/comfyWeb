<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$display_sidebar = nexter_site_sidebar_layout();
?>
<div class="nxt-col nxt-col-md-4 nxt-col-sm-12">
	<div itemtype="https://schema.org/WPSideBar" itemscope="itemscope" id="secondary" class="widget-area nxt-sidebar" role="complementary">
		
		<?php nxt_sidebars_before(); ?>
		
		<?php if ( !empty($display_sidebar) && isset($display_sidebar['sidebar']) && $display_sidebar['sidebar'] != 'none' && is_active_sidebar( $display_sidebar['sidebar'] ) ) { ?>
		
			<?php dynamic_sidebar( $display_sidebar['sidebar'] ); ?>
			
		<?php }else if ( !empty($display_sidebar) && isset($display_sidebar['sidebar']) && $display_sidebar['sidebar'] == 'custom' ) { ?>
		
			<?php do_action( 'nexter_custom_sidebar' ); ?>
		
		<?php } ?>
		
		<?php nxt_sidebars_after(); ?>
		
	</div><!-- #secondary -->
</div><!-- #column-4 -->