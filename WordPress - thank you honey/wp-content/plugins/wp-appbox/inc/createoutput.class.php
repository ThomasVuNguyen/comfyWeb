<?php
	
include_once( "imagecache.class.php" );

/**
* wpAppbox_CreateOutput
*/

class wpAppbox_CreateOutput {
	
	/**
	* Prüft ob Bilder auf einem externen Server exisitieren / Wird noch nicht genutzt
	*
	* @since   4.0.0
	* @change  4.4.0
	*
	* @param   string  	$theURL   	App-Link
	* @return  boolean	true/false  true wenn existiert
	*/
	
	function checkExImageURL( $appIcon ) {
		return( true );
		if ( 'http' != substr( $appIcon, 0, 4 ) ) {
			if ( is_ssl() ) $appIcon = 'https:' . $appIcon;
			else $appIcon = 'http:' . $appIcon;
		}	    
	    $args = array();
		add_action( 'http_api_curl', function( $curl_handle ) {
  			curl_setopt( $curl_handle, CURLOPT_NOBODY, 1 );
  			curl_setopt( $curl_handle, CURLOPT_FAILONERROR, 1 );
  			curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, 1 );
		});
		$response = wp_remote_get( utf8_decode( esc_url( $appIcon ) ), $args  );
		if ( "200" == wp_remote_retrieve_response_code( $response ) ) return( true );
		return( false );
	}
	
	
	/**
	* Ersetzt HTTP und HTTPS durch // und wandelt Links für Apple und Amazon um
	*
	* @since   3.0.2
	* @change  4.4.0
	*
	* @param   string  $theURL   App-Link
	* @return  string  $theURL   Umgewandelter App-Link
	*/
	
	function cleanURL( $theURL ) {
		if ( is_ssl() || get_option( 'wpAppbox_forceSSL' ) ) {
			$theURL = str_replace( 'http://', '//', $theURL );
			$theURL = str_replace( 'https://', '//', $theURL );
			if ( strpos( $theURL, 'amazon.' ) ):
				$theURL = str_replace( 'ecx.images-amazon.com', 'images-na.ssl-images-amazon.com', $theURL );
				$theURL = 'https:' . $theURL;
			endif;
		}
		return( esc_url( $theURL ) );
	}
	
	
	/**
	* Prüft ob eine gültige Store-ID und App-ID angebeben wurden
	*
	* @since   2.0.0
	* @change  3.2.0
	*
	* @param   array    $attr       Attribute [WordPress]
	* @return  boolean  true/false  TRUE when both
	*/
	
	function checkAttributs( $attr ) {
		if ( '' == $attr['store'] ) {
			return( 'nostore');
		} elseif ( '' == $attr['appid'] ) {
			return( 'noappid' );
		} else {
			return( true );
		}
	}
	
	
	/**
	* Erzeugt die Ausgabe für den Feed
	*
	* @since   2.0.0
	* @change  3.2.0
	*
	* @return  string  output  Feedausgabe
	*/
	
	function getTheFeedOutput() {
		$feedOutput = "<p><a href=\"{APPLINK}\" title=\"{TITLE}\">{TITLE} ({PRICE}, {STORE}) →</a></p>";
		return( $feedOutput );
	}
	
	
	/**
	* Gibt Bilder von externen Servern über einen eigenen Bilder-Proxy zurück
	*
	* @since   4.0.45
	* @change  4.2.24
	*
	* @param   string  $imageURL  	   URL eines Bildes
	* @return  string                  Rückgabe der Bild-URL mitsamt der Proxy-URL
	*/
	
	function returnImageProxyURL( $imageURL ) {
		if ( !get_option('wpAppbox_imgProxy') || !ini_get( 'allow_url_fopen' ) ) return( $imageURL );
		if ( 0 === strpos( $imageURL, $this->cleanURL( get_site_url() ) ) ) return( $imageURL );
		if ( 0 !== strpos( $imageURL, 'http' ) ) {
			if ( 0 === strpos( get_site_url(), 'https' ) ) $imageURL = 'https:' . $imageURL;
			else $imageURL = 'http:' . $imageURL;
		}
		if ( FALSE === filter_var( $imageURL, FILTER_VALIDATE_URL ) ) return( $imageURL ); //die( 'Invalid URL' );
		$allowedImageTypes = array( 'image/jpeg', 'image/png', 'image/webp' );
		$imageURL = esc_url_raw( $imageURL );
		$getImage = wp_remote_get( $imageURL );
		$imageInfo = wp_remote_retrieve_header( $getImage, 'content-type' );
		if ( !in_array( $imageInfo, $allowedImageTypes ) ) return( $imageURL ); //die( 'Invalid image file' );
		$imageURL = $data_uri = 'data:image/jpeg;base64,' . base64_encode( $getImage['body'] ) ;
		return( $imageURL );
	}
	
	
	/**
	* Gibt die URL des QR-Code zurück
	*
	* @since   2.0.0
	* @change  4.1.13
	*
	* @param   string  $appLink   URL der App
	* @param   string  $appID     ID der App
	* @param   string  $cacheID   Cache-ID der App
	* @param   string  $onlyLink  Nur Rückgabe des Links, ohne Caching und ähnlichem [optional]
	* @param   string  $size      Bildgröße des QR-Codes [optional]
	* @param   string  $EC_level  Fehlerkorrektur (L, M, Q, H) [optional]
	* @param   string  $margin    Weißer Rahmen um den Code [optional]
	* @return  string             URL des QR-Codes
	*
	* @infos   https://developers.google.com/chart/infographics/docs/qr_codes
	*/
	
	function returnQRCode( $appLink, $appID, $cacheID, $onlyLink = false, $size = '200', $EC_level = 'L', $margin = '0' ) {
		global $ItemInfo;
		$wpAppbox_CreateOutput_Helper = new wpAppbox_CreateOutput;
		$appLink = $wpAppbox_CreateOutput_Helper->returnAppLink( $appLink, $appID );
		$qrCode = urlencode( $appLink );
		$qrCode = "https://chart.googleapis.com/chart?cht=qr&chl=$qrCode&chs=$size"."x"."$size&chld=$EC_level%7C$margin";
		if ( !$onlyLink ):
			$imageCache = new wpAppbox_imageCache;
			$qrCode = $imageCache->cacheImages( $qrCode, $cacheID, 'qr' );
			$qrCode = $wpAppbox_CreateOutput_Helper->returnImageProxyURL( $qrCode );
		endif;
		return( $qrCode );
	}
	
	
	/**
	* Gibt den Entwickler mitsamt Link zurück
	*
	* @since   2.0.0
	* @change  3.2.5
	*
	* @param   string  $appAuthor     Name des Entwicklers
	* @param   string  $appAuthorURL  URL der Autoren-Seite im Store
	* @param   string  $appLink       Manche Stores haben keine Entwicklerseite... [optional]
	* @return  string                 HTML-Ausgabe (<a></a>) des Entwicklers
	*/
	
	function returnDeveloper( $appAuthor, $appAuthorURL, $appID, $appLink = true ) {
		if ( $appAuthorURL === NULL ||$appAuthorURL == '' || !$appLink ) {
			return( $appAuthor );
		} else {
			$appAuthorURL = $this->returnAppLink( $appAuthorURL, $appID );
			return( '<a href="'.$appAuthorURL.'">'.$appAuthor.'</a>' );
		}
	}
	
	
	/**
	* Gibt das App-Icon zurück
	*
	* @since   2.0.0
	* @change  4.2
	*
	* @param   string  $cacheID  	   Cache-ID der App
	* @param   string  $appIcon        URL des App-Icons
	* @param   string  $appStore       ID des Stores (z.B. "microsoftstore")
	* @param   string  $appBackground  Windows Store hat teilweise Hintergrundfarben [optional]
	* @return  string                  Rückgabe der Icon-URL (Windows Store mit Hintergrund)
	*/
	
	function returnAppIcon( $cacheID, $appIcon, $appStore, $appBackground = '' ) {
		$imageCache = new wpAppbox_imageCache;
		$appIcon = $imageCache->cacheImages( $appIcon, $cacheID, 'ai' );
		$appIcon = $this->cleanURL( $appIcon ); 
		$appIcon = $this->returnImageProxyURL( $appIcon );
		if ( $appStore == 'microsoftstore' && $appBackground != '' ) {
			return( $appIcon . '" style="' . $appBackground . ';');
		} else {
			return( $appIcon );
		}
	}
	
	
	/**
	* Gibt den Link zum Store zurück (mit Affiliate)
	*
	* @since   2.0.0
	* @change  4.1.26
	*
	* @param   string  $appLink  URL der App
	* @param   string  $appID    ID der App
	* @return  string  $appLink  Rückgabe der URL mit Affiliate-ID
	*/
	
	function returnAppLink( $appLink, $appID ) {
		global $wpAppbox_MicrosoftPrivateAffiliateProgramm;
		/**
		* Link-Umwandlung für das Amazon PartnerNet
		*/
		$affiliateID = '';
		if ( preg_match( '/(?:https?\:\/\/)?(www.)?amazon\.(?:.{2,8})/i', $appLink ) && false === strpos( $appLink, 'play.google' ) ):
			if ( get_option('wpAppbox_userAffiliate') ):
				$authorID = get_the_author_meta('ID');
				if ( get_option( 'wpAppbox_user_' . $authorID . '_ownAffiliateAmazon' ) ):
					$affiliateID = Trim( get_option( 'wpAppbox_user_' . $authorID . '_affiliateAmazon' ) );
				endif;
				if ( '' != $affiliateID ):
					$appLink = str_replace( get_option( 'wpAppbox_affiliateAmazonID' ), $affiliateID, $appLink );
					return( $appLink );
				endif;
			endif;
			if ( '' == $affiliateID ):
				if ( get_option('wpAppbox_affiliateAmazonDev') )
					$affiliateID = WPAPPBOX_AFFILIATE_AMAZON;
				else
					$affiliateID = get_option('wpAppbox_affiliateAmazonID');
			endif;
			if ( '' != $affiliateID )
				$appLink = $appLink .' ref=as_li_tf_tl?ie=UTF8&camp=1638&creative=6742&creativeASIN=' . $appID . '&linkCode=am2&tag=' . $affiliateID;
		endif;
		/**
		* Link-Umwandlung für das Microsoft Private Affiliate Program
		*/
		if ( preg_match( '/(:https?\:\/\/)?(apps.|microsoftedge.)microsoft.com/i', $appLink ) ):
			if ( get_option('wpAppbox_userAffiliate') ):
				$authorID = get_the_author_meta('ID');
				if ( get_option('wpAppbox_user_'.$authorID.'_ownAffiliateMicrosoft') ):
					$affiliateID = Trim( get_option('wpAppbox_user_' . $authorID . '_affiliateMicrosoft') );
					$programID = Trim( get_option('wpAppbox_user_' . $authorID . '_affiliateMicrosoftProgram') );
				endif;
			endif;
			if ( ( '' == $affiliateID ) || ( '' == $programID ) ):
				if ( get_option('wpAppbox_affiliateMicrosoftDev') ):
					$affiliateID = WPAPPBOX_AFFILIATE_MICROSOFT;
					$programID = WPAPPBOX_AFFILIATE_MICROSOFT_PROGRAM;
				else:
					$affiliateID = Trim( get_option('wpAppbox_affiliateMicrosoftID') );
					$programID = Trim( get_option('wpAppbox_affiliateMicrosoftProgram') );
				endif;
			endif;			
			if ( ( '' != $affiliateID ) && ( '' != $programID ) ):
				$appLink = 'https://click.linksynergy.com/deeplink?id=' . $affiliateID . '&mid=' . $programID . '&murl=' . urlencode( $appLink );
			endif;
		endif;
		if ( function_exists( 'wpAppbox_customAppURL' ) )
			$appLink = wpAppbox_customAppURL( $appLink );
		/**
		* Links anonymisieren
		*/
		if ( get_option('wpAppbox_anonymizeLinks') ) 
			$appLink = 'https://anon.to/?' . $appLink;
		/**
		* Ausgabe des App-Links
		*/
		return( $appLink );
	}
	
	
	/**
	* Gibt die Bewertung zurück
	*
	* @since   2.1.0
	* @change  4.0.41
	*
	* @param   string  $appRating  Bewertung der App
	* @return  string              HTML-Ausgabe der Bewertungssterne
	*/
	
	function returnRating( $appRating ) {
		if ( '1' != get_option('wpAppbox_showRating') && '2' != get_option('wpAppbox_showRating') ) return( '' );
		if (  '-1' == $appRating ) return( '' );
		$appRating = str_replace( ',', '.', $appRating );
		$appRating = number_format( $appRating, 2 );
		$appRating = round( $appRating, 1 );
		if ( $appRating <= 0.3 ):
			$appRatingStars = '00';
		elseif ( $appRating >= 0.4 && $appRating <= 0.7 ):
			$appRatingStars = '05';
		elseif ( $appRating >= 0.8 && $appRating <= 1.3 ):
			$appRatingStars = '10';
		elseif ( $appRating >= 1.4 && $appRating <= 1.7 ):
			$appRatingStars = '15';
		elseif ( $appRating >= 1.8 && $appRating <= 2.3 ):
			$appRatingStars = '20';
		elseif ( $appRating >= 2.4 && $appRating <= 2.7 ):
			$appRatingStars = '25';
		elseif ( $appRating >= 2.8 && $appRating <= 3.3 ):
			$appRatingStars = '30';
		elseif ( $appRating >= 3.4 && $appRating <= 3.7 ):
			$appRatingStars = '35';
		elseif ( $appRating >= 3.8 && $appRating <= 4.3 ):
			$appRatingStars = '40';
		elseif ( $appRating >= 4.4 && $appRating <= 4.8 ):
			$appRatingStars = '45';
		elseif ( $appRating >= 4.9):
			$appRatingStars = '50';
		else:
			return( '' );
		endif;
		if ( '1' == get_option('wpAppbox_showRating') )
			$starsColor = 'stars-monochrome';
		else
			$starsColor = 'stars-colorful';
		return( '<div title="' . $appRating . ' ' . __('of 5 stars', 'wp-appbox') . '" class="rating-stars ' . $starsColor . ' stars' . $appRatingStars . '"></div>' );
	}
	
	
	/**
	* Gibt die Screenshots zurück
	*
	* @since   2.0.0
	* @change  4.4.0
	*
	* @param   array   $appScreenshots     Array der Screenshots
	* @param   string  $storeID            ID des Stores (z.B. "appstore")
	* @param   string  $cacheID            Cache-ID der App
	* @param   string  $appType            Typ der Screenshotausgabe (z.B "iphone") [optional]  
	* @return  string  $outputScreenshots  HTML-Ausgabe der Screenshots (Liste)
	*/
	
	function returnScreenshots( $appScreenshots, $storeID, $cacheID, $appType = '' ) {		
		switch ( $storeID ):
			case 'appstore':
				$appScreenshots['mac'][] = '';
				$appScreenshots['iphone'][] = '';
				$appScreenshots['ipad'][] = '';
				$appScreenshots['watch'][] = '';
				$appScreenshots['imessage'][] = '';
				$appScreenshots['appletv'][] = '';
				$appScreenshots[] = '';
				switch ( $appType ):
				case 'mac':
					$appScreenshots = $appScreenshots['mac'];
					break;
				case 'iphone':
					$appScreenshots = $appScreenshots['iphone'];
					break;
				case 'ipad':
					$appScreenshots = $appScreenshots['ipad'];
					break;
				case 'watch':
					$appScreenshots = $appScreenshots['watch'];
					break;
				case 'imessage':
					$appScreenshots = $appScreenshots['imessage'];
					break;
				case 'appletv':
					$appScreenshots = $appScreenshots['appletv'];
					break;
				default:
					$appScreenshots = array_merge( $appScreenshots['mac'], $appScreenshots['iphone'], $appScreenshots['ipad'], $appScreenshots['imessage'], $appScreenshots['watch'], $appScreenshots['appletv'] );
					break;
				endswitch;
				break;
		endswitch;
		$outputScreenshots = '';
		foreach ( $appScreenshots as $screenshotID => $screenshotURL ):
			if ( $screenshotURL != '' ):
				$imageCache = new wpAppbox_imageCache;
				$screenshotURL = $imageCache->cacheImages( $screenshotURL, $cacheID, 'ss' );
				$screenshotURL = $this->cleanURL( $screenshotURL );
				$screenshotURL = $this->returnImageProxyURL( $screenshotURL );
				$outputScreenshots .= "<li><img src=\"$screenshotURL\" alt=\"" . esc_attr( '{TITLE_ATTR} ' . esc_attr__('Screenshot', 'wp-appbox') ) . "\" title=\"\" /></li>";
			endif;
		endforeach;
		return( $outputScreenshots );
	}
	
	
	/**
	* Gibt den Preis zurück
	*
	* @since   2.0.0
	* @change  4.2.0
	*
	* @param   string   $appPrice   Aktueller Preis der App
	* @param   boolean  $appHasIAP  TRUE when in-app-purchases
	* @param   string   $oldPrice   Alter Preis der App (Shortcode "oldprice=x")
	* @return  string               (HTML-)Ausgabe des Preises
	*/
	
	function returnPrice( $appPrice, $appHasIAP, $oldPrice = '' ) {
		if ( $appHasIAP):
			$appIAP = "<sup>+</sup>";
		else:
			$appIAP = '';
		endif;
		if ( '0' == $appPrice ):
			$appPrice = esc_html__('Free', 'wp-appbox');
		elseif ( 'code' == $appPrice ):
			$appPrice = esc_html__('Code needed', 'wp-appbox');
		endif;
		if ( $appPrice == $oldPrice || '' == $oldPrice ):
			return( $appPrice . $appIAP );
		else:
			return( "<span class=\"oldprice\">$oldPrice</span> " . $appPrice . $appIAP );
		endif;
	}
	
	
	/**
	* Gibt den Reload-Link zurück
	*
	* @since   2.0.0
	* @change  4.1.25
	*
	* @param   string  $cacheID  Cache-ID der App
	* @return  string            HTML-Ausgabe des Reload-Links (<a></a>)
	*/
	
	function returnReloadLink( $cacheID ) {
		if ( wpAppbox_isUserAuthor() ) {
			return('<a href="' . get_permalink() . ( is_preview() ? '?preview=true&amp;' : '?' ) . 'wpappbox_reload_cache&amp;app_cache_id=' . $cacheID . '" title="' . __('Renew cached data of this app', 'wp-appbox') . '" class="reload-link">&#10227;</a>');
		}
	}
	
	
	/**
	* Ausgabe diverser Fehler (wird überarbeitet)
	*
	* @since   2.0.0
	* @change  4.0.28
	*
	* @param   string  $error_type  Fehlertyp (nostore, noappid, notfound, fallback)
	* @param   string  $storeID     ID des Stores (z.B. "playstore) [optional]
	* @param   string  $appID       ID der App [optional]
	* @param   string  $style       Name des Banner-Styles [optional, Standard = simple]
	* @return  string               HTML-Ausgabe der Fehlermeldung
	*/
	
	function errorOutput( $error_type, $storeID = '', $appID = '', $style = 'simple' ) {
			
		$template = wpAppbox_loadTemplate( 'error' );
		
		switch ( $error_type ):
			case 'nostore':
				$errorMessage = esc_html__('The App Store is not recognized.', 'wp-appbox');
				break;
			case 'noappid':
				$errorMessage = esc_html__('The App ID is not recognized.', 'wp-appbox');
				break;
			case 'notfound':
				$errorMessage = esc_html__('The app was not found in the store.', 'wp-appbox');
				break;
			default:
				$errorMessage = esc_html__('An unknown error has occurred.', 'wp-appbox');
				break;
		endswitch;
		
		if ( 'notfound' == $error_type && ( get_option('wpAppbox_eOnlyAuthors') == false || wpAppbox_isUserAuthor() ) ):
			$cacheID_ = new wpAppbox_GetAppInfoAPI;
			$cssClasses = 'wpappbox wpappbox-' . $cacheID_->getCacheID( $storeID, $appID ) . ' ' . $storeID;
			$template = str_replace( '{WPAPPBOXCSSCLASSES}', $cssClasses, $template );
			$template = str_replace( '{WPAPPBOXVERSION}', WPAPPBOX_PLUGIN_VERSION, $template );
			$template = str_replace( '{APPID}', $appID, $template );
			$template = str_replace( '{ERRORMSG}', $errorMessage, $template );
			$template = str_replace( '{ERRORMSG_ATTR}', esc_attr( $errorMessage ), $template );
			$template = str_replace( '{ICON}', 'https://www.gravatar.com/avatar/' . md5( $appID ) . '?s=128&d=retro&r=G', $template );
			$template = str_replace( '{ICON}', plugins_url( 'img/wpappbox-icon.png', dirname( __FILE__ ) ), $template );
			$apiDummy = new wpAppbox_GetAppInfoAPI();
			$template = str_replace( '{APPLINK}', $apiDummy->getStoreURL( $storeID, $appID ), $template );
			$template = str_replace( '{GOOGLESEARCH}', 'https://www.google.com/search?q=' . $appID . '+' . $storeID, $template );
			if ( get_option('wpAppbox_nofollow') ):
				$template = str_replace( '<a ', '<a rel="nofollow" ', $template );
			endif;
			if ( get_option('wpAppbox_targetBlank') ):
				$template = str_replace( '<a ', '<a target="_blank" ', $template ); 
			endif;
			$template = str_replace( '{RELOADLINK}', $this->returnReloadLink( $apiDummy->getCacheID( $storeID, $appID ) ), $template );
			if ( !is_feed() ):
				$template = '<!-- WP-Appbox (Version: ' . WPAPPBOX_PLUGIN_VERSION . ' // Store: ' . $storeID . ' // ID: ' . $appID . ') -->' . $template . '<!-- /WP-Appbox -->';
			endif;
			return( $template );
		else:
			if ( wpAppbox_isUserAuthor() ):
				$template = '<div class="wpappbox errormsg"><span>WP-Appbox:</span> ' . $errorMessage . ' :-(</div>';
				return( $template );
			endif;
		endif;
		
	}
	
	
	/**
	* Rückgabe der eigentlich Appbox
	*
	* @since   2.0.0
	* @change  4.3.0
	*
	* @param   array   $attr      Attribute des Shortcodes [WordPress]
	* @return  string  $template  Rückgabe des fertigen Templates
	*/
	
	function theOutput( $attr ) {
		global $wpAppbox_optionsDefault, $appIsDeprecated;
		
		/**
		* Wenn keine Attribute erkannt werden, dann abbrechen und Fehlerausgabe
		*/
		if ( true !== $this->checkAttributs( $attr ) ) return( $this->errorOutput( $this->checkAttributs( $attr ) ) );
		
		/**
		* Attribute trennen => bestimmte Screenshot-Darstellung? -iphone -ipad -watch...
		*/
		$appType = '';
		switch ( $attr['store'] ):
			case 'appstore':
				if ( $attr['bundle'] == true )
					$attr['appid'] = 'bundle' . $attr['appid'];
				if ( preg_match( '/-iphone/', $attr['appid'] ) ) {
					$appType = 'iphone';
				} else if ( preg_match( '/-ipad/', $attr['appid'] ) ) {
					$appType = 'ipad';
				} else if ( preg_match( '/-watch/', $attr['appid'] ) ) {
					$appType = 'watch';
				} else if ( preg_match( '/-imessage/', $attr['appid'] ) ) {
					$appType = 'imessage';
				} else if ( preg_match( '/-appletv/', $attr['appid'] ) ) {
					$appType = 'appletv';
				} else {
					$appType = 'universal';
				}
				$attr['appid'] = str_replace( array( '-iphone', '-ipad', '-universal', '-watch', '-imessage', '-appletv' ), '', $attr['appid'] );
				if( 'id' == substr( $attr['appid'], 0, 2 ) ) {
					$attr['appid'] = substr( $attr['appid'], 2 );
				}
			break;
			case 'windowsstore':
			case 'microsoftstore':
				if ( preg_match( '/-mobile/', $attr['appid'] ) ) {
					$appType = 'mobile';
				}
				else if ( preg_match( '/-desktop/', $attr['appid'] ) ) {
					$appType = 'desktop';
				}
				else if ( preg_match( '/-xbox/', $attr['appid'] ) ) {
					$appType = 'xbox';
				}
				else {
					$appType = 'all';
				}
				$attr['appid'] = str_replace( array( '-mobile', '-desktop', '-xbox', '-all' ), '', $attr['appid'] );
			break;
		endswitch;
		
		/**
		* Neue API-Abfrage öffnen und durchführen
		*/
		$appData = new wpAppbox_GetAppInfoAPI;
		$appData = $appData->getTheAppData( $attr['store'], $attr['appid'] );
		
		/**
		* Wenn keine App-Daten vorhanden, dann abbrechen und Fehlerausgabe
		*/
		if ( !$appData ) return( $this->errorOutput( 'notfound', $attr['store'], $attr['appid'] ) );
		
		/**
		* Ist die App deprecated?
		*/
		$appIsDeprecated = false;
		if ( true == $appData['deprecated'] ) $appIsDeprecated = true;
		
		/**
		* Template für die Ausgabe laden
		*/
		$template = wpAppbox_loadTemplate( $attr['style'] );
		
		/**
		* Caching der App-Images durchführen
		*/
		if ( wpAppbox_ImageCache::quickcheckImageCache() ):
			$imageCache = new wpAppbox_imageCache;
			$allImages = array();
			if ( $imageCache->checkImageCacheType( 'appicon' ) )
				$allImages = $allImages + $imageCache->getURLarray( 'ai', $appData['app_icon'] );
			if ( $imageCache->checkImageCacheType( 'screenshots' ) )
				$allImages = $allImages + $imageCache->getURLarray( 'ss', $appData['app_screenshots'] );
			if ( $imageCache->checkImageCacheType( 'qrcode' ) )
				$allImages = $allImages + $imageCache->getURLarray( 'qr', $this->returnQRCode( $appData['app_url'], $appData['app_id'], $appData['id'] ) );
			//$result = $imageCache->cacheImages( $allImages, $appData['id'] );
		endif;
		
		/**
		* Screenshots aufbereiten
		*/
		if ( 'screenshots' == $attr['style'] || 'screenshots-only' == $attr['style'] ) :
			$appScreenshots = $this->returnScreenshots( $appData['app_screenshots'], $appData['store_name_css'], $appData['id'], $appType );
			if ( ( 'screenshots' === $attr['style'] || 'screenshots-only' === $attr['style'] ) && '' == $appScreenshots ) {
				$attr['style'] = get_option('wpAppbox_defaultStyle');
				if ( ( 'simple' != $attr['style'] ) && ( 'compact' != $attr['style'] ) ) {
					$attr['style'] = 'simple';
				}
				$template = wpAppbox_loadTemplate( $attr['style'] );
			} else {
				$template = str_replace( '{SCREENSHOTS}', $appScreenshots, $template );
			}
		endif;
		
		/**
		* Wenn Feed, dann nur die Feedausgabe aktivieren
		*/	
		if ( is_feed() ) $template = $this->getTheFeedOutput();
				
		/**
		* Gibt es eine extend-Variable, z.B. für Alexa-Infos?
		*/
		if ( !empty( $appData['app_extend'] ) ):
			if ( isset( $appData['app_extend']['alexaskill'] ) && $appData['app_extend']['alexaskill'] == true )
				$appData['store_name_css'] = 'amazonalexa';
			if ( isset( $appData['app_extend']['oldPrice'] ) && $appData['app_extend']['oldPrice'] == true )
				$attr['oldprice'] = $appData['app_extend']['oldPrice'];
			if ( isset( $appData['app_extend']['apple-arcade'] ) ):
				$appData['app_price'] = esc_html__('Exclusive to Apple Arcade', 'wp-appbox');
				$appData['app_price'] = str_replace( 'Apple Arcade', '<small>&#63743;</small>Arcade', $appData['app_price'] );
			endif;
		endif;
		
		/**
		* Diverse Template-Variablen ersetzen
		*/
		$template = str_replace( '{WPAPPBOXVERSION}', WPAPPBOX_PLUGIN_VERSION, $template );
		if ( isset( $appData['app_extend']['ispreorder'] ) ) {
			$template = str_replace( '{DOWNLOADCAPTION}', esc_html__('Preorder', 'wp-appbox'), $template );
		} else if ( isset( $appData['app_extend']['ispreregister'] ) ) {
			$template = str_replace( '{DOWNLOADCAPTION}', esc_html__('Register', 'wp-appbox'), $template );
			$template = str_replace( '{PRICE}', esc_html__('To be announced', 'wp-appbox'), $template );
		} else {
			$template = str_replace( '{DOWNLOADCAPTION}', ( get_option('wpAppbox_downloadCaption') != '' ? get_option('wpAppbox_downloadCaption') : $wpAppbox_optionsDefault['downloadCaption'] ), $template );
		}
		$template = str_replace( '{APPID}', $appData['app_id'], $template );
		$template = str_replace( '{APPIDHASH}', $appData['id'], $template );
		$template = str_replace( '{ICON}', $this->returnAppIcon( $appData['id'], $appData['app_icon'], $appData['store_name_css'], ( $attr['store'] == 'microsoftstore' && isset( $appData['app_extend']['windowsstorebg'] )? $appData['app_extend']['windowsstorebg'] : '' ) ), $template );
		$template = str_replace( '{TITLE}', $appData['app_title'], $template );
		$template = str_replace( '{STORE}', $appData['store_name'], $template );
		$template = str_replace( '{RATING}', $this->returnRating( $appData['app_rating'] ), $template );
		$template = str_replace( '{APPLINK}', $this->returnAppLink( $appData['app_url'], $appData['app_id'] ), $template );
		$template = str_replace( '{DEVELOPERLINK}', $this->returnDeveloper( $appData['app_author'], $appData['app_author_url'], $appData['app_id'] ), $template );
		$template = str_replace( '{PRICE}', $this->returnPrice( $appData['app_price'], $appData['app_has_iap'], ( isset( $attr['oldprice'] ) ? $attr['oldprice'] : '' ) ), $template );
		$template = str_replace( '{QRCODE}', $this->returnQRCode( $appData['app_url'], $appData['app_id'], $appData['id'] ), $template );
		$template = str_replace( '{TITLE_ATTR}', esc_attr( $appData['app_title'] ), $template );
		if ( get_option('wpAppbox_nofollow') ) {
			$template = str_replace( '<a ', '<a rel="nofollow" ', $template );
		}
		if ( get_option('wpAppbox_targetBlank') ) {
			$template = str_replace( '<a ', '<a target="_blank" ', $template ); 
		}
		$template = str_replace( '{RELOADLINK}', $this->returnReloadLink( $appData['id'] ), $template );
				
		/**
		* Die CSS-Klassen für die Ausgabe erstellen
		*/
		$cssClasses = 'wpappbox wpappbox-' . $appData['id'] . ' ' . $appData['store_name_css'];
		if ( true == get_option('wpAppbox_colorfulIcons') ) 
			$cssClasses .= ' colorful';
		if ( isset( $appData['app_extend']['ispreorder'] ) ) 
			$cssClasses .= ' preorder';
		if ( ( true == $appData['deprecated'] ) && ( !get_option('wpAppbox_dontGreyOut') ) ) 
			$cssClasses .= ' deprecated';
		if ( isset( $appData['app_extend']['apple-arcade'] ) ) 
			$cssClasses .= ' apple-arcade';
		$template = str_replace( '{WPAPPBOXCSSCLASSES}', $cssClasses, $template );
			
		/**
		* HTML-Ausgabe mit WP-Appbox-Kommentar versehen
		*/	
		$template = '<!-- WP-Appbox (Version: ' . WPAPPBOX_PLUGIN_VERSION . ' // Store: ' . $appData['store_name_css'] . ' // ID: ' . $appData['app_id'] . ') -->' . $template . '<!-- /WP-Appbox -->';
				
		/**
		* Template zurück- und ausgeben
		*/
		return( $template );
	}
	
} /* Class beenden */

?>