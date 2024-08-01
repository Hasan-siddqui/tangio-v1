<?php
/*
Template name: Portfolio Archive List
*/
get_header();

if ( have_posts() ){

the_post();

$harington_portfolio_thumb_to_fullscreen	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-thumb-to-fullscreen' );
if( !harington_get_theme_options('clapat_harington_enable_ajax') ){
	
	$harington_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
}
$harington_portfolio_thumb_to_fullscreen_webgl_type = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-thumb-to-fullscreen-webgl-type' );

$harington_portfolio_tax_query = null;
$harington_portfolio_category_filter = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-filter-category' );

$harington_array_terms = null;
if( !empty( $harington_portfolio_category_filter ) ){

	$harington_array_terms = explode( ",", $harington_portfolio_category_filter );
	$harington_portfolio_tax_query = array(
										array(
											'taxonomy' 	=> 'portfolio_category',
											'field'		=> 'slug',
											'terms'		=> $harington_array_terms,
											),
									);
}

// Select all portfolio items
$harington_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$harington_args = array(
					'post_type' => 'harington_portfolio',
					'paged' => $harington_paged,
					'tax_query' => $harington_portfolio_tax_query,
					'posts_per_page' => 1000,
					 );

$harington_portfolio = new WP_Query( $harington_args );

$harington_portfolio_items = array();
$harington_archive_by_year = array();

// collect the posts first
$harington_current_item_count = 1;
while( $harington_portfolio->have_posts() ){

	$harington_portfolio->the_post();

	$harington_hero_properties = new Harington_Hero_Properties();
	$harington_hero_properties->getProperties( get_post_type( get_the_ID() ) );
	$harington_hero_properties->item_no = $harington_current_item_count;
	
	$harington_project_year = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-project-year' );
	if( !array_key_exists( $harington_project_year, $harington_archive_by_year ) ) {
		
		$harington_archive_by_year[$harington_project_year] = array();
	}
	
	$harington_archive_by_year[$harington_project_year][] = $harington_hero_properties;

	$harington_current_item_count++;

}

// sort the archive by year
krsort( $harington_archive_by_year );

wp_reset_postdata();

?>

			<!-- Main -->
			<div id="main">
			
				<?php
		
				// display hero section
				get_template_part('sections/hero_section'); 
		
				?>
				
				<!-- Main Content -->
				<div id="main-content">
					<!-- Main Page Content -->
					<div id="main-page-content">
						
						<!-- Portfolio Wrap -->
						<div id="itemsWrapperLinks">
							<!-- Portfolio Columns -->
							<div id="itemsWrapper" class="<?php echo sanitize_html_class( $harington_portfolio_thumb_to_fullscreen ); ?> <?php echo sanitize_html_class( $harington_portfolio_thumb_to_fullscreen_webgl_type ); ?>">
							
								<!-- Showcase List Holder -->
								<div class="showcase-list-holder">
									<!-- Showcase List --> 
									<div class="showcase-list">

										<?php
											
											if( !empty( $harington_archive_by_year ) ){
												
												foreach( $harington_archive_by_year as $archive_year => $yearly_archive ){
										?>
										<div class="slide-list-year">                                            
											<div class="sl-year fadeout-element"><span><?php echo wp_kses( $archive_year, 'harington_allowed_html' ); ?></span></div>
													<?php
													foreach( $yearly_archive as $harington_portfolio_item ){
														
														$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-bknd-color' );
														$harington_project_nav_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-navigation-cursor-color' );
														
														$harington_item_categories = '';
														$harington_item_cats = get_the_terms( $harington_portfolio_item->post_id, 'portfolio_category' );
														if($harington_item_cats){

															foreach($harington_item_cats as $item_cat) {
																
																$harington_item_categories .= $item_cat->name . ', ';
															}

															$harington_item_categories = rtrim( $harington_item_categories, ', ');

														}
													?>
													<div class="slide-list trigger-item" data-color="<?php echo esc_attr( $harington_project_nav_color ); ?>">
														<div class="hover-reveal">
															<div class="hover-reveal__inner">
																<div class="hover-reveal__img">
																	<img src="<?php echo esc_url( $harington_portfolio_item->image['url'] ); ?>" class="item-image grid__item-img" alt="<?php echo harington_get_image_alt( $harington_portfolio_item->image['id'] ); ?>">                                
																	<?php if( harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-video' ) ){

																		$harington_video_webm_url 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-video-webm' );
																		$harington_video_mp4_url 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-video-mp4' );
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
																	<img class="grid__item-img grid__item-img--large" src="<?php echo esc_url( $harington_portfolio_item->image['url'] ); ?>" alt="<?php echo harington_get_image_alt( $harington_portfolio_item->image['id'] ); ?>" />
																</div>
															</div>
														</div>

														<a data-type="page-transition" href="<?php the_permalink( $harington_portfolio_item->post_id ); ?>"></a>
														<div class="sl-title trigger-item-link"><?php echo wp_kses( $harington_portfolio_item->caption_title, 'harington_allowed_html' ); ?></div>
														<div class="sl-subtitle"><span><?php echo wp_kses( $harington_item_categories, 'harington_allowed_html' ); ?></span></div>                                                    
													</div>
													<?php
													
														$harington_portfolio_items[] = $harington_portfolio_item;

													}
										?>
										</div>
										<?php
												}
												
												harington_portfolio_thumbs_list( $harington_portfolio_items );
											}
										
										?>
										
									</div>
									<!-- /Showcase List -->
								</div>
								<!-- /Showcase List Holder-->
								
							</div>
						</div>
						
					</div>
					<!-- /Main Page Content -->
					<?php
		
						// display page navigation section
						get_template_part('sections/page_navigation_section'); 
		
					?>
				</div>
				<!-- /Main Content -->
			</div>
			<!--/Main -->
<?php

}

get_footer();

?>
