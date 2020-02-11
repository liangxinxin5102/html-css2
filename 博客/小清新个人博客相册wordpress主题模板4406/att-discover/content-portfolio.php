<?php
/**
 * The default template for displaying portfolio content.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */


/******************************************************
 * Single Posts
 * @since 1.0
*****************************************************/
if ( is_singular( 'portfolio') ) { ?>


	<?php $att_port_single_attachments = get_posts(
		array(
			'orderby'			=> 'menu_order',
			'post_type' 		=> 'attachment',
			'post_parent' 		=> get_the_ID(),
			'post_mime_type' 	=> 'image',
			'post_status' 		=> null,
			'posts_per_page' 	=> -1,
			'no_found_rows'		=> true,
			'suppress_filters'	=> false
		)
	); ?>
	
	<article id="single-portfolio-post" class="clr"> 
	
		<div class="clr">
	   
			<div id="single-portfolio-media" class="clr span_14 col col-1 fitvids">
				<?php
				/*--------------------------------------*/
				/* Single Featured Image Post Style
				/*--------------------------------------*/
				if ( get_post_meta( get_the_ID(), 'att_portfolio_post_style', true ) == 'Featured Image' || get_post_meta( get_the_ID(), 'att_portfolio_post_style', true ) == '' ) { ?>
			
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-thumbnail">
							<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="prettyphoto-link"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  att_img( 'port_post_width' ), att_img( 'port_post_height' ), att_img( 'port_post_crop' ) ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" /></a>
						</div><!-- /post-thumbnail -->
					<?php }  ?>
				
                
				<?php }
				/*--------------------------------------*/
				/* Slider Post Style
				/*--------------------------------------*/
				elseif ( get_post_meta( get_the_ID(), 'att_portfolio_post_style', true ) == 'Image Slider' ) { ?>
                	<?php wp_enqueue_script( 'flexslider', ATT_JS_DIR .'/flexslider.js', array( 'jquery' ), '2', true ); ?>
                	<?php wp_enqueue_script( 'att-slider-portfolio', ATT_JS_DIR .'/slider-portfolio.js', array( 'jquery','flexslider'), '1.0', true ); ?>
					<div id="single-portfolio-slider-wrap">
                        <div class="flexslider-container">
                            <div id="slider-<?php get_the_ID(); ?>" class="flexslider">
                                <ul class="slides">
                                    <?php foreach ( $att_port_single_attachments as $att_port_single_attachment ) : ?>
                                        <li class="slide">
                                            <a href="<?php echo wp_get_attachment_url( $att_port_single_attachment->ID ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="prettyPhoto[portfolio_gallery]"><img src="<?php echo aq_resize( wp_get_attachment_url( $att_port_single_attachment->ID ),  att_img( 'port_post_width' ), att_img( 'port_post_height' ), att_img( 'port_post_crop' ) ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" /></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul><!-- .slides -->
                            </div><!-- .flexslider -->
                        </div><!-- #flexslider-container -->
                    </div><!-- #single-portfolio-slider-wrap -->
                    
                    
				<?php }
				/*--------------------------------------*/
				/* Stacked Images Post Style
				/*--------------------------------------*/
				elseif ( get_post_meta( get_the_ID(), 'att_portfolio_post_style', true ) == 'Stacked Images' ) { ?>
					
					<?php foreach ( $att_port_single_attachments as $att_port_single_attachment ) : ?>
                    
					<div class="single-portfolio-stacked-image">
						<a href="<?php echo wp_get_attachment_url( $att_port_single_attachment->ID ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="prettyPhoto[portfolio_gallery]"><img src="<?php echo aq_resize( wp_get_attachment_url( $att_port_single_attachment->ID ),  att_img( 'port_post_width' ), att_img( 'port_post_height' ), att_img( 'port_post_crop' ) ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" /></a>
					</div><!-- /single-portfolio-stacked-image -->
					<?php endforeach; ?>
				
                
                <?php } 
				/*--------------------------------------*/
				/* Video Post Style
				/*--------------------------------------*/
				elseif ( get_post_meta( get_the_ID(), 'att_portfolio_post_style', true ) == 'Video' ) {
					echo wp_oembed_get( get_post_meta( get_the_ID(), 'att_portfolio_post_video', true ) );
				} ?>
                
			</div><!-- #single-portfolio-media -->
            
            <?php wp_reset_postdata(); ?>
			
			<div id="single-portfolio-info" class="entry span_10 col clr">
				<?php the_content(); ?>
			</div><!-- /single-portfolio-info -->
		
		</div><!-- #portfolio-content -->
		
		<?php if ( of_get_option( 'portfolio_comments') == '1' ) comments_template(); ?>
		
		<?php get_template_part( 'content','portfolio-related' ); ?>
	
	</article><!-- #post -->
    
    
<?php
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

	<?php global $att_count; ?>
	
	<?php $terms = get_the_terms( get_the_ID(), 'portfolio_category' ); ?>

    <article id="post-<?php the_ID(); ?>" class="portfolio-entry <?php if ($terms) foreach ($terms as $term) echo $term->slug .' '; ?> col-<?php echo $att_count; ?>">
        <?php if ( has_post_thumbnail() ) {  ?>
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  att_img( 'port_entry_width' ), att_img( 'port_entry_height' ), att_img( 'port_entry_crop' ) ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="portfolio-entry-img" /></a>           
        <?php } ?>
    </article><!-- .portfolio-entry -->

<?php } ?>

