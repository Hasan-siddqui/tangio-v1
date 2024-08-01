				<!-- Blog Page Nav-->
				<div id="blog-page-nav" class="content-full-width">
					<div id="blog-page-nav-wrap">

						<div class="blog-navigation has-animation">
							<?php
							$big = 999999999; // need an unlikely integer

							$harington_current_query = harington_get_current_query();
							if ( get_query_var( 'paged' ) ) { $harington_current_page = get_query_var( 'paged' ); }
							elseif ( get_query_var( 'page' ) ) { $harington_current_page = get_query_var( 'page' ); }
							else { $harington_current_page = 1; }
							
							$harington_paginate_links = paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'type' => 'list',
								'format' => '?paged=%#%',
								'current' => $harington_current_page,
								'total' => $harington_current_query->max_num_pages,
								'prev_text' => wp_kses_post( harington_get_theme_options('clapat_harington_blog_prev_posts_caption') ),
								'next_text' => wp_kses_post( harington_get_theme_options('clapat_harington_blog_next_posts_caption') )
							) );
							
							if( harington_get_theme_options( 'clapat_harington_enable_ajax' ) ){
								
								$harington_paginate_links = str_replace( 'a class="prev page-numbers"', 'a class="prev page-numbers ajax-link" data-type="page-transition"', $harington_paginate_links ); 
								$harington_paginate_links = str_replace( 'a class="page-numbers"', 'a class="page-numbers ajax-link" data-type="page-transition"', $harington_paginate_links ); 
								$harington_paginate_links = str_replace( 'a class="next page-numbers"', 'a class="next page-numbers ajax-link" data-type="page-transition"', $harington_paginate_links ); 
							}
								
							echo wp_kses_post( $harington_paginate_links ); 
							
							?>
						</div>
						
					</div>
				</div>
				<!-- /Blog Page Nav-->