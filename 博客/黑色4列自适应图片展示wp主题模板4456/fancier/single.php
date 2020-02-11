<?php get_header(); ?>

<div id="content">
<div id="contentinner">

<div id="post-entry-single">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
<span><?php the_category(' &raquo; ', 'fancier'); ?></span> 
<div class="post-meta-single" id="post-<?php the_ID(); ?>">
<div id="conte">
<div class="cont-wrap">
<div class="post-info-left">
<?php if ( has_post_thumbnail() ) { ?>
<div class="thumb"><?php the_post_thumbnail('squareThumb'); ?>
<div class="cat"><?php the_category(', ') ?></div><div class="tim"><?php the_time('M j')?></div></div>
<?php } else { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/top-default1.jpg" alt="<?php the_title(); ?>" class="aligncenter" /><div class="cat"><?php the_category(', ') ?></div><div class="tim"><?php the_time('M j')?></div></a></div>
<?php } ?>
<h4><?php _e( 'Tags', 'fancier'); ?></h4>
  <?php if (get_the_tag_list()) : ?>  
  <div class="taggs">  
<?php echo get_the_tag_list('',' ',''); ?>
  </div>  
  <?php endif; ?>

</div>
<div class="post-contain">
<div class="post-info">
<h1><?php the_title(); ?></h1>
<div class="post-date" style="padding-top:0px">Posted by <?php the_author() ?> on <?php the_time('F j, Y') ?> in <?php the_category(', ') ?> | <?php comments_number('No Comments', 'One Comment', '% Comments' ); ?></div><!-- POST DATE END -->
<hr>

</div><!-- POST INFO END -->
<div class="post-content">
<?php the_content(); ?>
<div class="clearfix"></div>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
</div>
</div>
</div>
<div class="clearfix"></div>
			<div class="post-nav">
					 <div class="post-nav-l"><?php previous_post_link(__('Previous post <br/> %link', '<span class="meta-nav">' . '</span> %title', 'fancier')); ?></div>
					<div class="post-nav-r"><?php next_post_link( __('Next post <br/> %link', '%title <span class="meta-nav">' . '</span>' , 'fancier')); ?></div>
				</div><!-- /page links -->
<div class="clearfix"></div>


<div class="single-com"><?php comments_template( '', true ); ?></div>
</div><!-- POST CONTENT END -->
</div><!-- POST META <?php the_ID(); ?> END -->

<?php endwhile; 
wp_reset_postdata();  ?>



<?php else : ?>



<p class="center"> <?php _e( 'Sorry but nothing matched your search criteria. Please try again with some different keywords.', 'fancier' ); ?></p>

<?php endif; ?>

</div><!-- POST ENTRY END -->






<?php get_sidebar(); ?>


<?php get_footer(); ?>