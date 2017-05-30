<?php

/**
* Plugin Name: CAHNRSWP People
* Plugin URI:  http://cahnrs.wsu.edu/communications/
* Description: Shortcodes for interacting with people.wsu.edu
* Version:     0.0.1
* Author:      CAHNRS Communications, Danial Bleile
* Author URI:  http://cahnrs.wsu.edu/communications/
* License:     Copyright Washington State University
* License URI: http://copyright.wsu.edu
*/

class CAHNRSWP_People_Profiles {
	
	public static $instance = false;
	
	
	public static function get_instance(){
		
		if ( ! self::$instance ){
			
			self::$instance = new self;
			
			self::$instance->init();
			
		} // end if
		
		return self::$instance;
		
	} // end get_instance
	
	
	public function init(){
		
		define( 'CAHNRSWPPEOPLEPLUGINPATH', plugin_dir_path( __FILE__ ) );
		define( 'CAHNRSWPPEOPLEPLUGINURL', plugin_dir_url( __FILE__ ) );
		
		require_once 'classes/class-request-cahnrswp-people.php';
		require_once 'classes/class-people-factory-cahnrswp-people.php';
		require_once 'classes/class-shortcode-cahnrswp-people.php';
		
		$request = new Request_CAHNRSWP_People();
		
		$people_factory = new People_Factory_CAHNRSWP_People( $request );
		
		$shortcode = new Shortcode_CAHNRSWP_People( $people_factory, true );
		
	} // end init
	
	
} // end CAHNRSWP_People_Profiles

$cahnrswp_people_profiles = CAHNRSWP_People_Profiles::get_instance();