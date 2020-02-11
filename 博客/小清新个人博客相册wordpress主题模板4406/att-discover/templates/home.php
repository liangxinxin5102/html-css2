<?php
/**
 * Template Name: Homepage
 *
 *
 * Custom template used for this theme's homepage display
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content" role="main">

            <div id="home-wrap" class="clr container">
            
              <?php
                /**************************
                * Slider
                ****************************/
				if ( of_get_option ( 'enable_slides', '1' ) == '1' ) : ?>
                	<?php get_template_part( 'content','slides' );  ?>
				<?php endif; ?>
                

				<?php	
                /**************************
                * Portfolio
                ****************************/
                if ( of_get_option ( 'enable_portfolio', '1' ) ) : ?>
                
                    <?php $query_portfolio_posts = new WP_Query(
                          array(
                              'post_type'			=> 'portfolio',
                              'posts_per_page'		=> of_get_option( 'home_portfolio_count','12'),
                              'no_found_rows'		=> true,
                          )
                      );		
					if ( $query_portfolio_posts->posts ) { ?>
                    
						<?php wp_enqueue_script( 'att-portfolio-filter', ATT_JS_DIR .'/portfolio-filter.js', array( 'jquery' ), '1.0', true ); ?>
                    
                        <div id="home-portfolio">
                            
                            <?php $att_port_cats = get_terms( 'portfolio_category', array( 'hide_empty' => '1' ) ); ?>                           
                            <?php if ( $att_port_cats ) { ?>
                            <ul id="portfolio-cats" class="portfolio-filter clr">
                                <li><a href="#" class="active" data-filter="*"><span><?php _e( 'Show All', 'att' ); ?></span></a></li>
                                <?php foreach ($att_port_cats as $att_port_cat ) : ?>
                                <li><a href="#" data-filter=".<?php echo $att_port_cat->slug; ?>"><span><?php echo $att_port_cat->name; ?></span></a></li>
                                <?php endforeach; ?>
                            </ul><!-- #portfolio-cats -->
                            <?php } ?>
                            
                            <div id="portfolio-wrap">
                                <div id="portfolio-filter-content" class="portfolio-isotope clr"> 
                                	<?php $att_count = 0 ?>
                                    <?php foreach( $query_portfolio_posts->posts as $post ) : setup_postdata($post); ?>
                                    	<?php $att_count++; ?>
                                        <?php get_template_part( 'content','portfolio' ); ?>
                                        <?php if ( $att_count == '4' ) { echo '<div class="clr"></div>'; $att_count=0; } ?>
                                    <?php endforeach; ?>
                                </div><!-- /portfolio-isotope -->
                            </div><!-- #portfolio-wrap -->
                        </div><!-- /home-portfolio -->
                
               		<?php } ?>
                    
					<?php wp_reset_postdata(); ?>
                
                <?php endif; ?>
    
			</div><!-- #home-wrap -->   

    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>