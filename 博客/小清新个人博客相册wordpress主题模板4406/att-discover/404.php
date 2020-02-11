<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
    
get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">

            <div id="page-header-wrap">
                <header id="page-header" class="clr">
                     <h1><?php _e( '404: Page Not Found', 'att' ); ?></h1>
                </header><!-- #page-header -->
            </div><!-- #page-header-wrap -->
                                   
            <article id="post" class="clr">  
                <div class="entry clr">	
                     <p><?php _e( 'Unfortunately, the page you tried accessing could not be retrieved. Please visit the', 'att' ); ?> <a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php _e( 'homepage', 'att' ); ?></a>.</p>
                </div><!-- .entry -->
            </article><!-- #post -->

        </div><!-- #content -->
    </div><!-- #primary -->
    
<?php get_footer(); ?>