<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Office WordPress Theme
 * @since Apollo 2.0
 */
?>
 
 <aside id="post-author-box" class="boxed clr row">
    <div id="post-author-image">
        <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
            <?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?>
        </a>
    </div><!-- #post-author-image --> 
    <div id="post-author-bio">
        <h4><?php _e('Article Written By ','att') . the_author_meta('display_name'); ?></h4>
        <p><?php the_author_meta('description'); ?></p>
    </div><!-- #post-author-bio -->
</aside><!-- #post-author-box -->