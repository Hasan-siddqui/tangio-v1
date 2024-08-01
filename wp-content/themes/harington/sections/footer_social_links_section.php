<?php

if( !function_exists('harington_render_footer_social_links' ) )
{
	function harington_render_footer_social_links(){

		global $harington_social_links_icons;
		$harington_social_links = "";
		for( $idx = 1; $idx <= HARINGTON_MAX_SOCIAL_LINKS; $idx++ ){

			$social_name = harington_get_theme_options( 'clapat_harington_footer_social_' . $idx );
			$social_url  = harington_get_theme_options( 'clapat_harington_footer_social_url_' . $idx );

			if( $social_url ){

				if( harington_get_theme_options( 'clapat_harington_social_links_icons' ) ){
					
					$harington_social_links .= '<li><span class="parallax-wrap"><a class="parallax-element" href="' . esc_url( $social_url ) . '" target="_blank"><i class="fa-brands fa-'. esc_attr( $harington_social_links_icons[ $social_name ] ) . '"></i></a></span></li>';
				}
				else {
					
					$harington_social_links .= '<li><span class="parallax-wrap"><a class="parallax-element" href="' . esc_url( $social_url ) . '" target="_blank">' . wp_kses( $social_name, 'harington_allowed_html' ) . '</a></span></li>';
				}

			}

		}
		
		if( !empty( $harington_social_links ) ){
?>
						<div class="socials-wrap">
							<div class="socials-icon"><i class="fa-solid fa-share-nodes"></i></div>
							<div class="socials-text"><?php echo wp_kses( harington_get_theme_options( 'clapat_harington_footer_social_links_prefix' ), 'harington_allowed_html' ); ?></div>
							<ul class="socials">
								<?php echo wp_kses( $harington_social_links, 'harington_allowed_html' ); ?>
							</ul>
						</div>
<?php			
		
		}

	}
}

harington_render_footer_social_links();

?>
