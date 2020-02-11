jQuery(window).load(function() {


/* Back to top */

	// Animate the scroll to top
	jQuery('.go-top').click(function(event) {
		event.preventDefault();
		
		jQuery('html, body').animate({scrollTop: 0}, 300);
	})
	
	
    jQuery('#topmenu').mobileMenu({
			prependTo:'.mobilenavi'
			});		
	
/* grid */
	jQuery('.latest-posts .col-md-6:nth-child(2n)').after('<div class="clear"></div>');


/*Flexslider */

	jQuery('#slide').flexslider({
        animation: "fade",
        directionNav:true,
        controlNav:false,
        prevText:"",
        nextText:""
      });	


/*Carousal */	
	jQuery("#top-slider").carouFredSel({
	
	responsive: true,
	pagination  : "#top-page",
	scroll: 1,
	items: {
			width: 300,
			height:"auto",
			visible: {
				min: 1,
				max: 4
			}
	}
	
	});
	
/* Tabs	 */

	
	jQuery('#side-tab a:last').tab('show')
	
});