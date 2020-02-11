	<div class="top-feature">
		<div class="container"><div class="row">
					<ul id="top-slider">
					<?php 	
					$count = of_get_option('w2f_slide_number','4');
					$slidecat =of_get_option('w2f_slide_categories');
					
					$query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count ) );
		           	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
		 	
			 		<li class="col-xs-3">
			 			
					<?php
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
						$image = aq_resize( $img_url, 720, 480, true ); //resize & crop the image
					?>
					
					<?php if($image) : ?>
						<img class="img-slide" src="<?php echo $image ?>"/>
					<?php endif; ?>
	
					
						<h3><?php the_title(); ?></h3>
					
						
					
			<?php endwhile; endif; ?>
					    		
		  </li>
		</ul>
		<div class="clearfix"></div>
		<div class="slide-pagination" id="top-page"></div>

		</div></div>
	</div>