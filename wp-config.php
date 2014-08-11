<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

//define('WP_HOME','https://gbd.fwd.wf/sfnct/');
//define('WP_SITEURL','https://gbd.fwd.wf/sfnct/');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sfnct');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q*pI]mXM0Hn-huR-hZ9Azyms1vg/Q[+>A 9Wz$wK3m@1lhEF4q0 IZ[uj*/2_@l]');
define('SECURE_AUTH_KEY',  'VV:]%{qt5_=*+Uy_)d4oWdw;9-E|o??+g|=ZX<EH+wkk?B)uxs/MnoNgiReH_zjj');
define('LOGGED_IN_KEY',    '[4$|7?W~9,U-I7Ov^P$/xAXWC}$M#T,)0GmbuV-s%C ~{))lIe9n+/D99uGNeSBv');
define('NONCE_KEY',        '<3#-yC8rO#+*K0Xs^CQ3J`@{|S}oIeNmPy)VL6%B(J})`T_snSNpA^w#uL3v{Yst');
define('AUTH_SALT',        '8q#mV9k R@m(_qP|Zj ~b#hQWdV71bdbfzhbq])pJOUIZ)n,TL`*HP9Q-W~ZS.{A');
define('SECURE_AUTH_SALT', 'UXY@*u|O1E),p7YC.=&cqxUJ@R[0T`9WZ-<nEH}QO$(~Ek^`]`2U<(q214[3j6`6');
define('LOGGED_IN_SALT',   '+Q:&r%.qH|-^J$s${- qE^IKln[,o`+6l-z%*MjI =y(E*Z5/#F-|+/O^ZZ)Kl|R');
define('NONCE_SALT',       '8;bRh++!ixbU29U~!}PB)t;>VKqbsvQh(SB`7&ucNA0SR}Qzyzwn3U]l|Q=Gs*}q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_sfnct';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
