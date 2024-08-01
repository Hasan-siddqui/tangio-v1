<?php
/**
 * Created by Clapat
 * Date: 01/12/22
 * Time: 11:00 AM
 */

 // Extra classes to the body
if ( ! function_exists( 'harington_body_class' ) ){

	function harington_body_class( $classes ) {

		$classes[] = 'hidden';
		$classes[] = 'hidden-ball';
		$classes[] = 'hero-below-caption';
		
		if( harington_get_theme_options( 'clapat_harington_enable_smooth_scrolling' ) ){
			
			$classes[] = 'smooth-scroll';
		}
		
		if( !harington_get_theme_options('clapat_harington_enable_preloader') ){
			
			$classes[] = 'disable-preloader';
		}
			
		if( !harington_get_theme_options( 'clapat_harington_enable_ajax' ) ){
			
			$classes[] = 'disable-ajaxload';
		}
		
		if( !harington_get_theme_options( 'clapat_harington_enable_magic_cursor' ) ){
			
			$classes[] = 'disable-cursor';
		}
		
		if( harington_get_theme_options( 'clapat_harington_uppercase_text' ) ){
			
			$classes[] = 'uppercase-text';
		}
		
		// return the $classes array
		return $classes;
	}
}
add_filter( 'body_class', 'harington_body_class' );

// site/blog title
if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function harington_wp_title() {

		echo wp_title( '|', false, 'right' );

	}
	add_action( 'wp_head', 'harington_wp_title' );
}

// menu
if ( ! function_exists( 'harington_menu_classes' ) ){

	function harington_menu_classes(  $classes , $item, $args ){

		$classes[] = 'link';
		if( $item->menu_item_parent == "0" ){
			
			$classes[] = 'menu-timeline';
		}
		if( in_array( 'current-menu-item', $item->classes ) || in_array( 'current-menu-ancestor', $item->classes ) ){

			$classes[] = 'active';
		}
				
		return $classes;
	}

}
if ( ! function_exists( 'harington_menu_link_attributes' ) ){

	function harington_menu_link_attributes(  $atts, $item, $args ){

		$arr_classes = array();
		
		if( !empty($item->classes) ){

			if( !in_array( 'menu-item-type-custom', $item->classes ) && !in_array( 'menu-item-has-children', $item->classes ) ){
				
				// if the menu item is not a custom link
				$atts['data-type'] = 'page-transition';	
				$arr_classes[] = 'ajax-link';
			}
		}
		
		if( !empty($item->classes) ){
			if( in_array( 'current-menu-item', $item->classes ) || in_array( 'current-menu-ancestor', $item->classes ) ){

				$arr_classes[] = 'active';
			}
		}

		if( !empty($item->classes) ){

			if( in_array( 'menu-item-has-children', $item->classes ) ){
				// if the menu item is a parent item, just use an empty <a> tag
				if( isset( $atts['data-type'] ) ){
					$atts['data-type'] = null;
				}
			}
		}
		if( !empty( $arr_classes ) ){

			$atts['class'] = implode( ' ', $arr_classes );
		}

		return $atts;
	}

}
if ( ! function_exists( 'harington_menu_item_title' ) ){

	function harington_menu_item_title(  $title, $item, $args, $depth ){

		if( $depth === 0 ){
			
			if( preg_match( "/<[^<]+>/", $title ) != 0 ){
				
				$title = '<div class="before-span">' . $title . '</div>';
			}
			else {
				
				// if the string does not contain any HTML tags as in multilingual flags, add the data hover attribute
				$title = '<div class="before-span"><span data-hover="' . esc_attr( $title ) . '">' . $title . '</span></div>';			
			}
			
		}
		return $title;
	}

}
// change priority here if there are more important actions associated with the hook
add_action('nav_menu_css_class', 'harington_menu_classes', 10, 3);
add_filter('nav_menu_link_attributes', 'harington_menu_link_attributes', 10, 3 );
add_filter( 'nav_menu_item_title', 'harington_menu_item_title', 10, 4 );

