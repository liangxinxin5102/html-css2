			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'fancier' ); ?></p>
			</div>
<?php	
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One Comment to %2$s', '%1$s Comments', get_comments_number(), 'fancier' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>
			<hr>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'fancier' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'fancier' ) ); ?></div>
			</div>
<?php endif; ?>

			<ol class="commentlist">
				<?php
					wp_list_comments( array( 'callback' => 'fancier_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'fancier' ) ); ?>
				&nbsp;&nbsp;&nbsp;
				<?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'fancier' ) ); ?>
			</div>
<?php endif; ?>

<?php else :

	if ( ! comments_open() ) :
?>
<?php endif;  ?>

<?php endif; 

$defaults = array(
	'label_submit' => esc_attr__( 'Submit comment', 'fancier' ),
);
?>

<?php comment_form( $defaults ); ?>

</div>
