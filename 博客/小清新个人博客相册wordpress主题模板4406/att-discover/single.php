<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
 
get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">

            <div id="page-header-wrap">
                <div id="page-header" class="clr">
					<h1><?php _e( 'Blog', 'att' ); ?></h1>
                </div><!-- #page-header -->
            </div><!-- #page-header -->
            
            <div id="post" class="single-post span_17 col col-1 clr">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
            </div><!-- #post -->

		<?php get_sidebar(); ?>

    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>