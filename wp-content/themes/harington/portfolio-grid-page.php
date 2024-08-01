<?php
/*
Template name: Portfolio Grid
*/
get_header();

if ( have_posts() ){

the_post();

$harington_portfolio_tax_query = null;
$harington_portfolio_category_filter	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-filter-category' );

$harington_portfolio_grid_width		= "content-full-width";
$harington_portfolio_grid_layout	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-grid-layout' );

$harington_portfolio_thumb_to_fullscreen	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-thumb-to-fullscreen' );
if( !harington_get_theme_options('clapat_harington_enable_ajax') ){
	
	$harington_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
}
$harington_portfolio_thumb_to_fullscreen_webgl_type = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-thumb-to-fullscreen-webgl-type' );

$harington_content_position	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-grid-content-position' );

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
					<div id="main-page-content">
						
						<!-- Portfolio Wrap -->
						<div id="itemsWrapperLinks">
							<!-- Portfolio Columns -->
							<div id="itemsWrapper" class="<?php echo sanitize_html_class( $harington_portfolio_thumb_to_fullscreen ); ?> <?php echo sanitize_html_class( $harington_portfolio_thumb_to_fullscreen_webgl_type ); ?>">
								<?php 
									if( $harington_content_position == "before" ){
										the_content();
									} 
								?>
								<div class="portfolio-wrap <?php echo sanitize_html_class( $harington_portfolio_grid_layout ); ?> <?php echo sanitize_html_class( $harington_portfolio_grid_width ); ?> fade-scaleout-effect">
									<div class="portfolio">
									<?php
										
										$harington_portfolio_items = harington_portfolio_thumbs_list();
										
										if( !empty( $harington_portfolio_items ) ){
											
											$harington_current_item_count = 1;
											foreach( $harington_portfolio_items as $harington_portfolio_item ){
												
												set_query_var('harington_query_var_item_count', $harington_current_item_count);
												
												get_template_part('sections/portfolio_section_item');
												
												$harington_current_item_count++;
											}
										}
									
									?>
									</div>
								</div>
								<?php 
									if( $harington_content_position == "after" ){
										the_content();
									} 
								?>
							</div>
							<!--/Portfolio Columns -->
						</div>
						<!--/Portfolio Wrap -->
						
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
