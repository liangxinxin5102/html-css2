/**
 * @author Andrei-Robert Rusu
 * @type {{ComponentId: number, Container: null, ContainerId: null, PlayerContainer: null, PlayerContainerId: null, TrackList: {}, TrackCount: number, CurrentTrackNumber: number, AutoPlay: number, Init: Function, _setPlayer: Function, _setTrackList: Function, _definePlayerContainer: Function, _setPlayerInstance: Function, _setPlayerChangeTrack: Function, _setPlayerLoadingBar: Function, SetSongAtIndexAsPlaying: Function, _pauseOtherPlayerComponentSongs: Function, PlaySong: Function, StartSong: Function, PauseSong: Function}}
 */
Component.AudioPlayerLarge = {

  ComponentId        : 0,
  Container          : null,
  ContainerId        : null,
  PlayerContainer    : null,
  PlayerContainerId  : null,
  TrackList          : {},
  TrackCount         : 0,
  CurrentTrackNumber : 0,
  AutoPlay           : 0,

  Init : function(information) {

    if(typeof information.container != "object") {
      alert('Audio Player Large - Invalid Container');
      return;
    }

    if(typeof information.auto_play != "undefined")
      this.AutoPlay = information.auto_play;


    this.Container = information.container;
    this.ComponentId = information.component_id;

    if(!this.Container.hasAttr('id'))
      this.Container.attr('id', 'component-audio-player-large-' + this.ComponentId);

    this.ContainerId = this.Container.attr('id');

    this.Container.hide();
    this._setPlayer();
    this._setBulletListDisplay();
    this.Container.fadeIn('slow');
  },

  _setBulletListDisplay : function() {
    var objectInstance = this;

    this.Container.find('.menu-button-icon button').click(function(){
      objectInstance.Container.find('.menu-button-icon').toggleClass('blue');
      objectInstance.Container.find('.menu-button-icon button.icon-menu-header-player').toggleClass('blue');
      objectInstance.Container.find('.sub-menu-audio-player').fadeToggle('fast')
    });
  },

  _setPlayer : function() {
    this._setTrackList();
    this._definePlayerContainer();
    this._setPlayerInstance();
    this._setPlayerChangeTrack();
    this._setPlayerLoadingBar();
  },

  _setTrackList : function() {
    var objectInstance = this;

    this.Container.find('.track').each(function(index){
      objectInstance.TrackList[index] = {};
      objectInstance.TrackList[index].index = index;

      if($(this).hasClass('selected')) {
        objectInstance.CurrentTrackNumber = index;
      }

      var attributes = $(this).getAttributes();

      $.each(attributes, function(key, value){
        if(key.startsWith('data-')) {
          var theKey = key.substr(5).replace('-', ' ').ucwords().replace(' ', '');
          theKey = theKey.charAt(0).toLowerCase() + theKey.substr(1);

          objectInstance.TrackList[index][theKey] = value;
        }
      });

      objectInstance.TrackCount++;
    });
  },

  _definePlayerContainer : function() {
    this.PlayerContainerId = 'player-container-' + this.ContainerId;

    this.Container.before('<div id="' + this.PlayerContainerId + '"></div>');

    this.PlayerContainer = $('#' + this.PlayerContainerId);
  },

  _setPlayerInstance : function() {
    var objectInstance = this;

    this.PlayerContainer.jPlayer({
      ready: function () {
        objectInstance.SetSongAtIndexAsPlaying(objectInstance.CurrentTrackNumber);

        if(objectInstance.AutoPlay == 1)
          objectInstance.StartSong();

        objectInstance.Container.find('.play').bind('click', function(){
          objectInstance.StartSong();
        });

        objectInstance.Container.find('.pause').bind('click', function(){
          objectInstance.PauseSong();
        });

        objectInstance.Container.find('.prev-song').bind('click', function(){
          if(objectInstance.CurrentTrackNumber == 0)
            objectInstance.PlaySong((objectInstance.TrackCount - 1));
          else
            objectInstance.PlaySong(objectInstance.CurrentTrackNumber - 1);
        });

        objectInstance.Container.find('.next-song').bind('click', function(){
          if(objectInstance.CurrentTrackNumber == (objectInstance.TrackCount - 1))
            objectInstance.PlaySong(0);
          else
            objectInstance.PlaySong((objectInstance.CurrentTrackNumber + 1));
        });
      },
      timeupdate: function(event) {
        var timeLeft = parseInt(event.jPlayer.status.duration, 10) - parseInt(event.jPlayer.status.currentTime, 10);

        if(timeLeft == 0)
          timeLeft = parseInt(event.jPlayer.status.duration, 10);

        if(timeLeft == 0) {
          objectInstance.Container.find('.info-time > .time-player-head').html('');
          objectInstance.Container.find('.time-of-song > .time').css('width', '0px');
          return;
        }


        var minutesLeft = parseInt(timeLeft / 60),
            secondsLeft = timeLeft % 60;

        secondsLeft = secondsLeft < 10 ? '0' + secondsLeft : secondsLeft;

        objectInstance.Container.find('.info-time > .time-player-head').html('- ' + minutesLeft + ':' + secondsLeft);

        objectInstance.Container.find('.time-of-song > .time').css('width', parseInt(event.jPlayer.status.currentPercentAbsolute, 10) + '%');
      },
      play: function(event) {

      },
      pause: function(event) {

      },
      ended: function(event) {
        objectInstance.PauseSong();
        objectInstance.Container.find('.info-time > .time-player-head').html('Finished');
      },
      swfPath: "assets/jplayer/",
      cssSelectorAncestor: "#" + objectInstance.PlayerContainerId,
      supplied: "mp3",
      wmode: "window"
    });
  },

  _setPlayerChangeTrack : function() {
    var objectInstance = this;

    this.Container.find(".track").bind('click', function(e) {
      e.preventDefault();
      e.stopPropagation();

      objectInstance.PlaySong($(this).index());
      return false;
    });
  },

  _setPlayerLoadingBar : function() {
    var objectInstance = this;

    this.Container.find('.time-of-song').bind('click', function(event) {
      var container = $(this),
          containerWidth = parseInt(container.width(), 10),
          containerClickPosition = (event.pageX - container.offset().left);

      var percent = parseInt(containerClickPosition/containerWidth * 100, 10);

      objectInstance.PlayerContainer.jPlayer('playHead', percent);
    });
  },

  SetSongAtIndexAsPlaying : function(songIndex) {
    var songInformation = this.TrackList[songIndex],
        currentTrackListItemObject  = this.Container.find('.track').eq(songIndex);

    this.Container.find('.track')
        .eq(this.CurrentTrackNumber)
        .find('.img-play-list > img')
        .attr('src', this.TrackList[this.CurrentTrackNumber].songPicture);

    this.Container.find('.track').removeClass('selected');
    currentTrackListItemObject.addClass('selected')
        .find('.img-play-list > img').attr('src', 'assets/img/play-icon-min.png');

    var authorNameContainer = this.Container.find('.song-and-author > p.author'),
        songNameContainer   = this.Container.find('.song-and-author > p.song-name'),
        songPictureContainer= this.Container.find('.song-and-author > img'),
        songInformationContainer = this.Container.find('.info-time > .right');

    authorNameContainer.fadeOut('fast', function(){
      authorNameContainer.html(songInformation.authorName);
      authorNameContainer.fadeIn('fast');
    });

    songNameContainer.fadeOut('fast', function(){
      songNameContainer.html(songInformation.songName);
      songNameContainer.fadeIn('fast');
    });

    songPictureContainer.fadeOut('fast', function(){
      songPictureContainer.attr('src', songInformation.songPicture);
      songPictureContainer.fadeIn('fast');
    });

    songInformationContainer.fadeOut('fast', function(){
      songInformationContainer.html((songIndex + 1) + ' . ' + songInformation.authorName + ' - ' + songInformation.songName);
      songInformationContainer.fadeIn('fast');
    });

    this.PlayerContainer.jPlayer("setMedia", {
      mp3: songInformation.songPath
    });
  },

  _pauseOtherPlayerComponentSongs : function() {
    var objectInstance = this,
        componentIds = Component.FetchComponentInComponentCollection(['audio-player-large', 'audio-player']);

    $.each(componentIds, function(key, component_id) {
      if(typeof Component.GetComponent(component_id).PauseSong != "undefined"
          && component_id != objectInstance.ComponentId)
        Component.GetComponent(component_id).PauseSong();
    })
  },

  PlaySong : function(songIndex) {
    var songInformation = this.TrackList[songIndex];

    this.SetSongAtIndexAsPlaying(songIndex);
    this.CurrentTrackNumber = songIndex;

    this.PlayerContainer.jPlayer("setMedia", {
      mp3: songInformation.songPath
    });

    this.StartSong();
  },

  StartSong : function() {
    this._pauseOtherPlayerComponentSongs();

    this.Container.find('.play').hide();
    this.Container.find('.pause').show();

    this.PlayerContainer.jPlayer("play");
  },

  PauseSong : function() {
    this.Container.find('.play').show();
    this.Container.find('.pause').hide();

    this.PlayerContainer.jPlayer("pause");
  }

};