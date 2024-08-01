<?php
/**
 * Created by Clapat.
 * Date: 04/02/19
 * Time: 6:21 AM
 */

// register navigation menus
if ( ! function_exists( 'harington_register_nav_menus' ) ){
	
	function harington_register_nav_menus() {
		
	  register_nav_menus(
		array(
		  'primary-menu' => esc_html__( 'Primary Menu', 'harington')
		)
	  );
	}
}
add_action( 'init', 'harington_register_nav_menus' );
 
// custom excerpt length
if( !function_exists('harington_custom_excerpt_length') ){

	function harington_custom_excerpt_length( $length ) {

		return intval( harington_get_theme_options( 'clapat_harington_blog_excerpt_length' ) );
	}
}

// theme setup
if ( ! function_exists( 'harington_theme_setup' ) ){

	function harington_theme_setup() {

		// Set content width
		if ( ! isset( $content_width ) ) $content_width = 1180;

		// add support for multiple languages
		load_theme_textdomain( 'harington', get_template_directory() . '/languages' );
			
	}

} // harington_theme_setup

/**
 * Tell WordPress to run harington_theme_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'harington_theme_setup' );