<?php
/**
 * The Template for displaying all single posts.
 *
 * @package web2feel
 */

get_header(); ?>
<div class="subhead">
		<div class="col-md-12 wednames">
			<?php the_title(); ?>
		</div>
</div>
<div class="container"> <div class="row"> 
	<div id="primary" class="content-area col-md-12">
		<main id="main" class="site-main row" role="main">
		
		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php 
		
		$gallery = get_post_gallery( $post, false );
		$ids = explode( ",", $gallery['ids'] );

		foreach( $ids as $id ) {

			$link   = wp_get_attachment_url( $id );
			$img_url  = wp_get_attachment_url( $id, "large");
			$image = aq_resize( $img_url, 750, 500, true ); ?>
			<!-- echo( "<div class='item col-md-4'><a href='$link'>" .$img_url . "</a></div>" ); -->
			<div class='col-md-4 album-pic'>
				<a rel="prettyPhoto[pp_gal]"  href='<?php echo $link?>'> <img src="<?php echo $image; ?>" /> </a>
			</div>
			

		<?php } 	?>
		<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->


</div></div>
<?php get_footer(); ?>