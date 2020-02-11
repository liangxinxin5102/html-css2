<?php get_header(); ?>

		<!-- begin main -->
		<section class="main">
		
			<!-- begin .col-left -->
			<div class="col-left">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!-- begin .post -->
				<article <?php post_class(); ?>>

					<h1><?php the_title(); ?></h1>
					
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

					<?php the_content(); ?>
					
					 <?php the_tags('<span class="post-tags icon-tag"> Tags: ', ', ', '</span>'); ?> 

					<?php endwhile; ?>
					<?php comments_template(); ?>

				</article>
				<!-- end .post -->

				<?php endif;?>
			
			</div>
			<!-- end colleft -->
			
			<?php get_sidebar(); ?>
			
		</section>
		<!-- end main -->

<div class="clear"></div>
<?php get_footer(); ?>