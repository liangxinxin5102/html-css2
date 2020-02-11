jQuery(function($){
	$(document).ready(function(){
		
		// overlay hover
		$('.overlayparent').hover(function(){
			$(this).children( 'img').stop(true, true ).animate({opacity: 0.1},200);
			$(this).children( '.overlay').stop(true, true ).fadeIn(200);
			
			var $overlay = $(this).find( '.overlay' );
			var $overlayHeight = $overlay.height();
			
			$overlay.css({
				marginTop: (-$overlayHeight - 0) / 2
			})
			
		} ,function(){
			$(this).children( 'img').stop(true, true ).animate({opacity: 1},200);
			$(this).children( '.overlay').stop(true, true ).fadeOut(200);
		});
		
		//animate comments scroll
		function att_comment_scroll() {
			$(".comment-scroll a").click(function(event){		
				event.preventDefault();
				$('html,body').animate({ scrollTop:$(this.hash).offset().top}, 'normal' );
			});
		}
		att_comment_scroll();
		
		// superFish
		$(function() { 
			$("ul.sf-menu").superfish({
				delay: 200,
				autoArrows: false,
				dropShadows: false,
				animation: {opacity:'show', height:'show'},
				speed: 'fast'
			});
		});
	
	}); // end doc ready
}); // end function