(function ($) {

    $.fn.countdown = function (settings, option) {
        return this.each(function () {
            var $settings = $.extend({}, $.fn.countdown.defaultSettings, settings || {});         
            var $element = $(this);
            var final_datetime = new Date($settings.finalDate);
            var ms_perday = 24 * 60 * 60 * 1000;
            setInterval(function () {
                var current_datetime = new Date();
                var time_left = final_datetime.getTime() - current_datetime.getTime();

                var est_days_left = time_left / ms_perday;
                var days_left = Math.floor(est_days_left);

                var est_hours_left = (est_days_left - days_left) * 24;
                var hours_left = Math.floor(est_hours_left);

                var est_minutes_left = (est_hours_left - hours_left) * 60;
                var minutes_left = Math.floor(est_minutes_left);

                var est_seconds_left = (est_minutes_left - minutes_left) * 60;
                var seconds_left = Math.floor(est_seconds_left);

                if (time_left > 0) {
                    if (hours_left < 10) {
                        if (hours_left >= 0)
                            hours_left = "0" + hours_left;
                        else
                            hours_left = "00";
                    }
                    if (minutes_left < 10) {
                        if (minutes_left >= 0)
                            minutes_left = "0" + minutes_left;
                        else
                            minutes_left = "00";
                    }
                    if (seconds_left < 10) {
                        if (seconds_left >= 0)
                            seconds_left = "0" + seconds_left;
                        else
                            seconds_left = "00";
                    }
                    if (days_left < 10) {
                        if (days_left >= 0)
                            days_left = "0" + days_left;
                        else
                            days_left = "00";
                    }
                }
                else {
                    days_left = "00";
                    hours_left = "00";
                    minutes_left = "00";
                    seconds_left = "00";
                }

                var $days = "<span class=\"time\">" + days_left + "</span>" + ((days_left < 2) ? "<span class=\"title\">DAY</span>" : "<span class=\"title\">DAYS</span>");
                var $hours = "<span class=\"time\">" + hours_left + "</span>" + ((hours_left < 2) ? "<span class=\"title\">HOUR</span>" : "<span class=\"title\">HOURS</span>");
                var $minutes = "<span class=\"time\">" + minutes_left + "</span>" + ((minutes_left < 2) ? "<span class=\"title\">MINUTE</span>" : "<span class=\"title\">MINUTES</span>");
                var $seconds = "<span class=\"time\">" + seconds_left + "</span>" + ((seconds_left < 2) ? "<span class=\"title\">SECOND</span>" : "<span class=\"title\">SECONDS</span>");

                $element.find("#days").html($days);
                $element.find("#hours").html($hours);
                $element.find("#minutes").html($minutes);
                $element.find("#seconds").html($seconds);

            }, 1000);

        });
    };

    
    function countdown($settings, $element) {
        this.settings = this.getSettings($settings, $element);
        this.$element = $element;
        return this;
    };

    countdown.prototype = {
        getSettings: function (settings, element) {
            var $settings = $.extend({}, settings, { 'format': element.data('format'), 'finalDate': element.data('finalDate') });
            return $settings;
        },
    };
    
    $.fn.countdown.defaultSettings = {
        format: "dd:hh:mm:ss",
        finalDate: "25 May 2013, 14:30:00"
    };

})(jQuery);
$(document).ready(function () {
    init_FormValidator();
    CaptchaHandler();

    $("#btn-Send").click(function () {
        var txtName = $('#txtName');
        var txtEmail = $('#txtEmail');
        var txtMessage = $('#txtMessage');

        if ($('#form-contact-us').valid()) {
            var ajaxRequest = $.ajax({
                url: 'handlers/contact.php',
                type: "POST",
                data: { formType: 'contact', txtName: txtName.val(), txtEmail: txtEmail.val(), txtMessage: txtMessage.val(), txtMailTo: '' },
                beforeSend: function () {
                    $("#btn-Send").button('loading');
                }
            });

            ajaxRequest.fail(
            function (data) {
                var $message = '<i class="icon-times-circle"></i> ' + data.responseText;
                $("#contact-form-message").addClass("alert alert-danger");
                $("#contact-form-message").html($message);
                $("#btn-Send").button('reset');
            });

            ajaxRequest.done(
            function (response) {
                var $message = '<i class="icon-check-circle"></i> ' + response;
                $("#contact-form-message").addClass("alert alert-success");
                $("#contact-form-message").html($message);
            });

            ajaxRequest.always(
                function () {
                    $("#btn-Send").button('reset');
                    $("#form-contact-us")[0].reset();
                }
            );
        }
    });
});

