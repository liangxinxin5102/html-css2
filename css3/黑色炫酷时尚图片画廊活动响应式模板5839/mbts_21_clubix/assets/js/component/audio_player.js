/**
 * @author Andrei-Robert Rusu
 * @type {{ComponentId: number, Container: null, ContainerId: null, PlayerContainer: null, PlayerContainerId: null, TrackList: {}, TrackCount: number, CurrentTrackNumber: number, Init: Function, _setPlayer: Function, _setTrackList: Function, _definePlayerContainer: Function, _setPlayerInstance: Function, _setPlayerLoadingBar: Function, SetSongAtIndexAsPlaying: Function, PlaySong: Function, _pauseOtherPlayerComponentSongs: Function, StartSong: Function, PauseSong: Function}}
 */
Component.AudioPlayer = {

  ComponentId        : 0,
  Container          : null,
  ContainerId        : null,
  PlayerContainer    : null,
  PlayerContainerId  : null,
  TrackList          : {},
  TrackCount         : 0,
  CurrentTrackNumber : 0,

  Init : function(information) {

    if(typeof information.container != "object") {
      alert('Audio Player - Invalid Container');
      return;
    }

    this.Container = information.container;
    this.ComponentId = information.component_id;

    if(!this.Container.hasAttr('id'))
      this.Container.attr('id', 'component-audio-player-' + this.ComponentId);

    this.ContainerId = this.Container.attr('id');

    this.Container.hide();
    this._setPlayer();
    this.Container.fadeIn('slow');
  },

  _setPlayer : function() {
    this._setTrackList();
    this._definePlayerContainer();
    this._setPlayerInstance();
    this._setPlayerLoadingBar();
  },

  _setTrackList : function() {
    var objectInstance = this;

    this.Container.find('.track').each(function(index){
      objectInstance.TrackList[index] = {};
      objectInstance.TrackList[index].index = index;

      var attributes = $(this).getAttributes();

      $(this).attr('data-track-number', index);

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

        objectInstance.Container.find('.play-pause-sec').bind('click', function(){
          if($(this).hasClass('pause-playing'))
            objectInstance.PauseSong();
          else {
            if($(this).parents('li').find('.song-name-side-bar > .timer-bg-sidebar').width() != 0)
              objectInstance.StartSong();
            else
              objectInstance.PlaySong($(this).parents('li').attr('data-track-number'));
          }
        });
      },
      timeupdate: function(event) {
        var timeLeft = parseInt(event.jPlayer.status.duration, 10) - parseInt(event.jPlayer.status.currentTime, 10);

        if(timeLeft == 0)
          timeLeft = parseInt(event.jPlayer.status.duration, 10);

        if(timeLeft == 0) {
          objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('.song-name-side-bar > .song-name-text').html('');
          objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('.song-name-side-bar > .timer-bg-sidebar').css('width', '0px');
          return;
        }


        var minutesLeft = parseInt(timeLeft / 60),
            secondsLeft = timeLeft % 60;

        secondsLeft = secondsLeft < 10 ? '0' + secondsLeft : secondsLeft;

        objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('.song-name-side-bar > .song-name-text').html('- ' + minutesLeft + ':' + secondsLeft);

        objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('.song-name-side-bar > .timer-bg-sidebar').css('width', parseInt(event.jPlayer.status.currentPercentAbsolute, 10) + '%');
      },
      play: function(event) {

      },
      pause: function(event) {

      },
      ended: function(event) {
        objectInstance.PauseSong();
        objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('.song-name-side-bar > .song-name-text').html('Finished');
      },
      swfPath: "assets/jplayer/",
      cssSelectorAncestor: "#" + objectInstance.PlayerContainerId,
      supplied: "mp3",
      wmode: "window"
    });
  },

  _setPlayerLoadingBar : function() {
    var objectInstance = this;

    this.Container.find('.song-name-side-bar').bind('click', function(event) {
      if(!($(this).parents('li:first').hasClass('playng-song-sidebar')))
        return;

      var container = $(this),
          containerWidth = parseInt(container.width(), 10),
          containerClickPosition = (event.pageX - container.offset().left);

      var percent = parseInt(containerClickPosition/containerWidth * 100, 10);

      objectInstance.PlayerContainer.jPlayer('playHead', percent);
    });
  },

  SetSongAtIndexAsPlaying : function(songIndex) {
    var songInformation = this.TrackList[songIndex];

    this.PlayerContainer.jPlayer("setMedia", {
      mp3: songInformation.songPath
    });
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

  _pauseOtherPlayerComponentSongs : function() {
    var objectInstance = this,
        componentIds = Component.FetchComponentInComponentCollection(['audio-player-large', 'audio-player']);

    $.each(componentIds, function(key, component_id) {
      if(typeof Component.GetComponent(component_id).PauseSong != "undefined"
          && component_id != objectInstance.ComponentId)
        Component.GetComponent(component_id).PauseSong();
    })
  },

  StartSong : function() {
    var objectInstance = this;

    this.Container.find('li.track')
        .removeClass('playng-song-sidebar')
        .find('.play-pause-sec').removeClass('pause-playing template-based-element-background-color')
        .find('> .image-play-side-bar').removeClass('pause-side-bar');
    this.Container.find('li.track .song-name-side-bar').removeClass('playng-song-sidebar');

    this.Container.find('li.track')
        .eq(this.CurrentTrackNumber)
        .addClass('playng-song-sidebar')
        .find('.play-pause-sec').addClass('pause-playing template-based-element-background-color')
        .find('> .image-play-side-bar').addClass('pause-side-bar');
    this.Container.find('li.track')
        .eq(this.CurrentTrackNumber)
        .find('.song-name-side-bar').addClass('playng-song-sidebar');

    this._pauseOtherPlayerComponentSongs();
    this.PlayerContainer.jPlayer("play");
  },

  PauseSong : function() {
    this.Container.find('li.track')
        .removeClass('playng-song-sidebar')
        .find('.play-pause-sec').removeClass('pause-playing template-based-element-background-color')
        .find('> .image-play-side-bar').removeClass('pause-side-bar');
    this.Container.find('li.track .song-name-side-bar').removeClass('playng-song-sidebar');

    this.PlayerContainer.jPlayer("pause");
  }

};