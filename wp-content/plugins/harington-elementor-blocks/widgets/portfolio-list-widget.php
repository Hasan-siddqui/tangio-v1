<?php
/**
 * Elementor Harington Portfolio List Widget.
 *
 * Elementor widget that inserts a vertical portfolio list containing the thumbnails of portfolio items defined in the system
 *
 * @since 1.0.0
 */
class Elementor_Harington_Portfolio_List_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Portfolio List widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_portfolio_list';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Portfolio List widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Portfolio List', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Portfolio List widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-table-of-contents';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Portfolio List widget belongs to.
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
	 * Register Portfolio List widget controls.
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
	 * Render Portfolio List widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

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

		// add the wrapper links divs only if they don't exist already in the page, otherwise it will inherit the existing divs
		if( !is_page_template('portfolio-grid-page.php') ){
			
			echo '<div id="itemsWrapperLinks">';
			echo '<div id="itemsWrapper" class="' .  sanitize_html_class( $harington_portfolio_thumb_to_fullscreen ) . ' ' . sanitize_html_class( $harington_portfolio_thumb_webgl ) . '">';
		}
		
		echo '<!-- Showcase List Holder -->';
		echo '<div class="showcase-list-holder">';
		echo '<!-- Showcase List -->';
		echo '<div class="showcase-list">';

		$harington_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$harington_args = array(
										'post_type' => 'harington_portfolio',
										'paged' => $harington_paged,
										'tax_query' => $harington_portfolio_tax_query,
										'posts_per_page' => 1000
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
				
				$harington_image_alt_text = __('Portfolio Image', 'harington_core_plugin_text_domain');
				if( !empty( $full_image['id'] ) ){
					
					$harington_image_alt_text = trim( strip_tags( get_post_meta( $full_image['id'], '_wp_attachment_image_alt', true ) ) );
					
				}
				
				$item_url = get_the_permalink();

				echo '<div class="slide-list  trigger-item ' . esc_attr( $harington_item_classes ) . '" data-color="' . esc_attr( $harington_background_navigation ) . '">';
				
				echo '<div class="hover-reveal">';
				echo '<div class="hover-reveal__inner">';
				echo '<div class="hover-reveal__img">';
				echo '<img src="' . esc_url( $full_image['url'] ) . '" class="item-image grid__item-img" alt="' . esc_attr( $harington_image_alt_text ) . '">';
				if( harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video' ) ){

					$harington_video_webm_url = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video-webm' );
					$harington_video_mp4_url = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video-mp4' );
					
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
				echo '<img class="grid__item-img grid__item-img--large" src="' . esc_url( $full_image['url'] ) . '" alt="' . esc_attr( $harington_image_alt_text ) . '" />';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '<a data-type="page-transition" href="' . esc_url( $item_url ) . '"></a>';
				echo '<div class="sl-title trigger-item-link">' . wp_kses( $harington_item_title, 'harington_allowed_html' ) . '</div>';
				echo '<div class="sl-subtitle">' . wp_kses( $harington_item_categories, 'harington_allowed_html' ) . '</div>';
				echo '</div>';
				
			}
			
			$harington_current_item_count++;

		}

		wp_reset_postdata();
		
		if( function_exists( 'harington_portfolio_thumbs_list' ) ){
			
			// add the portfolio items from the list to the existing items
			$harington_global_portfolio_items  = harington_portfolio_thumbs_list();
			if( empty( $harington_global_portfolio_items ) ){
				
				$harington_global_portfolio_items = array();
			}
			
			harington_portfolio_thumbs_list( array_merge($harington_global_portfolio_items, $harington_portfolio_items) );
		}
		
		echo '</div>';
		echo '<!--/Showcase List-->';
		echo '</div>';
		echo '<!--/Showcase List Holder-->';
		
		if( !is_page_template('portfolio-grid-page.php') ){
			
			echo '</div>';
			echo '</div>';
		}

	}

}

?>
