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