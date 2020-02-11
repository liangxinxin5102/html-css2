/**
 * @author Andrei-Robert Rusu
 */
Component.ImageSlider = {

  ComponentId         : 0,
  Container           : null,
  SliderListObject    : {},
  SliderListCurrentDisplayedIndex : 0,
  SliderPreviousItemElementTrigger : {},
  SliderNextItemElementTrigger : {},
  ShowAnimationNext  : 'fadeInLeft',
  HideAnimationNext  : 'fadeOutRight',
  ShowAnimationPrev  : 'fadeInRight',
  HideAnimationPrev  : 'fadeOutLeft',

  Init : function(information) {

    if(typeof information.container != "object") {
      alert('Image Slider - Invalid Container');
      return;
    }

    this.Container = information.container;
    this.ComponentId = information.component_id;

    this._setSliderObjects();
    this._hideSliderItemsAndShowFirst();
    this._setSliderPrevNextEvents();
  },

  _setSliderObjects : function() {
    this.SliderListObject = this.Container.find('.container-image-single-slider');
    this.SliderPreviousItemElementTrigger = this.Container.find('.left-arrow-slider-single');
    this.SliderNextItemElementTrigger = this.Container.find('.right-arrow-slider-single');
  },

  _hideSliderItemsAndShowFirst : function() {
    this.SliderListObject
        .find('> li').hide();
    this.SliderListObject.find('> li')
        .eq(0).show();
  },

  _setSliderPrevNextEvents : function() {
    var objectInstance = this;

    this.SliderPreviousItemElementTrigger.bind('click', function(event) {
      event.stopImmediatePropagation();
      event.preventDefault();

      objectInstance.ShowPreviousSliderImage();
    });

    this.SliderNextItemElementTrigger.bind('click', function(event) {
      event.stopImmediatePropagation();
      event.preventDefault();

      objectInstance.ShowNextSliderImage();
    });
  },

  ShowNextSliderImage : function() {
    var nextSlideObject =
        ((this.SliderListObject.find('> li:visible').index() + 1) == this.SliderListObject.find('> li').length) ?
            this.SliderListObject.find('> li').eq(0)
            : this.SliderListObject.find('> li:visible').next();

    this.HandleSlideChange(nextSlideObject, 'next');
  },

  ShowPreviousSliderImage : function() {
    var nextSlideObject =
        (this.SliderListObject.find('> li:visible').index() == 0) ?
            this.SliderListObject.find('> li').eq(this.SliderListObject.find('> li').length - 1)
            : this.SliderListObject.find('> li:visible').prev();

    this.HandleSlideChange(nextSlideObject, 'prev');
  },

  _removeAnimateCSSEffects : function(object) {
    object.removeClass('animated');
    object.removeClass(this.ShowAnimationNext);
    object.removeClass(this.ShowAnimationPrev);
    object.removeClass(this.HideAnimationNext);
    object.removeClass(this.HideAnimationPrev);
  },

  HandleSlideChange : function(nextSlideObject, type) {
    var objectInstance     = this,
        currentEventObject = this.SliderListObject.find('> li:visible');

    type = typeof type == "undefined" ? 'next' : type;

    nextSlideObject.hide();

    this._removeAnimateCSSEffects(nextSlideObject);

    this._removeAnimateCSSEffects(this.SliderListObject.find('> li:visible'));

    if(type == 'prev')
      currentEventObject.addClass('animated ' + this.HideAnimationPrev);
    else
      currentEventObject.addClass('animated ' + this.HideAnimationNext);

    setTimeout(function(){
      currentEventObject.hide();

      if(type == 'prev')
        nextSlideObject.show().addClass('animated ' + objectInstance.ShowAnimationPrev);
      else
        nextSlideObject.show().addClass('animated ' + objectInstance.ShowAnimationNext);

    }, 500);
  }


};