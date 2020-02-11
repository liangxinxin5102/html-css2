<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div class="post_title">
					<h1 class="entry-title" style="padding-bottom:0px"><?php the_title(); ?></h1>
				<?php the_post_thumbnail(array(720,9999), array('class' => 'aligncenter')); ?>	

				</div>

				<div id="wides"></div>		
			
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'photobook' ), 'after' => '</div>' ) ); ?>

									<div class="clear"></div>

							<div class="entry-utility">
							<?php the_tags(); ?> 
								
							</div><!-- .entry-utility -->
				
				<!-- #post-## -->
<div class="post-nav">
					 <div class="post-nav-l"><?php previous_post_link(__('Previous post <br/> %link', '<span class="meta-nav">' . '</span> %title', 'photobook')); ?></div>
					<div class="post-nav-r"><?php next_post_link( __('Next post <br/> %link', '%title <span class="meta-nav">' . '</span>' , 'photobook')); ?></div>
				</div><!-- /page links -->
			<?php comments_template( '', true ); ?>

<?php endwhile; ?>


				
