<?php

require_once ( get_template_directory() . '/include/defines.php' );

// Returns an array with published pages
if( !function_exists('harington_list_published_pages') ){

	function harington_list_published_pages(){
		
		$harington_list_pages = array('' => esc_html__('None', 'harington') );
		$harington_wp_published_pages = get_pages();
		foreach( $harington_wp_published_pages as $wp_published_page ){
			
			$harington_list_pages[ $wp_published_page->ID ] = $wp_published_page->post_title;
		}
		
		return $harington_list_pages;
	}
}

// Returns the default values for the social links
if( !function_exists('harington_social_network_default') ) {

	function harington_social_network_default( $idx ){

		if( $idx == 5 ){
			
			return "In"; // Instagram
		}
		else if( $idx == 3 ){
			
			return "Be"; // Behance
		}
		else if( $idx == 2 ){
			
			return "Tw"; // Twitter
		}
		else if( $idx == 1 ){
			
			return "Db"; // Dribbble
		}
		else {
			
			return "Fb"; // Facebook
		}
	}
}

if( !function_exists('harington_social_network_url_default') ) {

	function harington_social_network_url_default( $idx ){

		if( $idx == 5 ){
			
			return "https://www.instagram.com/clapat.themes/"; // Instagram
		}
		else if( $idx == 4 ){
			
			return "https://www.facebook.com/clapat.ro"; // Facebook
		}
		else if( $idx == 3 ){
			
			return "https://www.behance.com/clapat/"; // Behance
		}
		else if( $idx == 2 ){
			
			return "https://twitter.com/clapatdesign/"; // Twitter
		}
		else if( $idx == 1 ){
			
			return "https://dribbble.com/clapat/"; // Dribbble
		}
		else {
			
			return "";
		}
	}
}

// Metaboxes
require_once ( get_template_directory() . '/include/metabox-config.php');

// Customizer options
require_once( get_template_directory() . '/include/admin-config.php' );

// Load the default options
require_once( get_template_directory() . '/include/default-theme-options.php' );

if( !function_exists('harington_get_theme_options') ){

	function harington_get_theme_options( $option_id ){

		global $harington_default_theme_options;

		$default_value = false;
		if ( isset( $harington_default_theme_options ) && isset( $harington_default_theme_options[$option_id] ) ){

			$default_value  = $harington_default_theme_options[$option_id];

		}

		return get_theme_mod( $option_id, $default_value );

	}
}

if( !function_exists('harington_get_post_meta') ){

	function harington_get_post_meta( $opt_name = "", $thePost = array(), $meta_key = "", $def_val = "" ) {

		if( class_exists('Harington\Core\Metaboxes\Meta_Boxes') ){

			return Harington\Core\Metaboxes\Meta_Boxes::get_metabox_value( $thePost, $meta_key );
		}

		return "";
	}
}

if( !function_exists('harington_get_current_query') ){

	function harington_get_current_query(){

		global $harington_posts_query;
		global $wp_query;
		if( $harington_posts_query == null ){
			return $wp_query;
		}
		else{
			return $harington_posts_query;
		}

	}
}

// Portfolio Next Project Image
if( !function_exists('harington_portfolio_next_project_image') ){

	function harington_portfolio_next_project_image( $portfolio_image_param = null ){

		global $harington_portfolio_image_param;
		if( isset( $portfolio_image_param ) && ( $portfolio_image_param != null ) ){

			$harington_portfolio_image_param = $portfolio_image_param;
		}

		return $harington_portfolio_image_param;
	}
}

// Portfolio Thumbs List
if( !function_exists('harington_portfolio_thumbs_list') ){

	function harington_portfolio_thumbs_list( $portfolio_thumbs_param = null ){

		global $harington_portfolio_thumbs_param;
		if( isset( $portfolio_thumbs_param ) && ( $portfolio_thumbs_param != null ) ){

			$harington_portfolio_thumbs_param = $portfolio_thumbs_param;
		}

		return $harington_portfolio_thumbs_param;
	}
}

