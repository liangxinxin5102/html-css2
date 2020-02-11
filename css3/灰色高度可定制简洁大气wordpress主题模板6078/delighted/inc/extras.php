<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package deLighted
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since 1.0
 */
 
add_filter( 'wp_page_menu_args', 'delighted_page_menu_args' );

function delighted_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since 1.0
 */
 
add_filter( 'wp_title', 'delighted_wp_title', 10, 2 );

function delighted_wp_title( $title, $sep ) {

	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= strip_tags( html_entity_decode( get_bloginfo( 'name' ) ) );

	// Add the blog description for the home/front page.
	
	$site_description = get_bloginfo( 'description', 'display' );
	
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'delighted' ), max( $paged, $page ) );

	return $title;
}
