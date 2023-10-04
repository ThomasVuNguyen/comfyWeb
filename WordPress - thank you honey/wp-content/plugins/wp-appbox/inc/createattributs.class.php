<?php

/**
* wpAppbox_CreateAttributs
*/

class wpAppbox_CreateAttributs {
	
	
	/**
	* Prüfen ob Shortcode-Attribut ein Style ist
	*
	* @since   2.0.0
	* @change  3.2.0
	*
	* @param   string   $value      Attribut
	* @return  boolean  true/false  TRUE when Style
	*/
	
	function isValueStyle( $value ) {
		global $wpAppbox_styleNames;
		if ( array_search( $value, $wpAppbox_styleNames ) != '' ) {
			return( true );
		} else {
			return( false );
		}
	}
	
	
	/**
	* Prüfen ob Shortcode-Attribut ein Store ist
	*
	* @since   2.0.0
	* @change  4.4.5
	*
	* @param   string   $value      Attribut
	* @return  boolean  true/false  TRUE when Store
	*/
	
	function isValueStore( $value ) {
		global $wpAppbox_storeNames;
		if ( 'androidpit' == $value ) $value = 'googleplay';
		if ( 'goodoldgames' == $value ) $value = 'gog';
		if ( 'windowsphone' == $value || 'windowsstore' == $value ) $value = 'microsoftstore';
		if ( isset( $wpAppbox_storeNames ) && array_key_exists( $value, $wpAppbox_storeNames ) ) {
			return( true );
		} else {
			return( false );
		}
	}
	
	
	/**
	* Prüfen ob Shortcode-Attribut "Bundle" ist
	*
	* @since   3.0.0
	* @change  3.2.0
	*
	* @param   string   $value      Attribut
	* @return  boolean  true/false  TRUE when "Bundle"
	*/
	
	function isValueAppBundle( $value ) {
		if ( 'bundle' == $value ) {
			return( true );
		} else {
			return( false );
		}
	}
	
	
	/**
	* Prüft ob der Style für den Store genutzt werden kann
	*
	* @since   2.0.0
	* @change  3.2.3
	*
	* @param   string  $storeID   ID des Stores (z.B. "googleplay")
	* @param   string  $style     ID des Styles (z.B. "simple")
	* @return  string             ID des genutzten Styles (z.B. "simple")
	*/
	
	function checkStyle( $storeID, $style ) {
		global $wpAppbox_styleNames, $wpAppbox_storeStyles;
		/* Wenn Feed dann "feed" zurückgeben */
		if ( is_feed() ) {
			return( 'feed' );
		}
		$style_id = array_search( $style, $wpAppbox_styleNames );
		if ( in_array( $style_id, (array)$wpAppbox_storeStyles[$storeID] ) ) {
			return( $style );
		} else {
			return( $wpAppbox_styleNames[get_option('wpAppbox_defaultStyle')] );
		}
	}

	
	/**
	* Gibt die Attribute der Appbox zurück
	*
	* @since   2.0.0
	* @change  4.2.0
	*
	* @param   array  $attribute  Attribute des Shortcodes [WordPress]
	* @return  array  $attr       Attribute des Shortcodes als "reines" Array
	*/
	
	function devideAttributs( $attribute ) {
		global $wpAppbox_styleNames;
		$attr =	array(	
			'store' => '',
			'style' => '',
			'appid' => '',
			'bundle' => false
		);
		if ( is_array( $attribute ) ) {
			foreach ( $attribute as $value ) {
				if ( $this->isValueAppBundle( $value ) ) {
					$attr['bundle'] = true;
				} elseif ( $this->isValueStyle( $value ) ) {
					$attr['style'] = $value;
				} elseif ( $this->isValueStore( $value ) ) {
					$attr['store'] = $value;
				} else {
					$attr['appid'] = $value;
				}
			}
		}
		if ( '' != $attr['store'] && '' == $attr['style'] ) {
			$attr['style'] = $this->checkStyle( $attr['store'], $wpAppbox_styleNames[get_option( 'wpAppbox_defaultStyle' )] );
		}
		$attr['appid'] = str_replace( '/>', '', $attr['appid'] );
		return( $attr );
	}
	
} /* Class beenden */

?>