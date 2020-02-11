<?php
	$options[] = array("name" => "Homepage",
						"sicon" => "user-home.png",
						"type" => "heading");
						
	 $options[] = array( "name" => "Display Welcome Section?",
                        "desc" => "Display welcome section on homepage",
                        "id" => SN."displaywelcome",
                        "std" => "1",
                        "type" => "checkbox",
                        "class" => "tiny");

	// WELCOME		
	$options[] = array( "name" => "Welcome Background Image",
						"desc" => "Choose background image for the homepage. Click to 'Upload Image' button and upload your homepage background image.",
						"id" => SN."homepagebg",
						"std" => "$blogpath/images/bgimg.png",
						"type" => "upload");
						
	$options[] = array( "name" => "Welcome Background Color",
						"desc" => "Choose background color for the homepage.",
						"id" => SN."homepagebgcolor",
						"std" => "#83CDBE",
						"type" => "color");
						
	$options[] = array( "name" => "Welcome Title",
						"desc" => "You can use homepage summary text. This area will appear only on the homepage.",
						"id" => SN."hometitle",
						"std" => "WELCOME",
						"type" => "text");
				
	$options[] = array( "name" => "Welcome Summary Text",
						"desc" => "You can use homepage summary text. This area will appear only on the homepage.",
						"id" => SN."homesummary",
						"std" => "discover one page website",
						"type" => "textarea");
						
	$options[] = array( "name" => "Welcome Button Title",
						"desc" => "You can use homepage button title. This button will appear only on the homepage.",
						"id" => SN."homebuttontitle",
						"std" => "LEARN MORE",
						"type" => "text");
						
	$options[] = array( "name" => "Welcome Button URL",
						"desc" => "You can use homepage button url. This will linked to button.",
						"id" => SN."homebuttonurl",
						"std" => "#",
						"class" => "sectionlast",
						"type" => "text");
						
						
	// ABOUT					
	$options[] = array( "name" => "Display About Section on Homepage?",
                        "desc" => "Display about section on homepage",
                        "id" => SN."displayabout",
                        "std" => "1",
                        "type" => "checkbox",
                        "class" => "tiny");
						
	$options[] = array( "name" => "Display Faetures in About Section?",
                        "desc" => "This will be display features in about section.",
                        "id" => SN."displayfeatures",
                        "std" => "1",
                        "type" => "checkbox",
                        "class" => "tiny");
						
	$options[] = array( "name" => "About Section",
						"desc" => "Choose a page for the about section on homepage.",
						"id" => SN."aboutpage",
                        "std" => "About",
                        "type" => "select",
						"options" => $options_pages);
					
	$options[] = array( "name" => "About Background Image",
						"desc" => "Choose background image for the about section. Click to 'Upload Image' button and upload your background image.",
						"id" => SN."aboutbg",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => "About Background Color",
						"desc" => "Choose background color for the about section.",
						"id" => SN."aboutbgcolor",
						"std" => "#F5F5F5",
						"class" => "sectionlast",
						"type" => "color");
						
						
						
	// PORTFOLIO					
	$options[] = array( "name" => "Display Portfolio Section on Homepage?",
                        "desc" => "Display portfolio section on homepage",
                        "id" => SN."displayportfolio",
                        "std" => "1",
                        "type" => "checkbox",
                        "class" => "tiny");
						
	$options[] = array( "name" => "Portfolio Section",
						"desc" => "Choose a page for the portfolio section on homepage.",
						"id" => SN."portfoliopage",
                        "std" => "Portfolio",
                        "type" => "select",
						"options" => $options_pages);
					
	$options[] = array( "name" => "Portfolio Background Image",
						"desc" => "Choose background image for the portfolio section. Click to 'Upload Image' button and upload your background image.",
						"id" => SN."portfoliobg",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => "Portfolio Background Color",
						"desc" => "Choose background color for the portfolio section.",
						"id" => SN."portfoliobgcolor",
						"std" => "#ffffff",
						"class" => "sectionlast",
						"type" => "color");
						
	//TEAM					
	$options[] = array( "name" => "Display Team Section on Homepage?",
                        "desc" => "Display team section on homepage",
                        "id" => SN."displayteam",
                        "std" => "1",
                        "type" => "checkbox",
                        "class" => "tiny");
						
	$options[] = array( "name" => "Team Section",
						"desc" => "Choose a page for the team section on homepage.",
						"id" => SN."teampage",
                        "std" => "Team",
                        "type" => "select",
						"options" => $options_pages);
					
	$options[] = array( "name" => "Team Background Image",
						"desc" => "Choose background image for the team section. Click to 'Upload Image' button and upload your background image.",
						"id" => SN."teambg",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => "Team Background Color",
						"desc" => "Choose background color for the team section.",
						"id" => SN."teambgcolor",
						"std" => "#F5F5F5",
						"class" => "sectionlast",
						"type" => "color");
						
	
	//SERVICE
	$options[] = array( "name" => "Display Service Section on Homepage?",
                        "desc" => "Display service section on homepage",
                        "id" => SN."displayservice",
                        "std" => "1",
                        "type" => "checkbox",
                        "class" => "tiny");
						
	$options[] = array( "name" => "Service Section",
						"desc" => "Choose a page for the service section on homepage.",
						"id" => SN."servicepage",
                        "std" => "Service",
                        "type" => "select",
						"options" => $options_pages);
					
	$options[] = array( "name" => "Service Background Image",
						"desc" => "Choose background image for the service section. Click to 'Upload Image' button and upload your background image.",
						"id" => SN."servicebg",
						"std" => "$blogpath/images/bgimg.png",
						"type" => "upload");
						
	$options[] = array( "name" => "Service Background Color",
						"desc" => "Choose background color for the service section.",
						"id" => SN."servicebgcolor",
						"std" => "#F09297",
						"type" => "color");
						
	//CONTACT					
	$options[] = array( "name" => "Display Contact Section on Homepage?",
                        "desc" => "Display contact section on homepage",
                        "id" => SN."displaycontact",
                        "std" => "1",
                        "type" => "checkbox",
                        "class" => "tiny");
						
	$options[] = array( "name" => "Contact Section",
						"desc" => "Choose a page for the contact section on homepage.",
						"id" => SN."contactpage",
                        "std" => "Contact",
                        "type" => "select",
						"options" => $options_pages);
					
	$options[] = array( "name" => "Contact Background Image",
						"desc" => "Choose background image for the contact section. Click to 'Upload Image' button and upload your background image.",
						"id" => SN."contactbg",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => "Contact Background Color",
						"desc" => "Choose background color for the contact section.",
						"id" => SN."contactbgcolor",
						"std" => "#FFFFFF",
						"type" => "color");
						
?>