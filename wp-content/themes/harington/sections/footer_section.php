			<!-- Footer -->
			<footer class="hidden">
				<div id="footer-container">

				<?php if( harington_get_theme_options( 'clapat_harington_enable_back_to_top' ) ){?>
					<?php if( harington_display_back_to_top() ){ ?>
					<div id="backtotop" class="button-wrap left">
						<div class="icon-wrap parallax-wrap">
							<div class="button-icon parallax-element">
								<i class="arrow-icon-up"></i>
							</div>
						</div>
						<div class="button-text sticky left"><span data-hover="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_back_to_top_caption' ) ); ?>"><?php echo wp_kses( harington_get_theme_options( 'clapat_harington_back_to_top_caption' ), 'harington_allowed_html' ); ?></span></div>
					</div>
					<?php } ?>
				<?php } ?>

				<?php if( harington_display_copyright() ){
					if( harington_get_theme_options('clapat_harington_footer_copyright') ){ ?>
					<div class="footer-middle"><div class="copyright"><?php echo wp_kses( harington_get_theme_options('clapat_harington_footer_copyright'), 'harington_allowed_html' ); ?></div></div>
				<?php }
				}	?>

				<?php if( is_page_template('portfolio-showcase-page.php') ) {

							get_template_part('sections/showcase_navigation_section');
					} 
				?>
					
				<?php if( is_page_template('portfolio-carousel-page.php') ) {

							get_template_part('sections/carousel_navigation_section');
					} 
				?>

				<?php
					if( display_footer_social_links_section() ){

						get_template_part('sections/footer_social_links_section');
					}
				?>

				</div>
			</footer>
			<!--/Footer -->

		</div>