function CaptchaHandler() {
    var array_vals = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    var array_operators = new Array('+', '+');
    var index = parseInt(Math.random() * 10);
    index = (index == 0) ? index : (index - 1);
    var hidden_val_1 = array_vals[index];
    index = parseInt(Math.random() * 10);
    index = (index == 0) ? index : (index - 1);
    var hidden_val_2 = array_vals[index];
    index = parseInt(Math.random() * 10) % 2;
    var hidden_operator = array_operators[index];
    var result = 0;
    switch (hidden_operator) {
        case '*':
            result = hidden_val_1 * hidden_val_2;
            break;
        default:
            result = hidden_val_1 + hidden_val_2;
            break;
    }

    jQuery('label[for="txtCaptcha"]').html('<strong>What is ' + hidden_val_1 + ' ' + hidden_operator + ' ' + hidden_val_2 + ' = ?</strong>');

    var txtCaptchaResult = '<input type="hidden" id="txtCaptchaResult" />';
    jQuery("body").append(txtCaptchaResult);
    jQuery("#txtCaptchaResult").val(result);
}

function init_FormValidator() {
    $('#form-contact-us').validate({
        rules: {
            txtCaptcha: {
                equalTo: '#txtCaptchaResult'
            }
        },
        messages: {
            txtName: '<i class="icon-remove-sign"></i> required.',
            txtEmail: {
                required: '<i class="icon-remove-sign"></i> required.',
                email: '<i class="icon-info-sign"></i> invalid.'
            },
            txtMessage: '<i class="icon-remove-sign"></i> required.',
            txtCaptcha: {
                required: '<i class="icon-remove-sign"></i> required.',
                equalTo: '<i class="icon-remove-sign"></i> wrong.'
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            $('<div class="clearfix"></div>').insertBefore(error);
            $('<div class="clearfix"></div>').insertAfter(error);
            error.css({ left: element.position().left + (element.width() - error.width()), top: element.position().top + 8, position: 'absolute', 'z-index': 900 });
        },
        invalidHandler: function (event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
            } else {
            }
        }
    });
}
$(document).ready(function () {
    init_SubscribeFormValidator();

    $("#btn_subscribe").click(function () {
        var txtEmail = $('#txtSubscribeEmail');
        if ($('#frm_subscribe').valid()) {
            var ajaxRequest = $.ajax({
                url: 'handlers/subscribe.php',
                type: "POST",
                data: { email: txtEmail.val() },
                beforeSend: function () {
                    $("#btn_subscribe").button('loading');
                }
            });

            ajaxRequest.fail(function (data) {
                // error
                var $message = '<i class="fa fa-times-circle"></i> ' + data.responseText;
                $("#subscribe_form_message").addClass("alert alert-danger");
                $("#subscribe_form_message").html($message);
                $("#btn_subscribe").button('reset');
            });

            ajaxRequest.done(function (response) {
                // done
                var $message = '<i class="fa fa-check-circle"></i> ' + response;
                $("#subscribe_form_message").addClass("alert alert-success");
                $("#subscribe_form_message").html($message);
            });

            ajaxRequest.always(function () {
                // complete
                $("#btn_subscribe").button('reset');
                $("#frm_subscribe")[0].reset();
            });
        }
    });
});

