<?php

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

function alhenalite_general_function() {
	
	get_template_part( 'core/post-formats/general' );

}

add_action( 'alhenalite_general','alhenalite_general_function', 10, 2 );

?>