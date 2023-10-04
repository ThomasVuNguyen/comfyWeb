<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nexter
 * @since	1.0.0
 */

if ( post_password_required() ) {
	return;
}

function nexter_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	unset( $fields['cookies'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'nexter_move_comment_field_to_bottom' );
?>

<div id="comments" class="comments-area">
	<?php nxt_comments_before(); 
	
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$nexter_comment_count = get_comments_number();
			if ( '1' === $nexter_comment_count ) {
				echo esc_html(
					  sprintf(
					  /* translators: 1: Comment. */
						_nx( 'Comment (%1$s)', 'Comment (%1$s)', $nexter_comment_count, 'count comment', 'nexter' ), number_format_i18n( $nexter_comment_count )
					  )
				);
			} else {
				echo esc_html(
					  sprintf(
					  /* translators: 1: Comment. */
						_nx( 'Comment (%1$s)', 'Comment (%1$s)', $nexter_comment_count, 'count comment', 'nexter' ), number_format_i18n( $nexter_comment_count )
					  )
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">			
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'avatar_size' => 100,
			) );
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nexter' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	
	if ( comments_open() ) : 

		$required_text = null;
		
		$args = array(
		  'id_form'           => 'commentform',
		  'class_form' => 'comment-form',
		  'id_submit'         => 'submit',
		  'title_reply'       => esc_html__( 'Leave Your Comment', 'nexter' ),
		  /* translators: 1: Leave a Reply */
		  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'nexter' ),
		  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'nexter' ),
		  'label_submit'      => esc_html__( 'Submit Now', 'nexter' ),

		  'comment_field' =>  '<div class="nxt-row"><div class="nxt-col"><label><textarea id="comment" name="comment" cols="45" rows="6" placeholder="'.esc_attr__('Comment','nexter').'" aria-required="true"></textarea></label></div></div>',
			
		  'must_log_in' => '<p class="must-log-in">' .
			sprintf(
			/* translators: 1: logged. */
			  __( 'You must be %1$slogged in%2$s to post a comment.', 'nexter' ),
			  '<a href="'.wp_login_url( apply_filters( "the_permalink", get_permalink() ) ).'">',
			  '</a>'
			) . '</p>',
			
		  'logged_in_as' => '<p class="logged-in-as">' .
			sprintf(
			/* translators: 1: logged. */
			esc_html__( 'Logged in as %1$s%2$s. %3$sLog out?%4$s', 'nexter' ),
			  '<a href="'.admin_url( "profile.php" ).'">'.$user_identity,
			  '</a>',
			  '<a href="'.wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ).'" title="'.esc_attr__("Log out of this account","nexter").'">',
			  '</a>'
			) . '</p>',

		  'comment_notes_before' => '',

		  'comment_notes_after' => '',

		  'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<div class="nxt-row"> <div class="nxt-col-md-4 nxt-col"><label>' .
			  '<input id="author" name="author" type="text" placeholder="'.esc_attr__('Name','nexter').'" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30" /></label></div>',

			'email' =>
			  '<div class="nxt-col-md-4 nxt-col"><label>' .
			  '<input id="email" name="email" type="text" placeholder="'.esc_attr__('Email Address *','nexter').'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30" /></label></div>',

			'url' =>
			  '<div class="nxt-col-md-4 nxt-col"><label>' .
			  '<input id="url" name="url" type="text" placeholder="'.esc_attr__('Website','nexter').'" value="' . esc_attr( $commenter['comment_author_url'] ) .
			  '" size="30" /></label></div></div>'
			)
		  ),
		);

		comment_form($args);
		
	endif;
	
	nxt_comments_after(); ?>
</div><!-- #comments -->
