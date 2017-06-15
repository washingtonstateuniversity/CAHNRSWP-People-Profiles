<?php
/*
* Plugin Name: CAHNRSWP People
* Plugin URI:  http://cahnrs.wsu.edu/communications/
* Description: Shortcodes for interacting with people.wsu.edu
* Version:     0.1.0
* Author:      CAHNRS Communications, Danial Bleile
* Author URI:  http://cahnrs.wsu.edu/communications/
* License:     Copyright Washington State University
* License URI: http://copyright.wsu.edu
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This plugin uses namespaces and requires PHP 5.3 or greater.
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
	add_action( 'admin_notices', create_function( '',
	"echo '<div class=\"error\"><p>" . __( 'WSUWP Plugin Skeleton requires PHP 5.3 to function properly. Please upgrade PHP or deactivate the plugin.', 'wsuwp-plugin-skeleton' ) . "</p></div>';" ) );
	return;
} else {
	
	define( 'CAHNRSWPPEOPLEPATH', plugin_dir_path( __FILE__ ) );
	define( 'CAHNRSWPPEOPLEURL', plugin_dir_url( __FILE__ ) );
	
	include_once __DIR__ . '/includes/classes/class-wsuwp-people-display-cahnrs.php';

}
