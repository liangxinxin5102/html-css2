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

	<header id="masthead" class="site-header" role="banner">
		<div class="container"> <div class="row"> 
			<div class="top clearfix">
				<div class="site-branding col-sm-6">
					<?php if( of_get_option('w2f_logo')!=''){ ?>
					<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <img src="<?php echo of_get_option('w2f_logo'); ?>" alt="" /> </a></div>
					<?php } else { ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } ?>

			
		</div>
		<div class="col-sm-6"> 
			<div class="social-buttons clearfix">
				<ul class="clearfix">
					<li><a href="<?php of_get_option('w2f_facebook',''); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="Facebook" /></a></li>
					<li><a href="https://twitter.com/<?php of_get_option('w2f_twitter',''); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="Twitter" /></a></li>
					<li><a href="http://www.pinterest.com/<?php of_get_option('w2f_pinterest',''); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/pinterest.png" alt="Pinterest" /></a></li>
					<li><a href="<?php of_get_option('w2f_google',''); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/google.png" alt="Google" /></a></li>
				</ul>
			</div>
				</div>
		</div>
		</div> </div>
		
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="container"> <div class="row"> 
				<div class="col-sm-12"> 
					<div class="mobilenavi"></div>	
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary','container_class' => 'topmenu','menu_id'=>'topmenu' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>
			</div></div>
		</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		