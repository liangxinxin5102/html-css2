<?php
/**
 * File used to setup your theme options.
 * Theme options are located in your dashboard at Appreance->Theme Options
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
 
function optionsframework_option_name() {
    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = 'options_att_themes';
    update_option( 'optionsframework', $optionsframework_settings);
}


// Begin options
function optionsframework_options() {

	$options = array();
	
	//GENERAL	
	$options[] = array(
					'name'	=> __( 'General', 'att' ),
					'type'	=> 'heading',
				);
		
	$options[] = array(
					'name'	=> __( 'Custom Logo', 'att' ),
					'desc'	=> __( 'Upload your custom logo.', 'att' ),
					'std'	=> '',
					'id'	=> 'custom_logo',
					'type'	=> 'upload',
				);
	
	$options[] = array(
					'name'	=> __( 'Portfolio Enable', 'att' ),
					'desc'	=> __( 'Check this box to enable the portfolio post type.', 'att' ),
					'id'	=> 'enable_portfolio',
					'std'	=> '1',
					'type'	=> 'checkbox'
				);
	
	//HOMEPAGE	
	$options[] = array(
					'name'	=> __( 'Homepage', 'att' ),
					'type'	=> 'heading',
				);
		
	$options[] = array(
					'name'	=> __( 'Homepage: Portfolio Items Count', 'att' ),
					'desc'	=> __( 'How many portfolio items do you wish to show on the homepage?', 'att' ),
					'id'	=> 'home_portfolio_count',
					'std'	=> '12',
					'type'	=> 'text',
				);
	
	//PORTFOLIO	
	$options[] = array(
					'name'	=> __( 'Portfolio', 'att' ),
					'type'	=> 'heading',
				);
					
	$options[] = array(
					'name'	=> __( 'Portfolio Enable', 'att' ),
					'desc'	=> __( 'Check this box to enable the portfolio post type.', 'att' ),
					'id'	=> 'enable_portfolio',
					'std'	=> '1',
					'type'	=> 'checkbox'
				);
				
	$options[] = array(
					'name'	=> __( 'Portfolio: Items Per Page', 'att' ),
					'desc'	=> __( 'How many portfolio items do you wish to show on your portfolio templates and archives? Use -1 to show all.', 'att' ),
					'id'	=> 'portfolio_pagination',
					'std'	=> '-1',
					'type'	=> 'text'
				);
	
	$options[] = array(
					"name"	=> __( 'Toggle: Portfolio Comments', 'att' ),
					"desc"	=> __( 'Check this box to enable comments on single portfolio posts.', 'att' ),
					"id"	=> "portfolio_comments",
					"std"	=> "0",
					"type"	=> "checkbox"
				);
						
	$options[] = array(
					"name"	=> __( 'Toggle: Portfolio More Items Section', 'att' ),
					"desc"	=> __( 'Check this box to enable the section that displays other portfolio items on single portfolio posts.', 'att' ),
					"id"	=> "portfolio_more",
					"std"	=> "1",
					"type"	=> "checkbox"
				);
				
	//BLOG	
	$options[] = array(
					'name'	=> __( 'Blog', 'att' ),
					'type'	=> 'heading',
				);		
					
	$options[] = array(
					"name"	=> __( 'Toggle: Featured Images On Single Blog Posts', 'att' ),
					"desc"	=> __( 'Check this box to enable featured images on single blog posts.', 'att' ),
					"id"	=> "blog_single_thumbnail",
					"std"	=> "1",
					"type"	=> "checkbox",
				);

	return $options;
}
?>