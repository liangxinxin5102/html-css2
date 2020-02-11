	<div class="home-slider">
	
		<div class="cycle-slideshow"
			 data-cycle-caption-plugin='caption2' 
		  	 data-cycle-slides="li" 
			 data-cycle-fx='scrollHorz' 
			 data-cycle-speed='700' 
			 data-cycle-timeout='8000' 
			 data-cycle-center-horz=true
			 data-cycle-center-vert=true
			 data-cycle-prev=".prev" 
			 data-cycle-next=".next"   
			 data-cycle-caption-template="<span class=stitle>{{ptitle}}</span><br><span class=stext>{{ptext}}</span> "			
			 data-cycle-pause-on-hover="true" >
			 <div class="cycle-caption custom"></div>
			<ul>
		    <?php 	$count = of_get_option('w2f_slide_number');
					$slidecat =of_get_option('w2f_slide_categories');

					$query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count ) );
		           	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
		           	
 	
			 		<li data-cycle-ptitle="<?php echo get_the_title(); ?>" data-cycle-ptext="<?php echo excerpt(20); ?>" data-cycle-pmore="Read More" data-cycle-plink="<?php echo get_permalink( $id ); ?>">
			 		 <?php
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
						$image = aq_resize( $img_url, 1000, 500, true ); //resize & crop the image
					?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $image ?>" /></a>
	
			 		</li>
					
				   	<?php endwhile; endif; ?>
			</ul>
			
			<div class="prev"></div>
			<div class="next"></div>
		
    
		</div>

	</div>
	<div class="intro clearfix">
		<div class="container_12">
			<div class="grid_12 intro-text">
				<h2><?php echo of_get_option( 'w2f_welcome_text', 'Welcome to my website' ); ?></h2>
			</div>
		</div>
	</div>