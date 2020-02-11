<?php
/**
 * This file is used for all excerpt related functions
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
*/



/**
 * Custom excerpts based on wp_trim_words
 * Created for child-theming purposes
 * 
 * Learn more at http://codex.wordpress.org/Function_Reference/wp_trim_words
 *
 * @since 1.0
*/
if ( !function_exists( 'att_excerpt' ) ) :
	function att_excerpt($length=30, $readmore=false ) {
		global $post;
		$id = $post->ID;
		if ( has_excerpt( $id ) ) {
			$output = $post->post_excerpt;
		} else {
			$output = wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length);
			if ( $readmore == true ) {
				$readmore_link = '<a href="'. get_permalink( $id ) .'" title="'. __('continue reading', 'att' ) .'" rel="bookmark" class="readmore-link">'. __('continue reading', 'att' ) .' &rarr;</a>';
				$output .= apply_filters( 'att_readmore_link', $readmore_link );
			}
		}
		echo $output;
	}
endif;

/**
* Change default read more style
* @since 1.0
*/
if ( !function_exists( 'att_excerpt_more' ) ) :
	function att_excerpt_more($more) {
		global $post;
		return '...';
	}
	add_filter( 'excerpt_more', 'att_excerpt_more' );
endif;

/**
* Change default excerpt length
* @since 1.0
*/
if ( !function_exists( 'att_custom_excerpt_length' ) ) :
	function att_custom_excerpt_length( $length ) {
		return of_get_option( 'excerpt_length','50' );
	}
	add_filter( 'excerpt_length', 'att_custom_excerpt_length', 999 );
endif;
?>