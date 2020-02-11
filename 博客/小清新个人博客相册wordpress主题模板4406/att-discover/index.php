<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
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
        
            <div id="page-header-wrap">
                <header id="page-header" class="grid-1">
                    <h1 class="page-header-title"><?php _e( 'Recent Posts', 'att' ); ?></h1>
                </header><!-- #page-header -->
            </div><!-- #page-header -->

            <div class="grid-1">
                <div id="post" class="clr">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                    <?php endwhile; ?>
                    <?php att_pagejump(); ?>
                </div><!-- #post -->     
                <?php get_sidebar(); ?>
            </div><!-- #post -->

		</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>