<?php
/**
 * Harington Theme Config File
 */

if ( ! function_exists( 'harington_options_config' ) ) {

	function harington_options_config( $wp_customize ){

		$harington_before_default_section = 40; // Before Colors.
		
		/*** General Settings section ***/
		$wp_customize->add_section(
			'general_settings',
			array(
				'title'    => esc_html__( 'General Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 9),
			)
		);
	
		// Enable AJAX
		$wp_customize->add_setting(
			'clapat_harington_enable_ajax',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_enable_ajax',
			array(
				'label'   		=> esc_html__( 'Load Pages With Ajax', 'harington' ),
				'description'  	=> esc_html__( 'When navigates to another page it loads the target content without reloading the current page.', 'harington' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Enable Smooth Scroll
		$wp_customize->add_setting(
			'clapat_harington_enable_smooth_scrolling',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_enable_smooth_scrolling',
			array(
				'label'   		=> esc_html__( 'Enable Smooth Scrolling', 'harington' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
				
		// Enable Magic Cursor
		$wp_customize->add_setting(
			'clapat_harington_enable_magic_cursor',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_enable_magic_cursor',
			array(
				'label'   		=> esc_html__( 'Enable Magic Cursor', 'harington' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Primary color for magic cursor
		$wp_customize->add_setting(
			'clapat_harington_primary_color',
			array(
				'default'           	=> '#f33a3a',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'clapat_harington_primary_color', 
			array(
				'label'      => esc_html__( 'Magic Cursor Primary Color', 'harington' ),
				'description' => esc_html__('Set the primary color for magic cursor.', 'harington'),
				'section'    => 'general_settings'
			)
		));
		
		// Enable Uppercase Text
		$wp_customize->add_setting(
			'clapat_harington_uppercase_text',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_uppercase_text',
			array(
				'label'   		=> esc_html__( 'Enable Uppercase Text Effect', 'harington' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Global background page type
		$wp_customize->add_setting(
			'clapat_harington_default_page_bknd_type',
			array(
				'default'           	=> 'light-content',
				'sanitize_callback' 	=> 'harington_sanitize_default_page_bknd_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_default_page_bknd_type',
			array(
				'label'   		=> esc_html__('Default Background Type', 'harington'),
				'description'	=> esc_html__('Default background type for pages, posts and category pages. The background type set in page options will overwrite this option.', 'harington'),
				'section' 		=> 'general_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'dark-content' => esc_html__('White', 'harington'),
										'light-content' => esc_html__('Black', 'harington') ),
			)
		);
		
		// Enable page title as hero caption
		$wp_customize->add_setting(
			'clapat_harington_enable_page_title_as_hero',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_enable_page_title_as_hero',
			array(
				'label'   		=> esc_html__( 'Display Page Title When Hero Section Is Disabled', 'harington' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		/*** End General Settings section ***/
		
		/*** Preloader Settings section ***/
		$wp_customize->add_section(
			'preloader_settings',
			array(
				'title'    => esc_html__( 'Preloader Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 8),
			)
		);
		
		// Enable Preloader
		$wp_customize->add_setting(
			'clapat_harington_enable_preloader',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_enable_preloader',
			array(
				'label'   		=> esc_html__( 'Enable Preloader', 'harington' ),
				'description'  	=> esc_html__( 'Enable preloader mask while the page is loading.', 'harington' ),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Preloader Intro
		$wp_customize->add_setting(
			'clapat_harington_preloader_intro',
			array(
				'default'           	=> 'bold,brave,iconic,simple,louder',
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_preloader_intro',
			array(
				'label'   		=> esc_html__( 'Preloader Intro', 'harington' ),
				'description'	=> esc_html__( 'This is a list of words displayed in a quick succession while the page loads. Individual words or phrases must be separated by comma without any blank spaces.', 'harington'),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_preloader_hover_first_line',
			array(
				'default'           	=> esc_html__( 'Stay', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_preloader_hover_first_line',
			array(
				'label'   		=> esc_html__( 'Preloader Hover Text - First Line', 'harington' ),
				'description'	=> esc_html__( 'First line of the view caption displayed on hover in preloader.', 'harington' ),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_preloader_hover_second_line',
			array(
				'default'           	=> esc_html__( 'Relaxed', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_preloader_hover_second_line',
			array(
				'label'   		=> esc_html__( 'Preloader Hover Text - Second Line', 'harington' ),
				'description'	=> esc_html__( 'Second line of the view caption displayed on hover in preloader.', 'harington' ),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_preloader_text',
			array(
				'default'           	=> esc_html__( 'Loaded', 'harington' ),
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_preloader_text',
			array(
				'label'   		=> esc_html__( 'Preloader text', 'harington' ),
				'description'	=> esc_html__( 'Text displayed while preloader is shown.', 'harington' ),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'text',
			)
		);
		/*** End Preloader Settings section ***/
		
		/*** Header Settings section ***/
		$wp_customize->add_section(
			'header_settings',
			array(
				'title'    => esc_html__( 'Header Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 7),
			)
		);
		
		// Logo (default)
		$wp_customize->add_setting(
			'clapat_harington_logo',
			array(
				'default'           	=> get_template_directory_uri() . '/images/logo.png',
				'sanitize_callback' 	=> 'esc_url_raw',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( 
			$wp_customize, 
			'clapat_harington_logo', 
			array(
				'label'      => esc_html__( 'Header Logo', 'harington' ),
				'description' => esc_html__('Upload your logo to be displayed at the left side of the header menu.', 'harington'),
				'section'    => 'header_settings'
			)
		));
		
		// Logo (light version)
		$wp_customize->add_setting(
			'clapat_harington_logo_light',
			array(
				'default'           	=> get_template_directory_uri() . '/images/logo-white.png',
				'sanitize_callback' 	=> 'esc_url_raw',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( 
			$wp_customize, 
			'clapat_harington_logo_light', 
			array(
				'label'      => esc_html__( 'Header Logo Light', 'harington' ),
				'description' => esc_html__('Light logo displayed on dark backgrounds.', 'harington'),
				'section'    => 'header_settings'
			)
		));
		
		// Enable Fullscreen Menu
		$wp_customize->add_setting(
			'clapat_harington_header_menu_type',
			array(
				'default'           	=> 'classic-burger-lines',
				'sanitize_callback' 	=> 'harington_sanitize_menu_header_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_header_menu_type',
			array(
				'label'   		=> esc_html__('Desktop Menu Type', 'harington'),
				'description'	=> esc_html__('The type of the header menu on desktop.', 'harington'),
				'section' 		=> 'header_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'classic-burger-dots' => esc_html__('Classic - Responsive Burger Menu Dots', 'harington'),
										'classic-burger-lines' => esc_html__('Classic - Responsive Burger Menu Lines', 'harington'),
										'fullscreen-burger-dots' => esc_html__('Fullscreen - Burger Menu Dots', 'harington'),
										'fullscreen-burger-lines' => esc_html__('Fullscreen - Burger Menu Lines', 'harington') ),
			)
		);
		
		// Menu button caption
		$wp_customize->add_setting(
			'clapat_harington_menu_btn_caption',
			array(
				'default'           	=> esc_html__( 'Menu', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_menu_btn_caption',
			array(
				'label'   		=> esc_html__( 'Menu button caption', 'harington' ),
				'description'	=> esc_html__( 'Text preceding the burger menu button.', 'harington' ),
				'section' 		=> 'header_settings',
				'type'    		=> 'text',
			)
		);
		
		// Menu background color
		$wp_customize->add_setting(
			'clapat_harington_menu_background_color',
			array(
				'default'           	=> '#171717',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'clapat_harington_menu_background_color', 
			array(
				'label'      => esc_html__( 'Menu Background Color', 'harington' ),
				'description' => esc_html__('Set the background color for fullscreen or classic responsive menu.', 'harington'),
				'section'    => 'header_settings'
			)
		));
		
		// Menu background color type
		$wp_customize->add_setting(
			'clapat_harington_menu_background_type',
			array(
				'default'           	=> 'invert-header',
				'sanitize_callback' 	=> 'harington_sanitize_menu_bknd_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_menu_background_type',
			array(
				'label'   		=> esc_html__('Menu Background Type', 'harington'),
				'description'	=> esc_html__('Set background type for for fullscreen or classic responsive menu.', 'harington'),
				'section' 		=> 'header_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'inherit-header' => esc_html__('Dark', 'harington'),
										'invert-header' => esc_html__('Light', 'harington') ),
			)
		);
		/*** End Header Settings section ***/
		
		
		/*** Footer Settings section ***/
		$wp_customize->add_section(
			'footer_settings',
			array(
				'title'    => esc_html__( 'Footer Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 6),
			)
		);
		
		// Enable Back To Top button
		$wp_customize->add_setting(
			'clapat_harington_enable_back_to_top',
			array(
				'default'          		=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_enable_back_to_top',
			array(
				'label'   		=> esc_html__( 'Enable Back To Top Button', 'harington' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_back_to_top_caption',
			array(
				'default'          		=> esc_html__( 'Back Top', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_back_to_top_caption',
			array(
				'label'   		=> esc_html__( 'Back To Top Caption', 'harington' ),
				'description'	=> esc_html__( 'Caption displayed next to the back to top button in the footer.', 'harington' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'text',
			)
		);
		
		// Copyright
		$wp_customize->add_setting(
			'clapat_harington_footer_copyright',
			array(
				'default'           	=> wp_kses( __('2023 © <a class="link" target="_blank" href="https://www.clapat-themes.com/">ClaPat</a>. All rights reserved.', 'harington'), 'harington_allowed_html' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_footer_copyright',
			array(
				'label'   		=> esc_html__( 'Copyright text', 'harington' ),
				'description'	=> esc_html__( 'This is the copyright text displayed in the footer.', 'harington' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'textarea',
			)
		);
		
		// Social links
		$wp_customize->add_setting(
			'clapat_harington_footer_social_links_prefix',
			array(
				'default'           	=> esc_html__( 'Follow Us', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_footer_social_links_prefix',
			array(
				'label'   		=> esc_html__( 'Social Links Prefix', 'harington' ),
				'description'	=> esc_html__('Text preceding the social links.', 'harington'),
				'section' 		=> 'footer_settings',
				'type'    		=> 'text',
			)
		);
		
		// Social Links Display
		$wp_customize->add_setting(
			'clapat_harington_social_links_icons',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_social_links_icons',
			array(
				'label'   		=> esc_html__( 'Display Social Links As Fontawesome Icons', 'harington' ),
				'description'  	=> esc_html__( 'If unchecked will display the social networks acronyms.', 'harington' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		global $harington_social_links;
		$social_network_ids = array_keys( $harington_social_links );
		for( $idx = 1; $idx <= HARINGTON_MAX_SOCIAL_LINKS; $idx++ ){

			$wp_customize->add_setting(
				'clapat_harington_footer_social_' . $idx,
				array(
					'default'           	=> harington_social_network_default( $idx ),
					'sanitize_callback' 	=> 'harington_sanitize_social_links',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_footer_social_' . $idx,
				array(
					'label'   		=>  esc_html__('Social Network Name ', 'harington' ) . $idx,
					'section' 		=> 'footer_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_social_links,
				)
			);
			
			$wp_customize->add_setting(
				'clapat_harington_footer_social_url_' . $idx,
				array(
					'default'           	=> harington_social_network_url_default( $idx ),
					'sanitize_callback' 	=> 'esc_url_raw',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_footer_social_url_' . $idx,
				array(
					'label'   		=>  esc_html__('Social Link URL ', 'harington' ) . $idx,
					'section' 		=> 'footer_settings',
					'type'    		=> 'url',
				)
			);
			
		}
		/*** End Footer Settings section ***/
		
		/*** Showcase Settings section ***/
		$wp_customize->add_section(
			'showcase_settings',
			array(
				'title'    => esc_html__( 'Showcase Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 5),
			)
		);
		
		// Showcase transition image
		$wp_customize->add_setting(
			'clapat_harington_showcase_transition_pattern_image',
			array(
				'default'           	=> 'aqua-light',
				'sanitize_callback' 	=> 'harington_sanitize_showcase_transition_pattern_image',
			)
		);
		
		global $harington_slide_transitions_labels;
		$wp_customize->add_control(
			'clapat_harington_showcase_transition_pattern_image',
			array(
				'label'   		=> esc_html__('Showcase Transition Pattern Image', 'harington'),
				'section' 		=> 'showcase_settings',
				'type'    		=> 'select',
				'choices'   	=> $harington_slide_transitions_labels,
			)
		);
		
		// Showcase custom transition image
		$wp_customize->add_setting(
			'clapat_harington_showcase_transition_pattern_custom_image',
			array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'esc_url_raw',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( 
			$wp_customize, 
			'clapat_harington_showcase_transition_pattern_custom_image', 
			array(
				'label'      => esc_html__( 'Showcase Transition Pattern Image - Custom', 'harington' ),
				'description' => esc_html__('Upload your custom showcase transition pattern image.', 'harington'),
				'section'    => 'showcase_settings'
			)
		));
		
		// Next, Prev Slide caption
		$wp_customize->add_setting(
			'clapat_harington_showcase_next_slide_caption',
			array(
				'default'           	=> esc_html__( 'Next Slide', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_showcase_next_slide_caption',
			array(
				'label'   		=> esc_html__( 'Next Slide Caption', 'harington' ),
				'description'	=> esc_html__( 'The caption of the next slide navigation button in showcase templates.', 'harington' ),
				'section' 		=> 'showcase_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_showcase_prev_slide_caption',
			array(
				'default'           	=> esc_html__( 'Prev Slide', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_showcase_prev_slide_caption',
			array(
				'label'   		=> esc_html__( 'Prev Slide Caption', 'harington' ),
				'description'	=> esc_html__( 'The caption of the previous slide navigation button in showcase templates.', 'harington' ),
				'section' 		=> 'showcase_settings',
				'type'    		=> 'text',
			)
		);
		/*** End Showcase Settings section ***/
		
		/*** Portfolio Settings section ***/
		$wp_customize->add_section(
			'portfolio_settings',
			array(
				'title'    => esc_html__( 'Portfolio Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 4),
			)
		);
		
		// Custom portfolio slug
		$wp_customize->add_setting(
			'clapat_core_portfolio_custom_slug',
			array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'harington_sanitize_slug_field',
				'transport'         	=> 'postMessage',
			)
		);
		
		$wp_customize->add_control(
			'clapat_core_portfolio_custom_slug',
			array(
				'label'   		=> esc_html__( 'Custom Slug', 'harington' ),
				'description'	=> esc_html__('If you want your portfolio post type to have a custom slug in the url, please enter it here. You will still have to refresh your permalinks after saving this! This is done by going to Settings > Permalinks and clicking save.', 'harington'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Portfolio Enable Portfolio Autotrigger
		$wp_customize->add_setting(
			'clapat_harington_portfolio_nav_autotrigger',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_nav_autotrigger',
			array(
				'label'   		=> esc_html__( 'Portfolio Auto Navigate On End Scroll', 'harington' ),
				'description'	=> esc_html__( 'When reaching the bottom of each portfolio page, automatically navigates to the next page.', 'harington' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// View Project caption
		$wp_customize->add_setting(
			'clapat_harington_view_project_caption_first',
			array(
				'default'           	=> esc_html__( 'View', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_view_project_caption_first',
			array(
				'label'   		=> esc_html__( 'View Project Caption - First Line', 'harington' ),
				'description'	=> esc_html__( 'First line of the view caption displayed on hover in portfolio page templates.', 'harington' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_view_project_caption_second',
			array(
				'default'           	=> esc_html__( 'Project', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_view_project_caption_second',
			array(
				'label'   		=> esc_html__( 'View Project Caption - Second Line', 'harington' ),
				'description'	=> esc_html__( 'Second line of the view caption displayed on hover in showcase or carousel templates.', 'harington' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// 'All' portfolio category caption
		$wp_customize->add_setting(
			'clapat_harington_portfolio_filter_all_caption',
			array(
				'default'           	=> esc_html__('All', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_filter_all_caption',
			array(
				'label'   		=> esc_html__('All Category Caption', 'harington'),
				'description'	=> esc_html__('The caption the All category displaying all portfolio items in portfolio page templates.', 'harington'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Show Filters caption
		$wp_customize->add_setting(
			'clapat_harington_portfolio_show_filters_caption',
			array(
				'default'           	=> esc_html__( 'Show Filters', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_show_filters_caption',
			array(
				'label'   		=> esc_html__( 'Portfolio Grid - Show Filters Caption', 'harington' ),
				'description'	=> esc_html__( 'Caption of the Show Filters button displayed in Portfolio Grid layout.', 'harington' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Next Project caption
		$wp_customize->add_setting(
			'clapat_harington_portfolio_next_caption_first_line',
			array(
				'default'           	=> esc_html__('Next', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_next_caption_first_line',
			array(
				'label'   		=> esc_html__( 'Next Project Caption - First Line', 'harington' ),
				'description'	=> esc_html__('Caption of the next project in portfolio navigation displayed on hover - on two lines.', 'harington'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_portfolio_next_caption_second_line',
			array(
				'default'           	=> esc_html__('Project', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_next_caption_second_line',
			array(
				'label'   		=> esc_html__( 'Next Project Caption - Second Line', 'harington' ),
				'description'	=> esc_html__('Caption of the next project in portfolio navigation displayed on hover - on two lines.', 'harington'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
			
		
		// View Case caption
		$wp_customize->add_setting(
			'clapat_harington_portfolio_viewcase_caption',
			array(
				'default'           	=> esc_html__( 'View Case', 'harington' ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_viewcase_caption',
			array(
				'label'   		=> esc_html__( 'View Case Caption', 'harington' ),
				'description'	=> esc_html__( 'The caption of the view case link in portfolio page templates.', 'harington' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Portfolio Share Social Networks caption
		$wp_customize->add_setting(
			'clapat_harington_portfolio_share_social_networks_caption',
			array(
				'default'           	=> esc_html__('Share Project:', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_share_social_networks_caption',
			array(
				'label'   		=> esc_html__( 'Share This Project Caption', 'harington' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Portfolio Share Social Networks list
		$wp_customize->add_setting(
			'clapat_harington_portfolio_share_social_networks',
			array(
				'default'           	=> 'facebook,twitter,pinterest',
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_share_social_networks',
			array(
				'label'   		=> esc_html__( 'Share This Project On', 'harington' ),
				'description'	=> esc_html__('This is a list of social networks you can share the project on, displayed at the bottom right of the hero image. Leave this field empty if you do not want to show it. Type in the social lower case social networks names, separated by comma (,). The list of available networks: twitter, facebook, googleplus, linkedin, pinterest, email, stumbleupon, whatsapp, telegram, line, viber, pocket, messenger, vkontakte, rss', 'harington'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);	
			
		// Portfolio navigation order
		$wp_customize->add_setting(
			'clapat_harington_portfolio_navigation_order',
			array(
				'default'           	=> 'forward',
				'sanitize_callback' 	=> 'harington_sanitize_portfolio_navigation_order',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_portfolio_navigation_order',
			array(
				'label'   		=> esc_html__('Portfolio Items Navigation Order', 'harington'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'forward' => esc_html__('Forward in time (next item is newer or loops to the oldest if current item is the newest)', 'harington'),
											  'backward' => esc_html__('Backward in time (next item is older or loops to the newest if current item is the oldest)', 'harington') ),
			)
		);
		/*** End Portfolio Settings section ***/
		
		/*** Blog Settings section ***/
		$wp_customize->add_section(
			'blog_settings',
			array(
				'title'    => esc_html__( 'Blog Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 3),
			)
		);
		
		// Blog pages navigation type
		$wp_customize->add_setting(
			'clapat_harington_blog_navigation_type',
			array(
				'default'           	=> 'blog-nav-classic',
				'sanitize_callback' 	=> 'harington_sanitize_blog_navigation_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_navigation_type',
			array(
				'label'   		=> esc_html__('Blog Pages Navigation Type', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'blog-nav-classic' => esc_html__('Classic', 'harington'),
										'blog-nav-minimal' => esc_html__('Minimal', 'harington') )
			)
		);
		
		// Excerpt in blog pages
		$wp_customize->add_setting(
			'clapat_harington_blog_excerpt_type',
			array(
				'default'           	=> 'blog-excerpt-none',
				'sanitize_callback' 	=> 'harington_sanitize_blog_excerpt_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_excerpt_type',
			array(
				'label'   		=> esc_html__('Excerpt or Full Blog Content', 'harington'),
				'description'	=> esc_html__('Show excerpt or full blog content on archive / blog pages.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'blog-excerpt-none' => esc_html__('None', 'harington'),
										'blog-excerpt' => esc_html__('Excerpt', 'harington'),
										'blog-excerpt-full' => esc_html__('Full Content', 'harington') )
			)
		);
							
		// Navigation caption
		$wp_customize->add_setting(
			'clapat_harington_blog_next_post_caption',
			array(
				'default'           	=> esc_html__('Next', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_next_post_caption',
			array(
				'label'   		=> esc_html__('Next Post Caption', 'harington'),
				'description'	=> esc_html__('Caption of the button linking to the next single blog post page.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_blog_prev_post_caption',
			array(
				'default'           	=> esc_html__('Prev', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_prev_post_caption',
			array(
				'label'   		=> esc_html__('Prev Post Caption', 'harington'),
				'description'	=> esc_html__('Caption of the button linking to the previous single blog post page.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_blog_no_posts_caption',
			array(
				'default'           	=> esc_html__('No more posts', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_no_posts_caption',
			array(
				'label'   		=> esc_html__('No Posts Page Caption', 'harington'),
				'description'	=> esc_html__('Caption displayed if there are no posts in the next or previous post from blog post page navigation.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_blog_read_more_caption',
			array(
				'default'           	=> esc_html__('Read More', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_read_more_caption',
			array(
				'label'   		=> esc_html__('Read More Caption', 'harington'),
				'description'	=> esc_html__('Caption of the button linking to the single blog post page from the blog index.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_blog_prev_posts_caption',
			array(
				'default'           	=> esc_html__('Prev', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_prev_posts_caption',
			array(
				'label'   		=> esc_html__('Previous Posts Page Caption', 'harington'),
				'description'	=> esc_html__('Caption of the button linking to the previous blog posts page.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_harington_blog_next_posts_caption',
			array(
				'default'           	=> esc_html__('Next', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_next_posts_caption',
			array(
				'label'   		=> esc_html__('Next Posts Page Caption', 'harington'),
				'description'	=> esc_html__('Caption of the button linking to the next blog posts page.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		// Blog pages default title
		$wp_customize->add_setting(
			'clapat_harington_blog_default_title',
			array(
				'default'           	=> esc_html__('Blog', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_blog_default_title',
			array(
				'label'   		=> esc_html__('Default Posts Page Title', 'harington'),
				'description'	=> esc_html__('Title of the default blog posts page. The default blog posts page is the page displaying blog posts when there is no front page set in Settings -> Reading.', 'harington'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		/*** End Blog Settings section ***/
		
		/*** Map Settings section ***/
		$wp_customize->add_section(
			'map_settings',
			array(
				'title'    => esc_html__( 'Map Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 2),
			)
		);
		
		// Map address
		$wp_customize->add_setting(
			'clapat_harington_map_address',
			array(
				'default'           	=>  esc_html__('775 New York Ave, Brooklyn, Kings, New York 11203', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_map_address',
			array(
				'label'   		=> esc_html__('Google Map Address', 'harington'),
				'description'  	=> esc_html__('Example: 775 New York Ave, Brooklyn, Kings, New York 11203. Or you can enter latitude and longitude for greater precision. Example: 41.40338, 2.17403 (in decimal degrees - DDD)', 'harington'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		
		// Map marker image
		$wp_customize->add_setting(
			'clapat_harington_map_marker',
			array(
				'default'           	=> get_template_directory_uri() . '/images/marker.png',
				'sanitize_callback' 	=> 'esc_url_raw',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( 
			$wp_customize, 
			'clapat_harington_map_marker', 
			array(
				'label'      => esc_html__( 'Map Marker', 'harington' ),
				'description' => esc_html__('Please choose an image file for the marker.', 'harington'),
				'section'    => 'map_settings'
			)
		));
		
		// Map zoom
		$wp_customize->add_setting(
			'clapat_harington_map_zoom',
			array(
				'default'           	=> 16,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_map_zoom',
			array(
				'label'   		=> esc_html__( 'Map Zoom Level', 'harington' ),
				'description'  	=> esc_html__('Higher number will be more zoomed in.', 'harington'),
				'section' 		=> 'map_settings',
				'type'    		=> 'number',
				'input_attrs' 	=> array( 'min' => 0, 'max' => 30, 'step'  => 1 )
			)
		);
		
		// Pop-up marker title
		$wp_customize->add_setting(
			'clapat_harington_map_company_name',
			array(
				'default'           	=> esc_html__('harington', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_map_company_name',
			array(
				'label'   		=> esc_html__('Pop-up marker title', 'harington'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		
		// Pop-up marker text
		$wp_customize->add_setting(
			'clapat_harington_map_company_info',
			array(
				'default'           	=> esc_html__('Here we are. Come to drink a coffee!', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_map_company_info',
			array(
				'label'   		=> esc_html__('Pop-up marker text', 'harington'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		
		// Map type
		$wp_customize->add_setting(
			'clapat_harington_map_type',
			array(
				'default'           	=> 'satellite',
				'sanitize_callback' 	=> 'harington_sanitize_map_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_map_type',
			array(
				'label'   		=> esc_html__('Map Type', 'harington'),
				'description'	=> esc_html__('Set the map type as road map or satellite.', 'harington'),
				'section' 		=> 'map_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'satellite' => esc_html__('Satellite', 'harington'),
										'roadmap' => esc_html__('Roadmap', 'harington') ),
			)
		);
		
		// Google maps API key
		$wp_customize->add_setting(
			'clapat_harington_map_api_key',
			array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_map_api_key',
			array(
				'label'   		=> esc_html__('Google Maps API Key', 'harington'),
				'description'	=> esc_html__('Without it, the map may not be displayed. If you have an api key paste it here. More information on how to obtain a google maps api key: https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key', 'harington'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		/*** End Map Settings section ***/
		
		/*** Error Page section ***/
		$wp_customize->add_section(
			'error_page_settings',
			array(
				'title'    => esc_html__( 'Error Page Settings', 'harington' ),
				'priority' => ($harington_before_default_section - 1),
			)
		);
		
		// Error page title
		$wp_customize->add_setting(
			'clapat_harington_error_title',
			array(
				'default'           	=> esc_html__('404', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_error_title',
			array(
				'label'   		=> esc_html__('Error Page Title', 'harington'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error page info
		$wp_customize->add_setting(
			'clapat_harington_error_info',
			array(
				'default'           	=> esc_html__('The page you are looking for could not be found.', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_error_info',
			array(
				'label'   		=> esc_html__('Error Page Info Text', 'harington'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error back button
		$wp_customize->add_setting(
			'clapat_harington_error_back_button',
			array(
				'default'           	=> esc_html__('Home Page', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_error_back_button',
			array(
				'label'   		=> esc_html__('Back Button Caption', 'harington'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error back button - caption on hover
		$wp_customize->add_setting(
			'clapat_harington_error_back_button_hover_caption',
			array(
				'default'           	=> esc_html__('Go Back', 'harington'),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_error_back_button_hover_caption',
			array(
				'label'   		=> esc_html__('Back Button Caption On Hover', 'harington'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error back button url
		$wp_customize->add_setting(
			'clapat_harington_error_back_button_url',
			array(
				'default'           	=> esc_url( get_home_url() ),
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_error_back_button_url',
			array(
				'label'   		=> esc_html__('Back Button URL', 'harington'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// 404 page background type
		$wp_customize->add_setting(
			'clapat_harington_error_page_bknd_type',
			array(
				'default'           	=> 'light-content',
				'sanitize_callback' 	=> 'harington_sanitize_error_page_bknd_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_harington_error_page_bknd_type',
			array(
				'label'   		=> esc_html__('Background Type', 'harington'),
				'description'	=> esc_html__('Background type for the 404 error page.', 'harington'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'dark-content' 	=> esc_html__('White', 'harington'),
										'light-content' => esc_html__('Black', 'harington') ),
			)
		);
		/*** End Error Page Settings section ***/
		
		/*** Typography section ***/
		$harington_typography_setting_desc = esc_html__( 'Select custom fonts for your site. You can create custom fonts variations in Appearance -> Custom Fonts.', 'harington' );
		if( !class_exists( 'Bsf_Custom_Fonts_Taxonomy' ) ){
			
			$harington_typography_setting_desc = wp_kses( __('To change default typography please install recommended plugins <a class="link" target="_blank" href="https://wordpress.org/plugins/custom-fonts/">Custom Fonts</a> and then create at least one font variation in Appearance -> Custom Fonts.', 'harington'), 'harington_allowed_html' );
		};
		
		$wp_customize->add_section(
			'typography_page_settings',
			array(
				'title'    		=> esc_html__( 'Typography', 'harington' ),
				'description' 	=> $harington_typography_setting_desc,
				'priority' 		=> ($harington_before_default_section - 1),
			)
		);
		
		$harington_custom_fonts = array( '' => esc_html__( 'Select custom font', 'harington' ) );
		$harington_custom_fonts = apply_filters('harington_custom_fonts_customizer', $harington_custom_fonts);
			
		// Typography portfolio title
		$wp_customize->add_setting(
			'clapat_harington_typography_main_title',
			array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'harington_sanitize_text_field',
			)
		);
			
		$wp_customize->add_control(
			'clapat_harington_typography_main_title',
			array(
				'label'   		=> esc_html__('Main Title', 'harington'),
				'section' 		=> 'typography_page_settings',
				'type'    		=> 'select',
				'choices'   	=> $harington_custom_fonts
			)
		);
			
		if( class_exists( 'Bsf_Custom_Fonts_Taxonomy' ) ){
			
			// Typography portfolio subtitle
			$wp_customize->add_setting(
				'clapat_harington_typography_main_subtitle',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_main_subtitle',
				array(
					'label'   		=> esc_html__('Main Subtitle', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography headings
			$wp_customize->add_setting(
				'clapat_harington_typography_headings',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_headings',
				array(
					'label'   		=> esc_html__('Headings', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography paragraph
			$wp_customize->add_setting(
				'clapat_harington_typography_paragraph',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_paragraph',
				array(
					'label'   		=> esc_html__('Paragraph', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography body
			$wp_customize->add_setting(
				'clapat_harington_typography_body',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_body',
				array(
					'label'   		=> esc_html__('Body', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography inputs
			$wp_customize->add_setting(
				'clapat_harington_typography_inputs',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_inputs',
				array(
					'label'   		=> esc_html__('Inputs', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography fullscreen menu
			$wp_customize->add_setting(
				'clapat_harington_typography_fullscreen_menu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_fullscreen_menu',
				array(
					'label'   		=> esc_html__('Fullscreen Menu', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography fullscreen submenu
			$wp_customize->add_setting(
				'clapat_harington_typography_fullscreen_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_fullscreen_submenu',
				array(
					'label'   		=> esc_html__('Fullscreen Submenu', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography fullscreen submenu
			$wp_customize->add_setting(
				'clapat_harington_typography_fullscreen_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_fullscreen_submenu',
				array(
					'label'   		=> esc_html__('Fullscreen Submenu', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography classic menu
			$wp_customize->add_setting(
				'clapat_harington_typography_classic_menu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_classic_menu',
				array(
					'label'   		=> esc_html__('Classic Menu', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography classic submenu
			$wp_customize->add_setting(
				'clapat_harington_typography_classic_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_classic_submenu',
				array(
					'label'   		=> esc_html__('Classic Submenu', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography responsive menu
			$wp_customize->add_setting(
				'clapat_harington_typography_responsive_menu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_responsive_menu',
				array(
					'label'   		=> esc_html__('Responsive Menu', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
			
			// Typography classic submenu
			$wp_customize->add_setting(
				'clapat_harington_typography_responsive_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'harington_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_harington_typography_responsive_submenu',
				array(
					'label'   		=> esc_html__('Responsive Submenu', 'harington'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $harington_custom_fonts
				)
			);
		}
		/*** Typography section ***/
	}

	add_action( 'customize_register', 'harington_options_config' );
}

/**
 * Sanitize a text or textarea field
 *
 * @param string $input - the text
 */
function harington_sanitize_text_field( $input ) {
	
	return wp_kses( $input, 'harington_allowed_html' );
}

/**
 * Sanitize a custom slug field
 *
 * @param string $input - the input slug
 */
function harington_sanitize_slug_field( $input ) {
	
	return sanitize_title( $input );
}


/**
 * Sanitize the social network options.
 *
 * @param string $input social network id.
 */
function harington_sanitize_social_links( $input ) {
	
	global $harington_social_links;
	$valid = array_keys( $harington_social_links );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'Fb';
}


/**
 * Sanitize the portfolio navigation order.
 *
 * @param string $input - portfolio navigation order
 */
function harington_sanitize_portfolio_navigation_order( $input ) {
	
	$valid = array( 'forward', 'backward' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'forward';
}

/**
 * Sanitize the blog layout types.
 *
 * @param string $input - blog layout type
 */
function harington_sanitize_blog_pages_layout( $input ) {
	
	$valid = array( 'blog-classic', 'blog-minimal' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'forward';
}

/**
 * Sanitize the blog navigation types.
 *
 * @param string $input - blog layout type
 */
function harington_sanitize_blog_navigation_type( $input ) {
	
	$valid = array( 'blog-nav-classic', 'blog-nav-minimal' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'forward';
}

/**
 * Sanitize the blog excerpt types.
 *
 * @param string $input - blog excerpt type
 */
function harington_sanitize_blog_excerpt_type( $input ) {
	
	$valid = array( 'blog-excerpt-none', 'blog-excerpt', 'blog-excerpt-full' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'blog-excerpt-none';
}

/**
 * Sanitize the showcase transition pattern settings.
 *
 * @param string $input - showcase transition
 */
function harington_sanitize_showcase_transition_pattern_image( $input ) {
	
	global $harington_slide_transitions;
	$valid = array_keys( $harington_slide_transitions );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'first';
}

/**
 * Sanitize the map type
 *
 * @param string $input - map type
 */
function harington_sanitize_map_type( $input ) {
	
	$valid = array( 'satellite', 'roadmap' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'satellite';
}

/**
 * Sanitize the global page background type
 *
 * @param string $input - background type
 */
function harington_sanitize_default_page_bknd_type( $input ) {
	
	$valid = array( 'dark-content', 'light-content' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light-content';
}

/**
 * Sanitize the error page background type
 *
 * @param string $input - background type
 */
function harington_sanitize_error_page_bknd_type( $input ) {
	
	$valid = array( 'dark-content', 'light-content' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light-content';
}

/**
 * Sanitize the header menu type
 *
 * @param string $input - header menu type
 */
function harington_sanitize_menu_header_type( $input ) {
	
	$valid = array( 'classic-burger-dots', 'classic-burger-lines', 'fullscreen-burger-dots', 'fullscreen-burger-lines' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'classic-burger-dots';
}

/**
 * Sanitize the menu background type
 *
 * @param string $input - background type
 */
function harington_sanitize_menu_bknd_type( $input ) {
	
	$valid = array( 'invert-header', 'inherit-header' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'invert-header';
}