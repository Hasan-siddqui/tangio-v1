<?php

$harington_current_item_count = get_query_var('harington_query_var_item_count');
$harington_portfolio_items = harington_portfolio_thumbs_list();

// validate the current portfolio index
if( array_key_exists( $harington_current_item_count-1, $harington_portfolio_items ) ) {
	
	$harington_portfolio_item = $harington_portfolio_items[$harington_current_item_count-1];
	
	$harington_hero_properties = new Harington_Hero_Properties();
	$harington_hero_properties->post_id = $harington_portfolio_item->post_id;
	$harington_hero_properties->getProperties( 'harington_portfolio' );
	
	$harington_hero_image 				= $harington_hero_properties->image;
	$harington_background_type 			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-bknd-color' );
	$harington_background_color 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-bknd-color-code' );
	$harington_background_navigation	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-navigation-cursor-color' );
	$harington_caption_title			= $harington_hero_properties->caption_title;
	$harington_caption_subtitle			= $harington_hero_properties->caption_subtitle;
	$harington_page_caption_first_line	= harington_get_theme_options( 'clapat_harington_view_project_caption_first' );
	$harington_page_caption_second_line	= harington_get_theme_options( 'clapat_harington_view_project_caption_second' );
	$harington_thumbnail_type 			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-thumb-size' );

	$harington_item_classes = $harington_thumbnail_type . ' ';
	$harington_item_categories = '';
	$harington_item_cats = get_the_terms( $harington_portfolio_item->post_id, 'portfolio_category' );
	if($harington_item_cats){

		foreach($harington_item_cats as $item_cat) {
			
			$harington_item_classes .= $item_cat->slug . ' ';
			$harington_item_categories .= $item_cat->name . ', ';
		}

		$harington_item_categories = rtrim( $harington_item_categories, ', ');

	}
			
	$item_url = get_the_permalink( $harington_portfolio_item->post_id );
	
?>
						<div class="sr-slide trigger-item <?php echo esc_attr( $harington_item_classes ); ?>" data-color="<?php echo esc_attr( $harington_background_navigation ); ?>">
							<div class="item-parallax">
								<div class="item-appear">
									<div class="item-content">
										<a class="item-wrap ajax-link-project" data-type="page-transition" href="<?php echo esc_url( $item_url ); ?>"></a>
										<div class="item-wrap-image">
											<img src="<?php echo esc_url( $harington_hero_image['url'] ); ?>" class="item-image grid__item-img trigger-item-link" alt="<?php echo esc_attr( harington_get_image_alt(  $harington_hero_image['id'] ) ); ?>">
											<?php if( $harington_hero_properties->video ){ ?>
											<div class="hero-video-wrapper">
												<video loop muted class="bgvid">
												<?php if( !empty( $harington_hero_properties->video_mp4 ) ){ ?>
													<source src="<?php echo esc_url( $harington_hero_properties->video_mp4 ); ?>" type="video/mp4">
												<?php } ?>
												<?php if( !empty( $harington_hero_properties->video_webm ) ){ ?>
													<source src="<?php echo esc_url( $harington_hero_properties->video_webm ); ?>" type="video/webm">
												<?php } ?>
												</video>
											</div>
											<?php } ?>
										</div>
										<img class="grid__item-img grid__item-img--large" src="<?php echo esc_url( $harington_hero_image['url'] ); ?>" alt="<?php echo esc_attr( harington_get_image_alt(  $harington_hero_image['id'] ) ); ?>" />
									</div>
								</div>
								<div class="item-caption-wrapper">
									<div class="item-caption">
										<div class="item-title"><?php echo wp_kses( $harington_caption_title, 'harington_allowed_html' ); ?></div>
										<div class="item-cat">
											<span data-hover="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_viewcase_caption' ) ); ?>"><?php echo wp_kses( $harington_item_categories, 'harington_allowed_html' ); ?></span>
										</div>	
									</div>
								</div>
							</div>
						</div>
<?php

}
?>
