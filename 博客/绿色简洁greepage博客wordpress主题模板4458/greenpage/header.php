<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
  
 <?php wp_title('|',true,'left'); ?>

</title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />	
	<?php
$greenpage_settings = get_option( 'greenpage_options');
wp_get_archives('type=monthly&format=link'); 		
	if ( isset ($greenpage_settings['greenpage_favicon_url']) &&  ($greenpage_settings['greenpage_favicon_url']!="") ) { ?>
			<link rel="shortcut icon" href="<?php echo $greenpage_settings['greenpage_favicon_url']; ?>" />	
	<?php 
		}	
?>	
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="wrapper-header">
	<div id="header">
	
			<div id="header-title">
    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
  </div>
					    <?php if ( has_nav_menu( 'header-menu' ) ) { ?>
    <div id="menu-container">
    <div class="page_menu">
      <?php wp_nav_menu( array( 'menu_id'=>'nav', 'theme_location'=>'header-menu' ) );?>
    </div>
    </div><?php } ?>
	<div class="clear"></div>
	 <div class="search-box-outer">
      <div class="search-box-inner">
      <div class="search-box-shadow">
<?php get_search_form(); ?>
      </div>
      </div>
    </div>  
		</div>

	</div>

					<div class="clear"></div>


