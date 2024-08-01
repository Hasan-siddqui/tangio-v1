<?php
/**
 * Elementor Harington Video Popup Widget.
 *
 * Elementor widget displaying video in a pop up
 *
 * @since 1.0.0
 */
class Elementor_Harington_Video_Popup_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve video popup widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_video_popup';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve video popup widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Video Popup', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve video popup widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-video-playlist';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the video popup widget belongs to.
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
	 * Register video popup widget controls.
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
			'thumbnail',
			[
				'label' => __( 'Thumbnail image', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'video_url',
			[
				'label' => __( 'Video URL', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

		$this->add_control(
			'animation',
			[
				'label'        => __( 'Animation', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'none',
				'options'      => array( 'none' => __( 'None', 'harington-elementor-widgets' ),
																'cover' => __( 'Cover', 'harington-elementor-widgets' ),
																'fade' => __( 'Fade', 'harington-elementor-widgets' ) )
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
	 * Renders image popup widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$harington_elementor_img_alt = trim( strip_tags( get_post_meta( $settings['thumbnail']['id'], '_wp_attachment_image_alt', true ) ) );
		$harington_animation = $settings['animation'];
		$harington_animation_delay = $settings['animation_delay'];

		echo '<figure class="';
		if( $harington_animation == "fade" ){

			echo 'has-animation';
		}
		else if( $harington_animation == "cover" ){

			echo 'has-animation has-cover';
		}
		echo '"';
		if( $harington_animation != "none" ){

			echo ' data-delay="'. $settings['animation_delay'] . '"';
		}
		echo '>';
		echo '<a class="video-link" href="' . esc_url( $settings['video_url'] ) . '">';
		echo '<img src="' . esc_url( $settings['thumbnail']['url'] ) . '" alt="' . esc_attr( $harington_elementor_img_alt ) . '" />';
		echo '</a>';
		echo '</figure>';
	}

}

?>
