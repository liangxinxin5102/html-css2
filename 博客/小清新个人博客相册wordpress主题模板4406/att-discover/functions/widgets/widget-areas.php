<?php
/**
 * Define sidebars for use in this theme
 * @package  Theme
 * @since 1.0
 * @author Authentic Themes : http://www.authenticthemes.com
 * @copyright Copyright (c) 2012, Authentic Themes
 * @link http://www.authenticthemes.com
 * @author Authentic Themes : http://www.authenticthemes.com
 */

//sidebar
register_sidebar(array(
	'name' => __( 'Sidebar', 'att' ),
	'id' => 'sidebar',
	'description' => __( 'Widgets in this area are used on the main sidebar region.', 'att' ),
	'before_widget' => '<div class="sidebar-box %2$s clr">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//footer 1
register_sidebar(array(
	'name' => __( 'Footer 1', 'att' ),
	'id' => 'footer-one',
	'description' => __( 'Widgets in this area are used in the footer region.', 'att' ),
	'before_widget' => '<div class="footer-widget %2$s clr">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));
//footer 2
register_sidebar(array(
	'name' => __( 'Footer 2', 'att' ),
	'id' => 'footer-two',
	'description' => __( 'Widgets in this area are used in the footer region.', 'att' ),
	'before_widget' => '<div class="footer-widget %2$s clr">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));
//footer 3
register_sidebar(array(
	'name' => __( 'Footer 3', 'att' ),
	'id' => 'footer-three',
	'description' => __( 'Widgets in this area are used in the footer region.', 'att' ),
	'before_widget' => '<div class="footer-widget %2$s clr">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));
//footer 4
register_sidebar(array(
	'name' => __( 'Footer 4', 'att' ),
	'id' => 'footer-four',
	'description' => __( 'Widgets in this area are used in the footer region.', 'att' ),
	'before_widget' => '<div class="footer-widget %2$s clr">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

?>