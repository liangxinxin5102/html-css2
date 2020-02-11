<?php 

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

function alhenalite_after_content_function() {

	if ((is_home()) || (is_category()) || (is_page() )):
		
		the_excerpt(); 
	
	else:
	
		the_content();
		the_tags( '<footer class="post-tags"><div class="line"><span class="entry-info"><strong>Tags:</strong> ', ', ', '</span></div></footer>' );

		if (alhenalite_setting('wip_view_comments') == "on" ) :
			comments_template();
		endif;

		echo '<div class="post-pagination">';
		
		previous_post_link( '%link', _x( '&larr; %title', 'Previous post', 'wip' ) ); 
		next_post_link( '%link', _x( '%title &rarr;', 'Next post', 'revised' ) );

		echo '</div>';


	endif;

} 

add_action( 'alhenalite_after_content', 'alhenalite_after_content_function', 10, 2 );

?>