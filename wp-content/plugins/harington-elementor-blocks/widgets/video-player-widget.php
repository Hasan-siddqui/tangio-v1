<?php
/**
 * Elementor Harington Video Player Widget.
 *
 * Elementor widget that inserts a video player with self hosted videos in webm and mp4 formats
 *
 * @since 1.0.0
 */
class Elementor_Harington_Video_Player_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Video Player widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_video_player';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Video Player widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Video Player', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Video Player widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-youtube';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Video Player widget belongs to.
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
	 * Register Video Player widget controls.
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
			'poster_image',
			[
				'label' => __( 'Poster Image', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'mp4_url',
			[
				'label' => __( 'URL of the video file in MP4 format', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
			]
		);

		$this->add_control(
			'webm_url',
			[
				'label' => __( 'URL of the video file in WEBM format', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
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

		$this->end_controls_section();

	}

	/**
	 * Render Video Player widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<!-- Video Player -->';
    echo '<div class="video-wrapper';
		if( $settings['has_animation'] === 'yes' ){

			echo ' has-animation';
		}
		echo '">';

		echo '<div class="video-cover" data-src="' . esc_url( $settings['poster_image']['url'] ) . '"></div>';
    echo '<video class="bgvid" controls preload="auto" >';
		if( !empty( $settings['webm_url'] ) ){
    	echo '<source src="' . esc_url( $settings['webm_url'] ) . '" />';
		}
		if( !empty( $settings['mp4_url'] ) ){
    	echo '<source src="' . esc_url( $settings['mp4_url'] ) . '" />';
		}
    echo '</video>';

    echo '<div class="control">';
    echo '<div class="btmControl">';
    echo '<div class="progress-bar">';
    echo '<div class="progress">';
    echo '<span class="bufferBar"></span>';
    echo '<span class="timeBar"></span>';
    echo '</div>';
    echo '</div>';
    echo '<div class="video-btns">';
    echo '<div class="sound sound2 btn" title="' . __( 'Mute/Unmute sound', 'harington-elementor-widgets' ) . '">';
    echo '<i class="fa fa-volume-up" aria-hidden="true"></i>';
    echo '<i class="fa fa-volume-off" aria-hidden="true"></i>';
    echo '</div>';
    echo '<div class="btnFS btn" title="' . __( 'Switch to full screen', 'harington-elementor-widgets' ) . '">';
    echo '<i class="fa fa-expand" aria-hidden="true"></i>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '</div>';
    echo '<!--/Video Player -->';

	}

}

?>
