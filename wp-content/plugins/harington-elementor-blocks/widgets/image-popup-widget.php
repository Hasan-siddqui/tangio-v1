<?php
/**
 * Elementor Harington Image Popup Widget.
 *
 * Elementor widget that a popup image - the high res version of the thumbnail.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Image_Popup_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image popup widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_image_popup';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image popup widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Image Popup', 'harington-elementor-widgets' );
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
		return 'eicon-lightbox';
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
	 * Register image popup widget controls.
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
			'fullres',
			[
				'label' => __( 'Full image', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
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

		$this->add_control(
			'has_parallax',
			[
				'label' => __( 'Has Parallax', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'harington-elementor-widgets' ),
				'label_off' => __( 'No', 'harington-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'start_parallax',
			[
				'label' => __( 'Start Parallax. A value between 0 and 1 representing the top parallax translation.', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
				'default' => '0.0',
			]
		);

		$this->add_control(
			'end_parallax',
			[
				'label' => __( 'End Parallax. A value between 0 and 1 representing the bottom parallax translation.' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
				'default' => '0.0',
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
		$harington_elementor_img_caption = wp_get_attachment_caption( $settings['thumbnail']['id'] );
		$harington_animation = $settings['animation'];
		$harington_animation_delay = $settings['animation_delay'];
		$harington_has_parallax = $settings['has_parallax'];
		$harington_start_parallax = $settings['start_parallax'];
		$harington_end_parallax = $settings['end_parallax'];

		if( $harington_has_parallax == 'yes' ){

			echo '<div class="vertical-parallax" data-startparallax="' . esc_attr( $harington_start_parallax ) . '" data-endparallax="' . esc_attr( $harington_end_parallax ) . '">';
		}

		echo '<figure class="';
		if( $harington_animation == "fade" ){

			echo 'has-animation';
		}
		else if( $harington_animation == "cover" ){

			echo 'has-animation has-cover';
		}
		echo '"';
		if( $harington_animation != "none" ){

			echo ' data-delay="'. esc_attr( $harington_animation_delay ) . '"';
		}
		echo '>';
		echo '<a href="' . esc_url( $settings['fullres']['url'] ) . '" class="image-link">';
		echo '<img src="' . esc_url( $settings['thumbnail']['url'] ) . '" alt="' . esc_attr( $harington_elementor_img_alt ) . '">';
		echo '</a>';
		echo '<figcaption>' . wp_kses_post( $harington_elementor_img_caption ) . '</figcaption>';
    echo '</figure>';

		if( $harington_has_parallax == 'yes' ){

			echo '</div>';
		}

	}

}

?>
