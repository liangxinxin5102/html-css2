<?php get_header(); ?>

<div id="content">
<div id="contentinner">


<div id="post-entry">

<?php $postcounter = 0; if (have_posts()) : ?>

<?php while (have_posts()) : $postcounter = $postcounter + 1; the_post(); ?>

<div class="post-meta" id="post-<?php the_ID(); ?>">
<?php if (!is_sticky()) { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(225,9999), array('class' => 'aligncenter')); ?></a></div><div class="cat"><?php the_category(', ') ?></div><div class="tim"><?php the_time('M j')?></div>
<?php } else { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(464,9999), array('class' => 'aligncenter')); ?></a></div><div class="cat"><?php the_category(', ') ?></div><div class="tim"><?php the_time('M j')?></div>
<?php } ?>
<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php fancier_short_feat_title(); ?></a></h2>
<div class="post-author">
						Posted by <?php the_author() ?></div>
<hr>

<div class="post-content"><a href="<?php the_permalink(); ?>"><?php fancier_the_post_excerpt($excerpt_length=25); ?></a></div>

</div><!-- POST META <?php the_ID(); ?> END -->

<?php endwhile; ?>

<?php else : ?>



<p class="center"><?php _e( 'Sorry but nothing matched your search criteria. Please try again with some different keywords.', 'fancier' ); ?></p>

<?php endif; 
wp_reset_postdata();  ?>
	<div class="clearfix"></div>
				<div class="posts-navigation">
					<div class="posts-navigation-next"><?php next_posts_link(esc_html__('Previous','fancier')) ?></div>
					<div class="posts-navigation-prev"><?php previous_posts_link(esc_html__('Next', 'fancier')) ?></div>
					<div class="clearfix"></div>
				</div>
</div><!-- POST ENTRY END -->



</div><!-- CONTENTINNER END -->
</div><!-- CONTENT END -->




<?php get_footer(); ?>