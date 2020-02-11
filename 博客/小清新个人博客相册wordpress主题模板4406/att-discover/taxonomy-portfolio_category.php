<?php
/**
 * The template for displaying your Portfolio Category custom taxonomy archives.
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
                <header id="page-header" class="grid-1 clr">
                    <h1 class="page-header-title"><?php echo single_term_title(); ?></h1>
					<?php if ( term_description() !== '' ) { ?>
                        <div id="archive-description"><?php echo term_description(); ?></div>
                    <?php } ?>
                </header><!-- #page-header -->
            </div><!-- #page-header-wrap -->
    
			<?php if ( have_posts( ) ) : ?>
            
            	<?php wp_enqueue_script( 'isotope', ATT_JS_DIR .'/isotope.js', array( 'jquery' ), '1.5.19', true ); ?>
				<?php wp_enqueue_script( 'att-isotope-init', ATT_JS_DIR .'/isotope-init.js', array( 'jquery', 'isotope' ), '1.0', true ); ?>

                <div id="portfolio-template" class="grid-1">
                    
                    <div id="portfolio-wrap">
                        <div id="portfolio-filter-content" class="portfolio-content clr">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'content', 'portfolio' ); ?>
                            <?php endwhile; ?>
                        </div><!-- #portfolio-filter-content -->
                        <?php att_pagination(); ?>
                    </div><!-- #portfolio-wrap -->
                    
                </div><!-- #portfolio-template -->
    
            <?php endif; ?>

    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>