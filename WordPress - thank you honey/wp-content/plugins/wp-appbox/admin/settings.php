<?php

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! is_admin() ) die;

/* Variablen für das Backend definieren */
define( 'WPAPPBOX_URL_PAYPAL', 'https://www.paypal.me/marcelismus' ); 
define( 'WPAPPBOX_URL_AMAZON', 'http://www.amazon.de/gp/registry/wishlist/1FC2DA2J8SZW7?tag=' . WPAPPBOX_AFFILIATE_AMAZON );


/**
* Registrierung der Einstellungen des Plugins
*
* @since   1.0.0
* @change  3.2.0
*/

function wpAppbox_pageInit() {
	$settings_page = add_options_page( WPAPPBOX_PLUGIN_NAME . ' ' . __('settings', 'wp-appbox') , WPAPPBOX_PLUGIN_NAME, 'manage_options', 'wp-appbox', 'wpAppbox_options_page' );
	add_action( "load-{$settings_page}", 'wpAppbox_loadSettingsPage' );
}


/**
* Initalisierung der Adminseite [deprecated]
*
* @since   1.0.0
* @change  3.2.0
*/

function wpAppbox_adminInit() {
}


/**
* Benachrichtigung im Admin-Panel anzeigen
*
* @since   4.0.0
* @change  4.4.0
*/

function wpAppbox_showAdminNotification() {
	if ( ( 'not' == 'show' ) && ( WPAPPBOX_PLUGIN_VERSION != get_option( 'wpAppbox_notifyLastV' ) ) ):
		?>
		<div class="notice notice-success is-dismissible">
			<p>
				🎉🎊 <strong><?php printf( esc_html__( 'WP-Appbox %1$s is here!', 'wp-appbox' ), esc_html( WPAPPBOX_PLUGIN_VERSION ) ); ?> </strong>
				<?php printf( wp_kses( __( '<a href="%s" target="_blank">See here</a> what is new.', 'wp-appbox' ), array(  'a' => array( 'href' => array(), 'target' => array( '_blank') ) ) ), esc_url( ( get_locale() == 'de_DE' ) ? 'http://wordpress.org/plugins/wp-appbox/changelog/' : 'http://wordpress.org/plugins/wp-appbox/changelog/' ) ); ?>
				<?php printf( wp_kses( __( 'If you like this plugin and find it useful, please <a href="%s" target="_blank">consider to rate</a> this plugin.', 'wp-appbox' ), array(  'a' => array( 'href' => array(), 'target' => array( '_blank') ) ) ), esc_url( 'https://wordpress.org/support/plugin/wp-appbox/reviews/' ) ); ?> :-)
			</p>
		</div>
		<?php
		update_option( 'wpAppbox_notifyLastV', sanitize_text_field( WPAPPBOX_PLUGIN_VERSION ), 'no' );
	endif;
}
add_action( 'admin_notices', 'wpAppbox_showAdminNotification' );


/**
* Anzeige der Apps im Cache im Dashboard-Glance-Widget
*
* @since   3.4.0
* @change  4.4.0
*/

function wpAppbox_counterInDashboard( $items = array() ) {
	if ( ! current_user_can('manage_options') ) {
		return( $items );
	}
	$countCachedApps = wpAppbox_countCachedApps();
	if ( $countCachedApps > 0 ) {
		echo( '<style>#dashboard_right_now .wp-appbox a:before { content: "\f108" !important; }</style>' );
		echo( '<li class="page-count wp-appbox"><a href="options-general.php?page=wp-appbox&amp;tab=cache-list">' . esc_html( $countCachedApps ) . ' ' . _n( 'app in cache', 'apps in cache', $countCachedApps, 'wp-appbox' ) . '</a></li>' );
	}	
	//return( $items );
}
add_filter( 'dashboard_glance_items', 'wpAppbox_counterInDashboard', 10, 1 );


