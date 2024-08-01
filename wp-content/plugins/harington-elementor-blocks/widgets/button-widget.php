<?php
/**
 * Elementor Harington Button Widget.
 *
 * Elementor widget that inserts a button with a link and has different styles
 *
 * @since 1.0.0
 */
class Elementor_Harington_Button_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieves Button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Button', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Button widget belongs to.
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
	 * Register Button widget controls.
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
			'type',
			[
				'label'        => __( 'Type', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'normal',
				'options'      => array( 'normal' => __( 'Normal', 'harington-elementor-widgets' ),
										'outline' => __( 'Outline', 'harington-elementor-widgets' ) )
			]
		);

		$this->add_control(
			'rounded',
			[
				'label' => __( 'Rounded', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'harington-elementor-widgets' ),
				'label_off' => __( 'No', 'harington-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'show_label' => true,
				'default' => ''
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'show_label' => true,
				'default' => ''
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
	 * Render Button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$css_classes = '';
		$link_css_classes = '';
		$transition = '';
		if( $settings['type'] == 'outline' ){
			$css_classes .= ' outline';
		}
		if( $settings['rounded'] == 'yes' ){
			$css_classes .= ' rounded';
		}
		if( $settings['link_target'] == '_self' ){
			$link_css_classes .= ' ajax-link animation-link';
			$transition = ' data-type="page-transition"';
		}

		$harington_attributes = "";
		if( !empty( $settings['background_color'] ) ){

			$harington_attributes .= ' data-btncolor="' . esc_attr( $settings['background_color'] ) . '"';
		}
		if( !empty( $settings['text_color'] ) ){

			$harington_attributes .= ' data-btntextcolor="' . esc_attr( $settings['text_color'] ) . '"';
		}

		echo '<div class="button-box';

		$harington_animation = $settings['has_animation'];
		if( $harington_animation == 'no'){

			$harington_animation = false;
		}

		if( $harington_animation ){

			echo ' has-animation';
		}
		if( $harington_animation ){

			echo '" data-delay="'. esc_attr( $settings['animation_delay'] ) . '">';
		}
		else{

			echo '">';
		}

		echo '<div class="harington-button-wrap parallax-wrap hide-ball">';
		echo '<div class="harington-button parallax-element">';
		echo '<div class="button-border parallax-element-second' . $css_classes . '"' . $harington_attributes . '>';
		echo '<a class="'  . $link_css_classes . '" href="' . esc_url( $settings['url'] ) . '"' . $transition . ' target="' . esc_attr( $settings['link_target'] ) . '">';
		echo '<span data-hover="' . esc_attr( $settings['caption'] ) . '">' . wp_kses_post( $settings['caption'] ) . '</span>';
		echo '</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

}

?>
