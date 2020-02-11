<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : the_post(); ?>

				<div id="page-header-wrap">
					<header id="page-header" class="clr">
						<h1 class="page-header-title"><?php _e( 'Author', 'att' ); ?>: <?php echo get_the_author() ?></h1>
					</header><!-- #page-header -->
            	</div><!-- #page-header -->
    
                <div id="post" class="post span_17 col col-1 clr">  
                    <?php rewind_posts(); ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                    <?php endwhile; ?>        
                    <?php att_pagejump(); ?>
            	</div><!--/post -->
        
                <?php endif; ?>
            
            <?php get_sidebar(); ?>
        
    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>