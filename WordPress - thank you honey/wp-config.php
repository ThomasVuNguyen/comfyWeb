<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u678532893_RfgQx' );

/** Database username */
define( 'DB_USER', 'u678532893_Sb8aY' );

/** Database password */
define( 'DB_PASSWORD', 'ANGs1TYzwg' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '[FMzd6<#xj+H&QOmXgZ7$-Mpx)E0@c!6?&%=z^BKCoLXx %1$(~F(>o;*)R|k~JV' );
define( 'SECURE_AUTH_KEY',   'Tku-}MMFrRgQ9/<#_[PfatoA!p2DLBo+=e8OtS4uE]USHOaRv>z!`hlR2?udPk)9' );
define( 'LOGGED_IN_KEY',     '2PuXFJ,[zA#`tpA=RKN QO;kED[gzIkFGn#H)e60 UFGUnyeRNT.{$h[]QQAi@Ju' );
define( 'NONCE_KEY',         'Y&h?}GkuhT3ses8[&{1j2[V~QFp$!rO#]w5VQ@]l)@9=F[(1OChTxS@8aQ1Dsnb=' );
define( 'AUTH_SALT',         '1skp-*~+.B-U4R69Nh2U{J*E[h<[H*T)=U,(F,gq7gUIDgJEz~XQ^OI$7<oHj(L?' );
define( 'SECURE_AUTH_SALT',  'oR{t?JE30W4hS&#ZzA#~]n7gWEMg|{XMRV-!&W4ILwl U|}9jP[SUsop}B*&jP z' );
define( 'LOGGED_IN_SALT',    'B(9ug5MZ D#H:2wpg2GMus@F7w*toiNK2Jp*3&~~*(L]?tBChcn# BtG2#NH]Br)' );
define( 'NONCE_SALT',        'Qr=qF5Br1P7BNw47n6k`o%M-U+%^3ZRTbtc)zPoq[_*>Ovd>(m>RsMzDT.uW7-)E' );
define( 'WP_CACHE_KEY_SALT', 'Hg4qz>yb51tzRg%-P9DKtt-f`BOL8uMmx1B7?4IB#$>O)d#^QDXZz^qSzugGR:Q)' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
