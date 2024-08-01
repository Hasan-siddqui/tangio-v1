<?php

get_header();

if ( have_posts() ){

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
							<h1 class="hero-title"><span><?php echo wp_kses( harington_get_theme_options('clapat_harington_blog_default_title'), 'harington_allowed_html' ); ?></span></h1> 
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
					while( have_posts() ){

						the_post();

						get_template_part( 'sections/blog_post_minimal_section' );
											
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

}

get_footer();

?>