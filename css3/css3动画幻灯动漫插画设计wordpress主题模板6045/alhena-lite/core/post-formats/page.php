<?php 

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

alhenalite_thumbnail('blog','pin-container'); ?>
    
<article class="article">
	
	<?php 
		
		alhenalite_get_title();
		the_content(); 

		if (alhenalite_setting('wip_view_comments') == "on" ) :
			comments_template();
		endif;

	?>

</article>