<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php wp_title( '' ); ?><?php if (wp_title( '', false )) { echo ' |'; } ?> <?php bloginfo( 'name' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>    
</head>

<body <?php body_class(); ?>>

	<?php att_hook_site_before(); ?>
    
    <div id="masthead" class="clr">
    	<div class="container clr">
            <div class="logo">
                <?php if ( of_get_option('custom_logo') ) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option('custom_logo'); ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
                <?php } else { ?>
                    <h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
                <?php } ?>
            </div><!-- .logo -->
			<nav id="site-navigation" class="navigation main-navigation grid-1 clr" role="navigation">
				<?php wp_nav_menu( array(
                    'theme_location'	=> 'main_menu',
                    'menu_class'		=> 'dropdown-menu',
                    'fallback_cb'		=> false,
                ) ); ?>
			</nav>
        </div><!-- .container -->
    </div><!-- #masthead -->
    
    <div id="wrap" class="clr">
        <div id="main-content" class="clr">