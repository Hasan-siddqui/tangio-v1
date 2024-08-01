<?php

if( !isset( $harington_default_theme_options ) ){

	$harington_default_theme_options = array();

	// General Settings
	$harington_default_theme_options['clapat_harington_enable_ajax'] = 0;
	$harington_default_theme_options['clapat_harington_enable_smooth_scrolling'] = 0;
	$harington_default_theme_options['clapat_harington_enable_magic_cursor'] = 0;
	$harington_default_theme_options['clapat_harington_primary_color'] ='#f33a3a';
	$harington_default_theme_options['clapat_harington_enable_preloader'] = 1;
	$harington_default_theme_options['clapat_harington_preloader_intro'] = esc_html__( 'bold,brave,iconic,simple,louder', 'harington' );
	$harington_default_theme_options['clapat_harington_preloader_hover_first_line'] = esc_html__( 'Stay', 'harington' );
	$harington_default_theme_options['clapat_harington_preloader_hover_second_line'] = esc_html__( 'Relaxed', 'harington' );
	$harington_default_theme_options['clapat_harington_preloader_text'] = esc_html__( 'Loaded', 'harington' );
	$harington_default_theme_options['clapat_harington_uppercase_text'] = 1;
	$harington_default_theme_options['clapat_harington_default_page_bknd_type'] = 'light-content';
	$harington_default_theme_options['clapat_harington_enable_page_title_as_hero'] = 1;
	
	// Header Settings
	$harington_default_theme_options['clapat_harington_logo'] = esc_url( get_template_directory_uri() . '/images/logo.png' );
	$harington_default_theme_options['clapat_harington_logo_light'] = esc_url( get_template_directory_uri() . '/images/logo-white.png' );
	$harington_default_theme_options['clapat_harington_enable_fullscreen_menu'] = 0;
	$harington_default_theme_options['clapat_harington_header_menu_type'] = 'classic-burger-lines';
	$harington_default_theme_options['clapat_harington_menu_btn_caption'] = esc_html__( 'Menu', 'harington' );
	$harington_default_theme_options['clapat_harington_menu_background_color'] = '#171717';
	$harington_default_theme_options['clapat_harington_menu_background_type'] = 'invert-header';
	
	// Footer Settings
	$harington_default_theme_options['clapat_harington_enable_back_to_top'] = 1;
	$harington_default_theme_options['clapat_harington_back_to_top_caption'] = esc_html__( 'Back Top', 'harington' );
	$harington_default_theme_options['clapat_harington_footer_copyright'] = wp_kses( __('2023 © <a class="link" target="_blank" href="https://www.clapat-themes.com/">ClaPat</a>. All rights reserved.', 'harington'), 'harington_allowed_html' );
	$harington_default_theme_options['clapat_harington_footer_social_links_prefix'] = esc_html__( 'Follow Us', 'harington' );
	$harington_default_theme_options['clapat_harington_social_links_icons'] = 0;
	global $harington_social_links;
	$social_network_ids = array_keys( $harington_social_links );
	for( $idx = 1; $idx <= HARINGTON_MAX_SOCIAL_LINKS; $idx++ ){

		$harington_default_theme_options['clapat_harington_footer_social_' . $idx] = harington_social_network_default( $idx );
		$harington_default_theme_options['clapat_harington_footer_social_url_' . $idx] = harington_social_network_url_default( $idx );
	}
	
	// Showcase Settings
	$harington_default_theme_options['clapat_harington_showcase_transition_pattern_image'] = 'aqua-light';
	$harington_default_theme_options['clapat_harington_showcase_transition_pattern_custom_image'] = '';
	$harington_default_theme_options['clapat_harington_showcase_next_slide_caption'] = esc_html__('Next Slide', 'harington');
	$harington_default_theme_options['clapat_harington_showcase_prev_slide_caption'] = esc_html__('Prev Slide', 'harington');
	
	// Portfolio Settings
	$harington_default_theme_options['clapat_core_portfolio_custom_slug'] = '';
	$harington_default_theme_options['clapat_harington_portfolio_nav_autotrigger'] = 1;
	$harington_default_theme_options['clapat_harington_view_project_caption_first'] = esc_html__('View', 'harington');
	$harington_default_theme_options['clapat_harington_view_project_caption_second'] = esc_html__('Project', 'harington');
	$harington_default_theme_options['clapat_harington_portfolio_filter_all_caption'] = esc_html__('All', 'harington');
	$harington_default_theme_options['clapat_harington_portfolio_show_filters_caption'] = esc_html__( 'Show Filters', 'harington' );
	$harington_default_theme_options['clapat_harington_portfolio_next_caption_first_line'] = esc_html__('Next', 'harington');
	$harington_default_theme_options['clapat_harington_portfolio_next_caption_second_line'] = esc_html__('Project', 'harington');
	$harington_default_theme_options['clapat_harington_portfolio_viewcase_caption'] = esc_html__( 'View Case', 'harington' );
	$harington_default_theme_options['clapat_harington_portfolio_share_social_networks_caption'] = esc_html__('Share Project:', 'harington');
	$harington_default_theme_options['clapat_harington_portfolio_share_social_networks'] = 'facebook,twitter,pinterest';
	$harington_default_theme_options['clapat_harington_portfolio_navigation_order'] = 'forward';
	
	// Blog Settings
	$harington_default_theme_options['clapat_harington_blog_navigation_type'] = 'blog-nav-classic';
	$harington_default_theme_options['clapat_harington_blog_excerpt_type'] = 'blog-excerpt-none';
	$harington_default_theme_options['clapat_harington_blog_next_post_caption'] = esc_html__('Next', 'harington');
	$harington_default_theme_options['clapat_harington_blog_prev_post_caption'] = esc_html__('Prev', 'harington');
	$harington_default_theme_options['clapat_harington_blog_read_more_caption'] = esc_html__('Read More', 'harington');
	$harington_default_theme_options['clapat_harington_blog_no_posts_caption'] = esc_html__('No more posts', 'harington');
	$harington_default_theme_options['clapat_harington_blog_prev_posts_caption'] = esc_html__('Prev', 'harington');
	$harington_default_theme_options['clapat_harington_blog_next_posts_caption'] = esc_html__('Next', 'harington');
	$harington_default_theme_options['clapat_harington_blog_default_title'] = esc_html__('Blog', 'harington');
	
	// Map Settings
	$harington_default_theme_options['clapat_harington_map_address'] = esc_html__('775 New York Ave, Brooklyn, Kings, New York 11203', 'harington');
	$harington_default_theme_options['clapat_harington_map_marker'] = esc_url( get_template_directory_uri() . '/images/marker.png');
	$harington_default_theme_options['clapat_harington_map_zoom'] = 16;
	$harington_default_theme_options['clapat_harington_map_company_name'] = esc_html__('harington', 'harington');
	$harington_default_theme_options['clapat_harington_map_company_info'] = esc_html__('Here we are. Come to drink a coffee!', 'harington');
	$harington_default_theme_options['clapat_harington_map_type'] = 'satellite';
	$harington_default_theme_options['clapat_harington_map_api_key'] = '';
	
	// Error Page
	$harington_default_theme_options['clapat_harington_error_title'] = esc_html__('404', 'harington');
	$harington_default_theme_options['clapat_harington_error_info'] = esc_html__('The page you are looking for could not be found.', 'harington');
	$harington_default_theme_options['clapat_harington_error_back_button'] = esc_html__('Home Page', 'harington');
	$harington_default_theme_options['clapat_harington_error_back_button_hover_caption'] = esc_html__('Go Back', 'harington');
	$harington_default_theme_options['clapat_harington_error_back_button_url'] = esc_url( get_home_url() );
	$harington_default_theme_options['clapat_harington_error_page_bknd_type'] = 'light-content';
}

