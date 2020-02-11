<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package web2feel
 * @since web2feel 1.0
 */
?>
		<div id="secondary" class="widget-area grid_2" role="complementary">
			<div class="searchbox">
				<?php get_search_form(); ?>
				<ul class="social-links cf">
												<li> <a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to our RSS feed.">
				   <img src="<?php bloginfo('template_directory'); ?>/images/feed.png" alt="Subscribe to our RSS feed." />
				 </a> </li>
												<li> <a href="http://twitter.com/home/?status=<?php the_title(); ?> : <?php the_permalink(); ?>" title="Tweet this!">
				 <img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="Tweet this!" />
				</a></li>
												<li> <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="StumbleUpon.">
				 <img src="<?php bloginfo('template_directory'); ?>/images/stumbleupon.png" alt="StumbleUpon" />
				</a></li>
												<li> <a href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Vote on Reddit.">
				 <img src="<?php bloginfo('template_directory'); ?>/images/reddit.png" alt="Reddit" />
				</a></li>
												<li> <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;amp;t=<?php the_title(); ?>" title="Share on Facebook.">
				 <img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="Share on Facebook" id="sharethis-last" />
				</a></li>
												<li> <a href="http://digg.com/submit?phase=2&amp;amp;url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Digg this!">
				 <img src="<?php bloginfo('template_directory'); ?>/images/digg.png" alt="Digg This!" />
				</a></li>
														<li> <a href="http://del.icio.us/post?url=<?php the_permalink();?>&amp;amp;title=<?php the_title(); ?>" title="Submit to  delicious.">
				 <img src="<?php bloginfo('template_directory'); ?>/images/delicious.png" alt="Submit to delicious" />
				</a></li>
				
											</ul>
				
			</div>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<?php endif; // end sidebar widget area ?>
			<?php get_template_part( 'sponsors' ); ?>
		</div><!-- #secondary .widget-area -->

