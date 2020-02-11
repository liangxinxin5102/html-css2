<?php

/**
 * Wp in Progress
 * 
 * @theme Alhena
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

/*-----------------------------------------------------------------------------------*/
/* Admin class */
/*-----------------------------------------------------------------------------------*/   

function alhenalite_admin_body_class( $classes ) {
	
	global $wp_version;
	
	if ( ( $wp_version >= 3.8 ) && ( is_admin()) ) {
		$classes .= 'wp-8';
	}
		return $classes;
}
	
add_filter( 'admin_body_class', 'alhenalite_admin_body_class' );

/*-----------------------------------------------------------------------------------*/
/* Localize theme */
/*-----------------------------------------------------------------------------------*/   

load_theme_textdomain( 'wip', get_template_directory() . '/languages');

/*-----------------------------------------------------------------------------------*/
/* Default menu */
/*-----------------------------------------------------------------------------------*/   

function alhenalite_add_menuclass( $ulclass ) {
	return preg_replace( '/<ul>/', '<ul class="menu">', $ulclass, 1 );
}
add_filter( 'wp_page_menu', 'alhenalite_add_menuclass' );

/*-----------------------------------------------------------------------------------*/
/* Tag Title */
/*-----------------------------------------------------------------------------------*/  
 
function alhenalite_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'alhenalite_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Admin menu */
/*-----------------------------------------------------------------------------------*/  

function alhenalite_option_panel() {
        global $wp_admin_bar, $wpdb;
    	$wp_admin_bar->add_menu( array( 'id' => 'theme_options', 'title' => '<span> Alhena Options </span>', 'href' => get_admin_url() . 'themes.php?page=themeoption' ) );
        $wp_admin_bar->add_menu( array( 'id' => 'get_premium', 'title' => '<span> Get Premium </span>', 'href' => get_admin_url() . 'themes.php?page=getpremium' ) );
}
add_action( 'admin_bar_menu', 'alhenalite_option_panel', 1000 );

/*-----------------------------------------------------------------------------------*/
/* Content width */
/*-----------------------------------------------------------------------------------*/ 

if ( ! isset( $content_width ) )
	$content_width = 940;

/*-----------------------------------------------------------------------------------*/
/* Prettyphoto at post gallery */
/*-----------------------------------------------------------------------------------*/   

function alhenalite_prettyPhoto( $html, $id, $size, $permalink, $icon, $text ) {
	
    if ( ! $permalink )
        return str_replace( '<a', '<a data-rel="prettyPhoto" ', $html );
    else
        return $html;
}

add_filter( 'wp_get_attachment_link', 'alhenalite_prettyPhoto', 10, 6);


/*-----------------------------------------------------------------------------------*/
/* Custom excerpt more */
/*-----------------------------------------------------------------------------------*/   

function alhenalite_new_excerpt_more( $more ) {
	
	global $post;
	
	if (alhenalite_postmeta( 'wip_service_url' )):
		$url = alhenalite_postmeta('wip_service_url' );
	else:
		$url = get_permalink($post->ID);
	endif;
	
	return '<a class="button" href="'.$url.'" title="More">  ' . __( "Read More","wip") . ' </a>';

}

add_filter('excerpt_more', 'alhenalite_new_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/* Shortcode in widget */
/*-----------------------------------------------------------------------------------*/   

add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/* Remove category list rel */
/*-----------------------------------------------------------------------------------*/   

function alhenalite_remove_category_list_rel($output) {
	$output = str_replace('rel="category"', '', $output);
	return $output;
}

add_filter('wp_list_categories', 'alhenalite_remove_category_list_rel');
add_filter('the_category', 'alhenalite_remove_category_list_rel');

/*-----------------------------------------------------------------------------------*/
/* Remove thumbnail dimensions */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'alhenalite_remove_thumbnail_dimensions', 10, 3 );
  
