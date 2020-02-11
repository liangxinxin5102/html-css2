<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
   
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php if (alhenalite_setting('wip_custom_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo alhenalite_setting('wip_custom_favicon'); ?>"/>
<?php endif; ?>

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<!--[if IE 8]>
    <script src="<?php echo get_template_directory_uri(); ?>/scripts/html5.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/scripts/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->

<?php 

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	wp_head(); 
	
?>

</head>

<body <?php body_class('custombody'); ?>>

<header class="header" >
    <div class="container" >
        <div class="row">
            <div class="span3" >
                <div id="logo">
                        
                	<?php 
                                        
                    	if ( alhenalite_setting('wip_custom_logo') ):
							echo '<a href="'.home_url().'" title="'.get_bloginfo('name').'">';
                            echo "<img src='".alhenalite_setting('wip_custom_logo')."' alt='logo'>"; 
							echo '</a>';
                        else: 
							echo '<a href="'.home_url().'" class="logo" title="'.get_bloginfo('name').'">';
                            bloginfo('name');
							echo '</a>';
                        endif; 
                            
                    ?>

                </div>
                
            </div>
            <div class="span9" >
                <nav id="mainmenu">
                    <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => 'false','depth' => 3  )); ?>
                </nav> 
                               
            </div>
        </div>
    </div>
</header>