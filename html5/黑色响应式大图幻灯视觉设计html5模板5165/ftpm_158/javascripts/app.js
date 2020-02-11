(function($){  
  $(function(){
    
    $(document).foundationAlerts();
    $(document).foundationAccordion();
    $(document).tooltips();
    $('input, textarea').placeholder();
    
    $(document).foundationButtons();
    
    $(document).foundationNavigation();
    $(document).foundationCustomForms();
    $(document).foundationTabs({callback:$.foundation.customForms.appendCustomMarkup});
    
    // UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE8 SUPPORT AND ARE USING .block-grids
     $('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'left'});
     $('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'left'});
     $('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'left'});
     $('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'left'});
  });
  
  
})(jQuery);

//portfolio mouseover effects

$(document).ready(function(){
	
if (window.innerWidth < 768) {
$(".projects li img.a").hover(
function() {
$(this).stop().animate({"opacity": "0.7"}, "fast");
},
function() {
$(this).stop().animate({"opacity": "1"}, "fast");
});
}
else  {
$(".projects li img.a").hover(
function() {
$(this).stop().animate({"opacity": "0"}, "fast");
},
function() {
$(this).stop().animate({"opacity": "1"}, "fast");
});
}	
 
});


//portfolio click item effects

$(document).ready(function(){
  $('#project-titles a').click(function(){
    var target = $(this).attr("class");
	$('#project-descriptions>div').fadeOut(500);
    $(target).fadeIn(500);
	$('#project-titles').fadeIn(500);
	$(".projects li img.a").fadeIn(500);
	$('#portfolio .close').fadeIn(500);
  });
  
  $('#project-titles a.fancybox,#project-titles a.fancybox-media').click(function() {
 
    var target = $(this).attr("class");
	$('#portfolio .close').hide();
  });

  $('#portfolio .close').click(function(){
	$('#project-titles').fadeIn(500);
    $('#project-descriptions>div').fadeOut(500);
	$(".projects li img.a").fadeIn(500);
	$('#portfolio .close').fadeOut(500);
  })
  
  $('.top').click(function(){
    $('#project-titles').fadeIn(500);
	$('#project-descriptions>div').fadeOut(500);
	$('#portfolio .close').fadeOut(500);
  })
  
  
  $('#back-to-top').click(function(){
	$('#project-titles').fadeIn(500);
    $('#project-descriptions>div').fadeOut(500);
	$('#portfolio .close').fadeOut(500);
  })
    
});

//back to top button

$(window).scroll(function () {
		if ($(this).scrollTop() > 600) {
			$('#back-to-top').fadeIn('slow');
		} else {
			$('#back-to-top').fadeOut('slow');
		}
	});
	
//camera slider settings
jQuery('#camera_wrap_1').camera({
autoAdvance: true,	
thumbnails: false,
height: '457px',
easing: 'easeInOutExpo',
fx: 'curtainBottomLeft',
navigationHover: false,
pagination: true,
pauseOnClick: false,
playPause: false,
navigation: true,
loader: 'none',
time: 3500});


//flex slider settings #portfolio

$('#project-titles a').click(function() {
   $('.flexslider').flexslider({ 
        controlNav: true,
        directionNav: false,
        slideToStart: 0,  
        pauseOnHover: true,
        start: function(slider) {
        if (slider.currentSlide !== 0) slider.flexAnimate(0);
        }
   });
});

//fancybox 2

		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});


//google map
$(function(){
      
        $('#maplocation').gmap3(
          { action:'setDefault', 
            classes:{Marker:MarkerWithLabel}
          },
          { action: 'addMarker',
            address: "WYFF-4, Rutherford Street, Greenville, SC, United States",
            marker:{
               labelContent: "$425K",
               labelAnchor: new google.maps.Point(52, -2),
               labelClass: "gmaplabels",
               labelStyle: {opacity: 0.75},
               labelContent: "Moses / Digital Solutions"
            },
            map:{
              center: true,
              zoom: 14,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            }
          }
          );
      });