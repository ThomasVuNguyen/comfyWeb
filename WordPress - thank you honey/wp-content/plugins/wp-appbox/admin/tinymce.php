<?php 


/**
* Einzelne Buttons zum TinyMCE-Editor (WYSIWYG) hinzufügen
*
* @since   2.0.0
* @change  4.4.0
*
* @param   array  $buttons  Buttons [WordPress]
* @return  array  $buttons  Buttons [WordPress]
*/

function wpAppbox_addSingleButtons( $buttons ) {
	global $wpAppbox_storeNames;
	$defaultOption = get_option( 'wpAppbox_defaultButton' );
	if ( '0' == $defaultOption || '3' == $defaultOption ):
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'amazonapps' ) || get_option('wpAppbox_buttonWYSIWYG_amazonapps') )
			array_push( $buttons, 'wpAppbox_AmazonAppsButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'appgallery' ) || get_option('wpAppbox_buttonWYSIWYG_appgallery') )
			array_push( $buttons, 'wpAppbox_AppGalleryButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'appstore' ) || get_option('wpAppbox_buttonWYSIWYG_appstore') )
			array_push( $buttons, 'wpAppbox_AppStoreButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'chromewebstore' ) || get_option('wpAppbox_buttonWYSIWYG_chromewebstore') )
			array_push( $buttons, 'wpAppbox_ChromeWebStoreButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'edgeaddons' ) || get_option('wpAppbox_buttonWYSIWYG_edgeaddons') )
			array_push( $buttons, 'wpAppbox_EdgeAddOnsButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'fdroid' ) || get_option('wpAppbox_buttonWYSIWYG_fdroid') )
			array_push( $buttons, 'wpAppbox_FDroidButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'firefoxaddon' ) || get_option('wpAppbox_buttonWYSIWYG_firefoxaddon') )
			array_push( $buttons, 'wpAppbox_FirefoxAddonButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'gog' ) || get_option('wpAppbox_buttonWYSIWYG_gog') )
			array_push( $buttons, 'wpAppbox_GOGButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'googleplay' ) || get_option('wpAppbox_buttonWYSIWYG_googleplay') )
			array_push( $buttons, 'wpAppbox_GooglePlayButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'microsoftstore' ) || get_option('wpAppbox_buttonWYSIWYG_microsoftstore') )
			array_push( $buttons, 'wpAppbox_MicrosoftStoreButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'operaaddons' ) || get_option('wpAppbox_buttonWYSIWYG_operaaddons') )
			array_push( $buttons, 'wpAppbox_OperaAddonsButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'steam' ) || get_option('wpAppbox_buttonWYSIWYG_steam') )
			array_push( $buttons, 'wpAppbox_SteamButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'snapcraft' ) || get_option('wpAppbox_buttonWYSIWYG_snapcraft') )
			array_push( $buttons, 'wpAppbox_SnapcraftButton' );
		if ( '0' == $defaultOption || ( isset( $forceSingle ) && $forceSingle == 'wordpress' ) || get_option('wpAppbox_buttonWYSIWYG_wordpress') )
			array_push( $buttons, 'wpAppbox_WordPressButton' );
	endif;
	return( $buttons );
}
//--> See next: wpAppbox_addTheButtons();


/**
* WP-Appbox-Button zum alten TinyMCE-Editor (WYSIWYG) hinzufügen
*
* @since   2.0.0
* @change  4.4.0
*
* @param   array  $buttons  Buttons [WordPress]
* @return  array  $buttons  Buttons [WordPress]
*/

function wpAppbox_addCombinedButton( $buttons ) {
	global $wpAppbox_storeNames, $wpAppbox_combinedButton;
	$defaultOption = get_option( 'wpAppbox_defaultButton' );
	if ( $defaultOption == '1' || $defaultOption == '3' ):
		$combinedButton = array();
		$combinedButtonNames = array();
		$combinedButtonIDs = array();
		foreach ( $wpAppbox_storeNames as $storeID => $storeName ):
			if ( '1' == $defaultOption || get_option( 'wpAppbox_buttonAppbox_' . $storeID ) ):
				$combinedButtonNames[] = esc_attr( $storeName );
				$combinedButtonIDs[] = esc_attr( $storeID );
			endif;
		endforeach;
		if ( count( $combinedButtonNames ) == 1 && count( $combinedButtonIDs ) == 1 ):
			$forceSingle = $combinedButtonIDs[0];
		elseif ( !empty( $combinedButtonNames) && !empty( $combinedButtonIDs ) ):
			$combinedButton['names'] = array_map( 'esc_attr', $combinedButtonNames );
			$combinedButton['ids'] = array_map( 'esc_attr', $combinedButtonIDs );
		endif;
	endif;
	if ( !empty( $combinedButton ) ):
		array_push( $buttons, 'wpAppbox_AppboxButton' );
		$wpAppbox_combinedButton = $combinedButton;
	endif;
	return( $buttons );
}
//--> See next: wpAppbox_addTheButtons();


/**
* Die Buttons in die Toolbar einfügen (primary vs. advanced)
*
* @since   4.1.14
* @change  n/a
*/

function wpAppbox_addTheButtons() {
	if( !get_option('wpAppbox_advancedToolbar') ) {
		add_filter( 'mce_buttons', 'wpAppbox_addSingleButtons' );
		add_filter( 'mce_buttons', 'wpAppbox_addCombinedButton' );
	}
	else {
		add_filter( 'mce_buttons_2', 'wpAppbox_addSingleButtons' );
		add_filter( 'mce_buttons_2', 'wpAppbox_addCombinedButton' );
	}
}

wpAppbox_addTheButtons();


/**
* Script für den WP-Appbox-Button in die HTML-Ausgabe einbetten
*
* @since   4.1.14
* @change  4.1.15
*
* @param   array  $buttons  Buttons [WordPress]
*/

function wpAppbox_addCombinedButtonHTML() {
	global $wpAppbox_combinedButton;
	if( empty( $wpAppbox_combinedButton ) ) return;
	echo( '<script type="text/javascript">
		var wpappbox_combined_button = '.json_encode( $wpAppbox_combinedButton ).';
	</script>');
}

add_action( 'admin_print_footer_scripts', 'wpAppbox_addCombinedButtonHTML' );


/**
* Buttons zum TinyMCE-Editor (HTML-Ansicht) hinzufügen
*
* @since   2.0.0
* @change  4.4.6
*
* @echo    string   Ausgabe des Scripts innerhalb TinyMCE
*/

function wpAppbox_addButtonsHTML() {
	if ( !is_admin() ) return;
	global $wpAppbox_storeNames;
	$defaultOption = get_option('wpAppbox_defaultButton');
	if ( $defaultOption == '2' || !wp_script_is( 'quicktags' ) ) return;
	wp_add_inline_script(
        		'quicktags',
        		"QTags.addButton( 'htmlx_appstore', 'Appbox: AppStore', '[appbox appstore appid]', '', '', 'AppStore' );"
			);
	foreach ( $wpAppbox_storeNames as $storeID => $storeName ):
		if ( get_option('wpAppbox_buttonHTML_' . $storeID) || $defaultOption == '0' ):
			wp_add_inline_script(
        		'quicktags',
        		"QTags.addButton( 'htmlx_" . esc_html( $storeID ) . "', 'Appbox: " . esc_html( $storeID ) . "', '[appbox " . esc_html( $storeID ) . " appid]', '', '', '" . esc_html( $storeName ) . "' );"
			);
		endif;
	endforeach;
}
add_action( 'wp_enqueue_scripts', 'wpAppbox_addButtonsHTML' );


/**
* Registrierung des Plugins für TinyMCE
*
* @since   2.0.0
* @change  4.2.0
*
* @param   array  $plugin_array     Plugin-Array [WordPress]
* @return  array  $plugin_array     Plugin-Array [WordPress]
*/

function wpAppbox_registerButtons( $plugin_array ) {
	global $wpAppbox_storeNames;
	$option = get_option('wpAppbox_defaultButton');
	if ( '2' != $option ):
		foreach ( $wpAppbox_storeNames as $storeID => $storeName ):
			if ( get_option("wpAppbox_buttonAppbox_$storeID") ) $isCombined = true;
		endforeach;
		$plugin_array['wpAppbox_CombinedButton'] = plugins_url( "/../editor/tinymce/buttons.min.js?ver=" . WPAPPBOX_PLUGIN_VERSION, __FILE__ );
		$plugin_array["wpAppboxSingle"] = plugins_url( "/../editor/tinymce/buttons.min.js?ver=" . WPAPPBOX_PLUGIN_VERSION, __FILE__ );
		return( $plugin_array );
	endif;
}

add_filter( 'mce_external_plugins', "wpAppbox_registerButtons" );


?>