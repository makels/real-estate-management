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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_test' );

/** Database username */
define( 'DB_USER', 'wp_test' );

/** Database password */
define( 'DB_PASSWORD', 'wp_test' );

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
define( 'AUTH_KEY',         '#&x>}&J!b RT=t}?oK}o%N([)wiHbo3D,mv?s-n`}EU7G2<jP#O7LaoI0,%P*6T-' );
define( 'SECURE_AUTH_KEY',  'a8{,,y&Vzlmwo[N- <fIU|ZEO:nqc.*f6i~oi3*MdDDx( $_[|@,AiDws,(G_,[8' );
define( 'LOGGED_IN_KEY',    'iMRxhVuS4?`njpC:bl.pOEd _m;#&v/LV6#Gp-nXOX=JDeTNZxs6`SNU3fNnBoG=' );
define( 'NONCE_KEY',        'KODEi(B_$-Cvt*^~[ch]h.K<e7}e4([!V+t=h;m`DkUO*b9LOB+@U}8LkRO&VIj@' );
define( 'AUTH_SALT',        'Ql ?{f/OI<2P[ =9_gz`W1FHR&Uec<dg|aHuh:%VqGBw1]H?<sNll5KuYUBUB35X' );
define( 'SECURE_AUTH_SALT', '~ewY DXS0ZBAf6p`dSsMC>!XW_:YAWO0uyYFtFW8t!F<TUA$K0fs3|M2dcyD8Q6$' );
define( 'LOGGED_IN_SALT',   '*kll3%*V5^>fR;0nXKrXrFu2{zJ2 wX{0x2M`kx)g<VR:eKM`*wo8U3Y2ZbtcP25' );
define( 'NONCE_SALT',       'h]o L) Du)2Wy#TSO!HCY,4n&c;f{1Tu_f{$H@[[ifNqAP9 2=aR[_W}cFF9`,mI' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
