<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'demo' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '7I0KjA:y%{+Z>/s4|l`s3QAZUN:]gYl9Aaw0J}4 vP+3m@f$V;G66L~es/VY|_dK' );
define( 'SECURE_AUTH_KEY',  'N,4~z8p$&jMZhSZ~cC4BdX,Vff#v7)BTLX@rCp|uv=4w>E+j^5O_7W5kr(6CT!u;' );
define( 'LOGGED_IN_KEY',    'FJvcH^Sx-5`H9kG8}]k]2,+K[=&=&39!8{cws:GUOvgC2^; )z8gc`2b/cSz,Qaw' );
define( 'NONCE_KEY',        '_+#p+^tfz8qI=:69ENj@_s]J?5&H7&G[njyaaj?Pqvt,2]I peuZD+.SQcr57nwK' );
define( 'AUTH_SALT',        'pUjL(]dhr5qPV-m|D| K~1HMs~1|yHLGCS$RR?QyV2wfF5^[VgV(M. U/2T2Vght' );
define( 'SECURE_AUTH_SALT', '9LR)98_AHPu&QR[w8twu[d]O;E@ap>%khF,CzVlmN`&w);CTQrou{f[/63yWD,eu' );
define( 'LOGGED_IN_SALT',   'I$0`VDkOmN#RFT@+8cjMa!A0GZn2T!q3[:8y7h])yBv:,nN0#<RzbBu/e,`}vW$!' );
define( 'NONCE_SALT',       'i$:DWz[tnW3Q2uqY|xkY#Yg (U+cv|GR%$t+`#UHM%RV^2X>i $`Rf Z8~7eSRip' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
