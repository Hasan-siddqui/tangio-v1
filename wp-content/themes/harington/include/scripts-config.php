<?php
/**
 * Created by Clapat.
 * Date: 16/11/21
 * Time: 7:26 AM
 */

if ( ! function_exists( 'harington_load_scripts' ) ){

	function harington_load_scripts() {

		// Force load Elementor styles on non-Elementor pages if AJAX page transitions are turned on
		if ( class_exists( '\Elementor\Frontend' ) && !harington_post_is_built_with_elementor() && harington_get_theme_options( "clapat_harington_enable_ajax" ) ) {

			\Elementor\Frontend::instance()->enqueue_styles();
		}

		// Enqueue css files
		wp_enqueue_style( 'harington-content', get_template_directory_uri() . '/css/content.css' );

		wp_enqueue_style( 'harington-showcase', get_template_directory_uri() . '/css/showcase.css' );

		wp_enqueue_style( 'harington-portfolio', get_template_directory_uri() . '/css/portfolio.css' );

		wp_enqueue_style( 'harington-blog', get_template_directory_uri() . '/css/blog.css' );

		wp_enqueue_style( 'harington-shortcodes', get_template_directory_uri() . '/css/shortcodes.css' );

		wp_enqueue_style( 'harington-assets', get_template_directory_uri() . '/css/assets.css' );
		
		wp_enqueue_style( 'harington-style-wp', get_template_directory_uri() . '/css/style-wp.css' );
		
		wp_enqueue_style( 'harington-page-builders', get_template_directory_uri() . '/css/page-builders.css' );

		wp_enqueue_style( 'harington-theme', get_stylesheet_uri(), array('harington-content', 'harington-showcase', 'harington-portfolio', 'harington-blog', 'harington-shortcodes', 'harington-assets', 'harington-style-wp', 'harington-page-builders') );

		$harington_typography_css = harington_typography_css();
		if( empty( !$harington_typography_css ) ){
			
			wp_add_inline_style( 'harington-theme', $harington_typography_css );
		}
		
		if ( class_exists( '\Elementor\Plugin' ) ) {

			wp_enqueue_style( 'elementor-icons-fa-brands' ); // FontAwesome 5 Brands from Elementor
			wp_enqueue_style( 'elementor-icons-fa-solid' ); // FontAwesome 5 Solid from Elementor
		}

		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/all.min.css' );

		// enqueue standard font style
		$harington_main_font_url  = '';
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'harington') ) {
			$harington_main_font_url = add_query_arg( 'family', urlencode( 'Poppins:300,400,500,600,700' ), "//fonts.googleapis.com/css" );
			$harington_secondary_font_url = add_query_arg( array( 'family' => urlencode( 'Six Caps' ),
																'display' => 'swap' ), "//fonts.googleapis.com/css" );
		}
		wp_enqueue_style( 'harington-main-font', $harington_main_font_url, array(), '1.0.0' );
		wp_enqueue_style( 'harington-secondary-font', $harington_secondary_font_url, array(), '1.0.0' );

		// Force load Elementor scripts on non-Elementor pages if AJAX page transitions are turned on
		if ( class_exists( '\Elementor\Frontend' ) && !harington_post_is_built_with_elementor() && harington_get_theme_options( "clapat_harington_enable_ajax" ) ) {

			\Elementor\Frontend::instance()->enqueue_scripts();
		}

		// enqueue scripts
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

			// Register scripts
			wp_enqueue_script(
            'modernizr',
            get_template_directory_uri() . '/core/js/modernizr.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'jquery-flexnav',
            get_template_directory_uri() . '/core/js/jquery.flexnav.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'jquery-waitforimages',
            get_template_directory_uri() . '/core/js/jquery.waitforimages.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'appear',
            get_template_directory_uri() . '/core/js/appear.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'jquery-magnific-popup',
            get_template_directory_uri() . '/core/js/jquery.magnific-popup.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'jquery-justifiedgallery',
            get_template_directory_uri() . '/core/js/jquery.justifiedGallery.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'isotope-pkgd',
            get_template_directory_uri() . '/core/js/isotope.pkgd.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'packery-mode-pkd',
            get_template_directory_uri() . '/core/js/packery-mode.pkgd.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script( 'imagesloaded' );

		wp_enqueue_script(
            'three',
            get_template_directory_uri() . '/core/js/three.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'clapatwebgl',
            get_template_directory_uri() . '/core/js/clapatwebgl.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
			'scroll-to-plugin',
			get_template_directory_uri() . '/core/js/scrolltoplugin.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'smooth-scroll-drag',
			get_template_directory_uri() . '/core/js/smooth-scroll-drag.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'gsap',
			get_template_directory_uri() . '/core/js/gsap.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
            'ease-pack',
            get_template_directory_uri() . '/core/js/easepack.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'scroll-magic',
            get_template_directory_uri() . '/core/js/scrollmagic.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'animation-gsap',
            get_template_directory_uri() . '/core/js/animation.gsap.min.js',
            array('jquery'),
            false,
            true
		);
		
		wp_enqueue_script(
            'scroll-trigger',
            get_template_directory_uri() . '/core/js/scrolltrigger.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
			'swiper',
			get_template_directory_uri() . '/core/js/swiper.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'js-socials',
			get_template_directory_uri() . '/core/js/jssocials.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'grid-to-fullscreen',
			get_template_directory_uri() . '/core/js/gridtofullscreen.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'smooth-scrollbar',
			get_template_directory_uri() . '/core/js/smooth-scrollbar.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'harington-common',
			get_template_directory_uri() . '/core/js/common.js',
			array('jquery'),
			false,
			true
		);
		
		wp_enqueue_script(
			'harington-contact',
			get_template_directory_uri() . '/core/js/contact.js',
			array('jquery'),
			false,
			true
		);
		
		wp_enqueue_script(
			'harington-scripts',
			get_template_directory_uri() . '/js/scripts.js',
			array('jquery'),
			false,
			true
		);

		wp_localize_script( 'harington-common',
						'ClapatThemeOptions',
						array( 	"share_social_network_list" => harington_get_theme_options('clapat_harington_portfolio_share_social_networks') )
						);
					
		wp_localize_script( 'harington-scripts',
                    'ClapatHaringtonThemeOptions',
                    array( 	"enable_preloader" 	=> harington_get_theme_options('clapat_harington_enable_preloader') )
					);

		wp_localize_script( 'harington-contact',
							'ClapatMapOptions',
							array(  "map_marker_image"	=> esc_js( esc_url ( harington_get_theme_options("clapat_harington_map_marker") ) ),
									"map_address"		=> harington_get_theme_options('clapat_harington_map_address'),
									"map_zoom"			=> harington_get_theme_options('clapat_harington_map_zoom'),
									"marker_title"		=> harington_get_theme_options('clapat_harington_map_company_name'),
									"marker_text"		=> harington_get_theme_options('clapat_harington_map_company_info'),
									"map_type" 			=> harington_get_theme_options('clapat_harington_map_type'),
									"map_api_key"		=> harington_get_theme_options('clapat_harington_map_api_key') ) );

	}

}

