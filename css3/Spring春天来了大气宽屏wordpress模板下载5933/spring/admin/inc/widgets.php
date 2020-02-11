<?php
/*********************************************************************************************

Register Global Sidebars

*********************************************************************************************/
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sidebar',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

?>