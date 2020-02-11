jQuery(function($){
	$(window).load(function() {
		
		// Homepage
    	$('#home-slider .flexslider').flexslider({
			animation: 'slide',
			slideshow: false,
			smoothHeight: true,
			controlNav: false,
			prevText: '<span>Back</span>',
			nextText: '<span>Next</span>',
			start: function(slider) {
 				slider.removeClass( 'slider-loading' );
			}
		});
		
		// Portfolio
		$('#single-portfolio-media .flexslider').flexslider({
			animation: 'slide',
			slideshow: false,
			smoothHeight: true,
			controlNav: false,
			prevText: '<span>Back</span>',
			nextText: '<span>Next</span>',
		});
		
	}); // end window load
}); // end function