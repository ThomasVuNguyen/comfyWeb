<?php

/* Query-Class inkludieren */
include_once( 'queryelements.php' );
include_once( 'imagecache.class.php' );
include_once( 'getstoreurls.class.php' );
include_once( 'createoutput.class.php' );
	
	
/**
* wpAppbox_GetAppInfoAPI
*/

class wpAppbox_GetAppInfoAPI {
	
	
	/**
	* Baut aus dem Store-Namen und der App-ID eine eindeutige Cache-ID auf
	*
	* @since   4.0.0
	*
	* @param   string  $storeID  ID des Stores (z.B. "googleplay")
	* @param   string  $appID    ID der App
	* @return  string  $cacheID  ID des Caches und INDEX für die Datenbank
	*/
	
	function getCacheID( $storeID, $appID ) {
		$cacheID = md5( $appID . '-' . $storeID );
		return( $cacheID );
	}
	
	
	/**
	* Baut den Funktionsnamen zusammen und ruft die Funktionen zum Laden und Zurückgeben der App-Informationen auf
	*
	* @since   2.0.0
	* @change  4.4.4
	*
	* @param   string  	$storeID  ID des Stores (z.B. "googleplay")
	* @param   string  	$appID    ID der App
	* @param   boolean  $isCron   true wenn über Cronjob ausgeführt [optional]
	* @return  array  	$appData  Array der App-Daten
	*/
	
	function getTheAppData( $storeID, $appID, $isCron = false ) {
		switch ( $storeID ) {
			case 'androidpit':
				$storeID = 'googleplay';
				break;
			case 'goodoldgames':
				$storeID = 'gog';
				break;
			case 'windowsstore':
			case 'windowsphone':
				$storeID = 'microsoftstore';
				break;
			case 'microsoftstore':
				if ( 20 <= strlen( $appID ) ) $storeID = 'edgeaddons';
				break;
			case 'appstore':
				$appID = str_replace( array( '-iphone', '-ipad', '-universal', '-watch', '-imessage', '-appletv' ), '', $appID );
				if ( substr( $appID, 0, 2 ) == 'id' )
					$appID = substr( $appID, 2 );
				if ( substr( $appID, 0, 8 ) == 'bundleid' )
					$appID = str_replace( 'bundleid', 'bundle', $appID );
				break;
		}
		//if ( !in_array( $wpAppbox_storeNames, $storeID ) ) return( false );
		$cacheID = self::getCacheID( $storeID, $appID );
		$thegetfunction = "get$storeID";
		if ( !method_exists( $this, $thegetfunction ) ) return( false );
		$hasCachedData = $this->hasCachedData( $cacheID );
		$transientName = 'wpAppbox_blockQuery_' . $cacheID;
		if ( '' != get_transient( $transientName ) && !wpAppbox_forceNewCache( $cacheID ) && !$isCron ) {
			$blockedUntil = date_i18n( 'Y-m-d H:i:s', get_option( '_transient_timeout_' . $transientName ) );
			wpAppbox_errorOutput( 'function: getTheAppData() ---> App (ID ' . $appID . ') not found. Queries are still blocked until ' . $blockedUntil . '.' );
			if ( $hasCachedData['exists'] ) return( $this->returnCachedData( $cacheID ) );
			else return( false );
		}
		if ( !$hasCachedData['exists'] ) { 
			/**
			* Cache existiert nicht
			*/
			wpAppbox_errorOutput( 'function: wpAppbox_hasCachedData() ---> App has no chached data' );
			$appData = $this->$thegetfunction( $appID, $cacheID );
			if ( $appData ) $appData = $this->cacheAppData( $appData );
		} else { 
			/**
			* Cache existiert, aber...
			*/
			if ( $hasCachedData['expired'] ) {
				/**
				* Cache-Daten sind abgelaufen und müssen u.U. erneuert werden
				*/
				wpAppbox_errorOutput( 'function: wpAppbox_hasCachedData() ---> App has cached data but they are expired' );
				$appData = $this->$thegetfunction( $appID, $cacheID );
				if ( FALSE === $appData ) {
					/**
					* Die App konnte nicht (mehr) gefunden werden
					*/
					$appData = $this->markAsDeprecated( $cacheID );
					$appData = true; // Einfach weil ja Daten vorhanden sind, Abfrage erfolgt später ;-)
				} else {
					/**
					* Die App wurde im Store gefunden und besitzt Daten
					*/
					$appData = $this->cacheAppData( $appData );
				}
			} else { 
				/**
				* Cache-Daten sind nicht abgelaufen = aktuell
				*/
				$appData = true; // Einfach weil ja Daten vorhanden sind, Abfrage erfolgt später ;-)
				wpAppbox_errorOutput( 'function: wpAppbox_hasCachedData() ---> App has valid cached data' );
			}
		}
		/**
		* App-Daten (oder Fehlermeldung) zurückgeben zur Weiterverarbeitung
		*/
		if ( $appData ) return( $this->returnCachedData( $cacheID ) );
		else if ( !$appData && get_option( 'wpAppbox_blockMissing' ) ) { // Keine App gefunden
			set_transient( $transientName, $cacheID, WPAPPBOX_BLOCKMISSINGTIME * MINUTE_IN_SECONDS );
			$blockedUntil = date_i18n( 'Y-m-d H:i:s', get_option( '_transient_timeout_' . $transientName ) );
			wpAppbox_errorOutput( 'function: getTheAppData() ---> App not found. Queries will be blocked until ' . $blockedUntil . '.' );
		}
		return( false );
	}
	
	
	/**
	* Prüft ob die App-Daten bereits in der Cache-Tabelle liegen
	*
	* @since   2.0.0
	* @change  4.4.0
	*
	* @param   string    $cacheID       	Cache-ID der App
	* @return  array   	 $hasCachedData 	array('exists' => boolean, 'expired' => boolean)
	* @output  function  errorOutput()  	Fehlermeldung
	*/
	
	function hasCachedData( $cacheID ) {
		global $wpdb;
		$hasCachedData = array( 'exists' => false, 'expired' => false );
		$cachedApp = $wpdb->get_row( $wpdb->prepare( "SELECT created FROM " . $wpdb->prefix . WPAPPBOX_TABLE_NAME . " WHERE id = %s", $cacheID ) );
		if ( $wpdb->last_error ) {
			wpAppbox_errorOutput( 'function: wpAppbox_hasCachedData() ---> ' . $wpdb->last_error );
		}
		if ( $cachedApp != null ) {
		
			$hasCachedData['exists'] = true;
			
			switch ( get_option('wpAppbox_cacheMode' ) ) {
				case 'loggedin': // Neue App-Daten nur abfragen, wenn Nutzerlevel >= 2 (Autor)
					if ( !wpAppbox_isUserAuthor() ) {
						wpAppbox_errorOutput( 'function: wpAppbox_hasCachedData() ---> Userlevel is too low (needed: user_level >= 2)' );
						$hasCachedData['expired'] = false;
						return( $hasCachedData );
					}
					break;
				case 'manually': // Neue App-Daten nur über den Reload-Button abfragen (Voraussetzung: Nutzer hat User-Level >= 2,Autor)
					if ( !wpAppbox_isUserAuthor() || !wpAppbox_forceNewCache( $cacheID ) ) {
						wpAppbox_errorOutput( 'function: wpAppbox_hasCachedData() ---> Userlevel is too low for manual renewal (needed: user_level >= 2)' );
						$hasCachedData['expired'] = false;
						return( $hasCachedData );
					}
					break;
				case 'cronjob': // Neue App-Daten nur via Cronjob abfragen
					if ( defined( 'DOING_CRON' ) ) {
						$hasCachedData['expired'] = true;
						return( $hasCachedData );
					} else if ( !wpAppbox_forceNewCache( $cacheID ) ) {
						$hasCachedData['expired'] = false;
						return( $hasCachedData );
					}
					break;
			}
			$timeCreated = $cachedApp->created;
			$timeExpires = $timeCreated + ( WPAPPBOX_CACHINGTIME * 60 );
			$timeNow = time(); 
			if ( wpAppbox_forceNewCache( $cacheID ) ) {
				$timeExpires = 0;
			}
			if ( $timeNow >= $timeExpires ) {
				$hasCachedData['expired'] = true;
			}
		} else {
			$hasCachedData['exists'] = false;
		}
		return( $hasCachedData );
	}
	
	
	/**
	* Markiert eine App in der Datenbank als "deprecated"
	*
	* @since   4.0.0
	* @change  4.4.0
	*
	* @param   string     $cacheID       Cache-ID der App
	*/
	
