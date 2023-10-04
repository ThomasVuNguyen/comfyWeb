<div class="wpa-infobox wpa-notice">
    <p><?php esc_html_e( 'Which buttons should be displayed in the WordPress-Editor? In addition to a combined button, it is also possible to display frequently used buttons separately.', 'wp-appbox' ); ?></p>
	<?php if ( function_exists( 'register_block_type' ) ) { ?>
		<p><b><?php esc_html_e( 'Warning', 'wp-appbox' ); ?>:</b> <?php esc_html_e( 'These settings only apply to the old TinyMCE editor. Settings for Gutenberg can be found in the tab "Advanced".', 'wp-appbox' ); ?></p>
	<?php } ?>
</div>

<table class="form-table">

	<tr valign="top">
		<th scope="row"><label for="wpAppbox_defaultButton"><?php esc_html_e('Button behavior', 'wp-appbox'); ?></label></th>
		<td colspan="7">
			<select onChange="javascript:show_hide_table()" name="wpAppbox_defaultButton" id="wpAppbox_defaultButton" class="postform">
			   <option <?php selected( get_option('wpAppbox_defaultButton'), '0' ); ?> class="level-0" value="0"><?php esc_html_e('Show all App Store buttons in the editor', 'wp-appbox'); ?></option> 
			   <option <?php selected( get_option('wpAppbox_defaultButton'), '1' ); ?> class="level-0" value="1"><?php esc_html_e('Show all App Stores in one dropdown button', 'wp-appbox'); ?></option>
			   <option <?php selected( get_option('wpAppbox_defaultButton'), '2' ); ?> class="level-0" value="2"><?php esc_html_e('Show no buttons in the editor', 'wp-appbox'); ?></option>
			   <option <?php selected( get_option('wpAppbox_defaultButton'), '3' ); ?> class="level-0" value="3"><?php esc_html_e('Custom Settings', 'wp-appbox'); ?></option>
			</select>
		</td>
	</tr>
	
	<tr valign="top" id="form_advancedToolbar" <?php if( '2' == get_option('wpAppbox_defaultButton') ): ?> style="display:none;" <?php endif; ?>>
		<th scope="row"><label for="wpAppbox_advancedToolbar"><?php esc_html_e('Select toolbar', 'wp-appbox'); ?></label></th>
		<td colspan="7">
			<select name="wpAppbox_advancedToolbar" id="wpAppbox_advancedToolbar" class="postform">
			   <option <?php selected( !get_option('wpAppbox_advancedToolbar'), '1' ); ?> class="level-0"><?php esc_html_e('Add buttons to the primary toolbar of the editor', 'wp-appbox'); ?></option> 
				<option <?php selected( get_option('wpAppbox_advancedToolbar'), '1' ); ?> class="level-0" value="1"><?php esc_html_e('Add buttons to the advanced toolbar of the editor', 'wp-appbox'); ?></option>
			</select>
		</td>
	</tr>
	
</table>

