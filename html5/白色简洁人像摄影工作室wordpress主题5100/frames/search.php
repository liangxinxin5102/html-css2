<?php get_header(); ?>

		<!-- begin main -->
		<section class="main">

			<h2><?php _e('Search Results','site5framework') ?>: <?php the_category(', '); ?></h2>

			<?php if (have_posts()) : $count = 0; ?>

			<?php while (have_posts()) : the_post(); $count++; global $post; ?>

			<!-- begin .post -->
			<article <?php post_class(); ?>> 

					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>				

					<?php if(of_get_option('posts_layout') == 'pexcerpt') { ?>
						<?php
						global $more;
	        			$more = 0;
	        			the_excerpt(100); ?>
        			<?php } else { ?>
						<?php the_content(__('Read More','site5framework'));  ?>
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
			
		</section>
		<!-- end section -->

		<?php endif; ?>

<div class="clear"></div>

<?php get_footer(); ?>