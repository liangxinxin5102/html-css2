<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package web2feel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<div class="top-bar">
		<div class="container"><div class="row">
			<div class="col-md-12">
				<div class="custom-search">
					<?php get_search_form();?>
				</div>
			</div>
		</div></div>
	</div>
	<header id="masthead" class="site-header" role="banner">
		<div class="container"> <div class="row"> 
			<div class="col-md-4">
				<div class="site-branding">
					<?php if( of_get_option('w2f_logo')!=''){ ?>
					<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <img src="<?php echo of_get_option('w2f_logo'); ?>" alt="" /> </a></div>
					<?php } else { ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-8">
				<?php if( of_get_option('w2f_topad')!=''){ ?>
				<div class="top-ad">
					<?php echo of_get_option('w2f_topad'); ?>
				</div>
				<?php } ?>
			</div>
		</div></div>
	</header><!-- #masthead -->
	<div class="main-menu">
		<div class="container"> <div class="row"> 
			<div class="col-md-12"> 
			<div class="mobilenavi"></div>	
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary','container_class' => 'topmenu','menu_id'=>'topmenu' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</div></div>
	</div>
	
	<div id="content" class="site-content">
