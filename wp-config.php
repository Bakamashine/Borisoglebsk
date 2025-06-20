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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'wCB[VBIJ3|Rh h[as+1<)~7)f2(o9)0kYf]~w]%CRpH7<BpH6C3:[_!>kYbg^zPq' );
define( 'SECURE_AUTH_KEY',  'S!ZTmaOebvysTC{4yG. SoR(_%F$)/%RH=7YLDB]C-&MrPe*c+9r}2,Ak0QS&tu=' );
define( 'LOGGED_IN_KEY',    'vFl3,t9.X`z)t3M2],]|@G 0SFCbR|:U:%=q1kCjte5:i+Nqs0@OX-KK0y;9GGL.' );
define( 'NONCE_KEY',        '_>n)2,7 ;sY$5E8b9Yr}p1=2S#n9}-6f|m?-fNYB!0`Y0&wsU<XCGw]]o]fiRmyF' );
define( 'AUTH_SALT',        'Yv5kzS^kcPu!Ad0d]RuC}G-~hrPS7qCnHvbI[Da%WW_Q[I!yL^Syx2Q#<I1Q%F0R' );
define( 'SECURE_AUTH_SALT', 'vppfQ-{A[m f(q@[coeMXa#^-5~*XuOPZHnoRy[~yrOx.3)1u@Gxlwa-AJI]k<1J' );
define( 'LOGGED_IN_SALT',   ']zt?|S32>k8s|wG*XlC]s$+[q@[C=tn.O>5[!_qL%Z/P/Q5!S0LPLa`[Ta5SGnU@' );
define( 'NONCE_SALT',       'Q}kU]seFBR=G|UG/F|5/>7v-w3z6JgfxLd|Z.^P`RqEho5{la7<wW`T^6*Qm;[zo' );

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
