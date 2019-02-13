<?php
$defaults = array(
	'fields'               => array(
								'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">(Обязательно)</span>' : '' ) . '</label></br> ' .
											'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
								'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">(Обязательно, публиковаться не будет)</span>' : '' ) . '</label></br> ' .
											'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
								
							),
	'comment_field'        => '<p class="comment-form-comment"><label for="comment">Ваш комментарий</label> <textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
	'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( '<a href="%1$s" aria-label="Logged in as %2$s. Edit your profile.">Logged in as %2$s</a>. <a href="%3$s">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'class_form'           => 'comment-form',
	'class_submit'         => 'submit',
	'name_submit'          => 'submit',
	'title_reply'          => __( 'Leave a Reply' ),
	'title_reply_to'       => __( 'Leave a Reply to %s' ),
	'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
	'title_reply_after'    => '</h3>',
	'cancel_reply_before'  => ' <small>',
	'cancel_reply_after'   => '</small>',
	'cancel_reply_link'    => __( 'Cancel reply' ),
	'label_submit'         => __( 'Post Comment' ),
	'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
	'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
	'format'               => 'xhtml',
);

function sort_comment_fields( $fields ){
    $new_fields = array();
    $myorder = array('author','email','url','comment'); // порядок полей
 
    foreach( $myorder as $key ){
        $new_fields[ $key ] = $fields[ $key ];
        unset( $fields[ $key ] );
    }
 
    if( $fields )
        foreach( $fields as $key => $val )
            $new_fields[ $key ] = $val;
    return $new_fields;
}
add_filter('comment_form_fields', 'sort_comment_fields' );


comment_form( $defaults );
	
	
?>