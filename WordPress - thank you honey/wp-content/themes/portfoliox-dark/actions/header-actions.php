<?php

/**
 * The file for header all actions
 *
 *
 * @package PortfolioX Dark
 */

function portfoliox_dark_header_menu_output()
{
?>
	<nav id="site-navigation" class="main-navigation">
		<?php
		wp_nav_menu(array(
			'theme_location' => 'main-menu',
			'menu_id'        => 'portfoliox-menu',
			'menu_class'        => 'portfoliox-menu',
		));
		?>
	</nav><!-- #site-navigation -->
<?php
}
add_action('portfoliox_dark_main_menu', 'portfoliox_dark_header_menu_output');


function portfoliox_dark_header_logo_output()
{
	$portfoliox_dark_site_tagline_show = get_theme_mod('portfoliox_dark_site_tagline_show');

?>

	<?php if (has_custom_logo()) : ?>
		<div class="site-branding brand-logo">
			<?php
			the_custom_logo();
			?>
		</div>
	<?php endif; ?>
	<?php
	if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
		<div class="site-branding brand-text">
			<?php if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				$portfoliox_dark_description = get_bloginfo('description', 'display');
				if (($portfoliox_dark_description || is_customize_preview()) && empty($portfoliox_dark_site_tagline_show)) :
				?>
					<p class="site-description"><?php echo $portfoliox_dark_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
												?></p>
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- .site-branding -->
	<?php endif; ?>

<?php
}
add_action('portfoliox_dark_header_logo', 'portfoliox_dark_header_logo_output');




// header style one
function portfoliox_dark_header_style_one()
{
?>
	<div class="container-fluid pxm-style1">
		<div class="navigation mx-4">
			<div class="d-flex">
				<div class="pxms1-logo">
					<?php do_action('portfoliox_dark_header_logo'); ?>
				</div>
				<div class="pxms1-menu ms-auto">
					<?php do_action('portfoliox_dark_main_menu'); ?>
				</div>
			</div>
		</div>
	</div>


<?php
}
add_action('portfoliox_dark_header_style_one', 'portfoliox_dark_header_style_one');

// header style one
function portfoliox_dark_header_style_two()
{

?>
	<div class="portfoliox-logo-section">
		<div class="container">
			<div class="head-logo-sec">
				<?php do_action('portfoliox_dark_header_logo'); ?>
			</div>
		</div>
	</div>

	<div class="menu-bar text-center">
		<div class="container">
			<div class="portfoliox-container menu-inner">
				<?php do_action('portfoliox_dark_main_menu'); ?>
			</div>
		</div>
	</div>
<?php
}
add_action('portfoliox_dark_header_style_two', 'portfoliox_dark_header_style_two');


// newsxpaper mene style
function portfoliox_dark_mobile_menu_output()
{
?>
	<div class="mobile-menu-bar">
		<div class="container">
			<nav id="mobile-navigation" class="mobile-navigation">
				<button id="mmenu-btn" class="menu-btn" aria-expanded="false">
					<span class="mopen"><?php esc_html_e('Menu', 'portfoliox-dark'); ?></span>
					<span class="mclose"><?php esc_html_e('Close', 'portfoliox-dark'); ?></span>
				</button>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'menu_id'        => 'wsm-menu',
					'menu_class'        => 'wsm-menu',
				));
				?>
			</nav><!-- #site-navigation -->
		</div>
	</div>

<?php
}
add_action('portfoliox_dark_mobile_menu', 'portfoliox_dark_mobile_menu_output');
