<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">
        
        	<?php while ( have_posts() )  : the_post(); ?>

                <div id="page-header-wrap">
                    <header id="page-header" class="clr">
                        <h1 class="page-header-title"><?php the_title(); ?></h1>
                    </header><!-- #page-header -->
                </div><!-- #page-header-wrap -->
                                       
                <article id="post" class="span_17 col col-1 clr">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <div id="page-featured-img">
                            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php get_the_title(); ?>" />
                        </div><!-- #page-featured-img -->
                    <?php } ?>
                    <div class="entry clr">	
                        <?php the_content(); ?>
                    </div><!-- .entry -->
                    <?php comments_template(); ?>
                </article><!-- #post -->
                
			<?php endwhile; ?>
                    
            <?php get_sidebar(); ?>

        </div><!-- #content -->
    </div><!-- #primary -->
    
<?php get_footer(); ?>