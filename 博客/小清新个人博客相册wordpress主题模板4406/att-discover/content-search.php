<?php
/**
 * The default template for displaying search entries
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
?>  

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-entry clr' ); ?>>  
	 <header>
	     <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
	 </header>
	 <ul class="meta clr">
	 	<li><span><?php _e( 'Posted on', 'att' ); ?></span> <?php the_time( 'jS F Y' ); ?></li> 
	 	<li><span><?php _e( 'in', 'att' ); ?></span> <span class="posted-in"><?php echo get_post_type(); ?></span>,</li> 
	    <li><span><?php _e( 'written by', 'att' ); ?></span> <?php the_author_posts_link(); ?></li>   
	    <?php if (comments_open()) { ?><li><span><?php _e( 'with', 'att' ); ?></span> <?php comments_popup_link(__( '0 Comments', 'att' ), __( '1 Comment', 'att' ), __( '% Comments', 'att' ), 'comments-link' ); ?></li><?php } ?>
	</ul>
	<?php if ( has_post_thumbnail() ) {  ?>
        <div class="loop-entry-thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  att_img( 'blog_width' ), att_img( 'blog_height' ), att_img( 'blog_crop' ) ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" /></a>
        </div><!-- .loop-entry-thumbnail -->
    <?php } ?>
    <div class="entry-content">
        <div class="entry-text">
            <?php the_excerpt(); ?>
        </div><!-- /entry-text -->
        <a class="theme-button" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php _e( 'Continue Reading', 'att' ); ?></a>
    </div><!-- .entry-content -->  
</article><!-- .entry -->