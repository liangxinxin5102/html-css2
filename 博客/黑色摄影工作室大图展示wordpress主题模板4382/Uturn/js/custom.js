jQuery(document).ready(function() {


/* Flexslider */

 jQuery('#kentcarousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 140,
    itemMargin: 20,
    asNavFor: '#kentslider'
  });
   
  jQuery('#kentslider').flexslider({
    animation: "slide",
    controlNav: false,
    directionNav: false,
    animationLoop: false,
    slideshow: true,
    sync: "#kentcarousel"
  });
	 
	 
/* Tabs	  */
/*
	 
jQuery('#tabs div').hide();
jQuery('#tabs div:first').show();
jQuery('#tabs ul.tabnav li:first').addClass('active');
 
jQuery('#tabs ul.tabnav li a').click(function(){
jQuery('#tabs ul.tabnav li').removeClass('active');
jQuery(this).parent().addClass('active');
var currentTab = jQuery(this).attr('href');
jQuery('#tabs div').hide();
jQuery(currentTab).show();
return false;
});
	 
	 
*/
	 
/* Banner claaass */

	jQuery('.squarebanner ul li:nth-child(even)').addClass('rbanner');


	
});