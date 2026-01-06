<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;

if ( ! comments_open() ) {
	return;
}

?>

<?php if ( have_comments() ) :
	$nb_reviews = WP_RealEstate_Review::get_total_reviews($post->ID);
	$rating = get_post_meta( $post->ID, '_average_rating', true );
?>
	<div id="comments">
		<div class="d-flex align-items-center wrapper-comments-title">
			<h3 class="comments-title m-0"><?php echo round($rating, 2); ?> <?php echo sprintf(esc_html__('(%d Reviews)', 'justhome'), $nb_reviews); ?></h3>
			<div class="ms-auto">
    			<a href="#commentform" class="btn btn-down-link"><?php echo esc_html__('Leave a Review','justhome') ?></a>
    		</div>
		</div>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => array( 'WP_RealEstate_Review', 'agent_comments' ) ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			echo '<nav class="apus-pagination">';
			paginate_comments_links( apply_filters( 'wp_realestate_comment_pagination_args', array(
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				'type'      => 'list',
			) ) );
			echo '</nav>';
		endif; ?>
	</div>
<?php endif; ?>

<div id="reviews">
	<?php $commenter = wp_get_current_commenter(); ?>
	<div id="review_form_wrapper" class="commentform commentform-detail-agent">
		<div id="review_form">
			<?php
				$comment_form = array(
					'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'justhome' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'justhome' ), get_the_title() ),
					'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'justhome' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<div class="row"><div class="col-12 col-sm-6"><div class="form-group">'.
						            '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /><label for="author" class="for-control">'.esc_html__( 'Name', 'justhome' ).'</label></div></div>',
						'email'  => '<div class="col-12 col-sm-6"><div class="form-group">' .
						            '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /><label for="email" class="for-control">'.esc_html__( 'Email', 'justhome' ).'</label></div></div></div>',
					),
					'label_submit'  => esc_html__( 'Submit Review', 'justhome' ),
					'logged_in_as'  => '',
					'comment_field' => '',
					'title_reply_before' => '<h4 class="title comment-reply-title">',
					'title_reply_after'  => '</h4>',
					'class_submit' => 'btn btn-theme'
				);

				$comment_form['must_log_in'] = '<div class="must-log-in">' . wp_kses(__( 'You must be <a href="javascript:void(0)">logged in</a> to post a review.', 'justhome' ), array('a' => array('class' => array(), 'href' => array())) ) . '</div>';
				
				$comment_form['comment_field'] .= '<div class="form-group"><textarea id="comment" class="form-control" name="comment" cols="45" rows="5" aria-required="true"></textarea><label for="comment" class="for-control">'.esc_html__( 'Write Comment', 'justhome' ).'</label></div>';
				
				justhome_comment_form($comment_form);
			?>
		</div>
	</div>
</div>