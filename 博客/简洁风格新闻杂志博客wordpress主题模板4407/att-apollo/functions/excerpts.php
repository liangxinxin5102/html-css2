<?php
/**
* Change default read more style
* @since 1.0
*/
if ( !function_exists( 'att_excerpt_more' ) ) :
	function att_excerpt_more($more) {
		global $post;
		return '...';
	}
	add_filter('excerpt_more', 'att_excerpt_more');
endif;




/**
* Change default excerpt length
* @since 1.0
*/
if ( !function_exists( 'att_custom_excerpt_length' ) ) :
	function att_custom_excerpt_length( $length ) {
		return att_option('excerpt_length','25');
	}
	add_filter( 'excerpt_length', 'att_custom_excerpt_length', 999 );
endif;