<table id="table_buttons_settings" class="form-table" <?php if( '3' != get_option('wpAppbox_defaultButton') ): ?> style="display:none;" <?php endif; ?>>

	<?php 
		$th_last = count($wpAppbox_storeNames);
		$th_half = ceil($th_last/2);
		$th_count = -1;
		foreach ( $wpAppbox_storeNames as $storeID => $storeName ) { ?>
		<?php $th_count++; ?>
		<?php if( ( $th_count == 0 ) || ( $th_half == $th_count ) ) { ?>
		
			<tr valign="top">
				<th scope="row"></th>
				<td style="width: 130px; text-align:center;">
					<?php esc_html_e('Appbox-Button', 'wp-appbox'); ?>
					<?php if ( $th_count == 0 ) { ?><br /><small>
						<a href="#" onClick="select_buttons_appbox(true);return false;"><?php esc_html_e('All', 'wp-appbox'); ?></a> | 
						<a href="#" onClick="select_buttons_appbox(false);return false;"><?php esc_html_e('None', 'wp-appbox'); ?></a>
					</small><?php } ?>
				</td>
				<td style="width: 130px; text-align:center;">
					<?php esc_html_e('WYSIWYG-View', 'wp-appbox'); ?>
					<?php if ( $th_count == 0 ) { ?><br /><small>
						<a href="#" onClick="select_buttons_alone(true);return false;"><?php esc_html_e('All', 'wp-appbox'); ?></a> | 
						<a href="#" onClick="select_buttons_alone(false);return false;"><?php esc_html_e('None', 'wp-appbox'); ?></a>
					</small><?php } ?>
				</td>
				<td style="width: 130px; text-align:center;">
					<?php esc_html_e('HTML-View', 'wp-appbox'); ?>
					<?php if ( $th_count == 0 ) { ?><br /><small>
						<a href="#" onClick="select_buttons_text(true);return false;"><?php esc_html_e('All', 'wp-appbox'); ?></a> | 
						<a href="#" onClick="select_buttons_text(false);return false;"><?php esc_html_e('None', 'wp-appbox'); ?></a>
					</small><?php } ?>
				</td>
				<td style="width: 130px; text-align:center;">
					<?php esc_html_e('Hide button', 'wp-appbox'); ?>
					<?php if ( $th_count == 0 ) { ?><br /><small>
						<a href="#" onClick="select_buttons_hidden(true);return false;"><?php esc_html_e('All', 'wp-appbox'); ?></a> | 
						<a href="#" onClick="select_buttons_hidden(false);return false;"><?php esc_html_e('None', 'wp-appbox'); ?></a>
					</small><?php } ?>
				</td>
				<td></td>
			</tr>
			
		<?php } ?>
		
		<tr valign="top">
			<th scope="row"><label for="button_<?php esc_attr_e( $storeID ); ?>"><?php esc_attr_e( $wpAppbox_storeNames[$storeID] ); ?></label></th>
			<td style="text-align:center;">
				<input name="wpAppbox_buttonAppbox_<?php esc_attr_e( $storeID ); ?>" <?php checked( get_option("wpAppbox_buttonAppbox_$storeID") ); ?><?php if ( get_option("wpAppbox_buttonHidden_$storeID") ): ?> disabled="disabled" <?php endif; ?>type="checkbox" id="wpAppbox_buttonAppbox_<?php esc_attr_e( $storeID ); ?>" value="1" />
			</td>	
			<td style="text-align:center;">
				<input name="wpAppbox_buttonWYSIWYG_<?php esc_attr_e( $storeID ); ?>" <?php checked( get_option("wpAppbox_buttonWYSIWYG_$storeID") ); ?><?php if ( get_option("wpAppbox_buttonHidden_$storeID") ): ?> disabled="disabled" <?php endif; ?>type="checkbox" id="wpAppbox_buttonWYSIWYG_<?php esc_attr_e( $storeID ); ?>" value="1" />
			</td>	
			<td style="text-align:center;">
				<input name="wpAppbox_buttonHTML_<?php esc_attr_e( $storeID ); ?>" <?php checked( get_option("wpAppbox_buttonHTML_$storeID") ); ?><?php if ( get_option("wpAppbox_buttonHidden_$storeID") ): ?> disabled="disabled" <?php endif; ?>type="checkbox" id="wpAppbox_buttonHTML_<?php esc_attr_e( $storeID ); ?>" value="1" />
			</td>	
			<td style="text-align:center;">
				<input name="wpAppbox_buttonHidden_<?php esc_attr_e( $storeID ); ?>" <?php checked( get_option("wpAppbox_buttonHidden_$storeID") ); ?> type="checkbox" id="wpAppbox_buttonHidden_<?php esc_attr_e( $storeID ); ?>" onClick="javascript:disable_enable_checkboxes('<?php esc_attr_e( $storeID ); ?>')" value="1" />
			</td>	
		</tr>
		
	<?php } ?>
	
	<tr valign="top">
		<th scope="row"></th>
		<td style="width: 130px; text-align:center;"><?php esc_html_e('Appbox-Button', 'wp-appbox'); ?></td>
		<td style="width: 130px; text-align:center;"><?php esc_html_e('WYSIWYG-View', 'wp-appbox'); ?></td>
		<td style="width: 130px; text-align:center;"><?php esc_html_e('HTML-View', 'wp-appbox'); ?></td>
		<td style="width: 130px; text-align:center;"><?php esc_html_e('Hide button', 'wp-appbox'); ?></td>
		<td></td>
	</tr>
	
