<?php
/**
 * Main theme support functions
 * since 1.0
 */
 

add_action( 'after_setup_theme', 'att_theme_setup' );
function att_theme_setup() {
	
	// Localization support
	load_theme_textdomain( 'att', get_template_directory() .'/languages' );

	// Register navigation menus
	register_nav_menus (
		array(
			'top_menu' => __( 'Top Navigation', 'att' ),
			'main_menu' => __( 'Main Navigation', 'att' ),
			'footer_menu' => __( 'Footer Navigation', 'att' ),
		)
	);
		
	// Add theme support
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-background');
	add_theme_support('post-thumbnails');

}