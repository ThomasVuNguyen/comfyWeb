<?php

global $wpAppbox_optionsDefault;

function wpAppbox_checkIfCachePlugin() {
	$cachePlugin = '';
	if ( has_action( 'cachify_remove_post_cache' ) ) {
		$cachePlugin = 'cachify';
	}
	else if ( function_exists( 'w3tc_pgcache_flush_post' ) ) {
		$cachePlugin = 'W3 Total Cache';
	}
	else if ( function_exists( 'wp_cache_post_change' ) ) {
		$cachePlugin = 'WP Super Cache';
	}
	else if ( function_exists( 'rocket_clean_post' ) ) {
		$cachePlugin = 'WP Rocket';
	}
	else if ( isset( $GLOBALS['wp_fastest_cache'] ) && method_exists( $GLOBALS['wp_fastest_cache'], 'singleDeleteCache' ) ) {
		$cachePlugin = 'WP Fastest Cache';
	}
	else if ( isset( $GLOBALS['zencache'] ) && method_exists( $GLOBALS['zencache'], 'auto_clear_post_cache' ) ) {
		$cachePlugin = 'ZenCache';
	}	
	else if ( has_action( 'ce_clear_post_cache' ) ) {
	    $cachePlugin = 'Cache Enabler';
	}
	return( $cachePlugin );
}
	
?>

<div class="wpa-infobox wpa-notice">
    <p><?php esc_html_e('The caching interval indicate how often the data is updated from the server - this increases the performance, and should not really be changed.', 'wp-appbox'); ?></p>
</div>

<h3><?php esc_html_e('General caching settings', 'wp-appbox'); ?></h3>

