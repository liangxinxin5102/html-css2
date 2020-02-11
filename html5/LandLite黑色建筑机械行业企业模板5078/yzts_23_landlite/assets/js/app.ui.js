$(document).ready(function () {
    if (!$.browser.mobile) {
        $("html").niceScroll({ scrollspeed: 200 });
        $(window).scroll(function () {
            $("html").getNiceScroll().resize();
        });
    }

    init_header();

    if (showTimer) {
        init_timer();
    }
    else {
        $('#counter .slogan').removeClass('hidden');
        $('#counter .timer').addClass('hidden');
    }

    init_twitter();

    if (isSliderEnabled) {
        init_slider();
    }
    else {
        if (isVideoBgEnabled) {
            init_video();
        } else {
            if (isParallaxEnabled) {
                init_parallax();
            }
            else {
                if (isSolidColorEnabled) {
                    init_solidColor();
                }
            }
        }
    }

    init_smoothScroll();
    init_scrollToTop();
    call_animations();
});

$(window).resize(function () {
    init_header();
    call_animations();
});

function init_header() {
    var headerHeight = $('#header').height();
    var windowHeight = $(window).height();
    var midWindowHeight = windowHeight / 2;
    $('#header').css({ 'padding-top': midWindowHeight - (headerHeight / 2) + 20, 'padding-bottom': midWindowHeight - (headerHeight / 2) - 20 });
}

function init_timer() {
    $('#counter').countdown({
        finalDate: countdown_timer
    });
}

function init_parallax() {
    $('#parallax-section-1 .bg1').parallax("50%", 0.6);
    $('#parallax-section-2 .bg2').parallax("50%", 0.6);
}

function init_twitter() {
    $('#twitterfeed_ticker1').tweet({
        modpath: 'assets/twitter/',
        count: 5,
        loading_text: 'loading...',
        username: twitter_username,
        template: "<div class=\"col-lg-12 text-center col-icon\"><span class=\"fa fa-twitter fa-3x\"></span></div>" +
                  "<div class=\"col-lg-12 text-center col-tweet\">{join}{text}<div class=\"clearfix\"></div>{time}</div>" +
                  "<div class=\"clearfix\"></div>"
    });
    $('#twitterfeed_ticker1 .tweet_list li').not(":first").hide();
    function tick() {
        $('#twitterfeed_ticker1 .tweet_list li:first').fadeOut(function () { $(this).appendTo($('#twitterfeed_ticker1 .tweet_list')).hide(); $('#twitterfeed_ticker1 .tweet_list li:first').fadeIn(); });
    }
    setInterval(function () { tick() }, 5000);
}

function init_video() {
    $('.bg-video').mb_YTPlayer({ videoURL: youtube_video, mute: true, showControls: false, loop: true, autoplay: true, showYTLogo: false });    
    disable_bgImages();
}

function init_smoothScroll() {
    $('#nav ul.navbar-nav a').smoothScroll({
        speed: 1000
    });
}

function init_scrollToTop() {
    $('body').append('<a href="#top" class="scrollup"><span class="fa fa-chevron-up"></span></a>');

    $(window).scroll(function () {
        var scroll = 600;
        if ($(this).scrollTop() > scroll) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });
}

function init_slider() {
    $.getScript("assets/js/supersized.3.2.7.min.js")
      .done(function (script, textStatus) {
          $.supersized({
              slide_interval: 3000,
              transition: 1,
              transition_speed: 700,
              slide_links: 'blank',
              slides: [
                          { image: 'assets/images/slider/slide1.jpg' },
                          { image: 'assets/images/slider/slide2.jpg' },
                          { image: 'assets/images/slider/slide3.jpg' }
              ]
          });
      })
      .fail(function (jqxhr, settings, exception) {
      });
    disable_bgImages();
}

function init_solidColor() {
    $('body').css({ 'background': solidColor });
    disable_bgImages();
}

function call_animations() {
    $('.scrollblock .about-box, .scrollblock .content-box, .scrollblock_team .member-box, .scrollblock .contact-box, .scrollblock .quote-box').attr('style', '');

    var scrollorama = $.scrollorama({
        blocks: '.scrollblock', enablePin: false
    });
    
    $('.about-box').each(function (idx, el) {
        var property_name = ['left', 'right'];
        var property_value = [ 80, 80 ];
        scrollorama
            .animate($(this), { delay: -150, duration: 80, property: 'opacity', start: 0 })
            .animate($(this), { delay: -150, duration: 80, property: property_name[idx], start: property_value[idx], end: 0 });
    });

    $('.content-box').each(function (idx, el) {
        var property_name = ['left', 'top', 'right'];
        var property_value = [-80, -80, -80];
        scrollorama
            .animate($(this), { delay: 300, duration: 80, property: 'opacity', start: 0 })
            .animate($(this), { delay: 300, duration: 80, property: property_name[idx], start: property_value[idx], end: 0 });
    });

    $('.contact-box').each(function (idx, el) {
        var property_name = ['left', 'right'];
        var property_value = [-80, -80];
        scrollorama
            .animate($(this), { delay: 500, duration: 120, property: 'opacity', start: 0 })
            .animate($(this), { delay: 500, duration: 120, property: property_name[idx], start: property_value[idx], end: 0 });
    });

    scrollorama
        .animate('.quote-box', { delay: 200, duration: 80, property: 'opacity', start: 0 })
        .animate('.quote-box', { delay: 200, duration: 80, property: 'left', start: 80, end: 0 });

    var scrollorama_team = $.scrollorama({
        blocks: '.scrollblock_team', enablePin: false
    });

    $('.member-box').each(function (idx, el) {
        var property_name = ['left', 'top', 'bottom', 'right'];
        var property_value = [-80, -80, -80, -80];
        scrollorama_team
            .animate($(this), { delay: -140, duration: 80, property: 'opacity', start: 0, end: 1 })
            .animate($(this), { delay: -140, duration: 80, property: property_name[idx], start: property_value[idx], end: 0 });
    });
}

function extract_youtubeID(url) {
    var youtube_id;
    youtube_id = url.replace(/^[^v]+v.(.{11}).*/, "$1");
    return youtube_id;
}

function disable_bgImages() {
    $('.bg1,.bg2,#footer').css({ 'background': 'none' });
}

$(window).load(function () { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({ 'overflow': 'visible' });
});

$('#nav').scrollspy();
$('.social-container a').tooltip();

function tick() {
    $('#header .text-ticker span.ticker-item:first').slideUp(function () {
        $(this).appendTo($('#header .text-ticker')).show();
    });
}
setInterval(function () { tick() }, 1500);