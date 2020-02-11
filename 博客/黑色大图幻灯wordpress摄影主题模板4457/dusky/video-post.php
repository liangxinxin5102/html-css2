<?php
	$dusky_settings = get_option( 'dusky_options'); 

?>
<div class="post-video">

      
			<?php $format = get_post_format();  
get_template_part( 'format', $format );  
$query4 = new WP_Query( array(
 'posts_per_page' => 1,
	'tax_query' => array(
		array(
		'taxonomy' => 'post_format',
		'field'    => 'slug',
		'terms'    =>  'post-format-video'		
		)
	 )
));
while($query4->have_posts()){ $query4->the_post();  ?>			
					<div <?php post_class(); ?>>
<div class="video_box">
<div class="braun-back"><h3 class="title"><?php _e('Featured video', 'dusky'); ?></h3></div>
							<?php
								global $wp_embed;
								$video_width = apply_filters( 'dusky_single_video_width', 630 );
								$video_height = apply_filters( 'dusky_single_video_height', 400 );
								
								$video = get_post_meta($post->ID, '_et_dusky_video_url', true);
								$video = $wp_embed->shortcode( '', $video );
																							
								$video = preg_replace('/<embed /','<embed wmode="transparent" ',$video);
								$video = preg_replace('/<\/object>/','<param name="wmode" value="transparent" /></object>',$video); 

								$video = preg_replace("/width=\"[0-9]*\"/", "width={$video_width}", $video);
								$video = preg_replace("/height=\"[0-9]*\"/", "height={$video_height}", $video);
								
								echo $video;
							?>
						</div> 
						
		
					</div><!-- /post-->

			<?php 
		
	 } 
	wp_reset_postdata();  
		?>
					
	


</div><!-- featured-posts -->

