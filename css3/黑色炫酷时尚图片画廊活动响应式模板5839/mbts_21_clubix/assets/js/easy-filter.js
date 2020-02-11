/**
 * @author Andrei-Robert Rusu
 */
var EasyFiler = {

  currentFilterKey    : "",
  currentFilterValue  : "",
  showEffect          : ['fadeInUp', 'fadeInRight', 'fadeInDown', 'fadeInLeft'],
  hideEffect          : ['fadeOutUp', 'fadeOutRight', 'fadeOutDown', 'fadeOutLeft'],
  showEffectStringList : 'fadeInUp fadeInRight fadeInDown fadeInLeft',
  hideEffectStringList : 'fadeOutUp fadeOutRight fadeOutDown fadeOutLeft',

  Init : function() {
    var objectInstance = this;

    $(window).bind('hashchange', function() {
      objectInstance.HandleCurrentHash();
    });

    this.HandleCurrentHash();
  },

  HandleCurrentHash : function() {
    this.SetCurrentFilters();
    this.ToggleCurrentFilterPanel();
    this.DisplayCurrentFilterItems();
  },

  SetCurrentFilters : function() {
    var hash = window.location.hash;
    hash = hash.substr(1);

    if(hash.indexOf('=') != -1) {
      this.currentFilterKey   = hash.substr(0, hash.indexOf('='));
      this.currentFilterValue = decodeURIComponent(hash.substr(hash.indexOf('=') + 1));

      this.currentFilterValue = this.currentFilterValue.replace('+', ' ');
    } else {
      this.currentFilterKey   = '';
      this.currentFilterValue = 'all';
    }
  },

  ToggleCurrentFilterPanel : function() {
    $('.listFilterPanel')
        .removeClass('selected')
        .find("> a")
        .removeClass('selected');
    $('.listFilterPanel[data-filter="' + this.currentFilterValue+ '"]')
        .addClass('selected')
        .find("> a")
        .addClass('selected');
  },

  DisplayCurrentFilterItems : function() {
    var objectList = $('.listFilterItem');

    if(this.currentFilterValue == 'all') {
      this.DisplayListObject(objectList);
    } else {
      this.HideListObject(objectList,
                          objectList.filter('[data-filter="' + this.currentFilterValue+ '"]'));
    }
  },

  ClearAnimations   : function(listObject) {
    listObject.removeClass('animated ' + this.showEffectStringList + ' ' + this.hideEffectStringList);
  },

  HideListObject : function(listObject, displayListObject) {
    var objectInstance = this;

    this.ClearAnimations(listObject);

    listObject.each(function(){
      $(this).removeClass('animated');

      if(typeof $(this).attr('data-last-effect') != "undefined")
        $(this).removeClass($(this).attr('data-last-effect'));

      var effect = (objectInstance.hideEffect instanceof Array ?
          objectInstance.hideEffect
              [
              Math.floor(
                  Math.random() * objectInstance.hideEffect.length
              )
              ]
          : objectInstance.hideEffect);

      $(this).show();
      $(this).addClass('animated ' + effect);
    });

    setTimeout(function(){
      listObject.hide();

      objectInstance.ClearAnimations(displayListObject);
      displayListObject.show();
    }, 500);
  },

  DisplayListObject : function(listObject) {
    var objectInstance = this;

    this.ClearAnimations(listObject);

    listObject.each(function(){
      $(this).removeClass('animated');

      if(typeof $(this).attr('data-last-effect') != "undefined")
        $(this).removeClass($(this).attr('data-last-effect'));

      var effect = (objectInstance.showEffect instanceof Array ?
          objectInstance.showEffect
              [
              Math.floor(
                  Math.random() * objectInstance.showEffect.length
              )
              ]
          : objectInstance.showEffect);

      $(this).show();
      $(this).addClass('animated ' + effect);
    });
  }

};