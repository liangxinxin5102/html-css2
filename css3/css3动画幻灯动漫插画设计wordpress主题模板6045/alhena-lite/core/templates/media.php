<?php

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

function alhenalite_thumbnail($id,$class) {
	if ( has_post_thumbnail() ) :
		echo '<div class="'.$class.'">';
			the_post_thumbnail($id);
		echo '</div>';
	endif; 
}

?>