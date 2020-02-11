<?php
    $options[] = array( "name" => "Typography",
    					"sicon" => "font.png",
						"type" => "heading");

	$options[] = array( "name" => "Custom Headings Font",
						"desc" => "This theme uses Google Web Font for headings. You can change it by entering the font details in the fields below.",
						"id" => SN."customfontsinfo",
						"std" => "",
						"type" => "info");

	$options[] = array( "name" => "Enable Google Font",
						"desc" => "By unchecking this the theme will use default font for headings, Arial.",
						"id" => SN."customtypography",
						"std" => "1",
						"type" => "checkbox");

    $options[] = array( "name" => "Body Google Font Link",
                        "desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'&gt;",
                        "id" => SN."bodyfontlink",
                        "std" => "<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>",
                        "type" => "textarea");

    $options[] = array( "name" => "Body Google Font Family",
                        "desc" => "Ex: font-family: 'Montserrat', sans-serif",
                        "id" => SN."bodyfontface",
                        "std" => "font-family: 'Montserrat', sans-serif;",
                        "type" => "text");

    $options[] = array( "name" => "Headings Google Font Link",
                        "desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Roboto:400,100italic,100,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'&gt;",
                        "id" => SN."headingfontlink",
                        "std" => "<link href='http://fonts.googleapis.com/css?family=Roboto:400,100italic,100,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>",
                        "type" => "textarea");

    $options[] = array( "name" => "Headings Google Font Family",
                        "desc" => "Ex: font-family: 'Roboto', sans-serif",
                        "id" => SN."headingfontface",
                        "std" => "font-family: 'Roboto', sans-serif",
                        "type" => "text");

?>