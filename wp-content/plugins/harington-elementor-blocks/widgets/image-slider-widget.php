<?php
/**
 * Elementor Harington Image Slider Widget.
 *
 * Elementor widget that inserts an image slider.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Image_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Image Slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_image_slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Image Slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Image Slider', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slides';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
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
	 * Register Image Slider widget controls.
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
			'gallery',
			[
				'label' => __( 'Add Images', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->add_control(
			'cursor_type',
			[
				'label'        => __( 'Cursor Type', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'light-cursor',
				'options'      => array( 'light-cursor' => __( 'Light', 'harington-elementor-widgets' ),
										'dark-cursor' => __( 'Dark', 'harington-elementor-widgets' ) )
			]
		);

		$this->add_control(
			'enable_dots_nav',
			[
				'label' => __( 'Enable Dots Navigation', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'harington-elementor-widgets' ),
				'label_off' => __( 'No', 'harington-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autocenter',
			[
				'label' => __( 'Autocenter', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'harington-elementor-widgets' ),
				'label_off' => __( 'No', 'harington-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
	 * Render Image Slider widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<div class="swiper-container content-slider';
		if( $settings['has_animation'] === 'yes' ){

			echo ' has-animation';
		}
		echo ' ' . sanitize_html_class( $settings['cursor_type'] );
		if( $settings['autocenter'] === 'yes' ){

			echo ' autocenter';
		}
		if( $settings['enable_dots_nav'] !== 'yes' ){

			echo ' disabled-slider-dots';
		}
		echo '"';
		if( $settings['has_animation'] === 'yes' ){

			echo ' data-delay="' . esc_attr( $settings['animation_delay'] ) . '"';
		}
		echo '>';
		echo '<div class="swiper-wrapper">';

		foreach ( $settings['gallery'] as $image ) {

			$image_alt = get_post_meta( $image['id'], '_wp_attachment_image_alt', TRUE );

			echo '<div class="swiper-slide">';
			echo '<div class="slide-img">';
			echo '<img src="' . esc_url(  $image['url'] ) . '" alt="' . esc_attr( $image_alt ) . '" />';
			echo '</div>';
			echo '</div>';

		}

		echo '</div>';
		echo '<div class="slider-button-next"></div>';
		echo '<div class="slider-button-prev"></div>';
		echo '<div class="swiper-pagination"></div>';
		echo '</div>';

	}

}

?>
