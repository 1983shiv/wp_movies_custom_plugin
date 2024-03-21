<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://github.com/1983shiv
 * @since      1.0.0
 *
 * @package    Movies
 * @subpackage Movies/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Movies
 * @subpackage Movies/includes
 * @author     Shiv Srivastava <ninjatech.app@gmail.com>
 */
class Movies_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */


	
	public static function activate() {

		global $wpdb;

		/**************************
		 * CREATE CUSTOM POST TYPES
		 *
         
		 * @ custom_post_types.php
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-movies-post-types.php';
		$plugin_post_types = new Movies_Custom_Post_Type();
		$plugin_post_types->add_example_movies();

	}

}
