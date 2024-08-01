<?php

	if ( post_password_required() ) { ?>
		<div id="post-notification"><h2><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'harington'); ?></h2></div>
	<?php
		return;
	}

?>



	
<!-- Article Discusion -->
<div id="post-comments">
	
    <div class="post-max-width">
	
        <div id="comments">
        
            <div class="article-head">
                <ul class="entry-meta">
                    <li><?php comments_number(esc_html__('No Comments', 'harington'), esc_html__('One Comment', 'harington'), esc_html__('% Comments', 'harington'));?></li>
                </ul>
            </div>
                
            <?php if ( have_comments() ) { ?>
    
                <div class="comments-navigation">
                    <div class="alignleft"><?php previous_comments_link(); ?></div>
                    <div class="alignright"><?php next_comments_link(); ?></div>
                </div>
    
                <div class="container">
                    <?php wp_list_comments('callback=harington_comment&style=div'); ?>
                </div>
                        
                <div class="comments-navigation">
                    <div class="alignleft"><?php previous_comments_link(); ?></div>
                    <div class="alignright"><?php next_comments_link(); ?></div>
                </div>
    
            <?php } // if have comments ?>
    
            <?php if ( !comments_open() ) { ?>
            <!-- If comments are closed. -->
            <h5><?php esc_html_e('Comments are closed.', 'harington'); ?></h5>
            <?php } ?>
            
        </div>
    
    </div>

</div>
<!-- Article Discusion -->




<?php if ( comments_open() ) { ?>

	<!-- Post Comments Formular -->
	<div id="post-form">

<?php

		$harington_class_message_area = '';
		if( is_user_logged_in() ){

			$harington_class_message_area = 'comment_area_loggedin';
		}

		$harington_comment_id = "comment";

		$harington_commentform_args = array(
						'id_form'           => 'commentsform',
						'class_form'      	=> 'comment-form',
						'id_submit'         => 'submit',
						'title_reply'       => '<div class="article-head"><ul class="entry-meta"><li>'. esc_html__( 'Leave a comment', 'harington') . '</li></ul></div>',
						'title_reply_to'    => '<div class="article-head"><ul class="entry-meta"><li>'. esc_html__( 'Leave a comment to %s ', 'harington') . '</li></ul></div>',
						'cancel_reply_link' => '<span class="cancel-reply">'. esc_html__( 'Cancel Reply', 'harington') . '</span>',
						'label_submit'      => esc_html__( 'Post Comment', 'harington'),
						'submit_button'		=> '<div class="button-box"><div class="clapat-button-wrap parallax-wrap hide-ball"><div class="clapat-button parallax-element"><div class="button-border outline rounded parallax-element-second"><input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" /></div></div></div></div>',
						'submit_field'		=> '<div class="form-submit">%1$s %2$s</div>',

						'comment_field' =>  '<div class="message-box hide-ball ' . sanitize_html_class( $harington_class_message_area ) . '"><textarea id="' . esc_attr( $harington_comment_id ) . '" name="comment" onfocus="if(this.value == \'' . esc_attr__( 'Comment', 'harington') .'\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'' . esc_attr__( 'Comment', 'harington') .'\'; }" >' . esc_html__( 'Comment', 'harington') .'</textarea><label class="input_label slow"></label></div>',

						'must_log_in' => '<p class="must-log-in">' .
										sprintf(
										wp_kses( __( '<h4>You must be <a href="%s">logged in</a> to post a comment.</h4>', 'harington'), 'harington_allowed_html' ),
										wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
										) . '</p>',

						'comment_notes_before' => '',

						'comment_notes_after' => '',

						'fields' => apply_filters( 'comment_form_default_fields', array(

													'author' => '<div class="name-box hide-ball"><input name="author" type="text" id="author" size="30"  onfocus="if(this.value == \'' . esc_attr__( 'Name', 'harington') .'\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'' . esc_attr__( 'Name', 'harington') .'\'; }" value=\'' . esc_attr__( 'Name', 'harington') . '\' ><label class="input_label"></label></div>',

													'email' =>  '<div class="email-box hide-ball"><input name="email" type="text" id="email" size="30"  onfocus="if(this.value == \'' . esc_attr__( 'E-mail', 'harington') .'\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'' . esc_attr__( 'E-mail', 'harington') .'\'; }" value=\'' . esc_attr__( 'E-mail', 'harington') . '\' ><label class="input_label"></label></div>',

													'url' => ''
													)
												)
					);

		comment_form( $harington_commentform_args );

?>
		</div>
		<!-- /Post Comments Formular -->
<?php

} // if comments are open
?>