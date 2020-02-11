<?php
/**
 * Template Name: Fullwidh
 *
 *
 * Custom template used to create fullwidth (without sidebar) pages.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">
        
        	<div class="container clr">

				<?php while ( have_posts() ) : the_post(); ?>
                
                    <div id="page-header-wrap">
                        <header id="page-header" class="grid-1 clr">
                            <h1 class="page-header-title"><?php the_title(); ?></h1>
                        </header><!-- #page-header -->
                    </div><!-- #page-header -->
                    
                    <div class="grid-1">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <div id="page-featured-img">
                                <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php get_the_title(); ?>" />
                            </div>
                        <?php } ?>
                        <article id="full-width" class="clr">
                            <div class="entry clr">	
                                <?php the_content(); ?>
                            </div><!-- .entry -->
                        </article><!-- #post -->       
                    </div><!-- .grid-1 -->
                
                <?php endwhile; ?>
            
            </div><!-- .container -->
            
    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>