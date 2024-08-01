						<div class="button-wrap left disable-drag swiper-prev">
							<div class="icon-wrap parallax-wrap">
								<div class="button-icon parallax-element">
									<i class="arrow-icon-down left"></i>
								</div>
							</div>
							<div class="button-text sticky left"><span data-hover="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_showcase_prev_slide_caption' ) ); ?>"><?php echo wp_kses( harington_get_theme_options( 'clapat_harington_showcase_prev_slide_caption' ), 'harington_allowed_html' ); ?></span></div> 
						</div>

						<div class="swiper-pagination"></div>

						<div class="button-wrap right disable-drag swiper-next">
							<div class="icon-wrap parallax-wrap">
								<div class="button-icon parallax-element">
									<i class="arrow-icon-up right"></i>
								</div>
							</div>
							<div class="button-text sticky right"><span data-hover="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_showcase_next_slide_caption' ) ); ?>"><?php echo wp_kses( harington_get_theme_options( 'clapat_harington_showcase_next_slide_caption' ), 'harington_allowed_html' ); ?></span></div>
						</div>