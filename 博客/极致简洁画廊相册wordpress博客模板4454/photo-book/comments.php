			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'photobook' ); ?></p>
			</div>
<?php	
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'photobook' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'photobook' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'photobook' ) ); ?></div>
			</div>
<?php endif; ?>

			<ol class="commentlist">
				<?php
					wp_list_comments( array( 'callback' => 'phb_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'photobook' ) ); ?>
				&nbsp;&nbsp;&nbsp;
				<?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'photobook' ) ); ?>
			</div>
<?php endif; ?>

<?php else :

	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'photobook' ); ?></p>
<?php endif;  ?>

<?php endif; ?>

      <?php  
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );   
	   
	   	$comments_args = array(
    'title_reply'=>'Leave a Reply',
    'label_submit' => 'Submit comment', 
	'comment_notes_after'  => '',
	'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( ' ', 'photobook' ) .
    '</label></p><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea>',
	'comment_notes_before' => '',
	 'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<p class="comment-form-author">' .
      '<label for="author">' . __( '', 'domainreference' ) . '</label> ' . 
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' />'. __( 'Name (required)', 'photobook' ) . '</p>',

    'email' =>
      '<p class="comment-form-email"><label for="email">' . __( '', 'domainreference' ) . '</label> ' .
            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' />'. __( 'Mail (will not be published) (required)', 'photobook' ) . '</p>',

    'url' =>
      '<p class="comment-form-url"><label for="url">' .
      __( '', 'domainreference' ) . '</label>' .
      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30"' . $aria_req . ' />'. __( 'Website', 'tphotobook' ) . '</p>'
    )
  ),
);
	   comment_form($comments_args);?>

</div>
