<?php
/*
Template name: Portfolio Carousel
*/

get_header();

if ( have_posts() ){

	the_post();

	$harington_portfolio_thumb_to_fullscreen = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-thumb-to-fullscreen' );
	if( !harington_get_theme_options('clapat_harington_enable_ajax') ){
		
		$harington_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
	}


	$harington_showcase_tax_query = null;
	$harington_showcase_category_filter	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-filter-category' );

	if( !empty( $harington_showcase_category_filter ) ){

		$harington_array_terms = explode( ",", $harington_showcase_category_filter );
		$harington_showcase_tax_query = array(
											array(
												'taxonomy' 	=> 'portfolio_category',
												'field'		=> 'slug',
												'terms'		=> $harington_array_terms,
												),
										);
	}
?>

		<!-- Main -->
		<div id="main">

			<!-- Main Content -->
			<div id="main-content">

				<!-- Showcase Carousel Holder -->
				<div id="itemsWrapperLinks">
					<div id="itemsWrapper" class="<?php echo sanitize_html_class( $harington_portfolio_thumb_to_fullscreen ); ?>">
						<div id="showcase-carousel-holder" class="<?php if( !harington_get_theme_options('clapat_harington_enable_ajax') ) { echo 'thumb-no-ajax'; } ?>">
							<div id="showcase-carousel" class="swiper-container">
								<div class="swiper-wrapper">
							
								<?php

									$harington_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
									$harington_args = array(
																'post_type' => 'harington_portfolio',
																'paged' => $harington_paged,
																'tax_query' => $harington_showcase_tax_query,
																'posts_per_page' => 1000,
																 );

									$harington_portfolio = new WP_Query( $harington_args );

									$harington_slides_count = 0;
									$harington_portfolio_items = array();
									while( $harington_portfolio->have_posts() ){

										$harington_portfolio->the_post();

										$harington_bknd_color			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-bknd-color' );
										$harington_project_nav_color 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-navigation-cursor-color' );
																			
										$harington_hero_properties = new Harington_Hero_Properties();
										$harington_hero_properties->getProperties( get_post_type( get_the_ID() ) );
										
										$harington_item_categories = '';
										$harington_item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
										if($harington_item_cats){

											foreach($harington_item_cats as $item_cat) {
												
												$harington_item_categories .= $item_cat->name . ', ';
											}

											$harington_item_categories = rtrim( $harington_item_categories, ', ');

										}

								?>

									<div class="swiper-slide trigger-item" data-color="<?php echo esc_attr( $harington_project_nav_color ); ?>" data-firstline="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_view_project_caption_first' ) ); ?>" data-secondline="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_view_project_caption_second' ) ); ?>">
										<div class="img-mask">
											<a class="slide-link" data-type="page-transition" href="<?php the_permalink(); ?>"></a>
											<div class="section-image">
												<img src="<?php echo esc_url( $harington_hero_properties->image['url'] ); ?>" class="item-image grid__item-img trigger-item-link" alt="<?php echo harington_get_image_alt( $harington_hero_properties->image['id'] ); ?>">
												<?php if( harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video' ) ){

													$harington_video_webm_url 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video-webm' );
													$harington_video_mp4_url 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-video-mp4' );
												?>
												<div class="hero-video-wrapper">
													<video loop muted class="bgvid">
													<?php if( !empty( $harington_video_mp4_url ) ) { ?>
														<source src="<?php echo esc_url( $harington_video_mp4_url ); ?>" type="video/mp4">
													<?php } ?>
													<?php if( !empty( $harington_video_webm_url ) ) { ?>
														<source src="<?php echo esc_url( $harington_video_webm_url ); ?>" type="video/webm">
													<?php } ?>
													</video>
												</div>
												<?php } ?>
											</div>
											<img class="grid__item-img grid__item-img--large" src="<?php echo esc_url( $harington_hero_properties->image['url'] ); ?>" alt="<?php echo harington_get_image_alt( $harington_hero_properties->image['id'] ); ?>" />
										</div>
										<div class="outer">
											<div class="inner">
												<div class="slide-title-wrapper">
													<div class="slide-title"><?php echo wp_kses( $harington_hero_properties->caption_title, 'harington_allowed_html' ); ?></div>
												</div>
												<div class="slide-subtitle">
													<span data-hover="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_viewcase_caption' ) ); ?>"><?php echo wp_kses( $harington_item_categories, 'harington_allowed_html' ); ?></span>
												</div>
											</div>
										</div>
									</div>
								
								<?php

										$harington_portfolio_items[] = $harington_hero_properties;

										$harington_slides_count++;

									}

									wp_reset_postdata();
									
									harington_portfolio_thumbs_list( $harington_portfolio_items );

								?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Showcase Carousel Holder -->

			</div>
			<!--/Main Content -->

		</div>
		<!--/Main -->

<?php

}

get_footer();

?>
