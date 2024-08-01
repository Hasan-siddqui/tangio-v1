<?php
/*
Template name: Portfolio Showcase
*/

get_header();

if ( have_posts() ){

	the_post();

	$harington_showcase_transition_pattern_image_id = harington_get_theme_options('clapat_harington_showcase_transition_pattern_image');
	$harington_showcase_transition_pattern_image = "";

	$harington_showcase_transition_pattern_image_custom = harington_get_theme_options('clapat_harington_showcase_transition_pattern_custom_image');
	if( $harington_showcase_transition_pattern_image_custom ){

		$harington_showcase_transition_pattern_image = $harington_showcase_transition_pattern_image_custom;
	}
	else{

		global $harington_slide_transitions;

		$harington_showcase_transition_pattern_image = $harington_slide_transitions[ $harington_showcase_transition_pattern_image_id ];
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

				<!-- Showcase Slider Holder -->
				<div id="showcase-slider-holder" class="<?php if( !harington_get_theme_options('clapat_harington_enable_ajax') ) { echo 'thumb-no-ajax'; } ?>" data-pattern-img="<?php echo esc_url( $harington_showcase_transition_pattern_image ); ?>">

					<div id="showcase-slider" class="swiper-container">
						<div id="trigger-slides" class="swiper-wrapper">

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
									$harington_project_year 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-project-year' );
									$harington_change_header_color	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-invert-hero-header' );
									$harington_change_header_class	= false;
									if( (($harington_change_header_color == "change-header-color") && ($harington_bknd_color == "light-content")) ||
									(($harington_change_header_color != "change-header-color") && ($harington_bknd_color == "dark-content")) ){
										
										$harington_change_header_class = true;
									}

									$harington_item_categories = '';
									$harington_item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
									if($harington_item_cats){

										foreach($harington_item_cats as $item_cat) {
																
											$harington_item_categories .= $item_cat->name . ', ';
										}

										$harington_item_categories = rtrim( $harington_item_categories, ', ');

									}
														
									$harington_hero_properties = new Harington_Hero_Properties();
									$harington_hero_properties->getProperties( get_post_type( get_the_ID() ) );

							?>

							<div class="swiper-slide<?php if( $harington_change_header_class ) { echo " change-header"; } ?>">
								<div class="slide-wrap<?php if( $harington_slides_count == 0 ){ echo " active"; } ?>" data-slide="<?php echo esc_attr( $harington_slides_count ); ?>"></div>
								<div class="outer content-full-width">
									<div class="inner">
										<div class="slide-title-wrapper">
											<div class="slide-title" data-color="<?php echo esc_attr( $harington_project_nav_color ); ?>" data-firstline="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_view_project_caption_first' ) ); ?>" data-secondline="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_view_project_caption_second' ) ); ?>"><?php echo wp_kses( $harington_hero_properties->caption_title, 'harington_allowed_html' ); ?></div>
											<a href="<?php the_permalink(); ?>" class="slide-link" data-type="page-transition"></a>
										</div>
										<div class="slide-subtitle">
											<?php if( !empty( $harington_project_year ) ){ ?>
											<span><?php echo wp_kses( $harington_project_year, 'harington_allowed_html' ); ?></span>
											<?php } ?>
											<span><?php echo wp_kses( $harington_item_categories, 'harington_allowed_html' ); ?></span>
										</div>
									</div>
								</div>
							</div>
							
							<?php

									$harington_portfolio_items[] = $harington_hero_properties;

									$harington_slides_count++;

								}

								wp_reset_postdata();

							?>
						</div>
					</div>

				</div>
				<!-- Showcase Slider Holder -->
				
				<!-- Canvas slider -->
				<div id="canvas-slider" class="canvas-slider">
					<?php
					$harington_slides_count = 0;
					foreach( $harington_portfolio_items as $harington_portfolio_item ){

					?>
					<div class="slider-img" data-slide="<?php echo esc_attr( $harington_slides_count ); ?>">
						<img class="slide-img" src="<?php echo esc_url( $harington_portfolio_item->image['url'] ); ?>" alt="<?php echo harington_get_image_alt( $harington_portfolio_item->image['id'] ); ?>" />
					</div>
					<?php

						$harington_slides_count++;
					}
					?>
				</div>
				<!--/Canvas slider -->

			</div>
			<!--/Main Content -->

		</div>
		<!--/Main -->

<?php

}

get_footer();

?>
