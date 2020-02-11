<?php

	if ( has_post_format( 'quote' )) {
    	get_template_part( 'post-formats/quote' );
    }
		
	else 
		
	if ( has_post_format( 'aside' )) {
    	get_template_part( 'post-formats/aside' );
	}
		
	else 

    if ( has_post_format( 'link' )) {
    	get_template_part( 'post-formats/link' );
    }
		
	else 
        
	if ( has_post_format( 'audio' )) {
		get_template_part( 'post-formats/audio' );
	}
		
	else 
        
	if ( has_post_format( 'video' )) {
		get_template_part( 'post-formats/video' );
	}
		
	else 
        
	if ( has_post_format( 'gallery' )) {
		get_template_part( 'post-formats/gallery' );
	}
	
	else 
		
	if ( get_post_type( get_the_ID()) == "page" ) {
		get_template_part( 'post-formats/page' );
	}

	else  {
		get_template_part( 'post-formats/standard' );
	}

?>
