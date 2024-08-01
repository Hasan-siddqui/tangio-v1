<?php
$harington_post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

$harington_post_title = get_the_title();
if( empty( $harington_post_title ) ){
	
	$harington_post_title = esc_html__("Post has no title", "harington");
}

?>
				
				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
					<div class="article-wrap">
						<?php if( $harington_post_image  ){ ?>
						<div class="hover-reveal">
							<div class="hover-reveal__inner">
								<div class="hover-reveal__img">
									<a class="ajax-link" href="<?php echo esc_url( the_permalink() ); ?>" data-type="page-transition">
										<img src="<?php echo esc_url( $harington_post_image[0] ); ?>" alt="<?php esc_attr_e("Post Image", "harington"); ?>">                                      	 
									</a>
								</div>
							</div>
						</div>
						<?php } ?>
						<a class="post-title ajax-link has-mask-fill" href="<?php echo esc_url( the_permalink() ); ?>" data-type="page-transition"><?php echo wp_kses( $harington_post_title, 'harington_allowed_html' ); ?></a>
					</div>	
					<div class="article-content">
								
						<div class="entry-meta-wrap">    
							<div class="entry-meta entry-categories">
								<ul class="post-categories">
									<?php 
										$harington_categories = get_the_category();
										if ( ! empty( $harington_categories ) ) {

											foreach( $harington_categories as $harington_category ) {

												echo '<li class="link">';
												echo wp_kses( '<a class="ajax-link" data-type="page-transition" href="' . esc_url( get_category_link( $harington_category->term_id ) ) . '" rel="category tag"><span data-hover="' . esc_attr( $harington_category->name ) . '">' . esc_html( $harington_category->name ) . '</span></a>', 'harington_allowed_html' );
												echo '</li>';
											}
										}
									?>
								</ul>
							</div>
						</div>
						
						<div class="entry-meta-wrap">
							<ul class="entry-meta entry-date">
								<li class="link"><a class="ajax-link" href="<?php the_permalink(); ?>"><span data-hover="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></span></a></li>
							</ul>
						</div>
						
					</div>
					<div class="article-links">
						<div class="button-box">
							<a class="ajax-link" data-type="page-transition" href="<?php the_permalink(); ?>">
								<div class="clapat-button-wrap parallax-wrap hide-ball">
									<div class="clapat-button parallax-element">
										<div class="button-border outline rounded parallax-element-second">
											<span data-hover="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_blog_read_more_caption' ) ); ?>"><?php echo wp_kses( harington_get_theme_options( 'clapat_harington_blog_read_more_caption' ), 'harington_allowed_html' ); ?></span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="page-links">
						<?php
							wp_link_pages();
						?>
						</div>

						<?php
						if( harington_get_theme_options('clapat_harington_blog_excerpt_type') != 'blog-excerpt-none' ) {
						?>
						<div class="blog-excerpt">
							<?php
							if( harington_get_theme_options('clapat_harington_blog_excerpt_type') == 'blog-excerpt-full' ) {
								
								the_content( esc_html__('Continue Reading...', 'harington') );
							}
							else {
								
								the_excerpt();
							}
						?>
						</div>
						<?php
						}
						?>
					</div>
				</article>
				<!--/Article -->