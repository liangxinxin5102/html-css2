<?php
	$dusky_settings = get_option( 'dusky_options'); 
	$cat1_id = $dusky_settings['dusky_feat_cat1'];
	$cat1_name = get_cat_name($cat1_id);
	$cat1_url = get_category_link( $cat1_id );
?>

<div id="featured-posts">
	<ul id="featured-posts-list">
      
		<?php $my_query = new WP_Query('showposts=6&category_name='.$cat1_name); while ($my_query->have_posts()) : $my_query->the_post(); ?> 
        	<li>
            		<div class="featured-post-image">
				<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('mini-thumb'); ?></a>
		<?php } else { ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/def-min.png" alt="<?php the_title(); ?>" class="aligncenter" /></a>
<?php } ?>	
			</div>
		</li>
		<?php endwhile; ?>

	</ul> 
</div><!-- featured-posts -->
