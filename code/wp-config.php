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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/getchee0/public_html/wordpress/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'getchee0_blog');


/** MySQL database username */
define('DB_USER', 'getchee0_getchee');


/** MySQL database password */
define('DB_PASSWORD', 'Foosball339');


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
define('AUTH_KEY',         '>!JYC5#MxLc9;;~QI5N4?y}>pFU@z|Dm?K t812a$Pfe}Q<pOcGe6rk)^/b9.-UU');

define('SECURE_AUTH_KEY',  '-c(o~ptJ.Ca?n5LM*bDm1)a)%U!/c}mM[+%T^R|-p;1>YRBy7:t|SuE]Wg#J0p#0');

define('LOGGED_IN_KEY',    'nK+4W,hk|nq_RhTnHTn6?IdY$1yHnO~ {>sley6z7vYZuUps.U21&=K|UT(cA6Yd');

define('NONCE_KEY',        '%-?RuN}9*fT8y!|ET{f5evzeBO 4 ~/zR*@?{{e-BS)EzT8HNcdRwne#yM4JWBL%');

define('AUTH_SALT',        'km]1bSm:kZ##LyCV6<0J7$m|7$MhbnC-vLdssU5S|]Ed>:eg)UjsX=Bg<cC*8df2');

define('SECURE_AUTH_SALT', 'yXpCtU$5V;uOcrykouKI]c)VAGMYrrc&a$UzKi.2p{0009oHtc&x:aiG-|Ra%qd1');

define('LOGGED_IN_SALT',   '?kdeZTqIRBP|n-Rz{sdtQ92YV?M_r-EIn2:Q*oD#$s>w_oR4IPkGu2Ok*f6_tqtf');

define('NONCE_SALT',       'K.g&-G~L}U/Ct1|}DeKjLK}TYM/]2ut-P9>iHXH]0U|J#HLMZ,?>j25{NZc*Z1oK');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';


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
