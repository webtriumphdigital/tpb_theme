<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Justhome
 * @since Justhome 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<div class="box-comment">
			<div class="d-flex align-items-center wrapper-comments-title">
	        		<h3 class="comments-title m-0"><?php comments_number( esc_html__('0 Comments', 'justhome'), esc_html__('1 Comment', 'justhome'), esc_html__('% Comments', 'justhome') ); ?></h3>
	        		<div class="ms-auto">
	        			<a href="#commentform" class="btn btn-down-link"><?php esc_html_e( 'Leave a Review', 'justhome' ); ?></a>
	        		</div>
	        	</div>
			<ol class="comment-list">
				<?php wp_list_comments('callback=justhome_comment_item'); ?>
			</ol><!-- .comment-list -->

			<?php justhome_comment_nav(); ?>
		</div>	
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'justhome' ); ?></p>
	<?php endif; ?>

	<?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                        'title_reply'=> esc_html__('Leave a Comment','justhome'),
                        'comment_field' => '<div class="form-group space-comment">
                                                <textarea rows="7" id="comment" class="form-control" name="comment"'.$aria_req.'></textarea>
                                                <label class="for-control" for="comment">'.esc_html__('Comment', 'justhome').'</label>
                                            </div>',
                        'fields' => apply_filters(
                        	'comment_form_default_fields',
	                    		array(
	                                'author' => '<div class="row"><div class="col-sm-6 col-12"><div class="form-group ">
	                                            <input type="text" name="author" class="form-control" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
	                                            <label class="for-control" for="author">'.esc_html__('Name', 'justhome').'</label>
	                                            </div></div>',
	                                'email' => ' <div class="col-sm-6 col-12"><div class="form-group ">
	                                            <input id="email"  name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
	                                            <label class="for-control" for="email">'.esc_html__('Email', 'justhome').'</label>
	                                            </div></div>',
	                                'Website' => ' <div class="col-12 col-sm-4 d-none"><div class="form-group ">
	                                            <input id="website" name="website" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" ' . $aria_req . ' />
	                                            </div></div></div>',
	                            )
							),
	                        'label_submit' => esc_html__('Submit Comment', 'justhome'),
							'comment_notes_before' => '',
							'comment_notes_after' => '',
							'title_reply_before' => '<h4 class="title comment-reply-title">',
							'title_reply_after'  => '</h4>',
							'class_submit' => 'btn btn-theme'
                        );
    ?>

	<?php justhome_comment_form($comment_args); ?>
</div><!-- .comments-area --> 