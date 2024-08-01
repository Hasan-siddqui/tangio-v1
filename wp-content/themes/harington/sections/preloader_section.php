	<?php if( harington_get_theme_options('clapat_harington_enable_preloader') ){ ?>
		<!-- Preloader -->
		<div class="preloader-wrap" data-firstline="<?php echo esc_attr( harington_get_theme_options('clapat_harington_preloader_hover_first_line') ); ?>" data-secondline="<?php echo esc_attr( harington_get_theme_options('clapat_harington_preloader_hover_second_line') ); ?>">
						
			<div class="outer">
				<div class="inner"> 
				
					<div class="trackbar">
						<?php 
							$harington_preloader_intro_words = explode( ",", harington_get_theme_options('clapat_harington_preloader_intro') ); 
							if( !empty( $harington_preloader_intro_words ) ){
						?>
						<ul class="preloader-intro">
							<?php
							foreach( $harington_preloader_intro_words as $harington_preloader_word ){
							?>
							<li class="preloader-list"><?php echo wp_kses( $harington_preloader_word, 'harington_allowed_html'); ?></li>
							<?php
							}
							?>
						</ul>
						<?php
							}
						?>
						
						<div class="loadbar"></div>
					</div>

					<div class="percentage-wrapper"><div class="percentage" id="precent"></div></div>
					<div class="percentage-intro"><?php echo wp_kses( harington_get_theme_options('clapat_harington_preloader_text'), 'harington_allowed_html' ); ?></div>
					
				</div>
			</div>
			
		</div>
		<!--/Preloader -->
	<?php } ?>