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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pxdm_forum');

/** MySQL database username */
define('DB_USER', 'pxdm_forum');

/** MySQL database password */
define('DB_PASSWORD', '7936_Pxd$*M');

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
define('AUTH_KEY',         '38_DAJ-n8fL6fztxPgl~R 1i!Hc9QOY1.Qg@zf]_HIm42Ht/oj=9+|Ks[j]ic8!{');
define('SECURE_AUTH_KEY',  'SQ}zwR(`>;.8=pivh3/>/^eIJ?b=YUdjYxQT-U]M_bChdT/`?6aO`<07VyJfwk%G');
define('LOGGED_IN_KEY',    'J]0*wYeQeMGv+-!|aZTo[j4Gl7}ls,G%l N]Z$3?8w]2J%iRi5T|D((O#6$vDt;N');
define('NONCE_KEY',        '}-W=I0z5<GJNNGGf6a0_mh7;{cAaA}l[YM6Xs1q(MAXr#* `Z`F83k5!Rey)vxm_');
define('AUTH_SALT',        'LlByA~Y|b9I.j[hcwGse|e;cA|(QLY3nzK_W~C5^g.N)IlHr>efWACjFfDC$$2Kn');
define('SECURE_AUTH_SALT', '5`S^!U~c%ZVm|TF+C85 7GRrp)#mldFob&z@Iy>`dHyf+t@RB~59V|Zl&o:KHe(F');
define('LOGGED_IN_SALT',   'P<BFFC=aWvx4>dSrVk2K0k}BHvWI_ueqWG,1jyJ;med{>md-F}&niHW)^_a>q4mj');
define('NONCE_SALT',       '-S6p:I/I}H>*{]!5w:VRH--n].ktC* _tnhU}`4,ck^]Mog?,tp%H77*hMUO**L6');

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
