<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
define("FS_METHOD","direct");

define("FS_CHMOD_DIR", 0777);

define("FS_CHMOD_FILE", 0777);
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'greenhomeland');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         's/a GWVq)PO0YR=p#Nyj=}k,%&y)hQBVPt%oM.4<Rk[ln#B4<7:Z!)~64,?)OPlK');
define('SECURE_AUTH_KEY',  '^l:t[ZE#!<qe7W/bFZCWy;WEJedESN JTz qqTP~?]rdasm<U6s&eNY}Of#8k*.+');
define('LOGGED_IN_KEY',    'LCv/e(w;=zqH]qmS6&h]b9,#EM JLB9<!OR,a(a$iP~so~rPW)d|#W`E+AN-mk7k');
define('NONCE_KEY',        'm^}Zo6W#zIvq_yNKcRI_/UwsJZZ@:yCvn|bg#~q;q<(rTJM$+FvMsFhc([DV16a^');
define('AUTH_SALT',        '=uTw>Ho&+(!R%<Z?V]5kN>.iu{nr}gK,3s[2r^xVyCm}R0+*N#a[K]7MgH}y*`Q6');
define('SECURE_AUTH_SALT', 'pM@+M*`K3i*W~=^(bTv}Yl0;Lh4C+P3}^>:C5uK9:Ss,n`/!T,NXI^K7.sh_pEuC');
define('LOGGED_IN_SALT',   'lv!( mF*g1.=-E/RS<7G==T>SJ1??ZK]h02NvyKGxS@!DKl{^_,h[q0:,*SGb|Np');
define('NONCE_SALT',       'TC=C6.Y5.brFuu2.ZF2MWHLy8bjUTW,#vPWpKlt+2^C@iGywW9z#ARKS8M}Uu*l[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
