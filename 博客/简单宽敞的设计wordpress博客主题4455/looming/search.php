<?php get_header(); ?>

	<div id="content">

		<div id="posts">

			<?php if (have_posts()) : ?>

				<div class="search-results"><h2>Search results for "<?php echo $_GET['s']; ?>":</h2></div>

				<?php while (have_posts()) : the_post(); ?>

				<div class="single-post" id="post-<?php the_ID(); ?>"> 

					<div class="single-post-image"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('homepage-thumb', array('alt' => '', 'title' => '')) ?></a></div>
					<div class="single-post-text">

						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="single-post-content"><?php the_excerpt() ?></div>

						<div class="meta">
							<span><?php the_time('F j, Y'); ?></span><br />
							By: <span><?php the_author() ?></span><br />
							<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
						</div><!--meta-->

					</div><!-- single-post-text -->
					<div class="clearfix"></div>

				</div><!-- single-post -->

				<?php endwhile; ?>

				<div class="posts-navigation">
					<div class="posts-navigation-next"><?php next_posts_link(esc_html__('Older Posts','looming')) ?></div>
					<div class="posts-navigation-prev"><?php previous_posts_link(esc_html__('Newer Posts', 'looming')) ?></div>
					<div class="clearfix"></div>
				</div>

			<?php else: ?>

				<div class="search-results"><h2><?php _e( 'Nothing Found', 'looming' ); ?></h2></div>

			<?php endif; ?>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
