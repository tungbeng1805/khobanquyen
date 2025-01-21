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
define( 'DB_NAME', 'taikho31_wp696' );

/** Database username */
define( 'DB_USER', 'taikho31_wp696' );

/** Database password */
define( 'DB_PASSWORD', 'S71K!EY]3p' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '4nf1uvucc9s8he7orkacl2l5azfxtp7u7yjpqzr0xrguej1orxdqtfhho18w6day' );
define( 'SECURE_AUTH_KEY',  '0y6owzfmhcry0ojl4k98wbhvs8glhnbgp0lktx4qz4pxyrc4lfxssyuqec8bmmgz' );
define( 'LOGGED_IN_KEY',    'z7wjsrceso9tyabwlkmheqkjzwjozhbhe2y3buchjarjxa6x5eot3aptrl3rxsci' );
define( 'NONCE_KEY',        'do1dbtlghcfbmxpwy0f00lky0jvjfempjehihzkrn26kndm4wsr1qhg9qj2lfsnp' );
define( 'AUTH_SALT',        'hdok6igxpzex2uqgimjraog1f2nlqtjqsuw0ab1rte117pzwuaxbcr6ngjteri2d' );
define( 'SECURE_AUTH_SALT', '22s3ebuod8nj3lwunqx9d7kxbobkgep7rhnd2xgkjfsnblx6y7lejsjymmsjcv69' );
define( 'LOGGED_IN_SALT',   'ih5jz688kirkygqafbwxd2akpursmrzeem5qhbmzg8siukxnvmbz08gigw7cp7e4' );
define( 'NONCE_SALT',       'ixogu0swfx9axzin8osivpdlp8nsu7dwlj398xxd7ge9iowuaeuxdwhaqexqlosz' );

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
$table_prefix = 'wp81_';

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
