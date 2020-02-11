<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'photobook' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php get_template_part( 'loop-cat', 'search' ); ?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'photobook' ); ?></h1>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'photobook' ); ?></p>
						
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
