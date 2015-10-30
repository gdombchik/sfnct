<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_e1l4o6h6on');

/** MySQL database username */
define('DB_USER', 'oF3i4Un6J6hId7w');

/** MySQL database password */
define('DB_PASSWORD', '8aZbJ648LRbLP13N');

/** MySQL hostname */
define('DB_HOST', 'sfnctorg.fatcowmysql.com');

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
define('AUTH_KEY', 'uoq=-tBuQCrMUjMBZbmbj[lkwYYGy(bQ<Ss!p-nomp&|j?q<*([_ct!NL=TS@Axt%zg;MCBO(Q{!|C}<WUp_dV$/E^aHLE)]MDtoL]=fE_N@pLw$P;dsa(PrK*u[no%/');
define('SECURE_AUTH_KEY', 'Ii*vMU{vmazX(I&SCS(]MAZ&|y)$g>D?|xLG+h/butM*eY]mTMk(RUKti{j*y}wl[gny;{ivqz|*d(UnUk<t$]}QsxM_vEU=P=_Q_m+iHIG;Qu-DWtn(E+^HIMl|q$W?');
define('LOGGED_IN_KEY', 'Gigaj;r<}O$HlUcDPG|NsyQBNu!xtZOl^p<QTMXwZ<@]I-_AhfUYpDq%H|dH+hNE*WX?TMb(=?U_;q_Sd|{*]iV!@|JDz&y=Waehk^wMn{W<A*DzSphZt{uxT&^%h%$b');
define('NONCE_KEY', '=?qYm>HyAxH$Q|$){T/=[<ExNTVXJfaWUSHIaDUU|N*Ew{&>K>JVVSTmZ^x=XAUpwTSkM[!]c=I!kYj^$RL(hx>[rmXS]p@;k%-]No>D)&Qlh]!wAm*ixaQ(MgVKlVJn');
define('AUTH_SALT', '-qFf=W?kPDZ%=X<gT>TsI}=sF*t|HsGerN^rBXHg+HA|Ab<XQd=/d>C-NIi^TieR|huVOZl@INjNoyZdqze(Az<oaY{!!xT>X&D?CEKvkgvDhy%rRTPy[Qm[>EZ?-m=B');
define('SECURE_AUTH_SALT', 'bAd>X_n;$=Z^JJYkJl@e/{Ht/^Wg}g(_^JWs^hKgvhr%FF>y%{+y]EY]FTVtkKqngR$jhTpVNu&(sV/dMnDfK<NsVV?H*tpDm@O)-LWBVRy>BRP;aml=CIKnsLGMCPFM');
define('LOGGED_IN_SALT', '>aLX^}aKt>uc!^Bcd^{MwumJ]<fSbe;J-rbWE<h%VcJ[wQ_LaepikUekLsooj;vfPi($DzgabTaEIUTH+$}!PeAY@}^sIN(]lbjnT[K!z%Nt{tS{I$L[^)lR{G/SdZxH');
define('NONCE_SALT', '?BiC]]OhH=k(E?%R;[NYakED)=KudIeHUH()}|/WfQS/]@&Y*wJO(jtv(>Lt$bAQEV_ytH$rgl%CSdWPfyl*do/dbPVVZJX{rJ}@L_q&*P&?;QSRQS-CLdG!/@TWM-}z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_sfnct';

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