/**
* Tab-Navigation erzeugen und anzeigen
*
* @since   3.0.2
* @change  4.4.0
*
* @param   string  $currentTab  Aktuell ausgewählter Tab [optional]
*
* @output  HTML-Ausgabe der Tableiste Tableiste
*/

function wpAppbox_createTabs( $currentTab = 'info' ) {
	if ( isset($_GET['tab'] ) ) {
		$currentTab = sanitize_key( $_GET['tab'] );
	}
    $tabs = array(	
   		'info' => array( 'name' => __( 'Info', 'wp-appbox' ), 'dashicon' => 'heart' ),
   		//'compilations' => array( 'name' => __('Compilations', 'wp-appbox'), 'dashicon' => 'excerpt-view' ), 
   		'output' => array( 'name' => __( 'Output', 'wp-appbox' ), 'dashicon' => 'analytics' ), 
   		'cache' => array( 'name' => __( 'Cache', 'wp-appbox' ), 'dashicon' => 'dashboard' ),  
   		'buttons' => array( 'name' => __( 'Editor-Buttons', 'wp-appbox' ), 'dashicon' => 'editor-kitchensink' ), 
   		'storeurls' => array( 'name' => __( 'Store-URLs', 'wp-appbox' ), 'dashicon' => 'admin-links' ), 
   		'affiliate' => array( 'name' => __( 'Affiliate IDs', 'wp-appbox' ), 'dashicon' => 'money-alt' ),  
   		'advanced' => array( 'name' => __( 'Advanced', 'wp-appbox' ), 'dashicon' => 'admin-tools' ),  
   		'help' => array( 'name' => __( 'Help', 'wp-appbox' ), 'dashicon' => 'editor-help' )
    	);
    echo( '<h2 class="nav-tab-wrapper">' );
    foreach ( $tabs as $tab => $properties ) {
    	if ( 'cache-list' == $currentTab ) $currentTab = 'cache';
        $class = ( $tab == $currentTab ) ? ' nav-tab-active' : '';
        $dashicon = $properties['dashicon'];
        $name = $properties['name'];
        echo( "<a class='nav-tab$class dashicons-before dashicons-$dashicon' href='?page=wp-appbox&tab=$tab'> $name</a>" );
    }
    echo( "<a class='nav-tab paypal dashicons-before dashicons-superhero-alt' target='blank' href='" . esc_attr( WPAPPBOX_URL_PAYPAL ) . "' ); ?>" . __('PayPal-Donation', 'wp-appbox') . "</a>" );
    echo( "<a class='nav-tab amazon dashicons-before dashicons-amazon' target='blank' href='" . esc_attr( WPAPPBOX_URL_AMAZON ) . "' ); ?>" . __('Amazon Wishlist', 'wp-appbox') . "</a>" );
    echo( '</h2>' );
}


/**
* Optionsseiten laden
*
* @since   1.0.0
* @change  4.1.14
*/

function wpAppbox_loadSettingsPage() {
	if ( isset( $_GET['tab'] ) && 'cachelist' == $_GET['tab'] ) {
		$args = array(
			'label' => __('Apps', 'wp-appbox'),
		  	'default' => 50,
		 	'option' => 'apps_per_page'
		);
		add_screen_option( 'per_page', $args) ;
	}
	if ( isset( $_POST["wp-appbox-settings-submit"]) && 'Y' == $_POST["wp-appbox-settings-submit"] ) {
		check_admin_referer( "wp-appbox-setting-page" );
		wpAppbox_saveSettings();
		$url_parameters = isset( $_GET['tab'] ) ? 'updated=true&tab=' . sanitize_text_field( $_GET['tab'] ) : 'updated=true';
		wp_redirect( admin_url( "options-general.php?page=wp-appbox&$url_parameters" ) );
		exit;
	}
}


/**
* Anzahl der Einträge pro Seite in der Cache-Tabelle
*
* @since   2.0.0
* @change  3.2.0
*
* @param   string  $status   Status [WordPress]
* @param   string  $option   Angefragte Optionskey
* @param   string  $value    Angefragter Optionswert
* @return  string  $theURL   Umgewandelter App-Link
*/

