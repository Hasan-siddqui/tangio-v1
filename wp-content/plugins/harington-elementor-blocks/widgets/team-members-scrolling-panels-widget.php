<?php
/**
 * Elementor Harington Team Members In Scrolling Panels.
 *
 * Elementor widget that inserts a team members in scrolling panels element into the page.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Team_Members_Scrolling_Panels_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Team Members In Scrolling Panels widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_team_members_scrolling_panels';
	}

	/**
	 * Get widget title.
	 *
	 * Get the Team Members In Scrolling Panels widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team Members In Scrolling Panels', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve team members in scrolling panels widget icon.
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
	 * Retrieve the list of categories the Team Members In Scrolling Panels widget belongs to.
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
	 * Register team members in scrolling panels widget controls.
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

		$this->end_controls_section();

	}

	/**
	 * Render Team Members In Scrolling Panels widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<div id="team-panels" class="panels">';
		echo '<div class="panels-container">';

		foreach ( $settings['team_members'] as $team_member ) {

			$alt_text = trim( strip_tags( get_post_meta( $team_member['picture']['id'], '_wp_attachment_image_alt', true ) ) );

			echo '<div class="panel">';
			echo '<div class="panel-content-wrapper">';
			echo '<div class="panel-image">';
			echo '<img src="' . esc_url( $team_member['picture']['url'] ) . '" alt="' . esc_attr( $alt_text ) . '">';
			echo '</div>';
			echo '<div class="panel-content">';
			echo '<div class="team-name-panel">' . wp_kses_post( $team_member['name'] ) . '</div>';
			echo '<div class="team-cat-panel">' . wp_kses_post( $team_member['job_title'] ) . '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';

		}

		echo '</div>';
		echo '</div>';

	}

}

?>
