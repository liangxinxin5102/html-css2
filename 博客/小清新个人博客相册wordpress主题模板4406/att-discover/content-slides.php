<?php
/**
 * This file is used to show your homepage slides
 * @package Kraken WordPress Theme
 * @since 1.0
 * @author Authentic Themes : http://www.authenticthemes.com
 * @copyright Copyright (c) 2012, Authentic Themes
 * @link http://www.authenticthemes.com
 */
?>

<?php $query_slides = new WP_Query( array(
		'post_type'			=> 'slides',
		'posts_per_page'	=> '-1',
		'no_found_rows'		=> true,
	)
);
if ( $query_slides->posts ) { ?>

	<?php wp_enqueue_script( 'flexslider', ATT_JS_DIR .'/flexslider.js', array( 'jquery' ), '2', true ); ?>
	<?php wp_enqueue_script( 'att-slider-home', ATT_JS_DIR .'/slider-home.js', array('jquery','flexslider'), '1.0', true ); ?>
	<?php $flex_params = array(
		'slideshow' => of_get_option( 'slides_slideshow', '0'),
		'randomize' => of_get_option( 'slides_randomize', '0'),			
		'animation' => of_get_option( 'slides_animation', 'slide'),
		'direction' => of_get_option( 'slides_direction', 'horizontal'),
		'slideshowSpeed' => of_get_option( 'slideshow_speed', '7000'),
		'animationSpeed' => of_get_option( 'animation_speed', '600')
	);
	wp_localize_script( 'att-slider-home', 'flexLocalize', $flex_params ); ?>
    
    <div id="home-slider-wrap">
        <div id="home-slider" class="flexslider clr">
            <ul class="slides">
                <?php foreach( $query_slides->posts as $post ) : setup_postdata($post); ?>
                <?php if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'att_slides_video', true ) ){ ?>
                    <li>
                    	<div class="slide-inner grid-1 fitvids">
                        	<?php if ( get_post_meta( get_the_ID(), 'att_slides_video', true ) !== '' ) {
								echo wp_oembed_get( get_post_meta( get_the_ID(), 'att_slides_video', true ) );
							} else {
								if ( get_post_meta( get_the_ID(), 'att_slides_url', true ) !== '' ) { ?>
                                <a href="<?php echo get_post_meta( get_the_ID(), 'att_slides_url', true ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" target="_<?php echo get_post_meta( get_the_ID(), 'att_slides_url_target', true ); ?>">
                                	<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
                                </a>
								<?php } else { ?>
                            	<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
								<?php } ?>
							<?php } ?>
							<?php if ($post->post_content !=='') { ?>
                                <div class="flex-caption"><?php the_content(); ?></div>
                            <?php } ?>
                        </div><!-- .slide-inner -->
                    </li>
                <?php } ?>
                <?php endforeach; wp_reset_postdata(); ?>
            </ul><!-- .slides -->
        </div><!-- #home-slider -->
    </div><!-- #home-slider-wrap -->
<?php } ?>