			<?php
				
				$harington_menu_breakpoint = "1025";
				$harington_menu_additional_text = "";
				if( ( harington_get_theme_options( 'clapat_harington_header_menu_type' ) != 'classic-burger-dots' ) &&
					( harington_get_theme_options( 'clapat_harington_header_menu_type' ) != 'classic-burger-lines' ) ){
					
					$harington_menu_breakpoint = "10025";
				}
				
				$harington_theme_location = '';
				if( has_nav_menu( 'primary-menu' ) ){
					
					$harington_theme_location = 'primary-menu';
				}
				wp_nav_menu(array(
					'theme_location' 	=> $harington_theme_location,
					'container' 		=> 'nav',
					'items_wrap' 		=> '<div class="nav-height"><div class="outer"><div class="inner"><ul id="%1$s" data-breakpoint="' . esc_attr( $harington_menu_breakpoint ) . '" class="flexnav %2$s">%3$s</ul></div>' . wp_kses( $harington_menu_additional_text, 'harington_allowed_html' ) . '</div></div>'
				));

			?>
