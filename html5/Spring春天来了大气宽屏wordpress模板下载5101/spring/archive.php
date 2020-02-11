<?php get_header(); ?>

		<section class="main">
			
			<h2><?php _e('Archive','site5framework') ?>: <?php the_category(', '); ?></h2>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<!-- begin .post -->
			<article <?php post_class(); ?>>

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

				<?php the_content(); ?>
				
			</article>
			<!-- end .post -->

			<?php endwhile; ?>
			<div class="navigation">
		        <div class="alignleft"><?php next_posts_link('Older') ?></div>
		        <div class="alignright"><?php previous_posts_link('Newer') ?></div>
		      </div>
			<?php endif;?>
		</section>

<div class="clear"></div>
<?php get_footer(); ?>