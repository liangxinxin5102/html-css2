<?php get_header(); ?>

<div id="content">
<div id="contentinner">

<div id="post-entry">
<?php 

$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
 'paged' => $current_page
);
$query2 = new WP_Query($args);?>
<?php while($query2->have_posts()){ $query2->the_post(); ?>
<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <div class="post-meta"> 
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

<!--<div class="post-date"><?php the_time('j F G:i') ?></div>-->
<!-- <a class="readmore" href="<?php the_permalink() ?>#more" class="more-link"><?php _e('Read more', 'columnist'); ?></a>-->
</div>
</div><!-- POST META END -->

<?php }  

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