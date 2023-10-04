<?php
/**
 * Nexter Font Families List
 *
 * @package	Nexter
 * @since	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Nexter Fonts Listing
 * Google fonts list, Default(System) fonts list and Custom fonts list in Nexter
 */
if ( ! class_exists( 'Nexter_Font_Families_Listing' ) ) {

	final class Nexter_Font_Families_Listing {
		
		/**
		 * Default Fonts
		 */
		public static $default_fonts_list = array();
		
		/**
		 * Google Fonts
		 */
		public static $google_fonts_list = array();
		
		/**
		 * Get Google Fonts List
		 */
		public static function get_google_fonts_load() {

			if ( empty( self::$google_fonts_list ) ) {
				
				$google_fonts_list_file = apply_filters( 'nexter_google_fonts_load_array', NXT_THEME_DIR . 'inc/customizer/nexter-google-font-list.php' );

				if ( ! file_exists( $google_fonts_list_file ) ) {
					return array();
				}

				$google_fonts_list_array = include $google_fonts_list_file;

				foreach ( $google_fonts_list_array as $key => $gfonts ) {
					self::$google_fonts_list[ $key ][] = array_values( $gfonts[ 'variants' ] );
					self::$google_fonts_list[ $key ][] =  $gfonts[ 'category' ];
				}
			}
			return apply_filters( 'nexter_google_fonts_load', self::$google_fonts_list );
		}
		
		/*
		 * Load Font List
		 * @since 1.1.0
		 */
		public static function get_local_google_fonts_load(){
			$nxt_ext = get_option( 'nexter_extra_ext_options' );
			self::$google_fonts_list = self::get_google_fonts_load();
			//local google font load
			if( !empty($nxt_ext) && isset($nxt_ext['local-google-font']) && !empty($nxt_ext['local-google-font']['switch']) && !empty($nxt_ext['local-google-font']['values']) ){
				$local_fonts = $nxt_ext['local-google-font']['values'];
				$gfont_list = empty(self::$google_fonts_list) ? self::get_google_fonts_load() : self::$google_fonts_list;
				self::$google_fonts_list= [];
				foreach ( $local_fonts as $font ) {
					if( isset($gfont_list[$font]) ){
						self::$google_fonts_list[ $font ] = $gfont_list[ $font ];
					}
				}
			}
			return self::$google_fonts_list;
		}

		/*
		 * Nexter Local Google Font Data
		 * @since 1.1.0
		 */
		public static function get_local_google_font_data(){
			$fonts = self::get_local_google_fonts_load();
			if( empty($fonts) ){
				return false;
			}
			$gfont = [];
			foreach($fonts as $key => $font){
				$gfont[$key] = $font[0];
			}

			$googleFontUrl = Nexter_Get_Fonts::generate_google_fonts_url($gfont,[]);
			if( !empty( $googleFontUrl ) ){
				$googleFontCss = self::nxt_remote_get_data($googleFontUrl, array('user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:87.0) Gecko/20100101 Firefox/87.0') );
				if( !empty( $googleFontCss ) ){
					
					$currentWeight = null;
					$currentLang = null;

					$lines = explode("\n", $googleFontCss);
					$linesToInclude = [];
					$file_url = [];
					foreach ($lines as $line) {
						if (preg_match('/^  font-weight: (\d{3}).*$/', $line, $matches) === 1) {
							$currentWeight = $matches[1];
						}

						if(preg_match('/https?\:\/\/[^\" ]+/i', $line, $matches_url) === 1){
							if(!empty($matches_url[0])){
								$file_url[] = str_replace(')', '', $matches_url[0]);
							}
						}
					}
					
					if(!empty($file_url)){
						$gfont_paths = self::generate_local_google_font_path(true);
						
						require_once (ABSPATH . '/wp-admin/includes/file.php');
						WP_Filesystem();

						global $wp_filesystem;
					
						foreach ($file_url as $font_url) {
							$parsed_url = wp_parse_url($font_url);
							$dirname = $gfont_paths['gfonts_path'] . dirname($parsed_url['path']);
				
							if (! $wp_filesystem->is_dir($dirname)) {
								wp_mkdir_p($dirname);
							}
				
							$wp_filesystem->put_contents(
								$gfont_paths['gfonts_path'] . $parsed_url['path'],
								self::nxt_remote_get_data($font_url)
							);

							$googleFontCss = str_replace( $font_url,
								$gfont_paths['gfonts_url'] . $parsed_url['path'], $googleFontCss
							);
						}
					}
					
					$nxt_ext = get_option( 'nexter_extra_ext_options' );
					if( !empty($nxt_ext) && isset($nxt_ext['local-google-font']) && !empty($nxt_ext['local-google-font']['switch']) && !empty($nxt_ext['local-google-font']['values']) ){
						$nxt_ext['local-google-font']['style'] = $googleFontCss;
						update_option('nexter_extra_ext_options', $nxt_ext);
					}
				
				}
			}
		}

		/*
		 * Generate Local Google Font Upload Path
		 * @since 1.1.0
		 */
		public static function generate_local_google_font_path( $is_generate = false){

			require_once (ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();

			global $wp_filesystem;

			$uploads = wp_upload_dir();

			$nxt_ext_uploads = [
				'gfonts' => 'nexter-ext/local-gfonts'
			];

			foreach($nxt_ext_uploads as $folder => $path) {
				$upload_paths[ $folder . '_url' ] = $uploads['baseurl'] . '/' . $path;
				$upload_paths[ $folder . '_path' ] = $uploads['basedir'] . '/' . $path;
			}
	
			if (! self::file_has_direct_access()) {
				return false;
			}
	
			if (! $wp_filesystem) {
				return false;
			}
			
			if(!$is_generate){
				return $upload_paths;
			}

			foreach(array_keys($nxt_ext_uploads) as $folder) {
				$path = $upload_paths[$folder . '_path'];
				$parent_dir = dirname($path);

				if (!$wp_filesystem->is_dir($parent_dir)) {
					$wp_filesystem->mkdir($parent_dir);
					if (!$wp_filesystem->is_dir($path)) {
						$wp_filesystem->mkdir($path);
					}
				}else if ($wp_filesystem->is_dir($parent_dir)) {
					if ($folder === 'gfonts') {
						$wp_filesystem->rmdir($path, true);
					}
					if (!$wp_filesystem->is_dir($path)) {
						$wp_filesystem->mkdir($path);
					}
				}
			}
			
			return $upload_paths;
		}

		public static function file_has_direct_access( $context = null ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			WP_Filesystem();
	
			global $wp_filesystem;
	
			if ($wp_filesystem) {
				if ($wp_filesystem->method !== 'direct') {
					if ( is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
						return true;
					} else {
						return $wp_filesystem->method === 'direct';
					}
				} else {
					return true;
				}
			}
	
			if ( get_filesystem_method( [], $context ) === 'direct' ) {
				ob_start();

				{
					$creds = request_filesystem_credentials( admin_url(), '', false, $context, null );
				}
	
				ob_end_clean();
				if ( WP_Filesystem( $creds ) ) {
					return true;
				}
			}
			return false;
		}

		/*
		 * Nexter Remote Get Data
		 * @since 1.1.0
		 */
		public static function nxt_remote_get_data( $url ='', $useragent = []){
			if( empty($url) ){
				return false;
			}

			$response = wp_safe_remote_get($url, $useragent);

			if ( is_wp_error( $response ) ) {
				return false;
			}
			 
			$body = wp_remote_retrieve_body( $response );

			if( !empty($body) ){
				return $body;
			}

			return false;
		}

		/**
		 * Get Default Fonts List
		 */
		public static function get_default_fonts_load() {
			if ( empty( self::$default_fonts_list ) ) {
				self::$default_fonts_list = [
					'Helvetica' => [
						'fallback' => 'Verdana, Arial, sans-serif',
						'weights'  => [ '300', '400', '700' ],
					],
					'Times'     => [
						'fallback' => 'Georgia, serif',
						'weights'  => [ '300', '400', '700' ],
					],
					'Verdana'   => [
						'fallback' => 'Helvetica, Arial, sans-serif',
						'weights'  => [ '300', '400', '700' ],
					],
					'Arial'     => [
						'fallback' => 'Helvetica, Verdana, sans-serif',
						'weights'  => [ '300','400','700' ],
					],
				];
			}

			return apply_filters( 'nexter_default_fonts_list', self::$default_fonts_list );
		}
		
		/**
		 * Custom Fonts List
		 */
		public static function get_custom_fonts_load() {
			$custom_fonts_list = [];
			
			return apply_filters( 'nexter_custom_fonts_load', $custom_fonts_list );
		}

	}
}