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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tangio' );

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
define( 'AUTH_KEY',         'RZbr:27a <C`i WUTObe1[2G-%EbUZA@~InqxE`}aClxRFCOjjwkQzmH{No[V_Pt' );
define( 'SECURE_AUTH_KEY',  '?D~oh,Btx5/5z:e<[d>W%n:[(GX#ATWLW)#:Q]Q4ZesNsZJ,alpq#@sAZi^f4GEH' );
define( 'LOGGED_IN_KEY',    ' JPIo*0_~YOfIHDgn.9Qn)@Dw`Y#?z;3$|YS|ZhH,c1`2%4~7r^I#F+:sDZQAfl!' );
define( 'NONCE_KEY',        '&Y*>2A_~yO!k<-yE3#4J)eZ2OW U.FGrP|ER<YsiQ?$}Ue;>9aqw:E++F@.p@,ke' );
define( 'AUTH_SALT',        '%erg,D+jJ*2X2tm-YUV64L;9my{QI>rbV}RM:26uu-<WJvZb%*&m3()@*ov>hzyH' );
define( 'SECURE_AUTH_SALT', 'GlMzon<Q:}(GaYhn#~x;,kJ)Nh{:gP}sit[#z`5F*#=o>`3`}lri`G=|<VPZ0XgM' );
define( 'LOGGED_IN_SALT',   'EXP17]QP:,gO1,%uJj`V*<a-j9&YJ+I>yc$VO_;rxTS>EKyw5e4L7[[$`}kz ^Z^' );
define( 'NONCE_SALT',       '$`DdMXD&-$Pf9^XFF3yrPLI]Ur&,L2R&qtaRi|>N %iat}xcyMPnF&-&6MC^,0S^' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
