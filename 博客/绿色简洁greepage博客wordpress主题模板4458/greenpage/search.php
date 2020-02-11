<?php get_header(); ?>
<div id="wrapper-main">
	  <div id="container">  
	<div id="content">
			<div class="content-inside">
				
<div class="single-post-index">

			<?php if (have_posts()) : ?>

				<div class="search-results"><h2>Search results for: <?php echo $_GET['s']; ?></h2></div>

				<?php while (have_posts()) : the_post(); ?>

				<div class="single-post" id="post-<?php the_ID(); ?>"> 
										<p class="publish-date"><span class="publish-day"><?php the_time( 'd' ) ?></span> <span class="publish-month"><?php the_time( 'M' ) ?></span> <span class="publish-year"><?php the_time( 'Y' ) ?></span></p>
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<div class="meta">
							
							 <?php _e('Author', 'greenpage'); ?>: <?php the_author_link(); ?> | 
							 <?php _e('Category', 'greenpage'); ?>: <?php the_category(', '); ?> |  
							<?php _e('Tags', 'greenpage'); ?>: <?php echo get_the_tag_list('',', ',''); ?>							 
						
						</div><!--meta-->
			
						<div class="single-post-content">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('squareThumb', array('alt' => '', 'title' => '')) ?></a>
					

						
						<?php global $more; $more = 0; ?><?php the_excerpt(); ?></div>

				<div class="continue-reading">
          <p class="full-article"><a href="<?php echo get_permalink(); ?>"><?php _e( 'Read More', 'greenpage' ); ?></a> <?php if ( comments_open() ) : ?><a class="article-comments" href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a><?php endif; ?></p>
        </div>
		
											<div class="clearfix"></div>

				</div><!-- single-post -->

				<?php endwhile; ?>

				<div class="posts-navigation">
					<div class="posts-navigation-prev"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'greenpage' ) ); ?></div>
					<div class="posts-navigation-next"> <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'greenpage' ) ); ?></div>
			
					<div class="clearfix"></div>
					
				</div>

		<?php else: ?>

				<div class="search-results"><h2><?php _e( 'Nothing Found', 'greenpage' ); ?></h2></div>

			<?php endif; ?>
			
</div>

 </div>
<?php get_sidebar(); ?>
	</div>
</div>
  </div><!-- end of wrapper-main -->
<?php get_footer(); ?>