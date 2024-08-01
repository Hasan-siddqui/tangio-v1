<?php
/**
 * The template for displaying Category Search Results pages
 */

get_header();

$harington_navigation_type = harington_get_theme_options( 'clapat_harington_blog_navigation_type' );

?>
		
	<!-- Main -->
	<div id="main">
		
		<!-- Hero Section -->
		<div id="hero">
			<div id="hero-styles">
				<div id="hero-caption" class="content-full-width parallax-scroll-caption inline-title">
					<div class="inner">
						<div class="hero-title-wrapper">
							<h1 class="hero-title"><span><?php single_cat_title('', true); ?></span></h1>
						</div>
						<div class="hero-subtitle-wrapper">
							<h5 class="hero-subtitle"><span><?php echo esc_html__( 'Category Results', 'harington'); ?></span></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
		
		<!-- Main Content -->
		<div id="main-content">
			<!-- Blog-->
			<div id="blog-page-content">
				<!-- Blog-Content-->
				<div id="blog-effects" class="content-full-width" data-fx="1">
				<?php 
						
					// the loop
					if( have_posts() ){
					
						while( have_posts() ){

							the_post();

							get_template_part( 'sections/blog_post_minimal_section' );
							
						}
					}
					else {
						
						echo '<h4 class="search_results">' . esc_html__('No posts found in this category', 'harington') . '</h4>';
					}
				?>
			
				<!-- /Blog-Content-->
				</div>
				
			</div>
			<!-- /Blog-->
			<?php
					
				harington_pagination( null, $harington_navigation_type );

			?>
			
		</div>
		<!--/Main Content-->
	</div>
	<!-- /Main -->
<?php

get_footer();

?>