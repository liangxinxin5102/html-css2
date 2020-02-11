<?php
/**
 * This file is used to show related/other portfolio items on single portfolio posts
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
 
/*--------------------------------------------------*/
/* Show Other Posts @ Random
/*--------------------------------------------------*/
if ( of_get_option( 'portfolio_more', '1' ) == '1' ) { ?>
	
    <?php
	$query_portfolio_posts = new WP_Query(
		array(
			'orderby' 			=> 'rand',
			'post_type'			=> 'portfolio',
			'posts_per_page'	=> '8',
			'no_found_rows'		=> true,
		)
	);
	if ( $query_portfolio_posts->posts ) { ?>
    
		<div class="clear"></div>
            <div id="single-portfolio-related" class="clr">
				<h3><span><?php _e('Other Work', 'att' ); ?></span></h3>
                <div class="grid-container">
                <?php $att_count=0; ?>
				<?php foreach( $query_portfolio_posts->posts as $post ) : setup_postdata($post); ?>
                	<?php $att_count++; ?>
                    <article id="post-<?php the_ID(); ?>" class="portfolio-entry col-<?php echo $att_count; ?>">
						<?php if ( has_post_thumbnail() ) {  ?>
                            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  att_img( 'port_entry_width' ), att_img( 'port_entry_height' ), att_img( 'port_entry_crop' ) ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="portfolio-entry-img" /></a>           
                        <?php } ?>
                    </article><!-- .portfolio-entry -->
                    <?php if ( $att_count == '4' ) { echo '<div class="clr"></div>'; $att_count=0; } ?>
				<?php endforeach; ?>
			</div><!--/grid-container -->
		</div><!-- /single-portfolio-related -->
        
	<?php } ?>
    
    <?php wp_reset_postdata(); ?>
    
<?php } ?>