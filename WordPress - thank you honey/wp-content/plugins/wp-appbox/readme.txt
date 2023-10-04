=== WP-Appbox ===
Contributors: Marcelismus
Donate link: https://www.paypal.me/marcelismus
Tags: google play, google, android, apps, apple, app store, ios, windows, mobile, windows store, microsoft store, appbox, firefox, chrome, chrome web store, amazon, amazon apps, wordpress, opera, steam, phg, gog.com, good old games, affiliate, fdroid, snapcraft
Requires at least: 4.7
Tested up to: 6.2
Stable tag: 4.4.12
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0

With WP-Appbox you can add beautiful mobile app badges to your WordPress posts and pages simply by adding a shortcode.


== Description ==

With WP-Appbox you can add beautiful mobile app badges to your WordPress posts and pages simply by adding a shortcode. WP-Appbox supports the following app stores:

Apps & Software:
* Amazon App Shop
* Apple App Store
* F-Droid
* Google Play Store
* Huawei AppGallery (highly experimental!)
* Microsoft Store
* Snapcraft
* WordPress-Plugins

Browser Extensions:
* Chrome Web Store
* Microsoft Edge-Add-ons
* Firefox Add-ons
* Opera Add-ons

Games:
* GOG.com (Good Old Games)
* Steam (only single games)

= Usage of the shortcode =

All stores are integrated in a short code and can be inserted via button in the WordPress editor. The structure of the short code is always the following:

[appbox *storename* *app-id* *style*]

The order does not matter - as long as "appbox" is on the front. The blind names are: amazonapps, appstore, chromewebstore, fdroid, firefoxaddon, firefoxmarketplace, goodoldgames, googleplay, operaaddons, steam, windowsstore and wordpress. How to get the ID of the corresponding apps is illustrated in the settings for WP-Appbox. The default format is "simple", alternatively there is also an ad with "compact", "screenshots" and "screenshots-only".

There is another special feature for the App Store: With Universal Apps you can decide whether you want to get screenshots of the iPhone, iPad and the Watch App, or for example only of the iPhone, only of the iPad or only of the Watch App. All you need to do is simply attach a "-iphone", "-ipad" or "-watch" to the ID of the app. Example: 392502056-ipad.

By the way, the special feature is also available for the Windows Store: Here, too, only the mobile screenshots or those of the desktop version can be displayed. All you have to do is attach a "-mobile" or "-desktop" to the App-ID. Example: 392502056-mobile.

= Further Features =

* Display a QR code with MouseOver
* Adaptation to mobile devices with smaller displays
* Adaptation to the feed output
* Caching of data for performance purposes
* Use of the Microsoft Private Affiliate Program via Impact
* Use of user-specific Affiliate IDs
* Fully customizable via HTML and CSS

= Requirements =
* PHP min. 5.3
* WordPress min. 3.4
* Server with allow_url_fopen, cURL (curl_init and curl_exec) and mb_eregi enabled
* Outgoing requests must be allowed

