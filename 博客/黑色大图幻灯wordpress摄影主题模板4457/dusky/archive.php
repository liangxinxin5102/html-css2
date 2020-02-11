<?php get_header(); ?>

	<div id="content">

		<div id="posts">

			<?php if (have_posts()) : ?>

				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
					<div class="search-results"><h2><?php single_cat_title(); ?></h2></div>
				<?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
					<div class="search-results"><h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;:</h2></div>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<div class="search-results"><h2>Archive for <?php the_time('F jS, Y'); ?>:</h2></div>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<div class="search-results"><h2>Month: <?php the_time('F, Y'); ?></h2></div>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<div class="search-results"><h2>Archive for <?php the_time('Y'); ?>:</h2></div>
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<div class="search-results"><h2>Author Archive:</h2></div>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<div class="search-results"><h2>Blog Archives:</h2></div>
				<?php } ?>

				<?php while (have_posts()) : the_post(); ?>

				<div class="single-post" id="post-<?php the_ID(); ?>"> 

					<div class="single-post-text"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('homepage-thumb', array('alt' => '', 'title' => '')) ?></a>
					

						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php if (trim(get_the_title()) != '') { the_title(); } else  _e('No title', 'dusky'); ?></a></h2>
						<div class="meta">Posted on <?php the_time('F j, Y'); ?> by <?php the_author_posts_link() ?></div>
						<div class="single-post-content"><?php the_excerpt() ?></div>

						<div class="meta" style="width:600px">Posted in <?php the_category(', ');?> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
						</div><!--meta-->

					</div><!-- single-post-text -->
					<div class="clearfix"></div>

				</div><!-- single-post -->

				<?php endwhile; ?>

				<div class="posts-navigation">
					<div class="posts-navigation-next"><?php next_posts_link(esc_html__('Next','dusky')) ?></div>
					<div class="posts-navigation-prev"><?php previous_posts_link(esc_html__('Previous', 'dusky')) ?></div>
					
					<div class="clearfix"></div>
				</div>

			<?php endif; ?>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