// hooks to add extra classes for next & prev portfolio projects and single blog posts
if ( ! function_exists( 'harington_prev_post_link' ) ){

	function harington_prev_post_link( $output, $format, $link, $post ){

			if( $format == 'harington_portfolio' ){

				$output = '';
				$next_post = $post;

				if( $post ){

					$next_post = $post;
				}
				else{ // could not find the next post so rewind to the oldest one

					$args = array(
							'posts_per_page'	=> 2,
							'order'           => 'DESC',
							'post_type'       => 'harington_portfolio',
						);

					$find_query = new WP_Query( $args );
					if ( $find_query->have_posts() && ($find_query->found_posts > 1) )  {

						$find_query->the_post();

						$next_post = $find_query->post;

					} else {
						// no posts found
					}

					wp_reset_postdata();
				}

				if( $next_post ){
					
					$harington_hero_properties = new Harington_Hero_Properties();
					$harington_hero_properties->post_id	= $next_post->ID;
					$harington_hero_properties->getProperties( get_post_type( $next_post->ID ) );
					$harington_hero_image = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $next_post->ID, 'harington-opt-portfolio-hero-img' );
					$harington_hero_title = $harington_hero_properties->caption_title;
					$harington_hero_subtitle = esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_first_line' ) ) . ' ' . esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_second_line' ) );
					$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-bknd-color' );
					$harington_project_nav_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $next_post->ID, 'harington-opt-portfolio-navigation-cursor-color' );
					$harington_project_nav_autotrigger = harington_get_theme_options( 'clapat_harington_portfolio_nav_autotrigger' );
					$harington_nav_class = "";
					if( $harington_bknd_color == "dark-content" ){
						
						$harington_nav_class = "";
					}
					else{
						
						$harington_nav_class = "change-header";
					}
					
					$output = '<!-- Project Navigation -->';
					$output .= '<div id="project-nav" class="' . $harington_nav_class . '">';
					$output .= '<div class="next-project-wrap">';
					$output .= '<div class="next-project-caption content-full-width">';
					$output .= '<div class="next-caption-wrapper">';
					$output .= '<div class="caption-wrapper">';
					$output .= '<a class="next-ajax-link-project ';
					if( $harington_project_nav_autotrigger ) { $output .= 'auto-trigger'; } else { $output .= 'auto-trigger-disabled'; }
					$output .= '" data-type="page-transition" href="'. esc_url( get_permalink( $next_post ) ) . '" data-color="' . $harington_project_nav_color . '" data-firstline="' . esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_first_line' ) ) . '" data-secondline="' . esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_second_line' ) ) .'"></a>';
					$output .= '<div class="next-caption">';
					if( !empty( $harington_hero_subtitle ) ){
						
						$output .= '<div class="next-hero-subtitle-wrapper"><div class="next-hero-subtitle"><span>' . wp_kses( $harington_hero_subtitle, 'harington_allowed_html' ) . '</span></div></div>';
					}
					$output .= '<div class="next-hero-progress"><span></span></div>';
                	$output .= '<div class="next-hero-title-wrapper"><div class="next-hero-title">' . wp_kses( $harington_hero_title, 'harington_allowed_html' ) . '</div></div>';
					$output .= '</div>';
					$output .= '</div>'; 
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="next-project-image-wrapper">';
					$output .= '<div class="next-project-image">';
					$output .= '<div class="next-project-image-bg" style="background-image:url(' . esc_url( $harington_hero_image['url'] ) . ')"></div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<!--/Project Navigation -->';
					
					harington_portfolio_next_project_image( esc_url( $harington_hero_image['url'] ) );

				}

			}
			else if(  $format == 'blog-post' ){

				$output = '';
				
				$harington_post_title = get_the_title( $post );
				if( empty( $harington_post_title ) ){
	
					$harington_post_title = esc_html__("Post has no title", "harington");
				}
				$output .= '<div class="post-next';
				if( empty( $post ) ){
					
					$output .= ' disabled';
				}
				$output .= '">';
				$output .= '<div class="post-next-caption">';
				$output .= wp_kses( harington_get_theme_options( 'clapat_harington_blog_next_post_caption' ), 'harington_allowed_html' );
				$output .= '</div>';
				$output .= '<div class="post-next-title">';
				if( $post ){
					
					$output .= '<a href="' . get_permalink( $post ) . '" class="ajax-link hide-ball" data-type="page-transition">';
					$output .= '<span>' . $harington_post_title . '</span>';
					$output .= '</a>';
				}
				else {
					
					$output .= '<span>' . wp_kses( harington_get_theme_options( 'clapat_harington_blog_no_posts_caption' ), 'harington_allowed_html' ) . '</span>';
				}
				$output .= '</div>';
				$output .= '</div>';

				return $output;
			}
			else {

				if( $post ){

					$output = get_permalink( $post );
				}
			}

			return $output;
	}

}
if ( ! function_exists( 'harington_next_post_link' ) ){

	function harington_next_post_link( $output, $format, $link, $post ){

			if( $format == 'harington_portfolio' ){

				$output = '';
				$next_post = $post;

				if( $post ){

					$next_post = $post;
				}
				else{ // could not find the next post so rewind to the oldest one

					$args = array(
								'posts_per_page'   => 2,
								'order'            => 'ASC',
								'post_type'        => 'harington_portfolio',
							);

					$find_query = new WP_Query( $args );
					if ( $find_query->have_posts() && ($find_query->found_posts > 1) )  {

						$find_query->the_post();

						$next_post = $find_query->post;

					} else {
						// no posts found
					}

					wp_reset_postdata();
				}

				if( $next_post ){

					$harington_hero_properties = new Harington_Hero_Properties();
					$harington_hero_properties->post_id	= $next_post->ID;
					$harington_hero_properties->getProperties( get_post_type( $next_post->ID ) );
					$harington_hero_image = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $next_post->ID, 'harington-opt-portfolio-hero-img' );
					$harington_hero_title = $harington_hero_properties->caption_title;
					$harington_hero_subtitle = esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_first_line' ) ) . ' ' . esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_second_line' ) );
					$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-bknd-color' );
					$harington_project_nav_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $next_post->ID, 'harington-opt-portfolio-navigation-cursor-color' );
					$harington_project_nav_autotrigger = harington_get_theme_options( 'clapat_harington_portfolio_nav_autotrigger' );
					$harington_nav_class = "";
					if( $harington_bknd_color == "dark-content" ){
						
						$harington_nav_class = "";
					}
					else{
						
						$harington_nav_class = "change-header";
					}
										
					$output = '<!-- Project Navigation -->';
					$output .= '<div id="project-nav" class="' . $harington_nav_class . '">';
					$output .= '<div class="next-project-wrap">';
					$output .= '<div class="next-project-caption content-full-width">';
					$output .= '<div class="next-caption-wrapper">';
					$output .= '<div class="caption-wrapper">';
					$output .= '<a class="next-ajax-link-project ';
					if( $harington_project_nav_autotrigger ) { $output .= 'auto-trigger'; } else { $output .= 'auto-trigger-disabled'; }
					$output .= '" data-type="page-transition" href="'. esc_url( get_permalink( $next_post ) ) . '" data-color="' . $harington_project_nav_color . '" data-firstline="' . esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_first_line' ) ) . '" data-secondline="' . esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_next_caption_second_line' ) ) .'"></a>';
					$output .= '<div class="next-caption">';
					if( !empty( $harington_hero_subtitle ) ){
						
						$output .= '<div class="next-hero-subtitle-wrapper"><div class="next-hero-subtitle"><span>' . wp_kses( $harington_hero_subtitle, 'harington_allowed_html' ) . '</span></div></div>';
					}
					$output .= '<div class="next-hero-progress"><span></span></div>';
                	$output .= '<div class="next-hero-title-wrapper"><div class="next-hero-title">' . wp_kses( $harington_hero_title, 'harington_allowed_html' ) . '</div></div>';
					$output .= '</div>';
					$output .= '</div>'; 
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="next-project-image-wrapper">';
					$output .= '<div class="next-project-image">';
					$output .= '<div class="next-project-image-bg" style="background-image:url(' . esc_url( $harington_hero_image['url'] ) . ')"></div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<!--/Project Navigation -->';
					
					harington_portfolio_next_project_image( esc_url( $harington_hero_image['url'] ) );

				}

			}
			else if(  $format == 'blog-post' ){

				$output = '';
				
				$harington_post_title = get_the_title( $post );
				if( empty( $harington_post_title ) ){
	
					$harington_post_title = esc_html__("Post has no title", "harington");
				}
				$output .= '<div class="post-prev';
				if( empty( $post ) ){
					
					$output .= ' disabled';
				}
				$output .= '">';
				$output .= '<div class="post-prev-caption">';
				$output .= wp_kses( harington_get_theme_options( 'clapat_harington_blog_prev_post_caption' ), 'harington_allowed_html' );
				$output .= '</div>';
				$output .= '<div class="post-next-title">';
				if( $post ){

					
					$output .= '<a href="' . get_permalink( $post ) . '" class="ajax-link hide-ball" data-type="page-transition">';
					$output .= '<span>' . get_the_title( $post ) . '</span>';
					$output .= '</a>';
					
				} else {
					
					$output .= '<span>' . wp_kses( harington_get_theme_options( 'clapat_harington_blog_no_posts_caption' ), 'harington_allowed_html' ) . '</span>';
				}
				$output .= '</div>';
				$output .= '</div>';
				
				return $output;
			}
			else {

				if( $post ){

					$output = get_permalink( $post );
				}
			}

		return $output;
	}

}
// change priority here if there are more important actions associated with the hook
add_filter('next_post_link', 'harington_next_post_link', 10, 4);
add_filter('previous_post_link', 'harington_prev_post_link', 10, 4);

