<?php get_header(); ?>	
<?php $shortname = "design_studio"; ?>
<?php global $slider_arr; ?>
	<?php if (is_home() || is_front_page()) { ?>
		<div id="new_slide_cont">
			
		</div><!--//new_slide_cont-->		
	<?php } ?>
<div id="content">
	<div class="container">
		
		<?php if (trim(get_option($shortname.'_featured_text','')) != '') { ?>
			<div class="home_featured_text"><?php echo stripslashes(stripslashes(get_option($shortname.'_featured_text',''))); ?></div>
		<?php } ?>
		<?php
		global $slider_arr;
		$idObj = get_category_by_slug('blog'); 
		$blog_id = $idObj->term_id;
		
		$args = array(
			 //'category_name' => 'blog',
			 'post_type' => 'post',
			 'post__not_in' => $slider_arr,
			 'cat' => '-' . $blog_id,
			 'posts_per_page' => 6
			 );
		query_posts($args);
		$y = 0;
		while (have_posts()) : the_post(); ?>
		
			<div class="home_featured_post <?php if ($y == 2) { echo 'home_featured_post_last'; } ?>">
				<?php if(get_post_meta( get_the_ID(), 'page_featured_type', true ) == 'youtube') { ?>
					<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo get_post_meta( get_the_ID(), 'page_video_id', true ); ?>" frameborder="0" allowfullscreen></iframe>
				<?php } elseif(get_post_meta( get_the_ID(), 'page_featured_type', true ) == 'vimeo') { ?>
					<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta( get_the_ID(), 'page_video_id', true ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=085e17" width="500" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php } else { ?>
					<?php the_post_thumbnail('design-home-featured'); ?>
					
					<a class="home_featured_post_hover" href="<?php the_permalink(); ?>">
						<div class="home_featured_post_tbl">
							<div class="home_featured_post_tbl_cell">
								<h3><?php the_title(); ?></h3>
								<p><?php echo ds_get_excerpt('40'); ?></p>
							</div><!--//home_featured_post_tbl_cell-->
						</div><!--//home_featured_post_tbl-->
					</a><!--//home_featured_post_hover-->					
				<?php } ?>																					
			
			</div><!--//home_featured_post-->
			<?php if($y == 2 ) { echo '<div class="home_featured_post clear"></div>'; $y = -1; } ?>
				
			
		
		<?php $y++; ?>
		<?php endwhile; ?>
		                                 									
		 <?php wp_reset_query(); ?>  
		<div class="clear"></div>
		
		<div class="home_blog_bottom_box_cont">
			<?php
			global $slider_arr;
			$args = array(
				 'category_name' => 'blog',
				 'post_type' => 'post',
				 'post__not_in' => $slider_arr,
				 'posts_per_page' => 3
				 );
			query_posts($args);
			$y = 0;
			while (have_posts()) : the_post(); ?>
			
				<div class="home_blog_bottom_box <?php if ($y == 2) { echo 'home_blog_bottom_box_last'; } ?>">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo ds_get_excerpt('150'); ?></p>
				</div><!--//home_blog_bottom_box-->
			<?php $y++; ?>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>                                    									
			<div class="clear"></div>
		</div><!--//home_blog_bottom_box_cont-->
		
	</div><!--//container-->
</div><!--//content-->
<?php get_footer(); ?> 		