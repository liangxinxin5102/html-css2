<?php get_header(); ?>

	<div id="wrapper-main">
	  <div id="container">  
	<div id="content">
			<div class="content-inside">
				<div class="top-navigation"><h1>Home</h1></div>
	<div id="slideshow_cont">
  
        <div id="slideshow">       

            <?php  

            $slider_arr = array();

            $x = 0;

            $args = array(

                         //'category_name' => 'blog',

                         'post_type' => 'post',

                         'meta_key' => 'ex_show_in_slideshow',

                         'meta_value' => 'Yes',

                         'posts_per_page' => 10

                         );

            query_posts($args);

            while (have_posts()) : the_post(); ?>         

            <div class="slide_cont <?php if($x == 0) { ?>active<?php } ?>">

                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-slideshow'); ?></a>               

            </div><!--//slide_cont-->

            <?php array_push($slider_arr,get_the_ID()); ?>

            <?php $x++; ?>

            <?php endwhile; ?>  

            <?php wp_reset_query(); ?>                       

            <img src="<?php echo get_template_directory_uri(); ?>/images/slide-prev.png" class="slide_prev" />

            <img src="<?php echo get_template_directory_uri(); ?>/images/slide-next.png" class="slide_next" />            

        </div><!--//slideshow-->

    </div><!--//slideshow_cont-->
<div class="single-post-index">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="single-post" id="post-<?php the_ID(); ?>"> 
										<p class="publish-date"><span class="publish-day"><?php the_time( 'd' ) ?></span> <span class="publish-month"><?php the_time( 'M' ) ?></span> <span class="publish-year"><?php the_time( 'Y' ) ?></span></p>
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<div class="meta">
							
							 <?php _e('Author', 'greenpage'); ?>: <?php the_author_link(); ?> | 
							 <?php _e('Category', 'greenpage'); ?>: <?php the_category(', '); ?> |  
							<?php _e('Tags', 'greenpage'); ?>: <?php echo get_the_tag_list('',', ',''); ?>							 
						
						</div><!--meta-->
			
						<div class="single-post-content">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('squareThumb', array('alt' => '', 'title' => '')) ?></a>
					

						
						<?php global $more; $more = 0; ?><?php the_excerpt(); ?></div>

				<div class="continue-reading">
          <p class="full-article"><a href="<?php echo get_permalink(); ?>"><?php _e( 'Read More', 'greenpage' ); ?></a> <?php if ( comments_open() ) : ?><a class="article-comments" href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a><?php endif; ?></p>
        </div>
		
											<div class="clearfix"></div>

				</div><!-- single-post -->

				<?php endwhile; ?>

				<div class="posts-navigation">
					<div class="posts-navigation-prev"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'greenpage' ) ); ?></div>
					<div class="posts-navigation-next"> <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'greenpage' ) ); ?></div>
			
					<div class="clearfix"></div>
				</div>

			<?php endif; ?>
</div>
 </div>
<?php get_sidebar(); ?>
	</div>
</div>
  </div><!-- end of wrapper-main -->
<?php get_footer(); ?>
