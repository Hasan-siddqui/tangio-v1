<?php
/**
 * Plugin Name: Harington Elementor Widgets
 * Description: Elementor widgets for Harington WordPress Theme
 * Plugin URI:  https://clapat-themes.com/
 * Version:     1.0
 * Author:      ClaPat
 * Author URI:  https://clapat-themes.com/
 * Text Domain: harington-elementor-widgets
 * Elementor tested up to: 3.10.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Elementor Harington Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Elementor_Harington_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Harington_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Harington_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'harington-elementor-widgets' );

	}

	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_plugins_loaded() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		$this->i18n();

		// Add Plugin actions
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/element/section/section_layout/after_section_start', [ $this, 'init_section_controls' ], 10, 2 );
		add_action( 'elementor/element/section/section_layout/before_section_end', [ $this, 'remove_section_controls' ], 10, 2 );

	}

	/**
	 * Adds Harington widget category
	 *
	 * Adds the Harington category under which all theme's widgets are shown
	 *
	 * Fired by `categories_registered` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'harington-widgets',
			[
				'title' => __( 'Harington', 'harington-elementor-widgets' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/heading-widget.php' );
		require_once( __DIR__ . '/widgets/portfolio-grid-widget.php' );
		require_once( __DIR__ . '/widgets/portfolio-list-widget.php' );
		require_once( __DIR__ . '/widgets/pinned-section-right-widget.php' );
		require_once( __DIR__ . '/widgets/pinned-section-left-widget.php' );
		require_once( __DIR__ . '/widgets/slowed-text-pin-widget.php' );
		require_once( __DIR__ . '/widgets/image-slider-widget.php' );
		require_once( __DIR__ . '/widgets/carousel-slider-widget.php' );
		require_once( __DIR__ . '/widgets/image-collage-widget.php' );
		require_once( __DIR__ . '/widgets/zoom-gallery-widget.php' );
		require_once( __DIR__ . '/widgets/scrolling-panels-widget.php' );
		require_once( __DIR__ . '/widgets/moving-gallery-widget.php' );
		require_once( __DIR__ . '/widgets/accordion-widget.php' );
		require_once( __DIR__ . '/widgets/clients-table-widget.php' );
		require_once( __DIR__ . '/widgets/team-members-widget.php' );
		require_once( __DIR__ . '/widgets/team-members-carousel-widget.php' );
		require_once( __DIR__ . '/widgets/team-members-scrolling-panels-widget.php' );
		require_once( __DIR__ . '/widgets/google-maps-widget.php' );
		require_once( __DIR__ . '/widgets/image-popup-widget.php' );
		require_once( __DIR__ . '/widgets/video-popup-widget.php' );
		require_once( __DIR__ . '/widgets/image-parallax-widget.php' );
		require_once( __DIR__ . '/widgets/marquee-widget.php' );
		require_once( __DIR__ . '/widgets/moving-title-widget.php' );
		require_once( __DIR__ . '/widgets/button-widget.php' );
		require_once( __DIR__ . '/widgets/button-link-widget.php' );
		require_once( __DIR__ . '/widgets/icon-box-widget.php' );
		require_once( __DIR__ . '/widgets/counter-widget.php' );
		require_once( __DIR__ . '/widgets/video-player-widget.php' );
		require_once( __DIR__ . '/widgets/news-widget.php' );

		// Register Harington widgets
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Heading_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Portfolio_Grid_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Portfolio_List_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Pinned_Section_Right_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Pinned_Section_Left_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Slowed_Text_Pin_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Image_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Carousel_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Image_Collage_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Zoom_Gallery_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Scrolling_Panels_Gallery_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Moving_Gallery_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Accordion_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Clients_Table_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Team_Members_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Team_Members_Carousel_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Team_Members_Scrolling_Panels_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Google_Maps_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Image_Popup_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Video_Popup_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Image_Parallax_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Marquee_Text_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Moving_Title_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Button_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Button_Link_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Icon_Box_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Counter_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_Video_Player_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Harington_News_Widget() );

		// Unregister unwanted widgets
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'image-carousel' );
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'progress' );
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'counter' );
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'menu-anchor' );
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'tabs' );
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'accordion' );
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'toggle' );
		\Elementor\Plugin::instance()->widgets_manager->unregister( 'video' );
	}

	/**
	 * Init Controls
	 *
	 * Adds theme specific controls to existing Inner Section widget
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_section_controls( $element, $args ) {

		$element->add_control(
			'section_background_type' ,
			[
				'label'        => 'Background Type',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'light-section',
				'options'      => array( 'dark-section' => __( 'Dark', 'harington-elementor-widgets' ),
										'light-section' => __( 'Light', 'harington-elementor-widgets' ) ),
				'prefix_class' => ''
			]
		);

		$element->add_control(
			'section_header_color' ,
			[
				'label'        => 'Header Color',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'inherit-header-color',
				'options'      => array( 'inherit-header-color' => __( 'Inherit', 'harington-elementor-widgets' ),
										'change-header-color' => __( 'Invert', 'harington-elementor-widgets' ) ),
				'prefix_class' => ''
			]
		);

		$element->add_control(
			'section_top_padding' ,
			[
				'label'        => 'Top Padding?',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array( 'row_padding_top' => __( 'Yes', 'harington-elementor-widgets' ),
										'' => __( 'No', 'harington-elementor-widgets' ) ),
				'prefix_class' => ''
			]
		);

		$element->add_control(
			'section_bottom_padding' ,
			[
				'label'        => 'Bottom Padding?',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array( 'row_padding_bottom' => __( 'Yes', 'harington-elementor-widgets' ),
										'' => __( 'No', 'harington-elementor-widgets' ) ),
				'prefix_class' => ''
			]
		);

		$element->add_control(
			'section_left_padding' ,
			[
				'label'        => 'Left Padding?',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array( 'row_padding_left' => __( 'Yes', 'harington-elementor-widgets' ),
										'' => __( 'No', 'harington-elementor-widgets' ) ),
				'prefix_class' => ''
			]
		);

		$element->add_control(
			'section_right_padding' ,
			[
				'label'        => 'Right Padding?',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array( 'row_padding_right' => __( 'Yes', 'harington-elementor-widgets' ),
										'' => __( 'No', 'harington-elementor-widgets' ) ),
				'prefix_class' => ''
			]
		);

		$element->add_control(
			'section_container_width' ,
			[
				'label'        => 'Content Width',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'elementor-default-width content-max-width',
				'options'      => array( 'elementor-default-width content-max-width' => __( 'Default', 'harington-elementor-widgets' ),
										'elementor-full-width content-max-width' => __( 'Full', 'harington-elementor-widgets' ),
										'elementor-small-width content-max-width' => __( 'Small', 'harington-elementor-widgets' ) ),
				'prefix_class' => ''
			]
		);

	}

	/**
	 * Remove Section Controls
	 *
	 * Remove specific controls from Inner Section widget
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function remove_section_controls( $section, $args ) {

		// Remove content width slider control
		$section->remove_control('layout');
		$section->remove_control('content_width');
		$section->remove_control('stretch_section');
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'harington-elementor-widgets' ),
			'<strong>' . esc_html__( 'Elementor Harington Extension', 'harington-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'harington-elementor-widgets' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'harington-elementor-widgets' ),
			'<strong>' . esc_html__( 'Elementor Harington Extension', 'harington-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'harington-elementor-widgets' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'harington-elementor-widgets' ),
			'<strong>' . esc_html__( 'Elementor Harington Extension', 'harington-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'harington-elementor-widgets' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

}

Elementor_Harington_Extension::instance();

?>
