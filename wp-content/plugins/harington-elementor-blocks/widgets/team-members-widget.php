<?php
/**
 * Elementor Harington Team Members Widget.
 *
 * Elementor widget that inserts a team members element into the page.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Team_Members_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Team Members widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_team_members';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Team Members widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team Members', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget's icon.
	 *
	 * Retrieve accordion Team Members icon.
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
	 * Get widget's categories.
	 *
	 * Retrieve the list of categories the Team Members widget belongs to.
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
	 * Register team members widget controls.
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
	 * Render Team Members widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<ul class="team-members-list';
		if( $settings['has_animation'] === 'yes' ){

			echo ' has-animation"';
		}
		echo '" data-fx="1">';

		foreach ( $settings['team_members'] as $team_member ) {

			echo '<li class="hide-ball has-hover-image" data-img="' . esc_url( $team_member['picture']['url'] ) . '">';
 			echo '<div class="team-member has-animation"><div>' . wp_kses_post( $team_member['name'] ) . '</div><span>' . wp_kses_post( $team_member['job_title'] ) . '</span></div>';
			echo '</li>';

		}

		echo '</ul>';

	}

}

?>
