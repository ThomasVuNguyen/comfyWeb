<?php

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

global $wpdb;

/** Delete options */
$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'hostinger\_%';" );
