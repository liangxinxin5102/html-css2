<?php get_header(); ?>

	<div id="content">

		<div id="posts">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="full-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

					<h2 class="full-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="video_box">

							<?php
								global $wp_embed;
								$video_width = apply_filters( 'dusky_single_video_width', 630 );
								$video_height = apply_filters( 'dusky_single_video_height', 400 );
								
								$video = get_post_meta($post->ID, '_et_dusky_video_url', true);
								$video = $wp_embed->shortcode( '', $video );
																							
								$video = preg_replace('/<embed /','<embed wmode="transparent" ',$video);
								$video = preg_replace('/<\/object>/','<param name="wmode" value="transparent" /></object>',$video); 

								$video = preg_replace("/width=\"[0-9]*\"/", "width={$video_width}", $video);
								$video = preg_replace("/height=\"[0-9]*\"/", "height={$video_height}", $video);
								
								echo $video;
							?>
						</div> 
					<div class="meta-full-post">
						<span>Posted on <?php the_time('F j, Y'); ?> by <?php the_author_posts_link() ?></span>
					</div><!--meta-->
					<?php the_post_thumbnail('homepage-thumb', array('alt' => '', 'title' => '')) ?>
 
					<div class="full-post-content"><?php the_content(); ?></div>

					<div class="full-post-pages"><?php wp_link_pages(); ?></div>

					<div class="meta-full-post">
					This entry was posted in <?php the_category(', ') ?><br />
						<?php the_tags( 'Tags: ', ', ', ''); ?><br />
									</div>

					<div class="clearfix"></div>

			<div class="post-nav">
					 <div class="post-nav-l"><?php previous_post_link(__('&larr; %link', '<span class="meta-nav">' . '</span> %title', 'dusky')); ?></div>
					<div class="post-nav-r"><?php next_post_link( __('%link &rarr;', '%title <span class="meta-nav">' . '</span>' , 'dusky')); ?></div>
					
				</div><!-- /page links -->
			<?php comments_template( '', true ); ?>

				</div><!-- full-post -->

				<?php endwhile; ?>

			<?php endif; ?>

		</div>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>
