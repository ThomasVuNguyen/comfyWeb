<?php
/**
 * Nexter WooCommerce Compatibility.
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! class_exists( 'Nexter_Woocommerce_Compatibility' ) ) {

	class Nexter_Woocommerce_Compatibility {

		/**
		 * Member Variable
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			// Woocommerce Setup theme
			add_action( 'after_setup_theme', array( $this, 'woo_setup_theme' ) );
			
			// Woocommerce Style And Scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			
			add_action( 'wp_head', array( $this, 'single_product_config' ), 5 );
			add_action( 'wp', array( $this, 'woocommerce_actions' ), 1 );
			
			/*Shop Loop Before And After Wrap Start/End */
			add_action( 'woocommerce_before_shop_loop_item', array( $this,'woo_shop_loop_thumb_wrap_before'), 6 );
			add_action( 'woocommerce_after_shop_loop_item', array( $this,'woo_shop_loop_thumb_wrap_after'), 8 );
			
			/**
			 * Add Out of Stock to the Shop page
			 */
			add_action( 'woocommerce_before_shop_loop_item', array( $this,'woo_product_badge_sale'), 9 );
			
			/*
			 * Woocommerce render html Rating bar 
			 */
			add_filter( 'woocommerce_product_get_rating_html', array( $this, 'woo_rating_render_html' ), 10, 3 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'woo_related_products_args' ) );
			
			//add_filter( 'post_class', array( $this, 'woo_shop_products_list_item_class' ) );
			
			add_filter( 'woocommerce_subcategory_count_html', array( $this, 'woo_subcategory_count_render_html' ), 10, 2 );

			add_action( 'woocommerce_before_shop_loop', array( $this, 'woo_shop_header_wrap_start' ), 15 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'woo_shop_header_wrap_end' ), 30 );
			
			add_action( 'woocommerce_before_main_content', array( $this, 'woo_before_main_content' ) );
			add_action( 'woocommerce_after_main_content', array( $this, 'woo_after_main_content' ) );
			add_filter('nexter_sidebar_layout', array( $this, 'woo_sidebar_layout'));
			
			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'woo_customizer_sections' ), 2 );
			}
			$this->woo_customizer_options();
			add_filter('nexter_container_layout', array( $this, 'woo_container_layout'));
			
			add_filter('body_class', array( $this, 'woo_body_class'));
			
			
			/**
			 * WooCommerce Shop Product Listing
			 */
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'woo_shop_product_listing_content') );
		}
		
		public function woo_sidebar_layout( $get_sidebar ){
		
			if ( is_shop() || is_product_taxonomy() || is_checkout() || is_cart() || is_account_page() ) {
				$woo_sidebar = nexter_get_option( 'woo-sidebar-layout', 'default' );
				if('default' == $woo_sidebar || empty( $woo_sidebar )){
					return $get_sidebar;
				}else if(!empty($woo_sidebar)){
					$get_sidebar['layout'] = $woo_sidebar;
					$get_sidebar['sidebar'] = nexter_get_option( 'woo-display-sidebar','sidebar-1' );
					if( $get_sidebar['sidebar'] === 'custom' ){
						$get_sidebar['custom'] = nexter_get_option( 'woo-custom-sidebar', 'none' );
					}
				}
			}
			
			return $get_sidebar;
		}
		
		public function woo_before_main_content(){
			$get_sidebar = nexter_site_sidebar_layout();
			$content_column = 'nxt-col-md-12';
			
			if(!empty($get_sidebar) && ($get_sidebar['layout'] == 'left-sidebar' || $get_sidebar['layout'] == 'right-sidebar') ){
				$content_column = ' nxt-col-md-8 nxt-col-sm-12';		
			}
			echo '<div id="primary" class="content-area">';
			echo '<main id="main" class="site-main">';
			echo '<div class="nxt-row">';
				/* Left Sidebar */
				if ( !empty($get_sidebar) && $get_sidebar['layout'] == 'left-sidebar' ) :
					get_sidebar();
				endif;
				/* Left Sidebar */
				echo '<div class="nxt-col '.esc_attr($content_column).'">';
		}
		
		public function woo_after_main_content(){
			$get_sidebar = nexter_site_sidebar_layout();
				echo '</div>';
				/* Right Sidebar */
				if ( !empty($get_sidebar) && $get_sidebar['layout'] == 'right-sidebar' ) :
					get_sidebar();
				endif;
				/* Right Sidebar */
			echo '</div>';
			echo '</main>';
			echo '</div>';
		}
		
		/**
		 * Setup theme
		 */
		public function woo_setup_theme() {
			// gallery zoom.
			add_theme_support( 'wc-product-gallery-zoom' );
			// gallery lightbox.
			add_theme_support( 'wc-product-gallery-lightbox' );
			// gallery slider.
			add_theme_support( 'wc-product-gallery-slider' );
		}
		
		/**
		 * Woocommerce Css And Js
		 */
		public function enqueue_scripts() {
			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_style( 'nxt-woocommerce', NXT_CSS_URI .'main/woocommerce'. $minified .'.css', false, NXT_VERSION, 'all');
		}
		
		/**
		 * Single Product Config
		 */
		public function single_product_config() {

			if ( is_product() ) {
				//Return False Empty Product Description Heading
				add_filter( 'woocommerce_product_description_heading', '__return_false' );
				//Return False Empty Product Additional Info. Heading
				add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

				// Breadcrumb.
				add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 2 );
			}
		}
		
		/**
		 * Remove Actions Woocommerce 
		 */
		public function woocommerce_actions() {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
		
		/**
		 * Woocommerce Before Shop Loop Item 
		 */
		public function woo_shop_loop_thumb_wrap_before() {
			echo '<div class="nxt-prodcut-thumb-wrap">';
		}
		
		/**
		 * Woocommerce After Shop Loop Item
		 */
		public function woo_shop_loop_thumb_wrap_after() {
			global $product;
			$attachment_ids = $product->get_gallery_image_ids();
			if ( $attachment_ids && ! get_post_meta( $attachment_ids[0], '_woocommerce_exclude_image', true ) ) { 
				echo '<a href="'.esc_url(get_the_permalink()).'" title="'. the_title_attribute(array('echo' => 0)).'" class="nxt-hover-thumb">'.wp_get_attachment_image( $attachment_ids[0], 'shop_catalog' ).'</a>';	
			}
			woocommerce_template_loop_add_to_cart();		
			echo '</div>';
		}
		
		/**
		 * Add Badge Sale OR Out of Stock In Shop Loop
		 */
		public function woo_product_badge_sale() {
			global $post, $product;
			
			$out_of_stock_text = apply_filters( 'nxt_woo_out_of_stock_text', __( 'Out of stock', 'nexter' ) );
			$out_of_stock_staus        = get_post_meta( get_the_ID(), '_stock_status', true );
			
			if ( $out_of_stock_staus === 'outofstock' ) {
				echo '<span class="badge nxt-product-out-of-stock">' . esc_html( $out_of_stock_text ) . '</span>';
			} else if ( $product->is_on_sale() ) {
				if ('discount' == 'discount') {
					if ($product->get_type() == 'variable') {
						$available_variations = $product->get_available_variations();								
						$maximumper = 0;
						for ($i = 0; $i < count($available_variations); ++$i) {
							$variation_id=$available_variations[$i]['variation_id'];
							$variable_product1= new WC_Product_Variation( $variation_id );
							$regular_price = $variable_product1->get_regular_price();
							$sales_price = $variable_product1->get_sale_price();
							$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
							if ($percentage > $maximumper) {
								$maximumper = $percentage;
							}
						}
						echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					} else if ($product->get_type() == 'simple'){
						$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
						echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					} else if ($product->get_type() == 'external'){
						$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
						echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				} else {
					echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.esc_html__( 'Sale','nexter' ).'</span>', $post, $product);// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}
	
		/**
		 * Rating render html
		 */
		public function woo_rating_render_html( $html, $rating, $count ) {

			if ( $rating == 0 ) {
				$html  = '<div class="star-rating">';
					$html .= wc_get_star_rating_html( $rating, $count );
				$html .= '</div>';
			}
			return $html;
		}
		
		/**
		 * Shop Page Header Before Start
		 */
		public function woo_shop_header_wrap_start(){
			echo '<div class="nxt-prodcut-nav nxt-row">';
				echo '<div class="nxt-col nxt-col-lg-6 nxt-col-md-4 nxt-col-sm-4 align-items-center nxt-flex ">';
					woocommerce_breadcrumb();
				echo '</div>';
			echo '<div class="align-items-center justify-content-end nxt-col nxt-col-lg-6 nxt-col-md-8 nxt-col-sm-8 nxt-flex">';				
		}
		
		/**
		 * Shop Page Header Before end
		 */
		public function woo_shop_header_wrap_end(){
				echo '</div>';
			echo '</div>';
		}
		
		/**
		 * Subcategory Count Render html
		 */
		public function woo_subcategory_count_render_html( $content, $category ) {

			$content = sprintf( // WPCS: XSS OK.
					/* translators: 1: count of products */
					_nx( '(%1$s)', '(%1$s)', $category->count, 'product categories', 'nexter' ),
				number_format_i18n( $category->count )
			);
			return $content;
		}

		/**
		 * WooCommerce Shop Page Add products item class
		*/
		public function woo_shop_products_list_item_class( $classes = '' ) {

			if ( is_shop() || is_product_taxonomy() ) {
				$columns      = get_option( 'woocommerce_catalog_columns', 4 );
				$column_array = [ 1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2 ];
				$classes[] = 'nxt-col nxt-col-6  nxt-col-md-4 nxt-col-sm-6';
				if(!empty($columns) && in_array($columns,$column_array) ){
					$classes[] = 'nxt-col-lg-'.$column_array[$columns];
				}
				
				$classes[] = 'nxt-woo-shop-archive';
			}
			
			return $classes;
		} 

		/**
		 * Woocommerce related product args
		 */
		public function woo_related_products_args( $args ) {
			$args['posts_per_page'] = 4;
			return $args;
		}
		
		/*
		 * WooCommerce Shop Product Listing
		 */
		public function woo_shop_product_listing_content() {
			$product_listing_layout = array( 'title', 'ratings', 'price' );
			
			if ( ! empty( $product_listing_layout ) ) {

				echo '<div class="nxt-shop-summary-wrap text-center">';

				foreach ( $product_listing_layout as $value ) {

					switch ( $value ) {
						case 'title':
							echo '<a href="' . esc_url( get_the_permalink() ) . '" class="nxt-loop-product-link">';
								woocommerce_template_loop_product_title();
							echo '</a>';
							break;
							
						case 'ratings':
							woocommerce_template_loop_rating();						
							break;
							
						case 'price':
							woocommerce_template_loop_price();
							break;
							
						default:
							break;
					}
				}

				echo '</div>';
			}
		}
		
		/*
		 * Register Woocommerce Customizer
		 */
		public function woo_customizer_sections(){
			require NXT_THEME_DIR . 'inc/third-party/woocommerce/customizer/customizer-woocommerce.php';
		}
		
		public function woo_customizer_options(){
			require NXT_THEME_DIR . 'inc/third-party/woocommerce/customizer/class-woocommerce-general.php';
		}
		
		public function woo_container_layout( $layout_container ){
			
			if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {

				$layout = nexter_get_option( 'woo-layout-container' );

				if ( $layout !== 'default' ) {
					$layout_container = $layout;
				}

				if ( is_shop() ) {
					$shop_page_id = get_option( 'woocommerce_shop_page_id' );
					$shop_layout  = get_post_meta( $shop_page_id, 'site-layout-container', true );
				} elseif ( is_product_taxonomy() ) {
					$shop_layout = 'default';
				} else {
					$shop_layout = nexter_get_option_meta( 'site-layout-container', '', true );
				}

				if ( ! empty( $shop_layout ) && $shop_layout !== 'default' ) {
					$layout_container = $shop_layout;
				}
			}

			return apply_filters( 'nexter_woo_layout_container', $layout_container );
		}
		
		public function woo_body_class( $classes ) {
			if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
				$classes[] = 'nxt-woocommerce';
			}
			
			return $classes;
			
		}
		
	}

}

Nexter_Woocommerce_Compatibility::get_instance();