<?php
/**
 * Function used to alter the ammount of posts per page
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

// Get posts per page
$att_option_posts_per_page = get_option( 'posts_per_page' );

// Add posts per page filter
add_action( 'init', 'att_modify_posts_per_page', 0);
function att_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'att_option_posts_per_page' );
}

// Modify posts per page
if ( !function_exists('att_option_posts_per_page') ) :
	function att_option_posts_per_page( $value ) {
		
		global $att_option_posts_per_page;
		
		if ( is_tax( 'portfolio_category') || is_tax( 'portfolio_tag') || is_post_type_archive( 'portfolio') ) {
			return of_get_option( 'portfolio_pagination','-1' );
		}
		
		else { return $att_option_posts_per_page; }
	}
endif;
?>