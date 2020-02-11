<?php
/**
 * Creates a function for your featured image sizes which can be altered via your child theme
 * @package WordPress Theme
 * @since 1.0
 */
 
if ( ! function_exists( 'att_img' ) ) :
	function att_img($args){
							
		//blog entries
		if( $args == 'blog_entry_width' ) return '400';
		if( $args == 'blog_entry_height' ) return '250';
		if( $args == 'blog_entry_crop' ) return true;
		
		//blog post
		if( $args == 'blog_post_width' ) return '768';
		if( $args == 'blog_post_height' ) return '9999';
		if( $args == 'blog_post_crop' ) return false;
		
	}
endif;