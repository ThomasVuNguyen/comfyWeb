<div class="wpa-infobox wpa-notice">
    <p><?php esc_html_e('Here you can change the query URL of the stores. Just copy the desired URL and set instead of the app ID wildcard {APPID}. If the URL is empty, the default URL (German) is used.', 'wp-appbox'); ?></p>
</div>

<table class="form-table">

	<?php foreach( $wpAppbox_storeNames as $storeID => $storeName ) { ?>
	
		<tr valign="top">
			<th scope="row"><?php esc_html_e( $wpAppbox_storeNames[$storeID] ); ?>:</th>
			<td>	
				<?php 
					if ( in_array( $storeID, $wpAppbox_storeURL_noLanguages ) ):
						echo( __('No language selection supported.', 'wp-appbox') ); 
					else:
					?>
					
					<select style="width: 185px;" onChange="javascript:show_hide_box('<?php esc_attr_e( $storeID ); ?>')" name="wpAppbox_storeURL_<?php esc_attr_e( $storeID ); ?>" id="wpAppbox_storeURL_<?php esc_attr_e( $storeID ); ?>" class="postform">
						<option <?php selected( get_option( 'wpAppbox_storeURL_'.$storeID ), '0' ); ?> value="0" data="<?php esc_attr_e( get_option( 'wpAppbox_storeURL_'.$storeID.'_URL' ) ); ?>"><?php esc_attr_e( $wpAppbox_storeURL_languages[0] ); ?></option>
						<?php 
							asort( $wpAppbox_storeURL_languages );
							foreach( $wpAppbox_storeURL_languages as $languageID => $languageNameCode ) { ?>
							<?php if ( ( '0' != $languageID ) && isset( $wpAppbox_storeURL[$storeID][$languageID] ) && ( '' != $wpAppbox_storeURL[$storeID][$languageID] ) ) { ?>
								<option <?php selected( get_option( 'wpAppbox_storeURL_' . $storeID ), $languageID); ?> value="<?php esc_attr_e( $languageID ); ?>" data="<?php esc_attr_e( $wpAppbox_storeURL[$storeID][$languageID] ); ?>"><?php esc_attr_e( $languageNameCode['name'] ); ?></option>
							<?php } ?>
						<?php } ?>
					</select>
					<input <?php if( get_option( 'wpAppbox_storeURL_' . $storeID ) != 0): ?> disabled="disabled" <?php endif; ?> type="text" value="<?php echo esc_url( get_option( 'wpAppbox_storeURL_'.$storeID ) == '0' ) ? get_option('wpAppbox_storeURL_URL_' . $storeID ) : $wpAppbox_storeURL[$storeID][get_option( 'wpAppbox_storeURL_' . $storeID )]; ?>" name="wpAppbox_storeURL_URL_<?php esc_attr_e( $storeID ); ?>" id="wpAppbox_storeURL_URL_<?php esc_attr_e( $storeID ); ?>" style="width:500px;" />
				<?php endif; ?>
			</td>
		</tr>
			
	<?php } ?>
	
</table>

<script>
	function show_hide_box( store ) {
		var box = document.getElementById( "wpAppbox_storeURL_" + store );
		var attr = document.getElementById( "wpAppbox_storeURL_" + store ).options[box.selectedIndex].getAttribute( "data" );
		var txt = document.getElementById( "wpAppbox_storeURL_URL_" + store );
		txt.value = attr;
		if ( box.selectedIndex == 0 ) txt.disabled = false;
		else txt.disabled = true;
	}
</script>