<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package web2feel
 
 Template name:Homepage
 */

get_header(); ?>

<div class="subhead">
	<div class="subinner"><div class="container"><div class="row">
	
		<div class="col-md-12 wednames">
			<?php echo of_get_option('w2f_bfname',''); ?> <?php _e('weds','web2feel'); ?>  <?php echo of_get_option('w2f_gfname',''); ?>
			<span> <?php echo of_get_option('w2f_wed_location',''); ?> </span>
		</div>
		
		<div class="col-md-6">
			<div class="bridecol">
				<div class="bridepic">
					<?php $bridcl = of_get_option('w2f_brideclose',''); ?>
					<?php $bridclose = aq_resize( $bridcl, 180, 180, true ); ?>
					<img src="<?php echo $bridclose ?>" alt="bride" />
				</div>
				
				<div class="brideinfo">
					<h3> <?php echo of_get_option('w2f_bfname',''); ?> <?php echo of_get_option('w2f_blname',''); ?></h3>
					<p> <?php echo of_get_option('w2f_blocation',''); ?></p>
				</div>
					<div class="cplus glyphicon glyphicon-heart"> </div>
			</div>
		
		</div>
		
		<div class="col-md-6">
			<div class="groomcol">
				<div class="groompic">
					<?php $groomcl = of_get_option('w2f_groomclose',''); ?>
					<?php $groomclose = aq_resize( $groomcl, 180, 180, true ); ?>
					<img src="<?php echo $groomclose ?>" alt="groom" />
				</div>
				<div class="groominfo">
					<h3> <?php echo of_get_option('w2f_gfname',''); ?> <?php echo of_get_option('w2f_glname',''); ?> </h3>
					<p> <?php echo of_get_option('w2f_glocation',''); ?></p>
				</div>
			</div>
		</div>
		
	</div></div></div>
</div>

<div class="timer-box">
	
	<div class="container"><div class="row">
		<div class="col-md-12">
		<h2 class="timehead"> We are Getting Married in  </h2>
		
		<div id="ctimer">
		    <span class="cblock"> <h3> %w </h3> weeks </span>
		    <span class="cblock"> <h3> %d </h3> days </span>
		    <span class="cblock"> <h3> %H </h3> hours </span>

		</div>
		</div>
	</div></div>
</div>

<div class="story-box">
	<div class="container"><div class="row">
		
		<div class="col-xs-12">
			<h2 class="section-title"> Our Story </h2>
		
		</div>
	
		<div class="col-sm-6">
			<div class="dstory">
			
				<?php $brim = of_get_option('w2f_bridepic',''); ?>
				<?php $brimg = aq_resize( $brim, 720, 360, true ); ?>
				<img src="<?php echo $brimg ?>" alt="bride" />
				<h3><?php echo of_get_option('w2f_bfname',''); ?></h3>
				<p><?php echo of_get_option('w2f_bstory',''); ?></p>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="dstory">
				<?php $grim = of_get_option('w2f_groompic',''); ?>
				<?php $grimg = aq_resize( $grim, 720, 360, true ); ?>
				<img src="<?php echo $grimg ?>" alt="groom" />
				<h3><?php echo of_get_option('w2f_gfname',''); ?></h3>
				<p><?php echo of_get_option('w2f_gstory',''); ?></p>
			</div>
		</div>
	</div></div>
</div>

<div class="album-box">

	<div class="container"><div class="row">
	
		<div class="col-xs-12">
			<?php $albumlink = of_get_option('w2f_album_page',''); ?>
			<h2 class="section-title"> Photo Album <span> <a href="<?php echo get_page_link($albumlink); ?>">View Full Album</a></span> </h2>
		</div>
		
		<div class="albumcover">
			
				<?php
								
				$args = array (	
					'post_type'=>'photo',
					'posts_per_page'=> '6',
					);
					
					// The Query
					$query = new WP_Query( $args );
					
					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post(); ?>
							
							<div class="col-md-4 album-post">
									<?php
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
							$image = aq_resize( $img_url, 720, 480, true ); //resize & crop the image
						?>
						
						<?php if($image) : ?>
							<a href="<?php the_permalink(); ?>"><img class="img-responsive"  src="<?php echo $image ?>"/></a>
						<?php endif; ?>
							</div>
							
						<?php }
					} else {
						// no posts found
					}
					
					// Restore original Post Data
					wp_reset_postdata();
				?>
			
		</div>	
			
	</div></div>
</div>

<div class="blog-box">

	<div class="container"><div class="row">
	
		<div class="col-md-12">
			<?php $bloglink = of_get_option('w2f_blog_page',''); ?>
			<h2 class="section-title"> Blog <span> <a href="<?php echo get_page_link($bloglink); ?>">Check Our Blog</a></span>  </h2>
		</div>
		
		<div class="blogcover clearfix">
							<?php
				
			
				$args = array (	
					 'posts_per_page'=> '2',
					 'cat' => -$album_cat,
					 
					);
					
					// The Query
					$query = new WP_Query( $args );
					
					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post(); ?>
							
							<div class="col-md-6 home-post">
									<?php
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
							$image = aq_resize( $img_url, 720, 360, true ); //resize & crop the image
						?>
						
						<?php if($image) : ?>
							<a href="<?php the_permalink(); ?>"><img class="img-responsive"  src="<?php echo $image ?>"/></a>
						<?php endif; ?>
						<h3><?php the_title(); ?></h3>
						
							<?php the_excerpt(); ?>
						
							</div>
							
						<?php }
					} else {
						// no posts found
					}
					
					// Restore original Post Data
					wp_reset_postdata();
				?>
		</div>
		
	</div></div>
</div>

<?php get_footer(); ?>