	function markAsDeprecated( $cacheID ) {
		global $wpdb;
		if ( $cacheID != '' ):
			$updated = $wpdb->update( $wpdb->prefix . WPAPPBOX_TABLE_NAME, array( 'deprecated' => '1', 'created' => time() ), array( 'id' => $cacheID ) );
			if ( false === $updated ):
				// Es ist ein Fehler aufgetreten
				wpAppbox_errorOutput( 'function: wpAppbox_markAsDeprecated() ---> ' . $wpdb->last_error );
			    wpAppbox_errorOutput( 'function: wpAppbox_markAsDeprecated() ---> Something went wrong. :-(' );
			else:
				wpAppbox_errorOutput( 'function: wpAppbox_markAsDeprecated() ---> App was marked as deprecated.' );
			    // No error. You can check updated to see how many rows were changed.
			    if ( wpAppbox_imageCache::quickcheckImageCache() ):
			    	$imgCache = new wpAppbox_imageCache;
			    	if ( !$imgCache->markAsDeprecated( $cacheID ) ):
			    		wpAppbox_errorOutput( 'function: wpAppbox_markAsDeprecated() ---> Folder could not marked as deprecated.' );
			    	endif;
			    endif;
			endif;
		endif;
	}
	
	
	/**
	* Speichert die App-Daten im Cache
	*
	* @since   2.0.0
	* @change  4.2.0
	*
	* @param   array     $appData       Array der App-Daten
	* @return  boolean   true/false     TRUE when cached
	* @output  function  errorOutput()  Fehlermeldung
	*/
	
	function cacheAppData( $appData ) {
		global $wpdb, $appIsDeprecated;
		$appData['created'] = time();
		$appData['deprecated'] = '0';
		$appData['appbox_version'] = WPAPPBOX_PLUGIN_VERSION;
		if ( isset( $appData['app_extend'] ) ) 
			$appData['app_extend'] = serialize( $appData['app_extend'] );
		if ( isset( $appData['app_screenshots'] ) ) 
			$appData['app_screenshots'] = serialize( $appData['app_screenshots'] );
		else $appData['app_screenshots'] = '';
		if ( '' == trim( $appData['app_title'] ) ):
			$appData['app_title'] = esc_html__('Unknown app', 'wp-appbox');
			wpAppbox_errorOutput( 'function: wpAppbox_cacheAppData() ---> Something went wrong. :-( No app-title for ' . $appData['app_id'] );
		endif;
		if ( '' == trim( $appData['app_author'] ) ):
			$appData['app_author'] = esc_html__('Unknown', 'wp-appbox');
		endif;
		/**
		* BEGIN App-Daten für die Datenbank kontrollieren und korrigieren
		*/
		$fixedAddon = '<sup>[*]</sup>';
		if ( 255 < mb_strlen( $appData['app_url'] ) ) 
			$appData['app_url'] = substr( $appData['app_url'], 0, 255-3 ) . $fixedAddon;
		if ( 350 < mb_strlen( $appData['app_icon'] ) )
			$appData['app_icon'] = substr( $appData['app_icon'], 0, 350-3 ) . $fixedAddon;
		if ( '' == $appData['app_icon'] )
			$appData['app_icon'] = plugins_url( 'img/' . $appData['store_name_css'] . '@2x.png', dirname( __FILE__ ) );
		if ( 255 < mb_strlen( $appData['app_title'] ) )
			$appData['app_title'] = substr( $appData['app_title'], 0, 255-3 ) . $fixedAddon;
		if ( 100 < mb_strlen( $appData['app_author'] ) )
			$appData['app_author'] = substr( $appData['app_author'], 0, 100-3 ) . $fixedAddon;
		if ( isset( $appData['app_author_url'] ) && 255 < strlen( $appData['app_author_url'] ) )
			$appData['app_author_url'] = substr( $appData['app_author_url'], 0, 255-3 ) . $fixedAddon;
		if ( 25 < mb_strlen( $appData['app_price'] ) )
			$appData['app_price'] = substr( $appData['app_price'], 0, 28-3 ) . $fixedAddon;
		if ( '' == $appData['app_price'] ) 
			$appData['app_price'] = __( 'unknown', 'wp-appbox' );
		if ( isset( $appData['app_has_iap'] ) && ( 1 < mb_strlen( $appData['app_has_iap'] ) ) )
			$appData['app_has_iap'] = substr( $appData['app_has_iap'], 0, 1 );
		if ( !isset( $appData['app_rating'] ) || '' == $appData['app_rating'] )
			$appData['app_rating'] = '-1';
		if ( 3 < strlen( $appData['app_rating'] ) )
			$appData['app_rating'] = substr( $appData['app_rating'], 0, 3 );
		if ( is_numeric( $appData['app_rating'] ) ) 
			$appData['app_rating'] = number_format( $appData['app_rating'], 1 );
		/**
		* END App-Daten für die Datenbank kontrollieren und korrigieren
		*/
		$replaced = $wpdb->replace( $wpdb->prefix . WPAPPBOX_TABLE_NAME, $appData );
		if ( $wpdb->last_error ):
			wpAppbox_errorOutput( 'function: wpAppbox_cacheAppData() ---> ' . $wpdb->last_error );
		else:
			if ( wpAppbox_imageCache::quickcheckImageCache() ) {
				$imgCache = new wpAppbox_imageCache;
				$wpAppbox_CreateOutput_Helper = new wpAppbox_CreateOutput;
				$tempQRcode = $wpAppbox_CreateOutput_Helper->returnQRCode( $appData['app_url'], $appData['app_id'], $appData['id'], true );
				$result = $imgCache->cleanUp( $appData['id'], $appData['app_icon'], $appData['app_screenshots'], $tempQRcode );
				$allImages = array();
				if ( $imgCache->checkImageCacheType( 'appicon' ) )
					$allImages = $allImages + $imgCache->getURLarray( 'ai', $appData['app_icon'] );
				if ( $imgCache->checkImageCacheType( 'screenshots' ) )
					$allImages = $allImages + $imgCache->getURLarray( 'ss', $appData['app_screenshots'] );
				if ( $imgCache->checkImageCacheType( 'qrcode' ) )
					$allImages = $allImages + $imgCache->getURLarray( 'qr', $tempQRcode );
				$result = $imgCache->cacheImages( $allImages, $appData['id'] );
			}
			$flushCache = wpAppbox_clearCachePlugin();
			return( true );
		endif;
	}
	
	
	/**
	* Gibt die bereits gecachten App-Daten zurück
	*
	* @since   2.0.0
	* @change  4.4.0
	*
	* @param   string  $cacheID         Cache-ID der App
	* @return  array   $appData         Array der App-Daten
	* @output  function  errorOutput()  Fehlermeldung
	*/
	
