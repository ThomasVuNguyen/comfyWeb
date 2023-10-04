<div class="wpa-infobox wpa-notice">
    <p><?php esc_html_e('Some quick-help about little functions of WP-Appbox and how to get the ID of an specific app. ;-)', 'wp-appbox'); ?></p>
</div>

<h3><?php esc_html_e('Get the ID of an app', 'wp-appbox'); ?></h3>

<table class="form-table">

	<?php foreach ( $wpAppbox_storeNames as $storeID => $storeName ) { ?>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( $storeName ); ?>:</th>
		<td><img src="<?php esc_attr_e( plugins_url( "img/appid/$storeID.jpg", dirname( __FILE__ ) ) ); ?>" alt="<?php esc_attr_e( $storeName ); ?> ID" /></td>
	</tr>
	<?php } ?>
	
</table>

<hr />

<h3><?php esc_html_e('The shortcode', 'wp-appbox'); ?></h3>

<table class="form-table">

	<tr valign="top">
	
		<th scope="row"><?php esc_html_e('App Store screenshots', 'wp-appbox'); ?>:</th>
		<td><?php printf( esc_html__( 'Link to a universal app for iOS, you can just leave on request show the iPhone or iPad screenshots. For this, %1$s can be added to the App ID.', 'wp-appbox' ), '<code>-iphone</code>, <code>-ipad</code>, <code>-watch</code>, <code>-imessage</code> or <code>-appletv</code>' ); ?> <?php esc_html_e( 'Example', 'wp-appbox' ); ?>: <code>[appbox appstore appid-iphone screenshots]</code></td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><?php esc_html_e('Microsoft Store screenshots', 'wp-appbox'); ?>:</th>
		<td><?php printf( esc_html__( 'Link to a universal app for Windows 10 (Mobile), so you can just leave on request show the mobile or desktop screenshots. For this, %1$s can be added to the App ID.', 'wp-appbox' ), '<code>-mobile</code> or <code>-desktop</code>' ); ?> <?php esc_html_e( 'Example', 'wp-appbox' ); ?>: <code>[appbox microsoftstore appid-mobile screenshots]</code></td>
	</tr>
	
</table>