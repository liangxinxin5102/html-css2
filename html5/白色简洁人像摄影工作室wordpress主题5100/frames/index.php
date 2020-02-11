<?php get_header(); ?>

		<!-- begin main -->
		<section class="main">
		
			<!-- begin .col-left -->
			<div class="col-left">

			<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); global $post; ?>

			<!-- begin .post -->
			<article <?php post_class(); ?>>

				<?php if(of_get_option('posts_layout') == 'pexcerpt') { ?>
				
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					
					<!-- begin .post-meta -->
					<div class="meta">
						<span class="post-author"><em><?php _e('by','site5framework') ?></em> <?php the_author_posts_link(); ?></span>
						<span class="post-category"><em><?php _e('in','site5framework') ?></em> <?php the_category(', '); ?></span>
						<span class="post-date"> | <?php echo get_the_date(M); ?> <?php echo get_the_date(d); ?>, <?php echo get_the_date(Y); ?></span>  | 
						<span class="post-comments"><a href="<?php echo get_comments_link() ?>"><?php $comments_count = get_comments_number( $post_id ); echo $comments_count; ?> Comments</a></span>
					</div>
					<!-- end .post-meta -->
					

					<div class="post-excerpt">
						<!-- begin .post-thumb -->
						<?php if(has_post_thumbnail()): the_post_thumbnail('thumbnail', array('class'=>'alignleft')); else: ?><?php endif; ?>
						<!-- end .post-thumb -->
						
						<?php
						global $more;
	        			$more = 0;
	        			the_excerpt(); ?>
        			</div>

				<?php } else { ?>
				
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					
					<!-- begin .post-meta -->
					<div class="meta">
						<span class="post-author"><em><?php _e('by','site5framework') ?></em> <?php the_author_posts_link(); ?></span>
						<span class="post-category"><em><?php _e('in','site5framework') ?></em> <?php the_category(', '); ?></span>
						<span class="post-date"> | <?php echo get_the_date(M); ?> <?php echo get_the_date(d); ?>, <?php echo get_the_date(Y); ?></span>  | 
						<span class="post-comments"><a href="<?php echo get_comments_link() ?>"><?php $comments_count = get_comments_number( $post_id ); echo $comments_count; ?> Comments</a></span>
					</div>
					<!-- end .post-meta -->

					<!-- begin .post-thumb -->
					<div class="post-thumb">
						<?php if(has_post_thumbnail()): the_post_thumbnail('large', array('class'=>'blog-thumb')); else: ?><?php endif; ?>
					</div>
					<!-- end .post-thumb -->
					

					<div class="post-content">
						<?php
						global $more;
	        			$more = 0;
	        			the_content(__('Read More','site5framework')); ?>
        			</div>

				<?php } ?>

			</article>
			<!-- end .post -->

			<?php endwhile; ?>

			<!-- begin #pagination -->
			<?php if (function_exists("emm_paginate")) {
					emm_paginate();
				 } else { ?>
			<div class="navigation">
		        <div class="alignleft"><?php next_posts_link('Older') ?></div>
		        <div class="alignright"><?php previous_posts_link('Newer') ?></div>
		    </div>
		    <?php } ?>
	    	<!-- end #pagination -->
			
			<?php endif;?>

			</div>
			<!-- end colleft -->
			
			<?php get_sidebar(); ?>
			
		</section>
		<!-- end main -->

<div class="clear"></div>
<?php get_footer(); ?>