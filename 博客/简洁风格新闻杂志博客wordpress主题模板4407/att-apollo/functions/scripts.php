<?php
/**
 * This file loads the CSS and Javascript used for the theme.
 *
 * @package WordPress Theme
 * @since 1.0
 */
 
 
add_action('wp_enqueue_scripts','att_load_scripts');
function att_load_scripts() {
	
	
	/*******
	*** CSS
	*******************/
	
	// Main CSS
	wp_enqueue_style('style', get_stylesheet_uri() );
	
	// Google Fonts
	wp_enqueue_style('google-fonts', 'http://fonts.googleapis.com/css?family=Sintony:400,700', 'style');
	
	// Font Awesome
	wp_enqueue_style('font-awesome', ATT_CSS_DIR_UIR . '/font-awesome.min.css', 'style', true);
	
	//Responsive
	wp_enqueue_style('att-responsive', ATT_CSS_DIR_UIR .'/responsive.css');
		
	// Remove default contact 7 styling
	if( function_exists('wpcf7_enqueue_styles') ) wp_dequeue_style('contact-form-7');
	

	/*******
	*** jQuery
	*******************/
	
	
	// Responsive
	wp_enqueue_script('fitvids', ATT_JS_DIR_URI .'/fitvids.js', array('jquery'), 1.0, true);
	wp_enqueue_script('uniform', ATT_JS_DIR_URI .'/uniform.js', array('jquery'), '1.7.5', true);
	wp_enqueue_script('att-responsive', ATT_JS_DIR_URI .'/responsive.js', array('jquery'), '', true);

	// Comment replies
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script('comment-reply');
	}
	
	// Localize responsive nav
	$nav_params = array(
		'text' => __('Navigation','att'),
	);
	wp_localize_script( 'att-responsive', 'navLocalize', $nav_params );
	
	// Initialize
	wp_enqueue_script('att-global-init', ATT_JS_DIR_URI .'/initialize.js', false, '1.0', true);

	
} //end att_load_scripts()


/**
* Browser Specific CSS
* @Since 1.0
*/
add_action('wp_head', 'att_browser_dependencies_css');
if ( !function_exists('att_browser_dependencies_css') ) :
	function att_browser_dependencies_css() {
		echo '<!-- Custom CSS For IE -->';
		echo '<!--[if gte IE 9]><style type="text/css">.gradient {filter: none;}</style><![endif]-->';		
		echo '<!--[if IE 8]><link rel="stylesheet" type="text/css" href="'. ATT_CSS_DIR_UIR .'/ie8.css" media="screen" /><![endif]-->';
		echo '<!--[if IE 7]><link rel="stylesheet" type="text/css" href="'. ATT_CSS_DIR_UIR .'/font-awesome-ie7.min.css" media="screen" /><![endif]-->';
		echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->';
	}
endif;