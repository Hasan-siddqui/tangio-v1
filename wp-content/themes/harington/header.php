<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-primary-color="<?php echo esc_attr( harington_get_theme_options('clapat_harington_primary_color') ); ?>">
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

	<main>
	<?php
		// display header section
		get_template_part('sections/preloader_section');
	?>
	
		<!--Cd-main-content -->
		<div class="cd-index cd-main-content">

		<?php
		$harington_bknd_color = "";
		if( is_singular( 'harington_portfolio' ) ){

			$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-bknd-color' );
			$harington_bknd_color_attribute = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-portfolio-bknd-color-code' );
		}
		else if( is_singular( 'post' ) ){

			$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-blog-bknd-color' );
			$harington_bknd_color_attribute = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-blog-bknd-color-code' );
		}
		else if( is_404() ){

			$harington_bknd_color = harington_get_theme_options( 'clapat_harington_error_page_bknd_type' );
			$harington_bknd_color_attribute = "#ffffff";
			if( $harington_bknd_color == "light-content" ){

				$harington_bknd_color_attribute = "#171717";
			}

		}
		else if( is_page() ){

			$harington_bknd_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-bknd-color' );
			$harington_bknd_color_attribute = harington_get_post_meta( HARINGTON_THEME_OPTIONS, get_the_ID(), 'harington-opt-page-bknd-color-code' );
		}
		
		if( empty( $harington_bknd_color ) ){

			$harington_bknd_color = harington_get_theme_options( 'clapat_harington_default_page_bknd_type' );
			
			$harington_bknd_color_attribute = "#ffffff";
			if( $harington_bknd_color == "light-content" ){

				$harington_bknd_color_attribute = "#171717";
			}
		}

		?>

		<?php $harington_page_content_classes = ""; ?>

		<?php
		// Check if Elementor is installed and activated
		if ( did_action( 'elementor/loaded' ) ) {

			if( !empty( $harington_page_content_classes ) ){

				$harington_page_content_classes .= " ";
			}

			$harington_page_content_classes	.= "with-elementor";
		}
		?>
		
		<?php if( is_page_template( 'blog-page.php' ) || is_home() || is_archive() || is_search() ){ ?>
			<!-- Page Content -->
			<div id="page-content" class="blog-template-content <?php echo sanitize_html_class( $harington_bknd_color ); if( !harington_get_theme_options( 'clapat_harington_enable_magic_cursor' ) ){ echo " magic-cursor-disabled"; } ?> <?php echo esc_attr( $harington_page_content_classes ); ?>" data-bgcolor="<?php echo esc_attr( $harington_bknd_color_attribute ); ?>" >
		<?php } else if( is_singular( 'post' ) ){ ?>
			<!-- Page Content -->
			<div id="page-content" class="post-template-content <?php echo sanitize_html_class( $harington_bknd_color ); if( !harington_get_theme_options( 'clapat_harington_enable_magic_cursor' ) ){ echo " magic-cursor-disabled"; } ?> <?php echo esc_attr( $harington_page_content_classes ); ?>" data-bgcolor="<?php echo esc_attr( $harington_bknd_color_attribute ); ?>" >
		<?php } else { ?>
			<!-- Page Content -->
			<div id="page-content" class="<?php echo sanitize_html_class( $harington_bknd_color ); if( !harington_get_theme_options( 'clapat_harington_enable_magic_cursor' ) ){ echo " magic-cursor-disabled"; } ?> <?php echo esc_attr( $harington_page_content_classes ); ?>" data-bgcolor="<?php echo esc_attr( $harington_bknd_color_attribute ); ?>" >
		<?php } ?>

		<?php
			// display header section
			get_template_part('sections/header_section');
		?>