if( !class_exists('Clapat\Harington\Metaboxes\Meta_Boxes') ){

	$harington_default_meta_options = array (
									"harington-opt-page-bknd-color-code" => "#171717",
									"harington-opt-page-bknd-color" => "light-content",
									"harington-opt-page-enable-hero" => "",
									"harington-opt-page-hero-img" => "",
									"harington-opt-page-invert-hero-header" => "default-header-color",
									"harington-opt-page-video" => false,
									"harington-opt-page-video-webm" => "",
									"harington-opt-page-video-mp4" => "",
									"harington-opt-page-hero-caption-title" => "",
									"harington-opt-page-hero-caption-title-type" => "block-title",
									"harington-opt-page-hero-caption-subtitle" => "",
									"harington-opt-page-hero-info-text" => "",
									"harington-opt-page-hero-scroll-caption" => esc_html__('Scroll to navigate', 'harington'),
									"harington-opt-page-hero-parallax-caption" => "parallax-scroll-caption",
									"harington-opt-page-hero-caption-align" => "text-align-left",
									"harington-opt-page-navigation-caption-first-line" => esc_html__('Next', 'harington'),
									"harington-opt-page-navigation-caption-second-line" => esc_html__('Page', 'harington'),
									"harington-opt-page-navigation-caption-title" => "",
									"harington-opt-page-navigation-caption-title-marquee" => false,
									"harington-opt-page-navigation-caption-subtitle" => "",
									"harington-opt-page-navigation-next-page" => "", 
									"harington-opt-page-portfolio-filter-category" => "",
									"harington-opt-page-portfolio-grid-layout" => "parallax-grid",
									"harington-opt-page-portfolio-thumb-to-fullscreen" => "webgl-fitthumbs",
									"harington-opt-page-portfolio-thumb-to-fullscreen-webgl-type" => "fx-one",
									"harington-opt-page-portfolio-grid-content-position" => "after",
									"harington-opt-page-panels-parallax" => "1",
									"harington-opt-blog-bknd-color-code" => "#171717",
									"harington-opt-blog-bknd-color" => "light-content",
									"harington-opt-blog-caption-alignment" => "text-align-left",
									"harington-opt-portfolio-bknd-color-code" => "#171717",
									"harington-opt-portfolio-bknd-color" => "light-content",
									"harington-opt-portfolio-navigation-cursor-color" => "#f33a3a",
									"harington-opt-portfolio-thumb-size" => "normal",
									"harington-opt-portfolio-project-year" => date("Y"),
									"harington-opt-portfolio-hero-img" => "",
									"harington-opt-portfolio-invert-hero-header" => "default-header-color",
									"harington-opt-portfolio-video" => false,
									"harington-opt-portfolio-video-webm" => "",
									"harington-opt-portfolio-video-mp4" => "",
									"harington-opt-portfolio-hero-caption-title" => "",
									"harington-opt-portfolio-hero-parallax-caption" => "parallax-scroll-caption",
									"harington-opt-portfolio-hero-scroll-caption" => ""
								);
}

?>
