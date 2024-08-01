 <?php

	$harington_next_page_nav_id			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-navigation-next-page' );
	$harington_page_nav_enable			= !empty( $harington_next_page_nav_id );
	$harington_page_caption_first_line	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-page-navigation-caption-first-line' );
	$harington_page_caption_second_line	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-page-navigation-caption-second-line' );
	$harington_next_url					= get_permalink( $harington_next_page_nav_id );
	
	$harington_hero_properties 			= new Harington_Hero_Properties();
	$harington_hero_properties->post_id	= $harington_next_page_nav_id;
	$harington_hero_properties->getProperties( get_post_type( $harington_next_page_nav_id ) );
	$harington_next_hero_title			= $harington_hero_properties->caption_title;
	$harington_next_hero_subtitle			= $harington_hero_properties->caption_subtitle;
	if( !$harington_hero_properties->enabled ){
		
		$harington_next_hero_title 		= '<span>' . get_the_title( $harington_next_page_nav_id ) . '</span>';
		$harington_next_hero_subtitle		= "";
	}
	$harington_url_class = "next-ajax-link-page";
	if( !$harington_hero_properties->enabled && !harington_get_theme_options( 'clapat_harington_enable_page_title_as_hero' ) ){
		
		// This is a page without hero section so a seamless AJAX transition is not possible
		$harington_url_class = "ajax-link";
	}
	
	// Get the next page title & subtitle captions; if they are empty use the hero section of the next page
	$harington_page_caption_title			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-navigation-caption-title' );
	if( empty( $harington_page_caption_title ) ){
		
		$harington_page_caption_title = $harington_next_hero_title;
	}
	else {
		
		$title_row	= $harington_page_caption_title;
		$title_list	= preg_split('/\r\n|\r|\n/', $title_row);
		$harington_page_caption_title	= "";
		foreach( $title_list as $title_bit ){
					
			$harington_page_caption_title .= '<span>' . $title_bit . '</span>';
		}
	}
	$harington_page_caption_title_marquee	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-navigation-caption-title-marquee' );
	$harington_page_caption_subtitle		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-navigation-caption-subtitle' );
	if( empty( $harington_page_caption_subtitle ) ){
		
		$harington_page_caption_subtitle = $harington_next_hero_subtitle;
	}
	else {
		
		$title_row	= $harington_page_caption_subtitle;
		$title_list	= preg_split('/\r\n|\r|\n/', $title_row);
		$harington_page_caption_subtitle	= "";
		foreach( $title_list as $title_bit ){
					
			$harington_page_caption_subtitle .= '<span>' . $title_bit . '</span>';
		}
	}

	if( $harington_page_nav_enable ){
?>
				<!-- Page Navigation --> 
				<div id="page-nav">
					<div class="page-nav-wrap">
						<div class="page-nav-caption <?php echo esc_attr( $harington_hero_properties->alignment ); ?> <?php if( $harington_page_caption_title_marquee ){ echo 'marquee-title'; } ?> content-full-width">
							<div class="inner">
								<a class="page-title <?php echo esc_attr( $harington_url_class ); ?>" href="<?php echo esc_url( $harington_next_url ); ?>" data-type="page-transition" data-firstline="<?php echo esc_attr( $harington_page_caption_first_line ); ?>" data-secondline="<?php echo esc_attr( $harington_page_caption_second_line ); ?>">
									<div class="next-hero-title-wrapper">
										<div class="next-hero-title"><?php echo wp_kses( $harington_page_caption_title, 'harington_allowed_html' ); ?></div>
									</div>
								</a>
								<?php if( !empty( $harington_page_caption_subtitle ) ){ ?>
								<div class="next-hero-subtitle-wrapper">
									<div class="next-hero-subtitle"><?php echo wp_kses( $harington_page_caption_subtitle, 'harington_allowed_html' ); ?></div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<!--/Page Navigation -->
<?php } ?>
