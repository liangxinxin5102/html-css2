<?php
/**
 * The template for displaying the Portfolio custom post type archive.
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
                <header id="page-header" class="clr">
                    <h1 class="page-header-title"><?php post_type_archive_title(); ?></h1>
                </header><!-- #page-header -->
            </div><!-- #page-header-wrap -->
            
            <?php if ( have_posts() ) : ?>
            
            	<?php wp_enqueue_script( 'att-portfolio-filter', ATT_JS_DIR .'/portfolio-filter.js', array( 'jquery' ), '1.0', true ); ?>

                <div id="portfolio-template">
                    
                        <?php  $att_port_cats = get_terms( 'portfolio_category', array( 'hide_empty' => '1' ) ); ?>
                        <?php if ($att_port_cats) { ?>
                            <ul id="portfolio-cats" class="portfolio-filter clr">
                                <li><a href="#" class="active" data-filter="*"><span><?php _e( 'Show All', 'att' ); ?></span></a></li>
                                <?php foreach ($att_port_cats as $att_port_cat ) : ?>
                                	<li><a href="#" data-filter=".<?php echo $att_port_cat->slug; ?>"><span><?php echo $att_port_cat->name; ?></span></a></li>
                                <?php endforeach; ?>
                            </ul><!-- #portfolio-cats -->
                        <?php } ?>
                        
                        <div id="portfolio-wrap">
                            <div id="portfolio-filter-content" class="portfolio-content clr">
                                <?php $att_count = 0 ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                    	<?php $att_count++; ?>
                                    	<?php get_template_part( 'content','portfolio' ); ?>
                                	<?php if ( $att_count == '4' ) { echo '<div class="clr"></div>'; $att_count=0; } ?>
								<?php endwhile; ?>
                            </div><!-- #portfolio-filter-content -->
                            <?php att_pagination(); ?>
                        </div><!-- #portfolio-wrap -->
                        
                </div><!-- #portfolio-template -->

			<?php endif; ?>
            
    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>