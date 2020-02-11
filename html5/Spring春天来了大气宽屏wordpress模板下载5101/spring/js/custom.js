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


  /* fix vertical when not overflow
  call fullscreenFix() if .fullscreen content changes */
  function fullscreenFix(){
      var h = $('body').height();
      // set .fullscreen height
      $(".homepage").each(function(i){
          if($(this).innerHeight() <= h){
              $(this).closest(".fullscreen").addClass("not-overflow");
          }
      });
  }
  $(window).resize(fullscreenFix);
  fullscreenFix();

  /* resize background images */
  function backgroundResize(){
      var windowH = $(window).height();
      $(".background").each(function(i){
          var path = $(this);
          // variables
          var contW = path.width();
          var contH = path.height();
          var imgW = path.attr("data-img-width");
          var imgH = path.attr("data-img-height");
          var ratio = imgW / imgH;
          // overflowing difference
          var diff = parseFloat(path.attr("data-diff"));
          diff = diff ? diff : 0;
          // remaining height to have fullscreen image only on parallax
          var remainingH = 0;
          if(path.hasClass("parallax")){
              var maxH = contH > windowH ? contH : windowH;
              remainingH = windowH - contH;
          }
          // set img values depending on cont
          imgH = contH + remainingH + diff;
          imgW = imgH * ratio;
          // fix when too large
          if(contW > imgW){
              imgW = contW;
              imgH = imgW / ratio;
          }
          //
          path.data("resized-imgW", imgW);
          path.data("resized-imgH", imgH);
          path.css("background-size", imgW + "px " + imgH + "px");
      });
  }
  $(window).resize(backgroundResize);
  $(window).focus(backgroundResize);
  backgroundResize();

  /********** jQuery Isotope Filterable Portfolio  **********/


  /********** jQuery Isotope Filterable Portfolio  **********/

	var $container = $('#gallery');

	if($container.length ) {
		$container.isotope({
		  itemSelector : '.view',
		  layoutMode : 'fitRows',

      resizable: false, // disable normal resizing
      // set columnWidth to a percentage of container width
      masonry: { columnWidth: $container.width() / 4 }
		});
	}


  // update columnWidth on window resize
  $(window).smartresize(function(){
    $container.isotope({
      // update columnWidth to a percentage of container width
      masonry: { columnWidth: $container.width() / 4 }
    });
  });

	var $optionSets = $('ul.filterable'),
	$optionLinks = $optionSets.find('a');

	$optionLinks.click(function(){
		var $this = $(this);
		// don't proceed if already selected
		if ( $this.hasClass('active') ) {
		return false;
		}
		var $optionSet = $this.parents('.filterable');
		$optionSet.find('li.active').removeClass('active');
		$this.parents('li').addClass('active');

		// make option object dynamically, i.e. { filter: '.my-filter-class' }
		var options = {},
		key = $optionSet.attr('data-option-key'),
		value = $this.attr('data-option-value');
		// parse 'false' as false boolean
		value = value === 'false' ? false : value;
		options[ key ] = value;
		if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
			// changes in layout modes need extra logic
			changeLayoutMode( $this, options )
		} else {
			// otherwise, apply new options
			$container.isotope( options );
		}
		return false;
	});

	/********** jQuery Isotope Filterable Portfolio  **********/


  /* smooth scrolling by id */
  $('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

			  var target = $(this.hash);
			  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			  if (target.length) {
				$('html,body').animate({
				  scrollTop: target.offset().top
				}, 1000);
				return false;
			  }
			}
		  });

  /********** sticky Header  **********/
  $(window).scroll(function() {
  if ($(this).scrollTop() > $(window).height() - $('header').height()){
      $('header').addClass("sticky");
    }
    else{
      $('header').removeClass("sticky");
    }
  });


  });
