<?php
/**
 * Elementor News Portfolio Grid Widget.
 *
 * Elementor widget that inserts a news carousel containing latest blog posts
 *
 * @since 1.0.0
 */
class Elementor_Harington_News_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve News widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harington_news';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve News widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'News', 'harington-elementor-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve News widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-archive-posts';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the News widget belongs to.
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
	 * Register News widget controls.
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
				'label' => __( 'Number of post items. Leave empty for ALL.', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
			]
		);

		$this->add_control(
			'filter_category',
			[
				'label' => __( 'Category filter. Add one or more blog categories separated by comma. Leave empty for ALL.', 'harington-elementor-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'show_label' => true,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render News widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$harington_max_items		= $settings['items_no'];
		if( empty($harington_max_items) ){

			$harington_max_items = 1000;
		}

		$harington_blog_tax_query = null;
		$harington_blog_category_filter	= $settings['filter_category'];

		$harington_portfolio_tax_query = null;

		$harington_enable_ajax = false;
		if( function_exists( 'harington_get_theme_options' ) ){

			$harington_enable_ajax = harington_get_theme_options( 'clapat_harington_enable_ajax' );
		}

		$harington_array_terms = null;
		if( !empty( $harington_blog_category_filter ) ){

			$harington_array_terms = explode( ",", $harington_blog_category_filter );
			$harington_portfolio_tax_query = array(
												array(
													'taxonomy' 	=> 'category',
													'field'		=> 'slug',
													'terms'		=> $harington_array_terms,
													),
											);
		}

		$harington_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$harington_args = array(
										'post_type' => 'post',
										'paged' => $harington_paged,
										'tax_query' => $harington_portfolio_tax_query,
										'posts_per_page' => $harington_max_items,
										 );

		$harington_portfolio = new WP_Query( $harington_args );

		$harington_current_item_count = 1;
		while( $harington_portfolio->have_posts() ){

			$harington_portfolio->the_post();

			$post_classes = get_post_class( 'post', get_the_ID() );

			echo '<article id="post-'. get_the_ID() . '" class="' . esc_attr( implode( ' ', $post_classes ) ) . '">';

			// article wrap
			echo '<div class="article-wrap">';

			// post image
			$harington_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			if( $harington_post_image ){

				echo '<div class="hover-reveal">';
				echo '<div class="hover-reveal__inner">';
				echo '<div class="hover-reveal__img">';
				$alt_text = trim( strip_tags( get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true ) ) );
				echo '<img src="' . esc_url( $harington_post_image[0] ) .'" alt="' . $alt_text . '">';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}

			// post link
			if( $harington_enable_ajax ){
				echo '<a class="post-title ajax-link has-mask-fill" href="' . get_the_permalink() . '" data-type="page-transition" data-color="#000">' . get_the_title() . '</a>';
			}
			else {
				echo '<a class="post-title has-mask-fill" href="' . get_the_permalink() . '" data-color="#000">' . get_the_title() . '</a>';
			}

			// end article wrap
			echo '</div>';

			// article content
			echo '<div class="article-content">';

			// post categories
			echo '<div class="entry-meta-wrap">';
			echo '<div class="entry-meta entry-categories">';
			echo '<ul class="post-categories">';
			$harington_categories = get_the_category();
			if ( ! empty( $harington_categories ) ) {

				foreach( $harington_categories as $harington_category ) {

					echo '<li class="link">';
					if( $harington_enable_ajax ){
						echo wp_kses_post( '<a class="ajax-link" data-type="page-transition" href="' . esc_url( get_category_link( $harington_category->term_id ) ) . '" rel="category tag"><span data-hover="' . esc_attr( $harington_category->name ) . '">' . esc_html( $harington_category->name ) . '</span></a>');
					}
					else {
						echo wp_kses_post( '<a href="' . esc_url( get_category_link( $harington_category->term_id ) ) . '" rel="category tag"><span data-hover="' . esc_attr( $harington_category->name ) . '">' . esc_html( $harington_category->name ) . '</span></a>');
					}
					echo '</li>';
				}
			}
			echo '</ul>';
			echo '</div>';
			echo '</div>';

			// post date
			echo '<div class="entry-meta-wrap">';
			echo '<ul class="entry-meta entry-date">';
			echo '<li class="link">';
			if( $harington_enable_ajax ){
				echo '<a class="ajax-link" data-type="page-transition" href="' . esc_url( get_the_permalink() ) .'"><span data-hover="' . get_the_date() . '">' . get_the_date() . '</span></a>';
			}
			else {
				echo '<a href="' . esc_url( get_the_permalink() ) .'"><span data-hover="' . get_the_date() . '">' . get_the_date() . '</span></a>';
			}
			echo '</li>';
			echo '</ul>';
			echo '</div>';

			// end article content
			echo '</div>';

			echo '</article>';

			$harington_current_item_count++;

		}

		wp_reset_postdata();

	}

}

?>
