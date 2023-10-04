<?php
/*
Plugin Name: WP-Appbox
Version: 4.4.12
Plugin URI: https://tchgdns.de/wp-appbox-app-badge-fuer-google-play-mac-app-store-windows-store-windows-phone-store-co/
Description: With WP-Appbox you can add beautiful mobile app badges to your WordPress posts and pages simply by adding a shortcode.
Author: Marcel Schmilgeit
Author URI: https://tchgdns.de
Text Domain: wp-appbox
Domain Path: /lang
*/


/*
Copyright (C)  2012-2023 Marcel Schmilgeit

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

/* PHP-Fehlerausgabe deaktivieren */
//error_reporting( E_ALL );
//

defined( 'ABSPATH' ) or exit( 'Nothing to see here' ); // Exit if accessed directly


/**
* Ein paar Variablen
*/
$wpAppboxFirstShortcode = true;


/**
* Includierung benötigter Scripte und Dateien
*
* @since   1.0.0
* @change  4.4.0
*/
include_once( "inc/definitions.php" );
include_once( "inc/appboxdb.php" );
include_once( "inc/imagecache.class.php" );
include_once( "inc/getstoreurls.class.php" );
if ( is_admin() ) {
	include_once( 'admin/tinymce.php' );
	include_once( "admin/settings.php" );
	include_once( "admin/user-profiles.php" );
	if ( isset( $_GET['page'] ) && 'wp-appbox' == $_GET['page'] ) {
		switch ( isset( $_GET['tab'] ) ) {
			case 'storeurls':
			case 'advanced':
				include_once( "inc/getstoreurls.class.php" );
				break;
			case 'cache-list':
				include_once( "inc/getappinfo.class.php" );
				include_once( "inc/createoutput.class.php" );
				break;
		}
	}
}
if ( !is_admin() ) {
	include_once( "inc/getappinfo.class.php" );
	include_once( "inc/createattributs.class.php" );
	include_once( "inc/createoutput.class.php" );
}


/**
* Laden der Sprachpakete
*
* @since   1.0.0
* @change  n/a
*/
function wpAppbox_loadTextdomain() {
	load_plugin_textdomain( 'wp-appbox', false, basename( dirname( __FILE__ ) ) . '/lang' );
}
add_action( 'init', 'wpAppbox_loadTextdomain' );


/**
* Cron Schedules für den Cache-Cronjob festlegen und Cron registrieren
*
* @since   4.0.0
* @change  4.4.0
*
* @param 	ka		$schedules		ka
* @return 	ka		$schedules		ka
*/

function wpAppbox_cronSchedules( $schedules ) {
	global $wpAppbox_optionsDefault;
	$cronIntervall = intval( get_option( 'wpAppbox_cronIntervall' ) );
	if ( !is_int( $cronIntervall ) || 0 == $cronIntervall )
		$cronIntervall = $wpAppbox_optionsDefault['cronIntervall'];
    $schedules["wp_appbox_cache"] = array(
	    'interval' => $cronIntervall * 60,
	    'display' => sprintf( __( 'Every %1$s minutes', 'wp-appbox' ), esc_attr( $cronIntervall ) )
    );
    return( $schedules );
}

function wpAppbox_setupCronCache() {
	if ( wp_get_schedule('wpAppbox_cacheCron' ) )
		wp_clear_scheduled_hook( 'wpAppbox_cacheCron' );
	if ( 'cronjob' == get_option( 'wpAppbox_cacheMode' ) )
		wp_schedule_event( time(), 'wp_appbox_cache', 'wpAppbox_cacheCron' );
}

if ( 'cronjob' == get_option( 'wpAppbox_cacheMode' ) ) {
	add_filter( 'cron_schedules', 'wpAppbox_cronSchedules' );
	add_action( 'wpAppbox_cacheCron', 'wpAppbox_cacheCron' );
}


/**
* Prüfen ob der Nutzer Autor (min. User-Level 2) ist
*
* @since   2.0.0
* @change  4.0.9
*
* @return  boolean  true/false  TRUE when author
*/

function wpAppbox_isUserAuthor() {
	if ( current_user_can( 'editor' ) || current_user_can( 'author' ) || current_user_can( 'administrator' ) ) 
		return( true );
	else
		return( false );
}


/**
* Prüfen ob der Nutzer Admin (min. User-Level 9) ist
*
* @since   2.0.0
* @change  4.0.9
*
* @return  boolean  true/false  TRUE when admin
*/

function wpAppbox_isUserAdmin() {
	if ( current_user_can( 'administrator' ) )
		return( true );
	else
		return( false );
}


/**
* Ausgabe der Fehlermeldungen
*
* @since   2.0.0
* @change  4.0.9
*
* @param   string  $output  Fehlermeldung [optional]
* @print   error message
*/

function wpAppbox_errorOutput( $output = "" ) {
	if ( !wpAppbox_isUserAdmin() ) return;
	switch( get_option( "wpAppbox_eOutput" ) ):
		case 'output':
			print_r( "<pre>$output</pre>" );
			break;
		case 'errorlog':
			error_log( $output );
			break;
		case 'output+errorlog':
			print_r( "<pre>$output</pre>" );
			error_log( $output );
		break;
	endswitch;
}


