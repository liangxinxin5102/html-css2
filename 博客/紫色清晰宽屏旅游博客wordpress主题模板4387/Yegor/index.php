<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package web2feel
 */

get_header(); ?>
	
	<?php get_template_part( 'inc/carousal' ); ?>
	
	<div class="container"><div class="row">
	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main row" role="main">
		
		<div class="sub-feature col-md-12">
			
			<div id="slide" class="flex-slider">
					<ul class="slides">
					<?php 	
					$counts = of_get_option('w2f_slider_number');
					$slidecats =of_get_option('w2f_slider_categories');
					
					$query = new WP_Query( array( 'cat' =>$slidecats,'posts_per_page' =>$counts ) );
		           	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
		 	
				 		<li>
				 			
						<?php
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
							$image = aq_resize( $img_url, 1140, 550, true ); //resize & crop the image
						?>
						
						<?php if($image) : ?>
							<a href="<?php the_permalink(); ?>"><img class="grayscale"  src="<?php echo $image ?>"/></a>
						<?php endif; ?>
		
						<div class="flex-caption">
							<h2><?php the_title(); ?></h2>
						</div>
				<?php endwhile; endif; ?>
						    		
						</li>
					</ul>
			</div>

		</div>
		
		<div class="latest-posts">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
			<div class="clearfix"></div>
			<div class="col-md-12">
				<?php bootstrap_pagination();?>
			</div>
			

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
	</div></div>
<?php get_footer(); ?>