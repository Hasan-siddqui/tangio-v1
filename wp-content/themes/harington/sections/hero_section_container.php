<?php
/**
 * Created by Clapat.
 * Date: 01/12/22
 * Time: 1:34 PM
 */
$harington_hero_properties = new Harington_Hero_Properties();
$harington_hero_properties->getProperties( get_post_type() );

$hero_styles = "content-full-width";
if( !empty( $harington_hero_properties->alignment ) ){
	
	$hero_styles .= " " . $harington_hero_properties->alignment;
}
if( !empty( $harington_hero_properties->caption_display_type ) ){
	
	$hero_styles .= " " . $harington_hero_properties->caption_display_type;
}
if( !empty( $harington_hero_properties->scroll_position ) ){
	
	$hero_styles .= " " . $harington_hero_properties->scroll_position;
}

if( $harington_hero_properties->enabled ){

?>

		<?php if( $harington_hero_properties->image && !empty( $harington_hero_properties->image['url'] ) ){ ?>
		<!-- Hero Section -->
		<div id="hero" class="has-image">
			<div id="hero-styles">
				<div id="hero-caption" class="<?php echo esc_attr( $hero_styles ); ?>">
					<div class="inner">
						<div class="hero-title-wrapper">
							<div class="hero-title"><?php echo wp_kses( $harington_hero_properties->caption_title, 'harington_allowed_html' ); ?></div>
						</div>
						<?php if( !empty( $harington_hero_properties->caption_subtitle ) ){ ?>
						<div class="hero-subtitle-wrapper">
							<div class="hero-subtitle"><?php echo wp_kses( $harington_hero_properties->caption_subtitle, 'harington_allowed_html' ); ?></div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div id="hero-footer">
					<div class="hero-footer-left">
						<?php if( !empty( $harington_hero_properties->scroll_down_caption ) ){ ?>
						<div class="button-wrap right scroll-down">
							<div class="icon-wrap parallax-wrap">
								<div class="button-icon parallax-element">
									<i class="arrow-icon-down"></i>
								</div>
							</div>
							<div class="button-text sticky right"><span data-hover="<?php echo esc_attr( $harington_hero_properties->scroll_down_caption ); ?>"><?php echo wp_kses( $harington_hero_properties->scroll_down_caption, 'harington_allowed_html' ); ?></span></div>
						</div>
						<?php } ?>
					</div>
					<?php if( $harington_hero_properties->share ){ ?>
					<div class="hero-footer-right">
						<div id="share" class="page-action-content" data-text="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_share_social_networks_caption' ) ); ?>"></div>
					</div>
					<?php } else { 
						if( !empty( $harington_hero_properties->info_text ) ){
					?>
					<div class="hero-footer-right">
						<div id="info-text"><?php echo wp_kses( $harington_hero_properties->info_text, 'harington_allowed_html' ); ?></div>
					</div>
					<?php }
					} ?>
				</div>
			</div>
		</div>
		<div id="hero-image-wrapper" class="<?php echo sanitize_html_class( $harington_hero_properties->change_header_color ); ?>">
			<div id="hero-background-layer" class="parallax-scroll-image">
				<div id="hero-bg-image" style="background-image:url(<?php echo esc_url( $harington_hero_properties->image['url'] ); ?>)">
				<?php if( $harington_hero_properties->video ){ ?>
					<div class="hero-video-wrapper">
						<video loop muted class="bgvid">
						<?php if( !empty( $harington_hero_properties->video_mp4 ) ){ ?>
							<source src="<?php echo esc_url( $harington_hero_properties->video_mp4 ); ?>" type="video/mp4">
						<?php } ?>
						<?php if( !empty( $harington_hero_properties->video_webm ) ){ ?>
							<source src="<?php echo esc_url( $harington_hero_properties->video_webm ); ?>" type="video/webm">
						<?php } ?>
						</video>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
		<?php } else { ?>

		<!-- Hero Section -->
		<div id="hero">
			<div id="hero-styles">
				<div id="hero-caption" class="content-full-width <?php echo esc_attr( $hero_styles ); ?>">
					<div class="inner">
						<div class="hero-title-wrapper">
							<h1 class="hero-title"><?php echo wp_kses( $harington_hero_properties->caption_title, 'harington_allowed_html' ); ?></h1>
						</div>
						<?php if( !empty( $harington_hero_properties->caption_subtitle ) ){ ?>
						<div class="hero-subtitle-wrapper">
							<h5 class="hero-subtitle"><?php echo wp_kses( $harington_hero_properties->caption_subtitle, 'harington_allowed_html' ); ?></h5>
						</div>
						<?php } ?>
					</div>
				</div>
				<div id="hero-footer">
					<div class="hero-footer-left">
						<?php if( !empty( $harington_hero_properties->scroll_down_caption ) ){ ?>
						<div class="button-wrap right scroll-down">
							<div class="icon-wrap parallax-wrap">
								<div class="button-icon parallax-element">
									<i class="arrow-icon-down"></i>
								</div>
							</div>
							<div class="button-text sticky right"><span data-hover="<?php echo esc_attr( $harington_hero_properties->scroll_down_caption ); ?>"><?php echo wp_kses( $harington_hero_properties->scroll_down_caption, 'harington_allowed_html' ); ?></span></div>
						</div>
						<?php } ?>
					</div>
					<?php if( $harington_hero_properties->share ){ ?>
					<div class="hero-footer-right">
						<div id="share" class="page-action-content" data-text="<?php echo esc_attr( harington_get_theme_options( 'clapat_harington_portfolio_share_social_networks_caption' ) ); ?>"></div>
					</div>
					<?php } else { 
						if( !empty( $harington_hero_properties->info_text ) ){
					?>
					<div class="hero-footer-right">
						<div id="info-text"><?php echo wp_kses( $harington_hero_properties->info_text, 'harington_allowed_html' ); ?></div>
					</div>
					<?php }
					} ?>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
		<?php } ?>

<?php
}
?>
