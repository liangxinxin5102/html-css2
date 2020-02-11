$(function() {
	var demo1 = $("#demo1").slippry({
		transition: 'fade',
		useCSS: true,
		speed: 1000,
		pause: 5000,
		auto: true
	});

	$('.stop').click(function () {
		demo1.stopAuto();
	});

	$('.start').click(function () {
		demo1.startAuto();
	});

	$('.prev').click(function () {
		demo1.goToPrevSlide();
		return false;
	});
	$('.next').click(function () {
		demo1.goToNextSlide();
		return false;
	});
	$('.reset').click(function () {
		demo1.destroySlider();
		return false;
	});
	$('.reload').click(function () {
		demo1.reloadSlider();
		return false;
	});
	$('.init').click(function () {
		demo1 = $("#demo1").slippry();
		return false;
	});
});

$(document).ready(function() {
	
        $('.header_menu li').hover(
            function () {
                $('ul:first', this).css('display','block');
            }, 
            function () {
                $('ul:first', this).css('display','none');         
            }
        );               				
	    
	$('.archive_box_media').hover(
		function() {
			$(this).find('.archive_box_hover').css('display','block');
		},
		function() {
			$(this).find('.archive_box_hover').css('display','none');
		}
	);
	    
	$('.header_spacing').css('height', $('#header').outerHeight() + 'px');
	    
	$('#main_header_menu').slicknav();
	    
	if($('#header').css('position') == 'absolute')
		$('#header').css('top', $('.slicknav_menu').outerHeight() + 'px');
	else
		$('#header').css('top', '0px');
	    
});

$(window).load(function() {

	$('.header_spacing').css('height', $('#header').outerHeight() + 'px');

});

$(window).scroll(function() {

	$('.header_spacing').css('height', $('#header').outerHeight() + 'px');
	if($('#header').css('position') == 'absolute')
		$('#header').css('top', $('.slicknav_menu').outerHeight() + 'px');
	else
		$('#header').css('top', '0px');
	
});

$(window).resize(function() {
	if($('#header').css('position') == 'absolute')
		$('#header').css('top', $('.slicknav_menu').outerHeight() + 'px');
	else
		$('#header').css('top', '0px');
});