WP-APPBOX ERRORLOG
		
==============================================================
		
Plugin version: <?php esc_html_e( WPAPPBOX_PLUGIN_VERSION ); ?>&#013;
Installed version: <?php esc_html_e( get_option('wpAppbox_pluginVersion') ); ?>&#013;
Database version: <?php esc_html_e( get_option('wpAppbox_dbVersion') ); ?>&#013;
Apps in cache: <?php esc_html_e( wpAppbox_countCachedApps() ); ?>&#013;

WordPress version: <?php esc_html_e( bloginfo('version') ); ?>&#013;
WordPress URL: <?php esc_html_e( bloginfo('wpurl') ); ?>&#013;
Site URL: <?php esc_html_e( bloginfo('url') ); ?>&#013;
SSL activated: <?php esc_html_e( ( is_ssl() ? 'yes' : 'no') ); ?>&#013;

PHP version: <?php esc_html_e( phpversion() ); ?>&#013;
cURL activated: <?php esc_html_e( ( function_exists('curl_version') ? 'yes' : 'no') ); ?>&#013;
allow_url_fopen activated: <?php esc_html_e( ( ini_get('allow_url_fopen') ? 'yes' : 'no') ); ?>&#013;
Server IP: <?php esc_html_e( $_SERVER['SERVER_ADDR'] ); ?>&#013;
Server Port: <?php esc_html_e( $_SERVER['SERVER_PORT'] ); ?>&#013;

==============================================================

defaultStyle => <?php esc_html_e( get_option( 'wpAppbox_defaultStyle' ) ); ?>&#013;
colorfulIcons => <?php esc_html_e( ( get_option('wpAppbox_colorfulIcons') ? 'true' : 'false') ); ?>&#013;
showRating => <?php esc_html_e( ( get_option('wpAppbox_showRating') ? 'true' : 'false') ); ?>&#013;
nofollow => <?php esc_html_e( ( get_option('wpAppbox_nofollow') ? 'true' : 'false') ); ?>&#013;
targetBlank => <?php esc_html_e( ( get_option('wpAppbox_targetBlank') ? 'true' : 'false') ); ?>&#013;

cacheTime => <?php esc_html_e( get_option( 'wpAppbox_cacheTime' ) ); ?> minutes&#013;
cacheMode => <?php esc_html_e( get_option( 'wpAppbox_cacheMode' ) ); ?>&#013;
blockMissing => <?php esc_html_e( ( get_option('wpAppbox_blockMissing') ? 'true' : 'false') ); ?>&#013;
blockMissingTime => <?php esc_html_e( get_option( 'wpAppbox_blockMissingTime' ) ); ?> minutes&#013;
cachePlugin => <?php esc_html_e( get_option( 'wpAppbox_cachePlugin' ) ); ?>&#013;

imgCache => <?php esc_html_e( ( get_option('wpAppbox_imgCache') ? 'true' : 'false') ); ?>&#013;
imgCache => <?php esc_html_e( wpAppbox_imageCache::checkImageCache( true ) ); ?>&#013;
imgCacheMode => <?php array_map( 'esc_html', get_option('wpAppbox_imgCacheMode') ); ?>&#013;
imgCacheDelay => <?php esc_html_e( ( get_option('wpAppbox_imgCacheDelay') ? 'true' : 'false') ); ?>&#013;
imgCacheDelayTime => <?php esc_html_e( get_option( 'imgCacheDelayTime' ) ); ?> hours&#013;
imgProxy => <?php esc_html_e( ( get_option('wpAppbox_imgProxy') ? 'true' : 'false') ); ?>&#013;

<?php if ( 'cronjob' == get_option( 'wpAppbox_cacheMode' ) ): ?>
cronIntervall => <?php esc_html_e( get_option('wpAppbox_cronIntervall') ); ?> minutes&#013;
cronCount => <?php esc_html_e( get_option('wpAppbox_cronCount') ); ?> apps at once&#013;
<?php endif; ?>

<?php foreach( $wpAppbox_storeNames as $storeID => $storeName ) {
	if ( !in_array( $storeID, $wpAppbox_storeURL_noLanguages ) ) {
		echo( esc_html( $storeName ) . ' => ' );
		echo( get_option( 'wpAppbox_storeURL_' . $storeID ) == '0' ) ? esc_html( get_option('wpAppbox_storeURL_URL_' . $storeID) ) : esc_html( $wpAppbox_storeURL[$storeID][get_option( 'wpAppbox_storeURL_' . $storeID )] );
		echo( '&#013;' );
	}
} ?>&#013;
affiliateAmazonDev => <?php esc_html_e( ( get_option('wpAppbox_affiliateAmazonDev') ? 'true' : 'false') ); ?>&#013;
affiliateMicrosoftDev => <?php esc_html_e( ( get_option('wpAppbox_affiliateMicrosoftDev') ? 'true' : 'false') ); ?>&#013;

autoLinks => <?php esc_html_e( ( get_option('wpAppbox_autoLinks') ? 'true' : 'false') ); ?>&#013;
anonymizeLinks => <?php esc_html_e( ( get_option('wpAppbox_anonymizeLinks') ? 'true' : 'false') ); ?>&#013;
includeCSS => <?php esc_html_e( get_option('wpAppbox_includeCSS') ); ?>&#013;
disableDefer => <?php esc_html_e( ( get_option('wpAppbox_disableDefer') ? 'true' : 'false') ); ?>&#013;
disableFonts => <?php esc_html_e( ( get_option('wpAppbox_disableFonts') ? 'true' : 'false') ); ?>&#013;
curlTimeout => <?php esc_html_e( get_option( 'wpAppbox_curlTimeout' ) ); ?> seconds&#013;
eOnlyAuthors => <?php esc_html_e( ( get_option('wpAppbox_eOnlyAuthors') ? 'true' : 'false') ); ?>&#013;
eOutput => <?php esc_html_e( ( get_option('wpAppbox_eOutput') ? 'true' : get_option('wpAppbox_eOutput') ) ); ?>&#013;
is_ssl() => <?php esc_html_e( ( is_ssl() ? 'true' : 'false') ); ?>&#013;
forceSSL => <?php esc_html_e( ( get_option('wpAppbox_forceSSL') ? 'true' : 'false') ); ?>&#013;

==============================================================

<?php 
if ( !function_exists( 'get_plugins' ) ) require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$activePluginsO = get_option('active_plugins');
$allPlugins = get_plugins();
$activatedPlugins = array();
foreach ( $activePluginsO as $p ){           
    if ( isset( $allPlugins[$p] ) ) array_push( $activatedPlugins, $allPlugins[$p] );           
}
foreach ( $activatedPlugins as $p ){   
	echo( esc_html( $p['Name'] . ' v' . $p['Version'] . ' (' . $p['PluginURI'] . ') ' . '&#013;' ) );                
}
?>

&#013;==============================================================

<?php 
	global $wpdb;
	foreach ( $wpdb->get_col( 'DESC ' . $wpdb->prefix . WPAPPBOX_TABLE_NAME, 0 ) as $column_name ) {
		echo( esc_html( $column_name ) . '&#013;' );
	}
?>