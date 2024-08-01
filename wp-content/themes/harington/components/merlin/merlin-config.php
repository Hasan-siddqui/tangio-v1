<?php
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

	$config = array(
		'directory'            => 'components/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'merlin', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => false, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => '', // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'harington' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'harington' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'harington' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'harington' ),

		'btn-skip'                 => esc_html__( 'Skip', 'harington' ),
		'btn-next'                 => esc_html__( 'Next', 'harington' ),
		'btn-start'                => esc_html__( 'Start', 'harington' ),
		'btn-no'                   => esc_html__( 'Cancel', 'harington' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'harington' ),
		'btn-child-install'        => esc_html__( 'Install', 'harington' ),
		'btn-content-install'      => esc_html__( 'Install', 'harington' ),
		'btn-import'               => esc_html__( 'Import', 'harington' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'harington' ),
		'btn-license-skip'         => esc_html__( 'Later', 'harington' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'harington' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'harington' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'harington' ),
		'license-label'            => esc_html__( 'License key', 'harington' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'harington' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'harington' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'harington' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'harington' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'harington' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'harington' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'harington' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'harington' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'harington' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'harington' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'harington' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'harington' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'harington' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'harington' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'harington' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'harington' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'harington' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'harington' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'harington' ),

		'import-header'            => esc_html__( 'Import Content', 'harington' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme. If you are using Elementor, please skip this step and install the import.xml manually from demo-data folder as described in the documentation.', 'harington' ),
		'import-action-link'       => esc_html__( 'Advanced', 'harington' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'harington' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'harington' ),
		'ready-action-link'        => esc_html__( 'Extras', 'harington' ),
		'ready-big-button'         => esc_html__( 'View your website', 'harington' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'harington' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://clapatsupport.ticksy.com/', esc_html__( 'Get Theme Support', 'harington' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'harington' ) ),
	)
);
