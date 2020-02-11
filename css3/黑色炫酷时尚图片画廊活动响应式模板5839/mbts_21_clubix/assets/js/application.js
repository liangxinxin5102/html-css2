var Application = {

  layoutBgHeaderMenuObject            : null,
  layoutSliderPlayerObject            : null,
  layoutSliderObject                  : null,
  layoutSliderAlbumAndEventsObject    : null,
  layoutSliderAlbumAndEventsEffectIn  : ['fadeInUp', 'fadeInRight', 'fadeInDown', 'fadeInLeft'],

  sliderPlayerObjectJPlayer     : null,
  menuObject : null,

  init : function() {
    $("a[rel^='prettyPhoto']").prettyPhoto();

    this._assignLayoutComponentObjects();
    this._setLayoutComponentObjects();
    this._setScrollToTop();

    $('ul.ddd li').click(function(){

      $(this).find('ul.sub-ddd').slideToggle('fast');

    });

    this._setNiceMenu();
  },

  _setNiceMenu : function() {
    this.menuObject = $('html > body > .bg-header-menu');

    var objectInstance  = this,
        menuTopPosition = parseInt(this.menuObject.position().top, 10);

    $(window).scroll(function(){
      if(parseInt($(window).scrollTop(), 10) > menuTopPosition && objectInstance.menuObject.find('.phone-menu').is(':hidden')) {
        objectInstance.menuObject.css('position', 'fixed');
        objectInstance.menuObject.css('width', '100%');
        objectInstance.menuObject.css('top', '0');
      } else {
        objectInstance.menuObject.css('position', 'relative');
        objectInstance.menuObject.css('width', 'auto');
      }
    });
  },

  _assignLayoutComponentObjects : function() {
    this.layoutBgHeaderMenuObject         = $('html > body > .bg-header-menu:first');
    this.layoutSliderObject               = $('html > body > .container-slider:first');
    this.layoutSliderAlbumAndEventsObject = this.layoutSliderObject.find('> .bg-albums-and-events:first');
    this.layoutSliderPlayerObject         = this.layoutSliderObject.find('> .bg-audio-player:first > .container-audio-player');
  },

  _setLayoutComponentObjects : function() {
    var objectInstance = this;

    this.layoutBgHeaderMenuObject.find('ul.menu li').hover(function(){
      $(this).find('> ul').slideDown('fast');
    } , function(){
      $(this).find('> ul').fadeOut('fast');
    });

    this.layoutBgHeaderMenuObject.find('.phone-menu li.page-menu').click(function(){
      $(this).find('ul').slideToggle('fast');
    });

    this._setLayoutComponentLayoutSlider();
  },

  _setLayoutComponentLayoutSlider : function() {
    var objectInstance = this;

    this.layoutSliderObject.find('.show-hide-events-albums').click(function(){
      if(objectInstance.layoutSliderAlbumAndEventsObject.hasClass('on-going-effect'))
        return;

      objectInstance.layoutSliderAlbumAndEventsObject.addClass('on-going-effect');
      $(this).toggleClass('show-hide-events-albums-show');

      var listItems = objectInstance.layoutSliderAlbumAndEventsObject.find(' > ul > li');

      if(objectInstance.layoutSliderAlbumAndEventsObject.hasClass('hide-bg-albums-events')) {
        objectInstance.layoutSliderAlbumAndEventsObject.removeClass('hide-bg-albums-events');
        objectInstance.layoutSliderAlbumAndEventsObject.hide();

        listItems.each(function(){
          $(this).removeClass('animated');

          if(typeof $(this).attr('data-last-effect') != "undefined")
            $(this).removeClass($(this).attr('data-last-effect'));

          var effect = (objectInstance.layoutSliderAlbumAndEventsEffectIn instanceof Array ?
              objectInstance.layoutSliderAlbumAndEventsEffectIn
                  [
                  Math.floor(
                      Math.random() * objectInstance.layoutSliderAlbumAndEventsEffectIn.length
                  )
                  ]
              : objectInstance.layoutSliderAlbumAndEventsEffectIn);

          $(this).attr('data-last-effect', effect);
          $(this).addClass('animated ' + effect);
        });

        objectInstance.layoutSliderAlbumAndEventsObject.slideDown("slow", function(){

        });
      } else {
        Application.layoutSliderAlbumAndEventsSlideUp();
      }

      objectInstance.layoutSliderAlbumAndEventsObject.removeClass('on-going-effect');
    });
  },

  layoutSliderAlbumAndEventsSlideUp : function() {
    this.layoutSliderAlbumAndEventsObject.slideUp("slow", function(){
      $(this).addClass('hide-bg-albums-events');
      $(this).show();
    });
  },

  _setScrollToTop : function() {
    $('.back-to-top').click(function(event){
      event.preventDefault();
      event.stopPropagation();

      $('html, body').animate({scrollTop:0}, 'slow');
    });
  }

};

$.fn.hasAttr = function(name) {
  return this.attr(name) !== undefined;
};

(function($) {
  $.fn.getAttributes = function() {
    var attributes = {};

    if( this.length ) {
      $.each( this[0].attributes, function( index, attr ) {
        attributes[ attr.name ] = attr.value;
      } );
    }

    return attributes;
  };
})(jQuery);

if (typeof String.prototype.startsWith != 'function') {
  // see below for better implementation!
  String.prototype.startsWith = function (str){
    return this.indexOf(str) == 0;
  };
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

String.prototype.ucwords = function() {
  var str = this.toLowerCase();
  return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
      function($1){
        return $1.toUpperCase();
      });
};