</table>

<script>
	function disable_enable_checkboxes(store) {
		var status = document.getElementById("wpAppbox_buttonHidden_"+store).checked;
		var checkbox1 = document.getElementById("wpAppbox_buttonAppbox_"+store);
		var checkbox2 = document.getElementById("wpAppbox_buttonWYSIWYG_"+store);
		var checkbox3 = document.getElementById("wpAppbox_buttonHTML_"+store);
		checkbox1.disabled = status;
		checkbox2.disabled = status;
		checkbox3.disabled = status;
		if( status == true ) {
			checkbox1.checked = false;
			checkbox2.checked = false;
			checkbox3.checked = false;
		}
	}
	function show_hide_table() {
		var status = document.getElementById("wpAppbox_defaultButton").selectedIndex;
		var table = document.getElementById("table_buttons_settings");
		var toolbar = document.getElementById("form_advancedToolbar");
		if( status == "3" ) { table.style.display = ""; }
		else { table.style.display = "none"; }
		if( status == "2" ) { toolbar.style.display = "none"; }
		else { toolbar.style.display = ""; }
	}
	function select_buttons_appbox(status) {
		<?php foreach ( $wpAppbox_storeNames as $storeID => $storeName ) { ?>
			var checkbox_<?php echo esc_js( $storeID ); ?> = document.getElementById("wpAppbox_buttonAppbox_<?php echo esc_js( $storeID ); ?>");
			checkbox_<?php echo esc_js( $storeID ); ?>.checked = status;
		<?php } ?>
	}
	function select_buttons_text(status) {
		<?php foreach ( $wpAppbox_storeNames as $storeID => $storeName ) { ?>
			var checkbox_<?php echo esc_js( $storeID ); ?> = document.getElementById("wpAppbox_buttonHTML_<?php echo esc_js( $storeID ); ?>");
			checkbox_<?php echo esc_js( $storeID ); ?>.checked = status;
		<?php } ?>
	}
	function select_buttons_alone(status) {
		<?php foreach ( $wpAppbox_storeNames as $storeID => $storeName ) { ?>
			var checkbox_<?php echo esc_js( $storeID ); ?> = document.getElementById("wpAppbox_buttonWYSIWYG_<?php echo esc_js( $storeID ); ?>");
			checkbox_<?php echo esc_js( $storeID ); ?>.checked = status;
		<?php } ?>
	}
	function select_buttons_hidden(status) {
		<?php foreach ( $wpAppbox_storeNames as $storeID => $storeName ) { ?>
			var checkbox_<?php echo esc_js( $storeID ); ?> = document.getElementById("wpAppbox_buttonHidden_<?php echo esc_js( $storeID ); ?>");
			var checkbox1_<?php echo esc_js( $storeID ); ?> = document.getElementById("wpAppbox_buttonAppbox_<?php echo esc_js( $storeID ); ?>");
			var checkbox2_<?php echo esc_js( $storeID ); ?> = document.getElementById("wpAppbox_buttonWYSIWYG_<?php echo esc_js( $storeID ); ?>");
			var checkbox3_<?php echo esc_js( $storeID ); ?> = document.getElementById("wpAppbox_buttonHTML_<?php echo esc_js( $storeID ); ?>");
			checkbox_<?php echo esc_js( $storeID ); ?>.checked = status;
			checkbox1_<?php echo esc_js( $storeID ); ?>.disabled = status;
			checkbox2_<?php echo esc_js( $storeID ); ?>.disabled = status;
			checkbox3_<?php echo esc_js( $storeID ); ?>.disabled = status;
			if(status == true) {
				checkbox1_<?php echo esc_js( $storeID ); ?>.checked = false;
				checkbox2_<?php echo esc_js( $storeID ); ?>.checked = false;
				checkbox3_<?php echo esc_js( $storeID ); ?>.checked = false;
			}
		<?php } ?>
	}
</script>