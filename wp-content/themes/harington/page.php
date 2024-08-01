<?php

get_header();

if ( have_posts() ){

the_post();

?>

		<!-- Main -->
		<div id="main">
		
		<?php
		
			// display hero section
			get_template_part('sections/hero_section'); 
		
		?>
			<!-- Main Content --> 
			<div id="main-content">
				<div id="main-page-content" class="content-max-width">
					
					<?php
							the_content();
							
							wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'harington' ),
												'after'  => '</div>',
										) );
					?>
												
					<?php
					// any comments?
					if ( comments_open() || get_comments_number() ){
					?>
					<div id="page-with-comments">
					<?php
						comments_template();
					?>
					</div>
					<?php
					}
					?>
					
				</div>
				<?php
		
					// display hero section
					get_template_part('sections/page_navigation_section'); 
		
				?>
			</div>
			<!--/Main Content-->
		</div>
		<!--/Main -->
<?php

}

get_footer();

?>