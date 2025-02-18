<?php

define('HARINGTON_THEME_ID', 'harington');
define('HARINGTON_THEME_OPTIONS', 'clapat_' . HARINGTON_THEME_ID . '_theme_options');

$harington_social_links = array('Fb' => esc_html__('Facebook', 'harington'),
							'Tw' => esc_html__('Twitter', 'harington'),
							'Be' => esc_html__('Behance', 'harington'),
							'Db' => esc_html__('Dribbble', 'harington'),
							'In' => esc_html__('Instagram', 'harington'),
							'Ld' => esc_html__('Linkedin', 'harington'),
							'Wa' => esc_html__('WhatsApp', 'harington'),
							'Da' => esc_html__('DeviantArt', 'harington'),
							'Dg' => esc_html__('Digg', 'harington'),
							'Fr' => esc_html__('Flickr', 'harington'),
							'Fq' => esc_html__('Foursquare', 'harington'),
							'Gi' => esc_html__('Git', 'harington'),
							'Pn' => esc_html__('Pinterest', 'harington'),
							'Rd' => esc_html__('Reddit', 'harington'),
							'Md' => esc_html__('Medium', 'harington'),
							'Sk' => esc_html__('Skype', 'harington'),
							'Sc' => esc_html__('Souncloud', 'harington'),
							'Su' => esc_html__('Stumbleupon', 'harington'),
							'Tb' => esc_html__('Tumblr', 'harington'),
							'Tk' => esc_html__('TikTok', 'harington'),
							'Ya' => esc_html__('Yahoo', 'harington'),
							'Ye' => esc_html__('Yelp', 'harington'),
							'Yt' => esc_html__('Youtube', 'harington'),
							'Vm' => esc_html__('Vimeo', 'harington'),
							'Xg' => esc_html__('Xing', 'harington') );
							
$harington_social_links_icons = array(	'Fb' => 'facebook-f',
									'Tw' => 'x-twitter',
									'Be' => 'behance',
									'Db' => 'dribbble',
									'In' => 'instagram',
									'Ld' => 'linkedin',
									'Wa' => 'whatsapp',
									'Da' => 'deviantart',
									'Dg' => 'digg',
									'Fr' => 'flickr',
									'Fq' => 'foursquare',
									'Gi' => 'git',
									'Pn' => 'pinterest',
									'Rd' => 'reddit',
									'Md' => 'medium',
									'Sk' => 'skype',
									'Sc' => 'soundcloud',
									'Su' => 'stumbleupon',
									'Tb' => 'tumblr',
									'Tk' => 'tiktok',
									'Ya' => 'yahoo',
									'Ye' => 'yelp',
									'Yt' => 'youtube',
									'Vm' => 'vimeo-square',
									'Xg' => 'xing' );
							
define ( 'HARINGTON_MAX_SOCIAL_LINKS', 5 );

$harington_slide_transitions = array( 'aqua-light' => get_template_directory_uri() . '/images/displacement/aqua-light.jpg',
								   'concrete-slab' => get_template_directory_uri() . '/images/displacement/concrete-slab.jpg',
								   'crystals' => get_template_directory_uri() . '/images/displacement/crystals.jpg',
								   'diagonal-stripes' => get_template_directory_uri() . '/images/displacement/diagonal-stripes.jpg',
								   'diamonds' => get_template_directory_uri() . '/images/displacement/diamonds.jpg',
								   'drops-grid' => get_template_directory_uri() . '/images/displacement/drops-grid.jpg',
								   'fire-flies' => get_template_directory_uri() . '/images/displacement/fire-flies.jpg',
								   'horizontal-stripes' => get_template_directory_uri() . '/images/displacement/horizontal-stripes.jpg',
								   'kaleidoscope' => get_template_directory_uri() . '/images/displacement/kaleidoscope.jpg',
								   'minecraft' => get_template_directory_uri() . '/images/displacement/minecraft.jpg',
								   'nebula' => get_template_directory_uri() . '/images/displacement/nebula.jpg',
								   'precious-stone.jpg' => get_template_directory_uri() . '/images/displacement/precious-stonejpg',
								   'printer-dots.jpg' => get_template_directory_uri() . '/images/displacement/printer-dots.jpg',
								   'textile-black-and-white.jpg' => get_template_directory_uri() . '/images/displacement/textile-black-and-white.jpg',
								   'white-noise.jpg' => get_template_directory_uri() . '/images/displacement/white-noise.jpg',
								   'zebra-stripes.jpg' => get_template_directory_uri() . '/images/displacement/zebra-stripes.jpg',
								   'zig-zag-stripes.jpg' => get_template_directory_uri() . '/images/displacement/zig-zag-stripes.jpg' );

$harington_slide_transitions_labels = array( 'aqua-light' =>  esc_html__('Aqua Light', 'harington'),
								   'concrete-slab' => esc_html__('Concrete Slab', 'harington'),
								   'crystals' => esc_html__('Crystals', 'harington'),
								   'diagonal-stripes' => esc_html__('Diagonal Stripes', 'harington'),
								   'diamonds' => esc_html__('Diamonds', 'harington'),
								   'drops-grid' => esc_html__('Drops Grid', 'harington'),
								   'fire-flies' => esc_html__('Fire Flies', 'harington'),
								   'horizontal-stripes' => esc_html__('Horizontal Stripes', 'harington'),
								   'kaleidoscope' => esc_html__('Kaleidoscope', 'harington'),
								   'minecraft' => esc_html__('Minecraft', 'harington'),
								   'nebula' => esc_html__('Nebula', 'harington'),
								   'precious-stone.jpg' => esc_html__('Precious Stone', 'harington'),
								   'printer-dots.jpg' => esc_html__('Printer Dots', 'harington'),
								   'textile-black-and-white.jpg' => esc_html__('Textile Black And White', 'harington'),
								   'white-noise.jpg' => esc_html__('White Noise', 'harington'),
								   'zebra-stripes.jpg' => esc_html__('Zebra Stripes', 'harington'),
								   'zig-zag-stripes.jpg' => esc_html__('Zig Zag Stripes', 'harington') );

?>