/*-----------------------------------------------------------------------------------*/
/* Remove css gallery */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_my_gallery_style() {
    return "<div class='gallery'>";
}

add_filter( 'gallery_style', 'alhenalite_my_gallery_style', 99 );

/*-----------------------------------------------------------------------------------*/
/* Thematic dropdown options */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_childtheme_dropdown_options($dropdown_options) {
	$dropdown_options = '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/scripts/thematic-dropdowns.js"></script>';
	return $dropdown_options;
}

add_filter('thematic_dropdown_options','alhenalite_childtheme_dropdown_options');

/*-----------------------------------------------------------------------------------*/
/* Require */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_require($folder) {

$dh  = opendir(get_template_directory().$folder);

while (false !== ($filename = readdir($dh))) {
   
	if ( strlen($filename) > 2 ) {
	require_once get_template_directory()."/".$folder.$filename;
	}
}


}

/*-----------------------------------------------------------------------------------*/
/* Scripts */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_enqueue_script($folder) {

	if (isset($folder)) : 
	
	$dh  = opendir(get_template_directory().$folder);
	
	while (false !== ($filename = readdir($dh))) {
	   
		if ( strlen($filename) > 2 ) {
				wp_enqueue_script( str_replace('.js','',$filename), get_template_directory_uri() . $folder . "/" . $filename , array('jquery'), FALSE, TRUE ); 
		}
	}

endif;

}

/*-----------------------------------------------------------------------------------*/
/* Styles */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_enqueue_style($folder) {

if (isset($folder)) : 

	$dh  = opendir(get_template_directory().$folder);
	
	while (false !== ($filename = readdir($dh))) {
	   
		if ( strlen($filename) > 2 ) {
				wp_enqueue_style( str_replace('.css','',$filename), get_template_directory_uri() . $folder . "/" . $filename ); 
		}
	}

endif;

}


/*-----------------------------------------------------------------------------------*/
/* Request */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_request($id) {
	
	if ( isset ( $_REQUEST[$id])) 
	return $_REQUEST[$id];	
	
}

/*-----------------------------------------------------------------------------------*/
/* Theme path */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_theme_data($id) {
	
	 global $wp_version;	
	 if ( $wp_version <= 3.4 ) :
	 	$themedata = get_theme_data( get_template_directory(). '/style.css');
		return $themedata[$id];
	 else:
		$themedata = wp_get_theme();
		return $themedata->get($id);
	 endif;
	
}

/*-----------------------------------------------------------------------------------*/
/* Theme name */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_themename() {
	
	$themename = "alhenalite_theme_settings";
	return $themename;	
	
}

/*-----------------------------------------------------------------------------------*/
/* Theme settings */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_setting($id) {

	$wip_setting = get_option(alhenalite_themename());
	if(isset($wip_setting[$id]))
		return $wip_setting[$id];

}

/*-----------------------------------------------------------------------------------*/
/* Post meta */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_postmeta($id) {

	global $post;
	
	$val = get_post_meta( $post->ID , $id, TRUE);
	if(isset($val))
		return $val;

}

/*-----------------------------------------------------------------------------------*/
/* Post formats */
/*-----------------------------------------------------------------------------------*/   

function alhenalite_setup() {

	add_theme_support( 'post-formats', array( 'aside','gallery','quote','video','audio','link' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'f3f3f3',
		'default-image' => get_template_directory_uri() . alhenalite_setting('wip_body_background'),
	) );
	
	add_theme_support( 'custom-header' );
	
	add_image_size( 'blog', 940,429, TRUE ); 
	register_nav_menu( 'main-menu', 'Main menu' );
	
}

add_action( 'after_setup_theme', 'alhenalite_setup' );

/*-----------------------------------------------------------------------------------*/
/* Get Skin */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_getskins($classes) {

	if (alhenalite_setting('wip_skins')):
		$getskin = explode("_", alhenalite_setting('wip_skins'));
		$classes[] = $getskin[0];
		return $classes;
	else:
		$classes[] = "light";
		return $classes;
	endif;
}

