<?php
/**
 * Create an array of social services
 * @package WordPress Theme
 * @since 1.0
 */


if ( !function_exists('att_social_links') ) {
	function att_social_links() {
		$social_icons = array( 
			'twitter' => 'twitter',
			'facebook' => 'facebook',
			'google' => 'google',
			'dribbble' => 'dribbble', 
			'behance' => 'behance',
			'lastfm' => 'lastfm',
			'linkedin' => 'linkedin',
			'pinterest' => 'pinterest',
			'tumblr' => 'tumblr',
			'vimeo' => 'vimeo',
			'youtube' => 'youtube',
			'behance' => 'behance',
			'yahoo' => 'yahoo',
			'flickr' => 'flickr',
			'picasa' => 'picasa',
			'forrst' => 'forrst',
			'yelp' => 'yelp',
			'rss' => 'rss' );
		return apply_filters('att_social_links', $social_icons);
	}
}




/**
 * Output a nice social list
 * @package WordPress Theme
 * @since 1.0
 */
if ( !function_exists('att_display_social') ) {
	function att_display_social() {
		
		$output = '<ul id="header-social">';
			$att_social_links = att_social_links();
				foreach( $att_social_links as $social_link ) {
					if( att_option( $social_link ) ) {
					$output .= '<li><a href="'. att_option( $social_link ) .'" title="'. $social_link .'" target="_blank"><img src="'. get_template_directory_uri() .'/images/social-alt/'.$social_link.'.png" alt="'. $social_link .'" /></a></li>';
					}
				}
		$output .= '</ul><!-- #header-social -->';
		
		echo $output;
	}
}