	function returnCachedData( $cacheID ) {
		global $wpdb;
		$cachedApp = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . WPAPPBOX_TABLE_NAME . " WHERE id = %s", $cacheID ) );
		if ( $wpdb->last_error )
			wpAppbox_errorOutput( 'function: wpAppbox_returnCachedData() ---> ' . $wpdb->last_error );
		if ( $cachedApp != null ) {
			$appData = array();
			$appData['id'] = $cachedApp->id;
			$appData['app_id'] = $cachedApp->app_id;
			$appData['app_url'] = $cachedApp->app_url;
			$appData['app_icon'] = $cachedApp->app_icon;
			$appData['app_title'] = $cachedApp->app_title;
			$appData['app_author'] = $cachedApp->app_author;
			$appData['app_author_url'] = $cachedApp->app_author_url;
			$appData['app_price'] = $cachedApp->app_price;
			$appData['app_has_iap'] = $cachedApp->app_has_iap;
			$appData['app_rating'] = $cachedApp->app_rating;
			$appData['store_name'] = $cachedApp->store_name;
			$appData['store_name_css'] = $cachedApp->store_name_css;
			$appData['appbox_version'] = $cachedApp->appbox_version;
			$appData['fallback'] = $cachedApp->fallback;
			$appData['created'] = $cachedApp->created;
			$appData['deprecated'] = $cachedApp->deprecated;
			$appData['app_extend'] = unserialize( $cachedApp->app_extend );
			$appData['app_screenshots'] = unserialize( $cachedApp->app_screenshots );
			return( $appData );
		}
	}

	
	/**
	* Gibt die umgewandelte URL des Stores zurück
	*
	* @since   3.0.0
	* @change  3.2.0
	*
	* @param   string  $storeID   ID des Stores (z.B. "googleplay)
	* @param   string  $appID     ID der App
	* @return  string  $storeURL  URL der App
	*/
	
	function getStoreURL( $storeID, $appID ) {
		global $wpAppbox_storeURL;
		if ( '1' == get_option( "wpAppbox_storeURL_$storeID" ) || '' == get_option( "wpAppbox_storeURL_$storeID" ) ) {
			$storeURL = $wpAppbox_storeURL[$storeID][1];
		} elseif ( '0' == get_option( "wpAppbox_storeURL_$storeID" ) && '' != get_option( "wpAppbox_storeURL_URL_$storeID" ) ) {
			$storeURL = get_option( "wpAppbox_storeURL_URL_$storeID" );
		} elseif ( '0' == get_option( "wpAppbox_storeURL_$storeID" ) && '' == get_option( "wpAppbox_storeURL_URL_$storeID" ) ) {
			$storeURL = $wpAppbox_storeURL[$storeID][1];
		} else {
			$storeURL = $wpAppbox_storeURL[$storeID][ get_option("wpAppbox_storeURL_$storeID") ];
		}
		$storeURL = str_replace( '{APPID}', $appID, $storeURL );
		$storeURL = str_replace( '{ID}', $appID, $storeURL );
		return( $storeURL );
	}
	
	
	/**
	* Gibt einen zufälligen User-Agent zurück (Standart: User-Agent des Nutzers)
	*
	* @since   4.0.1
	* @change  4.2.0
	*
	* @return  string   $userAgent  	User-Agent-String
	*/
	
	function getUserAgent() {
		$array_userAgent = array( 
							'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
							'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0',
							'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36 OPR/67.0.3575.97',
							'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko/20100101 Firefox/73.0',
							'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.5 Safari/605.1.15',
							'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.3',
							'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36',
							'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36',
							'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36 Edg/80.0.361.109'
						   );
		$userAgent = $array_userAgent[ mt_rand( 0, count( $array_userAgent ) - 1) ];
		return( $userAgent );
	}
	
	
	/**
	* Gibt eine zufällige IP Adresse zurück (Standart: IP des Nutzers)
	*
	* @since   4.0.0
	* @change  4.4.0
	*
	* @return  string   $userAgent  	User-Agent-String
	*/
	
	function getRandomIP() {
		$returnUP = '';
		if ( !empty($_SERVER['HTTP_CLIENT_IP'] ) ) 
			return( $_SERVER['HTTP_CLIENT_IP'] );
		if ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
			return( $_SERVER['HTTP_X_FORWARDED_FOR'] );
		if ( !empty( $_SERVER['REMOTE_ADDR'] ) )
			return( $_SERVER['REMOTE_ADDR'] );
		$randomIP = "" . mt_rand( 0, 255 ) . "." . mt_rand( 0, 255 ) . "." . mt_rand( 0, 255 ) . "." . mt_rand( 0, 255 );
		return( esc_attr( $randomIP ) );
	}
	
	
	/**
	* Gibt den Quellcode einer URL zurück
	*
	* @since   1.0.0
	* @change  4.4.2
	*
	* @param   string  $appURL              URL der App
	* @param   string  $javascript_loop     Wie viele JS-Loops [optional]
	* @param   string  $timeout             Timeout der Anfrage [optional]
	* @return  array   $content, $response  Quelltext und HTTP-Codes
	*/
	
	function getContent( $appURL, $javascript_loop = 0, $timeout = 10 ) {
		sleep( 3 );
		$appURL = urldecode( $appURL );
		$appURL = str_replace( "&amp;", "&", trim( $appURL ) );
		$timeout = get_option('wpAppbox_curlTimeout');
		if ( defined( 'DOING_CRON' ) ) $timeout = 15; // Bei Cronjob längeren Timeout setzen
		$cookie = tempnam( "/tmp", "CURLCOOKIE" );
		$args = array(
	        'timeout'    	=> intval( $timeout ),
	        'redirection'	=> 5,
	        'sslverify'		=> false,
	        'headers' 		=> array(
		        				'Remote_Addr' 		=> esc_attr( $this->getRandomIP() ),
		        				'X-Forwarded-For' 	=> esc_attr( $this->getRandomIP() ),
		        				'referer' 			=> esc_url_raw( get_site_url() ),
		        				'content-encoding' 	=> 'gzip'
      						),
      		'user-agent' 	=> esc_attr( $this->getUserAgent() )
    	);
		add_action( 'http_api_curl', function( $curl_handle ) {
  			curl_setopt( $curl_handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
  			curl_setopt( $curl_handle, CURLOPT_FOLLOWLOCATION, true );
  			curl_setopt( $curl_handle, CURLOPT_ENCODING, 'gzip' );
  			curl_setopt( $curl_handle, CURLOPT_CONNECTTIMEOUT, 0 ); 
		});
		$i = 0;
		$response = '';
		do {
			$i++;
			$response = wp_remote_get( utf8_decode( $appURL ), $args  );
		} while( !isset( $response ) && !isset( $response['body'] ) && 5 <= $i );
		if ( !isset( $response->errors ) )
			return( $response );
		else
			//print_r( $response->errors['http_request_failed']['0'] );
			wpAppbox_errorOutput( 'function: getContent() ---> ' . $response->errors['http_request_failed']['0'] );
	}
	
	
	/**
	* Informationen aus dem Play Store auslesen
	*
	* @since   1.0.0
	* @change  4.4.2
	*
	* @param   string  $appID    ID der App
	* @param   string  $cacheID  Cache-ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getGooglePlay( $appID, $cacheID, $storeID = 'googleplay' ) {
		if ( '' != get_transient( 'wpAppbox_blockGooglePlay' ) ) {
			$blockedUntil = date_i18n( 'Y-m-d H:i:s', get_option( '_transient_timeout_wpAppbox_blockGooglePlay' ) );
			wpAppbox_errorOutput( 'function: getGooglePlay() ---> Temporary recognition as a bot. Play Store queries are blocked until ' . $blockedUntil . '.' );
			return( false );
		}
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getGooglePlay() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( "#error-section" )->text();
			if ( '' != $error_found ) {
				return( false ); //and quit
			}
			//App-Daten aus der HTML-Seite auslesen
			$appURL = pq( 'link[hreflang="x-default"]' )->attr( 'href' );
			if ( $appURL == '' ) $appURL = pq( 'meta[property="og:url"]' )->attr( 'content' );
			$appURL = str_replace( '&rdid=sp0n.citizen&feature=md&offerId', '', $appURL );
			$appIcon = pq( 'img[itemprop="image"][alt*="Cover"]' )->attr( 'src' );
			if ( $appIcon == '' ) 
				$appIcon = pq( 'img[itemprop="image"]:first' )->attr( 'src' );
			$appIcon = preg_replace( '/(\/\/.*\.com\/.*)(\=(?:w|s)[0-9]{1,4}(?:-rw)?)/i', '$1=s128', $appIcon );
			$appTitle = pq( 'div[itemprop="name"]>div' )->html();
			if ( '' == trim( $appTitle ) ) {
				$appTitle = strip_tags( pq( 'h1[itemprop="name"]' )->html() );
			}
			$appAuthor = pq( 'div>div>a[href*="store/apps/dev"]:first' )->html();
			$appAuthorURL = pq( 'div>div>a[href*="store/apps/dev"]:first' )->attr( 'href' );
			if ( FALSE === strpos( $appAuthorURL, 'play.google.com' ) ) 
				$appAuthorURL = 'https://play.google.com' . $appAuthorURL;
			$appPrice = pq( 'meta[itemprop="price"]' )->attr( 'content' );
			if ( '' == $appPrice || '' != pq( 'div.preregistration-text' )->html() )
				$appExtend['ispreregister'] = true;
			if ( strpos( $appPrice, "," ) == false && strpos( $appPrice, "." ) == false )
				$appPrice = '0';
			if ( preg_match( '/<div class="\D{0,20}">\D{0,10}?in[-| ]app\D{0,10}?<\/div>/i', $thisContent['body'] ) )
				$appHasIAP = true;
			else 
				$appHasIAP = false;
			$appRatingHTML = pq( 'div[class="pf5lIe"]:first>div' )->html();
			$appRating = 5 - substr_count( $appRatingHTML, 'L0jl5e' );
			if ( 0 < substr_count( $appRatingHTML, 'D3FNOd' ) ) $appRating = $appRating + 0.5;
			$appScreenshots = array();
			foreach ( pq( 'div>img[data-screenshot-index*=""]' ) as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'src' );
				$appScreenshot = strtok( $appScreenshot, '=' ) . '=h310';
				if ( !in_array( $appScreenshot, $appScreenshots ) && 0 != strpos( $appScreenshot, '//' ) )
					$appScreenshots[] = $appScreenshot;
			}
			/* ============================================================================== */
			/* For old Google Play Design - Thank you Google for this sh*tty stuff *facepalm* */
			/* ============================================================================== */
			if ( $appURL == '' ) 
				$appURL = pq( 'meta[itemprop="url"]' )->attr( 'content' );
			if ( $appIcon == '' ) 
				$appIcon = pq( 'img.cover-image' )->attr( 'content' );
			if ( $appRating == '' ) 	
				$appRating = pq( 'meta[itemprop="ratingValue"]' )->attr( 'content' );
			if ( $appAuthor == '' ) 
				$appAuthor = pq( 'div[itemprop="author"]>a>span[itemprop="name"]' )->html();
			if ( $appAuthorURL == '' ):
				$appAuthorURL = pq( 'div[itemprop="author"]>meta[itemprop="url"]' )->attr( 'content' );
				if ( FALSE === strpos( $appAuthorURL, 'play.google.com' ) ) 
					$appAuthorURL = 'https://play.google.com' . $appAuthorURL;
			endif;
			if ( !isset( $appHasIAP ) ):
				if ( '' != ( trim( pq( 'div.inapp-msg' )->html() ) ) )
					$appHasIAP = true;
				else 
					$appHasIAP = false;
			endif;
			$oldPrice = trim( pq( 'div.details-info span.full-price' )->html() );
			if ( '' != $oldPrice ) {
				$appExtend = array( 'oldPrice' => $oldPrice );
			}
			/*
			if ( empty( $appScreenshots ) ):
				$appScreenshots = array();
				foreach ( pq( 'img[itemprop="image"]' ) as $appShots ) {
					$appScreenshot = pq( $appShots )->attr( 'src' );
					$appScreenshot = preg_replace( '/(\/\/.*\.com\/.*)(\=h[0-9]{1,4}(?:-rw)?)/i', '$1=h310', $appScreenshot );
					$appScreenshots[] = $appScreenshot;
				}
			endif;
			*/
			/* ============================================================================== */
			/* Really Google: Thank you for nothing...                                        */
			/* ============================================================================== */
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_price'] = $appPrice;
			$appData['app_has_iap'] = $appHasIAP;
			$appData['app_rating'] = $appRating;
			if ( isset( $appExtend ) ) {
				$appData['app_extend'] = $appExtend;
			}
			$appData['store_name'] = 'Google Play';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		if ( $thisContent['response']['code'] == '503' || $thisContent['response']['code'] == '302' ) {
			set_transient( 'wpAppbox_blockGooglePlay', ( time() + 3 * HOUR_IN_SECONDS ), 3 * HOUR_IN_SECONDS );
				$blockedUntil = date_i18n( 'Y-m-d H:i:s', get_option( '_transient_timeout_wpAppbox_blockGooglePlay' ) );
			wpAppbox_errorOutput( 'function: getGooglePlay() ---> Temporary recognition as a bot. Play Store queries will be blocked until ' . $blockedUntil . '.' );
			return( false );
		}
		wpAppbox_errorOutput( 'function: getGooglePlay() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
		
	
	/**
	* Informationen aus dem Amazon App Shop auslesen (via Scraping & Google Cache)
	*
	* @since   3.4.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getAmazonApps( $appID, $cacheID, $storeID = 'amazonapps' ) {
		global $wpdb;
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( 'http://webcache.googleusercontent.com/search?q=cache:' . $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getAmazonApps() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( "title" )->html();
			if ( strpos( $error_found, "404" ) !== false ) {
				return( false );
			}
			$appURL = strip_tags( pq( 'meta[property=og:url]' )->attr( 'content' ) );
			$appTitle = strip_tags( pq( 'meta[property=og:title]' )->attr( 'content' ) );
			$appIcon = strip_tags( pq( 'meta[property=og:image]' )->attr( 'content' ) );
			$appAuthor = pq( 'div#center-col a:first' )->html();
			$appAuthorURL = pq( 'div#center-col a:first' )->attr( 'href' );
			$appPrice = Trim( pq( '#actualPriceValue>strong' )->html() );
			if ( strpos( $appPrice, 'EUR' ) !== false ) {
				$appPrice = str_replace( 'EUR ', '', $appPrice ) . ' €';
			}
			$appRating = substr( Trim( pq( 'div#avgRating span' )->html() ), 0, 3);
			$appScreenshots = array();
			foreach ( pq( 'img.masrw-thumbnail' ) as $appShots ) {
				$appScreenshot = str_replace( '30', '300', pq( $appShots )->attr( 'src' ) );
				$appScreenshot = str_replace( '._SL160_', '', $appScreenshot );
				if ( '' != Trim( $appScreenshot ) ) $appScreenshots[] = $appScreenshot;
			}
			if ( false !== strpos( pq( 'meta[name="title"]' )->attr( 'content' ), 'Alexa Skills' ) ) {
				$appTitle = strip_tags( pq( '.a2s-title-content' )->html() );
				$appPrice = '0';
				$appAuthor = explode( ' ', Trim( pq( ' .a2s-title span' )->html() ), 2 );
				$appAuthor = $appAuthor[1];
				$appIcon = pq( 'div.a2s-skill-icon img.a2s-product-image' )->attr( 'src' );
				$appExtend['alexaskill'] = true;
			}
			if ( isset( $appExtend['alexaskill'] ) && ( true != $appExtend['alexaskill'] ) ) $appExtend['mobileapp'] = true;
			if ( '' == Trim( $appTitle ) ) {
				wpAppbox_errorOutput( 'function: getAmazonApps() ---> No app data found' );
				return( false );
			}
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_price'] = $appPrice;
			$appData['app_rating'] = $appRating;
			if ( isset( $appExtend ) ) $appData['app_extend'] = $appExtend;
			$appData['store_name'] = 'Amazon Apps';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getAmazonApps() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
		
	
	/**
	* Informationen von Good Old Games (GOG.com) auslesen
	*
	* @since   2.3.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getGOG( $appID, $cacheID, $storeID = 'gog' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code']) {
			wpAppbox_errorOutput( 'function: getGOG() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( "title" )->html();
			if ( strpos( $error_found, "404" ) !== false ) {
				return( false );
			}
			$appTitle = pq( 'h1.productcard-basics__title' )->html();
			$appURL = $pageURL;
			
			preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( 'img.productcard-player__logo' )->attr( 'srcset' ), $appIconMatch );
			$appIcon = $appIconMatch[0][0];
			
			$appPrice = pq( 'span.product-actions-price__final-amount' )->html();
			$oldPrice = trim( pq( 'span.product-actions-price__base-amount' )->html() );
			if ( '' != $oldPrice ) $appExtend['oldPrice'] = $oldPrice;
			$appAuthor = pq( 'div.details__content.table__row-content a[href*="devpub"]:first' )->html();
			$appAuthorURL = 'https://www.gog.com' . pq( 'div.details__content.table__row-content a[href*="devpub"]:first' )->attr( 'href' );
			$appRating = pq( 'div[itemprop="aggregateRating"]:first' )->html();
			if ( false !== strpos( $appRating, '/5' ) ) $appRating = Trim( str_replace( '/5', '', $appRating ) );
			else $appRating = 0;
			
			$appScreenshots = array();
			foreach ( pq( 'img.productcard-thumbnails-slider__image') as $appShots ):
				$appScreenshot = pq( $appShots )->attr( 'src' );
				if ( '' != Trim( $appScreenshot ) ):
					$appScreenshots[] = trim( $appScreenshot );
				endif;
			endforeach;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_price'] = $appPrice;
			$appData['app_rating'] = $appRating;
			if ( isset( $appExtend ) ) $appData['app_extend'] = $appExtend;
			$appData['store_name'] = 'GOG.com';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getGOG() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus dem Steam Store auslesen
	*
	* @since   1.8.5
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getSteam( $appID, $cacheID, $storeID = 'steam' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		$thisContent = $this->getContent( $pageURL );
		$thisContent = json_decode( $thisContent['body'] );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( '1' == $thisContent->$appID->success ) {
			wpAppbox_errorOutput( 'function: getSteam() ---> Get app information' );
			$thisContent = $thisContent->$appID->data;
			$appTitle = $thisContent->name;
			$appURL = 'http://store.steampowered.com/app/' . $appID . '/';
			$appIcon = $thisContent->header_image;
			foreach ( $thisContent->developers as $devs ) {
				if ( !isset( $appAuthor ) ) $appAuthor = '';
				/*$appAuthor .= ", <a href=\"http://store.steampowered.com/search/?developer=$devs\">$devs</a>";*/
				$appAuthor .= ", $devs";
			}
			$appAuthor = substr( $appAuthor, 2 );
			$currency = $thisContent->price_overview->currency;
			$appPrice = $thisContent->price_overview->final / 100;
			if ( 'EUR' == $currency ) {
				$appPrice = str_replace( '.', ',', $appPrice ) . ' €';
			} elseif ( 'USD' == $currency ) { 
				$appPrice = '$ ' . $appPrice;
			} else {
				$appPrice = $appPrice.' '.$currency;
			}
			$appScreenshots = array();
			foreach ( $thisContent->screenshots as $appShots ) {
				$appScreenshots[] = $appShots->path_thumbnail;
			}
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_price'] = $appPrice;
			$appData['app_rating'] = '-1';
			$appData['store_name'] = 'Steam';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getSteam() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus Snapcraft auslesen
	*
	* @since   1.8.5
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getSnapcraft( $appID, $cacheID, $storeID = 'snapcraft' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code']) {
			wpAppbox_errorOutput( 'function: getSnapcraft() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( "title" )->html();
			if ( strpos( $error_found, "404" ) !== false ) {
				return( false );
			}
			$appTitle = pq( 'h1[data-live="title"]' )->html();
			$appURL = $pageURL;
			$appIcon = pq( 'img[data-live="icon"]' )->attr( 'src' );
			$appPrice = '0';
			$appAuthor = pq( 'div.p-snap-heading__title span.p-tooltip--top-center:first' )->html();
			$appAuthor = preg_replace( "/>.*?</s", "><", $appAuthor );
			$appScreenshots = array();
			foreach ( pq( 'div[data-live="screenshots"] img') as $appShots ):
				$appScreenshot = pq( $appShots )->attr( 'src' );
				if ( '' != Trim( $appScreenshot ) ):
					$appScreenshots[] = trim( $appScreenshot );
				endif;
			endforeach;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = '';
			$appData['app_price'] = $appPrice;
			if ( isset( $appExtend ) ) $appData['app_extend'] = $appExtend;
			$appData['store_name'] = 'GOG.com';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getSnapcraft() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus dem (Mac) App Store auslesen
	*
	* @since   1.0.0
	* @change  4.4.8
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getAppStore( $appID, $cacheID, $storeID = 'appstore' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		if ( false !== strpos( $appID, "bundle" ) ) {
			$pageURL = str_replace( '/idbundle', '-bundle/id', $pageURL );
		}
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && ( '200' == $thisContent['response']['code'] ) ) {
			wpAppbox_errorOutput( 'function: getAppStore() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( 'meta[property="og:title"]' )->attr( 'content' );
			if ( '' == $error_found ) {
				return( false );
			}
			$jsonData = json_decode( pq( 'script[name="schema:software-application"][type="application/ld+json"]' )->html() );
			$appExtend = array();
			$appTitle = pq( 'meta[property="og:title"]' )->attr( 'content' );
			$appURL = pq( 'meta[property="og:url"]' )->attr( 'content' );
			preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( 'picture[class*="-app-icon"] source:first' )->attr( 'srcset' ), $appIconMatch );
			$appIcon = str_replace( '.webp' , '.png', $appIconMatch[0][0] );
			$appAuthor = $jsonData->author->name;
			$appAuthorURL = $jsonData->author->url;
			if ( '' == $appAuthor ) {
				$appAuthor = pq( 'h2.product-header__identity > a' )->text();
				$appAuthorURL = pq( 'h2.product-header__identity > a' )->attr( 'href' );
			}
			if ( isset( $jsonData->aggregateRating->ratingValue ) )
				$appRating = $jsonData->aggregateRating->ratingValue;
			else $appRating = -1;
			//if ( isset( $jsonData->offers->price ) && ( '0' == $jsonData->offers->price ) ) $appPrice = '0';
			//else $appPrice = pq( 'li.app-header__list__item--price' )->html();	
			$appPrice = pq( 'li.app-header__list__item--price' )->html();
			if ( ( !strpos( $appPrice, '.' ) ) && ( !strpos( $appPrice, ',' ) ) ):
				$appPrice = '0';
			endif;
			if ( ( false !== strpos( $appID, "bundle" ) && ( isset( $jsonData->offers->price ) ) ) ) {
				$appPrice = $jsonData->offers->price;
			}
			if ( pq( 'header.app-header--arcade')->html() ) $appExtend['apple-arcade'] = true;
			if ( '' != pq( 'li.app-header__list__item--in-app-purchase')->html() ) $appHasIAP = true;
			else $appHasIAP = '0';
			/* Deprecated - Thanks to Apple
			if ( isset( $jsonData->data->attributes->isSiriSupported ) )
				$appExtend['issirisupported'] = true;
			if ( isset( $jsonData->data->attributes->isAppleWatchSupported ) )
				$appExtend['watchapp'] = true;
			if ( isset( $jsonData->data->attributes->isPreorder ) )
				$appExtend['ispreorder'] = true;
			if ( isset( $jsonData->data->attributes->hasMessagesExtension ) )
				$appExtend['imessageapp'] = true;
			if ( isset( $jsonData->data->attributes->isHiddenFromSpringboard ) )
				$appExtend['imessage-only'] = true;
			if ( in_array( 'tvos', $jsonData->data->attributes->deviceFamilies ) )
				$appExtend['appletv'] = true;
			if ( isset( $jsonData->data->attributes->deviceFamilies ) && ( 1 == count( $jsonData->data->attributes->deviceFamilies ) ) && ( 'tvos' == $jsonData->data->attributes->deviceFamilies['0'] ) )	
				$appExtend['appletvonly'] = true;
			*/
			if ( "Mac App Store" === pq( 'meta[property="og:site_name"]' )->attr( 'content' ) ) {
				$storeName = 'Mac App Store';
				$storeNameCSS = 'macappstore';
			} else {
				$storeName = 'App Store';
				$storeNameCSS = 'appstore';
			}
			$appScreenshots = array();
			if ( 'macappstore' == $storeNameCSS ):
				foreach ( pq( '.we-artwork--screenshot-platform-mac source:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots[] = $appScreenshot;
				endforeach;
			endif;
			foreach ( pq( 'li.gallery-nav__item a.ember-view' ) as $appShots ):
				$tempContent = $this->getContent( 'https://apps.apple.com' . pq( $appShots )->attr('href') );
				if ( isset( $tempContent['body'] ))
					phpQuery::newDocumentHTML( $tempContent['body'] );
				else break;
				foreach ( pq( '.we-artwork--screenshot-platform-iphone source[type=\'image/webp\']:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots['iphone'][] = $appScreenshot;
				endforeach;
				foreach ( pq( '.we-artwork--screenshot-platform-ipad source[type=\'image/webp\']:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots['ipad'][] = $appScreenshot;
				endforeach;
				foreach ( pq( '.we-artwork--screenshot-platform-apple-watch source[type=\'image/webp\']:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots['watch'][] = $appScreenshot;
				endforeach;
				foreach ( pq( '.we-artwork--screenshot-platform-messages source[type=\'image/webp\']:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots['imessage'][] = $appScreenshot;
				endforeach;
				foreach ( pq( '.we-artwork--screenshot-platform-apple-tv source[type=\'image/webp\']:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots['appletv'][] = $appScreenshot;
				endforeach;
				foreach ( pq( '.we-artwork--screenshot-platform-mac source[type=\'image/webp\']:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots['mac'][] = $appScreenshot;
				endforeach;
			endforeach;
			if ( empty( $appScreenshots ) ):
				foreach ( pq( '.we-screenshot-viewer source[type=\'image/webp\']:not([media])') as $appShots ):
					preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', pq( $appShots )->attr( 'srcset' ), $appScreenshotMatch );
					$appScreenshot = str_replace( '.webp' , '.png', $appScreenshotMatch[0][0] );
					$appScreenshots['appletv'][] = $appScreenshot;
				endforeach;
			endif;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_price'] = $appPrice;
			$appData['app_has_iap'] = $appHasIAP;
			$appData['app_extend'] = $appExtend;
			$appData['app_rating'] = $appRating;
			$appData['store_name'] = $storeName;
			$appData['store_name_css'] = $storeNameCSS;
			$appData['app_screenshots'] = $appScreenshots;			
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getAppStore() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus dem WordPress-Plugin-Verzeichnis auslesen
	*
	* @since   1.7.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getWordPress( $appID, $cacheID, $storeID = 'wordpress' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( urldecode( $pageURL ) );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getWordPress() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( "Oops! " )->text();
			if ( $error_found != '' ) {
				return( false );
			}
			$appRating = pq( 'div.rating > div.wporg-ratings' )->attr( 'data-rating' );
			$appIcon_R = preg_match( '/<style type=\'text\/css\'>\#plugin-icon-.* \{ background-image: url\(\'(https:\/\/ps.w.org\/.*.png)\?rev.*/m', $thisContent['body'], $appIcon );
			if ( $appIcon_R ):
				$appIcon = $appIcon[1];
			else:
				$appIcon = plugins_url( 'img/wordpress-logo.png', dirname( __FILE__ ) );
			endif;
			$appTitle = pq( 'h1.plugin-title' )->text();
			$appAuthor = pq( 'span.byline .author.vcard>a' )->text();
			if ( 1 < substr_count($thisContent['body'], '<div class=\'plugin-contributor-info\'>' ) ) {
				$appAuthor = esc_html__('various', 'wp-appbox');
				$appAuthorURL = $pageURL;
			} else {
				$appAuthor = pq( 'span.byline .author.vcard>a' )->text();
				$appAuthorURL = pq( 'span.byline .author.vcard>a' )->attr( 'href' );
			}
			$appPrice = '0';
			$appScreenshots = array();
			foreach ( pq( 'ul.plugin-screenshots a') as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'href' );
				$appScreenshots[] = $appScreenshot;
			}
			$appURL = $pageURL;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_rating'] = $appRating;
			$appData['app_price'] = $appPrice;
			$appData['store_name'] = 'WordPress';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getWordPress() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
		
	
	/**
	* Informationen aus dem Microsoft "Classic" Store auslesen
	*
	* @since   1.0.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getMicrosoftClassicStore( $appID, $cacheID, $storeID = 'microsoftstore' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$old_phone_app = false;
		if ( strlen( $appID ) > 20 ) {
			$pageURL = 'https://www.windowsphone.com/s?appId=' . $appID;
			$old_phone_app = true;
		}
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getMicrosoftClassicStore() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			if ( 'Your request appears to be from an automated process' == pq( 'title' )->html() ) {
				wpAppbox_errorOutput( 'function: getMicrosoftClassicStore() ---> Microsoft blocks your server requests due to automated process. :-(' );
				return( false );
			}
			$appExtend = array();
			$error_found = pq( 'meta[name="ms.prod_type"]' )->attr( 'content' );
			if ( !in_array( $error_found, array( 'Apps', 'Games', 'AddOns', 'AddOn', 'Pass' ) ) ) return( false );
			$appURL = pq( 'link[rel="canonical"]' )->attr( 'href' );
			if ( $old_phone_app ) {
				$new_item_id = preg_replace( "/https:\/\/www.microsoft.com\/.*-.*\/store\/apps\/.*\/(.*)/i", "$1", $appURL );
				return( $this->getMicrosoftClassicStore( $new_item_id, $cacheID ) );
			}
			if ( '' != ( trim( pq( 'div.InAppPurchaseMessage' )->html() ) ) ) {
				$appHasIAP = true;
			} else {
				$appHasIAP = false;
			}
			$appURL = preg_replace( "/(https:\/\/www.microsoft.com\/)(.*)(store\/apps\/.*\/.*)/i", "$1$3", $appURL );
			$appTitle = pq( 'meta[name="ms.prod"]' )->attr( 'content' );
			if (  '0' == pq( 'meta[itemprop="price"]' )->attr( 'content' ) ):
				$appPrice = '0';
			else:
				$appPrice = trim( pq( 'meta[itemprop="price"]' )->attr( 'content' ) );
			endif;
			if (  '' != pq( '#buttonPanel_AppIdentityRedeemCodeButton' )->attr( 'aria-label' ) )
				$appPrice = 'code';
			$oldPrice = trim( pq( 'div#productPrice .pi-price-text s' )->html() );
			if ( '' != $oldPrice ) $appExtend['oldPrice'] = $oldPrice;
			$appAuthor = pq( 'div#publisher div span' )->html();
			$appRating = pq( 'div#ratingSummary div.c-rating' )->attr( 'data-value' );
			
			$appIcon = pq( 'div.pi-product-image picture img' )->attr( 'src' );
			
			if ( '' == $appIcon ) {
				$appIcon = pq( 'meta[property="og:image"]' )->attr( 'content' );
				if ( '' == $appIcon ) $appIcon = pq( 'div#image:first picture.c-image img' )->attr( 'src' );
			}

			if ( !strpos( $appIcon, 'xboxlive.com/image?' ) && !empty( $appIcon ) ):
				$appBackground_parts = parse_url( $appIcon );
				parse_str( $appBackground_parts['query'], $appBackground );
				if ( isset( $appBackground ) && array_key_exists( 'background', $appBackground ) )
					$appIcon = substr( $appIcon, 0, strrpos( $appIcon, '?' ) ) . '?background=' . urlencode( $appBackground['background'] ) . '&w=92&q=80';
				else 
					$appIcon = substr( $appIcon, 0, strrpos( $appIcon, '?' ) ) . '?w=92&q=80';
			endif;
			$appScreenshots = array();
			foreach ( pq( 'div[data-key="mobile"] picture.c-image img') as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'data-src' );
				$appScreenshot = substr( $appScreenshot, 0, strrpos( $appScreenshot, '?' ) ) . '?format=jpg&h=500&q=80';
				$appScreenshots['mobile'][] = $appScreenshot;
			}
			foreach ( pq( 'div[data-key="desktop"] picture.c-image img') as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'data-src' );
				$appScreenshot = substr( $appScreenshot, 0, strrpos( $appScreenshot, '?' ) ) . '?format=jpg&h=500&q=80';
				$appScreenshots['desktop'][] = $appScreenshot;
			}
			foreach ( pq( 'div[data-key="xbox"] picture.c-image img') as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'data-src' );
				if ( !strpos( $appIcon, 'xboxlive.com/image?' ) )
					$appScreenshot = substr( $appScreenshot, 0, strrpos( $appScreenshot, '?' ) ) . '?format=jpg&h=500&q=80';
				$appScreenshots['xbox'][] = $appScreenshot;
			}
			foreach ( pq( 'div[id^="feature"] .c-feature picture img') as $appShots ) { //Screenshots for Pass
				$appScreenshot = pq( $appShots )->attr( 'data-src' );
				if ( !strpos( $appIcon, 'xboxlive.com/image?' ) )
					$appScreenshot = substr( $appScreenshot, 0, strrpos( $appScreenshot, '?' ) ) . '?format=jpg&h=500&q=80';
				$appScreenshots['desktop'][] = $appScreenshot;
			}
			$appURL = $pageURL;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_rating'] = $appRating;
			$appData['app_has_iap'] = $appHasIAP;
			$appData['app_price'] = trim( $appPrice );
			if ( isset( $appExtend ) ) $appData['app_extend'] = $appExtend;
			$appData['store_name'] = 'Microsoft Store';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		if ( isset( $thisContent['body'] ) && '403' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getMicrosoftClassicStore() ---> Access denied (403)' );
		}
		wpAppbox_errorOutput( 'function: getMicrosoftClassicStore() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
		
	
	/**
	* Informationen aus dem Microsoft Store auslesen
	*
	* @since   1.0.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getMicrosoftStore( $appID, $cacheID, $storeID = 'microsoftstore' ) {
		if ( 20 <= strlen( $appID ) ) $this->getEdgeAddons( $appID, $cacheID );
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$jsonURL = 'https://apps.microsoft.com/store/api/ProductsDetails/GetProductDetailsById/' . $appID . strstr( $pageURL, '?' );
		$thisContent = $this->getContent( $jsonURL );
		$jsonContent = json_decode( $thisContent['body'] );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $jsonContent->title ) ) {
			wpAppbox_errorOutput( 'function: getMicrosoftStore() ---> Get app information' );
			$appExtend = array();
			$appURL = $pageURL;
			$appTitle = $jsonContent->title;
			$appRating = $jsonContent->averageRating;
			$appIcon = $jsonContent->iconUrl;
			$appAuthor = $jsonContent->publisherName;
			$appAuthorURL = 'https://apps.microsoft.com/store/search' . strstr( $pageURL, '?' ) . '&publisher=' . rawurlencode( $appAuthor );
			$appPrice = $jsonContent->displayPrice;
			if ( !preg_match( '~[0-9]+~', $appPrice ) ) $appPrice = '0';
			$appHasIAP = $jsonContent->hasThirdPartyIAPs;
			$appScreenshots = array();
			foreach ( $jsonContent->screenshots as $appShots ) {
				$appScreenshots[] = $appShots->url;
			}
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = trim( $appAuthorURL );
			$appData['app_rating'] = $appRating;
			$appData['app_has_iap'] = $appHasIAP;
			$appData['app_price'] = trim( $appPrice );
			if ( isset( $appExtend ) ) $appData['app_extend'] = $appExtend;
			$appData['store_name'] = 'Microsoft Store';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		if ( isset( $thisContent['body'] ) && '403' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getMicrosoftStore() ---> Access denied (403)' );
		}
		wpAppbox_errorOutput( 'function: getMicrosoftStore() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
		
	
	/**
	* Informationen aus den Edge-Add-Ons auslesen
	*
	* @since   4.4.0
	* @change  n/a
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getEdgeAddons( $appID, $cacheID, $storeID = 'edgeaddons' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$jsonURL = 'https://microsoftedge.microsoft.com/addons/getproductdetailsbycrxid/' . $appID . strstr( $pageURL, '?' );
		$thisContent = $this->getContent( $jsonURL );
		$jsonContent = json_decode( $thisContent['body'] );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $jsonContent->name ) ) {
			wpAppbox_errorOutput( 'function: getEdgeAddons() ---> Get app information' );
			$appURL = $pageURL;
			$appTitle = $jsonContent->name;
			$appRating = $jsonContent->averageRating;
			$appIcon = $jsonContent->thumbnail;
			$appAuthor = $jsonContent->developer;
			$appPrice = '0';
			$appScreenshots = array();
			foreach ( $jsonContent->images as $appShots ) {
				$appScreenshots[] = $appShots->uri;
			}
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_rating'] = $appRating;
			$appData['app_price'] = trim( $appPrice );
			$appData['store_name'] = 'Edge-Add-Ons';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		if ( isset( $thisContent['body'] ) && '403' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getEdgeAddons() ---> Access denied (403)' );
		}
		wpAppbox_errorOutput( 'function: getEdgeAddons() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
		
	
	/**
	* Informationen aus der Huawei App Gallery auslesen
	*
	* @since   4.4.0
	* @change  n/a
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getAppGallery( $appID, $cacheID, $storeID = 'appgallery' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		//https://web-dre.hispace.dbankcloud.cn/uowap/index?method=internal.getTabDetail&serviceType=20&reqPageNum=1&maxResults=1&uri=app|C105581953&shareTo=&currentUrl=https%3A%2F%2Fappgallery.huawei.com%2Fapp%2FC105581953&accessId=&appid=C105581953&zone=&locale=de
		$jsonURL = 'https://web-dre.hispace.dbankcloud.cn/uowap/index?method=internal.getTabDetail&serviceType=20&reqPageNum=1&maxResults=1&uri=app|'. $appID . '&shareTo=&currentUrl=https%3A%2F%2Fappgallery.huawei.com%2Fapp%2F'. $appID . '&accessId=&appid='. $appID . '&zone=&locale=de';
		$thisContent = $this->getContent( $jsonURL );
		$jsonContent = json_decode( $thisContent['body'] );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $jsonContent->layoutData[0]->dataList[0]->name ) ) {
			wpAppbox_errorOutput( 'function: getAppGallery() ---> Get app information' );
			$appURL = $pageURL;
			$appTitle = $jsonContent->layoutData[0]->dataList[0]->name;
			$appRating = $jsonContent->layoutData[0]->dataList[0]->stars;
			$appIcon = $jsonContent->layoutData[0]->dataList[0]->icoUri;
			$appPrice = $jsonContent->layoutData[1]->dataList[0]->price;
			$appAuthor = $jsonContent->layoutData[3]->dataList[0]->developer;
			$appScreenshots = array();
			foreach ( $jsonContent->layoutData[2]->dataList[0]->images as $appShots ) {
				$appScreenshots[] = $appShots;
			}
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_rating'] = $appRating;
			$appData['app_price'] = trim( $appPrice );
			$appData['store_name'] = 'Huawei AppGallery';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		if ( isset( $thisContent['body'] ) && '403' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getAppGallery() ---> Access denied (403)' );
		}
		wpAppbox_errorOutput( 'function: getAppGallery() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus dem Opera Addon-Archiv auslesen
	*
	* @since   1.7.5
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getOperaAddons( $appID, $cacheID, $storeID = 'operaaddons' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset($thisContent['body']) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getOperaAddons() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			if ( '404' == pq( "div.contained>header>h2" )->text()) {
				return( false );
			} elseif ( NULL != pq( "div#unavailable" )->text() ) {
				return( false );
			}
			$appRating = pq( 'p.rating>span[class="meter"]>span' )->attr( 'title' );
			$appTitle = pq( 'meta[property="og:title"]' )->attr( 'content' );
			$appIcon = pq( 'meta[property="og:image"]' )->attr( 'content' );
			$appIcon = str_replace( 'http://addons.opera.com', '', $appIcon );
			$appURL = pq( 'meta[property="og:url"]' )->attr( 'content' );
			$appAuthor = pq( 'article.pkg-details h2.h-byline>a' )->html();
			$appAuthorURL = 'https://addons.opera.com' . pq( 'article.pkg-details h3.h-byline>a' )->attr( 'href' );
			$appPrice = '0';
			$appScreenshots = array();
			foreach ( pq( 'section.image-viewer li.thumbnail a') as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'href' );
				$appScreenshots[] = $appScreenshot;
			}
			$appURL = $pageURL;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_rating'] = $appRating;
			$appData['app_price'] = $appPrice;
			$appData['store_name'] = 'Opera Add-ons';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getOperaAddons() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus F-Droid auslesen
	*
	* @since   4.2.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getFDroid( $appID, $cacheID, $storeID = 'fdroid' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getFDroid() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );			
			$error_found = pq( 'title' )->html();
			if ( FALSE !== strpos( $error_found, '404' ) ) {
				return( false );
			}
			//App-Daten aus der HTML-Seite auslesen
			$appURL = pq( 'link[rel="canonical"]' )->attr( 'href' );
			$appIcon = pq( 'img.package-icon' )->attr( 'src' );
			$appTitle = pq( 'h3.package-name' )->html();
			$appAuthor = pq( 'ul.package-links .package-link:first a[href*=mailto:]' )->html();
			$appAuthorURL = pq( 'ul.package-links .package-link:first a[href*=mailto:]' )->attr( 'href' );
			$appPrice = '0';
			$appRating = '';
			$appScreenshots = array();
			foreach ( pq( 'ul.gallery li.screenshot img' ) as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'src' );
				$appScreenshots[] = $appScreenshot;
			}
			$appURL = $pageURL;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_price'] = $appPrice;
			$appData['app_has_iap'] = ( ( isset( $appHasIAP ) && $appHasIAP ) ? true : false );
			$appData['app_rating'] = $appRating;
			$appData['store_name'] = 'F-Droid';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getFDroid() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus dem Firefox Addon-Verzeichnis auslesen
	*
	* @since   1.4.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getFirefoxAddon( $appID, $cacheID, $storeID = 'firefoxaddon' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getFirefoxAddon() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( '.NotFound' )->html();
			if ( $error_found != '' ) {
				wpAppbox_errorOutput( 'function: getFirefoxAddon() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
				return( false );
			}
			$appTitle = pq( 'h1.AddonTitle' )->html();
			$appTitle = Trim( preg_replace( '/<span[^>]*>([\s\S]*?)<\/span[^>]*>/', '', $appTitle ) );
			$appAuthor = pq( 'span.AddonTitle-author > a' )->html();
			$appAuthorURL = 'https://addons.mozilla.org' . pq( 'span.AddonTitle-author > a' )->attr( 'href' );
			$appIcon = pq( 'img.Addon-icon-image' )->attr( 'src' );
			$appPrice = '0';
			$appRating = 0;
			foreach ( pq( 'div.Rating-selected-star') as $tempRating )
				$appRating = $appRating + 1;
			foreach ( pq( 'div.Rating-half-star') as $tempRating )
				$appRating = $appRating + 0.5;
			$appScreenshots = array();
			foreach ( pq( 'div.pswp-thumbnail img.ScreenShots-image') as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'src' );
				$appScreenshots[] = $appScreenshot;
			}
			if ( '' != pq( 'div.ThemeImage>img' )->attr( 'src' ) )
				$appScreenshots[] = pq( 'div.ThemeImage>img' )->attr( 'src' );
			$appURL = $pageURL;
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_rating'] = $appRating;
			$appData['app_price'] = $appPrice;
			$appData['store_name'] = 'Firefox Add-ons';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getFirefoxAddon() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}
	
	
	/**
	* Informationen aus dem Chrome Web Store auslesen
	*
	* @notice  Keine Screenshots
	*
	* @since   1.0.0
	* @change  4.4.0
	*
	* @param   string  $appID    ID der App
	* @param   string  $storeID  ID des Stores (wird fest vergeben)
	* @return  array   $appData  Array der App-Daten
	*/
	
	function getChromeWebStore( $appID, $cacheID, $storeID = 'chromewebstore' ) {
		$pageURL = $this->getStoreURL( $storeID, $appID );
		$thisContent = $this->getContent( $pageURL );
		if ( '301' == $thisContent['response']['code'] ) {
			$thisContent = $this->getContent( $thisContent[1]['redirect_url'] );
		} else if ('0' == $thisContent['response']['code'] ) {
			$thisContent = $this->getContent( urldecode( 'https://chrome.google.com' . $thisContent['headers']['url'] ) );
		}
		//wpAppbox_errorOutput( $thisContent );
		$appData = array();
		if ( isset( $thisContent['body'] ) && '200' == $thisContent['response']['code'] ) {
			wpAppbox_errorOutput( 'function: getChromeWebStore() ---> Get app information' );
			phpQuery::newDocumentHTML( $thisContent['body'] );
			$error_found = pq( "#error-section" )->text();
			if ( $error_found != '' ) {
				return( false );
			}
			$appRating = pq( 'meta[itemprop="ratingValue"]' )->attr( 'content' );
			$appIcon = pq( 'meta[property="og:image"]' )->attr( 'content' );
			$appURL = pq( 'meta[property="og:url"]' )->attr( 'content' );
			$appTitle = pq( 'meta[property="og:title"]' )->attr( 'content' );
			if ( '' != pq( 'a.e-f-y' )->html() ) {
				$appAuthor = pq( 'a.e-f-y' )->html(); 
				$appAuthorURL = pq( 'a.e-f-y' )->attr( 'href' );
			} else if ( '' != pq( 'div.e-f-Me.e-f-Xi-oc' )->html() ) {
				$appAuthor = pq( 'div.e-f-Me.e-f-Xi-oc' )->html();
				$appAuthorParts = explode( ' ', $appAuthor, 3 );
				$appAuthor = end ( $appAuthorParts );
				if ( parse_url( $appAuthor ) ) {
					$appAuthorURL = "http://$appAuthor";
				}
			} else if ( '' != pq( 'span.e-f-Me > a' )->html() ) { 
				$appAuthor = pq( 'span.e-f-Me > a' )->html();
				$appAuthorParts = explode( ' ', $appAuthor, 3 );
				$appAuthor = end ( $appAuthorParts );
				$appAuthorURL = pq( 'a.e-f-y' )->attr( 'href' );
				if ( '' == $appAuthorURL ) {
					$appAuthorURL = $appURL;
				}
			} else if ( '' != pq( 'span.e-f-Me' )->html() ) { 
				$appAuthor = pq( 'span.e-f-Me' )->html();
				$appAuthorParts = explode( ' ', $appAuthor, 3 );
				$appAuthor = end ( $appAuthorParts );
				$appAuthorURL = pq( 'a.e-f-y' )->attr( 'href' );
				if ( '' == $appAuthorURL ) {
					$appAuthorURL = $appURL;
				}
			} else {
				$appAuthor = esc_html__('Unknown', 'wp-appbox');
				$appAuthorURL = $appURL;
			}
			if ( '$0' == pq( 'meta[itemprop="price"]' )->attr( 'content' ) ) {
				$appPrice = '0';
			} else {
				$appPrice = '0';
			}
			$appScreenshots = array();
			foreach ( pq( 'img[aria-hidden="true"]') as $appShots ) {
				$appScreenshot = pq( $appShots )->attr( 'src' );
				$appScreenshots[] = $appScreenshot;
			}
			//App-Daten in Array schreiben
			$appData['id'] = $cacheID;
			$appData['app_id'] = $appID;
			$appData['app_url'] = $appURL;
			$appData['app_icon'] = $appIcon;
			$appData['app_title'] = trim( $appTitle );
			$appData['app_author'] = trim( $appAuthor );
			$appData['app_author_url'] = $appAuthorURL;
			$appData['app_rating'] = $appRating;
			$appData['app_price'] = $appPrice;
			$appData['store_name'] = 'Chrome Web Store';
			$appData['store_name_css'] = $storeID;
			$appData['app_screenshots'] = $appScreenshots;
			return( $appData );
		}
		wpAppbox_errorOutput( 'function: getChromeWebStore() ---> Get no app information (Statuscode ' . $thisContent['response']['code'] . ')' );
		return( false );
	}	
	
} /* Class beenden */

?>