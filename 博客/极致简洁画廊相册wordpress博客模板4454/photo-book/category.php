<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main" style="margin-left:0px">

				<h1 class="page-title"><?php
					printf( __( '%s', 'photobook' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

					get_template_part( 'loop-cat', 'category' );
				?>

			</div><!-- #content -->
		</div><!-- #container -->
		<?php get_sidebar(); ?>
<?php get_footer(); ?>
