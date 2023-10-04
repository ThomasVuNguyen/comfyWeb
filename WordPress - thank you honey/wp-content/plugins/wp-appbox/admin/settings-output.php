<div class="wpa-infobox wpa-notice">
    <p><?php esc_html_e('Some general output options for rendered Appboxes. For your interest: You could style the look of rendered Appboxes within your themes\'s stylesheets.', 'wp-appbox'); ?></p>
</div>

<table class="form-table ">

	<tr valign="top">
		<th scope="row"><label for="wpAppbox_defaultStyle"><?php esc_html_e('Standard App-Badge', 'wp-appbox'); ?>:</label></th>
		<td colspan="7">
			<select name="wpAppbox_defaultStyle" id="wpAppbox_defaultStyle" class="postform" style="min-width:220px;">
			   <option class="level-0" value="1" <?php selected( get_option('wpAppbox_defaultStyle'), '1' ); ?>><?php esc_html_e('Simple Badge', 'wp-appbox'); ?> (<?php esc_html_e('Default', 'wp-appbox'); ?>)</option> 
			   <option class="level-0" value="3" <?php selected( get_option('wpAppbox_defaultStyle'), '3' ); ?>><?php esc_html_e('Screenshots', 'wp-appbox'); ?></option>
			   <option class="level-0" value="4" <?php selected( get_option('wpAppbox_defaultStyle'), '4' ); ?>><?php esc_html_e('Screenshots Only', 'wp-appbox'); ?></option>
			   <option class="level-0" value="2" <?php selected( get_option('wpAppbox_defaultStyle'), '2' ); ?>><?php esc_html_e('Compact Badge', 'wp-appbox'); ?></option> 
			</select>
			<label for="wpAppbox_defaultStyle"><?php esc_html_e('What app banners to be used in operation without format specification within the shortcodes?', 'wp-appbox'); ?></label>
			<br /><br />
			<img id="wpAppbox_bannerPreview" src="<?php esc_attr_e( plugins_url( 'img/admin-previews/banner-' . $wpAppbox_styleNames[get_option('wpAppbox_defaultStyle')] . '.jpg', dirname( __FILE__ ) ) ); ?>" style="width:350px;" />
			<script>
				jQuery( "#wpAppbox_defaultStyle" ).change(function() {
					value = jQuery(this).val();
					<?php
						foreach ( $wpAppbox_styleNames as $styleID => $styleName ) {
							echo esc_js( "value$styleID = '" . plugins_url( 'img/admin-previews/banner-' . $styleName . '.jpg', dirname( __FILE__ ) ) ) . "';";
						}
					?>
					jQuery("#wpAppbox_bannerPreview").attr( "src", eval('value'+value) );
				});
			</script>
		</td>
	</tr>
	
	<!--<tr valign="top">
		<th scope="row"><label for="wpAppbox_screenshotTabs"><?php esc_html_e( 'Tabs for screenshots', 'wp-appbox'); ?>:</label></th>
		<td>	
			<label for="wpAppbox_screenshotTabs">
				<input type="checkbox" name="wpAppbox_screenshotTabs" id="wpAppbox_screenshotTabs" value="1" <?php checked( get_option('wpAppbox_screenshotTabs') ); ?>/>
				<?php esc_html_e('Show tabs in screenshot badges if more than one device (e.g. iPhone and iPad)', 'wp-appbox'); ?>
			</label>
		</td>
	</tr>-->
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_colorfulIcons"><?php esc_html_e('Colored store icons', 'wp-appbox'); ?>:</label></th>
		<td>	
			<label for="wpAppbox_colorfulIcons">
				<input type="checkbox" name="wpAppbox_colorfulIcons" id="wpAppbox_colorfulIcons" value="1" <?php checked( get_option('wpAppbox_colorfulIcons') ); ?>/>
				<?php esc_html_e('Show colored icons of the stores instead of the grey ones', 'wp-appbox'); ?>
			</label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_dontGreyOut"><?php esc_html_e('Not available apps', 'wp-appbox'); ?>:</label></th>
		<td>	
			<label for="wpAppbox_dontGreyOut">
				<input type="checkbox" name="wpAppbox_dontGreyOut" id="wpAppbox_dontGreyOut" value="1" <?php checked( get_option('wpAppbox_dontGreyOut') ); ?>/>
				<?php esc_html_e( 'Do not grey out apps that are no longer found in the app stores (⇒ no class "deprecated")', 'wp-appbox' ); ?>
			</label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_showRating"><?php esc_html_e('App-Ratings', 'wp-appbox'); ?>:</label></th>
		<td colspan="7">
			<select name="wpAppbox_showRating" id="wpAppbox_showRating" class="postform" style="min-width:220px;">
			   <option class="level-0" value="1" <?php selected( get_option('wpAppbox_showRating'), '1' ); ?>><?php esc_html_e('Monochrome stars', 'wp-appbox'); ?> (<?php esc_html_e('Default', 'wp-appbox'); ?>)</option> 
			   <option class="level-0" value="2" <?php selected( get_option('wpAppbox_showRating'), '2' ); ?>><?php esc_html_e('Colorful stars', 'wp-appbox'); ?></option>
			   <option class="level-0" value="0" <?php selected( get_option('wpAppbox_showRating'), '0' ); ?>><?php esc_html_e('Hide app-ratings', 'wp-appbox'); ?></option>
			</select>
			<label for="wpAppbox_showRating"><?php esc_html_e('Show app-ratings from the stores in the banner (Variable {RATING} in the template-files)', 'wp-appbox'); ?></label>
			<br /><br />
			<?php 
				switch ( get_option('wpAppbox_showRating') ) {
					case '1':
						$previewOnload = 'monochrome';
						break;
					case '2':
						$previewOnload = 'colorful';
						break;
					case '0':
						$previewOnload = 'hidden';
						break;
				}
			?>
			<img id="wpAppbox_ratingstarsPreview" src="<?php esc_attr_e( plugins_url( 'img/admin-previews/rating-stars-' . $previewOnload . '.jpg', dirname( __FILE__ ) ) ); ?>" style="width:350px;" />
			<script>
				jQuery( "#wpAppbox_showRating" ).change(function() {
					value = jQuery(this).val();
					if(value == '1') value = 'monochrome';
					else if(value == '2') value = 'colorful';
					else if(value == '0') value = 'hidden';
					<?php
						echo esc_js( "valuemonochrome = '" . plugins_url( 'img/admin-previews/rating-stars-monochrome.jpg', dirname( __FILE__ ) ) ) . "';";
						echo esc_js( "valuecolorful = '" . plugins_url( 'img/admin-previews/rating-stars-colorful.jpg', dirname( __FILE__ ) ) ) . "';";
						echo esc_js( "valuehidden = '" . plugins_url( 'img/admin-previews/rating-stars-hidden.jpg', dirname( __FILE__ ) ) ) . "';";
					?>
					jQuery("#wpAppbox_ratingstarsPreview").attr( "src", eval('value'+value) );
				});
			</script>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_downloadCaption"><?php esc_html_e('Downloadbutton caption', 'wp-appbox'); ?>:</label></th>
		<td>
			<input type="text" name="wpAppbox_downloadCaption" id="wpAppbox_downloadCaption" value="<?php esc_attr_e( get_option('wpAppbox_downloadCaption') ); ?>" /> <label for="wpAppbox_downloadtext"><?php esc_html_e('Caption of the "Download"-button in the app-badge', 'wp-appbox'); ?></label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_nofollow"><?php esc_html_e('Nofollow', 'wp-appbox'); ?>:</label></th>
		<td>	
			<label for="wpAppbox_nofollow">
				<input type="checkbox" name="wpAppbox_nofollow" id="wpAppbox_nofollow" value="1" <?php checked( get_option('wpAppbox_nofollow') ); ?>/>
				<?php printf( esc_html__( 'Adds the %1$1s attribute to the links', 'wp-appbox' ), '<a href="http://en.wikipedia.org/wiki/Nofollow" target="_blank">nofollow</a>' ); ?>
			</label>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="wpAppbox_targetBlank"><?php esc_html_e('Open links in a new window', 'wp-appbox'); ?>:</label></th>
		<td>	
			<label for="wpAppbox_targetBlank">
				<input type="checkbox" name="wpAppbox_targetBlank" id="wpAppbox_targetBlank" value="1" <?php checked( get_option('wpAppbox_targetBlank') ); ?>/>
				<?php esc_html_e('Opens the links of apps in a new window (target="_blank")', 'wp-appbox'); ?>
			</label>
		</td>
	</tr>
	
</table>