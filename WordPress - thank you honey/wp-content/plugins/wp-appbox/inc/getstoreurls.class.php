<?php 


/* ID => Bezeichnung */
$wpAppbox_storeURL_languages = array(
	'0' => __('Use own URL', 'wp-appbox'),
	'1' => array( 'code' => 'de-DE', 'name' => __( 'Germany', 'wp-appbox' ) ),
	'2' => array( 'code' => 'en-US', 'name' => __( 'United States', 'wp-appbox' ) ),
	'3' => array( 'code' => 'en-GB', 'name' => __( 'United Kingdom', 'wp-appbox' ) ),
	'4' => array( 'code' => 'fr-FR', 'name' => __( 'France', 'wp-appbox' ) ),
	'5' => array( 'code' => 'es-ES', 'name' => __( 'Spain', 'wp-appbox' ) ),
	'6' => array( 'code' => 'ru-RU', 'name' => __( 'Russia', 'wp-appbox' ) ),
	'7' => array( 'code' => 'tr-TR', 'name' => __( 'Turkey', 'wp-appbox' ) ),
	'8' => array( 'code' => 'it-IT', 'name' => __( 'Italy', 'wp-appbox' ) ),
	'9' => array( 'code' => 'de-AT', 'name' => __( 'Austria', 'wp-appbox' ) ),
	'10' => array( 'code' => 'de-CH', 'name' => __( 'Switzerland', 'wp-appbox' ) ),
	'11' => array( 'code' => 'ja-JP', 'name' => __( 'Japan', 'wp-appbox' ) ),
	'12' => array( 'code' => 'pl-PL', 'name' => __( 'Poland', 'wp-appbox' ) ),
	'13' => array( 'code' => 'en-AU', 'name' => __( 'Australia', 'wp-appbox') ),
	'14' => array( 'code' => 'zh-CN', 'name' => __( 'China', 'wp-appbox') ),
	'15' => array( 'code' => 'id-ID', 'name' => __( 'Indonesia', 'wp-appbox') )
);
	
	
/* Stores ohne Möglichkeit des Sprachwechsels */
$wpAppbox_storeURL_noLanguages = array( 'wordpress', 'gog', 'snapcraft' );
	
	
/* Regionen für die Amazon Product Advertising API */
$wpAppbox_amaAPIregions = array(
	__( 'Brazil', 'wp-appbox' ) => 'com.br',
	__( 'Canada', 'wp-appbox' ) => 'ca',
	__( 'China', 'wp-appbox' ) => 'cn',
	__( 'France', 'wp-appbox' ) => 'fr',
	__( 'Germany', 'wp-appbox' ) => 'de',
	__( 'India', 'wp-appbox' ) => 'in',
	__( 'Italy', 'wp-appbox' ) => 'it',
	__( 'Japan', 'wp-appbox' ) => 'co.jp',
	__( 'Mexico', 'wp-appbox' ) => 'com.mx',
	__( 'Spain', 'wp-appbox' ) => 'es',
	__( 'United Kingdom', 'wp-appbox' ) => 'co.uk',
	__( 'United States', 'wp-appbox' ) => 'com'
);
	
	
/* Die URLs der Stores und Länder */
global $wpAppbox_storeURL; 
$wpAppbox_storeURL = array(	
	'amazonapps' => array(
		'1' => 'https://www.amazon.de/gp/product/{APPID}',
		'2' => 'https://www.amazon.com/gp/product/{APPID}',
		'3' => 'https://www.amazon.co.uk/gp/product/{APPID}',
		'4' => 'https://www.amazon.fr/gp/product/{APPID}',
		'5' => 'https://www.amazon.es/gp/product/{APPID}',
		'8' => 'https://www.amazon.it/gp/product/{APPID}',
		'11' => 'https://www.amazon.co.jp/gp/product/{APPID}'
	),
	'appgallery' => array(
		'1' => 'https://appgallery.huawei.com/app/{APPID}?locale=de',
		'2' => 'https://appgallery.huawei.com/app/{APPID}?locale=us',
		'3' => 'https://appgallery.huawei.com/app/{APPID}?locale=uk',
		'4' => 'https://appgallery.huawei.com/app/{APPID}?locale=fr',
		'5' => 'https://appgallery.huawei.com/app/{APPID}?locale=es',
		'6' => 'https://appgallery.huawei.com/app/{APPID}?locale=ru',
		'7' => 'https://appgallery.huawei.com/app/{APPID}?locale=tr',
		'8' => 'https://appgallery.huawei.com/app/{APPID}?locale=it',
		'9' => 'https://appgallery.huawei.com/app/{APPID}?locale=at',
		'10' => 'https://appgallery.huawei.com/app/{APPID}?locale=ch',
		'11' => 'https://appgallery.huawei.com/app/{APPID}?locale=jp',
		'12' => 'https://appgallery.huawei.com/app/{APPID}?locale=pl',
		'13' => 'https://appgallery.huawei.com/app/{APPID}?locale=au',
		'14' => 'https://appgallery.huawei.com/app/{APPID}?locale=cn',
		'15' => 'https://appgallery.huawei.com/app/{APPID}?locale=id'
	),
	'appstore' => array(
		'1' => 'https://apps.apple.com/de/app/id{APPID}',
		'2' => 'https://apps.apple.com/app/id{APPID}',
		'3' => 'https://apps.apple.com/gb/app/id{APPID}',
		'4' => 'https://apps.apple.com/fr/app/id{APPID}',
		'5' => 'https://apps.apple.com/es/app/id{APPID}',
		'6' => 'https://apps.apple.com/ru/app/id{APPID}',
		'7' => 'https://apps.apple.com/tr/app/id{APPID}',
		'8' => 'https://apps.apple.com/it/app/id{APPID}',
		'9' => 'https://apps.apple.com/at/app/id{APPID}',
		'10' => 'https://apps.apple.com/ch/app/id{APPID}',
		'11' => 'https://apps.apple.com/jp/app/id{APPID}',
		'13' => 'https://apps.apple.com/au/app/id{APPID}',
		'14' => 'https://apps.apple.com/cn/app/id{APPID}',
		'15' => 'https://apps.apple.com/id/app/id{APPID}?l=id'
	),
	'chromewebstore' => array(
		'1' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=de',
		'2' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=en',
		'3' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=en',
		'4' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=fr',
		'5' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=es',
		'6' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=ru',
		'7' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=tr',
		'8' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=it',
		'9' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=au',
		'10' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=ch',
		'12' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=pl',
		'14' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=zh',
		'15' => 'https://chrome.google.com/webstore/detail/{APPID}?hl=id'
	),
	'edgeaddons' => array(
		'1' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=de-de',
		'2' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=en-us',
		'3' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=en-gb',
		'4' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=fr-fr',
		'5' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=es-es',
		'6' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=ru-ru',
		'7' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=tr-tr',
		'8' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=it-it',
		'9' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=de-at',
		'10' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=de-ch',
		'12' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=pl-pl',
		'14' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=zh-cn',
		'15' => 'https://microsoftedge.microsoft.com/addons/detail/extension/{APPID}?hl=id-id'
	),
	'fdroid' => array(
		'1' => 'https://f-droid.org/de/packages/{APPID}/',
		'2' => 'https://f-droid.org/en/packages/{APPID}/',
		'3' => 'https://f-droid.org/en/packages/{APPID}/',
		'4' => 'https://f-droid.org/fr/packages/{APPID}/',
		'5' => 'https://f-droid.org/es/packages/{APPID}/',
		'6' => 'https://f-droid.org/ru/packages/{APPID}/',
		'7' => 'https://f-droid.org/tr/packages/{APPID}/',
		'8' => 'https://f-droid.org/it/packages/{APPID}/',
		'9' => 'https://f-droid.org/de/packages/{APPID}/',
		'10' => 'https://f-droid.org/de/packages/{APPID}/',
		'12' => 'https://f-droid.org/pl/packages/{APPID}/',
		'13' => 'https://f-droid.org/en/packages/{APPID}/'	
	),
	'firefoxaddon' => array(
		'1' => 'https://addons.mozilla.org/de/firefox/addon/{APPID}/',
		'2' => 'https://addons.mozilla.org/en-US/firefox/addon/{APPID}/',
		'4' => 'https://addons.mozilla.org/fr/firefox/addon/{APPID}/',
		'5' => 'https://addons.mozilla.org/es/firefox/addon/{APPID}/',
		'6' => 'https://addons.mozilla.org/ru/firefox/addon/{APPID}/',
		'8' => 'https://addons.mozilla.org/it/firefox/addon/{APPID}/',
		'12' => 'https://addons.mozilla.org/pl/firefox/addon/{APPID}/',
		'14' => 'https://addons.mozilla.org/zh-CN/firefox/addon/{APPID}/',
		'15' => 'https://addons.mozilla.org/id/firefox/addon/{APPID}/'
	),
	'gog' => array(
		'1' => 'http://www.gog.com/game/{APPID}'
	),
	'googleplay' => array(
		'1' => 'https://play.google.com/store/apps/details?id={APPID}&hl=de&gl=de',
		'2' => 'https://play.google.com/store/apps/details?id={APPID}&hl=en&gl=us',
		'3' => 'https://play.google.com/store/apps/details?id={APPID}&hl=en&gl=uk',
		'4' => 'https://play.google.com/store/apps/details?id={APPID}&hl=fr&gl=fr',
		'5' => 'https://play.google.com/store/apps/details?id={APPID}&hl=es&gl=es',
		'6' => 'https://play.google.com/store/apps/details?id={APPID}&hl=ru&gl=ru',
		'7' => 'https://play.google.com/store/apps/details?id={APPID}&hl=tr&gl=tr',
		'8' => 'https://play.google.com/store/apps/details?id={APPID}&hl=it&gl=it',
		'9' => 'https://play.google.com/store/apps/details?id={APPID}&hl=de&gl=at',
		'10' => 'https://play.google.com/store/apps/details?id={APPID}&hl=de&gl=ch',
		'13' => 'https://play.google.com/store/apps/details?id={APPID}&hl=en&gl=au',
		'14' => 'https://play.google.com/store/apps/details?id={APPID}&hl=zh&gl=cn',
		'15' => 'https://play.google.com/store/apps/details?id={APPID}&hl=in&gl=id'
	),
	'microsoftstore' => array(
		'1' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=de-de&gl=de',
		'2' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=en-us&gl=us',
		'3' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=en-gb&gl=uk',
		'4' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=fr-fr&gl=fr',
		'5' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=es-es&gl=es',
		'6' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=ru-ru&gl=ru',
		'7' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=tr-tr&gl=tr',
		'8' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=it-it&gl=it',
		'9' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=de-at&gl=at',
		'10' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=de-ch&gl=ch',
		'12' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=pl-pl&gl=pl',
		'14' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=zh-cn&gl=cn',
		'15' => 'https://apps.microsoft.com/store/detail/app/{APPID}?hl=id-id&gl=id'
	),
	'operaaddons' => array(
		'1' => 'https://addons.opera.com/de/extensions/details/{APPID}/',
		'2' => 'https://addons.opera.com/en/extensions/details/{APPID}/',
		'3' => 'https://addons.opera.com/en-gb/extensions/details/{APPID}/',
		'4' => 'https://addons.opera.com/fr/extensions/details/{APPID}/',
		'5' => 'https://addons.opera.com/es/extensions/details/{APPID}/',
		'6' => 'https://addons.opera.com/ru/extensions/details/{APPID}/',
		'7' => 'https://addons.opera.com/tr/extensions/details/{APPID}/',
		'8' => 'https://addons.opera.com/it/extensions/details/{APPID}/',
		'12' => 'https://addons.opera.com/pl/extensions/details/{APPID}/',
		'14' => 'https://addons.opera.com/zh-cn/extensions/details/{APPID}/',
		'15' => 'https://addons.opera.com/id/extensions/details/{APPID}/'
	),
	'snapcraft' => array(
		'1' => 'https://snapcraft.io/{APPID}'
	),
	'steam' => array(
		'1' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=de&l=german',
		'2' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=us&l=english',
		'3' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=uk&l=english',
		'4' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=fr&l=french',
		'5' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=es&l=spanish',
		'6' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=ru&l=russian',
		'7' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=tr&l=turkey',
		'8' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=it&l=italian',
		'11' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=jp&l=japanese',
		'14' => 'https://store.steampowered.com/api/appdetails/?appids={APPID}&cc=cn&l=schinese'
	),
	'wordpress' => array(
		'1' => 'https://wordpress.org/plugins/{APPID}/'
	)
);


?>