<?php

defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
*/
add_action( 'init', 'harington_gutenberg_load_textdomain' );

function harington_gutenberg_load_textdomain() {
	load_plugin_textdomain( 'harington-gutenberg', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function harington_gutenberg_register_blocks() {

	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

	wp_register_script(
		'harington-gutenberg',
		plugins_url( 'blocks.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor', 'wp-components' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'blocks.js' )
	);

	wp_register_style(
		'harington-gutenberg-editor',
		plugins_url( 'editor.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
	);

	wp_register_style(
		'harington-gutenberg',
		plugins_url( 'style.css', __FILE__ ),
		array( ),
		filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
	);

	register_block_type( 'harington-gutenberg/harington-blocks', array(
		'editor_script' => 'harington-gutenberg',
		'editor_style' => 'harington-gutenberg-editor'
	) );

}
add_action( 'init', 'harington_gutenberg_register_blocks' );

// register custom Harington category
function harington_gutenberg_block_categories( $categories, $post ) {
    
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'harington-block-category',
                'title' => __( 'Harington Blocks', 'harington-gutenberg' )
            ),
        )
    );
}
add_filter( 'block_categories_all', 'harington_gutenberg_block_categories', 10, 2 );
