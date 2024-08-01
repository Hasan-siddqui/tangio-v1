<?php
/*
Template name: Blog Template
*/
get_header();

while ( have_posts() ){

the_post();

$harington_navigation_type = harington_get_theme_options( 'clapat_harington_blog_navigation_type' );

?>
			
	<!-- Main -->
	<div id="main">
	
	<?php 
		
		// display hero section, if any
		get_template_part('sections/hero_section'); 
		
	?>
		<!-- Main Content -->
		<div id="main-content">
			<!-- Blog-->
			<div id="blog-page-content">
				<!-- Blog-Content-->
				<div id="blog-effects" class="content-full-width" data-fx="1">
				<?php 
						
					$harington_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					
					$harington_args = array(
						'post_type' => 'post',
						'paged' => $harington_paged
					);
					$harington_posts_query = new WP_Query( $harington_args );

					// the loop
					while( $harington_posts_query->have_posts() ){

						$harington_posts_query->the_post();

						get_template_part( 'sections/blog_post_minimal_section' );
												
					}
							
				?>
				</div>
				<!-- /Blog-Content -->
				
			</div>
			<!-- /Blog-->
			
			<?php
						
				harington_pagination( $harington_posts_query, $harington_navigation_type );

				wp_reset_postdata();
			?>
		</div>
		<!--/Main Content-->
	
	<!-- /Main -->
	</div>
	
<?php

}

get_footer();

?>
