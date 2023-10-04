<div class="wpa-infobox wpa-notice">
    <p><?php esc_html_e( 'Some advanced and experimental options for users, who want to configure a little bit more.', 'wp-appbox' ); ?> ;-)</p>
</div>

<h3><?php esc_html_e( 'Miscellaneous settings', 'wp-appbox' ); ?></h3>

<table class="form-table">

	<tr valign="top">
		<th scope="row"><label for="wpAppbox_autoLinks"><?php esc_html_e( 'Auto-detect', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_autoLinks">
				<input type="checkbox" name="wpAppbox_autoLinks" id="wpAppbox_autoLinks" value="1" <?php checked( get_option('wpAppbox_autoLinks') ); ?>/>
				<?php esc_html_e( 'Detect urls of apps in a separated line within the post.', 'wp-appbox' ); ?>
			</label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_anonymizeLinks"><?php esc_html_e( 'Anonymize URLs', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_anonymizeLinks">
				<input type="checkbox" name="wpAppbox_anonymizeLinks" id="wpAppbox_anonymizeLinks" value="1" <?php checked( get_option('wpAppbox_anonymizeLinks') ); ?>/>
				<?php esc_html_e( 'Anonymizes outgoing URLs via Anon.to - removes referer.', 'wp-appbox' ); ?>
			</label>
		</td>
	</tr>
	
	<?php if ( function_exists( 'register_block_type' ) ): ?>
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_renderGutenberg"><?php esc_html_e( 'Gutenberg', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_renderGutenberg">
				<input type="checkbox" name="wpAppbox_renderGutenberg" id="wpAppbox_renderGutenberg" value="1" <?php checked( get_option('wpAppbox_renderGutenberg') ); ?>/>
				<?php esc_html_e( 'Render the output of the appboxes in Gutenberg as a preview', 'wp-appbox' ); ?> (<?php esc_html_e( 'Experimental', 'wp-appbox' ); ?>)
			</label>
		</td>
	</tr>
	<?php endif; ?>
	
</table>

<hr />

<h3><?php esc_html_e( 'Stylesheets and Scripts', 'wp-appbox' ); ?></h3>

<table class="form-table">
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_includeCSS"><?php esc_html_e( 'Plugin stylesheet', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<select name="wpAppbox_includeCSS" id="wpAppbox_includeCSS" class="postform" style="min-width:220px;">
				<option class="level-0" value="1" <?php selected( get_option('wpAppbox_includeCSS'), '1' ); ?>><?php esc_html_e( 'Never enqueue plugin stylesheet', 'wp-appbox' ); ?></option> 
				<option class="level-0" value="2" <?php selected( get_option('wpAppbox_includeCSS'), '2' ); ?>><?php printf( esc_html__( 'Enqueue only on posts and pages (uses %1$1s)', 'wp-appbox' ), '<a href="https://developer.wordpress.org/reference/functions/is_singular/" target="_blank">if_singular()</a>' ); ?></option>
				<option class="level-0" value="0" <?php selected( get_option('wpAppbox_includeCSS'), '0' ); ?>><?php esc_html_e( 'Default', 'wp-appbox' ); ?></option>
			</select>
			<label for="wpAppbox_includeCSS"><?php esc_html_e( 'Configure the enqueueing of the plugin stylesheet.', 'wp-appbox' ); ?></label>
		</td>
	</tr>
		
	<tr valign="top" class="wpAppbox_disableDefer" <?php if( get_option( 'wpAppbox_includeCSS' ) == 1 ): ?> style="display:none;"<?php endif; ?>>
		<th scope="row"><label for="wpAppbox_disableDefer"><?php esc_html_e( 'Lean loading', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_disableDefer">
				<input type="checkbox" name="wpAppbox_disableDefer" id="wpAppbox_disableDefer" value="1" <?php checked( get_option('wpAppbox_disableDefer') ); ?>/>
					<?php esc_html_e( 'Disables lean loading and loads stylesheet and font within the header.', 'wp-appbox' ); ?>
			</label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_disableFonts"><?php esc_html_e( 'Google Fonts', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_disableFonts">
				<input type="checkbox" name="wpAppbox_disableFonts" id="wpAppbox_disableFonts" value="1" <?php checked( get_option('wpAppbox_disableFonts') ); ?>/>
				<?php esc_html_e( 'Avoid loading of Google Fonts (OpenSans) through WP-Appbox.', 'wp-appbox' ); ?>
			</label>
		</td>
	</tr>
	
</table>

<hr />

<h3><?php esc_html_e( 'Error output & troubleshooting', 'wp-appbox' ); ?></h3>

<table class="form-table">

	<tr valign="top">
		<th scope="row"><label for="wpAppbox_curlTimeout"><?php esc_html_e( 'Server timeout', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_curlTimeout">
				<input type="number" pattern="[0-9]*" name="wpAppbox_curlTimeout" id="wpAppbox_curlTimeout" value="<?php esc_attr_e( get_option('wpAppbox_curlTimeout') ); ?>" />
				<?php printf( esc_html__( 'The recommended timeout is %1$1s seconds. Only change if apps are not found.', 'wp-appbox' ), '<strong>5</strong>' ); ?>
			</label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_eOnlyAuthors"><?php esc_html_e( 'Error messages', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_eOnlyAuthors">
				<input type="checkbox" name="wpAppbox_eOnlyAuthors" id="wpAppbox_eOnlyAuthors" value="1" <?php checked( get_option('wpAppbox_eOnlyAuthors') ); ?>/>
				<?php esc_html_e( 'Show "App not found"-badges only for authors.', 'wp-appbox' ); ?>
			</label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_eOutput"><?php esc_html_e( 'Error output', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_eOutput">
				<select name="wpAppbox_eOutput" id="wpAppbox_eOutput" class="postform">
				  	<option <?php selected( get_option('wpAppbox_eOutput'), '0' ); ?> class="level-0" value="0"><?php esc_html_e( 'Disabled', 'wp-appbox' ); ?></option>
				  	<option <?php selected( get_option('wpAppbox_eOutput'), 'output' ); ?> class="level-0" value="output"><?php esc_html_e( 'Only print on site', 'wp-appbox' ); ?></option>
				  	<option <?php selected( get_option('wpAppbox_eOutput'), 'errorlog' ); ?> class="level-0" value="errorlog"><?php esc_html_e( 'Only to the web server \'s PHP error log', 'wp-appbox' ); ?></option>
				  	<option <?php selected( get_option('wpAppbox_eOutput'), 'output+errorlog' ); ?> class="level-0" value="output+errorlog"><?php esc_html_e( 'Print on site and to the web server\'s PHP error log', 'wp-appbox' ); ?></option>
				</select>
				<?php esc_html_e( 'Activate error output. (Note: "Print on site" is only visible to administrators)', 'wp-appbox' ); ?>
			</label>
		</td>
	</tr>
	
	<?php if ( !is_ssl() ): ?>
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_forceSSL"><?php esc_html_e( 'Force SSL', 'wp-appbox' ); ?>:</label></th>
		<td>	
			<label for="wpAppbox_forceSSL">
				<input type="checkbox" name="wpAppbox_forceSSL" id="wpAppbox_forceSSL" value="1" <?php checked( get_option('wpAppbox_forceSSL') ); ?>/>
				<?php printf( wp_kses( __( 'Force SSL output (for some reasons <a href="%s">is_ssl()</a> is buggy)', 'wp-appbox' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( 'https://codex.wordpress.org/Function_Reference/is_ssl' ) ); ?>
				.
			</label>
		</td>
	</tr>
	<?php endif; ?>
	
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Reset', 'wp-appbox' ); ?>:</th>
		<td>	
			<p><?php esc_html_e( 'For some issues, it may help to flush the database tables.', 'wp-appbox' ); ?> <a href="javascript:;" style="text-decoration:none;" id="switchResetOptions"><?php esc_html_e( 'Show options', 'wp-appbox' ); ?> ⤵</a></p>
			<div style="display:none;margin-top:8px;" id="wpAppbox_resetCache">
				<a class="button action" style="margin-right: 10px"; href="/wp-admin/options-general.php?page=wp-appbox&tab=<?php esc_attr_e( $_GET['tab'] ); ?>&flushcache" onClick="return confirm('<?php esc_html_e( 'Are you sure that the cache should be cleared? All data must be reloaded from the server of the operator.', 'wp-appbox' ); ?>')"><?php esc_html_e( 'Clear cache', 'wp-appbox' ); ?></a>
				<?php if ( wpAppbox_imageCache::quickcheckImageCache() ): ?>
				<a class="button action" style="margin-right: 10px"; href="/wp-admin/options-general.php?page=wp-appbox&tab=<?php esc_attr_e( $_GET['tab'] ); ?>&flushimgcache" onClick="return confirm('<?php esc_html_e( 'Are you sure that all cached images should be deleted? All images must be reloaded from the server of the operator.', 'wp-appbox' ); ?>')"><?php esc_html_e( 'Clear image cache', 'wp-appbox' ); ?></a>
				<a class="button action" style="margin-right: 10px"; href="/wp-admin/options-general.php?page=wp-appbox&tab=<?php esc_attr_e( $_GET['tab'] ); ?>&cleanupimagefolder" onClick="return confirm('<?php esc_html_e( 'Are you sure you want to clean up the folder with cached images?', 'wp-appbox' ); ?>')"><?php esc_html_e( 'Cleanup image folder', 'wp-appbox' ); ?></a><?php endif; ?>
				<a class="button action" style="margin-right: 10px"; href="/wp-admin/options-general.php?page=wp-appbox&tab=<?php esc_attr_e( $_GET['tab'] ); ?>&resetdeprecated" onClick="return confirm('<?php esc_html_e( 'Are you sure that all deprecated apps should be reset and marked as available?', 'wp-appbox' ); ?>')"><?php esc_html_e( 'Reset deprecated apps', 'wp-appbox' ); ?></a>
				<a class="button action" style="margin-right: 10px"; href="/wp-admin/options-general.php?page=wp-appbox&tab=<?php esc_attr_e( $_GET['tab'] ); ?>&resetblockedqueries" onClick="return confirm('<?php esc_html_e( 'Are you sure that all blocked queries should be reset?', 'wp-appbox' ); ?>')"><?php esc_html_e( 'Reset blocked queries', 'wp-appbox' ); ?></a>
			</div>
		</td>
	</tr>
	
</table>

<?php if ( !wpAppbox_imageCache::checkImageCache() || !get_option( 'wpAppbox_imgCache' ) || 3 != count( get_option('wpAppbox_imgCacheMode') ) ): ?>

<hr />

<h3><?php esc_html_e( 'Experimental settings', 'wp-appbox' ); ?></h3>

<table class="form-table">	
	
	<?php if ( !wpAppbox_imageCache::checkImageCache() || !get_option( 'wpAppbox_imgCache' ) || 3 != count( get_option('wpAppbox_imgCacheMode') ) ): ?>
		<?php if ( ini_get( 'allow_url_fopen' ) ): ?>
			<tr valign="top">
				<th scope="row"><label for="wpAppbox_imgProxy"><?php esc_html_e( 'Remote images', 'wp-appbox' ); ?>:</label></th>
				<td>	
					<label for="wpAppbox_imgProxy">
						<input type="checkbox" name="wpAppbox_imgProxy" id="wpAppbox_imgProxy" value="1" <?php checked( get_option('wpAppbox_imgProxy') ); ?>/>
						<?php esc_html_e( 'Displays external images as a data URI (base64). Warning: Needs much more resources.', 'wp-appbox' ); ?> <?php esc_html_e( 'Compliant with GDPR.', 'wp-appbox' ); ?>
					</label>
				</td>
			</tr>
		<?php else: ?>
			<tr valign="top">
				<th scope="row"><label for="wpAppbox_imgProxy"><?php esc_html_e( 'Remote images', 'wp-appbox' ); ?>:</label></th>
				<td>	
					<label for="wpAppbox_imgProxy">
						<input disabled="disabled" type="checkbox" name="wpAppbox_imgProxy" id="wpAppbox_imgProxy" value="1" />
						<span style="opacity:0.5;"><?php printf( esc_html__( '%1$1s is disabled on this web server. Please activate this function to use the Image Proxy.', 'wp-appbox' ), '<a href="https://www.php.net/manual/de/filesystem.configuration.php#ini.allow-url-fopen" target="_blank">allow_url_fopen</a>' ); ?></span>
					</label>
				</td>
			</tr>
		<?php endif; ?>
	<?php endif; ?>
	
</table>

<?php endif; ?>


<script>

	$j=jQuery.noConflict();
	
	$j("#wpAppbox_amaAPIuse").click(function () {
		if ( $j(this).attr('checked') ) {
			$j('tr.amaAPItr').show();
		} else {
			$j('tr.amaAPItr').hide();
		}
	} );
	
	$j("#wpAppbox_includeCSS").change(function () {
		if ( this.value == '1' ) {
			$j('.wpAppbox_disableDefer').hide();
		} else {
			$j('.wpAppbox_disableDefer').show();
		}
	} );
	
	$j("#switchResetOptions").click(function () {
		if ( $j('#wpAppbox_resetCache').is(":visible")  ) {
			$j('#wpAppbox_resetCache').hide();
			$j("#switchResetOptions").text('<?php esc_html_e( 'Show options', 'wp-appbox' ); ?> ⤵');
		} else {
			$j('#wpAppbox_resetCache').show();
			$j("#switchResetOptions").text('<?php esc_html_e( 'Hide options', 'wp-appbox' ); ?> ⤴');
		}
	} );
		
</script>