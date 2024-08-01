<?php
/**
 * Elementor Harington Heading Widget.
 *
 * Elementor widget displaying a heading title.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Heading_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Heading', 'harington-elementor-widgets' );
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
		return 'eicon-editor-h1';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the heading widget belongs to.
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
	 * Register heading widget controls.
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
			'title',
			[
				'label' => __( 'Title', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Add Your Heading Text Here', 'harington-elementor-widgets' )
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label'        => __( 'HTML Tag', 'harington-elementor-widgets' ),
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
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text-align-left' => [
						'title' => esc_html__( 'Left', 'harington-elementor-widgets' ),
						'icon' => 'eicon-text-align-left',
					],
					'text-align-center' => [
						'title' => esc_html__( 'Center', 'harington-elementor-widgets' ),
						'icon' => 'eicon-text-align-center',
					],
					'text-align-right' => [
						'title' => esc_html__( 'Right', 'harington-elementor-widgets' ),
						'icon' => 'eicon-text-align-right',
					],
					'text-align-justify' => [
						'title' => esc_html__( 'Justified', 'harington-elementor-widgets' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'text-align-center',
				'toggle' => true,
				'prefix_class' => ''
			]
		);
		
		$this->add_control(
			'css_classes',
			[
				'label' => esc_html__( 'Heading CSS Classes', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT
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
	 * Renders heading widget output on the frontend.
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
		
		$css_classes = $settings['css_classes'];
		if( $harington_animation ){
			
			if( !empty( $css_classes ) ){
			
				$css_classes .= ' ';
			}
			$css_classes .= 'has-animation';
		}
		
		echo '<' . $settings['html_tag'];
		if( !empty( $css_classes ) ){
			
			echo ' class="'. esc_attr( $css_classes ) . '"';
		}
		if( $harington_animation ){
			echo ' data-delay="'. esc_attr( $settings['animation_delay'] ) . '"';
		}
		echo '>';
		
		echo wp_kses_post( $settings['title'] );
		echo '</' . $settings['html_tag'] . '>';
	}

}

?>
