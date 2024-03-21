<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://https://github.com/1983shiv
 * @since      1.0.0
 *
 * @package    Movies
 * @subpackage Movies/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Movies
 * @subpackage Movies/includes
 * @author     Shiv Srivastava <ninjatech.app@gmail.com>
 */
class Movies_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Query to retrieve all posts of the "movie" post type
		$movie_posts = get_posts( array(
			'post_type'      => 'movie',
			'posts_per_page' => -1, // Retrieve all posts
			'fields'         => 'ids', // Only retrieve post IDs
		) );

		// Loop through each movie post and delete it
		foreach ( $movie_posts as $movie_post_id ) {
			wp_delete_post( $movie_post_id, true ); // Force delete to bypass trash
		}
	}

}
