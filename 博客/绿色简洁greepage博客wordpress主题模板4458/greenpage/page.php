<?php get_header(); ?>

	<div id="wrapper-main">
	  <div id="container"> 

	<div id="content">
<div class="content-inside">
		<div id="posts">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="full-post" id="post-<?php the_ID(); ?>"> 

					<h2 class="full-post-title"><?php the_title(); ?></h2>
					<div class="meta">
						<?php the_time('F j, Y'); ?> by <?php the_author() ?>
					</div><!--meta-->
 
					<div class="full-post-content"><?php the_content(); ?></div>

					<div class="full-post-pages"><?php wp_link_pages(); ?></div>

					

					<div class="clearfix"></div>

					<?php comments_template(); ?>

				</div><!-- full-post -->

				<?php endwhile; ?>

			<?php endif; ?>

		</div>
<div class="clearfix"></div>
					
				</div>

	
	
			

<?php get_sidebar(); ?>
	</div>
</div>
  </div><!-- end of wrapper-main -->
<?php get_footer(); ?>