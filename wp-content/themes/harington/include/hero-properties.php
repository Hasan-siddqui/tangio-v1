<?php

if ( ! class_exists( 'Harington_Hero_Properties' ) ) {

	class Harington_Hero_Properties
	{
		public $post_id;
		public $enabled;
		public $share;
		public $caption_title;
		public $caption_subtitle;
		public $desc;
		public $scroll_position;
		public $alignment;
		public $caption_display_type;
		public $image;
		public $foreground;
		public $video;
		public $video_webm;
		public $video_mp4;
		public $scroll_down_caption;
		public $info_text;
		public $item_no;
		public $change_header_color;

		public function __construct(){

			$this->post_id = "";
			$this->enabled = false;
			$this->share = false;
			$this->caption_title = "";
			$this->caption_subtitle = "";
			$this->desc = "";
			$this->scroll_position = esc_attr("parallax-scroll-caption");
			$this->alignment = esc_attr("text-align-center");
			$this->caption_display_type = "block-title";
			$this->image = true;
			$this->foreground= esc_attr('light-content');
			$this->video = false;
			$this->video_webm = "";
			$this->video_mp4 = "";
			$this->scroll_down_caption = "";
			$this->info_text = "";
			$this->item_no = 1;
			$this->change_header_color = 'default-header-color';
		}

		public function getProperties( $post_type ){

			if( empty( $this->post_id ) ){
				
				$this->post_id = get_the_ID();
			}

			if( $post_type == 'harington_portfolio' ){

				$this->enabled 			= true; // in portfolio projects hero is always enabled and the hero image will be displayed in showcase slider
				$this->share 			= true;
				$this->image		 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-hero-img' );
				$title_row				= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-hero-caption-title' );
				$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
				$this->caption_title	= "";
				foreach( $title_list as $title_bit ){
					
					$this->caption_title .= $this->titleWrap( $title_bit );
				}
				$this->caption_subtitle = "";
				$this->scroll_position 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-hero-parallax-caption' );
				if( $this->image && !empty( $this->image['url'] ) ){
					
					$this->scroll_position = "";
				}
				$this->alignment 		= "";
				$this->foreground 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-bknd-color' );
				$this->video 			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-video' );
				$this->video_webm 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-video-webm' );
				$this->video_mp4 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-video-mp4' );
				$this->scroll_down_caption = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-hero-scroll-caption' );
				$this->change_header_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-portfolio-invert-hero-header' );

			} else if( $post_type == 'post' ){

				$this->enabled = true; // the hero section is always enabled in case of blog posts, displaying post title and categories
				$this->caption_title 	= get_the_title();
				$this->caption_subtitle	= harington_blog_post_hero_caption();
				$this->alignment 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-blog-hero-caption-alignment' );
				$this->foreground 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-blog-bknd-color' );
				$this->image		 	= null;

			} 
			else if( !empty( $post_type ) ){

				$this->enabled 			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-enable-hero' );

				$this->image		 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-img' );
				$title_row				= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-caption-title' );
				$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
				$this->caption_title	= "";
				foreach( $title_list as $title_bit ){
					
					$this->caption_title .= $this->titleWrap( $title_bit );
				}
				$this->caption_display_type = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-caption-title-type' );
				$subtitle_row			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-caption-subtitle' );
				$subtitle_list			= preg_split('/\r\n|\r|\n/', $subtitle_row);
				$this->caption_subtitle	= "";
				foreach( $subtitle_list as $subtitle_bit ){
					
					$this->caption_subtitle .= $this->subtitleWrap( $subtitle_bit );
				}
				$this->scroll_position 	= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-parallax-caption' );
				if( $this->image && !empty( $this->image['url'] ) ){
					
					$this->scroll_position = "";
					$this->caption_subtitle = "";
				}
				$this->alignment 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-caption-align' );
				$this->foreground 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-bknd-color' );
				$this->video 			= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-video' );
				$this->video_webm 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-video-webm' );
				$this->video_mp4 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-video-mp4' );
				$this->scroll_down_caption = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-scroll-caption' );
				$this->info_text 		= harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-hero-info-text' );
				$this->change_header_color = harington_get_post_meta( HARINGTON_THEME_OPTIONS, $this->post_id, 'harington-opt-page-invert-hero-header' );
			}
			
		}

		protected function titleWrap( $title ){
			
			if( !empty( $title ) ){
					
				$title	= '<span>' . $title . '</span>';
			}
			
			return $title;
		}
		
		protected function subtitleWrap( $subtitle ){
			
			if( !empty( $subtitle ) ){
					
				$subtitle	= '<span>' . $subtitle . '</span>';
			}
			
			return $subtitle;
		}
	}
}

$harington_hero_properties = new Harington_Hero_Properties();

?>