// hooks to add extra classes for next & prev blog posts
if ( ! function_exists( 'harington_next_posts_link_attributes' ) ){

	function harington_next_posts_link_attributes(){

		return 'class="ajax-link" data-type="page-transition"';
	}
}
if ( ! function_exists( 'harington_prev_posts_link_attributes' ) ){

	function harington_prev_posts_link_attributes(){

		return 'class="ajax-link" data-type="page-transition"';
	}
}
// change priority here if there are more important actions associated with the hook
add_filter('next_posts_link_attributes', 'harington_next_posts_link_attributes', 10, 4);
add_filter('previous_posts_link_attributes', 'harington_prev_posts_link_attributes', 10, 4);

if ( ! function_exists( 'harington_comment_reply_link' ) ){

	function harington_comment_reply_link($link, $args, $comment, $post){

		return str_replace("class='comment-reply-link", "class='comment-reply-link reply hide-ball", $link);
	}
}
// change priority here if there are more important actions associated with the hook
add_filter('comment_reply_link', 'harington_comment_reply_link', 99, 4);

// category filter
if ( ! function_exists( 'harington_category' ) ){
	
	function harington_category( $thelist, $separator, $parents ){
		
		return str_replace('<a href="', '<a class="ajax-link link" data-type="page-transition" href="', $thelist);
	}
}
add_filter('the_category', 'harington_category', 10, 3);

