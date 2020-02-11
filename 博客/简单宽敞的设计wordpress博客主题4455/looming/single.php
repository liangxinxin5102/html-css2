<?php get_header(); ?>

	<div class="hr-full-post">
		<hr />
	</div>

	<div id="content">

		<div id="posts">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="full-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

					<h2 class="full-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="meta-full-post">
						<span><?php the_time('F j, Y'); ?></span> by <span><?php the_author() ?></span>
					</div><!--meta-->
					<div class="single-post-image"><?php the_post_thumbnail('homepage-thumb', array('alt' => '', 'title' => '')) ?></div>
 
					<div class="full-post-content"><?php the_content(); ?></div>

					<div class="full-post-pages"><?php wp_link_pages(); ?></div>

					<div class="meta-full-post">
					<?php the_category(', ') ?><br />
						<?php the_tags( 'Tags: ', ', ', ''); ?><br />
						<?php edit_post_link('Edit', ' &#124; ', ''); ?>
					</div>

					<div class="clearfix"></div>

			<div class="post-nav">
					 <div class="post-nav-l"><?php previous_post_link(__('Previous post <br/> %link', '<span class="meta-nav">' . '</span> %title', 'looming')); ?></div>
					<div class="post-nav-r"><?php next_post_link( __('Next post <br/> %link', '%title <span class="meta-nav">' . '</span>' , 'looming')); ?></div>
				</div><!-- /page links -->
			<?php comments_template( '', true ); ?>

				</div><!-- full-post -->

				<?php endwhile; ?>

			<?php endif; ?>

		</div>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>
