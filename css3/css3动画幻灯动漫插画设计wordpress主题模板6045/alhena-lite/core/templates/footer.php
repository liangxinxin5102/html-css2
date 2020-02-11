<?php

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

/*-----------------------------------------------------------------------------------*/
/* Socials */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_socials_function() {
	
	$socials = array ("facebook","twitter","flickr","google","linkedin","myspace","pinterest","tumblr","youtube","vimeo","skype","email");
	
	foreach ( $socials as $social ) 
	
	{
		if (alhenalite_setting('wip_footer_'.$social.'_button')): 
		if ($social == "email") $email = "mailto:"; else $email = "";
		if ($social == "skype") $skype = "skype:"; else $skype = "";
            echo '<a href="'.$email.$skype.alhenalite_setting('wip_footer_'.$social.'_button').'" target="_blank" title="'.$social.'" class="social '.$social.'"> '.$social.'  </a> ';
		endif;
	}
	
	if (alhenalite_setting('wip_footer_rss_button') == "on"): 
    	echo '<a href="'; bloginfo('rss2_url'); echo '" title="Rss" class="social rss"> Rss  </a> ';
	endif; 
}

add_action( 'alhenalite_socials', 'alhenalite_socials_function', 10, 2 );


?>