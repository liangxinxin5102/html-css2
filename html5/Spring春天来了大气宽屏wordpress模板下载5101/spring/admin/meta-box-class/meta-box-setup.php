<?php

require_once("meta-box-class.php");

if (is_admin()){

	//All meta boxes prefix
	$prefix = 'spring_';


	$config1 = array(
	'id' => 'feature_icon',          			// meta box id, unique per meta box
	'title' => 'Feature Icon',          		// meta box title
	'pages' => array('feature'),      		// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',            		// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',            		// order of meta box: high (default), low; optional
	'fields' => array(),            		// list of meta fields (can be added by field arrays)
	'local_images' => true,          		// Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => true          		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	//Initiate bio info meta box
	$my_meta1 =  new AT_Meta_Box($config1);


	//Bio info fields
	$my_meta1->addText($prefix.'f_icon',array('name'=> 'Icon ', 'desc'=>'Enter the fature fonwaewsome icon name here fox example: fa fa-cloud-download'));
	$my_meta1->addColor($prefix.'f_icon_color',array('name'=> 'Color ', 'desc'=>'Select the fature fonwaewsome icon color fox example: #F4989D'));

    //Finish bio info meta mox decleration
	$my_meta1->Finish();
	
	
	
	//Bio info meta box config
	$config2 = array(
	'id' => 'service_icon',          			// meta box id, unique per meta box
	'title' => 'Service Icon',          		// meta box title
	'pages' => array('service'),      		// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',            		// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',            		// order of meta box: high (default), low; optional
	'fields' => array(),            		// list of meta fields (can be added by field arrays)
	'local_images' => true,          		// Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => true          		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	//Initiate bio info meta box
	$my_meta2 =  new AT_Meta_Box($config2);


	//Bio info fields
	$my_meta2->addText($prefix.'s_icon',array('name'=> 'Icon ', 'desc'=>'Enter the service fontawesome icon name here fox example: fa fa-cloud-download'));
	$my_meta2->addColor($prefix.'s_icon_color',array('name'=> 'Color ', 'desc'=>'Select the service fontawesome icon color fox example: #F4989D'));

    //Finish bio info meta mox decleration
	$my_meta2->Finish();
	
	
	
	
	//Bio info meta box config
	$config3 = array(
	'id' => 'service_icon',          			// meta box id, unique per meta box
	'title' => 'Service Icon',          		// meta box title
	'pages' => array('team'),      		// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',            		// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',            		// order of meta box: high (default), low; optional
	'fields' => array(),            		// list of meta fields (can be added by field arrays)
	'local_images' => true,          		// Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => true          		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	//Initiate bio info meta box
	$my_meta3 =  new AT_Meta_Box($config3);


	//Bio info fields
	$my_meta3->addText($prefix.'t_title',array('name'=> 'Job Title ', 'desc'=>'Enter the team job title fox example:Lead Developer '));
	$my_meta3->addText($prefix.'f_icon',array('name'=> 'Facebook ', 'desc'=>'Enter the team facabook url'));
	$my_meta3->addText($prefix.'t_icon',array('name'=> 'Twitter ', 'desc'=>'Enter the team twitter url'));

    //Finish bio info meta mox decleration
	$my_meta3->Finish();


}