/**
* Prüfen ob "?wpappbox_reload_cache" angehangen
*
* @since   2.0.0
* @change  4.0.7
*
* @return  boolean  true/false  TRUE when $_GET[]
*/

function wpAppbox_forceNewCache( $cacheID ) {
	if ( !wpAppbox_isUserAuthor() ) return( false );
	if ( ( isset( $_GET["wpappbox_reload_cache"] ) ) || ( isset( $_GET["action"] ) && $_GET["action"] === 'wpappbox_reload_cache' ) ):
		if ( !isset( $_GET["app_cache_id"] ) ):
			return( false );
		elseif ( $_GET["app_cache_id"] === $cacheID ):
			return( true );
		endif;
	endif;
}


/**
* Einlesen des Templates
*
* @since   2.0.0
* @change  4.0.5
*
* @param   string   $styleName      Verwendeter Stil
* @param   boolean  $themeTemplate  Deprecated [optional]
* @return  string   $tpl            Ausgabe des Banners
*/

function wpAppbox_loadTemplate( $styleName, $themeTemplate = false ) {
	ob_start();
	if ( file_exists( get_template_directory() . "/wpappbox-$styleName.php" ) ):
		include( get_template_directory()."/wpappbox-$styleName.php" );
	elseif ( file_exists( get_template_directory() . "/wpappbox/$styleName.php" ) ):
		include( get_template_directory()."/wpappbox/$styleName.php" );
	elseif ( file_exists( plugin_dir_path( __FILE__ ) . "tpl/$styleName.php" ) ):
		include( "tpl/$styleName.php" );
	else:
		return( false );
	endif;
	$tpl = ob_get_contents();
	ob_end_clean();
	return( $tpl );
}


/**
* Löscht den Seiten-Cache eines Cache-Plugins
*
* @since   4.0.0
* @change  4.2.0
*
* @param   string    $postID       ID des Posts
*/

function wpAppbox_clearCachePlugin( $postID = '') {
	global $post;
	if ( !isset( $post ) ) return( false );
	$postID = $post->ID;
	if ( false == get_option( 'wpappbox_cachePlugin' ) || !is_single() || !isset( $postID ) || '' == $postID ) return;
	switch ( get_option( 'wpappbox_cachePlugin' ) ):
		case 'cachify':
			if ( has_action( 'cachify_remove_post_cache' ) ):
				do_action( 'cachify_remove_post_cache', $postID );
			endif;
			break;
		case 'w3-total-cache':
			if ( function_exists( 'w3tc_pgcache_flush_post' ) ):
				w3tc_pgcache_flush_post( $postID );
			endif;
		case 'wp-super-cache':
			if ( function_exists( 'wp_cache_post_change' ) ):
				$GLOBALS["super_cache_enabled"] = 1;
				wp_cache_post_change( $postID );
			endif;
			break;
		case 'wp-rocket':
			if ( function_exists( 'rocket_clean_post' ) ):
				rocket_clean_post( $postID );
			endif;
			break;
		case 'wp-fastest-cache':
			if ( isset( $GLOBALS['wp_fastest_cache'] ) && method_exists( $GLOBALS['wp_fastest_cache'], 'singleDeleteCache' ) ):
				$GLOBALS['wp_fastest_cache']->singleDeleteCache( false, $postID );
			endif;
			break;
		case 'zencache':
			if ( isset( $GLOBALS['zencache'] ) && method_exists( $GLOBALS['zencache'], 'auto_clear_post_cache' ) ):
				$GLOBALS['zencache']->auto_clear_post_cache( $postID );
			endif;
			break;
		case 'cache-enabler':
			if ( has_action( 'ce_clear_post_cache' ) ):
				do_action( 'ce_clear_post_cache', $postID );
			endif;
			break;
	endswitch;
}


/**
* Prüfen ob Versionsnummer älter oder neuer
*
* @since   3.1.6
* @change  4.1.13
*
* @param   string   $this_ver   Zu prüfende Versionsnummer
* @param   string   $com_ver    Versionsnummer in der Datenbank
* @return  boolean  true/false  TRUE when $this_ver neuer
*/

function wpAppbox_checkOlderVersion( $this_ver = '', $comp_ver = '' ) {
	if ( $this_ver == '' ) $this_ver = WPAPPBOX_PLUGIN_VERSION;
	if ( $comp_ver == '' ) $comp_ver = get_option( 'wpAppbox_pluginVersion' );
	if ( $comp_ver == '' ) $comp_ver = $this_ver;
	if ( version_compare( $this_ver, $comp_ver ) == 1 )
		return( true );
}


/**
* Appbox-Banner erstellen und ausgeben
*
* @since   2.0.0
* @change  4.1.2
*
* @param   string  $appboxAttributs  Attribute des Shortcodes
* @param   string  $content          Inhalte des Shortcodes [deprecated]
* @return  string  $output           Ausgabe des Banners
*/

