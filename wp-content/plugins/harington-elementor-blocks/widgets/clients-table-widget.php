<?php
/**
 * Elementor Harington Clients Table Widget.
 *
 * Elementor widget that inserts a list of clients.
 *
 * @since 1.0.0
 */
class Elementor_Harington_Clients_Table_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Clients Table widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_clients_table';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Clients Table widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Clients Table', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve clients table widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-product-images';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the clients table widget belongs to.
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
	 * Register Clients Table widget controls.
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
			'logo',
			[
				'label' => __( 'Client Logo', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_control(
			'url',
			[
				'label' => __( 'Client Link URL', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

		$this->add_control(
			'clients',
			[
				'label' => __( 'Clients', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->add_control(
			'has_borders',
			[
				'label' => __( 'Has Borders', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'harington-elementor-widgets' ),
				'label_off' => __( 'No', 'harington-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
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
	 * Render Clients Table widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		echo '<ul class="clients-table';
		if( $settings['has_animation'] === 'yes' ){

			echo ' has-animation';
		}
		if( $settings['has_borders'] !== 'yes' ){

			echo ' no-borders';
		}
		echo '" data-delay="10">';


		foreach ( $settings['clients'] as $client ) {

			$image_alt = get_post_meta( $client['logo']['id'], '_wp_attachment_image_alt', TRUE );

			echo '<li class="link">';
			if( !empty( $client['url'] ) ){

				echo '<a target="_blank" href="' . esc_url( $client['url'] ) . '">';
			}
			echo '<img src="' . esc_url( $client['logo']['url'] ) . '" alt="client image" />';
			if( !empty( $client['url'] ) ){

				echo '</a>';
			}
			echo '</li>';

		}

		echo '</ul>';

	}

}

?>
