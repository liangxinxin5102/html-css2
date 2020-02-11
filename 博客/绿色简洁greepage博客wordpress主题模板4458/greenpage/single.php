<?php get_header(); ?>

	<div id="wrapper-main">
	  <div id="container"> 

	<div id="content">
<div class="content-inside">
		<div id="posts">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="head-border"><a href="<?php the_permalink(); ?>">Home &raquo; </a><?php the_category(' &raquo; ', 'greenpage'); ?></div> 
				<div class="full-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

					<h2 class="full-post-title"><?php the_title(); ?></h2>
					<div class="meta">
							
							 <?php _e('Author', 'greenpage'); ?>: <?php the_author_link(); ?> | 
							 <?php _e('Category', 'greenpage'); ?>: <?php the_category(', '); ?> |  
							<?php _e('Tags', 'greenpage'); ?>: <?php echo get_the_tag_list('',', ',''); ?>							 
						
						</div><!--meta-->
					<!--meta-->
					<div class="single-post-image"><?php the_post_thumbnail('homepage-thumb', array('alt' => '', 'title' => '')) ?></div>
 
					<div class="full-post-content"><?php the_content(); ?></div>

					<div class="full-post-pages"><?php wp_link_pages(); ?></div>

				
					<div class="clearfix"></div>

			<div class="post-nav">
										 <div class="post-nav-l"><?php previous_post_link(__('&larr; %link', '<span class="meta-nav">' . '</span> %title', 'greenpage')); ?></div>
					<div class="post-nav-r"><?php next_post_link( __('%link &rarr;', '%title <span class="meta-nav">' . '</span>' , 'greenpage')); ?></div>
				</div><!-- /page links -->
				<div class="clear"></div>
			<?php comments_template( '', true ); ?>

				</div><!-- full-post -->

				<?php endwhile; ?>

			<?php endif; ?>

			</div>
	</div>
<?php get_sidebar(); ?>
</div>
			</div>
			</div>
<?php get_footer(); ?>
