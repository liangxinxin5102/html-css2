<?php

/* ------- Adding a custom menu ------- */
require( get_template_directory() . '/settings/loom-options.php' );
function loom_register_my_menus() {
	register_nav_menus(
		array(
			'menu-1' => __( 'Menu 1', 'looming' ),
			'menu-r' => __( 'Menu r', 'looming' ),
		)
	);
}
add_action( 'init', 'loom_register_my_menus' );

add_action( 'after_setup_theme', 'loom_setup' );

 if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : 
 if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
	endif; 



function loom_setup() {
global $phb_content_width, $phb_favicon_url;
if ( ! isset( $content_width ) )
	$content_width = 700;
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	add_image_size('squareThumb', 220, 160, true);
	add_image_size( 'homepage-thumb', 620, 260, true );
	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'looming', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory(). "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

}

/* ------- Register sidebar ------- */
function loom_widgets_init() {
    register_sidebars(1);
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}
 add_action('widgets_init', 'loom_widgets_init');





function loom_wp_head() { ?>
<?php }
add_action('wp_head', 'loom_wp_head');



