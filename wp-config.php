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
define( 'DB_NAME', 'wpdb' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         '+aKSN>QcR0?W%oc$v:)?d9$ZTi4zP|ag4[3vI%Cw#b^rjtgRmGT] gIbxM[&ejRz' );
define( 'SECURE_AUTH_KEY',  'fI^^?HC-JFtkH9L&10BgO?A`7;*x7hB<&yCN<T&G@p$H8y)ZwID,<<8{b.*mw/,q' );
define( 'LOGGED_IN_KEY',    's:CR!uJZD$v1I+z[$hC9XZ?)ARldv}L-ZVcw@Eulor8d -A%QHwWP/ Ahh0[imfx' );
define( 'NONCE_KEY',        '$U$Y!/F(PS?)+&PHeE.S2o1Mh 4rp]Sq=pdaj26t>B}_#`~Kf]r&nn?n]zPI>h3.' );
define( 'AUTH_SALT',        'J:E70(:}5,4vUyaO>> QVW-vf;hfc)^n~1b){Fw_YuseX@z*u:Z$:-.c&6:<lz5;' );
define( 'SECURE_AUTH_SALT', 'x>H8uiRUgv&#*<C5EYc GM:&4 R$So&;Br ]-h1!7n[:n/@Si8?.GTd:p{i:M-_9' );
define( 'LOGGED_IN_SALT',   'QECk#hbxbu9s@nY:aD<Ym&m#)8pokSA %&y]0(&i5d?-tzH/HS%c se =N)[*hwd' );
define( 'NONCE_SALT',       '_td#5`s>!B#?{0oDqC*IJSpgLJ1Ye%@:td*,!FdS5EAH/l4ZyNMGFY65,w69gxzP' );

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
