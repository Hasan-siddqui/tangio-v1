							<!-- Filters -->
							<div id="filters-overlay">
								<div id="close-filters"></div>
								<div class="outer">
									<div class="inner">  
										<ul id="filters">
											<li class="filters-timeline link"><a id="all" href="#" data-filter="*" class="active hide-ball"><?php echo wp_kses( harington_get_theme_options( 'clapat_harington_portfolio_filter_all_caption' ), 'harington_allowed_html' ); ?></a></li>
											<?php
										
												// check if the category filter is specified in page options
												$harington_portfolio_category_filter	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-portfolio-filter-category' );

												$harington_portfolio_category = null;
												if( !empty( $harington_portfolio_category_filter ) ){
					
													$harington_portfolio_category = array();
													$harington_category_slugs = explode( ",", $harington_portfolio_category_filter );
													foreach( $harington_category_slugs as $harington_category_slug ){
														
														$harington_category_object = get_term_by( 'slug', $harington_category_slug, 'portfolio_category' );
														if( $harington_category_object ){
															
															array_push( $harington_portfolio_category, $harington_category_object );
														}
													}
												}
												else {

													$harington_portfolio_category = get_terms('portfolio_category', array( 'hide_empty' => 0 ));
												}

												if( $harington_portfolio_category ){

													foreach( $harington_portfolio_category as $portfolio_cat ){

											?>
											<li class="filters-timeline link"><a href="#" data-filter=".<?php echo sanitize_title( $portfolio_cat->slug ); ?>" class="hide-ball"><?php echo wp_kses( $portfolio_cat->name, 'harington_allowed_html' ); ?></a></li>
											<?php

													}
												}

											?>
										</ul>
											
									</div>
								</div>
							</div>
							<!-- Filters -->