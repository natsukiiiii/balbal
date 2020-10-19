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
define( 'DB_NAME', 'balbal_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Vi@$IbN%:-F#`3YK3c$TI2 x~<)D5v~xg=9H@KH18I8T1%16aTxVrlD75fu4xXj@' );
define( 'SECURE_AUTH_KEY',  '*^mM3`uXuWv+ii9`lkX%g<`);c%9As=fbGEx`=ad{h$b,wF!Pp9rE^zjrBNoG]Wj' );
define( 'LOGGED_IN_KEY',    'OFjEn=%njz$~D6(g)D<)`7^fJ_kZa$C4(+xXb/D2Uy4:rc+)biGSpv5y<9s~VW4Q' );
define( 'NONCE_KEY',        'V>rw&ENBF-eH5c)~! `,!jlxCYjuQ>iS{h:P0D +,]w2IC|z[F-*Iqo)guAH~Cy?' );
define( 'AUTH_SALT',        'nv.e%OOV%eB0ASdcNI,*,w3AFZ}P3>VN2Cf@zqjw5D,*0E{SB%NtZN.r/9T7y$:Y' );
define( 'SECURE_AUTH_SALT', 'CRMzv%19Jx5Dmf&[+I#|l3%VvCCksV&.4ql$/kO4);K:aj~K2{XoP$m1+0[$[?GQ' );
define( 'LOGGED_IN_SALT',   'WZAh#Q{|c{f+#]=z-x-uTHqCIUgN9!3XP]ap*(Up4`T*B%Z,|>[{Qjb4VJ%8S)f&' );
define( 'NONCE_SALT',       '}[qr Qz/$G,iC@${KP2[{;I6i6`K(Vi$4@=AlaLzYoEr#3r93U|0XTBBMS ofWa}' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
