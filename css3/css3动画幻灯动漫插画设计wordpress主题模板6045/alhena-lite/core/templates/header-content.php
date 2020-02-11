<?php 

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

function alhenalite_header_content_function() { 

	if ( alhenalite_postmeta('wip_slogan') ) : ?>
	
	<!-- START SLOGAN  -->
	
	<section id="slogan" >
		<div class="container">
			<div class="row">
				<div class="span12">
					<p> <?php echo alhenalite_postmeta('wip_slogan'); ?> </p>
				</div>
			</div>
		</div>
	</section>
	
	<!-- END SLOGAN -->
	
<?php endif; ?>

	<?php if ( is_active_sidebar('top_sidebar_area')) : ?>
    
	<!-- TOP WIDGET -->

	<section id="top-box" >
		<div class="container">
			<div class="row">

			<?php dynamic_sidebar('top_sidebar_area'); ?>

			</div>
		</div>
	</section>

	<!--  END TOP WIDGET -->

<?php
	
	endif;
	
} 

add_action( 'alhenalite_header_content', 'alhenalite_header_content_function', 10, 2 );

?>