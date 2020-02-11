<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
            
                <div id="page-header-wrap">
                    <header id="page-header" class="clr">
                         <h1 id="archive-title"><?php _e( 'Search Results For', 'att' ); ?>: <?php the_search_query(); ?></h1>
                    </header><!-- #page-header -->
                </div><!-- #page-header -->
                                    
               <div id="post" class="post span_17 col col-1 clr">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile;	?>
                    <?php att_pagejump(); ?>
				</div><!-- #post -->
                
            <?php else : ?>
            
                <div id="page-header-wrap">
                    <header id="page-header" class="clr">
                        <h1 id="archive-title"><?php _e( 'Search Results For', 'att' ); ?>: <?php the_search_query(); ?></h1>
                    </header><!-- #page-header -->
                </div><!-- #page-header -->
        
                <div id="post" class="post span_17 col col-1 clr">
                    <?php _e( 'No results found for that query.', 'att' ); ?>
                </div><!-- /post  -->
                            
            <?php endif; ?>
            
			<?php get_sidebar(); ?>

    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>