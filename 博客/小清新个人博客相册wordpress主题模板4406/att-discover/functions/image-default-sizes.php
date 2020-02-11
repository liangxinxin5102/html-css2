<?php
/**
 * Defines your featured image sizes which can be altered via your child theme
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
*/
 
if ( ! function_exists( 'att_img' ) ) :

	function att_img($args){
		
		//blog post and entries
		if ( $args == 'blog_width' ) return '650';
		if ( $args == 'blog_height' ) return '9999';
		if ( $args == 'blog_crop' ) return false;
		
		//portfolio entries
		if ( $args == 'port_entry_width' ) return '370';
		if ( $args == 'port_entry_height' ) return '300';
		if ( $args == 'port_entry_crop' ) return 'false';
		
		//portfolio posts
		if ( $args == 'port_post_width' ) return '550';
		if ( $args == 'port_post_height' ) return '455';
		if ( $args == 'port_post_crop' ) return 'false';
		
	}
endif;
?>