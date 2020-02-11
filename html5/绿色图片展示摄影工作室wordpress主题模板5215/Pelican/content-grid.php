<?php
/**
 * @package fabthemes
 * @since fabthemes 1.0
 */
?>


<li class="grid_4">
	<figure>
		<div class="boximage"> 
		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 300, 300, true ); //resize & crop the image
		?>
					
		<?php if($image) : ?>
			<a href="<?php the_permalink(); ?>"> <img src="<?php echo $image ?>"/>	</a>
		<?php endif; ?>
		</div>
		<figcaption>
			<h3>  <?php the_title(); ?> </h3>
			
			<a href="<?php the_permalink(); ?>"> Read More </a>
		</figcaption>
	</figure>
	
</li>
