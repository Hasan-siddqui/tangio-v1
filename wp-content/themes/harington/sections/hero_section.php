<?php
/**
 * Created by Clapat.
 * Date: 07/12/22
 * Time: 11:33 AM
 */

// hero section container properties
$harington_hero_properties = new Harington_Hero_Properties();
$harington_hero_properties->getProperties( get_post_type() );

if( $harington_hero_properties->enabled ){

	get_template_part('sections/hero_section_container');
}
else {
	
	$harington_hero_styles = "content-full-width " . $harington_hero_properties->scroll_position . " " . $harington_hero_properties->alignment . " block-title";
	
?>
		<!-- Hero Section -->
		<div id="hero" <?php if( !harington_get_theme_options( 'clapat_harington_enable_page_title_as_hero' ) ){ echo 'class="hero-hidden"'; } ?>>
			<div id="hero-styles">
				<div id="hero-caption" class="<?php echo esc_attr( $harington_hero_styles ); ?>">
					<div class="inner">
						<div class="hero-title-wrapper">
							<h1 class="hero-title"><span><?php the_title(); ?></span></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/Hero Section -->   
		
<?php

}

?>
