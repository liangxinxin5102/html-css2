/**
 * @author Andrei-Robert Rusu
 * @type {{ComponentId: number, Container: null, ContainerId: null, EventListObject: null, ShowAnimationNext: string, HideAnimationNext: string, ShowAnimationPrev: string, HideAnimationPrev: string, Init: Function, _setEventListObject: Function, _setEventListBullets: Function, _removeAnimateCSSEffects: Function, _setEventTimers: Function, _handleEventTimersSecondPass: Function, ShowNextTicket: Function, ShowPreviousTicket: Function, HandleTicketChange: Function}}
 */
Component.TicketNavigation = {

  ComponentId        : 0,
  Container          : null,
  ContainerId        : null,
  EventListObject    : null,
  ShowAnimationNext  : 'fadeInLeft',
  HideAnimationNext  : 'fadeOutRight',
  ShowAnimationPrev  : 'fadeInRight',
  HideAnimationPrev  : 'fadeOutLeft',


  Init : function(information) {

    if(typeof information.container != "object") {
      alert('Ticket Navigation - Invalid Container');
      return;
    }

    this.Container = information.container;
    this.ComponentId = information.component_id;

    if(!this.Container.hasAttr('id'))
      this.Container.attr('id', 'component-ticket-navigation-' + this.ComponentId);

    this.ContainerId = this.Container.attr('id');
    this._setEventListObject();
    this._setEventListBullets();
    this._setEventTimers();

    this.Container.hide();
    this.Container.fadeIn('slow');
  },

  _setEventListObject : function() {
    this.EventListObject = this.Container.find('> .container-information > ul');
  },

  _setEventListBullets : function() {
    var objectInstance = this;

    this.Container.find('.go-next').bind('click', function(){
      objectInstance.ShowNextTicket();
    });

    this.Container.find('.go-prev').bind('click', function(){
      objectInstance.ShowPreviousTicket();
    });
  },

  _removeAnimateCSSEffects : function(object) {
    object.removeClass('animated');
    object.removeClass(this.ShowAnimationNext);
    object.removeClass(this.ShowAnimationPrev);
    object.removeClass(this.HideAnimationNext);
    object.removeClass(this.HideAnimationPrev);
  },

  _setEventTimers : function() {
    var objectInstance = this;

    setInterval(function(){
      objectInstance._handleEventTimersSecondPass();
    }, 1000);
  },

  _handleEventTimersSecondPass : function() {
    this.EventListObject.find('> li').each(function(){
      var timeLeftContainer = $(this).find('ul.time-left'),
          currentSeconds = timeLeftContainer.find('li.sec > p.number-time').html(),
          currentMinutes = timeLeftContainer.find('li.min > p.number-time').html(),
          currentHours   = timeLeftContainer.find('li.hour > p.number-time').html(),
          currentDays    = timeLeftContainer.find('li.days > p.number-time').html();

      if(currentSeconds == 0) {
        currentSeconds = 60;

        currentMinutes--;

        if(currentMinutes == 0) {
          currentMinutes = 60;

          currentHours--;

          if(currentHours == 0) {
            currentHours = 24;

            currentDays--;
          }
        }
      }

      currentSeconds--;

      timeLeftContainer.find('li.sec > p.number-time').html(currentSeconds < 10 ? '0' + currentSeconds : currentSeconds);

      if(currentMinutes != timeLeftContainer.find('li.min > p.number-time').html()) {
        timeLeftContainer.find('li.min > p.number-time').html(currentMinutes < 10 ? '0' + currentMinutes : currentMinutes);

        if(currentHours != timeLeftContainer.find('li.hour > p.number-time').html()) {
          timeLeftContainer.find('li.hour > p.number-time').html(currentHours < 10 ? '0' + currentHours : currentHours);

          if(currentDays != timeLeftContainer.find('li.days > p.number-time').html())
            timeLeftContainer.find('li.days > p.number-time').html(currentDays < 10 ? '0' + currentDays : currentDays);

        }
      }
    });
  },

  ShowNextTicket : function() {
    var nextEventObject =
        ((this.EventListObject.find('> li:visible').index() + 1) == this.EventListObject.find('> li').length) ?
          this.EventListObject.find('> li').eq(0)
        : this.EventListObject.find('> li:visible').next();

    this.HandleTicketChange(nextEventObject, 'next');
  },

  ShowPreviousTicket : function() {
    var nextEventObject =
        (this.EventListObject.find('> li:visible').index() == 0) ?
            this.EventListObject.find('> li').eq(this.EventListObject.find('> li').length - 1)
            : this.EventListObject.find('> li:visible').prev();

    this.HandleTicketChange(nextEventObject, 'prev');
  },

  HandleTicketChange : function(nextEventObject, type) {
    var objectInstance     = this,
        currentEventObject = this.EventListObject.find('> li:visible');

    type = typeof type == "undefined" ? 'next' : type;

    nextEventObject.hide();
    this._removeAnimateCSSEffects(nextEventObject);

    this._removeAnimateCSSEffects(this.EventListObject.find('> li:visible'));

    if(type == 'prev')
      currentEventObject.addClass('animated ' + this.HideAnimationPrev);
    else
      currentEventObject.addClass('animated ' + this.HideAnimationNext);

    setTimeout(function(){
      currentEventObject.hide();

      if(type == 'prev')
        nextEventObject.show().addClass('animated ' + objectInstance.ShowAnimationPrev);
      else
        nextEventObject.show().addClass('animated ' + objectInstance.ShowAnimationNext);

    }, 500);
  }

};