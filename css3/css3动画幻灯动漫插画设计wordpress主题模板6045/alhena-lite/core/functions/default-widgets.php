<?php

	register_sidebar(array(
	
		'name' => 'Side Sidebar',
		'id'   => 'side_sidebar_area',
		'description'   => __( "This sidebar will be shown at the side of content","wip"),
		'before_widget' => '<div class="widget-box">',
		'after_widget'  => '</div>',
		'before_title'  => '<header class="title"><div class="line"><h3>',
		'after_title'   => '</h3></div></header>'
	
	));

	register_sidebar(array(
	
		'name' => 'Home Sidebar',
		'id'   => 'home_sidebar_area',
		'description'   => __( "This sidebar will be shown for the homepage","wip"),
		'before_widget' => '<div class="widget-box">',
		'after_widget'  => '</div>',
		'before_title'  => '<header class="title"><div class="line"><h3>',
		'after_title'   => '</h3></div></header>'
	
	));

	register_sidebar(array(
	
		'name' => 'Top Sidebar',
		'id'   => 'top_sidebar_area',
		'description'   => __( "This sidebar will be shown before the content","wip"),
		'before_widget' => '<div class="' . alhenalite_layout('wip_top_sidebar_area') . '"><div class="widget-box">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<header class="title"><div class="line"><h3>',
		'after_title'   => '</h3></div></header>'
	
	));
	
	register_sidebar(array(
	
		'name' => 'Category Sidebar',
		'id'   => 'category_sidebar_area',
		'description'   => __( "This sidebar will be shown at the side of archive","wip"),
		'before_widget' => '<div class="widget-box">',
		'after_widget'  => '</div>',
		'before_title'  => '<header class="title"><div class="line"><h3>',
		'after_title'   => '</h3></div></header>'
	
	));

	register_sidebar(array(
	
		'name' => 'Footer Sidebar',
		'id'   => 'footer_sidebar_area',
		'description'   => __( "This sidebar will be shown after the content","wip"),
		'before_widget' => '<div class="pin-article ' . alhenalite_layout('wip_footer_sidebar_area') . '"><article class="article">',
		'after_widget'  => '</article></div>',
		'before_title'  => '<header class="title"><div class="line"><h3>',
		'after_title'   => '</h3></div></header>'

	));

?>