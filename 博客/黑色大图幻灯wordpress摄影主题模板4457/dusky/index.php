<?php 
$dusky_settings = get_option( 'dusky_options');
get_header(); ?>

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

	<?php 
	include get_template_directory() . '/featured-posts.php'; ?>
	<div class="clearfix"></div>
		<div id="content">

		<div id="posts">
	

	<?php 	if ( $dusky_settings['dusky_show_video_posts'] == 1 ) {
	include get_template_directory() . '/video-post.php'; ?>
	<div class="clearfix"></div>
	<?php 	} ?>
			
	<div class="braun-back"><h3><?php _e('Recent articles', 'dusky'); ?></h3></div>

			<?php $format = get_post_format();  
get_template_part( 'format', $format );  
$query5 = new WP_Query( array(
 'posts_per_page' => 6,
 'paged' => get_query_var('paged'),
 'tax_query' => array(
		array(
		'taxonomy' => 'post_format',
		'field'    => 'slug',
		'terms'    => array( 'post-format-video'),
		'operator' => 'NOT IN',
		
		)
	 )
));
while($query5->have_posts()){ $query5->the_post();  ?>		

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

			<?php 
		
	 } 
	wp_reset_postdata();  
		?>

				<div class="posts-navigation">
					<div class="posts-navigation-next"><?php next_posts_link(esc_html__('Next','dusky')) ?></div>
					<div class="posts-navigation-prev"><?php previous_posts_link(esc_html__('Previous', 'dusky')) ?></div>
					
					<div class="clearfix"></div>
				</div>

	

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
