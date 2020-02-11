jQuery(function($){
	$(window).load(function() {
		
		$('.portfolio-filter li a').click(function() {
			var cat = $(this).data('filter');
			
			$('.portfolio-filter a').removeClass('active');
			$(this).addClass('active');
			
			$('.portfolio-entry').removeClass('portfolio-entry-fade');
			
			if(cat == '*') {
			  $('#portfolio').children('div.portfolio-entry').removeClass('portfolio-entry-fade');
			}
			else {
			  $('.portfolio-entry').not(cat).addClass('portfolio-entry-fade');
			}
			
			return false;
		});
		
	});
});