function wpAppbox_createAppbox( $appboxAttributs, $content = null ) {
	if ( is_admin() ) return( false );
	global $wpAppboxFirstShortcode;
	$runtimeStart = microtime( true );
	wpAppbox_errorOutput( "//=================================================" );
	$attr = new wpAppbox_CreateAttributs;
	$attr = $attr->devideAttributs( $appboxAttributs );
	wpAppbox_errorOutput( "APP-ID: ".$attr['appid'] );
	$output = new wpAppbox_CreateOutput;
	$output = $output->theOutput( $attr );
	if ( $wpAppboxFirstShortcode ):
		if ( !get_option('wpAppbox_disableDefer') ):
			wpAppbox_registerStyle();
			wpAppbox_loadFonts();
		endif;
		$wpAppboxFirstShortcode = false;
	endif;
	$runtimeEnd = microtime( true );
	$runetimeResult = $runtimeEnd - $runtimeStart;
	wpAppbox_errorOutput( "function: wpAppbox_createAppbox() ---> Runtime: $runetimeResult seconds\n" );
	wpAppbox_errorOutput( "//=================================================\n\n" );
	return( $output );
}


/**
* Store-URLs automatisch erkennen und umwandeln
*
* @since   3.3.0
* @change  4.4.6
*
* @param   string  $appboxAttributs  Attribute des Shortcodes
*/

function wpAppbox_autoDetectLinks( $content ) {

	//Links zum App Store
	$pattern = array(	'/^(?:<p>)?http.?:\/\/.*?apps.apple.com\/(?:.*?\/)?app\/(?:.*?\/)?id([0-9]{1,45}).*?(?:<\/p>)?$/m',
						'/^(?:<p>)?http.?:\/\/.*?apps.apple.com\/WebObjects\/MZStore\.woa\/wa\/viewSoftware\?id=([0-9]{1,45}).*?(?:<\/p>)?$/m',
						'/^(?:<p>)?http.?:\/\/.*?itunes.apple.com\/(?:.*?\/)?app\/(?:.*?\/)?id([0-9]{1,45}).*?(?:<\/p>)?$/m',
						'/^(?:<p>)?http.?:\/\/.*?itunes.apple.com\/WebObjects\/MZStore\.woa\/wa\/viewSoftware\?id=([0-9]{1,45}).*?(?:<\/p>)?$/m'
					);
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox appstore ' . $appID . ']' );
	}, $content );
	
	
	//Links zum Play Store
	$pattern = '/^(?:<p>)?http.?:\/\/play\.google\.com\/store\/apps\/details(?:\/)?\?id=(.*?)(?:\&.*?)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox googleplay ' . $appID . ']' );
	}, $content );
	
	//Links zum Microsoft Store
	$pattern = array(	'/^(?:<p>)?http.?:\/\/(?:www\.)?microsoft\.com\/.*?\/(?:apps|p)\/.*?\/(.*?)(?:\?.*?)?(?:<\/p>)?$/m',
						'/^(?:<p>)?http.?:\/\/apps\.microsoft\.com\/store\/detail\/.*?\/(.*?)(?:\?.*?)?(?:<\/p>)?$/m'
					);
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox microsoftstore ' . $appID . ']' );
	}, $content );
	
	//Links zu Edge-Add-Ons
	$pattern = '/^(?:<p>)?http.?:\/\/microsoftedge\.microsoft\.com\/addons\/detail\/.*?\/(.*?)(?:\?.*?)?(?:\&.*?)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox edgeaddons ' . $appID . ']' );
	}, $content );
	
	//Links zur Huawei App Gallery
	$pattern = '/^(?:<p>)?http.?:\/\/appgallery\.huawei\.com\/app\/(.*?)(?:\/.*?)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox appgallery ' . $appID . ']' );
	}, $content );
	
	//Links zu Amazon-Apps
	$pattern = array(	'/^(?:<p>)?http.?:\/\/www\.amazon\.*(?:.*?)\/gp\/product\/([A-Za-z0-9]*)(?:.*)(?:<\/p>)?$/m',
						'/^(?:<p>)?http.?:\/\/www\.amazon\.*(?:.*?)\/dp\/([A-Za-z0-9]*)(?:.*)(?:<\/p>)?$/m',
						'/^(?:<p>)?http.?:\/\/www\.amazon\.*(?:.*?)\/exec\/obidos\/ASIN\/([A-Za-z0-9]*)(?:.*)(?:<\/p>)?$/m'
					);
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox amazonapps ' . $appID . ']' );
	}, $content );
	
	//Links zu F-Droid
	$pattern = '/^(?:<p>)?http.?:\/\/f\-droid\.org\/(?:.*\/)packages\/(.*?)\/?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox fdroid ' . $appID . ']' );
	}, $content );
	
	//Links zu Firefox-Addons
	$pattern = '/^(?:<p>)?http.?:\/\/addons\.mozilla\.org\/.*?\/firefox\/addon\/(.*?)(?:\/)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox firefoxaddon ' . $appID . ']' );
	}, $content );
	
	//Links zum Chrome Web Store
	$pattern = '/^(?:<p>)?http.?:\/\/chrome\.google\.com\/webstore\/detail\/.*?\/(.*?)(?:\?.*?)?(?:\&.*?)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox chromewebstore ' . $appID . ']' );
	}, $content );
	
	//Links zu WordPress Plugins
	$pattern = '/^(?:<p>)?http.?:\/\/(?:www\.)?wordpress\.org\/plugins\/([A-Za-z0-9-]*)(?:.*)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox wordpress ' . $appID . ']' );
	}, $content );
	
	//Links zu Games von GOG.com
	$pattern = '/^(?:<p>)?http.?:\/\/(?:www\.)?gog\.com\/game\/([A-Za-z0-9-_]*)(?:.*)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox gog ' . $appID . ']' );
	}, $content );
	
	//Links zu Snapcraft
	$pattern = '/^(?:<p>)?http.?:\/\/snapcraft\.io\/([A-Za-z0-9-_]*)(?:.*)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox snapcraft ' . $appID . ']' );
	}, $content );
	
	//Links zu Games von Steam
	$pattern = '/^(?:<p>)?http.?:\/\/store\.steampowered\.com\/app\/([A-Za-z0-9-_]*)(?:.*)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox steam ' . $appID . ']' );
	}, $content );
	
	//Links zu Opera Addons
	$pattern = '/^(?:<p>)?http.?:\/\/addons\.opera\.com\/(?:.*\/)?extensions\/details\/([A-Za-z0-9-_]*)(?:.*)?(?:<\/p>)?$/m';
	$content = preg_replace_callback( $pattern, function ( $matches ) {
		$appID = Trim( $matches[1] );
		return( '[appbox operaaddons ' . $appID . ']' );
	}, $content );
	
	//Post-Content zurückgegen
	return( $content );
}
if ( get_option('wpAppbox_autoLinks') ) add_filter( 'the_content', 'wpAppbox_autoDetectLinks', 0 );