function wpAppbox_setScreenOptions( $status, $option, $value ) {
	if ( 'apps_per_page' == $option ) {
  		return( $value );
  	}
}
add_filter( 'set-screen-option', 'wpAppbox_setScreenOptions', 10, 3 );


/**
* Einstellungen in "wp_options" speichern
*
* @since   1.0.0
* @change  4.4.0
*/

function wpAppbox_saveSettings() {
	global $wpAppbox_storeNames, $wpAppbox_optionsDefault;
	$tab = 'info';
	if ( isset( $_GET['tab'] ) ) {
		$tab = sanitize_text_field( $_GET['tab'] );
	}
	switch ( $tab ) {			
		case 'output':
	    	update_option( 'wpAppbox_downloadCaption', ( !empty( sanitize_text_field( $_POST['wpAppbox_downloadCaption'] ) ) ? sanitize_text_field( $_POST['wpAppbox_downloadCaption'] ) : sanitize_text_field( $wpAppbox_optionsDefault['downloadCaption'] ) ), 'no' );
			update_option( 'wpAppbox_nofollow', ( isset( $_POST['wpAppbox_nofollow'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_targetBlank', ( isset( $_POST['wpAppbox_targetBlank'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_screenshotTabs', ( isset( $_POST['wpAppbox_screenshotTabs'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_showRating', intval( $_POST['wpAppbox_showRating'] ), 'no' );
			update_option( 'wpAppbox_colorfulIcons', ( isset( $_POST['wpAppbox_colorfulIcons'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_dontGreyOut', ( isset( $_POST['wpAppbox_dontGreyOut'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_defaultStyle', intval( $_POST['wpAppbox_defaultStyle'] ), 'no' );	 
			update_option( 'wpAppbox_replaceAppIcons', ( isset( $_POST['wpAppbox_replaceAppIcons'] ) ? true : false ), 'no' );	   		
			break;
		case 'cache':
			if ( TRUE == get_option('wpAppbox_blockMissing') && FALSE == $_POST['wpAppbox_blockMissing'] ) wpAppbox_resetBlockedQueries();
			update_option( 'wpAppbox_cacheTime', ( '' != intval( $_POST['wpAppbox_cacheTime'] ) ? intval( $_POST['wpAppbox_cacheTime'] ) : sanitize_text_field( $wpAppbox_optionsDefault['cacheTime'] ) ), 'no' );
			update_option( 'wpAppbox_blockMissing', ( isset( $_POST['wpAppbox_blockMissing'] ) ? true : false ) );
			update_option( 'wpAppbox_blockMissingTime', ( '' != intval( $_POST['wpAppbox_blockMissingTime'] ) ? intval( $_POST['wpAppbox_blockMissingTime'] ) : sanitize_text_field( $wpAppbox_optionsDefault['blockMissingTime'] ) ), 'no' );
			update_option( 'wpAppbox_cacheMode', ( !empty( $_POST['wpAppbox_cacheMode'] ) != '' ? sanitize_text_field( $_POST['wpAppbox_cacheMode'] ) : sanitize_text_field( $wpAppbox_optionsDefault['cacheMode'] ) ), 'no' );
			update_option( 'wpAppbox_cronIntervall', ( '' != intval( $_POST['wpAppbox_cronIntervall'] ) ? intval( $_POST['wpAppbox_cronIntervall'] ) : sanitize_text_field( $wpAppbox_optionsDefault['cronIntervall'] ) ), 'no' );
			update_option( 'wpAppbox_cronCount', ( '' != intval( $_POST['wpAppbox_cronCount'] ) ? intval( $_POST['wpAppbox_cronCount'] ) : sanitize_text_field( $wpAppbox_optionsDefault['cronCount'] ) ), 'no' );
			update_option( 'wpAppbox_cachePlugin', ( !empty( $_POST['wpAppbox_cachePlugin'] ) != '' ? sanitize_text_field( $_POST['wpAppbox_cachePlugin'] ) : 0 ), 'no' );
			$imageCacheWAS = get_option( 'wpAppbox_imgCache' );
			if ( isset( $_POST['wpAppbox_imgCache'] ) && $_POST['wpAppbox_imgCache'] ) {
				if ( wpAppbox_imageCache::checkImageCache() ) 
					update_option( 'wpAppbox_imgCache', ( isset( $_POST['wpAppbox_imgCache'] ) ? true : false ), 'no' );
				else 
					set_transient( 'wpAppbox_imgCacheBlocked', true, 12 * HOUR_IN_SECONDS );
			} else {
				update_option( 'wpAppbox_imgCache', false, 'no' );
			}
			if ( $imageCacheWAS && !get_option( 'wpAppbox_imgCache' ) )
				$delete = wpAppbox_imageCache::deleteImageCache( true );
			if ( isset( $_POST['wpAppbox_imgCacheMode'] ) && is_array( $_POST['wpAppbox_imgCacheMode'] ) ) {
				update_option( 'wpAppbox_imgCacheMode',  array_map( 'sanitize_text_field', $_POST['wpAppbox_imgCacheMode'] ), 'no');
			}
			else {
				delete_option( 'wpAppbox_imgCacheMode' );
				update_option( 'wpAppbox_imgCache', false, 'no' );
			}
			update_option( 'wpAppbox_imgCacheDelay', ( isset( $_POST['wpAppbox_imgCacheDelay'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_imgCacheDelayTime', ( '' != intval( $_POST['wpAppbox_imgCacheDelayTime'] ) ? intval( $_POST['wpAppbox_imgCacheDelayTime'] ) : sanitize_text_field( $wpAppbox_optionsDefault['imgCacheDelayTime'] ) ), 'no' );
			wpAppbox_setupCronCache();
	   		break;
    	case 'advanced':
	    	update_option( 'wpAppbox_autoLinks', ( isset( $_POST['wpAppbox_autoLinks'] ) ? true : false ), 'no' );
	    	update_option( 'wpAppbox_anonymizeLinks', ( isset( $_POST['wpAppbox_anonymizeLinks'] ) ? true : false ), 'no' );
	    	if ( function_exists( 'register_block_type' ) ) { 
	    		update_option( 'wpAppbox_renderGutenberg', ( isset( $_POST['wpAppbox_renderGutenberg'] ) ? true : false ), 'no' );
	    	} else {
	    		delete_option( 'wpAppbox_renderGutenberg' );
	    	}
	    	update_option( 'wpAppbox_disableDefer', ( isset( $_POST['wpAppbox_disableDefer'] ) ? true : false ), 'no' );
	    	update_option( 'wpAppbox_includeCSS', ( !empty( $_POST['wpAppbox_includeCSS'] ) ? sanitize_text_field( trim( $_POST['wpAppbox_includeCSS'] ) ) : '0' ), 'no' );
	    	update_option( 'wpAppbox_disableFonts', ( isset( $_POST['wpAppbox_disableFonts'] ) ? true : false ), 'no' );
	    	update_option( 'wpAppbox_curlTimeout', ( '' != intval( $_POST['wpAppbox_curlTimeout'] ) ? intval( $_POST['wpAppbox_curlTimeout'] ) : sanitize_text_field( $wpAppbox_optionsDefault['curlTimeout'] ) ) );
    		update_option( 'wpAppbox_eOnlyAuthors', ( isset( $_POST['wpAppbox_eOnlyAuthors'] ) ? true : false ), 'no' );
    		update_option( 'wpAppbox_eOutput', ( !empty( $_POST['wpAppbox_eOutput'] ) ? sanitize_text_field( trim( $_POST['wpAppbox_eOutput'] ) ) : sanitize_text_field( $wpAppbox_optionsDefault['eOutput'] ) ), 'no' );
    		update_option( 'wpAppbox_forceSSL', ( isset ( $_POST['wpAppbox_forceSSL'] ) ? true : false ), 'no' );
    		update_option( 'wpAppbox_imgProxy', ( isset ( $_POST['wpAppbox_imgProxy'] ) ? true : false ), 'no' );
	   		break;
	   	case 'buttons':
	   		update_option( 'wpAppbox_defaultButton', intval( $_POST['wpAppbox_defaultButton'] ) );
	   		foreach ( $wpAppbox_storeNames as $storeID => $storeName ):
			   	$key_buttonAppbox = "wpAppbox_buttonAppbox_$storeID";
				update_option( $key_buttonAppbox, ( isset( $_POST[$key_buttonAppbox] ) ? true : false ), 'no' );
			   	$key_buttonWYSIWYG = "wpAppbox_buttonWYSIWYG_$storeID";
				update_option( $key_buttonWYSIWYG, ( isset( $_POST[$key_buttonWYSIWYG] ) ? true : false ), 'no' );
			   	$key_buttonHTML = "wpAppbox_buttonHTML_$storeID";
				update_option( $key_buttonHTML, ( isset( $_POST[$key_buttonHTML] ) ? true : false ), 'no' );
			   	$key_buttonHidden = "wpAppbox_buttonHidden_$storeID";
				update_option( $key_buttonHidden, ( isset( $_POST[$key_buttonHidden] ) ? true : false ), 'no' );
	   		endforeach;
	   		if ( isset( $_POST['wpAppbox_advancedToolbar'] ) && '1' == $_POST['wpAppbox_advancedToolbar'] )
	   			update_option( 'wpAppbox_advancedToolbar', true, 'no' );
	   		else
	   			delete_option( 'wpAppbox_advancedToolbar' );
	   		break;
	   	case 'storeurls':
	   		foreach ( $wpAppbox_storeNames as $storeID => $storeName ):
		   		$key_storeURL = "wpAppbox_storeURL_$storeID";
		   		update_option( $key_storeURL, ( isset( $_POST[$key_storeURL] ) ? intval( $_POST[$key_storeURL] ) : '' ) );
		   		if ( isset( $_POST[$key_storeURL] ) && '0' == $_POST[$key_storeURL] ):
		   			$key_storeURL_URL = "wpAppbox_storeURL_URL_$storeID";
		   			update_option( $key_storeURL_URL, ( isset( $_POST[$key_storeURL_URL] ) ? sanitize_text_field( trim( $_POST[$key_storeURL_URL] ) ) : '' ), 'no' );
		   		endif;
	   		endforeach;
	   		break;
		case 'affiliate':
			update_option( 'wpAppbox_userAffiliate', ( isset( $_POST['wpAppbox_userAffiliate'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_affiliateAppleDev', ( isset( $_POST['wpAppbox_affiliateAppleDev'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_affiliateAppleID', ( !empty( $_POST['wpAppbox_affiliateAppleID'] ) ? sanitize_text_field( trim( $_POST['wpAppbox_affiliateAppleID'] ) ) : '' ), 'no' );
			update_option( 'wpAppbox_affiliateAmazonDev', ( isset( $_POST['wpAppbox_affiliateAmazonDev'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_affiliateAmazonID', ( !empty( $_POST['wpAppbox_affiliateAmazonID'] ) ? sanitize_text_field( trim( $_POST['wpAppbox_affiliateAmazonID'] ) ) : '' ), 'no' );
			update_option( 'wpAppbox_affiliateMicrosoftDev', ( isset( $_POST['wpAppbox_affiliateMicrosoftDev'] ) ? true : false ), 'no' );
			update_option( 'wpAppbox_affiliateMicrosoftProgram', ( !empty( $_POST['wpAppbox_affiliateMicrosoftProgram'] ) ? sanitize_text_field( trim( $_POST['wpAppbox_affiliateMicrosoftProgram'] ) ) : '' ), 'no' );
			update_option( 'wpAppbox_affiliateMicrosoftID', ( !empty( $_POST['wpAppbox_affiliateMicrosoftID'] ) ? sanitize_text_field( trim( $_POST['wpAppbox_affiliateMicrosoftID'] ) ) : '' ), 'no' );
		break;
	}
	update_option( 'wpAppbox_pluginVersion', sanitize_text_field( WPAPPBOX_PLUGIN_VERSION ) );
}


/**
* Erzeugung und Ausgabe der Optionsseiten
*
* @since   1.0.0
* @change  4.4.0
*
* @output  HTML-Ausgabe der Optionsseiten
*/

function wpAppbox_options_page() {
	global $wpAppbox_storeNames, $wpAppbox_styleNames, $wpAppbox_storeStyles, $wpAppbox_storeURL_languages, $wpAppbox_storeURL, $wpAppbox_storeURL_noLanguages, $wpAppbox_amaAPIregions;
	if ( isset( $_GET['flushcache'] ) ) {
		$tab = 'cache'; 
	}
	?>
	<div class="wrap">
		<style>
			hr {
				margin-top: 10px !important;
				margin-bottom: 30px !important;
			}
			.wpa-error {
			}
			.wpa-infobox {
				display: block;
				background: #fff;
				border-left: 4px solid #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				margin: 20px 0 25px 0;
				padding: 10px 16px
			}
			.wpa-infobox.wpa-notice {
				border-left: 4px solid #ffba00;
			}
			.wpa-infobox.wpa-error {
				color: #b94a48;
				border-left-color: #dc3232
			}
			.wpa-infobox + h3 {
				padding-top: 8px;
			} 
			.wpa-infobox + .form-table {
				margin-top: -10px !important;
			} 
			.dashicons, .dashicons-before:before {
				line-height: 1.1 !important;
			}
			.nav-tab.paypal {
				background: #52aed8;
				border: 1px solid #169BD7;
				border-bottom: 0;
				color: #FFF;
			}
			.nav-tab.paypal:hover {
				background: #169BD7 !important;
				border: 1px solid #169BD7 !important;
				border-bottom: 0 !important;
			}
			.nav-tab.amazon {
				background: #fcba57;
				border: 1px solid #FF9900;
				border-bottom: 0;
				color: #FFF;
			}
			.nav-tab.amazon:hover {
				background: #FF9900 !important;
				border: 1px solid #FF9900 !important;
				border-bottom: 0 !important;
			}
		</style>
		<div id="icon-options-general" class="icon32">
			<br>
		</div>
		<h2><?php esc_html_e( WPAPPBOX_PLUGIN_NAME ); ?> (Version <?php esc_html_e( WPAPPBOX_PLUGIN_VERSION ); ?>)</h2>
		
		<?php if ( isset($_GET['flushcache'] ) ) {
			if( wpAppbox_clearCache() ) echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'The cache was flushed successfully.', 'wp-appbox' ).'</strong></p></div>' );
			else echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'The cache can not be emptied or there are no apps in the cache.', 'wp-appbox' ).'</strong></p></div>' );
		} ?>
		
		<?php if ( isset($_GET['flushimgcache'] ) ) {
			if( wpAppbox_imageCache::deleteImageCache() ) echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'The image cache was flushed successfully.', 'wp-appbox' ).'</strong></p></div>' );
			else echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'The image cache can not be emptied.', 'wp-appbox' ).'</strong></p></div>' );
		} ?>
		
		<?php if ( isset($_GET['cleanupimagefolder'] ) ) {
			if( wpAppbox_imageCache::cleanUpCacheFolder() ) echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'The image folder was successfully cleaned up.', 'wp-appbox' ).'</strong></p></div>' );
			else echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'The image folder can not be cleaned up.', 'wp-appbox' ).'</strong></p></div>' );
		} ?>
		
		<?php if ( isset($_GET['resetdeprecated'] ) ) {
			if( wpAppbox_resetDeprecatedApps() ) echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'Deprecated apps were successfully reset.', 'wp-appbox' ).'</strong></p></div>' );
			else echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'Deprecated apps can not be resetted.', 'wp-appbox' ).'</strong></p></div>' );
		} ?>
		
		<?php if ( isset($_GET['resetblockedqueries'] ) ) {
			if( wpAppbox_resetBlockedQueries() ) echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'Blocked queries were successfully reset.', 'wp-appbox' ).'</strong></p></div>' );
			else echo( '<div id="setting-error-settings_updated" class="updated settings-error is-dismissible"><p><strong>'.__( 'Blocked queries can not be resetted.', 'wp-appbox' ).'</strong></p></div>' );
		} ?>
		
		<?php if ( !wpAppbox_imageCache::checkImageCache() && ( get_option('wpAppbox_imgCache') || get_transient( 'wpAppbox_imgCacheBlocked' ) ) ): ?>
			<div class="notice notice-error is-dismissible">
				<p><span style="font-weight:bold;"><?php _e('Image cache is not active'); ?>: </span><?php esc_html_e( wpAppbox_imageCache::checkImageCache( true ) ); ?></p>
			</div>
			<?php delete_transient( 'wpAppbox_imgCacheBlocked' ); ?>
		<?php endif; ?>
		
		<div class="widget" style="margin:15px 0;"><p style="margin:10px;">
			<a href="https://twitter.com/Marcelismus" target="_blank"><?php esc_html_e('Follow me on Twitter', 'wp-appbox'); ?></a> | <a href="<?php echo( ( get_locale() == 'de_DE' ) ? 'https://tchgdns.de/wp-appbox-app-badge-fuer-google-play-mac-app-store-windows-store-windows-phone-store-co/' : 'https://translate.google.de/translate?hl=de&sl=de&tl=en&u=https%3A%2F%2Ftchgdns.de%2Fwp-appbox-app-badge-fuer-google-play-mac-app-store-windows-store-windows-phone-store-co%2F' ); ?>" target="_blank"><?php esc_html_e('Visit the Plugin plage', 'wp-appbox'); ?></a> | <a href="http://wordpress.org/extend/plugins/wp-appbox/" target="_blank"><?php esc_html_e('Plugin at WordPress Directory', 'wp-appbox'); ?></a> | <a href="http://wordpress.org/plugins/wp-appbox/changelog/" target="_blank"><?php esc_html_e('Changelog', 'wp-appbox'); ?></a>
		</p></div>
		<?php wpAppbox_createTabs(); ?>
		<form method="post" action="<?php admin_url( 'options-general.php?page=wp-appbox' ); ?>">
		<?php wp_nonce_field( "wp-appbox-setting-page" ); ?>
		<?php
			$tab = 'info';
			if ( isset( $_GET['tab'] ) ) {
				$tab = sanitize_key( $_GET['tab'] );
			}
			if ( isset( $tab ) && file_exists( plugin_dir_path( __FILE__ ) . "settings-$tab.php" ) ) {
				include_once( "settings-$tab.php" );
			} else {
				include_once( "settings-info.php" );
			}
		?>
		
		<?php if ( ( 'help' != $tab ) && ( 'info' != $tab ) && ( 'cache-list' != $tab ) ) { ?>
			<p class="submit" style="clear: both;">
			  	<input type="submit" name="Submit" class="button-primary" value="<?php esc_html_e('Save changes', 'wp-appbox'); ?>" />
				<input type="hidden" name="wp-appbox-settings-submit" value="Y" />
				<?php 
					$countCachedApps = wpAppbox_countCachedApps();
					if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'cache' && $countCachedApps > 0 ):
						?>
						<a class="button-secondary" href="options-general.php?page=wp-appbox&amp;tab=cache-list"><?php esc_html_e('Show all apps in cache', 'wp-appbox'); ?></a>
					<?php endif; 
				?>
		   </p>
		<?php } ?>
		
	</form>
	</div>
<?php } ?>