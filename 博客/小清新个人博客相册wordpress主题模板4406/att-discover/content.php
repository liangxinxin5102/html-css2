<?php
/**
 * The default template for displaying post content.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
 
 
 
/******************************************************
 * Single Posts
 * @since 1.0
*****************************************************/
if ( is_singular() && is_main_query() ) { ?>


	<header class="post-heading"><h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2></header>
     
	 <ul class="meta clr">
	     <li><span><?php _e('Posted on', 'att' ); ?></span> <?php the_time('jS F Y'); ?>,</li> 
	     <li><span><?php _e('written by', 'att' ); ?></span> <?php the_author_posts_link(); ?></li>   
	     <?php if(comments_open()) { ?><li><span><?php _e('with', 'att' ); ?></span> <?php comments_popup_link(__('0 Comments', 'att' ), __('1 Comment', 'att' ), __('% Comments', 'att' ), 'comments-link' ); ?></li><?php } ?>
	</ul>
    
	<?php if( of_get_option('blog_single_thumbnail') == '1' && has_post_thumbnail() ) { ?>
        <div id="post-thumbnail">
            <img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ),  att_img( 'blog_width' ), att_img( 'blog_height' ), att_img( 'blog_crop' ) ); ?>" alt="<?php echo the_title(); ?>" />
        </div><!-- /post-thumbnail -->
    <?php } ?>
    
    <article class="entry clr">
        <?php the_content(); ?>
    </article><!-- .entry -->
    
    <?php wp_link_pages(); ?>
    
    <?php comments_template(); ?>


<?php
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'loop-entry clr' ); ?>>  
    
        <header class="post-heading">
            <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
        </header>
    
         <ul class="meta clr">
             <li><span><?php _e( 'Posted on', 'att' ); ?></span> <?php the_time( 'jS F Y' ); ?>,</li> 
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

<?php } ?>