<table class="form-table">
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_cacheTime"><?php esc_html_e('Cache expiry', 'wp-appbox'); ?>:</label></th>
		<td>
			<input type="number" pattern="[0-9]*" name="wpAppbox_cacheTime" id="wpAppbox_cacheTime" value="<?php esc_attr_e( get_option('wpAppbox_cacheTime') ); ?>" /> <label for="wpAppbox_cacheTime"><?php printf( esc_html__( 'The recommended interval is %1$s minutes.', 'wp-appbox' ), '<strong>' . esc_html( $wpAppbox_optionsDefault['cacheTime'] ) . '</strong>' ); ?></label>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="wpAppbox_cacheMode"><?php esc_html_e('Mode for auto caching', 'wp-appbox'); ?>:</label></th>
		<td>
			<select name="wpAppbox_cacheMode" id="wpAppbox_cacheMode" class="postform">
				<option <?php selected( get_option('wpAppbox_cacheMode'), 'all' ); ?> class="level-0" value="all"><?php esc_html_e('Every page impresssion, if cache has expired', 'wp-appbox'); ?> (<?php esc_html_e('Default', 'wp-appbox'); ?>)</option>
				<option <?php selected( get_option('wpAppbox_cacheMode'), 'loggedin' ); ?> class="level-0" value="loggedin"><?php esc_html_e('Only for registered users (at least author), if cache is outdated', 'wp-appbox'); ?></option>
				<option <?php selected( get_option('wpAppbox_cacheMode'), 'manually' ); ?> class="level-0" value="manually"><?php esc_html_e('Only manually using the button, visible for logged in users only', 'wp-appbox'); ?></option>
				<?php if( !defined( 'DISABLE_WP_CRON') || DISABLE_WP_CRON != true ): ?><option <?php selected( get_option('wpAppbox_cacheMode'), 'cronjob' ); ?> class="level-0" value="cronjob"><?php esc_html_e('Update automatically via Cronjob and manually', 'wp-appbox'); ?></option><?php endif; ?>
			</select>
			<label for="wpAppbox_cacheMode"><?php esc_html_e('Mode which is used to renew the data of an app (depending on cache time settings)', 'wp-appbox'); ?></label>
		</td>
	</tr>
	
	<tr valign="top" class="cronSettings" <?php if( 'cronjob' != get_option( 'wpAppbox_cacheMode' ) ): ?> style="display:none;"<?php endif; ?>>
		<th scope="row"><label for="wpAppbox_cronjobSettings"><?php esc_html_e('Cronjob settings', 'wp-appbox'); ?>:</label></th>
		<td>
			<label for="wpAppbox_cronjobSettings">
				<?php printf( esc_html__( 'Run the cronjob every %1$s minutes and update %2$s expired apps at once', 'wp-appbox' ), '<input type="number" style="width: 70px;" pattern="[0-9]*" name="wpAppbox_cronIntervall" id="wpAppbox_cronIntervall" value="' . esc_attr( get_option('wpAppbox_cronIntervall') ) . '" />', '<input type="number" style="width: 55px;" pattern="[0-9]*" name="wpAppbox_cronCount" id="wpAppbox_cronCount" value="' . esc_attr( get_option('wpAppbox_cronCount') ) . '" />' ); ?>. <?php printf( esc_html__( 'Default values are %1$s minutes and %2$s apps at once.', 'wp-appbox' ), '<strong>' . $wpAppbox_optionsDefault['cronIntervall'] . '</strong>', '<strong>' . $wpAppbox_optionsDefault['cronCount'] . '</strong>' ); ?>
			</label>
			<p style="margin-top:.9em;"><strong><?php _e( 'Please note', 'wp-appbox' ); ?>:</strong> <?php _e( 'The higher the values the higher the server capacity utilisation and the queries to the external store servers. Don\'t forget: you could still update the cache of an app manually.', 'wp-appbox' ); ?></p>
		</td>
	</tr>
	
	<?php if( !defined( 'DISABLE_WP_CRON') || DISABLE_WP_CRON != true ): ?>
	<?php endif; ?>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_cachePlugin"><?php esc_html_e('Clear Post-Cache', 'wp-appbox'); ?>:</label></th>
		<td colspan="7">
			<select name="wpAppbox_cachePlugin" id="wpAppbox_cachePlugin" class="postform">
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), '0' ); ?> class="level-0" value="0">--------- <?php esc_html_e('Disabled', 'wp-appbox'); ?> ---------</option>
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), 'cachify' ); ?> class="level-0" value="cachify"><?php esc_html_e('Plugin', 'wp-appbox'); ?>: <?php esc_html_e('Cachify', 'wp-appbox'); ?></option>
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), 'w3-total-cache' ); ?> class="level-0" value="w3-total-cache"><?php esc_html_e('Plugin', 'wp-appbox'); ?>: <?php esc_html_e('W3 Total Cache', 'wp-appbox'); ?></option>
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), 'wp-super-cache' ); ?> class="level-0" value="wp-super-cache"><?php esc_html_e('Plugin', 'wp-appbox'); ?>: <?php esc_html_e('WP Super Cache', 'wp-appbox'); ?></option>
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), 'wp-rocket' ); ?> class="level-0" value="wp-rocket"><?php esc_html_e('Plugin', 'wp-appbox'); ?>: <?php esc_html_e('WP Rocket', 'wp-appbox'); ?></option>
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), 'wp-fastest-cache' ); ?> class="level-0" value="wp-fastest-cache"><?php esc_html_e('Plugin', 'wp-appbox'); ?>: <?php esc_html_e('WP Fastest Cache', 'wp-appbox'); ?></option>
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), 'zencache' ); ?> class="level-0" value="zencache"><?php esc_html_e('Plugin', 'wp-appbox'); ?>: <?php esc_html_e('ZenCache', 'wp-appbox'); ?></option>
			  	<option <?php selected( get_option('wpAppbox_cachePlugin'), 'cache-enabler' ); ?> class="level-0" value="cache-enabler"><?php esc_html_e('Plugin', 'wp-appbox'); ?>: <?php esc_html_e('Cache Enabler', 'wp-appbox'); ?></option>
			</select>
			<label for="wpAppbox_cachePlugin"><?php esc_html_e('Clears the post-cache of 3rd-party-plugins (only manually via the "Reload"-link)', 'wp-appbox'); ?></label>
		</td>
	</tr>
		
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_blockMissing"><?php esc_html_e('Apps not found', 'wp-appbox'); ?>:</label></th>
		<td>
			<label for="wpAppbox_blockMissing">
				<input type="checkbox" name="wpAppbox_blockMissing" id="wpAppbox_blockMissing" value="1" <?php checked( get_option('wpAppbox_blockMissing') ); ?>/>
				<?php esc_html_e('Block queries for missing apps', 'wp-appbox'); ?> 
			</label>
			<label for="wpAppbox_blockMissingTime" <?php if( true != get_option( 'wpAppbox_blockMissing' ) ): ?> style="display:none;"<?php endif; ?>>
				<?php printf( esc_html__( 'for %1$s minutes', 'wp-appbox' ), '<input type="number" style="width: 65px;" pattern="[0-9]*" name="wpAppbox_blockMissingTime" id="wpAppbox_blockMissingTime" value="' . esc_attr( get_option('wpAppbox_blockMissingTime') ) . '" />' ); ?>
			</label>
		</td>
	</tr>

</table>

<hr />

<h3><?php esc_html_e('Image caching', 'wp-appbox'); ?></h3>

