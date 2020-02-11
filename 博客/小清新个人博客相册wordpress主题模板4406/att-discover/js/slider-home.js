jQuery(function($){
	$(window).load(function() {		
		if (flexLocalize.slideshow == "true") flexLocalize.slideshow = true; else flexLocalize.slideshow = false;
		if (flexLocalize.randomize == "true") flexLocalize.randomize = true; else flexLocalize.randomize = false;		
		$('#home-slider.flexslider').flexslider({
			slideshow : flexLocalize.slideshow,
			randomize : flexLocalize.randomize,
			animation : flexLocalize.animation,
			direction : flexLocalize.direction,
			slideshowSpeed : flexLocalize.slideshowSpeed,
			animationSpeed : flexLocalize.animationSpeed,
			smoothHeight : true,
			controlNav : false,
			prevText: '<i class="icon-chevron-left"></i>',
			nextText: '<i class="icon-chevron-right"></i>',
		});		
	});
});