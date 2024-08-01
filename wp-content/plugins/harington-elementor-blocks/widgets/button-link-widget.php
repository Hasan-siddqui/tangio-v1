<?php
/**
 * Elementor Harington Button Link Widget.
 *
 * Elementor widget that inserts a button link opening in a new tab
 *
 * @since 1.0.0
 */
class Elementor_Harington_Button_Link_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Button Link widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_button_link';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Button Link widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Button Link', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Button Link widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-long-arrow-right';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Button Link widget belongs to.
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
	 * Register Button Link widget controls.
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
			'caption',
			[
				'label' => __( 'Caption', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __( 'Link URL', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'       	=> __( 'Link Target', 'harington-elementor-widgets' ),
				'type'        	=> \Elementor\Controls_Manager::SELECT,
				'default'     	=> '_blank',
				'options'     	=> array( '_blank' => __( 'Blank', 'harington-elementor-widgets' ),
										'_self' => __( 'Self', 'harington-elementor-widgets' ) )
			]
		);

		$this->add_control(
			'size',
			[
				'label'        => __( 'Size', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'small-btn',
				'options'      => array( 'small-btn' => __( 'Small', 'harington-elementor-widgets' ),
										'large-btn' => __( 'Large', 'harington-elementor-widgets' ) )
			]
		);

		$this->add_control(
			'position',
			[
				'label'        => __( 'Position', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'left',
				'options'      => array( 'left' => __( 'Left', 'harington-elementor-widgets' ),
										'right' => __( 'Right', 'harington-elementor-widgets' ) )
			]
		);

		$this->add_control(
			'type',
			[
				'label'        => __( 'Type', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'arrow',
				'options'      => array( 'arrow' => __( 'Arrow', 'harington-elementor-widgets' ),
										'bullet' => __( 'Bullet', 'harington-elementor-widgets' ) )
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
	 * Render Button Link widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<div class="button-wrap ' . sanitize_html_class( $settings['position'] ) . ' ' . sanitize_html_class( $settings['size'] );
		if( $settings['type'] == 'bullet' ){

			echo ' button-link';
		}
		if( $settings['has_animation'] === 'yes' ){

			echo ' has-animation';
		}
		echo '"';
		if( $settings['has_animation'] === 'yes' ){

			echo ' data-delay="' . esc_attr( $settings['animation_delay'] ) . '"';
		}
		echo '>';
		echo '<div class="icon-wrap parallax-wrap">';
		echo '<div class="button-icon parallax-element">';
		if( $settings['type'] == 'arrow' ){

			echo '<i class="arrow-icon-down"></i>';
		}
		else {

			echo '<i class="fa-solid fa-arrow-right"></i>';
		}
		echo '</div>';
		echo '</div>';
		echo '<a target="' . esc_attr( $settings['link_target'] ) . '" href="' . esc_url( $settings['url'] ) . '">';
		echo '<div class="button-text sticky ' . esc_attr( $settings['position'] ) . '">';
		echo '<span data-hover="' . esc_attr( $settings['caption'] ) . '">';
		echo wp_kses_post( $settings['caption'] );
		echo '</span>';
		echo '</div>';
		echo '</a>';
		echo '</div>';
	}

}

?>