/**
* Benötigte Update-Funktionen durchführen
*
* @since   3.1.6
* @change  4.4.0
*/

wpAppbox_UpdateAction();
            
function wpAppbox_UpdateAction() {
	if ( get_option('wpAppbox_pluginVersion') == WPAPPBOX_PLUGIN_VERSION ) return;
	if ( wpAppbox_checkOlderVersion( '4.4.10' ) ) {
		update_option( 'wpAppbox_affiliateMicrosoftDev', true, 'no' );
	}
	if ( wpAppbox_checkOlderVersion( '4.4.0' ) ) {
		wpAppbox_setOptions();
	}
	if ( wpAppbox_checkOlderVersion( '4.3.6' ) ) {
		global $wpdb; 
		$sql = "DELETE FROM $wpdb->options WHERE option_name LIKE ('%wpAppbox_%xda%')";
		$wpdb->query( $sql );
		$sql = "DELETE FROM wp_appbox WHERE store_name_css LIKE ('%xda%')";
		$wpdb->query( $sql );
	}
	if ( wpAppbox_checkOlderVersion( '4.2.0' ) ) {
		global $wpdb; 
		wpAppbox_setOptions();
		wpAppbox_changeStoreName( 'windowsstore', 'microsoftstore', 'Microsoft Store' );
		wpAppbox_changeStoreName( 'goodoldgames', 'gog', 'GOG.com' );
	}
	if ( wpAppbox_checkOlderVersion( '4.1.26' ) ) {
		wpAppbox_setOptions();
		delete_option( 'wpAppbox_amaAPIuse' );
		delete_option( 'wpAppbox_amaAPIsecretKey' );
		delete_option( 'wpAppbox_amaAPIpublicKey' );
		delete_option( 'wpAppbox_affiliateAmazonID' );
		delete_option( 'wpAppbox_amaAPIregion' );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.63' ) ) {
		global $wpdb; 
		$sql = "DELETE FROM $wpdb->options WHERE option_name LIKE ('%wpAppbox_%affiliateApple%')";
		$wpdb->query( $sql );
		$sql = "DELETE FROM $wpdb->options WHERE option_name LIKE ('%wpAppbox_%firefoxmarketplace%')";
		$wpdb->query( $sql );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.54' ) ) {
		global $wpdb; 
		$sql = "DELETE FROM $wpdb->options WHERE option_name LIKE ('%wpAppbox_%firefoxmarketplace%')";
		$wpdb->query( $sql );
		$sql = "DELETE FROM wp_appbox WHERE store_name_css LIKE ('%firefoxmarketplace%')";
		$wpdb->query( $sql );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.47' ) ) {
		switch ( get_option('wpAppbox_imgCacheMode') ):
			case 'appicon':
				update_option( 'wpAppbox_imgCacheMode',  array( 'appicon' ), 'no' );
				break;
			case 'screenshots':
				update_option( 'wpAppbox_imgCacheMode',  array( 'screenshots' ), 'no' );
				break;
			case 'appicon+screenshots':
				update_option( 'wpAppbox_imgCacheMode',  array( 'appicon', 'screenshots' ), 'no' );
				break;
		endswitch;
	}
	if ( wpAppbox_checkOlderVersion( '4.0.45' ) ) {
		delete_option( 'wpAppbox_cacheCronjob' );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.42' ) ) {
		if ( get_option( 'wpAppbox_disableCSS' ) )
			update_option( 'wpAppbox_includeCSS', 1, 'no' );
		else
			update_option( 'wpAppbox_includeCSS', 0, 'no' );
		delete_option( 'wpAppbox_disableCSS' );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.36' ) ) {
		if ( !get_option( 'wpAppbox_storeURL_steam' ) )
			update_option( 'wpAppbox_storeURL_steam', '1', 'no' );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.30' ) ) {
		global $wpdb; 
		$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE ('%wpAppbox_blockQuery_%')" );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.18' ) ) {
		if ( !get_option('wpAppbox_affiliateApple') ) 
			update_option( 'wpAppbox_affiliateAppleDev', true, 'no' );
		if ( !get_option('wpAppbox_affiliateAmazon') ) 
			update_option( 'wpAppbox_affiliateAmazonDev', true, 'no' );
		if ( !get_option('wpAppbox_affiliateMicrosoft') ) 
			update_option( 'wpAppbox_affiliateMicrosoftDev', true, 'no' );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.15' ) )
		wpAppbox_setOptions();
	if ( wpAppbox_checkOlderVersion( '4.0.10' ) )
		delete_option( 'wpAppbox_iTunesGeo' );
	if ( wpAppbox_checkOlderVersion( '4.0.9' ) )
		wpAppbox_autoLanguageStoreURLs();
	if ( wpAppbox_checkOlderVersion( '4.0.7' ) ) {
		if ( get_option('wpAppbox_sslAppleImages') )
			update_option( 'wpAppbox_forceSSL', true, 'no' );
		else
			update_option( 'wpAppbox_forceSSL', false, 'no' );
		delete_option( 'wpAppbox_sslAppleImages' );
		delete_option( 'wpAppbox_eImageApple' );
	}
	if ( wpAppbox_checkOlderVersion( '4.0.0' ) ) {
		global $wpdb; 
		$whereQuery =  "option_name = 'wpAppbox_pluginVersion'";
		$whereQuery .= " OR option_name = 'wpAppbox_cacheTime'";
		$whereQuery .= " OR option_name = 'wpAppbox_disableDefer'";
		$whereQuery .= " OR option_name = 'wpAppbox_dbVersion'";
		$whereQuery .= " OR option_name = 'wpAppbox_pluginVersion'";
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->options SET autoload = 'yes' WHERE $whereQuery" ) );
		delete_option( 'wpAppbox_disableAutoCache' );
		delete_option( 'wpAppbox_disableCache' );
		delete_option( 'wpAppbox_showReload' );
		delete_option( 'wpAppbox_imageCache' );
		delete_option( 'wpAppbox_imageCacheMode' );
		if ( true == get_option('wpAppbox_eOutput') )
			update_option( 'wpAppbox_eOutput', 'output', 'no' );
		wpAppbox_setOptions();
		wpAppbox_createTable();
	}
	/* Grundsätzlich nach Update zu prüfen */ 
	if ( get_option('wpAppbox_dbVersion') != WPAPPBOX_DB_VERSION )
		wpAppbox_createTable();
	/* Neue Versionsnummer in die Datenbank schreiben */ 
	update_option( "wpAppbox_pluginVersion", WPAPPBOX_PLUGIN_VERSION );
}


/**
* Neue Optionen in wp_options ($wpdb->options) einfügen
*
* @since   3.1.6
* @change  4.0.9
*/

function wpAppbox_setOptions() {
	global $wpAppbox_optionsDefault, $wpAppbox_storeNames;
	foreach ( $wpAppbox_optionsDefault as $key => $value ):
		$key = 'wpAppbox_'.$key;
		if ( false === get_option( $key ) ) update_option( $key, $value, 'no' );
	endforeach;
	foreach ( $wpAppbox_storeNames as $storeID => $storeName ):
		$key_buttonAppbox = "wpAppbox_buttonAppbox_$storeID";
		$key_buttonWYSIWYG = "wpAppbox_buttonWYSIWYG_$storeID";
		$key_buttonHTML = "wpAppbox_buttonHTML_$storeID";
		$key_buttonHidden = "wpAppbox_buttonHidden_$storeID";
		$key_storeURL = "wpAppbox_storeURL_$storeID";
		$key_storeURL_URL = "wpAppbox_storeURL_URL_$storeID";
		if ( false === get_option( $key_buttonWYSIWYG ) ) update_option( $key_buttonWYSIWYG, true, 'no' );
		if ( false === get_option( $key_buttonHTML ) ) update_option( $key_buttonHTML, true, 'no' );
		if ( false === get_option( $key_storeURL ) ) update_option( $key_storeURL, intval( "1" ), 'no' );
		if ( false === get_option( $key_storeURL_URL ) ) update_option( $key_storeURL_URL, "", 'no' );
	endforeach;
	update_option( "wpAppbox_pluginVersion", WPAPPBOX_PLUGIN_VERSION );
}


/**
* Automatische Erkennung der Sprache bei Neuinstallation
*
* @since  4.0.9
*/

function wpAppbox_autoLanguageStoreURLs() {
	if ( false !== get_option( 'wpAppbox_pluginVersion' ) ) return;
	global $wpAppbox_storeNames, $wpAppbox_storeURL_languages, $wpAppbox_storeURL_noLanguages, $wpAppbox_storeURL;
	foreach ( $wpAppbox_storeNames as $storeID => $storeName ):
		if ( in_array( $storeID, $wpAppbox_storeURL_noLanguages ) ) continue;
		if ( false !== get_option( $key_storeURL ) ) continue;
		$key_storeURL = "wpAppbox_storeURL_$storeID";
		$blogLanguage = get_bloginfo( 'language' );
		foreach( $wpAppbox_storeURL_languages as $languageID => $languageNameCode ):
			if ( strtolower( $languageNameCode['code'] ) == strtolower( $blogLanguage ) ) $languageCode = $languageID;
		endforeach;
		if ( !empty( $wpAppbox_storeURL[$storeID][$languageCode] ) ) update_option( $key_storeURL, intval( $languageCode ), 'no' );
	endforeach;
}


/**
* Registrierung des Gutenberg-Blocks
*
* @since   4.1.0
* @change  4.4.12
*/

function wpAppbox_registerGutenbergBlock() {
	if ( !function_exists( 'register_block_type' ) ) { return; }
	wp_register_script(
		'wp-appbox-block',
		plugins_url( 'editor/gutenberg/block.js?ver=' . WPAPPBOX_PLUGIN_VERSION, __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-plugins', 'wp-components', 'wp-edit-post', 'wp-api', 'wp-editor', 'wp-hooks' )
	);
	if ( function_exists( 'wp_set_script_translations' ) )
		wp_set_script_translations( 'wp-appbox-block', 'wp-appbox', plugin_dir_path( __FILE__ ) . 'lang' );
	if ( get_option('wpAppbox_renderGutenberg') ):
		wp_register_style(
			'wp-appbox-block-style',
			plugins_url( 'css/styles.min.css', __FILE__ ),
			array( 'wp-edit-blocks' ),
			WPAPPBOX_PLUGIN_VERSION
		);
	endif;
	register_block_type( 'wp-appbox/appbox', array(
		'attributes' => array(
			'appID' => array( 'type' => 'string' ),
			'storeID' => array( 'type' => 'string' ),
			'style' => array( 'type' => 'string' )
		),
		'editor_script' => 'wp-appbox-block',
		'editor_style' => 'wp-appbox-block-style', 
		'render_callback' => 'wpAppbox_renderGutenberg'
	) );
}
add_action( 'init', 'wpAppbox_registerGutenbergBlock' );


/**
* Gutenberg-Vorschau direkt im Editor rendern (oder auch nicht)
*
* @since   4.1.0
* @change  n/a
*/

function wpAppbox_renderGutenberg( $attributes ) {
	if ( !get_option('wpAppbox_renderGutenberg') && !is_preview() ) {
		$theShortcode = '';
		if ( $attributes[ 'style' ] != '' ) $theShortcode .= ' ' . $attributes[ 'style' ];
		if ( $attributes[ 'storeID' ] != '' ) $theShortcode .= ' ' . $attributes[ 'storeID' ];
		if ( $attributes[ 'appID' ] != '' ) $theShortcode .= ' ' . $attributes[ 'appID' ];
		return( '<div class="wp-block-shortcode wp-block-appbox"><label><img src="' . plugins_url( 'editor/tinymce/appbox.btn.png', __FILE__ ) . '" class="dashicon dashicons-shortcode" aria-hidden="true" width="20" height="20" />WP-Appbox</label><textarea class="editor-plain-text input-control" id="blocks-shortcode-input-1" rows="1" style="overflow: hidden; word-wrap: break-word; resize: none; height: 37px;" disabled>[appbox' . $theShortcode . ']</textarea></div>' );
	}
	else {
		return( wpAppbox_createAppbox( $attributes ) );
	}
}


/**
* "Einstellungen"-Link zur Plugin-Liste hinzufügen
*
* @since   2.0.0
* @change  4.0.9
*
* @param   array   $links  Array der eingetragenen Links [WordPress]
* @param   string  $file   Aufgerufene Datei [WordPress]
* @return  array   $links  Rückgabe der überarbeiteten Links [WordPress]
*/

function wpAppbox_addSettings( $links, $file ) {
	static $this_plugin;
	if ( !$this_plugin ) $this_plugin = plugin_basename( __FILE__ );
	if ( $file == $this_plugin ):
		$settings_link = '<a href="options-general.php?page=wp-appbox">' . esc_html__('Settings', 'wp-appbox') . '</a>';
		$links = array_merge( array( $settings_link ), $links );
	endif;
	return( $links );
}


function wpAppbox_addMenuAdminbar() {
	global $wp_admin_bar;
	$menu_id = 'wp-appbox';
	$wp_admin_bar->add_menu( array( 'id' => $menu_id, 'title' => __( 'WP-Appbox' ), 'href' => '/options-general.php?page=wp-appbox' ) );
	$wp_admin_bar->add_menu( array( 'parent' => $menu_id, 'title' => __( 'Homepage' ), 'id' => 'dwb-home', 'href' => '/options-general.php?page=wp-appbox' ) );
}

//add_action('admin_bar_menu', 'wpAppbox_addMenuAdminbar', 2000);


function wpAppbox_addMenuSidebar() {
	add_menu_page( 'Über', 'WP-Appbox', 'manage_options', 'wp-appbox', 'sd_display_top_level_menu_page', '', 6	);
	add_submenu_page( 'wp-appbox', 'Editor Buttons', 'Editor Buttons', 'manage_options', 'wp-appbox&tab=buttons', 'sd_display_sub_menu_page' );
}

//add_action( 'admin_menu', 'wpAppbox_addMenuSidebar' );






/**
* Weitere Links zur Plugin-Beschreibung in der Liste hinzufügen
*
* @since   2.0.0
* @change  4.4.0
*
* @param   array   $links  Array der eingetragenen Links [WordPress]
* @param   string  $file   Aufgerufene Datei [WordPress]
* @return  array   $links  Rückgabe der überarbeiteten Links [WordPress]
*/

function wpAppbox_addLinks( $links, $file ) {
	static $this_plugin;
	if ( !$this_plugin ) {
		$this_plugin = plugin_basename( __FILE__ );
	}
	if ( $file == $this_plugin ) {
		$links = array();
		$links[] = 'Version '.WPAPPBOX_PLUGIN_VERSION;
		$links[] = '<a target="_blank" href="https://twitter.com/Marcelismus">' . esc_html__('Follow me on Twitter', 'wp-appbox') . '</a>';
		$links[] = '<a target="_blank" href="' . ( ( get_locale() == 'de_DE' ) ? 'https://tchgdns.de/wp-appbox-app-badge-fuer-google-play-mac-app-store-windows-store-windows-phone-store-co/' : 'https://translate.google.de/translate?hl=de&sl=de&tl=en&u=https%3A%2F%2Ftchgdns.de%2Fwp-appbox-app-badge-fuer-google-play-mac-app-store-windows-store-windows-phone-store-co%2F' ) . '">' . esc_html__('Plugin page', 'wp-appbox') . '</a>';
		$links[] = '<a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/wp-appbox">' . esc_html__('Rate the plugin', 'wp-appbox') . '</a>';
		$links[] = '<a target="_blank" href="http://www.amazon.de/gp/registry/wishlist/1FC2DA2J8SZW7">' . esc_html__('My Amazon Wishlist', 'wp-appbox') . '</a>';
		$links[] = '<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SH9AAS276RAS6">' . esc_html__('PayPal-Donation', 'wp-appbox') . '</a>';
	}
	return( $links );
}


/**
* Ausgabe von Fehlermeldungen
*
* @since   2.0.0
* @change  3.2.0
*
* @param   string  $message  Fehlermeldung
*/

function br_trigger_error( $message ) {
    if ( isset( $_GET['action'] ) && $_GET['action'] == 'error_scrape' ) {
        echo( "<strong>" . esc_html( $message ) . "</strong>" );
        exit;
    } else {
    	trigger_error( $message, E_USER_ERROR );
    }
}


/**
* Aktivierung des Plugins
*
* @since   2.0.0
* @change  4.0.15
*/

function wpAppbox_activatePlugin( $network_wide ) {
	if ( version_compare( phpversion(), WPAPPBOX_MIN_PHPVERSION ) == -1 ) br_trigger_error( esc_html__( 'To use this plugin requires at least PHP version ' . WPAPPBOX_MIN_PHPVERSION . ' is required.', 'wp-appbox' ) );
	if ( !function_exists('curl_init') ) br_trigger_error( esc_html__( '"cURL" is disabled on this server, but is required. Please enable this feature (or contact your hoster).', 'wp-appbox' ) ); 
	if ( !function_exists('curl_exec') ) br_trigger_error( esc_html__( '"curl_exec" is disabled on this server, but is required. Please enable this feature (or contact your hoster).', 'wp-appbox' ) ); 
	if ( !function_exists('json_decode') ) br_trigger_error( esc_html__( '"json_decode" is disabled on this server, but is required. Please enable this feature (or contact your hoster).', 'wp-appbox' ) );
	if ( function_exists( 'is_multisite' ) && is_multisite() && $network_wide ) {
		global $wpdb;
		$current_blog = $wpdb->blogid;
		$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
		foreach ( $blogs as $blog ):
			switch_to_blog( $blog );
			wpAppbox_activateActions();
		endforeach;
		switch_to_blog( $current_blog );
	} else wpAppbox_activateActions();
}


/**
* Aktivierung-Actions des Plugins
*
* @since  3.2.7
* @change 4.0.9
*/

function wpAppbox_activateActions() {
	wpAppbox_autoLanguageStoreURLs(); /* Standard-URLs für die Stores festlegen */
	wpAppbox_setOptions(); /* Standard-Einstellungen in wp_options schreiben */
	wpAppbox_createTable(); /* Tabelle für "WP-Appbox" erstellen */
	wpAppbox_setupCronCache();
}


/**
* Deinstallation des Plugins
*
* @since   2.0.0
* @change  4.0.9
*/

function wpAppbox_uninstallPlugin() {
    if ( function_exists( 'is_multisite' ) && is_multisite() ) {
        global $wpdb;
        $current_blog = $wpdb->blogid;
        $blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
        foreach ( $blogs as $blog ):
        	switch_to_blog( $blog );
        	wpAppbox_uninstallActions();
        endforeach;
        switch_to_blog( $current_blog );
    } else wpAppbox_uninstallActions();
}


/**
* Deinstallation-Actions des Plugins
*
* @since  3.2.2
* @change 4.0.0
*/

function wpAppbox_uninstallActions() {
	global $wpdb;
	$wpdb->query( "DELETE FROM " . $wpdb->prefix . "options WHERE option_name LIKE 'wpAppbox_%';" );
	delete_option( "wpAppbox" ); //Für ältere Versionen ==> bis 3.1.6
	wp_clear_scheduled_hook( 'wpAppbox_cacheCron' );
	wpAppbox_deleteTable();
	$delete = wpAppbox_imageCache::deleteImageCache( true );
}


/**
* Deaktivierung des Plugins
*
* @since   4.0.0
*/

function wpAppbox_deactivatePlugin() {
    if ( function_exists( 'is_multisite' ) && is_multisite() ) {
        global $wpdb;
        $current_blog = $wpdb->blogid;
        $blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
        foreach ( $blogs as $blog ) {
        	switch_to_blog( $blog );
        	wpAppbox_deactivateActions();
        }
        switch_to_blog( $current_blog );
    } else wpAppbox_deactivateActions();
}


/**
* Deaktivierungs-Actions des Plugins
*
* @since  4.0.0
*/

function wpAppbox_deactivateActions() {
	wp_clear_scheduled_hook( 'wpAppbox_cacheCron' );
}


/**
* Aktivierung für neue Multisite-Blogs nach Plugin-Aktivierung
*
* @since  3.2.7
*/

function wpAppbox_activateBlogMultisite( $blogID ) {
    global $wpdb;
    if ( is_plugin_active_for_network('wp-appbox/wp-appbox.php') ) {
		switch_to_blog( $blogID );
		my_plugin_activate();
		restore_current_blog();
    }
}
add_action( 'wpmu_new_blog', 'wpAppbox_activateBlogMultisite' );


/**
* Stylesheet des Plugins registrieren
*
* @since   2.0.0
* @change  4.0.42
*/

function wpAppbox_registerStyle() {
	wp_register_style( 'wpappbox', plugins_url( 'css/styles.min.css', __FILE__ ), array(), WPAPPBOX_PLUGIN_VERSION, 'screen' );
	switch ( get_option('wpAppbox_includeCSS') ):
		case 1: //Disable CSS
			break;
		case 2: //Only on posts and pages
			if ( is_singular() ) wp_enqueue_style( 'wpappbox' );
			break;
		default: //Default
			wp_enqueue_style( 'wpappbox' );
			break;
	endswitch;
}


/**
* Google Fonts für das Plugin registrieren
*
* @since   2.0.0
* @change  4.0.42
*/

function wpAppbox_loadFonts() {
	if ( get_option('wpAppbox_disableFonts') == false ) {
		wp_register_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,600' );
		switch ( get_option('wpAppbox_includeCSS') ):
			case 1: //Disable CSS
				break;
			case 2: //Only on posts and pages
				if ( is_singular() ) wp_enqueue_style( 'open-sans' );
				break;
			default: //Default
				wp_enqueue_style( 'open-sans' );
				break;
		endswitch;
	}
}


/* Diverse Filter, Aktionen und Hooks registrieren */
add_filter( 'plugin_action_links', 'wpAppbox_addSettings', 10, 2 );
add_filter( 'plugin_row_meta', 'wpAppbox_addLinks', 10, 2 );
add_action( 'plugins_loaded', 'wpAppbox_UpdateAction' );
add_action( 'admin_menu', 'wpAppbox_pageInit' );
register_activation_hook( __FILE__, 'wpAppbox_activatePlugin' );
register_deactivation_hook( __FILE__, 'wpAppbox_deactivatePlugin' );
register_uninstall_hook( __FILE__, 'wpAppbox_uninstallPlugin' );


/* Stylesheet und Font auf den normalen Weg laden */
if ( get_option('wpAppbox_disableDefer') ) {
	add_action( 'wp_enqueue_scripts', 'wpAppbox_registerStyle' );
	add_action( 'wp_print_styles', 'wpAppbox_loadFonts' );
}


/* DER Shortcode */ 
add_shortcode( 'appbox', 'wpAppbox_createAppbox' );


?>