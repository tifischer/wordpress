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
define('DB_NAME', 'fis1523708530085');

/** MySQL database username */
define('DB_USER', 'fis1523708530085');

/** MySQL database password */
define('DB_PASSWORD', 'd4W@1Dfc5f1yV');

/** MySQL hostname */
define('DB_HOST', 'fis1523708530085.db.9398104.hostedresource.com');

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
define('AUTH_KEY',         'R71k5rqwN@_KamN!(IOk');
define('SECURE_AUTH_KEY',  'S&WWP(%G(GA$mE1WBWtH');
define('LOGGED_IN_KEY',    '(7+OI*9caZ2_v+zwL LD');
define('NONCE_KEY',        'a!d1C*vry4MmEA$2h1s=');
define('AUTH_SALT',        'F9MJ)QXS#UR4TsnTRNvV');
define('SECURE_AUTH_SALT', 'jss=sPF#70mG!qU#!F9f');
define('LOGGED_IN_SALT',   'C45rW kEsjsC)m C-%$P');
define('NONCE_SALT',       'dmnUQ9FQMG-AIjJN7mM9');

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