= Support =
Support requests and problems should ideally be reported directly on the [Blog](https://tchgdns.de/wp-appbox-app-badge-fuer-google-play-mac-app-store-windows-store-windows-phone-store-co/ "Blog") or even better via [Twitter](https://twitter.com/Marcelismus "Twitter"). I can't promise a quick solution for every problem, but I try to solve every problem. ;-)

= Author =
* [tchgdns.de](https://tchgdns.de "tchgdns.de")
* [marcelismus.de](http://marcelismus.de "marcelismus.de")
* [Twitter](https://twitter.com/Marcelismus "Twitter")

= Logo =
The logo of the WP-Appbox comes from [Till](https://twitter.com/craive "@craive on Twitter"), to whom I am deeply indebted. \o/

== Screenshots ==

1. App badge: "simple" (standard)
2. App badge with screenshots
3. App badge "compact"
4. Post editor with buttons
5. WP-Appbox settings: "About"
6. WP-Appbox settings: "Output"
7. WP-Appbox settings: "Cache"
8. WP-Appbox settings: "Affiliate"
9. WP-Appbox settings: "Buttons"
10. WP-Appbox settings: Customized store URLs
11. WP-Appbox settings: "Advanced"
12. WP-Appbox settings: "Help"

= Requirements =
* PHP min. 5.3
* WordPress min. 4.7
* Server with allow_url_fopen, cURL (curl_init and curl_exec) and mb_eregi enabled
* Outgoing requests must be allowed

= Installation =
1. Download und unpack the package
2. Upload the plugin folder to "/wp-content/plugins/
3. Activate the plugin in WordPress

Simply extract it into the plugin folder of WordPress and activate it.


== Frequently Asked Questions ==
  
= Which server requirements are necessary? =
The server must run at least PHP 5.3 and support cURL and mb_eregi.

= Can the output of the box be adapted to the theme design? =
Yes, all elements of the WP-Appbox can be customized via CSS. It is also possible to deactivate the CSS stylesheet of the plugin in the settings. In addition, you can create your own templates for the output (see below).

= How can I create my own templates? =
You can simply copy the existing standard templates (folder "tpl") into your theme folder. The files can be given the following names:

* your-theme-folder/wpappbox-simple.php
* your-theme-folder/wpappbox-compact.php
* your-theme-folder/wpappbox-screenshots.php
* your-theme-folder/wpappbox-screenshots-only.php

Or just put the templates inside a folder called "wp-appbox" and keep the original names:
 
* your-theme-folder/wpappbox/simple.php
* your-theme-folder/wpappbox/compact.php
* your-theme-folder/wpappbox/screenshots.php
* your-theme-folder/wpappbox/screenshots-only.php

In the user-defined template files, the output can be adjusted to any desired value. The available variables can be found in the original files. ;-)

= Are AMP plugins supported? =
Basically, yes. However, the CSS of the WP-Appbox has to be implemented manually into your AMP page. How this works depends on your plugin.

= Why are the QR codes scaled down from 400x400 pixels? =
The QR code generator from Google has the peculiarity that the QR codes are created only throughout the fixed size. The shorter the URL, the smaller the code becomes and the higher the value "margin". This cannot be corrected with a "margin=0" value. Whether it is a feature or a bug is discussed in the Google Groups.

= The Chrome Web Store only displays the first screenshot =
Unfortunately Google only loads the first screenshot into the HTML output of the Chrome Web Store, all other screenshots are dynamically reloaded. Therefore the output of several screenshots via WP-Appbox is not possible at the moment.

= Is WP-Appbox compliant with DSGVO? =

Basically: yes. But it depends on the settings. The plugin itself does not store any user data. However, external images from Apple, Google, Amazon and Co. are integrated. Depending on the interpretation of the DSGVO, this is problematic. If you don't want to supplement your data protection information, you can use two possible options:
 
* Activate the image proxy, which embeds external images in the WP appbox using its own URL. However, this can impair performance, especially with a large number of page calls.
* Activate the image cache. All images are stored on your own server. This variant is always recommended, because it improves performance and the images are still displayed even if the app is no longer available in the respective store. ;-)

= Is the Gutenberg editor supported? =
A first implementation is available. However, this is experimental in nature and is not officially supported. With WordPress 6.2 there are problems with the block, but so far I have not found a solution. Classic Editor is therefore recommended ;)

= Why isn't the Amazon Product Advertising API 5.0 used? =
The PA-API 5.0 has a request limit, which is currently still very buggy. Also, unlike version 4.0, no images (icons and screenshots) are returned for Android Apps and Alexa Skills. Therefore I have currently decided to remove the PA-API. Should Amazon extend version 5.0, it will of course be implemented again.

= Why are the requests for Amazon sent to the Google Cache? =
Amazon has a very strong and "good working" bot detection. Therefore I had to resort to this workaround. It is not perfect, but the only alternative would be to remove Amazon from the WP appbox completely... :-/


== Changelog ==

= 4.4.1 - 4.4.12 =
* Fixed: Various bugs

= 4.4.0 =
* Added: Microsoft Edge-Add-ons
* Added: Huawei AppGallery (highly experimental!)
* Changed: Replaced "classic" Microsoft Store with Windows Apps
* Changed: External images (if not cached) are now displayed as data URI (Base64)
* Fixed: Apple App Store (iOS / macOS)
* Fixed: Security flaws, sanitized and escaped all options
* Fixed: Various bugs

= 4.3.7 - 4.3.20 =
* Fixed: Various bugs

= 4.3.6 =
* Removed: XDA Labs ([read more](https://www.xda-developers.com/update-xda-labs/ "read more"))

= 4.3.2 - 4.3.5 =
* Fixed: Various bugs

= 4.3.1 =
* Fixed: App Store images
* Fixed: Various bugs

= 4.3.0 =
* Added: Snapcraft by Canonical
* Changed: Rakuten for Windows Store
* Fixed: App icons for Google Play Store
* Fixed: Various bugs

= 4.2.1 =
* Added: Some Store URLs for Poland and China
* Changed: Some CSS optimizations
* Fixed: Various bugs

= 4.2.0 =
* Added: F-Droid
* Added: Cleanup folder with cached images
* Added: Option to deactivate the graying out of not found apps 
* Changed: Windows Store to Microsoft Store (windowsstore → microsoftstore)
* Changed: Good Old Games zu GOG (goodoldgames → gog)
* Changed: New Icons
* Removed: Shortcode parameter "oldprice"
* Removed: Some old code for update compatibility with WP Appbox 3.x
* Fixed: WordPress ratings
* Fixed: XDA Labs
* Fixed: Various bugs

= 4.1.27 =
* Fixed: Windows Store (at least I hope so)

= 4.1.26 =
* Removed: Amazon Product Advertising API ([see FAQ](https://wordpress.org/plugins/wp-appbox/#faq-header "see FAQ") for more)
* Fixed: Optimizations for PHP 7.4

= 4.1.17 - 4.1.25 =
* Fixed: Various bugs

= 4.1.16 =
* Fixed: Adjustments for the Windows Store

= 4.1.15 =
* Fixed: Various bugs

= 4.1.14 =
* Changed: Revamp button integration for the TinyMCE

= 4.1.13 =
* Added: Filter for the list of cached apps
* Fixed: Various bugs

= 4.1.1 - 4.1.12 =
* Fixed: Various bugs

= 4.1.0 =
* Added: Gutenberg block for WP-Appbox (experimental)
* Fixed: Various bugs

= 4.0.63 - 4.0.65 =
* Fixed: Various bugs

= 4.0.62 =
* Removed: Apple Affiliate for the (Mac) App Store :-/
* Fixed: Various bugs

= 4.0.55 - 4.0.61 =
* Fixed: Various bugs

= 4.0.54 =
* Removed: Firefox Marketplace
* Fixed: Various bugs

= 4.0.48 - 4.0.53 =
* Fixed: Various bugs

= 4.0.47 =
* Added: QR Code can be cached on your own server (EU-DSGVO/GDPR)
* Fixed: Various bugs

= 4.0.46 =
* Fixed: Various bugs

= 4.0.45 =
* Added: Load external images via own image proxy (EU-DSGVO/GDPR)

= 4.0.43 - 4.0.44 =
* Fixed: Various bugs

= 4.0.42 =
* Added: The stylesheet can only be included on articles and pages

= 4.0.41 =
* Added: Display "Pre-register" for Google Play
* Fixed: Various bugs

= 4.0.39 - 4.0.40 =
* Fixed: Various bugs for Google Play (Thanks to [AndroidPolice](https://www.androidpolice.com/2018/03/16/google-rolling-new-web-play-store-design-much-larger-screenshots-new-reviews-page/ "AndroidPolice") for data!)

= 4.0.37 - 4.0.38 =
* Fixed: Various bugs

= 4.0.36 =
* Fixed: Changing the URL for Steam queries

= 4.0.32 - 4.0.35 =
* Fixed: Various bugs

= 4.0.31 =
* Added: "preorder" CSS class for Apple App Store
* Added: More reset options in the Advanced tab in settings
* Fixed: Screenshot fix for Apple App Store
* Fixed: Workaround for icons from Opera Addons
* Fixed: Various bugs

= 4.0.30 =
* Fixed: Various bugs

= 4.0.29 =
* Fixed: Modifications for the new App Store

= 4.0.28 =
* Fixed: Apps from Amazon from Google Play Store
* Fixed: Better compatibility with PHP 5.3

= 4.0.27 =
* Fixed: Modifications for Google Play Store urls

= 4.0.26 =
* Fixed: Mozilla Addons

= 4.0.24 - 4.0.25 =
* Fixed: Windows Store

= 4.0.19 – 4.0.23 =
* Removed: Some unnecessary/deprecated files
* Fixed: Various bugs

= 4.0.18 =
* Added: Czech language package
* Fixed: Various bugs

= 4.0.17 =
* Fixed: Google Play Store (Thank you Artem!)

= 4.0.16 =
* Changed: New icon for Apple App Store
* Changed: New icon for Mozilla Addons
* Fixed: XDA Labs
* Fixed: Better compatibility with iPv6
* Fixed: Various bugs

= 4.0.15 =
* Added: Screenshots for watch apps
* Added: Screenshots for iMessage apps
* Changed: Automatic detection for Amazon URLs improved
* Fixed: Various bugs

= 4.0.11 - 4.0.14 =
* Fixed: Various bugs

= 4.0.10 =
* Removed: geo.itunes.com URLs due to numerous problems

= 4.0.9 =
* Changed: Exchanged some store icons
* Fixed: Fix for the appbox button in the WYSIWYG editor
* Fixed: Fix for Windows Store
* Fixed: Various bugs

= 4.0.8 =
* Changed: Cache mode is no longer reset when the cronjob is disabled
* Changed: Error output provides more information

= 4.0.7 =
* Added: SSL output can now be forced
* Fixed: Various bugs

= 4.0.6 =
* Changed: Update notification is only displayed once
* Fixed: URLs for "App not found" boxes

= 4.0.2 - 4.0.5 =
* Fixed: Removed some PHP notices

= 4.0.1 =
* Fixed: Better user agent

= 4.0.0 =
* [more infos about v4.0.0 in the blog](https://tchgdns.de/wp-appbox-4-0-0/ "WP-Appbox 4.0.0")
* Added: Cache update now possible via cron
* Added: App icons can be stored locally on the server
* Added: Screenshots can be stored locally on the server (experimental)
* Added: Apps that are no longer available remain in the database
* Added: New template variable {DEPRECATED} for no longer available apps (addition to class .wpappbox)
* Added: New template for removed apps
* Added: Requests for deleted apps can be temporarily disabled
* Added: Anonymization of outgoing links via Anon.to possible
* Added: (Error) messages can be written to the PHP error log
* Changed: Alexa skills now have their own store icon (CSS class .amazonalexa)
* Changed: Better query of the app data
* Changed: If the Play Store detects a bot, queries are disabled for 3 hours
* Changed: Android logo replaced with Play Store logo in the editor
* Changed: Better error output
* Fixed: Ratings now show half stars
* Fixed: Discounted apps from Play Store now show the old price
* Fixed: Better url recognition
* Changed: Requires at least PHP 5.4

= 3.4.9 + 3.4.10 =
* Fixed: Windows Store

= 3.4.8 =
* Added: Support for Alexa skills
* Added: XDA Labs
* Changed: Exchanged a few graphics
* Removed: Icon for Apple Watch
* Fixed: Some errors with PHP 7

= 3.4.7 =
* Fixed: Amazon Product Advertising API

= 3.4.6 =
* Added: "rel=noopener" if using "target=_blank" for links
* Fixed: When querying via HTTPS and displaying via HTTP images from Amazon were missing

= 3.4.5 =
* Changed: Some smaller optimizations
* Fixed: Better compatibility with PHP 7

= 3.4.4 =
* Fixed: Apple iMessage apps
* Fixed: Apple SSL

= 3.4.3 =
* Fixed: Variables in own template

= 3.4.2 =
* Added: Support for Xbox Live Games
* Fixed: Various bugs

= 3.4.1 =
* Fixed: Various bugs

= 3.4.0 =
* [more infos about v3.4.0 in the blog](https://tchgdns.de/wp-appbox-3-4-0-integration-der-amazon-product-advertising-api/ "WP-Appbox 3.4.0")
* Added: The official Amazon API can now be used
* Fixed: Games from the Windows Store
* Fixed: Various bugs

= 3.3.4 =
* Changed: Better url auto detection from the App Store
* Fixed: New Windows Store design
* Fixed: Microsoft Country ID for Norway
* Fixed: Amazon queries

= 3.3.3 =
* Fixed: Readme

= 3.3.2 =
* Changed: Better url auto detection for iTunes
* Fixed: New url pattern for Windows Store

= 3.3.1 =
* Fixed: Various bugs
 
= 3.3.0 =
* [more infos about v3.3.0 in the blog](https://tchgdns.de/wp-appbox-3-3-0 "WP-Appbox 3.3.0")
* Added: Auto detections for plain urls (experimental)
* Added: Support for Apple TV apps
* Changed: Options now have the tag "autoload=no"
* Changed: Requirements raised to PHP 5.3
* Fixed: Various bugs

= 3.2.17 =
* Changed: Updated French translation

= 3.2.16 =
* Fixed: Screenshots for the Windows Store

= 3.2.15 =
* Added: Optional colorful rating stars
* Changed: Revamped settings in the backend
* Fixed: Chrome Web Store
* Fixed: Prices of the Windows Store
* Fixed: Various bugs

= 3.2.14 =
* Fixed: SSL fix for Apple Watch icons (experimental, see Version 3.2.13)

= 3.2.13 =
* Changed: App Store images can be loaded via SSL (optional and very, very experimental)
* Changed: Better visualization of the rating stars on high-resolution displays

= 3.2.12 =
* Added: App Store links now use geo.itunes.apple.com (optional) to always redirect the user to the app page in their language

= 3.2.11 =
* Fixed: Good Old Games
* Fixed: Microsoft-Affiliate
* Fixed: CSS path to high-resolution graphics of the rating stars

= 3.2.10 =
* [more infos about v3.2.10 in the blog](https://tchgdns.de/wp-appbox-3-2-10/ "WP-Appbox 3.2.10")
* Added: Support for the Microsoft Private Affiliate Program at TradeDoubler
* Changed: Output of Amazon images now uses HTTPS
* Changed: Revamped button implementation in the editor

= 3.2.9 =
* Added: Display in-app purchases in the Windows Store
* Fixed: In-app purchase in the Apple App Store
* Fixed: Shows correct developer for the Windows Store

= 3.2.8 =
* Noted: Support for WordPress 4.4
* Changed: Revised phpQuery

= 3.2.7 =
* Fixed: Better activation for multisite installations
* Fixed: App banners without screenshots (e.g. Chrome Web Store) are now shown correctly
* Fixed: Chrome Web Store

= 3.2.6 =
* Fixed: (Mac) App Store screenshots are now shown
* Fixed: Correct replacement of the variable {TITLE_ATTR}

= 3.2.5 =
* Changed: Affiliate ID added to the QR code url
* Changed: Affiliate ID added to the developer link
* Fixed: Amazon App Store
* Fixed: Windows Store

= 3.2.4 =
* Fixed: Better App Store icons

= 3.2.3 =
* Changed: Mobile screenshots from the Windows Store without background
* Changed: Smaller changes in the backend
* Fixed: Background color of app icons from Windows Store
* Fixed: Cache for apps with long identifier (DB version 1.0.2)

= 3.2.2 =
* Changed: Modifications in the backend
* Changed: Various modifications for multisite installations

= 3.2.1 =
* Added: CSS files can be loaded in the header
* Changed: Modifications for multisite installations
* Changed: Modification of the database creation
* Fixed: Bug in the update request fixed

= 3.2.0 =
* [more infos about v3.2.0 in the blog](https://tchgdns.de/wp-appbox-3-2/ "WP-Appbox 3.2")
* Added: WP-Appbox now uses an own database table
* Added: Support for custom templates
* Added: Styles and fonts are only loaded if an appbox has been created
* Added: Icons of Apple Watch apps can be hidden
* Added: Automatic refresh of the cache can be disabled
* Added: Support for cache plugins
* Changed: Modifications in the backend
* Removed: Some deprecated code

= 3.1.8 =
* Fixed: Selecting buttons in the WP-Appbox settings

= 3.1.7 =
* Fixed: URL of the settings page now works fine

= 3.1.6 =
* Added: Download caption can now be changed
* Changed: Modifications in the backend
* Fixed: Prices from the Amazon App Shop

= 3.1.5 =
* Fixed: Play Store apps now get their correct title

= 3.1.4 =
* Fixed: Show correct prices from Windows Store

= 3.1.3 =
* Changed: Show app prices in feed
* Fixed: Display cache page in the settings
* Fixed: Rating stars for Apple App Store
* Fixed: Icons for Windows Store

= 3.1.2 =
* Fixed: Apple App Store

= 3.1.1 =
* Added: Screenshot selection for Windows Store apps (attach -mobile and -desktop to ID)
* Changed: Better localisation for old Windows Phone apps
* Removed: Pebble App Store

= 3.1.0 =
* [more infos about v3.1.0 in the blog](https://tchgdns.de/wp-appbox-3-1/ "WP-Appbox 3.1")
* Added: Support for universal Windows Store
* Added: Support for Apple Watch apps
* Changed: Apple App Store switched to HTML
* Changed: Optimizations for the backend
* Fixed: Reload url in post/site preview
* Fixed: Various bugs

= 3.0.5 =
* Fixed: Prices from the Apple App Store

= 3.0.4 =
* Added: Usage of OpenSans can be deactivated
* Fixed: App Store does not deliver screenshots via HTTPS, therefore limited to HTTP

= 3.0.3 =
* Fixed: Font optimization regarding problems with the BUCKET theme

= 3.0.2 =
* Fixed: HTTPS for different stores
* Fixed: HTTPS for Google fonts

= 3.0.1 =
* Fixed: Working button in the WYSIWYG editor

= 3.0.0 =
* [more infos about v3.0.0 in the blog](https://tchgdns.de/wp-appbox-3-0-wordpress/ "WP-Appbox 3.0 ist da: Neues Design und viele Kleinigkeiten")
* Added: New design of the appboxes
* Added: Search in the overview of all cached apps
* Added: HTML editor shows buttons of WP-Appbox
* Added: Store URLs can now be changed in the backend
* Added: Colorful icons for the stores (optional)
* Added: Pebble App Store
* Added: Support for app bundles in the Apple App Store
* Changed: Interface now in English by default
* Changed: Revised feed output, displays now pure text links
* Changed: Support for age verification for Steam games
* Changed: HTTPS for QR code
* Removed: Banner and video box for Play Store
* Removed: Samsung Apps
* Fixed: Various bugs

= 2.4.12 =
* Fixed: QR code is now displayed correctly

= 2.4.11 =
* Fixed: Apple App Store icons are now displayed correctly

= 2.4.10 =
* Removed: AndroidPit (more infos [in this post](https://tchgdns.de/androidpit-alternativer-app-store-fuer-android-macht-dicht-update-fuer-wp-appbox-folgt/ "AndroidPit: Alternativer App-Store für Android macht dicht, Update für WP-Appbox folgt"))

= 2.4.9 =
* Fixed: WordPress Plugins

= 2.4.8 =
* Fixed: GOG.com
* Fixed: Amazon Apps

= 2.4.7 =
* Fixed: Support for the new AndroidPit profiles

= 2.4.6 =
* Fixed: Promos in the Windows Store are now displayed correctly

= 2.4.5 =
* Fixed: Buttons in the editor now work as desired

= 2.4.4 =
* Fixed: Buttons now work with WordPress 3.9
* Fixed: Various bugs

= 2.4.3 =
* Removed: TradeDoubler (more info [in this post](https://tchgdns.de/kurzinfo-in-der-sache-wp-appbox-und-dem-tradedoubler-partnerprogramm/ "Kurzinfo in der Sache WP-Appbox und dem TradeDoubler-Partnerprogramm"))

= 2.4.2 =
* Fixed: Some types
* Fixed: Certain types of Apple/PHG links did not work

= 2.4.1 =
* Changed: Optical correction regarding the PHG link

= 2.4.0 =
* [more infos about v2.4.0 in the blog](https://tchgdns.de/wp-appbox-2-4-0-bringt-neues-apple-affiliate-programm-mit-und-entfernt-intel-appup/ "WP-Appbox 2.4.0 bringt neues Apple-Affiliate-Programm mit und entfernt Intel AppUp")
* Added: Support for PHG for European users (more info [in this post](https://tchgdns.de/kurzinfo-in-der-sache-wp-appbox-und-dem-tradedoubler-partnerprogramm/ "Kurzinfo in der Sache WP-Appbox und dem TradeDoubler-Partnerprogramm"))
* Removed: Intel AppUp

= 2.3.5 =
* Fixed: Amazon App Shop

= 2.3.4 =
* Fixed: Developer in Play Store is now displayed correctly

= 2.3.3 =
* Noted: Support for WordPress 3.8

= 2.3.2 =
* Added: Serbian translation
* Fixed: Intel AppUp

= 2.3.1 =
* Fixed: AndroidPit

= 2.3.0 =
* [more infos about v2.3.0 in the blog](https://tchgdns.de/wp-appbox-2-3-0-bringt-unterstuetzung-fuer-good-old-games-gog-com-mit/ "WP-Appbox 2.3.0 bringt Unterstützung für Good Old Games (GOG.com) mit")
* Added: Good Old Games (GOG.com)
* Fixed: Various bugs

= 2.2.3 =
* Noted: Support for WordPress 3.7
* Fixed: Amazon App Shop
* Fixed: Various bugs

= 2.2.2 =
* Fixed: Author links for Firefox Addons are now read and displayed correctly
* Fixed: Various bugs

= 2.2.1 =
* Added: Support for the PHG affiliate program for (Mac) App Store (not for European users)
* Fixed: Various bugs

= 2.2.0 =
* [more infos about v2.2.0 in the blog](https://tchgdns.de/wp-appbox-2-2-0-benutzerspezifische-affiliate-ids-dauerhafter-cache-und-screenshot-only/ "WP-Appbox 2.2.0: Benutzerspezifische Affiliate-IDs und Screenshot-Only")
* Added: Users can use their own affiliate IDs
* Added: "Screenshot only" badge
* Fixed: Various bugs

= 2.1.4 =
* Fixed: Fixed problem with databases that do not use the default prefix "wp_".

= 2.1.3 =
* Noted: Support for WordPress 3.6.1
* Fixed: Various bugs

= 2.1.2 =
* Changed: Modifications for the feed output

= 2.1.1 = 
* Changed: Version number
* Fixed: Windows Store

= 2.1.0 = 
* [more infos about v2.1.0 in the blog](https://tchgdns.de/wp-appbox-2-1-0-bewertungen-aus-den-app-stores-und-hochaufloesendere-app-store-icons/ "WP-Appbox 2.1.0: Bewertungen aus den App Stores und hochauflösendere App-Store-Icons")
* Added: Ratings from the App Stores can now be displayed
* Added: High resolution icons
* Added: Italian translation
* Fixed: Various bugs

= 2.0.2 = 
* Changed: Optimizations for WordPress plugins
* Fixed: Various bugs

= 2.0.1 =
* Fixed: Lining up the parameters [... "app id" "simple"] no longer produces an error

= 2.0.0 =
* [more infos about v2.0.0 in the blog](https://tchgdns.de/wp-appbox-2-0-0-is-here-danke-fuer-10-000-downloads/ "WP-Appbox 2.0.0 is here! Danke für 10.000 Downloads.")
* Added: New logo- thanks to @craive!
* Added: Intel AppUp
* Added: A more compact badge
* Added: A badge for videos from Steam and Play Store
* Added: Apps in cache can be deleted individually
* Added: CSS stylesheet of the plugin can be disabled
* Changed: Stand-alone buttons and combined button now possible together in the WYSIWYG editor
* Changed: Large parts of the code rewritten
* Changed: New settings page
* Removed: Shortcode parameter "preis/price"
* Fixed: Windows Phone Store
* Fixed: Various bugs

= 1.8.15 =
* Noted: Support for WordPress 3.6

= 1.8.14 =
* Fixed: Bug with the activation of the plugin

= 1.8.13 =
* Fixed: Various bugs

= 1.8.12 =
* Fixed: Apple App Store
* Fixed: Windows Phone Store

= 1.8.11 =
* Changed: Modifications for the Windows Store

= 1.8.10 =
* Fixed: Apple App Store
* Fixed: Various bugs

= 1.8.9 =
* Removed: Screenshots from the Chrome Web Store currently no longer possible
* Fixed: App Store icons should be shown again
* Fixed: Various bugs

= 1.8.8 =
* Added: Support for new Play Store
* Removed: Banner badge for Play Store

= 1.8.7 =
* Fixed: Various bugs

= 1.8.6 =
* Fixed: Too long titles are now shortened correctly
* Fixed: App Store icons are now displayed correctly
* Fixed: Various bugs

= 1.8.5 =
* Added: Support for Steam (experimental, without age verification)
* Changed: Modifications to the badge output
* Fixed: Various bugs

= 1.8.0 =
* Added: Store urls can now be changed per PHP functions (see FAQ)
* Added: Timeout time can be set manually

= 1.7.13 =
* Fixed: TIFF icons from the App Store are now displayed
* Fixed: The fix from v1.7.12 is now really included

= 1.7.12 =
* Changed: Improved update method

= 1.7.11 =
* Fixed: Various bugs

= 1.7.10 =
* Fixed: Various bugs

= 1.7.9 =
* Added: Screenshots of universal apps from the App Store can now be selected (iPhone or iPad only)
* Added: Reload of app data can be forced (GET parameter: "wpappbox_reload_cache")
* Fixed: Various bugs

= 1.7.8 =
* Added: Spanish translation
* Changed: Optimizations for App Store icons

= 1.7.7 =
* Changed: Optimizations for the CSS stylesheet
* Changed: Optimizations for the Play Store

= 1.7.6 =
* Fixed: Tempfile for cached apps

= 1.7.5 =
* Added: Support for Opera Addons (Shortcode: operaaddons)
* Added: QR codes can now be displayed for mobile stores only
* Fixed: Translation files
* Fixed: Various bugs

= 1.7.1 =
* Fixed: Buttons in the editor

= 1.7.0 =
* Added: Support for WordPress plugins (Shortcode: wordpress)
* Changed: Removed some old lines
* Fixed: Various bugs

= 1.6.2 =
* Fixed: Button for the Amazon App Shop is now displayed

= 1.6.1 =
* Fixed: The QR code is now also enlarged when using the banner badge (Google Play, AndroidPit & Amazon Apps)

= 1.6.0 =
* Added: Support for Amazon App Shop
* Fixed: Various bugs

= 1.5.3 =
* Added: Support for Firefox Marketplace (again)
* Changed: Optimizations for the CSS stylesheet

= 1.5.2 =
* Removed: Firefox Marketplace [see more infos](https://tchgdns.de/mozilla-ueberarbeitet-den-firefox-marketplace-und-was-das-fuer-wp-appbox-bedeutet/ "Mozilla überarbeitet den Firefox Marketplace – und was das für WP-Appbox bedeutet")
* Fixed: Various bugs

= 1.5.1 =
* Added: QR codes can be deactivated for individual boxes (attribute "noqrcode")
* Added: The price to be displayed can be changed (attribute: preis="" or price="")
* Added: An "old price" can be specified (attribute: alterpreis="" or oldprice="")
* Fixed: Various bugs

= 1.5.0 =
* Added: Support for Samsung Apps
* Fixed: Developer names are now shortened correctly
* Fixed: Various bugs (wie immer)

= 1.4.6 =
* Added: Cache can be temporarily disabled
* Added: Shortening of the title can be deactivated
* Fixed: Google Play Store
* Fixed: Various bugs

= 1.4.5 =
* Noted: The sum of the version numbers is 10, so it could be called WP-Appbox X - if it came from Cupertino ;)
* Changed: Optimizations for the CSS stylesheet
* Fixed: Google Play Store

= 1.4.4 =
* Fixed: Various bugs

= 1.4.3 =
* Changed: Too long app titles are shortened
* Fixed: Windows Store
* Fixed: Windows Phone Store
* Fixed: Various bugs

= 1.4.2 =
* Changed: Optimizations for the CSS stylesheet

= 1.4.1 =
* Fixed: QR code now points to the correct link

= 1.4.0 =
* Added: Support for Firefox Addons
* Added: QR Codes can be deactivated
* Fixed: Translation files

= 1.3.3 =
* Removed: BlackBerry World
* Added: Support for translation files (*.mo & *.po)
* Fixed: QR codes for (Mac) App Store

= 1.3.2 =
* Fixed: (Mac) App Store

= 1.3.1 =
* Fixed: The correct AndroidPit URL is used again

= 1.3.0 =
* Added: Support for Firefox Marketplace
* Added: Support for Chrome Web Store (experimental)
* Added: Support for the AndroidPit affiliate program via Affili.net
* Changed: Query the (Mac) App Store via JSON API
* Changed: Revised options page

= 1.2.2 =
* Fixed: AndroidPit screenshots
* Fixed: Various bugs

= 1.2.1 =
* Fixed: The "Empty Cache" link now works

= 1.2.0 =
* Added: Cache can be cleared
* Changed: Using the transient API of WordPress to store the app data
* Fixed: Apps with umlauts are now displayed correctly
* Fixed: Windows Phone Store
* Fixed: Various bugs

= 1.1.3 =
* Fixed: Various bugs

= 1.1.2 =
* Fixed: Bug that the caching time could not be changed in Firefox

= 1.1.1 =
* Added: Error output
* Fixed: Various bugs

= 1.0.2 =
* Fixed: BlackBerry AppWorld
* Fixed: Bugfix from version 1.0.1 is now included

= 1.0.1 =
* Changed: Fallback if the request to the Play Store is detected as a bot

= 1.0.0 =
* Noted: Code-Freeze