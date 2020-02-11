<?php
/**
 * Template Name: Blog
 *
 *
 * Custom template used to display your recent blog posts
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
            
            <div id="page-header-wrap">
                <header id="page-header" class="clr">
					<h1 class="page-header-title"><?php the_title(); ?></h1>
                </header><!-- #page-header -->
            </div><!-- #page-header-wrap -->
            
            <div id="post" class="span_17 col col-1 clr">
                <?php query_posts(
                    array(
                        'post_type'	=> 'post',
                        'paged'		=> $paged
                    )
                ); ?>       
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() );   ?> 
                    <?php endwhile;	?>
                <?php att_pagejump(); ?>
                <?php endif; ?>        
                <?php wp_reset_query(); ?>
            </div><!-- #post -->
            <?php endwhile; ?>
            
            <?php get_sidebar(); ?>
                                        
    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>