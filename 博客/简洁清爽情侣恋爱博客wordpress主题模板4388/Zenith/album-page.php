<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
  Template name: Album
 
 * @package web2feel
 */

get_header(); ?>
<div class="subhead">
		<div class="col-md-12 wednames">
			<?php _e('Photo Album ','web2feel');?>
		</div>
</div>
<div class="container"> <div class="row"> 
	<div id="primary" class="content-area col-md-12">
		<main id="main" class="site-main" role="main">

		<?php
				
		if ( get_query_var('paged') )
		    $paged = get_query_var('paged');
		elseif ( get_query_var('page') )
		    $paged = get_query_var('page');
		else
		    $paged = 1;
		$wp_query = new WP_Query(array('post_type' => 'photo', 'posts_per_page' =>-1, 'paged' => $paged ));
		?>
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
		 <article class="col-sm-4 col-6 album-pic">
					
		 <?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 720, 480, true ); //resize & crop the image
		 ?>
					
		 <?php if($image) : ?>
			<div class="hthumb">
				 	<a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php echo $image ?>"/></a>
		 	</div>
		 <?php endif; ?>

		
		 
		 </article>
			

				<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->


</div></div>
<?php get_footer(); ?>
