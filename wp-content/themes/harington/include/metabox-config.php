<?php

// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = 'clapat_' . HARINGTON_THEME_ID . '_theme_options';


if ( !function_exists( "harington_add_metaboxes" ) ){

    function harington_add_metaboxes( $metaboxes ) {

    $metaboxes = array();


    ////////////// Page Options //////////////
    $page_options = array();
    $page_options[] = array(
        'title'         => esc_html__('General', 'harington'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'desc'          => esc_html__('Options concerning all page templates.', 'harington'),
        'fields'        => array(

			array(
                'id'        => 'harington-opt-page-bknd-color-code',
                'type'      => 'color-picker',
                'title'     => esc_html__('Background color', 'harington'),
				'desc'      => esc_html__('Background color for this page.', 'harington'),
                'default'   => '#171717',
            ),
			
			array(
                'id'        => 'harington-opt-page-bknd-color',
                'type'      => 'select',
                'title'     => esc_html__('Background Type', 'harington'),
				'desc'      => esc_html__('Background type for this page.', 'harington'),
                'options'   => array(
                    'dark-content' 	=> esc_html__('Light', 'harington'),
                    'light-content' => esc_html__('Dark', 'harington')

                ),
				'default'   => 'light-content',
            ),

			/**************************HERO SECTION OPTIONS**************************/
			array(
                'id'        => 'harington-opt-page-enable-hero',
                'type'      => 'switch',
                'title'     => esc_html__('Display Hero Section', 'harington'),
                'desc'      => esc_html__('Enable "hero" section displayed immediately below page header. Showcase and Carousel pages do not have a hero section.', 'harington'),
				'on'       => esc_html__('Yes', 'harington'),
				'off'      => esc_html__('No', 'harington'),
                'default'   => false
            ),

			array(
				'id'        => 'harington-opt-page-hero-img',
                'type'      => 'media',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
                'url'       => true,
                'title'     => esc_html__('Hero Image', 'harington'),
                'desc'      => esc_html__('Upload hero background image. The hero image is the fullscreen image in hero section. Hero section is the intro section displayed at the top of the page.', 'harington'),
                'default'   => array(),
            ),
			
			array(
                'id'        => 'harington-opt-page-invert-hero-header',
                'type'      => 'select',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Invert foreground color over hero image', 'harington'),
				'desc'      => esc_html__('This will invert foreground color when scrolling over hero image.', 'harington'),
                'options'   => array(
                    'change-header-color' => esc_html__('Yes', 'harington'),
                    'default-header-color' => esc_html__('No', 'harington')

                ),
				'default'   => 'default-header-color',
            ),
			
			array(
				'id'        => 'harington-opt-page-video',
				'type'      => 'switch',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
				'title'     => esc_html__('Video Hero', 'harington'),
				'desc'   	=> esc_html__('Video displayed as hero section in project page. If you check this option set the Hero Image as the first frame image of the video to avoid flickering!', 'harington'),
				'on'       	=> esc_html__('Yes', 'harington'),
				'off'      	=> esc_html__('No', 'harington'),
				'default'   => false
			),

			array(
				'id'        => 'harington-opt-page-video-webm',
				'type'      => 'text',
				'title'     => esc_html__('Webm Video URL', 'harington'),
				'desc'   	=> esc_html__('URL of the hero section background webm video. Webm format is previewed in Chrome and Firefox.', 'harington'),
				'required'	=> array('harington-opt-page-video', '=', true),
			),

			array(
				'id'        => 'harington-opt-page-video-mp4',
				'type'      => 'text',
				'title'     => esc_html__('MP4 Video URL', 'harington'),
				'desc'   	=> esc_html__('URL of the hero section background MP4 video. MP4 format is previewed in IE, Safari and other browsers.', 'harington'),
				'required'	=> array('harington-opt-page-video', '=', true),
			),
			
			array(
                'id'        => 'harington-opt-page-hero-caption-title',
                'type'      => 'textarea',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Hero Caption Title', 'harington'),
                'desc'  	=> esc_html__('The title displayed over hero section. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'harington'),
	        ),
			
			array(
                'id'        => 'harington-opt-page-hero-caption-title-type',
                'type'      => 'select',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Hero Title Type', 'harington'),
                'desc'      => esc_html__('Hero title display: block, indent (last span) or as marquee (scrolling) text.', 'harington'),
				'options'   => array(
                    'block-title'	=> esc_html__('Block', 'harington'),
                    'indent-title' => esc_html__('Indent', 'harington'),
					'marquee-title' => esc_html__('Marquee', 'harington'),
                ),
                'default'   => 'block-title'
            ),

			array(
                'id'        => 'harington-opt-page-hero-caption-subtitle',
                'type'      => 'textarea',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Hero Caption Subtitle', 'harington'),
                'desc'  	=> esc_html__('Subtitle displayed over hero section, underneath the title. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'harington'),
			),
			
			array(
                'id'        => 'harington-opt-page-hero-scroll-caption',
                'type'      => 'text',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
				'title'     => esc_html__('Scroll Down Caption', 'harington'),
                'desc'  	=> esc_html__('Scroll down caption displayed to the bottom right of the hero image indicating scrolling down to reveal the content. Leave empty for no scroll down button.', 'harington'),
				'default'   => '',
	        ),
			
			array(
                'id'        => 'harington-opt-page-hero-info-text',
                'type'      => 'text',
				'required'  => array( 'harington-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Hero Info Text', 'harington'),
                'desc'  	=> esc_html__('Additional info regarding this page.', 'harington'),
	        ),
			
			array(
                'id'        => 'harington-opt-page-hero-parallax-caption',
                'type'      => 'select',
                'title'     => esc_html__('Enable Parallax Caption', 'harington'),
                'desc'      => esc_html__('Parallax scrolling effect on hero section title and subtitle. This only applies if there is no hero image assigned.', 'harington'),
				'options'   => array(
                    'parallax-scroll-caption'	=> esc_html__('Yes', 'harington'),
                    'normal-scroll-caption' => esc_html__('No', 'harington')
                ),
                'default'   => 'parallax-scroll-caption'
            ),
			
			array(
                'id'        => 'harington-opt-page-hero-caption-align',
                'type'      => 'select',
                'title'     => esc_html__('Caption Alignment', 'harington'),
                'desc'      => esc_html__('The alignment of the hero caption (title and subtitle).', 'harington'),
				'options'   => array(
                    'text-align-center'	=> esc_html__('Center', 'harington'),
                    'text-align-left' => esc_html__('Left', 'harington')
                ),
                'default'   => 'text-align-left'
            ),
			
			/**************************END - HERO SECTION OPTIONS**************************/

			/**************************PAGE NAVIGATION SECTION**************************/
			array(
                'id'        => 'harington-page-navigation-caption-first-line',
                'type'      => 'text',
				'title'     => esc_html__('Navigation Caption - First Line', 'harington'),
                'desc'		=> esc_html__('First line of caption displayed when hovering over bottom navigation section.', 'harington'),
				'default'   => esc_html__('Next', 'harington'),
			),
			
			array(
                'id'        => 'harington-page-navigation-caption-second-line',
                'type'      => 'text',
				'title'     => esc_html__('Navigation Caption - Second Line', 'harington'),
                'desc'		=> esc_html__('Second line of caption displayed when hovering over bottom navigation section.', 'harington'),
				'default'   => esc_html__('Page', 'harington'),
			),
			
			array(
                'id'        => 'harington-opt-page-navigation-next-page',
                'type'      => 'select',
                'title'     => esc_html__('Next Page In Navigation', 'harington'),
				'desc'      => esc_html__('The next page navigation displayed at the bottom of the current page.', 'harington'),
                'options'   => harington_list_published_pages(),
				'default'   => '',
            ),
			
			array(
                'id'        => 'harington-opt-page-navigation-caption-title',
                'type'      => 'textarea',
                'title'     => esc_html__('Next Page Caption Title', 'harington'),
                'desc'  	=> esc_html__('Leave it empty to display the next page hero title. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'harington'),
	        ),
			
			array(
                'id'        => 'harington-opt-page-navigation-caption-title-marquee',
                'type'      => 'switch',
                'title'     => esc_html__('Marquee Next Page Title', 'harington'),
                'desc'      => esc_html__('Displays next page title as marquee (scrolling) text.', 'harington'),
				'on'       	=> esc_html__('Yes', 'harington'),
				'off'      	=> esc_html__('No', 'harington'),
                'default'   => false
            ),

			array(
                'id'        => 'harington-opt-page-navigation-caption-subtitle',
                'type'      => 'textarea',
                'title'     => esc_html__('Next Page Caption Subtitle', 'harington'),
                'desc'  	=> esc_html__('Leave it empty to display the next page hero subtitle. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'harington'),
			),
			/**************************END - PAGE NAVIGATION SECTION**************************/
        ),
    );

	$page_options[] = array(
        'title'         => esc_html__('Portfolio Templates', 'harington'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-folder-open',
        'desc'          => esc_html__('Options concerning only Portfolio templates (Creative Grid, Showcase, Carousel, Reverse List).', 'harington'),
        'fields'        => array(

			array(
                'id'        	=> 'harington-opt-page-portfolio-filter-category',
                'type'      	=> 'text',
				'title'     	=> esc_html__('Category Filter', 'harington'),
                'desc'  		=> esc_html__('Paste here the portfolio category slugs you want to include in the portfolio page templates separated by comma. Do not include spaces. For example photography,branding. It will exclude the rest of the categories. The portfolio category slugs can be found in Portfolio -> Categories.', 'harington'),
				'default'  	=> '',
	        ),
			
			array(
				'id'        => 'harington-opt-page-portfolio-grid-layout',
				'type'      => 'select',
				'title'     => esc_html__('Creative Grid Layout', 'harington'),
				'desc'      => esc_html__('Creative grid portfolio page layout.', 'harington'),
				'options'   => array(
								'metro-grid' => esc_html__('Metro', 'harington'),
								'parallax-grid' => esc_html__('Parallax', 'harington'),
								'scaleout-grid' => esc_html__('Scaleout', 'harington'),
								'ladder-grid' => esc_html__('Ladder', 'harington'),
								'classic-grid' => esc_html__('Classic', 'harington')
							),
				'default'   => 'parallax-grid',
			),
			
			array(
				'id'        => 'harington-opt-page-portfolio-thumb-to-fullscreen',
				'type'      => 'select',
				'title'     => esc_html__('Thumbnail To Fullscreen Animation', 'harington'),
				'desc'      => esc_html__('Type of animation when navigating from a portfolio thumbnail to the portfolio hero section background image.', 'harington'),
				'options'   => array(
								'webgl-fitthumbs' 	=> esc_html__('WebGL Animation', 'harington'),
								'scale-fitthumbs' => esc_html__('GSAP Animation', 'harington'),
								'no-fitthumbs' => esc_html__('None', 'harington')
							),
				'default'   => 'webgl-fitthumbs',
			),
			
			array(
				'id'        => 'harington-opt-page-portfolio-thumb-to-fullscreen-webgl-type',
				'type'      => 'select',
				'title'     => esc_html__('WebGL Animation Type', 'harington'),
				'desc'      => esc_html__('Type of animation when WebGL thumbnail to fullscreen effect is selected.', 'harington'),
				'options'   => array(
								'fx-one' 	=> esc_html__('FX one', 'harington'),
								'fx-two' 	=> esc_html__('FX two', 'harington'),
								'fx-three' 	=> esc_html__('FX three', 'harington'),
								'fx-four' 	=> esc_html__('FX four', 'harington'),
								'fx-five' 	=> esc_html__('FX five', 'harington'),
								'fx-six' 	=> esc_html__('FX six', 'harington')
							),
				'default'   => 'fx-one',
			),
			
			array(
                 'id'       	=> 'harington-opt-page-portfolio-grid-content-position',
                 'type'     	=> 'select',
                 'title'    	=> esc_html__( 'Page Content Position', 'harington'),
                 'desc' 		=> esc_html__( 'Available only for Portfolio Grid Template: page content position in relation with portfolio grid.', 'harington'),
                 'options'   => array(
                    'after' 	=> esc_html__('After Portfolio Grid', 'harington'),
					'before'	=> esc_html__('Before Portfolio Grid', 'harington'),
                 ),
				 'default'	=> 'after',
            ),
			
			array(
                'id'        	=> 'harington-opt-page-panels-parallax',
                'type'      	=> 'text',
				'title'     	=> esc_html__('Parallax Panels Value', 'harington'),
                'desc'  		=> esc_html__('Available only for Parallax Panels Template: Value between 0 and 1 representing the parallax value for panel images.', 'harington'),
				'default'  		=> '1',
	        ),

		),
	);

	$metaboxes[] = array(
        'id'            => 'clapat_' . HARINGTON_THEME_ID . '_page_options',
        'title'         => esc_html__( 'Page Options', 'harington'),
        'post_types'    => array( 'page' ),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'high', // high, core, default, low
        'sidebar'       => false, // enable/disable the sidsebar in the normal/advanced positions
        'sections'      => $page_options,
    );

    $blog_post_options = array();
    $blog_post_options[] = array(

        'title'         => esc_html__('General', 'harington'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'desc'          => esc_html__('Options concerning blog post options.', 'harington'),
        'fields'        => array(

			array(
                'id'        => 'harington-opt-blog-bknd-color-code',
                'type'      => 'color-picker',
                'title'     => esc_html__('Background color', 'harington'),
				'desc'      => esc_html__('Background color for this blog post.', 'harington'),
                'default'   => '#171717',
            ),
			
			array(
                'id'        => 'harington-opt-blog-bknd-color',
                'type'      => 'select',
                'title'     => esc_html__('Background type', 'harington'),
				'desc'      => esc_html__('Background type for this blog post.', 'harington'),
                'options'   => array(
                    'dark-content' 	=> esc_html__('Light', 'harington'),
                    'light-content' => esc_html__('Dark', 'harington')

                ),
				'default'   => 'light-content',
            ),

			array(
                 'id'       	=> 'harington-opt-blog-hero-caption-alignment',
                 'type'     	=> 'select',
                 'title'    	=> esc_html__( 'Header Caption Alignment', 'harington'),
                 'desc' 		=> esc_html__( 'The alignment of the blog post caption.', 'harington'),
                 'options'   => array(
                    'text-align-left' 	=> esc_html__('Left', 'harington'),
					'text-align-center'	=> esc_html__('Center', 'harington'),
                 ),
				 'default'	=> 'text-align-left',
            ),
          )
        );

	$blog_post_options[] = array(
		'title'         => esc_html__('', 'harington'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
		'desc'          => '',
        'fields'        => array()
		);
		
    $metaboxes[] = array(
       'id'            => 'clapat_' . HARINGTON_THEME_ID . '_post_options',
       'title'         => esc_html__( 'Post Options', 'harington'),
       'post_types'    => array( 'post' ),
       'position'      => 'normal', // normal, advanced, side
       'priority'      => 'high', // high, core, default, low
       'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
       'sections'      => $blog_post_options,
    );


    $portfolio_options = array();
	$portfolio_options[] = array(
		'title'         => esc_html__('General', 'harington'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'desc'          => esc_html__('Options concerning portfolio item options.', 'harington'),
        'fields'        => array(

			array(
                'id'        => 'harington-opt-portfolio-bknd-color-code',
                'type'      => 'color-picker',
                'title'     => esc_html__('Background color', 'harington'),
				'desc'      => esc_html__('Background color for this portfolio item page.', 'harington'),
                'default'   => '#171717',
            ),
			
			array(
                'id'        => 'harington-opt-portfolio-bknd-color',
                'type'      => 'select',
                'title'     => esc_html__('Background type', 'harington'),
				'desc'      => esc_html__('Background type for this portfolio item page.', 'harington'),
                'options'   => array(
                    'dark-content' 	=> esc_html__('Light', 'harington'),
                    'light-content' => esc_html__('Dark', 'harington')

                ),
				'default'   => 'light-content',
            ),
			
			array(
                'id'        => 'harington-opt-portfolio-navigation-cursor-color',
                'type'      => 'color-picker',
                'title'     => esc_html__('Project navigation cursor color', 'harington'),
				'desc'      => esc_html__('Cursor color in portfolio and project Next navigation.', 'harington'),
                'default'   => '#f33a3a',
            ),
			
			array(
				'id'        => 'harington-opt-portfolio-thumb-size',
				'type'      => 'select',
				'title'     => esc_html__('Thumbnail Size', 'harington'),
				'desc'      => esc_html__('Size of the portfolio thumbnail in portfolio creative grid templates.', 'harington'),
				'options'   => array(
									'normal' 	=> esc_html__('Normal', 'harington'),
									'wide' => esc_html__('Wide', 'harington')
								),
				'default'   => 'normal',
			),
			
			array(
				'id'        => 'harington-opt-portfolio-project-year',
				'type'      => 'text',
				'title'     => esc_html__('Project Year', 'harington'),
				'desc'   	=> esc_html__('Year the portfolio project was implemented. Displayed in Parallax Panels and Archive List portfolio page templates.', 'harington'),
				'default'	=> date("Y")
			),
			
			/**************************HERO SECTION OPTIONS**************************/
			array(
				'id'        => 'harington-opt-portfolio-hero-img',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__('Hero Image', 'harington'),
                'desc'      => esc_html__('Upload hero background image. The hero image is the fullscreen image in hero section. Hero section is the header section displayed at the top of the individual project page.', 'harington'),
                'default'   => array(),
            ),
			
			array(
                'id'        => 'harington-opt-portfolio-invert-hero-header',
                'type'      => 'select',
                'title'     => esc_html__('Invert foreground color over hero image', 'harington'),
				'desc'      => esc_html__('This will invert foreground color when scrolling over hero image.', 'harington'),
                'options'   => array(
                    'change-header-color' => esc_html__('Yes', 'harington'),
                    'default-header-color' => esc_html__('No', 'harington')

                ),
				'default'   => 'default-header-color',
            ),
			
			array(
				'id'        => 'harington-opt-portfolio-video',
				'type'      => 'switch',
				'title'     => esc_html__('Video Hero', 'harington'),
				'desc'   	=> esc_html__('Video displayed as hero section in project page. If you check this option set the Hero Image as the first frame image of the video to avoid flickering!', 'harington'),
				'on'       	=> esc_html__('Yes', 'harington'),
				'off'      	=> esc_html__('No', 'harington'),
				'default'   => false
			),

			array(
				'id'        => 'harington-opt-portfolio-video-webm',
				'type'      => 'text',
				'title'     => esc_html__('Webm Video URL', 'harington'),
				'desc'   	=> esc_html__('URL of the hero section background webm video. Webm format is previewed in Chrome and Firefox.', 'harington'),
				'required'	=> array('harington-opt-portfolio-video', '=', true),
			),

			array(
				'id'        => 'harington-opt-portfolio-video-mp4',
				'type'      => 'text',
				'title'     => esc_html__('MP4 Video URL', 'harington'),
				'desc'   	=> esc_html__('URL of the hero section background MP4 video. MP4 format is previewed in IE, Safari and other browsers.', 'harington'),
				'required'	=> array('harington-opt-portfolio-video', '=', true),
			),

			array(
				'id'        => 'harington-opt-portfolio-hero-caption-title',
				'type'      => 'textarea',
				'title'     => esc_html__('Hero Caption Title', 'harington'),
				'desc'  	=> esc_html__('Title displayed over hero section. The hero background image is set in the hero image set in preceding option. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'harington'),
			),
									
			array(
                'id'        => 'harington-opt-portfolio-hero-parallax-caption',
                'type'      => 'select',
                'title'     => esc_html__('Enable Parallax Caption', 'harington'),
                'desc'      => esc_html__('Parallax scrolling effect on hero section title and subtitle. This only applies if there is no hero image assigned.', 'harington'),
				'options'   => array(
                    'parallax-scroll-caption'	=> esc_html__('Yes', 'harington'),
                    'normal-scroll-caption' => esc_html__('No', 'harington')
                ),
                'default'   => 'parallax-scroll-caption'
            ),
			
			array(
                'id'        => 'harington-opt-portfolio-hero-scroll-caption',
                'type'      => 'text',
				'title'     => esc_html__('Scroll Down Caption', 'harington'),
                'desc'  => esc_html__('Scroll down caption displayed to the left of the hero image indicating scrolling down to reveal the content. Leave empty for no scroll down button.', 'harington'),
				'default'   => '',
	        ),

			/**************************END - HERO SECTION OPTIONS**************************/

        ),
    );
	
	$portfolio_options[] = array(
		'title'         => esc_html__('', 'harington'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
		'desc'          => '',
        'fields'        => array()
		);

    $metaboxes[] = array(
        'id'            => 'clapat_' . HARINGTON_THEME_ID . '_portfolio_options',
        'title'         => esc_html__( 'Portfolio Item Options', 'harington'),
        'post_types'    => array( 'harington_portfolio' ),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'high', // high, core, default, low
        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'      => $portfolio_options,
    );

	return $metaboxes;
  }

}

if( class_exists('Harington\Core\Metaboxes\Meta_Boxes') ){

	$metabox_definitions = array();
	$metabox_definitions = harington_add_metaboxes( $metabox_definitions );
	do_action( 'harington/core/add_metaboxes', $metabox_definitions );
}
