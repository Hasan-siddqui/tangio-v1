<?php
/**
 * Available filters for extending Merlin WP.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

/**
 * Filter the home page title from your demo content.
 * If your demo's home page title is "Home", you don't need this.
 *
 * @param string $output Home page title.
 */
function harington_merlin_content_home_page_title( $output ) {
	return 'Portfolio';
}
add_filter( 'merlin_content_home_page_title', 'harington_merlin_content_home_page_title' );

/**
 * Child theme screenshot
 */
function harington_merlin_generate_child_screenshot() {
	return get_template_directory() . '/components/merlin/assets/images/screenshot.png';
}
add_filter( 'merlin_generate_child_screenshot', 'harington_merlin_generate_child_screenshot' );

	
/**
 * Define the demo import files (remote files).
 *
 * To define imports, you just have to add the following code structure,
 * with your own values to your theme (using the 'merlin_import_files' filter).
 */
function harington_merlin_import_files() {
	return array(
		array(
			'import_file_name'           => 'Demo Import Gutenberg',
			'import_file_url'            => 'http://clapat-themes.com/demo-data/harington/gutenberg/import.xml',
			'import_widget_file_url'     => 'http://clapat-themes.com/demo-data/harington/gutenberg/widgets.wie',
			'import_customizer_file_url' => 'http://clapat-themes.com/demo-data/harington/gutenberg/customizer.dat',
			'import_notice'              => __( 'Demo built with Gutenberg.', 'harington' ),
			'preview_url'                => 'http://clapat-themes.com/wordpress/harington/',
		)
	);
}
add_filter( 'merlin_import_files', 'harington_merlin_import_files' );

/**
 * Execute custom code after the whole import has finished.
 */
function harington_merlin_after_import_setup() {
	
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Landing Page' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	
	// Update CPT Support for Elementor
	$cpt_support = get_option( 'elementor_cpt_support' );

	if ( ! $cpt_support ) {
		
		$cpt_support = array( 'page', 'post', 'harington_portfolio' );
		update_option( 'elementor_cpt_support', $cpt_support );
	} elseif ( ! in_array( 'arts_portfolio_item', $cpt_support ) ) {
		
		$cpt_support[] = 'harington_portfolio';
		update_option( 'elementor_cpt_support', $cpt_support );
	}

}
add_action( 'merlin_after_all_import', 'harington_merlin_after_import_setup' );
