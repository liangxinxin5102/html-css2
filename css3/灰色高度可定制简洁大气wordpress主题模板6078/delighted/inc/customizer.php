<?php
/**
 * delighted Theme Customizer
 *
 * @package deLighted
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object
 * @since 1.0
 */
 
add_action( 'customize_register', 'delighted_customize_register' );

function delighted_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0
 */
 
add_action( 'customize_preview_init', 'delighted_customize_preview_js' );

function delighted_customize_preview_js() {
	wp_enqueue_script( 'delighted_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131017', true );
}


/**
 * Register custom customizer logo options
 *
 * @since 1.0
 */

add_action( 'customize_register', 'delighted_customize_register_logo' );

function delighted_customize_register_logo( $wp_customize ) {
	
	// Add setting logo
	
	$wp_customize->add_setting(
		'logo',
		array(
			'default' 		=> get_template_directory_uri() . '/img/logo.png',
			'type' 			=> 'option'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'customize_logo',
			array(
			    'label'    => __( 'Logo', 'delighted' ),
			    'section'  => 'title_tagline',
			    'settings' => 'logo',
			)
		)
	);

}


/**
 * Register custom customizer color options
 *
 * @since 1.0
 */

add_action( 'customize_register', 'delighted_customize_register_color' );

function delighted_customize_register_color( $wp_customize ) {
	
	// Add setting link color
	
	$wp_customize->add_setting(
		'accent_color',
		array(
			'default' 		=> '#71616b',
			'type' 			=> 'theme_mod'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'customize_link_color',
			array(
			    'label'    => __( 'Accent Color', 'delighted' ),
			    'section'  => 'colors',
			    'settings' => 'accent_color',
			)
		)
	);

}


/**
 * Add theme mods CSS from
 * theme options to header
 *
 * @since 1.0
 */
 
add_action( 'wp_head', 'delighted_do_theme_mods_css' );

function delighted_do_theme_mods_css() {

	$mods = '';
	$accent_color = '';
	
	// Set accent color
	
	$accent_color .= delighted_generate_css( 'a, a:visited, a:hover, a:focus, a:active, .site-branding em, .entry-title h1 a:hover, .entry-title-meta span', 'color', 'accent_color' );
	$accent_color .= delighted_generate_css( '.main-navigation ul ul a:hover', 'color', 'accent_color', false, ' !important' );
	$accent_color .= delighted_generate_css( '.label, button, .button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:focus, html input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, button:active, html input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active, #wp-calendar caption', 'background-color', 'accent_color' );
	
	if( ! empty( $accent_color ) )
		$mods .= $accent_color;
	
	if( ! empty( $mods ) ) {	
	
		$css  = '<style type="text/css" media="screen">';
		$css .= $mods;
		$css .= '</style>' . "\n";
		
		echo $css;
		
	}

}
