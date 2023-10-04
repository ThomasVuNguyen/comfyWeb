<?php

/**
* Für das shice Tabellen-Prefix von WordPress
*/

global $wpdb;


/**
* Ein paar Definitionen #YOLO
*/

define( 'WPAPPBOX_MIN_PHPVERSION', '5.3' );
define( 'WPAPPBOX_PLUGIN_NAME', 'WP-Appbox' ); 
define( 'WPAPPBOX_PLUGIN_VERSION', '4.4.12' );
define( 'WPAPPBOX_DB_VERSION', '1.0.4' );
define( 'WPAPPBOX_PREFIX', 'wpAppbox_' );
define( 'WPAPPBOX_AFFILIATE_AMAZON', 'wp-appbox-21' );
define( 'WPAPPBOX_AFFILIATE_MICROSOFT', 'lkHXJgoakFQ' );
define( 'WPAPPBOX_AFFILIATE_MICROSOFT_PROGRAM', '46131' );
define( 'WPAPPBOX_TABLE_NAME', 'appbox' );


/**
* Festlegen der Standard-Einstellungen
*/

global $wpAppbox_optionsDefault;
$wpAppbox_optionsDefault = array(
	'pluginVersion' => WPAPPBOX_PLUGIN_VERSION,
	'defaultStyle' => intval( '1' ),
	'screenshotTabs' => true,
	'colorfulIcons' => false,
	'wpAppbox_dontGreyOut' => false,
	'showRating' => intval( '1' ),
	'downloadCaption' => __('Download', 'wp-appbox'),
	'nofollow' => true,
	'targetBlank' => true,
	'cacheTime' => intval( '720' ),
	'cacheMode' => 'all',
	'cronIntervall' => intval( '30' ),
	'cronCount' => intval( '5' ),
	'blockMissing' => true,
	'blockMissingTime' => intval( '120' ),
	'cachePlugin' => false,
	'imgCache' => false,
	'imgCacheMode' => array( 'appicon' ),
	'imgCacheDelay' => false,
	'imgCacheDelayTime' => intval( '8' ),
	'affiliateAmazonDev' => true,
	'affiliateAmazonID' => '',
	'affiliateMicrosoftDev' => true,
	'affiliateMicrosoftID' => '',
	'affiliateMicrosoftProgram' => '',
	'userAffiliate' => false,
	'defaultButton' => intval( '0' ),
	'autoLinks' => false,
	'utmSource' => false,
	'anonymizeLinks' => false,
	'renderGutenberg' => false,
	'disableDefer' => false,
	'includeCSS' => intval( '0' ),
	'disableFonts' => false,
	'curlTimeout' => intval( '10' ),
	'eOnlyAuthors' => false,
	'eOutput' => false,
	'forceSSL' => false,
	'cacheCronjob' => false,
);


/**
* Ein paar Standard-Einstellungen festlegen
*/

