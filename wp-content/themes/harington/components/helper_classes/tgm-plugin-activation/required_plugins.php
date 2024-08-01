<?php
/**
 * This file represents the code that themes use to register
 * the required plugins.
 *
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Helper
 * @version	   1.0
 * @author	   Clapat
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/components/helper_classes/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'harington_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function harington_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name' 		=> esc_html__( 'Contact Form 7', 'harington' ),
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),
		
		array(
			'name'					=> esc_html__( 'Harington Core Plugin', 'harington' ), // The plugin name
			'version'				=> '1.1',
			'slug'					=> 'harington-core-plugin', // The plugin slug (typically the folder name)
			'source'				=> get_parent_theme_file_path()  . '/plugins_required/harington-core-plugin.zip', // The plugin source
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required
		),
		
		array(
			'name'					=> esc_html__( 'Harington Gutenberg Blocks', 'harington' ), // The plugin name
			'version'				=> '1.0',
			'slug'					=> 'harington-gutenberg-blocks', // The plugin slug (typically the folder name)
			'source'				=> get_parent_theme_file_path() . '/plugins_required/harington-gutenberg-blocks.zip', // The plugin source
			'required'				=> false, // If false, the plugin is only 'recommended' instead of required
		),
	);
	
	if ( class_exists( '\Elementor\Plugin' ) ) {
		
		$plugins[] = array(
							'name'					=> esc_html__( 'Harington Elementor Widgets', 'harington' ), // The plugin name
							'version'				=> '1.0',
							'slug'					=> 'harington-elementor-blocks', // The plugin slug (typically the folder name)
							'source'				=> get_parent_theme_file_path() . '/plugins_required/harington-elementor-blocks.zip', // The plugin source
							'required'				=> false, // If false, the plugin is only 'recommended' instead of required
						);
	}

	
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'harington';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'harington-tgmpa',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'harington'),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'harington'),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'harington'), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'harington'),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'harington'), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'harington'), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'harington'), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'harington'), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'harington'), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'harington'), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'harington'), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'harington'), // %1$s = plugin name(s)
			'install_link' 								=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'harington'),
			'activate_link' 							=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'harington'),
			'return'									=> esc_html__( 'Return to Required Plugins Installer', 'harington'),
			'plugin_activated'							=> esc_html__( 'Plugin activated successfully.', 'harington'),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'harington'), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}