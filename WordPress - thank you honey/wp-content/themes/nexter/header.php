<?php
/**
 * The header for Nexter theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nexter
 * @since	1.0.0
 */
global $wp_query;
?>
<!doctype html>
<?php nxt_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
	<?php nxt_head_top(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<?php nxt_head_bottom(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if ( function_exists('get_current_screen')) {
    	wp_body_open();
	} ?>

	<?php nxt_body_top(); ?>
	
	<?php  do_action('nxt_body_frame'); ?>
	
	<?php	
		$layout_container = nexter_content_layout_container();
		if(!empty($layout_container)){
			$layout_container = 'nxt-'.nexter_content_layout_container();
			
			$get_sidebar = nexter_site_sidebar_layout();
			if(!empty($get_sidebar) && ($get_sidebar['layout'] == 'left-sidebar' || $get_sidebar['layout'] == 'right-sidebar') ){
				if( $layout_container == 'nxt-container-block-editor' ){
					$layout_container .= ' nxt-container';
				}
				$layout_container .= ' nxt-with-sidebar';
				
			}
		}else{
			$layout_container = 'nxt-container-block-editor';
		}
	?>
	<div class="wrapper-main">
	
		<?php nxt_header_before(); ?>
		<?php do_action( 'nexter_header' ); ?>
		<?php nxt_header_after(); ?>
		
		<?php do_action( 'nexter_breadcrumb' ); ?>
		
		<div id="content" class="site-content"><!--content-->
		
			<div class="<?php echo esc_attr($layout_container); ?>"><!--nxt container-->
			<?php nxt_content_top(); ?>