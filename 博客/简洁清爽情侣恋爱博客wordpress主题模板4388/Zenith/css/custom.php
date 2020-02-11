<?php
	header("Content-type: text/css;");
	
	if( file_exists('../../../../wp-load.php') ) :
		include '../../../../wp-load.php';
	else:
		include '../../../../../wp-load.php';
	endif;
?>


/*-------------------------------------------------------------------------------------------*/
/* Custom Styles */
/*-------------------------------------------------------------------------------------------*/

<?php
	// Styles	

	$primary =  of_get_option('w2f_primary_color','#769A38');
	$link = of_get_option('w2f_link_color','');
	$hover = of_get_option('w2f_hover_color','');
	
?>


.main-navigation,.main-navigation ul ul, 
#ctimer span, .footer-widget-section, ol.comment-list li .reply {
	background: <?php echo $primary ?>;
}

 h2.section-title {
	color: <?php echo $primary ?>;
}

/* Links */
a {
	color: <?php echo $link ?>;
}
a:visited {
	color: <?php echo $link ?>;
}
a:hover,
a:focus,
a:active {
	color:<?php echo $hover ?>;
	text-decoration: none;
}
