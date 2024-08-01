<?php
/**
 * Elementor Harington Slowed Text Pin Widget.
 *
 * Elementor widget that inserts pinned text with images scrolling in the background.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Slowed_Text_Pin_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Slowed Text Pin widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_slowed_text_pin';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Slowed Text Pin widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Slowed Text Pin', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Slowed Text Pin widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-box';
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
	 * Register Slowed Text Pin widget controls.
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
				'label' => __( 'Add Scrolling Background Images', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->add_control(
			'pre_title_text',
			[
				'label' => __( 'Pre-title pinned text', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'show_label' => true,
			]
		);
		
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title pinned text', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'show_label' => true,
			]
		);

		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub-title pinned text', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'show_label' => true,
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

		echo '<div class="slowed-pin">';
		echo '<div class="slowed-text">';
		echo '<h5>' . wp_kses_post( $settings[ 'pre_title_text' ] ) . '</h5>';
		echo '<h1 class="big-title">' . wp_kses_post( $settings[ 'title_text' ] ) . '</h1>';
		echo '<hr>';
		echo '<h5>' . wp_kses_post( $settings[ 'subtitle_text' ] ) . '</h5>';
		echo '</div>';
		echo '<div class="slowed-images">';
		foreach ( $settings['gallery'] as $image ) {

			$image_alt = get_post_meta( $image['id'], '_wp_attachment_image_alt', TRUE );

			echo '<div class="slowed-image">';
			echo '<img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image_alt ) . '" />';
			echo '</div>';

		}
		echo '</div>';
		echo '</div>';

	}

}

?>
