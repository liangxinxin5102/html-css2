<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress Theme
 * @since 1.0
 */
 
get_header();

if ( have_posts() ) :

	while ( have_posts() ) : the_post(); ?>
    
        <div id="post" class="col span_9 clr">
        
			<?php get_template_part( 'content', get_post_format() ); ?>
        
        	<div class="boxed clr <?php if ( ! has_post_thumbnail() ) echo 'rounded'; ?>">
            
                <header><h1 id="post-title"><?php the_title(); ?></h1></header><!-- #post-title -->
                
                <ul class="meta clr">
                     <li><i class="icon-time"></i><?php the_time('jS F Y'); ?></li> 
                     <li><i class="icon-user"></i><?php the_author_posts_link(); ?></li> 
                     <?php 
                     // First category link
                     $category = get_the_category(); 
                      if( $category[0] ){
                          echo '<li><i class="icon-folder-close"></i><a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a><li>';
                      }
                     // Comments link
                     if( comments_open() ) { ?>
                        <li><i class="icon-comments"></i><?php comments_popup_link(__('0 Comments', 'att'), __('1 Comment', 'att'), __('% Comments', 'att'), 'comments-link' ); ?></li>
                    <?php } ?>
                </ul><!-- .loop-entry-meta -->

                <article class="entry clr">
                    <?php the_content(); ?>
                </article><!-- .entry -->
                
                <?php wp_link_pages(); ?>
            
            </div><!-- .boxed -->     
            
            <?php get_template_part('author','bio'); ?>
            
            <?php
            // Display comments and comments form
            comments_template(); ?>
            
            <div id="post-pagination" class="clr">
                <div class="post-prev"><?php next_post_link('%link', '<span class="icon-arrow-left"></span>' . __('Previous Article','att'), false); ?></div> 
                <div class="post-next"><?php previous_post_link('%link', __('Next Article','att') . '<span class="icon-arrow-right"></span>', false); ?></div>
            </div><!-- #post-pagination -->
            
        </div><!-- #post -->

	<?php	
	endwhile;
endif;
get_sidebar();
get_footer();