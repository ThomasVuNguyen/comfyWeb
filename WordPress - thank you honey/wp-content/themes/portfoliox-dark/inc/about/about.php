<?php

/**
 * About setup
 *
 * @package PortfolioX
 */

require_once trailingslashit(get_template_directory()) . 'inc/about/class.about.php';

if (!function_exists('portfoliox_dark_about_setup')) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function portfoliox_dark_about_setup()
	{
		$theme = wp_get_theme();
		$xtheme_name = $theme->get('Name');
		$xtheme_domain = $theme->get('TextDomain');
		if ($xtheme_domain == 'x-magazine') {
			$theme_slug = $xtheme_domain;
		} else {
			$theme_slug = 'portfoliox-dark';
		}



		$config = array(
			// Menu name under Appearance.
			'menu_name'               => sprintf(esc_html__('%s Info', 'portfoliox-dark'), $xtheme_name),
			// Page title.
			'page_name'               => sprintf(esc_html__('%s Info', 'portfoliox-dark'), $xtheme_name),
			/* translators: Main welcome title */
			'welcome_title'         => sprintf(esc_html__('Welcome to %s! - Version ', 'portfoliox-dark'), $theme['Name']),
			// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf(esc_html__('%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'portfoliox-dark'), $theme['Name']),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__('Getting Started', 'portfoliox-dark'),
				'recommended_actions' => esc_html__('Recommended Actions', 'portfoliox-dark'),
				'useful_plugins'  => esc_html__('Useful Plugins', 'portfoliox-dark'),
				'free_pro'  => esc_html__('Free Vs Pro', 'portfoliox-dark'),
			),

			// Quick links.
			'quick_links' => array(
				'xmagazine_url' => array(
					'text'   => esc_html__('UPGRADE PortfolioX PRO', 'portfoliox-dark'),
					'url'    => 'https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925',
					'button' => 'danger',
				),
				'update_url' => array(
					'text'   => esc_html__('PortfoliX PRO Video', 'portfoliox-dark'),
					'url'    => 'https://www.youtube.com/watch?v=pNlm-ArOHTM&t=18s',
					'button' => 'danger',
				),

			),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__('Demo Content', 'portfoliox-dark'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('Demo content is pro feature. To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'portfoliox-dark'), esc_html__('One Click Demo Import', 'portfoliox-dark')),
					'button_text' => esc_html__('UPGRADE For  Demo Content', 'portfoliox-dark'),
					'button_url'  => 'https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),

				'two' => array(
					'title'       => esc_html__('Theme Options', 'portfoliox-dark'),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__('Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'portfoliox-dark'),
					'button_text' => esc_html__('Customize', 'portfoliox-dark'),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
				),
				'three' => array(
					'title'       => esc_html__('Show Video', 'portfoliox-dark'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('You may show PortfolioX short video for better understanding', 'portfoliox-dark'), esc_html__('One Click Demo Import', 'portfoliox-dark')),
					'button_text' => esc_html__('Show video', 'portfoliox-dark'),
					'button_url'  => 'https://www.youtube.com/watch?v=pNlm-ArOHTM&t=18s',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__('Set Widgets', 'portfoliox-dark'),
					'icon'        => 'dashicons dashicons-tagcloud',
					'description' => esc_html__('Set widgets in your sidebar, Offcanvas as well as footer.', 'portfoliox-dark'),
					'button_text' => esc_html__('Add Widgets', 'portfoliox-dark'),
					'button_url'  => admin_url() . '/widgets.php',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'six' => array(
					'title'       => esc_html__('Theme Preview', 'portfoliox-dark'),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__('You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized. Theme demo only work in pro theme', 'portfoliox-dark'),
					'button_text' => esc_html__('View Demo', 'portfoliox-dark'),
					'button_url'  => 'https://px.wpteamx.com/demos',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'seven' => array(
					'title'       => esc_html__('Contact Support', 'portfoliox-dark'),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__('Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'portfoliox-dark'),
					'button_text' => esc_html__('Contact Support', 'portfoliox-dark'),
					'button_url'  => 'https://wpthemespace.com/support/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
			),

			'useful_plugins'        => array(
				'description' => esc_html__('Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'portfoliox-dark'),
				'already_activated_message' => esc_html__('Already activated', 'portfoliox-dark'),
				'version_label' => esc_html__('Version: ', 'portfoliox-dark'),
				'install_label' => esc_html__('Install and Activate', 'portfoliox-dark'),
				'activate_label' => esc_html__('Activate', 'portfoliox-dark'),
				'deactivate_label' => esc_html__('Deactivate', 'portfoliox-dark'),
				'content'                   => array(
					array(
						'slug' => 'magical-addons-for-elementor',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-products-display'
					),
					array(
						'slug' => 'magical-posts-display'
					),
					array(
						'slug' => 'click-to-top'
					),
					array(
						'slug' => 'gallery-box',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-blocks'
					),
					array(
						'slug' => 'easy-share-solution',
						'icon' => 'svg',
					),
					array(
						'slug' => 'wp-edit-password-protected',
						'icon' => 'svg',
					),
				),
			),
			// Required actions array.
			'recommended_actions'        => array(
				'install_label' => esc_html__('Install and Activate', 'portfoliox-dark'),
				'activate_label' => esc_html__('Activate', 'portfoliox-dark'),
				'deactivate_label' => esc_html__('Deactivate', 'portfoliox-dark'),
				'content'            => array(
					'magical-blocks' => array(
						'title'       => __('Magical Addons', 'portfoliox-dark'),
						'description' => __('Now you can add or update your site elements very easily by Magical Products Display. Supercharge your Elementor block with highly customizable Magical Blocks For WooCommerce.', 'portfoliox-dark'),
						'plugin_slug' => 'magical-addons-for-elementor',
						'id' => 'magical-addons-for-elementor'
					),
					'go-pro' => array(
						'title'       => '<a target="_blank" class="activate-now button button-danger" href="https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925">' . __('UPGRADE PortfolioX PRO', 'portfoliox-dark') . '</a>',
						'description' => __('You will get more frequent updates and quicker support with the Pro version.', 'portfoliox-dark'),
						//'plugin_slug' => 'x-instafeed',
						'id' => 'go-pro'
					),

				),
			),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => $xtheme_name,
				'pro_theme_name'      => $xtheme_name . __(' Pro', 'portfoliox-dark'),
				'pro_theme_link'      => 'https://wpthemespace.com/product/portfoliox-pro',
				/* translators: View link */
				'get_pro_theme_label' => sprintf(__('Get %s', 'portfoliox-dark'), 'PortfolioX Pro'),
				'features'            => array(
					array(
						'title'       => esc_html__('Daring Design for Devoted Readers', 'portfoliox-dark'),
						'description' => esc_html__('PortfolioX\'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'portfoliox-dark'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Mobile-Ready For All Devices', 'portfoliox-dark'),
						'description' => esc_html__('PortfolioX makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'portfoliox-dark'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Home slider', 'portfoliox-dark'),
						'description' => esc_html__('PortfolioX gives you extra slider feature. You can create awesome home slider in this theme.', 'portfoliox-dark'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Widgetized Sidebars To Keep Attention', 'portfoliox-dark'),
						'description' => esc_html__('PortfolioX comes with a widget-based flexible system which allows you to add your favorite widgets over the Sidebar as well as on offcanvas too.', 'portfoliox-dark'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Auto Set-up Feature', 'portfoliox-dark'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'portfoliox-dark'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Multiple Header Layout', 'portfoliox-dark'),
						'description' => esc_html__('PortfolioX gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'portfoliox-dark'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('One Click Demo install', 'portfoliox-dark'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'portfoliox-dark'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Extra Drag and drop support', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advanced Portfolio Filter', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Testimonial Carousel', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Diffrent Style Blog', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Flexible Home Page Design', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Pro Service Section', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Animation Home Text', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Customizer Options', 'portfoliox-dark'),
						'description' => esc_html__('Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Pagination', 'portfoliox-dark'),
						'description' => esc_html__('Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.', 'portfoliox-dark'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),

					array(
						'title'       => esc_html__('Premium Support and Assistance', 'portfoliox-dark'),
						'description' => esc_html__('We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('No Credit Footer Link', 'portfoliox-dark'),
						'description' => esc_html__('You can easily remove the Theme: PortfolioX by PortfolioX copyright from the footer area and make the theme yours from start to finish.', 'portfoliox-dark'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

		);

		portfoliox_dark_About::init($config);
	}

endif;

add_action('after_setup_theme', 'portfoliox_dark_about_setup');

function portfoliox_dark_pnotice_output()
{

?>
	<div class="mgadin-hero">
		<div class="mge-info-content">
			<div class="mge-info-hello">
				<?php
				$current_theme = wp_get_theme();
				$current_theme_name = $current_theme->get('Name');
				$current_user = wp_get_current_user();

				$demo_link = esc_url('https://wpthemespace.com/product/portfoliox-pro/');
				$pro_link = esc_url('https://wpthemespace.com/product/portfoliox-pro/?add-to-cart=5925');

				esc_html_e('Hello, ', 'portfoliox-dark');
				echo esc_html($current_user->display_name);
				?>

				<?php esc_html_e('👋🏻', 'portfoliox-dark'); ?>
			</div>
			<div class="mge-info-desc">
				<div><?php printf(esc_html__('Hi Buddy!! Now You are using the Free version of %1$s theme.', 'portfoliox-dark'), $current_theme_name); ?></div>
				<div><?php printf(esc_html__('%1$s PRO version is now available with an auto-setup feature!! Only active the theme and follow auto-setup then your site will be ready with lots of advanced features. Now create your site like a pro with only a few clicks!!!! So why late get pro now ', 'portfoliox-dark'), $current_theme_name); ?></div>
			</div>
			<div class="mge-info-actions">
				<a href="<?php echo esc_url($pro_link); ?>" target="_blank" class="button button-primary upgrade-btn">
					<?php esc_html_e('Upgrade Pro', 'portfoliox-dark'); ?>
				</a>
				<a href="<?php echo esc_url($demo_link); ?>" target="_blank" class="button button-primary demo-btn">
					<?php esc_html_e('View Demo', 'portfoliox-dark'); ?>
				</a>
				<button class="button button-info btnend"><?php esc_html_e('Dismiss this notice', 'portfoliox-dark') ?></button>
			</div>

		</div>

	</div>
<?php
}



//Admin notice 
function portfoliox_dark_new_optins_texts()
{
	global $pagenow;
	$pxdinfo_date = get_option('portfoliox_darkinfo_hide1');
	if (!empty($pxdinfo_date) || $pagenow == 'themes.php') {
		$clickhide = round((time() - strtotime($pxdinfo_date)) / 24 / 60 / 60);
		if ($clickhide < 27) {
			return;
		}
	}

?>
	<div class="mgadin-notice notice notice-success mgadin-theme-dashboard mgadin-theme-dashboard-notice mge is-dismissible meis-dismissible">
		<?php portfoliox_dark_pnotice_output(); ?>
	</div>
<?php

}
add_action('admin_notices', 'portfoliox_dark_new_optins_texts');

function portfoliox_dark_new_optins_texts_init()
{
	$install_date = get_option('portfoliox_dark_install_date');
	if (empty($install_date)) {
		update_option('portfoliox_dark_install_date', current_time('mysql'));
	}

	if (isset($_GET['xbnotice']) && $_GET['xbnotice'] == 1) {
		update_option('portfoliox_darkinfo_hide1', current_time('mysql'));
	}
}
add_action('init', 'portfoliox_dark_new_optins_texts_init');
