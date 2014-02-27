<?php

$root = dirname( dirname( __FILE__ ) );

// Dotenv setup
if ( file_exists( $root . '/.env' ) ) {
	Dotenv::load( $root );
	Dotenv::required( array( 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_HOST', 'WP_HOME', 'WP_SITEURL' ) );
} else {
	$err  = "<h1>Fatal Error - Missing .env</h1>";
	$err .= "<p>Root directory must have a .env to define the environment.</p>";
	$err .= "<p>Refer to .env.example for a sample</p>";
	$err .= "<p>See documentation at <a href='https://github.com/vlucas/phpdotenv'>https://github.com/vlucas/phpdotenv</a></p>";
	echo error_container( $err );
	die();
}


// get the defined WP_ENV or default to 'development'
define( 'WP_ENV', getenv( 'WP_ENV' ) ? getenv( 'WP_ENV' ) : 'development' );
$env = dirname( __FILE__ ) . '/env/' . WP_ENV . '.php';

if ( file_exists( $env ) ) {
	require_once $env;
} else {
	$err  = "<h1>Fatal Error - No Environment Config </h1>";
	$err .= "<p>You're trying to call missing environment definition '" . $env . "'</p>";
	$err .= "<p>Either define your WordPress config in that file or change/delete the environment variable in .env</p>";
	echo error_container( $err );
	die();
}


// custom wp-content directory
define( 'WP_CONTENT_DIR', $root . '/app' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/app' );


// salts - You MUST replace these for security - https://api.wordpress.org/secret-key/1.1/salt
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );


// localized language, defaults to English
define( 'WPLANG', '' );


// database options
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
$table_prefix = 'wp_';


// Bootstrap WP
if ( !defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', $root . '/wp/' );
}


// I'm an idiot
function error_container( $content ) {
	$container  ='<iframe src="http://giphy.com/embed/usUm1EU5N5CBG" width="100%" height="98%" frameBorder="0"></iframe>';
	$container .= '<div style="position: absolute; top:1em; left:1em; margin-right: 1em; margin-bottom: 1em; padding: 2em; background: grey; color: white; max-width: 400px;">';
	$container .= $content;
	$container .= '</div>';

	return $container;
}
