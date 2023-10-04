<style>
	.donation-link>a:link,
	.donation-link>a:visited {
		position: absolute;
		bottom: 12px;
		width: 76px;
		height: 48px;
		display: block;
		padding-top: 28px;
		-webkit-border-radius: 42px;
		-moz-border-radius: 42px;
		border-radius: 42px;
		background-color: #D4B06A;
		color: #FFF;
		text-decoration: none;
		font-size: 14px;
	}
	.donation-link>a:hover,
	.donation-link>a:active {
		background-color: #996632;
	}
	.donation-link.amazon>a:link {
		right: 12px;
	}
	.donation-link.paypal>a:link {
		right: 100px;
	}
</style>
<div style="position: relative;width:100%; top: 10px; height: auto; text-align: center; background-color:#f5d6a9;">
	<div style="position: absolute; bottom: 4px; left: 6px;"><small>Logo by <a href="https://twitter.com/craive" target="_blank">@craive</a></small></div>
	<div class="donation-link amazon"><a href="<?php esc_attr_e( WPAPPBOX_URL_AMAZON ); ?>" target="_blank">Amazon</a></div>
	<div class="donation-link paypal"><a href="<?php esc_attr_e( WPAPPBOX_URL_PAYPAL ); ?>" target="_blank">PayPal</a></div>
	<img style="width:100%; max-width: 1100px; max-height: 600px;" src="<?php esc_attr_e( plugins_url( 'img/wpappbox-logo.png', dirname( __FILE__ ) ) ); ?>" alt="<?php esc_attr_e( WPAPPBOX_PLUGIN_NAME ); ?> (Version <?php esc_attr_e( WPAPPBOX_PLUGIN_VERSION ); ?>)" title="<?php esc_attr_e( WPAPPBOX_PLUGIN_NAME ); ?> (Version <?php esc_attr_e( WPAPPBOX_PLUGIN_VERSION ); ?>)" />
</div>
<br clear="both" />
<small>
	<?php  
		$countCachedApps = wpAppbox_countCachedApps();
		if ( $countCachedApps > 0 )
			echo( '<a href="options-general.php?page=wp-appbox&amp;tab=cache-list">' . esc_attr( $countCachedApps ) . '</a> ' . _n( 'app in cache', 'apps in cache', esc_attr( $countCachedApps ), 'wp-appbox' ) . ' | ' );
	?>
	<?php esc_html_e('Plugin version', 'wp-appbox'); ?>: <?php esc_html_e( WPAPPBOX_PLUGIN_VERSION ); ?> | 
	<?php esc_html_e('Installed version', 'wp-appbox'); ?>: <?php esc_html_e( get_option('wpAppbox_pluginVersion') ); ?> | 
	<?php esc_html_e('Database version', 'wp-appbox'); ?>: <?php esc_html_e( get_option('wpAppbox_dbVersion') ); ?> | 
	<a href="options-general.php?page=wp-appbox&tab=info&showerrorlog"><?php esc_html_e('Debug', 'wp-appbox'); ?></a>
</small>

<?php if ( isset( $_GET['showerrorlog'] ) ): ?>
	<br /><br /><hr />
	<h3><?php esc_html_e('Error log', 'wp-appbox'); ?></h3>
	<textarea id="wpappbox-error-log" style="font-family: monospace; width: 100%; height: 500px; white-space: pre;"><?php include( 'settings-errorlog.php' ); ?></textarea>
<?php endif; ?>