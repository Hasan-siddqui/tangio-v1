<?php
/*
Template name: Portfolio Parallax Panels
*/
get_header();

if ( have_posts() ){

the_post();

$harington_portfolio_tax_query = null;
$harington_portfolio_category_filter = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-filter-category' );

$harington_parallax_value = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-panels-parallax' );

$harington_page_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-bknd-color' );

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

// collect the posts first
$harington_current_item_count = 1;
while( $harington_portfolio->have_posts() ){

	$harington_portfolio->the_post();

	$harington_hero_properties = new Harington_Hero_Properties();
	$harington_hero_properties->getProperties( get_post_type( get_the_ID() ) );
	$harington_hero_properties->item_no = $harington_current_item_count;
	$harington_portfolio_items[] = $harington_hero_properties;

	$harington_current_item_count++;

}

harington_portfolio_thumbs_list( $harington_portfolio_items );

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
					<div id="main-page-content" class="content-max-width">
						
						<!-- Snap Slider Wrap -->
						<div class="snap-slider-holder">
							<!-- Snap Slider Container -->
							<div class="snap-slider-container" data-parallax="<?php echo esc_attr( $harington_parallax_value ); ?>">
						
								<div class="snap-slider-images">
								<?php
									
									$harington_portfolio_items = harington_portfolio_thumbs_list();
									
									if( !empty( $harington_portfolio_items ) ){
										
										$harington_current_item_count = 1;
										foreach( $harington_portfolio_items as $harington_portfolio_item ){
											
											$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-bknd-color' );
											$harington_change_header_color	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-invert-hero-header' );
											$harington_change_header_class	= false;
											if( ($harington_change_header_color == "change-header-color") && ($harington_bknd_color == "dark-content") )
											{
												if($harington_page_bknd_color == "dark-content"){
													
													$harington_change_header_class = true;
												}
											}
											else if( ($harington_change_header_color != "change-header-color") && ($harington_bknd_color == "dark-content") )
											{
												if($harington_page_bknd_color == "light-content"){
													
													$harington_change_header_class = true;
												}
											}
											else if( ($harington_change_header_color == "change-header-color") && ($harington_bknd_color == "light-content") )
											{
												if($harington_page_bknd_color == "light-content"){
													
													$harington_change_header_class = true;
												}
											}
											else if( ($harington_change_header_color != "change-header-color") && ($harington_bknd_color == "light-content") )
											{
												if($harington_page_bknd_color == "dark-content"){
													
													$harington_change_header_class = true;
												}
											}
											
								?>
									<div class="snap-slide<?php if( $harington_change_header_class ) { echo " change-header-color"; } ?>">
										<div class="img-mask">
											<div class="section-image">
												<img src="<?php echo esc_url( $harington_portfolio_item->image['url'] ); ?>" alt="<?php echo harington_get_image_alt( $harington_portfolio_item->image['id'] ); ?>">
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
											</div>
										</div>
									</div>
								<?php		
											$harington_current_item_count++;
										}
									}
								
								?>
								</div>
								
								<div class="snap-slider-captions">
								<?php
									
									$harington_portfolio_items = harington_portfolio_thumbs_list();
									
									if( !empty( $harington_portfolio_items ) ){
										
										$harington_current_item_count = 1;
										foreach( $harington_portfolio_items as $harington_portfolio_item ){
											
											$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-bknd-color' );
											$harington_project_nav_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-navigation-cursor-color' );
											$harington_project_year = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-project-year' );
											$harington_change_header_color	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-invert-hero-header' );
											$harington_change_header_class	= false;
											if( ($harington_change_header_color == "change-header-color") && ($harington_bknd_color == "dark-content") )
											{
												if($harington_page_bknd_color == "dark-content"){
													
													$harington_change_header_class = true;
												}
											}
											else if( ($harington_change_header_color != "change-header-color") && ($harington_bknd_color == "dark-content") )
											{
												if($harington_page_bknd_color == "light-content"){
													
													$harington_change_header_class = true;
												}
											}
											else if( ($harington_change_header_color == "change-header-color") && ($harington_bknd_color == "light-content") )
											{
												if($harington_page_bknd_color == "light-content"){
													
													$harington_change_header_class = true;
												}
											}
											else if( ($harington_change_header_color != "change-header-color") && ($harington_bknd_color == "light-content") )
											{
												if($harington_page_bknd_color == "dark-content"){
													
													$harington_change_header_class = true;
												}
											}
										
											$harington_item_categories = '';
											$harington_item_cats = get_the_terms( $harington_portfolio_item->post_id, 'portfolio_category' );
											if($harington_item_cats){

												foreach($harington_item_cats as $item_cat) {
													
													$harington_item_categories .= $item_cat->name . ', ';
												}

												$harington_item_categories = rtrim( $harington_item_categories, ', ');

											}
								?>
									<div class="snap-slide-caption<?php if( $harington_change_header_class ) { echo " change-header"; } ?>" data-color="<?php echo esc_attr( $harington_project_nav_color ); ?>">
										<div class="outer">
											<div class="inner">
												<div class="slide-title-wrapper">
													<div class="slide-title trigger-item-link"><?php echo wp_kses( $harington_portfolio_item->caption_title, 'harington_allowed_html' ); ?></div>
													<a class="slide-link" data-type="page-transition" href="<?php the_permalink( $harington_portfolio_item->post_id ); ?>"></a>
												</div>
												<div class="slide-subtitle"><span><?php echo wp_kses( $harington_project_year, 'harington_allowed_html' ); ?></span> <span><?php echo wp_kses( $harington_item_categories, 'harington_allowed_html' ); ?></span></div>
											</div>
										</div>
									</div>
								<?php		
											$harington_current_item_count++;
										}
									}
								
								?>
								</div>
							
							</div>
							<!--/Snap Slider Container -->
						</div>
						<!--/Snap Slider Wrap -->
						
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
