<?php
/**
 * The Template for displaying your single portfolio posts
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
 
get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">
        
			<?php $posttype_obj = get_post_type_object( get_post_type( ) ); ?>
        
            <div id="page-header-wrap">
                <header id="page-header" class="grid-1">
                    <h1><?php echo get_post_type_object( get_post_type( ) )->label; ?> / <?php the_title(); ?></h1>
                </header><!-- #page-header -->
            </div><!-- #page-header-wrap -->
            
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', 'portfolio' ); ?>
            <?php endwhile; ?>
            <?php endif; ?>

    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>