// tags filter
if ( ! function_exists( 'harington_tags' ) ){
	
	function harington_tags( $tag_list, $before, $sep, $after, $id ){
		
		return str_replace('<a href="', '<a class="ajax-link link" data-type="page-transition" href="', $tag_list);
	}
}
add_filter('the_tags', 'harington_tags', 10, 5);

// search filter
if( !function_exists('harington_searchfilter') ){

	function harington_searchfilter( $query ) {

		if ( !is_admin() && $query->is_main_query() ) {

			if ($query->is_search ) {

				$post_types = get_query_var('post_type');

				if( empty( $post_types ) ){

					$query->set('post_type', array('post'));
				}
			}

		}

		return $query;

	}
	add_filter('pre_get_posts','harington_searchfilter');

}

// allowable HTML tags in theme options
if( !function_exists('harington_kses_allowed_html') ){

	function harington_kses_allowed_html($tags, $context) {
		
		switch($context) {
			case 'harington_allowed_html':
				$tags = array(
					'a' => array(
								'id' => array(),
								'href' => array(),
								'title' => array(),
								'rel' => array(),
								'target' => array(),
								'class' => array(),
								'data-type' => array(),
								'data-filter' => array()
							),
					'div' => array(
								'id' => array(),
								'class' => array()
								),
					'span' => array(
								'id' => array(),
								'class' => array(),
								'data-hover' => array()
								),
					'img' => array(
								'src' => array(),
								'alt' => array(),
								'width' => array(),
								'height' => array(),
								'class' => array()
								),
					'h1' => array(),
					'h2' => array(),
					'h3' => array(),
					'h4' => array(),
					'h5' => array(),
					'h6' => array(),
					'ul' => array(
							'id' => array(),
							'class' => array()
							),
					'li' => array(
							'class' => array()
							),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
					'b' => array(),
					'i' => array(
							'id' => array(),
							'class' => array()
							),
					'u' => array(),
					'p' => array(
							'id' => array(),
							'class' => array()
							),
					'hr' => array(),
					'figure' => array(
							'id' => array(),
							'class' => array()
							)
				);
				return $tags;
			default: 
				return $tags;
		}

	}

	add_filter( 'wp_kses_allowed_html', 'harington_kses_allowed_html', 10, 2 );

}

// custom fonts
if( !function_exists('harington_custom_fonts_filter') ){

	function harington_custom_fonts_filter( $arr_custom_fonts ) {

		if( !isset( $arr_custom_fonts ) ){
		
			$arr_custom_fonts = array();
		}
	
		if ( class_exists( 'Bsf_Custom_Fonts_Render' ) ){
			
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
							if( !empty( $variation['font_weight'] ) ){
								
								$font_label .= ', ' . $variation['font_weight'];
							}
							if( !empty( $variation['font_style'] ) ){
								
								$font_label .= ', ' . $variation['font_style'];
							}
							$arr_custom_fonts[ $id.$variation['id'] ] = $font_label;
						}
					}
					else{
						
						$arr_custom_fonts[ $id ] = $font_family;
					}
				}
			}
			else {
				
				// keep backward compatibility with earlier versions of the plugin (<2.0.0)
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
															
								$arr_custom_fonts[ $term->term_id.$font_prop_id ] = $term->name . " - " . $font_prop_value;
							}
						}
					}
				}
			}

		}

		return $arr_custom_fonts;

	}
	add_filter( 'harington_custom_fonts_customizer', 'harington_custom_fonts_filter' );

}