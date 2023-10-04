<?php
/**
 * Woocommerce Register Customizer Sections
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Nexter_Woocommerce_Customizer_Register' ) ) {

	class Nexter_Woocommerce_Customizer_Register {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'customize_register', 	array( $this, 'woo_register_configuration' ) );
			add_action( 'customize_controls_print_scripts', array( $this, 'add_woo_scripts' ), 30 );
		}
		
		public function woo_register_configuration( $wp_customize ) {

			/**
			 * Woocommerce => General
			 */
			$wp_customize->add_section( new Nexter_Customizer_Section( $wp_customize, 'section-woocommerce-general', array(
				'title' 			=> esc_html__( 'General', 'nexter' ),
				'priority' 			=> 20,
				'panel' 			=> 'woocommerce',
			) ) );
			
		}
		
		public function add_woo_scripts() {
		?>
		<script type="text/javascript">
			jQuery( function( $ ) {
			var api = wp.customize;
				api.section( 'section-woocommerce-general', function( section ) {
					section.expanded.bind( function( isExpanded ) {
						if ( isExpanded ) {
							api.previewer.previewUrl.set( '<?php echo esc_js( wc_get_page_permalink( 'shop' ) ); ?>' );
						}
					} );
				} );
			});
		</script>
		<?php			
		}
		
	}
}


new Nexter_Woocommerce_Customizer_Register;