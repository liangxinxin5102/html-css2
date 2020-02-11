<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package fabthemes
 * @since fabthemes 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area grid_8">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

	
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<div class="paginate ">
					<?php kriesi_pagination(); ?>
				</div>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>