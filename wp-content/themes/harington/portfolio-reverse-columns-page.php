<?php
/*
Template name: Portfolio Reverse Columns
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
$harington_portfolio_left_column = array();
$harington_portfolio_center_column = array();
$harington_portfolio_right_column = array();

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

wp_reset_postdata();

// distribute the portfolio items to the columns
$harington_portfolio_items_count = count( $harington_portfolio_items );
if( $harington_portfolio_items_count < 7 ){
	
	if( $harington_portfolio_items_count == 1 ){
		
		$harington_portfolio_item = $harington_portfolio_items[0];
		
		$harington_portfolio_center_column = array_fill( 0, 3, $harington_portfolio_item );
		$harington_portfolio_left_column = array_fill( 0, 2, $harington_portfolio_item );
		$harington_portfolio_right_column = array_fill( 0, 2, $harington_portfolio_item );
	}
	else if( $harington_portfolio_items_count == 2 ){
		
		$harington_portfolio_item = $harington_portfolio_items[0];
		
		$harington_portfolio_center_column = array_fill( 0, 3, $harington_portfolio_item );
		
		$harington_portfolio_item = $harington_portfolio_items[1];
		
		$harington_portfolio_left_column = array_fill( 0, 2, $harington_portfolio_item );
		$harington_portfolio_right_column = array_fill( 0, 2, $harington_portfolio_item );
	}
	else if( $harington_portfolio_items_count == 3 ){
		
		$harington_portfolio_item = $harington_portfolio_items[0];
		
		$harington_portfolio_center_column = array_fill( 0, 3, $harington_portfolio_item );
		
		$harington_portfolio_item = $harington_portfolio_items[1];
		
		$harington_portfolio_left_column = array_fill( 0, 2, $harington_portfolio_item );
		
		$harington_portfolio_item = $harington_portfolio_items[2];
		
		$harington_portfolio_right_column = array_fill( 0, 2, $harington_portfolio_item );
		
	}
	else if( $harington_portfolio_items_count == 4 ){
		
		$harington_portfolio_center_column = array_slice( $harington_portfolio_items, 0, 3 );
		
		$harington_portfolio_item = $harington_portfolio_items[3];
		
		$harington_portfolio_left_column = array_fill( 0, 2, $harington_portfolio_item );
		
		$harington_portfolio_item = $harington_portfolio_items[3];
		
		$harington_portfolio_right_column = array_fill( 0, 2, $harington_portfolio_item );
	}
	else if( $harington_portfolio_items_count == 5 ){
		
		$harington_portfolio_center_column = array_slice( $harington_portfolio_items, 0, 3 );
		
		$harington_portfolio_item = $harington_portfolio_items[3];
		
		$harington_portfolio_left_column = array_fill( 0, 2, $harington_portfolio_item );
		
		$harington_portfolio_item = $harington_portfolio_items[4];
		
		$harington_portfolio_right_column = array_fill( 0, 2, $harington_portfolio_item );
	}
	else if( $harington_portfolio_items_count == 6 ){
		
		$harington_portfolio_center_column = array_slice( $harington_portfolio_items, 0, 4 );
		
		$harington_portfolio_item = $harington_portfolio_items[4];
		
		$harington_portfolio_left_column = array_fill( 0, 2, $harington_portfolio_item );
		
		$harington_portfolio_item = $harington_portfolio_items[5];
		
		$harington_portfolio_right_column = array_fill( 0, 2, $harington_portfolio_item );
	}
}
else {

	$harington_portfolio_items_diff = $harington_portfolio_items_count % 3;
	$harington_portfolio_items_spread = intdiv($harington_portfolio_items_count, 3);
	if( $harington_portfolio_items_diff == 0 ){
	
		$harington_portfolio_items_diff = 3;
		$harington_portfolio_items_spread -= 1;
	}
	
	$harington_portfolio_offset = 0;
	$harington_portfolio_center_column = array_slice( $harington_portfolio_items, $harington_portfolio_offset, $harington_portfolio_items_spread + $harington_portfolio_items_diff );
	$harington_portfolio_offset += $harington_portfolio_items_spread + $harington_portfolio_items_diff;
	$harington_portfolio_left_column = array_slice( $harington_portfolio_items, $harington_portfolio_offset, $harington_portfolio_items_spread );
	$harington_portfolio_offset += $harington_portfolio_items_spread;
	$harington_portfolio_right_column = array_slice( $harington_portfolio_items, $harington_portfolio_offset, $harington_portfolio_items_spread );
}

// at the end concatenate the items to set the reverse columns order in the global portfolio list
$harington_portfolio_items = array_merge( $harington_portfolio_left_column, $harington_portfolio_center_column, $harington_portfolio_right_column );
harington_portfolio_thumbs_list( $harington_portfolio_items );

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
							
								<div class="showcase-reverse-list-holder content-full-width">
									<div class="showcase-reverse-list">
										
										<?php
										$harington_portfolio_items = harington_portfolio_thumbs_list();
											
										if( !empty( $harington_portfolio_items ) ){
											
											$harington_current_item_count = 1;
										?>
										<!-- Column Reverse Left -->
										<div class="col-reverse-left">
										<?php
												
											foreach( $harington_portfolio_left_column as $harington_portfolio_item ){
													
												set_query_var('harington_query_var_item_count', $harington_current_item_count);
													
												get_template_part('sections/portfolio_reverse_columns_section_item');
													
												$harington_current_item_count++;
											}
										
										?>
										</div>
										<!--/Column Reverse Left -->
										
										<!-- Column Reverse Center -->
										<div class="col-reverse-center">
										<?php
												
											foreach( $harington_portfolio_center_column as $harington_portfolio_item ){
													
												set_query_var('harington_query_var_item_count', $harington_current_item_count);
													
												get_template_part('sections/portfolio_reverse_columns_section_item');
													
												$harington_current_item_count++;
											}
										
										?>
										</div>
										<!--/Column Reverse Center -->
										
										<!-- Column Reverse Right -->
										<div class="col-reverse-right">
										<?php
												
											foreach( $harington_portfolio_right_column as $harington_portfolio_item ){
													
												set_query_var('harington_query_var_item_count', $harington_current_item_count);
													
												get_template_part('sections/portfolio_reverse_columns_section_item');
													
												$harington_current_item_count++;
											}
										
										?>
										</div>
										<!--/Column Reverse Right -->
										<?php
										} // if there are portfolio items
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