function init_SubscribeFormValidator() {
    $('#frm_subscribe').validate({
        messages: {
            txtSubscribeEmail: {
                required: '<i class="icon-remove-sign"></i> required.',
                email: '<i class="icon-info-sign"></i> invalid.</b>'
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            $('<div class="clearfix"></div>').insertBefore(error);
            $('<div class="clearfix"></div>').insertAfter(error);
            error.css({ left: element.position().left + (element.width() - error.width()), top: element.position().top - 7, position: 'absolute', 'z-index': 900 });
        },
        invalidHandler: function (event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
            } else {
            }
        }
    });
}
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
$(document).ready(function () {
    if (showHideStyleSwitcher) {
        var render_styleswitcher = '<div id="style-switcher" class="push">' +
        '    <div class="switcher-container">' +
        '        <div class="rows">' +
        '            <span class="text-muted">Timer : </span>' +
        '            <div class="btn-group" data-toggle="buttons">' +
        '                <label class="btn btn-default active" id="opt-timeron">' +
        '                    <input type="radio" name="opt-timer" />' +
        '                    On' +
        '                </label>' +
        '                <label class="btn btn-default" id="opt-timeroff">' +
        '                    <input type="radio" name="opt-timer" />' +
        '                    Off' +
        '                </label>' +
        '            </div>' +
        '        </div>' +
        '        <div class="rows">' +
        '            <div class="btn-group-vertical styles" data-toggle="buttons">' +
        '                <label class="btn btn-default active" id="opt-parallax">' +
        '                    <input type="radio" name="options" />' +
        '                    <span class="fa fa-random"></span>Parallax' +
        '                </label>' +
        '                <label class="btn btn-default" id="opt-slider">' +
        '                    <input type="radio" name="options" />' +
        '                    <span class="fa fa-desktop"></span>Slider' +
        '                </label>' +
        '                <label class="btn btn-default" id="opt-video">' +
        '                    <input type="radio" name="options" />' +
        '                    <span class="fa fa-video-camera"></span>Video' +
        '                </label>' +
        '                <label class="btn btn-default" id="opt-fixedbg">' +
        '                    <input type="radio" name="options" />' +
        '                    <span class="fa fa-picture-o"></span>Fixed Background' +
        '                </label>' +
        '                <label class="btn btn-default" id="opt-solidcolor">' +
        '                    <input type="radio" name="options" />' +
        '                    <span class="fa fa-tint"></span>Solid Color' +
        '                </label>' +
        '            </div>' +
        '        </div>' +
        '        <div class="rows">' +
        '            <span class="text-muted">Set Background Video URL (youtube) : </span>' +
        '            <br />' +
        '            <div class="input-group">' +
        '                <input class="form-control" id="txtVideo" type="text" placeholder="youtube video url" />' +
        '                <span class="input-group-btn">' +
        '                    <button id="btn-video" class="btn btn-default">apply</button>' +
        '                </span>' +
        '            </div>' +
        '        </div>' +
        '        <div class="rows">' +
        '            <span class="text-muted">Set Background Image URL : </span>' +
        '            <br />' +
        '            <div class="input-group">' +
        '                <input class="form-control" id="txtImage" type="text" placeholder="image url" />' +
        '                <span class="input-group-btn">' +
        '                    <button id="btn-image" class="btn btn-default">apply</button>' +
        '                </span>' +
        '            </div>' +
        '        </div>' +
        '        <div class="rows skins">' +
        '            <button class="btn" id="btn-skin1"></button>' +
        '            <button class="btn" id="btn-skin2"></button>' +
        '            <button class="btn" id="btn-skin3"></button>' +
        '            <button class="btn" id="btn-skin4"></button>' +
        '            <button class="btn" id="btn-skin5"></button>' +
        '        </div>' +
        '        <div class="rows">' +
        '            <button id="btn-reset" class="btn btn-danger">reset</button>' +
        '        </div>' +
        '        <div class="clearfix"></div>' +
        '        <a class="puller hidden-xxs" href="#_"><i class="fa fa-spin fa-cog"></i></a>' +
        '    </div>' +
        '    <div class="clearfix"></div>' +
        '</div>'

        $('body').append(render_styleswitcher);

        $("#style-switcher .puller").click(function () {
            if ($("#style-switcher").hasClass("push")) {
                $("#style-switcher").removeClass("push").addClass("pull");
            }
            else {
                $("#style-switcher").removeClass("pull").addClass("push");
            }
        });
        $('#style-switcher input[name="options"]').parent().click(function () {
            var option = $(this).attr('id').split('-')[1];
            $.cookie("option", option, { expires: 1 });
            location.reload();
        });

        $('#style-switcher input[name="opt-timer"]').parent().click(function () {
            var option = $(this).attr('id').split('-')[1];
            $.cookie("opt-timer", option, { expires: 1 });
            location.reload();
        });

        $('#style-switcher #btn-video').click(function () {
            $.cookie("opt-video", $('#txtVideo').val(), { expires: 1 });
            $.cookie("option", 'video', { expires: 1 });
            location.reload();
        });

        $('#style-switcher #btn-image').click(function () {
            $.cookie("opt-image", $('#txtImage').val(), { expires: 1 });
            $.cookie("option", 'fixedbg', { expires: 1 });
            location.reload();
        });

        $('#style-switcher #btn-reset').click(function () {
            resetAll();
        });

        $('#style-switcher .skins .btn').click(function () {
            var skin = $(this).attr('id').split('-')[1];
            var skin_name = skin + '.min.css';
            $('#skin-styler').attr('href', 'assets/css/' + skin_name);
        });

        function resetAll() {
            $.removeCookie("option");
            $.removeCookie("opt-timer");
            $.removeCookie("opt-video");
            $.removeCookie("opt-image");
            $.cookie("option", "parallax", { expires: 1 });
            $.cookie("opt-timer", "timeron", { expires: 1 });
            location.reload();
        }

        var option = $.cookie("option");
        switch (option) {
            case 'parallax':
                isParallaxEnabled = true;
                isSliderEnabled = false;
                isVideoBgEnabled = false;
                isSolidColorEnabled = false;
                break;
            case 'slider':
                isSliderEnabled = true;
                isParallaxEnabled = false;
                isVideoBgEnabled = false;
                isSolidColorEnabled = false;
                break;
            case 'video':
                isVideoBgEnabled = true;
                isSliderEnabled = false;
                isParallaxEnabled = false;
                isSolidColorEnabled = false;
                break;
            case 'fixedbg':
                isVideoBgEnabled = false;
                isSliderEnabled = false;
                isParallaxEnabled = false;
                isSolidColorEnabled = false;
                break;
            case 'solidcolor':
                isSolidColorEnabled = true;
                isVideoBgEnabled = false;
                isSliderEnabled = false;
                isParallaxEnabled = false;
                break;
            default:
                isParallaxEnabled = true;
                isSliderEnabled = false;
                isVideoBgEnabled = false;
                isSolidColorEnabled = false;
                $.cookie("option", "parallax", { expires: 1 });
                break;
        }

        $('#style-switcher input[name="options"]').parent().removeClass('active');
        $('#opt-' + option).addClass('active');

        var opt_timer = $.cookie("opt-timer");
        switch (opt_timer) {
            case 'timeron':
                showTimer = true;
                break;
            case 'timeroff':
                showTimer = false;
                break;
            default: showTimer = true;
                $.cookie("opt-timer", "timeron", { expires: 1 });
                break;
        }
        $('#style-switcher input[name="opt-timer"]').parent().removeClass('active');
        $('#opt-' + opt_timer).addClass('active');

        var video = $.cookie("opt-video");
        if (video != null) {
            $('#txtVideo').val(video);
            youtube_video = video;
        }

        var image = $.cookie("opt-image");
        if (image != null) {
            $('#txtImage').val(image);
            $('.bg1').css({ 'background': 'url(' + image + ')' });
        }

        $.getScript("assets/js/app.ui.js")
          .done(function (script, textStatus) {
          })
          .fail(function (jqxhr, settings, exception) {
          });
    }
});