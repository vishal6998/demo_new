<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="eltdf-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="eltdf-comment-holder-inner">
				<h4 class="eltdf-comments-title"><?php esc_html_e( 'Comments', 'laurent' ); ?></h4>
				<div class="eltdf-comments">
					<ul class="eltdf-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'laurent_elated_comment' ), apply_filters( 'laurent_elated_filter_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'laurent' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$eltdf_commenter = wp_get_current_commenter();
		$eltdf_req       = get_option( 'require_name_email' );
		$eltdf_aria_req  = ( $eltdf_req ? " aria-required='true'" : '' );
	    $eltdf_consent  = empty( $eltdf_commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$eltdf_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Post a Comment', 'laurent' ),
			'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'laurent' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'laurent' ),
			'label_submit'         => esc_html__( 'Send', 'laurent' ),
			'comment_field'        => apply_filters( 'laurent_elated_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_attr__( 'Your comment', 'laurent' ) . '" name="comment" cols="45" rows="6" aria-required="true"></textarea>' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => apply_filters( 'laurent_elated_filter_comment_form_default_fields', array(
                'author' => '<div class="eltdf-grid-row eltdf-grid-normal-gutter"><div class="eltdf-grid-col-6"><input id="author" name="author" placeholder="' . esc_attr__( 'Your Name', 'laurent' ) . '" type="text" value="' . esc_attr( $eltdf_commenter['comment_author'] ) . '" ' . $eltdf_aria_req . ' /></div>',
                'email'  => '<div class="eltdf-grid-col-6"><input id="email" name="email" placeholder="' . esc_attr__( 'Your Email', 'laurent' ) . '" type="text" value="' . esc_attr( $eltdf_commenter['comment_author_email'] ) . '" ' . $eltdf_aria_req . ' /></div></div>',
                'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $eltdf_consent . ' />' .
					'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'laurent' ) . '</label></p>',
			) ),
            'submit_button'         => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s"><span class="eltdf-btn-text">%4$s</span></button>',
            'class_submit'          => 'eltdf-btn eltdf-btn-medium eltdf-btn-outline'
		);

	$eltdf_args = apply_filters( 'laurent_elated_filter_comment_form_final_fields', $eltdf_args );
		
	if ( get_comment_pages_count() > 1 ) { ?>
		<div class="eltdf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $eltdf_show_comment_form = apply_filters('laurent_elated_filter_show_comment_form_filter', true);
    if($eltdf_show_comment_form) {
    ?>
        <div class="eltdf-comment-form">
            <?php comment_form( $eltdf_args ); ?>
        </div>
    <?php } ?>
<?php } ?>	