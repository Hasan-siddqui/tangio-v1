<?php
/**
 * Created by Clapat
 * Date: 03/12/20
 * Time: 10:16 AM
 */

// pagination
if( !function_exists('harington_pagination') ){

	function harington_pagination( $current_query = null, $navigation_type = "blog-nav-minimal" ){

		// pages represent the total number of pages
		global $wp_query;
		if( $current_query == null )
			$current_query = $wp_query;
			
		$pages = ($current_query->max_num_pages) ? $current_query->max_num_pages : 1;

		if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
		elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
		else { $paged = 1; }
		
		if( $pages > 1 )
		{
			
			if( $navigation_type == "blog-nav-minimal" ){
				
				// pagination
				echo '<div id="blog-page-nav" class="content-full-width">';
				echo '<div id="blog-page-nav-wrap">';
				echo '<div id="blog-navigation">';
				echo '<div id="blog-wrap" class="has-animation">';
				echo '<div id="blog-nav-minimal">';
				if( get_previous_posts_link() ){
					
					echo '<div class="blog-prev-wrap parallax-wrap">';
					echo '<div class="blog-prev parallax-element">';
					previous_posts_link( '<i class="fa-solid fa-left-long" aria-hidden="true"></i>' );
				}
				else {
					
					echo '<div class="blog-prev-wrap">';
					echo '<div class="blog-prev">';
					echo '<i class="fa-solid fa-left-long" aria-hidden="true"></i>';
				}
				echo '</div>';
				echo '</div>';
				?>
					<div class="blog-numbers">    
						<div class="blog-active"><?php echo wp_kses( $paged, 'harington_allowed_html' ); ?></div>        
						<div class="blog-total"><?php  echo wp_kses( $current_query->max_num_pages, 'harington_allowed_html' ); ?></div>    
					</div>    
				<?php
				if( get_next_posts_link('', $current_query->max_num_pages) ){
					
					echo '<div class="blog-next-wrap parallax-wrap">';
					echo '<div class="blog-next parallax-element">';
					next_posts_link('<i class="fa-solid fa-right-long" aria-hidden="true"></i>',  $current_query->max_num_pages);
				}
				else {
					
					echo '<div class="blog-next-wrap">';
					echo '<div class="blog-next">';
					echo '<i class="fa-solid fa-right-long" aria-hidden="true"></i>';
				}
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				// end pagination
				
			} else {
				
				 // classic navigation
				get_template_part( "sections/blog_navigation_classic_section" );
			}
		}
	}

} // pagination function


// comments
if( !function_exists('harington_comment') ){

	function harington_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;
		$add_below = 'comment-wrapper';
		echo '<div ';
		if( $depth > 1 ){ //reply comment
			comment_class("user_comment_reply");
		}
		else{ //top comment
			comment_class("user_comment");
		}
		echo ' id="div-comment-';
		comment_ID();
		echo '">';
		
		echo '<div id="comment-wrapper-';
		comment_ID();
		echo '">';
		echo '<div class="user-image">'. get_avatar($comment, 54) . '</div>';
		echo '<div class="comment-box">';
		echo '<p class="comment-head">'. get_comment_author_link() . ' ';
		echo '<span>';
		echo esc_html__('at', 'harington') . ' ' . get_comment_time() . ', ' . get_comment_date() . ' - ';
		comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('Reply', 'harington'), 'before' => '', 'after' => '', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));
		echo '</span>';
		echo '</p>';
		
		echo '<div class="comment-text">';
		if ($comment->comment_approved == '0'){
			echo '<em>' . esc_html__("Your comment is awaiting moderation", 'harington') . '</em><br />';
		}
		comment_text();
		
		echo '</div>'; // div comment-box
		echo '</div>'; // div comment-wrapper
		echo '</div>'; // div user_comment

	}
}

// defaults of the comment form
if( !function_exists('harington_commentform_title') ){
	function harington_commentform_title( $args ) {
			
		$args['title_reply_before'] = '<div id="reply-title" class="comment-reply-title">';
		$args['title_reply_after']  = '</div>';

		return  $args;
	}
}
add_filter( 'comment_form_defaults', 'harington_commentform_title' );

// the caption displayed within single blog post hero pages
if( !function_exists('harington_blog_post_hero_caption') ){

	function harington_blog_post_hero_caption() {

		// should be called in the loop
		$hero_caption = '';
		$hero_caption .= '<ul class="entry-meta entry-categories">';
		
		$post_categories = get_the_category();
		foreach( $post_categories as $post_category ){
			
			if( $post_category ){
				
				$hero_caption .= "<li>";
				$hero_caption .= '<a href="' . get_category_link( $post_category->term_id ) .'" rel="category tag">' . $post_category->name . '</a>';
				$hero_caption .= "</li>";
			}
		}
		
		$hero_caption .= '</ul>';

		return $hero_caption;
	}
}


?>