define( 'WPAPPBOX_CACHINGTIME', ( get_option('wpAppbox_cacheTime') != '' ? get_option('wpAppbox_cacheTime') : $wpAppbox_optionsDefault['cacheTime'] ) ); 
define( 'WPAPPBOX_BLOCKMISSINGTIME', ( get_option('wpAppbox_blockMissingTime') != '' ? get_option('wpAppbox_blockMissingTime') : $wpAppbox_optionsDefault['blockMissingTime'] ) ); 
define( 'WPAPPBOX_PLUGIN_BASE_DIR', basename( dirname( __FILE__ ) ) ); // Ornder wp-content/plugins/wp-appbox/
define( 'WPAPPBOX_PLUGIN_BASE_DOMAIN', get_site_url() . '/' . basename( dirname( __FILE__ ) ) ); // http://domain.de/wp-content/...
define( 'WPAPPBOX_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); // Server-Path
define( 'WPAPPBOX_CACHE_PATH', WP_CONTENT_DIR . '/cache/wp-appbox/' );
define( 'WPAPPBOX_CACHE_DIR', content_url() . '/cache/wp-appbox/' );

			
/**
* Zuweisung Store-ID => Store-Bezeichnung
*/

global $wpAppbox_storeNames;	
$wpAppbox_storeNames = array(	
	'amazonapps' => __( 'Amazon Apps', 'wp-appbox' ),
	'appgallery' => __( 'Huawei AppGallery', 'wp-appbox' ),
	'appstore' => __( '(Mac) App Store', 'wp-appbox' ),
	'chromewebstore' => __( 'Chrome Web Store', 'wp-appbox' ),
	'edgeaddons' => __( 'Edge-Add-Ons', 'wp-appbox' ),
	'fdroid' => __( 'F-Droid', 'wp-appbox' ),
	'firefoxaddon' => __( 'Firefox Add-ons', 'wp-appbox' ),
	'gog' => __( 'GOG.com', 'wp-appbox' ),
	'googleplay' => __( 'Google Play Apps', 'wp-appbox' ),
	'operaaddons' => __( 'Opera Add-ons', 'wp-appbox' ),
	'steam' => __( 'Steam', 'wp-appbox' ),
	'snapcraft' => __( 'Snapcraft', 'wp-appbox' ),
	'microsoftstore' => __( 'Microsoft Store', 'wp-appbox' ),
	'wordpress' => __( 'WordPress Plugins', 'wp-appbox' )
);
					
						
/**
* Zuweisung Style-ID => Style-Name...
*/					
		
global $wpAppbox_styleNames;
$wpAppbox_styleNames = array(
	'0' => 'standard',
	'1' => 'simple',
	'2' => 'compact',
	'3' => 'screenshots',
	'4' => 'screenshots-only'
);
			
			
/**
* ...denn nicht alle Stores können alle Styles anzeigen. FU Chrome Web Store -.-
*/			
		
global $wpAppbox_storeStyles;
$wpAppbox_storeStyles = array(	
	'appgallery' => array( 1, 2, 3, 4 ),
	'amazonapps' => array( 1, 2, 3, 4 ),
	'appstore' => array( 1, 2, 3, 4 ),
	'chromewebstore' => array( 1, 2, 3, 4 ),
	'edgeaddons' => array( 1, 2, 3, 4 ),
	'fdroid' => array( 1, 2, 3, 4 ),
	'firefoxaddon' => array( 1, 2, 3, 4 ),
	'gog' => array( 1, 2, 3, 4 ),
	'googleplay' => array( 1, 2, 3, 4 ),
	'microsoftstore' => array( 1, 2, 3, 4 ),
	'operaaddons' => array( 1, 2, 3, 4 ),
	'snapcraft' => array( 1, 2, 3, 4 ),
	'steam' => array( 1, 2, 3, 4 ),
	'wordpress' => array( 1, 2, 3, 4 )
);


/**
* Länder und Regionen für den Microsoft Store definieren
*/	

global $wpAppbox_MicrosoftPrivateAffiliateProgramm;
$wpAppbox_MicrosoftPrivateAffiliateProgramm = array(
	__( 'US', 'wp-appbox' ) => '24542',
	__( 'Canada', 'wp-appbox' ) => '36509',
	__( 'APAC (Malaysia, Korea, Singapore and other countries)', 'wp-appbox' ) => '43674',
	__( 'Australia', 'wp-appbox' ) => '42411',
	__( 'LATAM', 'wp-appbox' ) => '42431',
	__( 'New Zealand', 'wp-appbox' ) => '42435',
	__( 'Belgium', 'wp-appbox' ) => '46129',
	__( 'Switzerland', 'wp-appbox' ) => '46130',
	__( 'Germany', 'wp-appbox' ) => '46131',
	__( 'Denmark', 'wp-appbox' ) => '46132',
	__( 'Spain', 'wp-appbox' ) => '46133',
	__( 'France', 'wp-appbox' ) => '46134',
	__( 'Italy', 'wp-appbox' ) => '46135',
	__( 'Netherlands', 'wp-appbox' ) => '46136',
	__( 'Norway', 'wp-appbox' ) => '46137',
	__( 'Poland', 'wp-appbox' ) => '46139',
	__( 'Sweden', 'wp-appbox' ) => '46138',
	__( 'UK & Ireland (Great Britain, Ireland)', 'wp-appbox' ) => '46128',
	__( 'Austria', 'wp-appbox' ) => '46140'
);
ksort( $wpAppbox_MicrosoftPrivateAffiliateProgramm );


/**
* Länder und Regionen für den Zugriff auf die Amazon API definieren
*/	

global $wpAppbox_AmazonAPIregions;
$wpAppbox_AmazonAPIregions = array(
	__( 'Australia', 'wp-appbox' ) => array( 'webservices.amazon.com.au', 'us-west-2' ),
	__( 'Brazil', 'wp-appbox' ) => array( 'webservices.amazon.com.br', '	us-east-1' ),
	__( 'Canada', 'wp-appbox' ) => array( 'webservices.amazon.ca', 'us-east-1' ),
	__( 'France', 'wp-appbox' ) => array( 'webservices.amazon.fr', 'eu-west-1' ),
	__( 'Germany', 'wp-appbox' ) => array( 'webservices.amazon.de', 'eu-west-1' ),
	__( 'India', 'wp-appbox' ) => array( 'webservices.amazon.in', 'eu-west-1' ),
	__( 'Italy', 'wp-appbox' ) => array( 'webservices.amazon.it', 'eu-west-1' ),
	__( 'Japan', 'wp-appbox' ) => array( 'webservices.amazon.co.jp', 'us-west-2' ),
	__( 'Mexico', 'wp-appbox' ) => array( 'webservices.amazon.com.mx', 'us-east-1' ),
	__( 'Singapore', 'wp-appbox' ) => array( 'webservices.amazon.sg', 'us-west-2' ),
	__( 'Spain', 'wp-appbox' ) => array( 'webservices.amazon.es', 'eu-west-1' ),
	__( 'Turkey', 'wp-appbox' ) => array( 'webservices.amazon.com.tr', 'eu-west-1' ),
	__( 'United Arab Emirates', 'wp-appbox' ) => array( 'webservices.amazon.ae', 'eu-west-1' ),
	__( 'United Kingdom', 'wp-appbox' ) => array( 'webservices.amazon.co.uk', 'eu-west-1' ),
	__( 'United States', 'wp-appbox' ) => array( 'webservices.amazon.com', 'us-east-1' ),
);
ksort( $wpAppbox_AmazonAPIregions );


?>