add_filter('body_class','alhenalite_getskins');

/*-----------------------------------------------------------------------------------*/
/* Content template */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_template($id) {

	$template = array ("full" => "span12" , "left-sidebar" => "span8" , "right-sidebar" => "span8" );

	$span = $template["full"];
	$sidebar =  "full";

	if ( (is_category()) || (is_tag()) ) {
		
		$span = $template[alhenalite_setting('wip_category_layout')];
		$sidebar =  alhenalite_setting('wip_category_layout');
			
	} else if (is_home()) {
		
		$span = $template[alhenalite_setting('wip_home')];
		$sidebar =  alhenalite_setting('wip_home');
			
	} else if (alhenalite_postmeta('wip_template')) {
		
		$span = $template[alhenalite_postmeta('wip_template')];
		$sidebar =  alhenalite_postmeta('wip_template');
			
	}
	
	return ${$id};
	
}

/*-----------------------------------------------------------------------------------*/
/* Content template */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_layout($id) {

	if (!alhenalite_setting($id)):
	
		$layout = "span12";
	
	else:

		$layout = alhenalite_setting($id);

	endif;
	
	return $layout;
	
}


/*-----------------------------------------------------------------------------------*/
/* Add default style, at theme activation */
/*-----------------------------------------------------------------------------------*/         

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	
	$wip_setting = get_option(alhenalite_themename());

	if (!$wip_setting) {	
		
		$skins = array( 
		
		"wip_skins" => "light_turquoise", 
		"wip_logo_font" => "Kristi", 
		"wip_logo_font_size" => "55px", 
		
		"wip_menu_font" => "Abel", 
		"wip_menu_font_size" => "14px", 
		
		"wip_titles_font" => "Abel", 
		
		"wip_text_font_color" => "#616161", 
		"wip_copyright_font_color" => "#ffffff", 
		
		"wip_link_color" => "#1abc9c", 
		"wip_link_color_hover" => "#16a085", 
		"wip_border_color" => "#16a085", 
		
		"wip_header_font_color" => "#919191", 
		"wip_header_hover_font_color" => "#ffffff", 
		"wip_submenu_color" => "#474747", 
		"wip_submenu_text_color" => "#919191", 
	
		"wip_header_background" => "None",
		"wip_header_background_color" => "#333333",
	
		"wip_body_background" => "/images/background/patterns/pattern1.jpg",
		"wip_body_background_repeat" => "repeat",
		"wip_body_background_color" => "#f3f3f3",
		
		"wip_footer_background" => "None",
		"wip_footer_background_color" => "#333333",
	
		"wip_top_sidebar_area" => "span4",
		"wip_header_sidebar_area" => "span4",
		"wip_footer_sidebar_area" => "span4",

		"wip_home" => "full",
		"wip_category_layout" => "full",
		"wip_footer_facebook_button" => "#",
		"wip_footer_twitter_button" => "#",
		"wip_footer_skype_button" => "#",
		"wip_view_comments" => "on",
		
		);
	
		update_option( alhenalite_themename(), $skins ); 
		
	}
}

/*-----------------------------------------------------------------------------------*/
/* Styles and scripts */
/*-----------------------------------------------------------------------------------*/ 

function alhenalite_scripts_styles() {
	
	alhenalite_enqueue_script('/js');
	alhenalite_enqueue_style('/css');

}

add_action( 'wp_enqueue_scripts', 'alhenalite_scripts_styles' );

/*-----------------------------------------------------------------------------------*/
/* Functions */
/*-----------------------------------------------------------------------------------*/ 

alhenalite_require('/core/widgets/');
alhenalite_require('/core/templates/');
alhenalite_require('/core/classes/');
alhenalite_require('/core/functions/');
alhenalite_require('/core/metaboxes/');

?>