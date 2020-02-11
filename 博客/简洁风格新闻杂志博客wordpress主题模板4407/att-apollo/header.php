<?php
/**
 * Header.php is generally used on all the pages of your site and is called somewhere near the top
 * of your template files. It's a very important file that should never be deleted.
 *
 * @package WordPress Theme
 * @since 1.0
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php wp_head(); ?>   
</head>

<!-- Begin Body -->
<body <?php body_class(); ?>>

<?php att_hook_site_before(); ?>

<div id="topbar-wrap">
    <nav id="topbar" class="container row clr">    
    	<div id="navigation" class="span_8 col clr">    
			<?php
            // Main navigation location
            wp_nav_menu( array( 'theme_location' => 'top_menu', 'menu_class' => 'dropdown-menu', 'fallback_cb' => false, 'walker' => new ATT_Dropdown_Walker_Nav_Menu() ) ); ?>
        </div><!-- #navigation -->
        <div class="span_4 col clr">
			<?php
            // Show social icons - see functions/social.php
            if( att_option('social','1') == '1' && function_exists('att_display_social') ) {
                att_display_social();
            } ?>   
        </div>             
    </nav><!-- #topbar -->
</div><!-- #topbar-wrap -->

<div id="header-wrap">
    	<div id="header" class="container row">   
            <div id="logo" class="col span_4">
                <?php
                // Show custom image logo if defined in the admin
                if( att_option('custom_logo') !== '' ) { ?>
                    <a href="<?php echo home_url(); ?>/" title="<?php echo get_bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo att_option('custom_logo'); ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
                    <?php if ( att_option('site_description','1') == '1' ) echo '<p id="site-description">'. get_bloginfo('description') .'</p>'; ?>
                <?php }
                // No custom img logo - show text
                    else { ?>
                     <h2 id="site-title"><a href="<?php echo home_url(); ?>/" title="<?php echo get_bloginfo( 'name' ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
                     <?php if ( att_option('site_description','1') == '1' ) echo '<p id="site-description">'. get_bloginfo('description') .'</p>'; ?>
                <?php } ?>
            </div><!-- /logo -->
            
            <?php
            // Show header ad as defined in the admin panel
            if( att_option('header_ad') !== '' ) {
                echo '<div class="col span_8"><div id="header-ad">'. do_shortcode( att_option('header_ad') ).'</div></div>';
            } ?>
    	</div><!-- /header -->
</div><!-- /header-wrap -->

<div id="navbar-wrap">
    <nav id="navbar" class="container row clr">
    	<div id="navigation-secondary" class="span_12 col clr">    
			<?php
            // Main navigation location
            wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => 'dropdown-menu', 'fallback_cb' => false, 'walker' => new ATT_Dropdown_Walker_Nav_Menu() ) ); ?>
        </div><!-- #navigation -->             
    </nav><!-- #topbar --> 
</div><!-- #topbar-wrap -->

<div id="box-wrap" class="container row clr">

    <?php
    // Display featured Image on pages
    if ( is_singular('page') && has_post_thumbnail() ) { ?>
        <div id="page-featured-img" class="clr">
            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php the_title(); ?>" />
        </div><!-- #page-featured-img -->
    <?php } ?>
    
    <div id="main-content" class="row span_12">