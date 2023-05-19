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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'houzez' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'AC ^uliX&0ddNBEK3|(I1R3{n8)h~XP-ZMD s82]#cApvUeARu6>tKI-!.wSulc9' );
define( 'SECURE_AUTH_KEY',  'kd8_?1RY>zs< I}UFiKb,(pRwf6fPSpuN/S|^9?H [YMo[l+YTuMA-vv/(wmtya7' );
define( 'LOGGED_IN_KEY',    'T$)jnj^yA2Qx[_=E6/*w; F]um?yd,e>qHnr XMq?&1rM!QWRdak4_oAWKIb9t9J' );
define( 'NONCE_KEY',        '9X`8reS8~::F.qXc9>)_lC4D,@Ry@I25W(A 14!wpLY[q</;qD(V?8 4pj9G|F>V' );
define( 'AUTH_SALT',        'QijQ2H[X@w!5Ee+[=`epyBEs0XA>G } TmS&-F%pqt$`X*&~8%MOCC `RE~dEZF=' );
define( 'SECURE_AUTH_SALT', '#fjQ<kUn#:T[9Md?;_fQS#m{P2>TM4KMw~CBN$>W/tsg,5 P025 }#^^E+U/*:s#' );
define( 'LOGGED_IN_SALT',   'p95)NeWGfi6K4xyK1i=J2N,b/Q`>(W9:>l?*vT.Ld.VDZZ|In`/Z+T5g9`{;&l,>' );
define( 'NONCE_SALT',       'OY.5#Z+,hM~dp+/Gz~!Qa3E>3o8E0PXa8EPz}6[|H20=HyDUoBnb!6*>jL 93PL.' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
