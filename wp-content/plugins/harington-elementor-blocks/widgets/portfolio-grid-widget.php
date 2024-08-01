<?php
/**
 * Elementor Harington Portfolio Grid Widget.
 *
 * Elementor widget that inserts a portfolio grid containing the thumbnails of portfolio items defined in the system
 *
 * @since 1.0.0
 */
class Elementor_Harington_Portfolio_Grid_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Portfolio Grid widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_portfolio_grid';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Portfolio Grid widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Portfolio Grid', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Portfolio Grid widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-masonry';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Portfolio Grid widget belongs to.
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
	 * Register Portfolio Grid widget controls.
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
			'items_no',
			[
				'label' => __( 'Number of portfolio items. Maximum of 4 items can be included. First 4 if you leave it empty.', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
			]
		);

		$this->add_control(
			'filter_category',
			[
				'label' => __( 'Category filter. Add one or more portfolio categories separated by comma. First 4 if you leave it empty.', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
			]
		);

		$this->add_control(
			'thumbs_effect',
			[
				'label'        => __( 'Thumbs Transition Effect', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'label_block'  => true,
				'default'      => 'webgl-fitthumbs',
				'options'      => array( 'webgl-fitthumbs' => __( 'WebGL Animation', 'harington-elementor-widgets' ),
										'scale-fitthumbs' => __( 'GSAP Animation', 'harington-elementor-widgets' ),
										'no-fitthumbs' => __( 'None', 'harington-elementor-widgets' )
										)
			]
		);

		$this->add_control(
			'thumbs_effect_webgl',
			[
				'label'        => __( 'WebGL Animation Type', 'harington-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'label_block'  => true,
				'default'      => 'fx-one',
				'options'      => array( 'fx-one' => __( 'FX One', 'harington-elementor-widgets' ),
										'fx-two' => __( 'FX Two', 'harington-elementor-widgets' ),
										'fx-three' => __( 'FX Three', 'harington-elementor-widgets' ),
										'fx-four' => __( 'FX Four', 'harington-elementor-widgets' ),
										'fx-five' => __( 'FX Five', 'harington-elementor-widgets' ),
										'fx-six' => __( 'FX Six', 'harington-elementor-widgets' ) )
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Portfolio Grid widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$harington_max_items		= $settings['items_no'];
		if( empty($harington_max_items) || ($harington_max_items > 4) ){

			$harington_max_items = 4; // max 4 items in the shortcode
		}

		$harington_portfolio_tax_query = null;
		$harington_portfolio_category_filter	= $settings['filter_category'];

		$harington_portfolio_grid_layout = 'flex-grid';
		$harington_portfolio_thumb_to_fullscreen = $settings['thumbs_effect'];
		$harington_portfolio_thumb_webgl = $settings['thumbs_effect_webgl'];
		$harington_enable_ajax = false;
		if( function_exists( 'harington_get_theme_options' ) ){

			$harington_enable_ajax = harington_get_theme_options( 'clapat_harington_enable_ajax' );
		}

		if( !$harington_enable_ajax ){

			$harington_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
		}

		$harington_array_terms = null;
		if( !empty( $harington_portfolio_category_filter ) ){

			$harington_array_terms = explode( ",", $harington_portfolio_category_filter );
			$harington_portfolio_tax_query = array(
												array(
													'taxonomy' 	=> 'portfolio_category',
													'field'		=> 'slug',
													'terms'		=> $harington_array_terms,
													),
											);
		}

		echo '<div id="itemsWrapperLinks">';
		echo	'<div id="itemsWrapper" class="' .  sanitize_html_class( $harington_portfolio_thumb_to_fullscreen ) . ' ' . sanitize_html_class( $harington_portfolio_thumb_webgl ) . '">';

		echo	'<!-- Portfolio Wrap -->';
		echo	'<div class="portfolio-wrap ' . sanitize_html_class( $harington_portfolio_grid_layout );
		if( !$harington_enable_ajax ){

			echo	 ' thumb-no-ajax';
		}
		echo	' content-full-width fade-scaleout-effect">';
		echo	'<!-- Portfolio Columns -->';
		echo	'<div class="portfolio portfolio-shortcode">';

		$harington_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$harington_args = array(
										'post_type' => 'harington_portfolio',
										'paged' => $harington_paged,
										'tax_query' => $harington_portfolio_tax_query,
										'posts_per_page' => $harington_max_items,
										 );

		$harington_portfolio = new WP_Query( $harington_args );

		$harington_portfolio_items = array();

		$harington_current_item_count = 1;
		while( $harington_portfolio->have_posts() ){

			$harington_portfolio->the_post();

			$harington_portfolio_item = new Harington_Portfolio_Grid_Item();
			$harington_portfolio_item->post_id = get_the_ID();
			$harington_portfolio_items[] = $harington_portfolio_item;

			$full_image = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-hero-img' );
			$harington_background_type = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-bknd-color' );
			$harington_background_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-bknd-color-code' );
			$title_row = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-hero-caption-title' );
			$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
			$harington_item_title		= "";
			foreach( $title_list as $title_bit ){

				$harington_item_title .= '<span>' . $title_bit . '</span>';
			}
			$subtitle_row 			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-hero-caption-subtitle' );
			$subtitle_list			= preg_split('/\r\n|\r|\n/', $subtitle_row);
			$harington_item_subtitle	= "";
			foreach( $subtitle_list as $subtitle_bit ){

				$harington_item_subtitle .= '<span>' . $subtitle_bit . '</span>';
			}
			$harington_background_navigation 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-navigation-cursor-color' );
			$harington_page_caption_first_line	= harington_get_theme_options( 'clapat_harington_view_project_caption_first' );
			$harington_page_caption_second_line	= harington_get_theme_options( 'clapat_harington_view_project_caption_second' );

			if( $full_image && isset( $full_image['url'] ) ){

				$harington_item_classes = '';

				$harington_item_categories 	= '';
				$harington_item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
				if($harington_item_cats){

					foreach($harington_item_cats as $item_cat) {

						$harington_item_classes 	.= $item_cat->slug . ' ';
						$harington_item_categories 	.= $item_cat->name . ', ';
					}

					$harington_item_categories = rtrim($harington_item_categories, ', ');

				}

				if( $harington_background_type == "dark-content" ){

					$harington_item_classes .= "change-header";
				}

				$harington_image_alt_text = __('Portfolio Image', 'harington_core_plugin_text_domain');
				if( !empty( $full_image['id'] ) ){

					$harington_image_alt_text = trim( strip_tags( get_post_meta( $full_image['id'], '_wp_attachment_image_alt', true ) ) );

				}

				$item_url = get_the_permalink();

				echo '<div class="item trigger-item ' . esc_attr( $harington_item_classes ) . '" data-color="' . esc_attr( $harington_background_navigation ) . '">';
				echo '<div class="item-parallax">';
				echo '<div class="item-appear">';
				echo '<div class="item-content">';
				echo '<a class="item-wrap ajax-link-project" data-type="page-transition" href="' . esc_url( $item_url ) . '"></a>';
				echo '<div class="item-wrap-image">';
				echo '<img src="' . esc_url( $full_image['url'] ) . '" class="item-image grid__item-img trigger-item-link" alt="' . esc_attr( $harington_image_alt_text ) . '">';
				if( harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video' ) ){

					$harington_video_webm_url = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video-webm' );
					$harington_video_mp4_url 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video-mp4' );

					echo '<div class="hero-video-wrapper">';
					echo '<video loop muted class="bgvid">';
					if( !empty( $harington_video_mp4_url ) ) {

						echo '<source src="' . esc_url( $harington_video_mp4_url ) . '" type="video/mp4">';
					}
					if( !empty( $harington_video_webm_url ) ) {

						echo '<source src="' . esc_url( $harington_video_webm_url ) . '" type="video/webm">';
					}
					echo '</video>';
					echo '</div>';
				}
				echo '</div>';
				echo '<img class="grid__item-img grid__item-img--large" src="' . esc_url( $full_image['url'] ) . '" alt="' . esc_attr( $harington_image_alt_text ) . '" />';
				echo '</div>';
				echo '</div>';
				echo '<div class="item-caption-wrapper">';
				echo '<div class="item-caption">';
				echo '<div class="item-title">' . wp_kses( $harington_item_title, 'harington_allowed_html' ) . '</div>';
				echo '<div class="item-cat">';
				echo '<span data-hover="' . esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_viewcase_caption' ) ) .'">' . wp_kses( $harington_item_categories, 'harington_allowed_html' ) . '</span>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';

			}

			$harington_current_item_count++;

		}

		wp_reset_postdata();

		if( function_exists( 'harington_portfolio_thumbs_list' ) ){

			harington_portfolio_thumbs_list( $harington_portfolio_items );
		}

		echo	 '</div>';
		echo	 '<!--/Portfolio Columns-->';
		echo	 '</div>';
		echo	 '<!--/Portfolio Wrap-->';
		echo	 '</div>';
		echo	 '</div>';

	}

}

?>
