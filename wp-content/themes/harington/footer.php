<?php
/**
 * Created by Clapat.
 * Date: 12/12/22
 * Time: 11:14 AM
 */
?>
			<?php

			// display footer section
			get_template_part('sections/footer_section');

			?>
			
			<?php
			
				$harington_portfolio_items = harington_portfolio_thumbs_list();
				
				if ( !empty( $harington_portfolio_items ) ){ 
			?>
			<div class="thumb-wrapper">
				<div class="thumb-container">
					<?php
					foreach( $harington_portfolio_items as $harington_portfolio_item ){
						
						$harington_hero_image = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $harington_portfolio_item->post_id, 'harington-opt-portfolio-hero-img' );
					?>
					<div class="thumb-page" data-src="<?php echo esc_url( $harington_hero_image['url'] ); ?>"></div>
					<?php
					}
					?>
				</div>
			</div>
			<?php } ?>
			
			<?php if( is_page_template('portfolio-showcase-page.php') ) { ?>

			<div class="showcase-pagination-wrap">
				<div class="showcase-pagination"></div>
			</div>
			<?php
			} 
			?>

			<div id="app"></div>

			</div>
			<!--/Page Content -->
		</div>
		<!--/Cd-main-content -->
	</main>
	<!--/Main -->

	<div class="cd-cover-layer"></div>
	<div id="magic-cursor">
		<div id="ball">
			<div id="ball-drag-x"></div>
			<div id="ball-drag-y"></div>
			<div id="ball-loader"></div>
		</div>
	</div>
	<div id="clone-image">
		<div class="hero-translate"></div>
	</div>
	<div id="rotate-device"></div>

<?php wp_footer(); ?>
</body>
</html>