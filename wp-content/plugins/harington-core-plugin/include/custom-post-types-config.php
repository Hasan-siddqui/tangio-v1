<?php
/**
 * Created by ClaPat
 * Date: 25/08/22
 */

// Register custom post types
if ( ! function_exists( 'harington_core_custom_types' ) ){

    function harington_core_custom_types() {

        $custom_slug = null;
		$clapat_custom_slug_option = get_theme_mod( 'clapat_core_portfolio_custom_slug', '' );
		if( !empty( $clapat_custom_slug_option ) ){
				
			$custom_slug = $clapat_custom_slug_option;
		}
				
        register_post_type(
            'harington_portfolio',
            array(
                'labels' => array(
                    'name' => __('Portfolio', 'harington_core_plugin_text_domain'),
                    'singular_name' => __('Portfolio', 'harington_core_plugin_text_domain'),
                    'all_items' => __('Portfolio Items', 'harington_core_plugin_text_domain'),
                    'add_new' => __( 'Add New', 'harington_core_plugin_text_domain' ),
                    'add_new_item' => __( 'Add New Portfolio Item', 'harington_core_plugin_text_domain' ),
                    'edit_item' => __( 'Edit Portfolio Item', 'harington_core_plugin_text_domain' ),
                    'new_item' => __( 'New Portfolio Item', 'harington_core_plugin_text_domain' ),
                    'view_item' => __( 'View Portfolio Item', 'harington_core_plugin_text_domain' ),
                    'search_items' => __( 'Search Portfolio Items', 'harington_core_plugin_text_domain' ),
                    'not_found' => __( 'No portfolio items found', 'harington_core_plugin_text_domain' ),
                    'not_found_in_trash' => __( 'No portfolio items found in Trash', 'harington_core_plugin_text_domain' ),
                    'menu_name' => __( 'Portfolio', 'harington_core_plugin_text_domain' ),
                ),
                'rewrite' => array('slug' => $custom_slug, 'with_front' => false),
                'description' => 'Add your Portfolio',
                'menu_icon' =>  'dashicons-portfolio',
                'public' => true,
				'show_in_rest' => true,
                'supports' => array('title', 'editor'),
            )
        );

		register_taxonomy( 	'portfolio_category', 
							'harington_portfolio', 
							array(
								'hierarchical' => true, 
								'label' => __('Categories', 'harington_core_plugin_text_domain'), 
								'query_var' => true, 
								'show_in_rest' => true,
								'rewrite' => true )
						);
    }

}
add_action('init', 'harington_core_custom_types');


// refresh rewrite rules for custom portfolio slugs
if ( ! function_exists( 'harington_core_activation_hook' ) ){

    function harington_core_activation_hook() {

		harington_core_custom_types();
		
        flush_rewrite_rules();
    }
}
register_activation_hook( __FILE__, 'harington_core_activation_hook' );


?>
