<?php

/**
 * About page class
 *
 * @package Portfolio View
 * @subpackage Admin
 * @since 1.0.0
 */
if (!class_exists('portfolio_view_About')) {
	/**
	 * Singleton class used for generating the about page of the theme.
	 */
	class portfolio_view_About
	{
		/**
		 * Define the version of the class.
		 *
		 * @var string $version The TI_About_Page class version.
		 */
		private $version = '1.0.0';
		/**
		 * Used for loading the texts and setup the actions inside the page.
		 *
		 * @var array $config The configuration array for the theme used.
		 */
		private $config;
		/**
		 * Get the theme name using wp_get_theme.
		 *
		 * @var string $theme_name The theme name.
		 */
		private $theme_name;
		/**
		 * Get the theme slug ( theme folder name ).
		 *
		 * @var string $theme_slug The theme slug.
		 */
		private $theme_slug;
		/**
		 * The current theme object.
		 *
		 * @var WP_Theme $theme The current theme.
		 */
		private $theme;
		/**
		 * Holds the theme version.
		 *
		 * @var string $theme_version The theme version.
		 */
		private $theme_version;
		/**
		 * Define the menu item name for the page.
		 *
		 * @var string $menu_name The name of the menu name under Appearance settings.
		 */
		private $menu_name;
		/**
		 * Define the page title name.
		 *
		 * @var string $page_name The title of the About page.
		 */
		private $page_name;
		/**
		 * Define the page tabs.
		 *
		 * @var array $tabs The page tabs.
		 */
		private $tabs;
		/**
		 * Define the html notification content displayed upon activation.
		 *
		 * @var string $notification The html notification content.
		 */
		private $notification;
		/**
		 * The single instance of TI_About_Page
		 *
		 * @var portfolio_view_About $instance The  TI_About_Page instance.
		 */
		private static $instance;

		/**
		 * The Main TI_About_Page instance.
		 *
		 * We make sure that only one instance of TI_About_Page exists in the memory at one time.
		 *
		 * @param array $config The configuration array.
		 */
		public static function init($config)
		{
			if (!isset(self::$instance) && !(self::$instance instanceof portfolio_view_About)) {
				self::$instance = new portfolio_view_About;
				if (!empty($config) && is_array($config)) {
					self::$instance->config = $config;
					self::$instance->setup_config();
					self::$instance->setup_actions();
				}
			}
		}

		/**
		 * Setup the class props based on the config array.
		 */
		public function setup_config()
		{
			$theme = wp_get_theme();
			if (is_child_theme()) {
				$this->theme_name = $theme->parent()->get('Name');
				$this->theme      = $theme->parent();
			} else {
				$this->theme_name = $theme->get('Name');
				$this->theme      = $theme->parent();
			}
			$this->theme_name = $theme->get('Name');
			$this->theme_version = $theme->get('Version');
			$this->theme_slug    = $theme->get_template();
			$this->menu_name     = isset($this->config['menu_name']) ? $this->config['menu_name'] : 'About ' . $this->theme_name;
			$this->page_name     = isset($this->config['page_name']) ? $this->config['page_name'] : 'About ' . $this->theme_name;
			$this->notification  = isset($this->config['notification']) ? $this->config['notification'] : ('<p>' . sprintf('Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$swelcome page%3$s.', $this->theme_name, '<a href="' . esc_url(admin_url('themes.php?page=' . $this->theme_slug . '-welcome')) . '">', '</a>') . '</p><p><a href="' . esc_url(admin_url('themes.php?page=' . $this->theme_slug . '-welcome')) . '" class="button" style="text-decoration: none;">' . sprintf('Get started with %s', $this->theme_name) . '</a></p>');
			$this->tabs          = isset($this->config['tabs']) ? $this->config['tabs'] : array();
		}

		/**
		 * Setup the actions used for this page.
		 */
		public function setup_actions()
		{

			add_action('admin_menu', array($this, 'register'));
			/* activation notice */
			add_action('load-themes.php', array($this, 'activation_admin_notice'));
			/* enqueue script and style for about page */
			add_action('admin_enqueue_scripts', array($this, 'style_and_scripts'));

			/* ajax callback for dismissable required actions */
			add_action('wp_ajax_ti_about_page_dismiss_required_action', array($this, 'dismiss_required_action_callback'));
			add_action('wp_ajax_nopriv_ti_about_page_dismiss_required_action', array($this, 'dismiss_required_action_callback'));
		}

		/**
		 * Hide required tab if no actions present.
		 *
		 * @return bool Either hide the tab or not.
		 */
		public function hide_required($value, $tab)
		{
			if ($tab != 'recommended_actions') {
				return $value;
			}
			$required = $this->get_required_actions();
			if (count($required) == 0) {
				return false;
			} else {
				return true;
			}
		}


		/**
		 * Register the menu page under Appearance menu.
		 */
		function register()
		{
			if (!empty($this->menu_name) && !empty($this->page_name)) {

				$count = 0;

				$actions_count = $this->get_required_actions();

				if (!empty($actions_count)) {
					$count = count($actions_count);
				}

				$title = $count > 0 ? $this->page_name . '<span class="badge-action-count">' . esc_html($count) . '</span>' : $this->page_name;

				add_theme_page(
					$this->menu_name,
					$title,
					'activate_plugins',
					$this->theme_slug . '-welcome',
					array(
						$this,
						'ti_about_page_render',
					)
				);
			}
		}

		/**
		 * Adds an admin notice upon successful activation.
		 */
		public function activation_admin_notice()
		{
			global $pagenow;
			if (is_admin() && ('themes.php' == $pagenow) && isset($_GET['activated'])) {
				add_action('admin_notices', array($this, 'ti_about_page_welcome_admin_notice'), 99);
			}
		}

		/**
		 * Display an admin notice linking to the about page
		 */
		public function ti_about_page_welcome_admin_notice()
		{
			if (!empty($this->notification)) {
				echo '<div class="updated notice is-dismissible">';
				echo wp_kses_post($this->notification);
				echo '</div>';
			}
		}

		/**
		 * Render the main content page.
		 */
		public function ti_about_page_render()
		{

			if (!empty($this->config['welcome_title'])) {
				$welcome_title = $this->config['welcome_title'];
			}
			if (!empty($this->config['welcome_content'])) {
				$welcome_content = $this->config['welcome_content'];
			}

			if (!empty($welcome_title) || !empty($welcome_content) || !empty($this->tabs)) {

				echo '<div class="wrap about-wrap portfolio-view-about-wrap">';

				if (!empty($welcome_title)) {
					echo '<h1>';
					echo esc_html($welcome_title);
					if (!empty($this->theme_version)) {
						echo esc_html($this->theme_version) . ' </sup>';
					}
					echo '</h1>';
				}
				if (!empty($welcome_content)) {
					echo '<div class="about-text">' . wp_kses_post($welcome_content) . '</div>';
				}

				echo '<a href="' . esc_url('https://wpthemespace.com/product/portfolio-view-pro/') . '" target="_blank" class="wp-badge epsilon-welcome-logo"></a>';

				$this->render_quick_links();

				/* Display tabs */
				if (!empty($this->tabs)) {
					$active_tab = isset($_GET['tab']) ? sanitize_text_field(wp_unslash($_GET['tab'])) : 'getting_started';

					echo '<h2 class="nav-tab-wrapper wp-clearfix">';

					$actions_count = $this->get_required_actions();

					$count = 0;

					if (!empty($actions_count)) {
						$count = count($actions_count);
					}


					foreach ($this->tabs as $tab_key => $tab_name) {

						if (($tab_key != 'changelog') || (($tab_key == 'changelog') && isset($_GET['show']) && ($_GET['show'] == 'yes'))) {

							if (($count == 0) && ($tab_key == 'recommended_actions')) {
								continue;
							}

							echo '<a href="' . esc_url(admin_url('themes.php?page=' . $this->theme_slug . '-welcome')) . '&tab=' . esc_attr($tab_key) . '" class="nav-tab ' . ($active_tab == $tab_key ? 'nav-tab-active' : '') . '" role="tab" data-toggle="tab">';
							echo esc_html($tab_name);
							if ($tab_key == 'recommended_actions') {
								$count = 0;

								$actions_count = $this->get_required_actions();

								if (!empty($actions_count)) {
									$count = count($actions_count);
								}
								if ($count > 0) {
									echo '<span class="badge-action-count">' . esc_html($count) . '</span>';
								}
							}
							echo '</a>';
						}
					}

					echo '</h2>';

					/* Display content for current tab */
					if (method_exists($this, $active_tab)) {
						$this->$active_tab();
					}
				}

				echo '</div><!--/.wrap.about-wrap-->';
			}
		}

		/*
		 * Call plugin api
		 */
		public function call_plugin_api($slug)
		{
			include_once(ABSPATH . 'wp-admin/includes/plugin-install.php'); // phpcs:ignore

			if (false === ($call_api = get_transient('ti_about_page_plugin_information_transient_' . $slug))) {
				$call_api = plugins_api(
					'plugin_information',
					array(
						'slug'   => $slug,
						'fields' => array(
							'downloaded'        => false,
							'rating'            => false,
							'description'       => false,
							'short_description' => true,
							'donate_link'       => false,
							'tags'              => false,
							'sections'          => true,
							'homepage'          => true,
							'added'             => false,
							'last_updated'      => false,
							'compatibility'     => false,
							'tested'            => false,
							'requires'          => false,
							'downloadlink'      => false,
							'icons'             => true
						)
					)
				);
				set_transient('ti_about_page_plugin_information_transient_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS);
			}

			return $call_api;
		}

		public function check_if_plugin_active($slug)
		{
			if (($slug == 'intergeo-maps') || ($slug == 'visualizer')) {
				$plugin_root_file = 'index';
			} elseif ($slug == 'adblock-notify-by-bweb') {
				$plugin_root_file = 'adblock-notify';
			} else {
				$plugin_root_file = $slug;
			}

			$path = WPMU_PLUGIN_DIR . '/' . $slug . '/' . $plugin_root_file . '.php';
			if (!file_exists($path)) {
				$path = WP_PLUGIN_DIR . '/' . $slug . '/' . $plugin_root_file . '.php';
				if (!file_exists($path)) {
					$path = false;
				}
			}

			if (file_exists($path)) {

				include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // phpcs:ignore

				$needs = is_plugin_active($slug . '/' . $plugin_root_file . '.php') ? 'deactivate' : 'activate';

				return array('status' => is_plugin_active($slug . '/' . $plugin_root_file . '.php'), 'needs' => $needs);
			}

			return array('status' => false, 'needs' => 'install');
		}

		/**
		 * Get icon of wordpress.org plugin
		 * @param $arr
		 *
		 * @return mixed
		 */
		public function get_plugin_icon($arr)
		{

			if (!empty($arr['svg'])) {
				$plugin_icon_url = $arr['svg'];
			} elseif (!empty($arr['2x'])) {
				$plugin_icon_url = $arr['2x'];
			} elseif (!empty($arr['1x'])) {
				$plugin_icon_url = $arr['1x'];
			} else {
				$plugin_icon_url = get_template_directory_uri() . '/inc/about/images/logo.png';
			}

			return $plugin_icon_url;
		}

		public function create_action_link($state, $slug)
		{

			if (($slug == 'intergeo-maps') || ($slug == 'visualizer')) {
				$plugin_root_file = 'index';
			} elseif ($slug == 'adblock-notify-by-bweb') {
				$plugin_root_file = 'adblock-notify';
			} else {
				$plugin_root_file = $slug;
			}

			switch ($state) {
				case 'install':
					return wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $slug
							),
							network_admin_url('update.php')
						),
						'install-plugin_' . $slug
					);
					break;
				case 'deactivate':
					return add_query_arg(
						array(
							'action'        => 'deactivate',
							'plugin'        => rawurlencode($slug . '/' . $plugin_root_file . '.php'),
							'plugin_status' => 'all',
							'paged'         => '1',
							'_wpnonce'      => wp_create_nonce('deactivate-plugin_' . $slug . '/' . $plugin_root_file . '.php'),
						),
						network_admin_url('plugins.php')
					);
					break;
				case 'activate':
					return add_query_arg(
						array(
							'action'        => 'activate',
							'plugin'        =>  rawurlencode($slug . '/' . $plugin_root_file . '.php'),
							'plugin_status' => 'all',
							'paged'         => '1',
							'_wpnonce'      => wp_create_nonce('activate-plugin_' . $slug . '/' . $plugin_root_file . '.php'),
						),
						network_admin_url('plugins.php')
					);
					break;
			}
		}


		/**
		 * Render quick links.
		 *
		 * @since 1.0.0
		 */
		public function render_quick_links()
		{

			$quick_links = (isset($this->config['quick_links'])) ? $this->config['quick_links'] : array();

			if (!empty($quick_links)) {
				echo '<p class="quick-links">';
				foreach ($quick_links as $link) {
					$button_type = '';
					if (isset($link['button'])) {
						$button_type = 'button-' . esc_attr($link['button']);
					}
					echo '<a href="' . esc_url($link['url']) . '" class="button ' . esc_attr($button_type) . '" target="_blank">' . esc_html($link['text']) . '</a>';
				}
				echo '</p>';
			}
		}

		/**
		 * Render getting started.
		 *
		 * @since 1.0.0
		 */
		public function getting_started()
		{

			$content = (isset($this->config['getting_started'])) ? $this->config['getting_started'] : array();
			if (empty($content)) {
				return;
			}
?>
			<div class="feature-section portfolio-view-section portfolio-view-section-getting-started three-col">
				<?php foreach ($content as $item) : ?>
					<?php $this->render_grid_item($item); ?>
				<?php endforeach; ?>
			</div><!-- .feature-section .portfolio-view-section -->
		<?php
		}

		/**
		 * Render grid item.
		 *
		 * @since 1.0.0
		 *
		 * @param array $item Item details.
		 */
		private function render_grid_item($item)
		{
		?>

			<div class="col">
				<?php if (isset($item['title']) && !empty($item['title'])) : ?>
					<h3>
						<?php if (isset($item['icon']) && !empty($item['icon'])) : ?>
							<span class="<?php echo esc_attr($item['icon']); ?>"></span>
						<?php endif; ?>
						<?php echo esc_html($item['title']); ?>
					</h3>
				<?php endif; ?>
				<?php if (isset($item['description']) && !empty($item['description'])) : ?>
					<p><?php echo wp_kses_post($item['description']); ?></p>
				<?php endif; ?>
				<?php if (isset($item['button_text']) && !empty($item['button_text']) && isset($item['button_url']) && !empty($item['button_url'])) : ?>
					<?php
					$button_target = (isset($item['is_new_tab']) && true === $item['is_new_tab']) ? '_blank' : '_self';
					$button_class = '';
					if (isset($item['button_type']) && !empty($item['button_type'])) {
						if ('primary' === $item['button_type']) {
							$button_class = 'button button-primary';
						} elseif ('secondary' === $item['button_type']) {
							$button_class = 'button button-secondary';
						}
					}
					?>
					<a href="<?php echo esc_url($item['button_url']); ?>" class="<?php echo esc_attr($button_class); ?>" target="<?php echo esc_attr($button_target); ?>"><?php echo esc_html($item['button_text']); ?></a>
				<?php endif; ?>
			</div><!-- .col -->
		<?php
		}

		/**
		 * Render support.
		 *
		 * @since 1.0.0
		 */
		public function support()
		{
			$content = (isset($this->config['support'])) ? $this->config['support'] : array();
			if (empty($content)) {
				return;
			}
		?>
			<div class="feature-section portfolio-view-section portfolio-view-section-support three-col">

				<?php foreach ($content as $item) : ?>
					<?php $this->render_grid_item($item); ?>
				<?php endforeach; ?>
			</div><!-- .feature-section .portfolio-view-section -->
			<?php
		}
		/**
		 * Recommended Actions tab
		 */
		public function recommended_actions()
		{

			$recommended_actions = isset($this->config['recommended_actions']) ? $this->config['recommended_actions'] : array();

			if (!empty($recommended_actions)) {

				echo '<div class="feature-section action-required demo-import-boxed" id="plugin-filter">';

				$actions = array();
				$req_actions = isset($this->config['recommended_actions']) ? $this->config['recommended_actions'] : array();
				foreach ($req_actions['content'] as $req_action) {
					$actions[] = $req_action;
				}

				if (!empty($actions) && is_array($actions)) {

					$ti_about_page_show_required_actions = get_option($this->theme_slug . '_required_actions');

					$hooray = true;

					foreach ($actions as $action_key => $action_value) {

						$hidden = false;
						echo '<div class="about-page-action-required-box">';

						if (!$hidden) {
							echo '<span data-action="dismiss" class="dashicons dashicons-visibility about-page-required-action-button" id="' . esc_attr($action_value['id']) . '"></span>';
						} else {
							echo '<span data-action="add" class="dashicons dashicons-hidden about-page-required-action-button" id="' . esc_attr($action_value['id']) . '"></span>';
						}

						if (!empty($action_value['title'])) {
							echo '<h3>' . wp_kses_post($action_value['title']) . '</h3>';
						}

						if (!empty($action_value['description'])) {
							echo '<p>' . wp_kses_post($action_value['description']) . '</p>';
						}

						if (!empty($action_value['plugin_slug'])) {

							$active = $this->check_if_plugin_active($action_value['plugin_slug']);
							$url    = $this->create_action_link($active['needs'], $action_value['plugin_slug']);
							$label  = '';

							switch ($active['needs']) {

								case 'install':
									$class = 'install-now button';
									if (!empty($this->config['recommended_actions']['install_label'])) {
										$label = $this->config['recommended_actions']['install_label'];
									}
									break;
								case 'activate':
									$class = 'activate-now button button-primary';
									if (!empty($this->config['recommended_actions']['activate_label'])) {
										$label = $this->config['recommended_actions']['activate_label'];
									}
									break;
								case 'deactivate':
									$class = 'deactivate-now button';
									if (!empty($this->config['recommended_actions']['deactivate_label'])) {
										$label = $this->config['recommended_actions']['deactivate_label'];
									}
									break;
							}

			?>
							<p class="plugin-card-<?php echo esc_attr($action_value['plugin_slug']) ?> action_button <?php echo ($active['needs'] !== 'install' && $active['status']) ? 'active' : '' ?>">
								<a data-slug="<?php echo esc_attr($action_value['plugin_slug']) ?>" class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url($url) ?>"> <?php echo esc_html($label) ?> </a>
							</p>

<?php

						}
						echo '</div>';
					}
				}
				echo '</div>';
			}
		}

		/**
		 * Recommended plugins tab
		 */
		public function useful_plugins()
		{
			$useful_plugins = $this->config['useful_plugins'];
			if (!empty($useful_plugins)) {
				if (!empty($useful_plugins['content']) && is_array($useful_plugins['content'])) {

					echo '<div class="feature-section recommended-plugins three-col demo-import-boxed" id="plugin-filter">';

					foreach ($useful_plugins['content'] as $useful_plugins_item) {

						if (!empty($useful_plugins_item['slug'])) {
							$info   = $this->call_plugin_api($useful_plugins_item['slug']);
							if (!empty($info->icons)) {
								$icon = $this->get_plugin_icon($info->icons);
							}

							$active = $this->check_if_plugin_active($useful_plugins_item['slug']);

							if (!empty($active['needs'])) {
								$url = $this->create_action_link($active['needs'], $useful_plugins_item['slug']);
							}

							echo '<div class="col plugin_box">';
							if (!empty($icon)) {
								echo '<img src="' . esc_url($icon) . '" alt="plugin box image">';
							}
							if (!empty($info->version)) {
								echo '<span class="version">' . (!empty($this->config['useful_plugins']['version_label']) ? esc_html($this->config['useful_plugins']['version_label']) : '') . esc_html($info->version) . '</span>';
							}


							if (!empty($info->name) && !empty($active)) {
								echo '<div class="action_bar ' . (($active['needs'] !== 'install' && $active['status']) ? 'active' : '') . '">';
								echo '<span class="plugin_name">' . (($active['needs'] !== 'install' && $active['status']) ? 'Active: ' : '') . esc_html($info->name) . '</span>';
								echo '</div>';

								$label = '';

								switch ($active['needs']) {
									case 'install':
										$class = 'install-now button';
										if (!empty($this->config['useful_plugins']['install_label'])) {
											$label = $this->config['useful_plugins']['install_label'];
										}
										break;
									case 'activate':
										$class = 'activate-now button button-primary';
										if (!empty($this->config['useful_plugins']['activate_label'])) {
											$label = $this->config['useful_plugins']['activate_label'];
										}
										break;
									case 'deactivate':
										$class = 'deactivate-now button';
										if (!empty($this->config['useful_plugins']['deactivate_label'])) {
											$label = $this->config['useful_plugins']['deactivate_label'];
										}
										break;
								}

								echo '<span class="plugin-card-' . esc_attr($useful_plugins_item['slug']) . ' action_button ' . (($active['needs'] !== 'install' && $active['status']) ? 'active' : '') . '">';
								echo '<a data-slug="' . esc_attr($useful_plugins_item['slug']) . '" class="' . esc_attr($class) . '" href="' . esc_url($url) . '">' . esc_html($label) . '</a>';
								echo '</span>';
							}
							echo '</div><!-- .col.plugin_box -->';
						}
					}

					echo '</div><!-- .recommended-plugins -->';
				}
			}
		}

		/**
		 * Changelog tab
		 */
		public function changelog()
		{
			$changelog = $this->parse_changelog();
			if (!empty($changelog)) {
				echo '<div class="featured-section changelog">';
				foreach ($changelog as $release) {
					if (!empty($release['title'])) {
						echo '<h2>' . wp_kses_post($release['title']) . ' </h2 > ';
					}
					if (!empty($release['changes'])) {
						echo wp_kses_post(implode('<br/>', $release['changes']));
					}
				}
				echo '</div><!-- .featured-section.changelog -->';
			}
		}

		/**
		 * Return the releases changes array.
		 *
		 * @return array The releases array.
		 */
		private function parse_changelog()
		{
			WP_Filesystem();
			global $wp_filesystem;
			$changelog = $wp_filesystem->get_contents(get_template_directory() . '/CHANGELOG.md');
			if (is_wp_error($changelog)) {
				$changelog = '';
			}
			$changelog = explode(PHP_EOL, $changelog);
			$releases  = array();
			foreach ($changelog as $changelog_line) {
				if (strpos($changelog_line, '**Changes:**') !== false || empty($changelog_line)) {
					continue;
				}
				if (substr($changelog_line, 0, 3) === '###') {
					if (isset($release)) {
						$releases[] = $release;
					}
					$release = array(
						'title'   => substr($changelog_line, 3),
						'changes' => array(),
					);
				} else {
					$release['changes'][] = $changelog_line;
				}
			}

			return $releases;
		}

		/**
		 * Free vs PRO tab
		 */
		public function free_pro()
		{
			$free_pro = isset($this->config['free_pro']) ? $this->config['free_pro'] : array();
			if (!empty($free_pro)) {
				if (!empty($free_pro['free_theme_name']) && !empty($free_pro['pro_theme_name']) && !empty($free_pro['features']) && is_array($free_pro['features'])) {
					echo '<div class="feature-section">';
					echo '<div id="free_pro" class="about-page-tab-pane about-page-fre-pro">';
					echo '<table class="free-pro-table">';
					echo '<thead>';
					echo '<tr>';
					echo '<th></th>';
					echo '<th>' . esc_html($free_pro['free_theme_name']) . '</th>';
					echo '<th>' . esc_html($free_pro['pro_theme_name']) . '</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					foreach ($free_pro['features'] as $feature) {
						echo '<tr>';
						if (!empty($feature['title']) || !empty($feature['description'])) {
							echo '<td>';
							if (!empty($feature['title'])) {
								echo '<h3>' . wp_kses_post($feature['title']) . '</h3>';
							}
							if (!empty($feature['description'])) {
								echo '<p>' . wp_kses_post($feature['description']) . '</p>';
							}
							echo '</td>';
						}
						if (!empty($feature['is_in_lite']) && ($feature['is_in_lite'] == 'true')) {
							echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
						} else {
							echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
						}
						if (!empty($feature['is_in_pro']) && ($feature['is_in_pro'] == 'true')) {
							echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
						} else {
							echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
						}
						echo '</tr>';
					}
					echo '<tr><td style="border-top:0;"></td><td style="border-top:0;"></td><td style="border-top:0;" class="only-pro"><a href="' . esc_url('https://wpthemespace.com/product/portfolio-view-pro/') . '" target="_blank" >';
					echo esc_html('Portfolio View Pro Live Preview', 'portfolio-view');
					echo '</a></td></tr>';
					if (!empty($free_pro['pro_theme_link']) && !empty($free_pro['get_pro_theme_label'])) {
						echo '<tr class="about-page-text-center">';
						echo '<td></td>';
						echo '<td colspan="2"><a href="' . esc_url($free_pro['pro_theme_link']) . '" target="_blank" class="button button-primary button-hero">' . wp_kses_post($free_pro['get_pro_theme_label']) . '</a></td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
					echo '</div>';
					echo '</div>';
				}
			}
		}

		/**
		 * Load css and scripts for the about page
		 */
		public function style_and_scripts($hook_suffix)
		{

			// this is needed on all admin pages, not just the about page, for the badge action count in the WordPress main sidebar
			wp_enqueue_style('about-page-css', get_template_directory_uri() . '/inc/about/css/about.min.css', array(), '2.3.5', 'all');
			wp_enqueue_script('eye-notice-js', get_template_directory_uri() . '/inc/about/js/notice.js', array('jquery'), '2.3.2', true);

			if ('appearance_page_' . $this->theme_slug . '-welcome' == $hook_suffix) {

				wp_enqueue_script('about-page-js', get_template_directory_uri() . '/inc/about/js/about.min.js', array('jquery'));

				wp_enqueue_style('plugin-install');
				wp_enqueue_script('plugin-install');
				wp_enqueue_script('updates');

				$recommended_actions         = isset($this->config['recommended_actions']) ? $this->config['recommended_actions'] : array();
				$required_actions = $this->get_required_actions();
				wp_localize_script(
					'about-page-js',
					'tiAboutPageObject',
					array(
						'nr_actions_required'      => count($required_actions),
						'ajaxurl'                  => esc_url(admin_url('admin-ajax.php')),
						'template_directory'       => get_template_directory_uri(),
						'activating_string'        => __('Activating', 'portfolio-view')
					)
				);
			}
		}

		/**
		 * Return the valid array of required actions.
		 *
		 * @return array The valid array of required actions.
		 */
		private function get_required_actions()
		{
			$saved_actions = get_option($this->theme_slug . '_required_actions');
			if (!is_array($saved_actions)) {
				$saved_actions = array();
			}
			$req_actions = isset($this->config['recommended_actions']) ? $this->config['recommended_actions'] : array();
			$valid       = array();
			foreach ($req_actions['content'] as $req_action) {
				if ((!isset($req_action['check']) || (isset($req_action['check']) && ($req_action['check'] == false))) && (!isset($saved_actions[$req_action['id']]))) {
					$valid[] = $req_action;
				}
			}

			return $valid;
		}

		/**
		 * Dismiss required actions
		 */
		public function dismiss_required_action_callback()
		{

			$recommended_actions = array();
			$req_actions = isset($this->config['recommended_actions']) ? $this->config['recommended_actions'] : array();
			foreach ($req_actions['content'] as $req_action) {
				$recommended_actions[] = $req_action;
			}

			$action_id = (isset($_GET['id'])) ? sanitize_text_field(wp_unslash($_GET['id'])) : 0;

			echo esc_html(wp_unslash($action_id)); /* this is needed and it's the id of the dismissable required action */

			if (!empty($action_id)) {

				/* if the option exists, update the record for the specified id */
				if (get_option($this->theme_slug . '_required_actions')) {

					$ti_about_page_show_required_actions = get_option($this->theme_slug . '_required_actions');

					$todo = (isset($_GET['todo'])) ? sanitize_text_field(wp_unslash($_GET['todo'])) : '';
					switch ($todo) {
						case 'add';
							$ti_about_page_show_required_actions[absint($action_id)] = true;
							break;
						case 'dismiss';
							$ti_about_page_show_required_actions[absint($action_id)] = false;
							break;
					}

					update_option($this->theme_slug . '_required_actions', $ti_about_page_show_required_actions);

					/* create the new option,with false for the specified id */
				} else {

					$ti_about_page_show_required_actions_new = array();

					if (!empty($recommended_actions)) {

						foreach ($recommended_actions as $ti_about_page_required_action) {

							if ($ti_about_page_required_action['id'] == $action_id) {
								$ti_about_page_show_required_actions_new[$ti_about_page_required_action['id']] = false;
							} else {
								$ti_about_page_show_required_actions_new[$ti_about_page_required_action['id']] = true;
							}
						}

						update_option($this->theme_slug . '_required_actions', $ti_about_page_show_required_actions_new);
					}
				}
			}
		}
	}
}
