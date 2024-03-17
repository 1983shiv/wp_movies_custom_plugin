<?php
/**
 * Plugin Name: Movies Custom Post Type
 * Description: Custom post type for movies with REST API integration.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL2+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Movies_Custom_Post_Type {
    
    public function __construct() {
        add_action( 'init', array( $this, 'register_custom_post_type' ) );
        add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
        register_activation_hook( __FILE__, array( $this, 'add_example_movies' ) );
    }

    public function register_custom_post_type() {
        $labels = array(
            'name'               => __( 'Movies', 'textdomain' ),
            'singular_name'      => __( 'Movie', 'textdomain' ),
            'menu_name'          => __( 'Movies', 'textdomain' ),
            'name_admin_bar'     => __( 'Movie', 'textdomain' ),
            'add_new'            => __( 'Add New', 'textdomain' ),
            'add_new_item'       => __( 'Add New Movie', 'textdomain' ),
            'new_item'           => __( 'New Movie', 'textdomain' ),
            'edit_item'          => __( 'Edit Movie', 'textdomain' ),
            'view_item'          => __( 'View Movie', 'textdomain' ),
            'all_items'          => __( 'All Movies', 'textdomain' ),
            'search_items'       => __( 'Search Movies', 'textdomain' ),
            'parent_item_colon'  => __( 'Parent Movies:', 'textdomain' ),
            'not_found'          => __( 'No movies found.', 'textdomain' ),
            'not_found_in_trash' => __( 'No movies found in Trash.', 'textdomain' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'movie' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor' ),
        );
    
        register_post_type( 'movie', $args );
    }


    public function register_rest_routes() {
        register_rest_route( 'herothemes/v1', '/movies', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'get_movies' ),
            'permission_callback' => function () {
                return current_user_can( 'edit_posts' );
            }
        ));

        register_rest_route( 'herothemes/v1', '/movies/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'get_movie' ),
            'permission_callback' => function () {
                return current_user_can( 'edit_posts' );
            }
        ));
    }

    public function get_movies() {
        $args = array(
            'post_type' => 'movie',
            'posts_per_page' => -1,
        );

        $movies = get_posts( $args );

        return $movies;
    }

    public function get_movie( $data ) {
        $args = array(
            'post_type' => 'movie',
            'p' => $data['id'],
        );

        $movie = get_posts( $args );

        return $movie;
    }

    public function add_example_movies() {
        $movies = array(
            array(
                'title' => __( 'The Shawshank Redemption', 'textdomain' ),
                'description' => __( 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'textdomain' ),
                'year' => '1994',
            ),
            array(
                'title' => __( 'The Godfather', 'textdomain' ),
                'description' => __( 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 'textdomain' ),
                'year' => '1972',
            ),
            array(
                'title' => __( 'The Dark Knight', 'textdomain' ),
                'description' => __( 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 'textdomain' ),
                'year' => '2008',
            ),
            array(
                'title' => __( 'Schindler\'s List', 'textdomain' ),
                'description' => __( 'In German-occupied Poland during World War II, industrialist Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.', 'textdomain' ),
                'year' => '1993',
            ),
            array(
                'title' => __( 'The Lord of the Rings: The Return of the King', 'textdomain' ),
                'description' => __( 'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', 'textdomain' ),
                'year' => '2003',
            ),
            array(
                'title' => __( 'Pulp Fiction', 'textdomain' ),
                'description' => __( 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'textdomain' ),
                'year' => '1994',
            ),
            array(
                'title' => __( 'Forrest Gump', 'textdomain' ),
                'description' => __( 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.', 'textdomain' ),
                'year' => '1994',
            ),
            array(
                'title' => __( 'Inception', 'textdomain' ),
                'description' => __( 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.', 'textdomain' ),
                'year' => '2010',
            ),
            array(
                'title' => __( 'The Matrix', 'textdomain' ),
                'description' => __( 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 'textdomain' ),
                'year' => '1999',
            ),
            array(
                'title' => __( 'Goodfellas', 'textdomain' ),
                'description' => __( 'The story of Henry Hill and his life in the mob, covering his relationship with his wife Karen Hill and his mob partners Jimmy Conway and Tommy DeVito in the Italian-American crime syndicate.', 'textdomain' ),
                'year' => '1990',
            ),
            array(
                'title' => __( 'The Silence of the Lambs', 'textdomain' ),
                'description' => __( 'A young F.B.I. cadet must receive the help of an incarcerated and manipulative cannibal killer to help catch another serial killer, a madman who skins his victims.', 'textdomain' ),
                'year' => '1991',
            ),
            array(
                'title' => __( 'The Green Mile', 'textdomain' ),
                'description' => __( 'The lives of guards on Death Row are affected by one of their charges: a black man accused of child murder and rape, yet who has a mysterious gift.', 'textdomain' ),
                'year' => '1999',
            ),
            array(
                'title' => __( 'The Godfather: Part II', 'textdomain' ),
                'description' => __( 'The early life and career of Vito Corleone in 1920s New York City is portrayed, while his son, Michael, expands and tightens his grip on the family crime syndicate.', 'textdomain' ),
                'year' => '1974',
            ),
            array(
                'title' => __( 'Saving Private Ryan', 'textdomain' ),
                'description' => __( 'Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.', 'textdomain' ),
                'year' => '1998',
            ),
            array(
                'title' => __( 'The Lord of the Rings: The Fellowship of the Ring', 'textdomain' ),
                'description' => __( 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', 'textdomain' ),
                'year' => '2001',
            ),
            array(
                'title' => __( 'The Departed', 'textdomain' ),
                'description' => __( 'An undercover cop and a mole in the police attempt to identify each other while infiltrating an Irish gang in South Boston.', 'textdomain' ),
                'year' => '2006',
            ),
            array(
                'title' => __( 'Gladiator', 'textdomain' ),
                'description' => __( 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.', 'textdomain' ),
                'year' => '2000',
            ),
            array(
                'title' => __( 'The Prestige', 'textdomain' ),
                'description' => __( 'After a tragic accident, two stage magicians engage in a battle to create the ultimate illusion while sacrificing everything they have to outwit each other.', 'textdomain' ),
                'year' => '2006',
            ),
            array(
                'title' => __( 'The Usual Suspects', 'textdomain' ),
                'description' => __( 'A sole survivor tells of the twisty events leading up to a horrific gun battle on a boat, which began when five criminals met at a seemingly random police lineup.', 'textdomain' ),
                'year' => '1995',
            ),
            array(
                'title' => __( 'Se7en', 'textdomain' ),
                'description' => __( 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.', 'textdomain' ),
                'year' => '1995',
            ),
        );
        

        foreach ( $movies as $movie ) {
            $post_id = wp_insert_post( array(
                'post_title'   => wp_strip_all_tags( $movie['title'] ),
                'post_content' => wp_strip_all_tags( $movie['description'] ),
                'post_status'  => 'publish',
                'post_type'    => 'movie',
                'meta_input'   => array(
                    'movie_year' => intval( $movie['year'] ),
                ),
            ) );
        }
    }
}

new Movies_Custom_Post_Type();
