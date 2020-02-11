<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
?>

<?php if ( get_the_author_meta( 'description' ) ) { ?>
    <div class="author-info row">	
        <div class="author-info-inner boxed clr">
            <div class="author-avatar">
                <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'att_author_bio_avatar_size', 75 ) ); ?>
                </a>
            </div><!-- .author-avatar -->
            <div class="author-description">
            	 <h4><span><?php printf( __( 'About %s', 'att' ), get_the_author() ); ?></span></h4>
                <p><?php the_author_meta( 'description' ); ?></p>
            </div><!-- .author-description -->
        </div><!-- .author-info-inner -->
    </div><!-- .author-info -->
<?php } ?>