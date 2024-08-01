<?php
/**
 * Elementor Harington Counter Widget.
 *
 * Elementor widget that enables you to add an animated numbered counter to your page
 *
 * @since 1.0.0
 */
class Elementor_Harington_Counter_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_counter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Counter', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-counter-circle';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Counter widget belongs to.
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
	 * Register Counter widget controls.
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
			'data_start',
			[
				'label' => __( 'Start Value', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'show_label' => true,
				'default' => 1000
			]
		);

		$this->add_control(
			'data_target',
			[
				'label' => __( 'Target Value', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'show_label' => true,
				'default' => 3000
			]
		);

		$this->add_control(
			'text_size',
			[
				'label'        => __( 'Text Size', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'h1',
				'options'      => array( 'h1' => __( 'H1', 'harington-elementor-widgets' ),
										'h2' => __( 'H2', 'harington-elementor-widgets' ),
									 	'h3' => __( 'H3', 'harington-elementor-widgets' ),
										'h4' => __( 'H4', 'harington-elementor-widgets' ),
										'h5' => __( 'H5', 'harington-elementor-widgets' ),
										'h6' => __( 'H6', 'harington-elementor-widgets' ))
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

		$this->add_control(
			'animation_delay',
			[
				'label' => __( 'Animation Delay', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'show_label' => true,
				'default' => 0
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$harington_animation = $settings['has_animation'];
		if( $harington_animation == 'no'){

			$harington_animation = false;
		}

		echo '<div class="number-counter-wrap';
		if( $harington_animation ){

			echo ' has-animation';
		}
		echo '"';
		if( $harington_animation ){

			echo ' data-delay="'. esc_attr( $settings['animation_delay'] ) . '"';
		}
		echo '>';

		echo '<' . esc_attr( $settings['text_size'] ) . ' class="number-counter" data-target="' . esc_attr( $settings['data_target'] ) . '">' . esc_attr( $settings['data_start'] ) . '</' . esc_attr( $settings['text_size'] ) . '>';

		echo '</div>';
	}

}

?>
