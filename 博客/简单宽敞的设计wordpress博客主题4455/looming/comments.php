<div id="comments-wrap">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'looming' ); ?></p>
			</div>
<?php	
		return;
	endif;
?>


<!-- You can start editing here. -->
<?php // Begin Comments & Trackbacks ?>
<?php if ( have_comments() ) : ?>
<h3 id="comments-number"><?php comments_number('No Comments', 'One Comment', '% Comments' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

<ol class="commentlist">
	<?php wp_list_comments(); ?>
</ol>

	<div class="comments-navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p><?php _e('Sorry, the comment form is closed at this time.', 'looming'); ?></p>

	<?php endif; ?>
<?php endif; ?>



 <?php  
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );   
	   
	   	$comments_args = array(
    'title_reply'=>'Leave a Reply',
    'label_submit' => 'Submit comment', 
	'comment_notes_after'  => '',
	'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( ' ', 'looming' ) .
    '</label></p><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea>',
	'comment_notes_before' => '',
	 'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<p class="comment-form-author">' .
      '<label for="author">' . __( '', 'domainreference' ) . '</label> ' . 
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' />'. __( 'Name (required)', 'looming' ) . '</p>',

    'email' =>
      '<p class="comment-form-email"><label for="email">' . __( '', 'domainreference' ) . '</label> ' .
            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' />'. __( 'Mail (will not be published) (required)', 'looming' ) . '</p>',

    'url' =>
      '<p class="comment-form-url"><label for="url">' .
      __( '', 'domainreference' ) . '</label>' .
      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30"' . $aria_req . ' />'. __( 'Website', 'looming' ) . '</p>'
    )
  ),
);
	   comment_form($comments_args);?>
</div>