<table class="form-table">

	<tr valign="top">
		<th scope="row"><label for="wpAppbox_imgCache"><?php esc_html_e('Activate image caching', 'wp-appbox'); ?>:</label></th>
		<td colspan="7">
			<label for="wpAppbox_imgCache">
				<input type="checkbox" name="wpAppbox_imgCache" id="wpAppbox_imgCache" value="1" <?php checked( get_option('wpAppbox_imgCache') ); ?>/>
				<?php printf( esc_html__( 'Cache app images on your own server (needs more resources when caching an app). Images are saved outside the media library in the "%1$s" folder.', 'wp-appbox' ), '<i>cache/wp-appbox</I>' ); ?> 
			</label>
		</td>
	</tr>
	
	<tr valign="top" class="imgCachingMode" <?php if ( true != get_option( 'wpAppbox_imgCache' ) ): ?> style="display:none;"<?php endif; ?>>
		<?php $imageCache = new wpAppbox_imageCache; ?>
		<th scope="row"><label for="wpAppbox_imgCacheMode"><?php esc_html_e('Image caching', 'wp-appbox'); ?>:</label></th>
		<td colspan="7">
			<label for="wpAppbox_imgCacheMode_AppIcons" style="margin-right:20px;">
				<input <?php checked( $imageCache->checkImageCacheType( 'appicon' ) ); ?> type="checkbox" id="wpAppbox_imgCacheMode_AppIcons" name="wpAppbox_imgCacheMode[]" value="appicon" /> <?php esc_html_e('App icons', 'wp-appbox'); ?>
			</label>
			<label for="wpAppbox_imgCacheMode_Screenshots" style="margin-right:20px;">
				<input <?php checked( $imageCache->checkImageCacheType( 'screenshots' ) ); ?> type="checkbox" id="wpAppbox_imgCacheMode_Screenshots" name="wpAppbox_imgCacheMode[]" value="screenshots" /> <?php esc_html_e('App screenshots', 'wp-appbox'); ?>
			</label>
			<label for="wpAppbox_imgCacheMode_QRcodes" style="margin-right:30px;">
				<input <?php checked( $imageCache->checkImageCacheType( 'qrcode' ) ); ?> type="checkbox" id="wpAppbox_imgCacheMode_QRcodes" name="wpAppbox_imgCacheMode[]" value="qrcode" /> <?php esc_html_e('QR codes', 'wp-appbox'); ?>
			</label>
			<?php esc_html_e('Which app images should be cached?', 'wp-appbox'); ?>
			</label>
		</td>
	</tr>
		
	<tr valign="top" class="imgCachingDelay" <?php if( true != get_option( 'wpAppbox_imgCache' ) ): ?> style="display:none;"<?php endif; ?>>
		<th scope="row"><label for="wpAppbox_imgCacheDelay"><?php esc_html_e('Delayed clearing', 'wp-appbox'); ?>:</label></th>
		<td>
			<label for="wpAppbox_imgCacheDelay">
				<input type="checkbox" name="wpAppbox_imgCacheDelay" id="wpAppbox_imgCacheDelay" value="1" <?php checked( get_option('wpAppbox_imgCacheDelay') ); ?>/>
				<?php esc_html_e('Keep outdated images', 'wp-appbox'); ?> 
			</label>
			<label for="wpAppbox_imgCacheDelayTime" <?php if( true != get_option( 'wpAppbox_imgCacheDelay' ) ): ?> style="display:none;"<?php endif; ?>> 
				<?php printf( esc_html__( 'for %1$s more hours (set expiry of your plugin)', 'wp-appbox' ), '<input type="number" style="width: 65px;" pattern="[0-9]*" name="wpAppbox_imgCacheDelayTime" id="wpAppbox_imgCacheDelayTime" value="' . esc_attr( get_option('wpAppbox_imgCacheDelayTime') ) . '" />' ); ?>
			</label>
			<label for ="wpAppbox_imgCacheDelay"> 
				 <?php esc_html_e('to prevent missing images in combination with a caching plugin', 'wp-appbox'); ?> 
			</label>
		</td>
	</tr>
	
</table>


<script>

	$j=jQuery.noConflict();
	
	$j("#wpAppbox_blockMissing").click(function () {
		if ( $j(this).attr('checked') ) {
			$j("label[for='wpAppbox_blockMissingTime']").show();
		} else {
			$j("label[for='wpAppbox_blockMissingTime']").hide();
		}
	} );
	
	$j("#wpAppbox_cacheMode").change(function () {
		if ( this.value == 'cronjob' ) {
			$j('.cronSettings').show();
		} else {
			$j('.cronSettings').hide();
		}
	} );
	
	$j("#wpAppbox_imgCache").change(function () {
		var success = true;
		if ( $j(this).is(":checked") ) {
			$j('.imgCachingMode').show();
			$j('.imgCachingDelay').show();
		} else {
			$j('.imgCachingMode').hide();
			$j('.imgCachingDelay').hide();
		}
		<?php if ( get_option('wpAppbox_imgCache') ): ?>
			if ( !$j(this).is(":checked") ) {
				success = confirm( '<?php _e( 'Do you want to deactivate the image caching? All local images will be deleted.', 'wp-appbox' ); ?>' );
			}
			if (success == false) {
				$j(this).prop( 'checked', !$j(this).prop('checked') );
			}
		<?php endif; ?>
	});
	
	$j("#wpAppbox_imgCacheDelay").click(function () {
		if ( $j(this).attr('checked') ) {
			$j('.imgCacheDelayTime').show();
			$j("label[for='wpAppbox_imgCacheDelayTime']").show();
		} else {
			$j('.imgCacheDelayTime').hide();
			$j("label[for='wpAppbox_imgCacheDelayTime']").hide();
		}
	} );
	
</script>