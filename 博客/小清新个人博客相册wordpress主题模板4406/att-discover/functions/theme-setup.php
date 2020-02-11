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
			'main_menu' => __( 'Main', 'att' )
		)
	);
		
	// Add theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	
}