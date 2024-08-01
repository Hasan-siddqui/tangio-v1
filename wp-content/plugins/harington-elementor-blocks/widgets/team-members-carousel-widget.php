<?php
/**
 * Elementor Harington Team Members Carousel Widget.
 *
 * Elementor widget that inserts a team members carousel element into the page.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Team_Members_Carousel_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Team Members Carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_team_members_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * Get the Team Members Carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team Members Carousel', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve accordion widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Team Members Carousel widget belongs to.
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
	 * Register team members carousel widget controls.
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
			'cursor_type',
			[
				'label'        => __( 'Cursor Type', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'light-cursor',
				'options'      => array( 'light-cursor' => __( 'Light', 'harington-elementor-widgets' ),
										'dark-cursor' => __( 'Dark', 'harington-elementor-widgets' ) )
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name',
			[
				'label' => __( 'Team Member Name', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true
			]
		);

		$repeater->add_control(
			'picture',
			[
				'label' => __( 'Team Member Photo', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_control(
			'job_title',
			[
				'label' => __( 'Job Title', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'team_members',
			[
				'label' => __( 'Team Members', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Team Member #1', 'harington-elementor-widgets' ),
						'job_title' => __( 'The Job Title.', 'harington-elementor-widgets' ),
					],
					[
						'name' => __( 'Team Member #2', 'harington-elementor-widgets' ),
						'job_title' => __( 'The Job Title.', 'harington-elementor-widgets' ),
					],
				],
				'title_field' => '{{{ name }}}',
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
	 * Render accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<div class="swiper-container team-looped-carousel autocenter ' . sanitize_html_class( $settings['cursor_type'] );
		if( $settings['has_animation'] === 'yes' ){

			echo ' has-animation';
		}
		echo '">';
		echo '<div class="swiper-wrapper">';

		foreach ( $settings['team_members'] as $team_member ) {

			$alt_text = trim( strip_tags( get_post_meta( $team_member['picture']['id'], '_wp_attachment_image_alt', true ) ) );

			echo '<div class="swiper-slide">';
			echo '<div class="slide-img"><img src="' . esc_url( $team_member['picture']['url'] ) . '" alt="' . esc_attr( $alt_text ) . '"></div>';
			echo '<div class="team-caption">';
			echo '<h5>' . wp_kses_post( $team_member['name'] ) . '</h5>';
			echo '<p>' . wp_kses_post( $team_member['job_title'] ) . '</p>';
			echo '</div>';
			echo '</div>';

		}

		echo '</div>';
		echo '</div>';

	}

}

?>
