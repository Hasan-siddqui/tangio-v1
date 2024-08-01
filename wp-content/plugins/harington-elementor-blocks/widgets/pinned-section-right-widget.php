<?php
/**
 * Elementor Right Pinned Section Widget.
 *
 * Elementor widget that inserts a section with a pinned section content to the right and scrolling image to the left
 *
 * @since 1.0.0
 */
class Elementor_Harington_Pinned_Section_Right_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve  widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_pinned_section_right';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve right pinned section widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Right Pinned Section', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve pinned section right widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-align-start-h';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the pinned section right widget belongs to.
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
	 * Register right pinned section widget controls.
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
			'scrolling_text',
			[
				'label' => __( 'Scrolling Text (HTML allowed)', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'html',
				'rows' => 20,
			]
		);

		$this->add_control(
			'pinned_text',
			[
				'label' => __( 'Right Pinned Text (HTML allowed)', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'html',
				'rows' => 20,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Renders right pinned section widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<div class="pinned-section">';

		echo '<div class="scrolling-element left">';
		echo wp_kses_post( $settings['scrolling_text'] );
		echo '</div>';

		echo '<div class="pinned-element right">';
		echo wp_kses_post( $settings['pinned_text'] );
		echo '</div>';

		echo '</div>';

	}

}

?>
