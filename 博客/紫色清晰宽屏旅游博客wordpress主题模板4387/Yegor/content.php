<?php
/**
 * @package web2feel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6'); ?>>

		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 720, 400, true ); //resize & crop the image
		?>
					
		<?php if($image) : ?>
		<a href="<?php the_permalink(); ?>"> <img class="img-responsive post-image" src="<?php echo $image ?>"/></a>
		<?php endif; ?>	

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="entry-meta"> <?php _e( 'Posted on', 'web2feel' ); ?> <?php the_time('jS F Y') ?> <?php _e( 'by', 'web2feel' ); ?> <?php the_author(); ?> </div>

	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	

</article><!-- #post-## -->
