<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php 
 wp_title('|',true,'left'); ?>

</title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" /><![endif]-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
$fancier_settings = get_option( 'fancier_options');	
	if ( isset ($fancier_settings['fancier_favicon_url']) &&  ($fancier_settings['fancier_favicon_url']!="") ) { ?>
			<link rel="shortcut icon" href="<?php echo $fancier_settings['fancier_favicon_url']; ?>" />	
	<?php 
		}	
	?>
<?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
<div id="container">

<div id="header">
<div class="siteinfo">
<h1><a href="<?php echo esc_url(home_url()); ?>/"><?php bloginfo('name'); ?></a></h1></div>
<div class="site-description"><?php bloginfo( 'description' ); ?></div>

		<div id="topnav">	
		<?php 
			   wp_nav_menu( array( 'theme_location' => 'header-cats' ) ); 
		?>
		
		
    	</div> 
<!-- SITEINFO END -->
<!-- TOPBANNER END -->

<div class="header-search">
	<form method="get" name="searchform" id="searchform" action="<?php echo home_url()?>">
<input type="text" value="Search" name="s" id="s" onfocus="if (this.value == 'Search') this.value = '';" onblur="if (this.value == '') this.value = 'Search';"/>
</form>

		</div>
<div id="main">
<div class="innerwrap">
