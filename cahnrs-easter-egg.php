<?php namespace cahnrswp\cahnrs\easter_egg;
/**
 * Plugin Name: CAHNRS Easter Egg
 * Plugin URI:  http://cahnrs.wsu.edu/communications/
 * Description: An interactive background element for the top CAHNRS properties integrated web presence
 * Version:     0.1
 * Author:      CAHNRS Communications, Phil Cable
 * Author URI:  http://cahnrs.wsu.edu/communications/
 * License:     Copyright Washington State University
 * License URI: http://copyright.wsu.edu
 */

class cahnrs_easter_egg {


	public function __construct() {

		$this->define_constants(); // Define constants
		$this->init_autoload(); // Activate custom autoloader for classes

	}


	private function define_constants() {

		define( __NAMESPACE__ . '\URL', plugin_dir_url( __FILE__ )  ); // Plugin base URL
		define( __NAMESPACE__ . '\DIR', plugin_dir_path( __FILE__ ) ); // Directory path

	}


	private function init_autoload() {

		require_once 'controls/autoload_control.php'; // Require autoloader control
		$autoload = new autoload_control(); // Init autoloader to eliminate further dependency on require

	}


	public function plugin() {

		if ( \wp_is_mobile() == false ) { // It saddens me that this only partially works
			$this->init_taxonomies = new posttype_control(); // Register Custom Taxonomies
			$this->init_scripts = new scripts_control(); // Enqueue scripts and styles
			$this->init_templates = new template_control(); // Load templates for custom post type
		}

		if ( \is_admin() ) {
			$init_metabox = new metabox_control(); // Custom metaboxes for custom post type
		}

	}

}

$init_cahnrs_easter_egg = new cahnrs_easter_egg();
$init_cahnrs_easter_egg->plugin();
?>