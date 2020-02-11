/**
	Functionality for Alhena Lite theme.
	Author: ThemeinProgress.
	Licensed under GNU General Public License v3 or later.
*/


jQuery(document).ready(function(){
	
    jQuery('nav#mainmenu ul.menu').tinyNav({
        active: 'selected',
    });
	
	jQuery('nav#mainmenu ul > li').each(function(){
			if( jQuery('ul', this).length > 0 )
			jQuery(this).children('a').append('<span class="sf-sub-indicator"> <i class="icon-chevron-down"></i> </span>');
	}); 
	
	jQuery('nav#mainmenu li').hover(
			function () {
				jQuery(this).children('ul').stop(true, true).fadeIn(100);
	 
			}, 
			function () {
				jQuery(this).children('ul').stop(true, true).fadeOut(400);		
			}
			
	
	);

	jQuery('nav#widgetmenu ul > li').each(function(){
			if( jQuery('ul', this).length > 0 )
			jQuery(this).children('a').append('<span class="sf-sub-indicator"> &raquo;</span>').removeAttr("href");
	}); 

	jQuery('nav#widgetmenu ul > li ul').click(function(e){
		  e.stopPropagation();
		})
		.filter(':not(:first)')
		.hide();
		
	  jQuery('nav#widgetmenu ul > li, nav#widgetmenu ul > li > ul > li').click(function(){
	
		var selfClick = jQuery(this).find('ul:first').is(':visible');
		if(!selfClick) {
		  jQuery(this).parent().find('> li ul:visible').slideToggle('low');
		  
		
		}
		jQuery(this).find('ul:first').stop(true, true).slideToggle();
		
	});

	jQuery('a.social').tipsy({fade:true, gravity:'s'});
	
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
				// Parameters for PrettyPhoto styling
				animationSpeed:'fast',
				slideshow:5000,
				theme:'pp_default',
				show_title:false,
				overlay_gallery: false,
				social_tools: false
	});

});          