<?php
/**
 * Handle sellkit admin notice.
 *
 * @since 2.0.6
 *
 * @package JupiterX\Framework\Admin\Notices
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sellkit admin notice class.
 *
 * @since 2.0.6
 *
 * @package JupiterX\Framework\Admin\Notices
 */
class JupiterX_Sellkit_Admin_Notice {
	/**
	 * Current user.
	 *
	 * @var WP_User
	 */
	public $user;

	/**
	 * Meta key.
	 */
	const META_KEY = 'sellkit_install_noctice';

	/**
	 * Constructor.
	 *
	 * @since 2.0.6
	 */
	public function __construct() {
		$this->user = wp_get_current_user();

		add_action( 'admin_notices', [ $this, 'check_plugins' ] );
		add_action( 'wp_ajax_jupiterx_install_sellkit_in_notice', [ $this, 'install_plugins' ] );
		add_action( 'wp_ajax_jupiterx_dismiss_sellkit_notice', [ $this, 'dismiss_notice' ] );
	}

	/**
	 * Check the plugins and conditions to run notice.
	 *
	 * @since 2.0.6
	 */
	public function check_plugins() {
		if (
			! function_exists( 'WC' ) ||
			class_exists( 'Sellkit_Pro' ) ||
			! jupiterx_is_pro() ||
			strval( 1 ) === get_user_meta( $this->user->ID, self::META_KEY . '_dismissed', true )
		) {
			return;
		}

		$nonce = wp_create_nonce( 'jupiterx_install_sellkit_in_notice_nonce' );

		$this->get_notice( $nonce );
	}

	/**
	 * Fetch data on click.
	 *
	 * @since 2.0.6
	 */
	public function install_plugins() {
		$plugins = [
			'sellkit' => [
				'sellkit/sellkit.php',
				'https://downloads.wordpress.org/plugin/sellkit.latest-stable.zip',
			],
			'sellkit-pro' => [
				'sellkit-pro/sellkit-pro.php',
				get_transient( 'jupiterx_sellkit_pro_link' ),
			],
		];

		foreach ( $plugins as $plugin ) {
			$install = null;

			if ( ! $this->check_is_installed( $plugin[0] ) ) {
				$install = $this->install_plugin( $plugin[1] );
			}

			if ( ! is_wp_error( $install ) && $install ) {
				activate_plugin( $plugin[0] );
			}

			if ( $this->check_is_installed( $plugin[0] ) && ! is_plugin_active( $plugin[0] ) ) {
				activate_plugin( $plugin[0] );
			}
		}

		wp_send_json_success();
	}

	/**
	 * Dismiss notice.
	 *
	 * @since 2.0.6
	 * @return void
	 */
	public function dismiss_notice() {
		check_ajax_referer( 'jupiterx_install_sellkit_in_notice_nonce' );

		update_user_meta( $this->user->ID, self::META_KEY . '_dismissed', 1 );

		wp_send_json_success();
	}

	/**
	 * Install plugin.
	 *
	 * @param string $plugin_zip download link of the plugin.
	 * @since 2.0.6
	 */
	private function install_plugin( $plugin_zip ) {
		if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		$upgrader  = new Plugin_Upgrader();
		$installed = $upgrader->install( $plugin_zip );

		return $installed;
	}

	/**
	 * Install plugin.
	 *
	 * @param string $base plugin base path.
	 * @since 2.0.6
	 */
	private function check_is_installed( $base ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$all_plugins = get_plugins();

		if ( ! empty( $all_plugins[ $base ] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get Notice.
	 *
	 * @param string $nonce ajax nonce.
	 * @since 2.0.6
	 */
	private function get_notice( $nonce ) {
		$content = '';
		$icons   = [ 'woo-logo', 'sellkit-logo' ];
		$items   = [
			'No Customization',
			'Long & Confusing Checkout Form',
			'No Checkout Optimization Tools',
			'Short & Smart Checkout Form',
			'1-click Order Bumps & Upsells',
			'Sales Funnel',
			'Checkout Alerts',
			'Product attribute swatches',
			'Custom Thank you pages',
			'Personalized Coupons',
			'Automated Discounts',
			'Advanced Product Filtering',
		];
		?>
		<div data-nonce="<?php echo esc_attr( $nonce ); ?>" class="sellkit-notice-in-jupiterx notice is-dismissible">
			<p class="sellkit-notice-heading">
				<?php
				printf(
					/* translators: The sellkit notice. */
					esc_html__( 'Your Default WooCommerce Checkout is %1$s! %2$s', 'jupiterx-lite' ),
					'<span>Hurting Your Business</span>',
					'&#128560;&#128561;'
				);
				?>
			</p>
			<div class="sellkit-notice-body">
				<ul class="sellkit-notice-logo">
					<?php
						foreach ( $icons as $icon ) {
							printf(
								wp_kses_post( '<li><img src="%1$s" alt="%2$s"></li>' ),
								esc_url( JUPITERX_ADMIN_ASSETS_URL . 'images/sellkit-notice/' . $icon . '.svg' ),
								esc_html( str_replace( '-', ' ', $icon ) )
							);
						}
					?>
				</ul>
				<ul>
					<?php
					foreach ( $items as $item ) {
						$content .= '<li>' . $item . '</li>';
					}

					echo wp_kses_post( $content );
					?>
				</ul>
			</div>
			<div class="sellkit-notice-footer">
				<div class="sellkit-notice-buttons-wrapper">
					<a class="button button-primary jupiterx-notice-install-sellkit" href="#"><?php esc_html_e( 'Install Plugin Now', 'jupiterx-lite' ); ?></a>
					<a class="button jupiterx-dismiss-sellkit-notice" href="#"><?php esc_html_e( 'I’m Not Interested', 'jupiterx-lite' ); ?></a>
				</div>
				<span>
					<?php
					printf(
						/* translators: The sellkit notice. */
						wp_kses_post( '%1$s %2$s For Jupiter X Users', 'jupiterx' ),
						'<del>' . esc_html__( '$199/year', 'jupiterx-lite' ) . '</del>',
						'<b>100% Free </b> '
					);
					?>
				</span>
			</div>
		</div>
		<?php
	}
}

new JupiterX_Sellkit_Admin_Notice();
