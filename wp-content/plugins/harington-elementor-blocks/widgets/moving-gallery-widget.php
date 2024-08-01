<?php
/**
 * Elementor Harington Moving Gallery Widget.
 *
 * Elementor widget that inserts a moving gallery on scroll.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Moving_Gallery_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Moving Gallery widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_moving_gallery';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Moving Gallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Moving Gallery', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve moving gallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-exchange';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the moving gallery widget belongs to.
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
	 * Register Moving Gallery widget controls.
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
				'label' => __( 'Add Images To Gallery', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);
		
		$this->add_control(
			'direction',
			[
				'label'        => __( 'Direction', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'fw-gallery',
				'options'      => array( 'fw-gallery' => __( 'Forward', 'harington-elementor-widgets' ),
										'bw-gallery' => __( 'Backward', 'harington-elementor-widgets' ) )
			]
		);
		
		$this->add_control(
			'randomize',
			[
				'label' => __( 'Randomize gallery images size?', 'harington-elementor-widgets' ),
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
	 * Render Moving Gallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<div class="moving-gallery ' . esc_attr( $settings['direction'] );
		if( $settings['randomize'] === 'yes' ){
			
			echo ' random-sizes';
		}
		echo '">';
		echo '<ul class="wrapper-gallery">';
		foreach ( $settings['gallery'] as $image ) {

			$image_alt = get_post_meta( $image['id'], '_wp_attachment_image_alt', TRUE );

			echo '<li>';
			echo '<img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image_alt ) . '" />';
			echo '</li>';
		}
		echo '</ul>';
		echo '</div>';
		
	}

}

?>
