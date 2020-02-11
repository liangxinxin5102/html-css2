jQuery.noConflict();
    jQuery(document).ready(function($){
    /********** jquery dropdown menu **********/
	$('ul.sf-menu').superfish({
		autoArrows:  false
	});
	
	
	$('.gallery').magnificPopup({
          delegate: 'a',
          type: 'image',
          closeOnContentClick: false,
          closeBtnInside: false,
          mainClass: 'mfp-with-zoom mfp-img-mobile',
          image: {
            verticalFit: true,
            titleSrc: function(item) {
              return item.el.attr('title') + '';
            }
          },
          gallery: {
            enabled: true
          },
          zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
              return element.find('img');
            }
          }
          
        });
	
	/********** jquery responsive dropdown menu **********/
    $("<select />").appendTo("nav");
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Select Page..."
      }).appendTo("nav select");
      $("nav a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav select");
      });
      $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
  });


    });