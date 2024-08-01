<?php
/**
 * Elementor Harington Icon Box Widget.
 *
 * Elementor widget that inserts a box containing h5 header text and icon
 *
 * @since 1.0.0
 */
class Elementor_Harington_Icon_Box_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Icon Box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_icon_box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Icon Box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Icon Box', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Icon Box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Icon Box widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'harington-widgets' ];
	}

	/**
	 * Register Icon Box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'harington-elementor-widgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'show_label' => true,
			]
		);

		$this->add_control(
			'header',
			[
				'label' => __( 'Header Text', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content Text', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

		$this->add_control(
			'type',
			[
				'label'        => __( 'Type', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'inline-boxes',
				'options'      => array( 'inline-boxes' => __( 'Inline', 'harington-elementor-widgets' ),
										'block-boxes' => __( 'Block', 'harington-elementor-widgets' ) )
			]
		);

		$this->add_control(
			'has_animation',
			[
				'label' => __( 'Has Animation', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'harington-elementor-widgets' ),
				'label_off' => __( 'No', 'harington-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Icon Box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<div class="box-icon-wrapper ' . sanitize_html_class( $settings['type'] );
		if( $settings['has_animation'] === 'yes' ){

			echo ' has-animation';
		}
		echo '">';
		echo '<div class="box-icon">';
		\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
		echo '</div>';
		echo '<div class="box-icon-content">';
		echo '<h5 class="no-margins">' . wp_kses_post( $settings['content'] ) . '</h5>';
		echo '<p>' . wp_kses_post( $settings['header'] ) . '</p>';
		echo '</div>';
		echo '</div>';

	}

}

?>