add_action('wp_enqueue_scripts', 'harington_load_scripts');

if ( ! function_exists( 'harington_admin_load_scripts' ) ){

    function harington_admin_load_scripts() {

		// enqueue standard font style
		$harington_main_font_url  = '';
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'harington') ) {
			$harington_main_font_url = add_query_arg( 'family', urlencode( 'Poppins:300,400,600,700' ), "//fonts.googleapis.com/css" );
		}
		wp_enqueue_style( 'harington-main-font', $harington_main_font_url, array(), '1.0.0' );
	}
}
add_action('admin_enqueue_scripts', 'harington_admin_load_scripts');

if ( ! function_exists( 'harington_typography_css' ) ){

	function harington_typography_css() {
		
		$harington_typography_css = '';
		
		// If custom fonts plugin is installed
		if ( class_exists( 'Bsf_Custom_Fonts_Render' ) ){
			
			$arr_custom_fonts = array();
			
			// if custom fonts plugin is installed
			$bsf_instance = Bsf_Custom_Fonts_Render::get_instance();
			
			if( method_exists( $bsf_instance, 'get_existing_font_posts' ) ){

				$all_fonts = $bsf_instance->get_existing_font_posts();

				if ( empty( $all_fonts ) || ! is_array( $all_fonts ) ) {
					
					return;
				}
				
				foreach ( $all_fonts as $font => $id ) {
					
					$font_family    = get_the_title( $id );
					$font_data      = get_post_meta( $id, 'fonts-data', true );

					if ( ! empty( $font_data['variations'] ) ) {
						
						foreach ( $font_data['variations'] as $variation ) {
							
							$font_label = $font_family;
							
							$font_weight = "";
							if( !empty( $variation['font_weight'] ) ){
								
								$font_weight = $variation['font_weight'];
							}
							
							$font_style = "";
							if( !empty( $variation['font_style'] ) ){
								
								$font_style = $variation['font_style'];
							}
							
							$arr_custom_fonts[ $id.$variation['id'] ] = array( 'name' => $font_family, 'weight' => $font_weight,  'style' => $font_style );
						}
					}
					else{
						
						$arr_custom_fonts[ $id ] = array( 'name' => $font_family );
					}
				}
			}
			else {
				
				// Get the custom fonts installed
				$font_terms = get_terms(
								Bsf_Custom_Fonts_Taxonomy::$register_taxonomy_slug,
								array(
									'hide_empty' => false,
								)
							);
							
				if ( ! empty( $font_terms ) ) {
					
					foreach ( $font_terms as $term ) {
						
						$font_props = Bsf_Custom_Fonts_Taxonomy::get_font_links( $term->term_id );
						foreach ( $font_props as $font_prop_id => $font_prop_value  ) {
							
							if ( strpos( $font_prop_id , 'weight' ) !== false ) {
															
								$arr_custom_fonts[ $term->term_id.$font_prop_id ] = array( 'name' => $term->name, 'weight' => $font_prop_value );
							}
						}
					}
				}
			}
			
			// Portfolio title
			if( harington_get_theme_options( 'clapat_harington_typography_main_title' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_main_title' ) ){
						
						$harington_typography_css .= ' .slide-title, .hero-title, .next-hero-title, article .post-title, .blog-numbers, .page-numbers, .post-prev-caption, .post-next-caption, .team-member {';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Portfolio subtitle
			if( harington_get_theme_options( 'clapat_harington_typography_main_subtitle' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_main_subtitle' ) ){
						
						$harington_typography_css .= ' .hero-subtitle, .next-hero-subtitle, .slide-subtitle, .hero-text { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Headings
			if( harington_get_theme_options( 'clapat_harington_typography_headings' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_headings' ) ){
						
						$harington_typography_css .= ' h1, h2, h3, h4, h5, h6 { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Paragraph
			if( harington_get_theme_options( 'clapat_harington_typography_paragraph' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_paragraph' ) ){
						
						$harington_typography_css .= ' p, #ball p, .accordion .accordion-content { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Body
			if( harington_get_theme_options( 'clapat_harington_typography_body' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_body' ) ){
						
						$harington_typography_css .= ' html, body { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Inputs
			if( harington_get_theme_options( 'clapat_harington_typography_inputs' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_inputs' ) ){
						
						$harington_typography_css .= ' input, textarea, input[type="submit"] { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Fullscreen Menu
			if( harington_get_theme_options( 'clapat_harington_typography_fullscreen_menu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_fullscreen_menu' ) ){
						
						$harington_typography_css .= ' @media all and (min-width: 1025px) { .fullscreen-menu .flexnav li a { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
					if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '} ';
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Fullscreen Submenu
			if( harington_get_theme_options( 'clapat_harington_typography_fullscreen_submenu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_fullscreen_submenu' ) ){
						
						$harington_typography_css .= ' @media all and (min-width: 1025px) { .fullscreen-menu .flexnav li ul li a { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '} ';
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Classic Menu
			if( harington_get_theme_options( 'clapat_harington_typography_classic_menu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_classic_menu' ) ){
						
						$harington_typography_css .= ' @media all and (min-width: 1025px) { .classic-menu .flexnav li a { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '} ';
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Classic Submenu
			if( harington_get_theme_options( 'clapat_harington_typography_classic_submenu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_classic_submenu' ) ){
						
						$harington_typography_css .= ' @media all and (min-width: 1025px) { .classic-menu .flexnav li ul li a { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '} ';
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Responsive Menu
			if( harington_get_theme_options( 'clapat_harington_typography_responsive_menu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_responsive_menu' ) ){
						
						$harington_typography_css .= ' @media all and (max-width: 1024px) { .flexnav li a { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '} ';
						$harington_typography_css .= '}';
						break;
					}
				}
			}
			
			// Responsive Submenu
			if( harington_get_theme_options( 'clapat_harington_typography_responsive_submenu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == harington_get_theme_options( 'clapat_harington_typography_responsive_submenu' ) ){
						
						$harington_typography_css .= ' @media all and (max-width: 1024px) { .flexnav li ul li a { ';
						$harington_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$harington_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$harington_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$harington_typography_css .= '} ';
						$harington_typography_css .= '}';
						break;
					}
				}
			}
		}
		
		return $harington_typography_css;
	}
}