// Fetch Portfolio Items
if( !function_exists('harington_fetch_portfolio_items') ){

	function harington_fetch_portfolio_items(){

		$harington_portfolio_tax_query = null;
		$harington_portfolio_category_filter	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-filter-category' );

		$harington_array_terms = null;
		if( !empty( $harington_portfolio_category_filter ) ){

			$harington_array_terms = explode( ",", $harington_portfolio_category_filter );
			$harington_portfolio_tax_query = array(
												array(
													'taxonomy' 	=> 'portfolio_category',
													'field'		=> 'slug',
													'terms'		=> $harington_array_terms,
													),
											);
		}

		$harington_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$harington_args = array(
							'post_type' => 'harington_portfolio',
							'paged' => $harington_paged,
							'tax_query' => $harington_portfolio_tax_query,
							'posts_per_page' => 1000,
						);

		$harington_portfolio = new WP_Query( $harington_args );

		$harington_portfolio_items = array();
								
		// collect the posts first
		$harington_current_item_count = 1;
		while( $harington_portfolio->have_posts() ){

			$harington_portfolio->the_post();

			$harington_hero_properties = new Harington_Hero_Properties();
			$harington_hero_properties->getProperties( get_post_type( get_the_ID() ) );
			$harington_hero_properties->item_no = $harington_current_item_count;
			$harington_portfolio_items[] = $harington_hero_properties;
								
			$harington_current_item_count++;
		}

		wp_reset_postdata();

		harington_portfolio_thumbs_list( $harington_portfolio_items );
	}
}

// Display Back to Top Button
if( !function_exists('harington_display_back_to_top') ){

	function harington_display_back_to_top(){

		if( !is_page_template('portfolio-showcase-page.php') &&
			!is_page_template('portfolio-carousel-page.php') ){

			return true;
		} else {

			return false;
		}
	}
}

// Display Copyright
if( !function_exists('harington_display_copyright') ){

	function harington_display_copyright(){

		if( !is_page_template('portfolio-showcase-page.php') &&
			!is_page_template('portfolio-carousel-page.php') ){

			return true;
		} else {

			return false;
		}
	}
}

// Display Social Links
if( !function_exists('display_footer_social_links_section') ){

	function display_footer_social_links_section(){

		if( !is_page_template('portfolio-showcase-page.php') &&
			!is_page_template('portfolio-carousel-page.php') ){

			return true;
		} else {

			return false;
		}
	}
}

// Display Swiper Page Navigation
if( !function_exists('harington_display_swiper_page_navigation') ){

	function harington_display_swiper_page_navigation(){

		if( is_page_template('portfolio-showcase-page.php') ){

			return true;
		} else {

			return false;
		}
	}
}

// Check if the current post/page is built using Elementor
if( !function_exists('harington_post_is_built_with_elementor') ){

	function harington_post_is_built_with_elementor( $post_id = null ) {

		if ( ! class_exists( '\Elementor\Plugin' ) ) {

			return false;
		}

		if ( $post_id == null ) {

			$post_id = get_the_ID();
		}

		if ( is_singular() && \Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor() ) {

			return true;
		}

		return false;
	}

}

// Hero properties
require_once ( get_template_directory() . '/include/hero-properties.php');

// Support for automatic plugin installation
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/required_plugins.php');

// Merlin setup wizzard
require_once( get_template_directory() . '/components/merlin/vendor/autoload.php' );
require_once( get_template_directory() . '/components/merlin/class-merlin.php' );
require_once( get_template_directory() . '/components/merlin/merlin-config.php' );
require_once( get_template_directory() . '/components/merlin/merlin-filters.php' );

// Widgets
require_once(  get_template_directory() . '/components/widgets/widgets.php');

// Util functions
require_once ( get_template_directory() . '/include/util_functions.php');

// Add theme support
require_once ( get_template_directory() . '/include/theme-support-config.php');

// Theme setup
require_once ( get_template_directory() . '/include/setup-config.php');

// Enqueue scripts
require_once ( get_template_directory() . '/include/scripts-config.php');

// Hooks
require_once ( get_template_directory() . '/include/hooks-config.php');

// Blog comments and pagination
require_once ( get_template_directory() . '/include/blog-config.php');

// Editor styles
add_editor_style( 'style-editor.css' );
?>
