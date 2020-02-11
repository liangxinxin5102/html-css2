<?php
/**
 * Define sidebars for use in this theme
 * @package WordPress Theme
 * @since 1.0
 * @author Authentic Themes : http://www.authenticthemes.com
 */

//sidebar
register_sidebar(array(
	'name' => __( 'Sidebar','att'),
	'id' => 'sidebar',
	'description' => __( 'Widgets in this area are used on the main sidebar region.','att' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


/* Footer Widgets */
if ( att_option('footer','1') =='1' ) {
	//footer 1
	register_sidebar(array(
		'name' => __( 'Footer 1','att'),
		'id' => 'footer-one',
		'description' => __( 'Widgets in this area are used in the footer region.','att' ),
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
	
	//footer 2
	register_sidebar(array(
		'name' => __( 'Footer 2','att'),
		'id' => 'footer-two',
		'description' => __( 'Widgets in this area are used in the footer region.','att' ),
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
	
	//footer 3
	register_sidebar(array(
		'name' => __( 'Footer 3','att'),
		'id' => 'footer-three',
		'description' => __( 'Widgets in this area are used in the footer region.','att' ),
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
}