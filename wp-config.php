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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tailwind' );

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
define( 'AUTH_KEY',         'e>Uy}n|<f.n|jslBf<_UyuB5W6Lu=#,rd4_|gZV.;zGY!+-@9GmnX#d*NP98~LKL' );
define( 'SECURE_AUTH_KEY',  'a,_jb,BS=>SxkY6j/#JSA5pI6>{XE0n#?DVYrJEYu/w_h{6i@ES2s*5$]--zB0s<' );
define( 'LOGGED_IN_KEY',    'uwN%M/Tm9S:$0|spP6K$/vfVI$kDO]Rtt[!h(ZR~D1,d[Swe7ZvYAV3#}e$+`&n;' );
define( 'NONCE_KEY',        'aUgU^6Y7ynucFcPGnm@Z+%B%3Vo;Kw6Cn?XsWD@P90m$P!G:-ZaOCnDm=T_R0MS?' );
define( 'AUTH_SALT',        'mqe?_dozRtP`7co$Vlk~jG!78E#,Q<=yJAwm>pE+v.VT6HrJv7s)4>iBM^Q&OMcQ' );
define( 'SECURE_AUTH_SALT', 'MG?-]2>5M`n~()Dvd&/w2d?oqF!>RH<$/xv$09mwXrG*FI4} E{Kw,uJ`={ON@VC' );
define( 'LOGGED_IN_SALT',   '{Z:$hjhej+i>ZxA~dq=9w+3A$8kXGP-a#m/(B4QM88v&{[BR&YIW,V10| 2K)wI|' );
define( 'NONCE_SALT',       '=j~(}~_Fc~dMC8[vyK/lf.i` YUz)*iet5,<+8LwyFJWsxCa1@7hlXFK$`LG/b89' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
