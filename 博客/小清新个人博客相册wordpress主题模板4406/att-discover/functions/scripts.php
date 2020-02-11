<?php
/**
 * This file loads custom css and js for our theme
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
*/
 
 
add_action( 'wp_enqueue_scripts','att_load_scripts' );
function att_load_scripts() {
	
	
	/*******
	*** CSS
	*******************/	
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', ATT_CSS_DIR . '/font-awesome.min.css', 'style', true );
	wp_enqueue_style( 'att-responsive', ATT_CSS_DIR .'/responsive.css' );
	wp_enqueue_style( 'google-font-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700', 'style' );
	wp_enqueue_style( 'google-font-bitter', 'http://fonts.googleapis.com/css?family=Bitter:400,700,400italic', 'style' );
	wp_enqueue_style( 'prettyphoto', ATT_CSS_DIR . '/prettyphoto.css', 'style', true );
	
	if ( function_exists( 'wpcf7_enqueue_styles') ) {
		wp_dequeue_style( 'contact-form-7' );
	}

	/*******
	*** jQuery
	*******************/
	
	// Main Scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'prettyphoto', ATT_JS_DIR .'/prettyphoto.js', array( 'jquery' ), '3.1.4', true );	
	wp_enqueue_script( 'fitvids', ATT_JS_DIR .'/fitvids.js', array( 'jquery' ), 1.0, true );
	wp_enqueue_script( 'att-responsive', ATT_JS_DIR .'/responsive.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'att-global', ATT_JS_DIR .'/global.js', array( 'jquery', 'superfish', 'prettyphoto' ), '1.0', true );
	
	wp_localize_script( 'att-responsive', 'attParams', array( 'responsiveMenu' => __( 'Navigation', 'att' ) ) );

	// Comment replies
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}


/**
* Browser Specific CSS
* @Since 1.0
*/
add_action( 'wp_head', 'att_browser_dependencies_css' );
if ( !function_exists( 'att_browser_dependencies_css' ) ) :
	function att_browser_dependencies_css() {
		echo '<!--[if lt IE 9]>';
			echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
			echo '<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>';
		echo '<![endif]-->';
		echo '<!--[if IE 7]><link rel="stylesheet" type="text/css" href="'. ATT_CSS_DIR .'/font-awesome-ie7.min.css" media="screen" /><![endif]-->';
	}
endif;
?>