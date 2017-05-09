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
define('DB_NAME', 'site4');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'Burton22.');

/** MySQL hostname */
define('DB_HOST', 'site3.ccdnwh4lmexx.us-east-1.rds.amazonaws.com:3306');

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
define('AUTH_KEY',         'rv{}*-]6d,Bp:V7NC0l%Qo&1TgkC|)iYcmLj[~>TPmAm$#:Z543=qXUC&V;,#l)V');
define('SECURE_AUTH_KEY',  '4z&Q$?t@HNCWhiaA]D[SZ~EFoxAs[7VfLsOeN{r`Vu ;kwLG~jL|_=QWMff5~!|B');
define('LOGGED_IN_KEY',    'A)?prW*0~EzVl~xc#j&Fqy0R3W _UEnR;R3vca<J(5. eD9fN)NU{A*;!jp?>,uU');
define('NONCE_KEY',        'IzP=*AFM?R@/:YYsc(itigyxyg{SI.dkY21FNuG)j>>,3n>w<#&n5b/zcDvl-nxY');
define('AUTH_SALT',        'J9xz pwwqYV$0RE9;`u*YG`K;kKo |j4 HW}<5|o~Nzo*M,XGhcHH/y8~;MH=n@^');
define('SECURE_AUTH_SALT', '0W?tH!?%}4[pDh,QnCX?UzAv|j{DnI!YS^uO]}7:unR_X)EJ>D5-!&]Duv2e;vAR');
define('LOGGED_IN_SALT',   '%l;j3p(]Qbj<C1aw=kTW<8w`*9qa6p8v/W!+Zo_sK>7MR-L-LQmqevX`dgICkc/m');
define('NONCE_SALT',       'iL/?]WfL1XI:#J<);c+l[jI-!?~;YY;Fgd8@8Xg,o}u1u|5U/{$+>Mb3dZ^[d-1w');

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
