
$3angle = {}

jQuery(document).ready(function($) {

    // Resize services wrapper to be square
    $3angle.service_width();
    $3angle.service_triangle();
    
    //Resize Gallery riangles
    $3angle.gallery_triangle();
    $('section.gallery figure.figure').hover(function(){
        $tb = $(this).find('.triangle.bottom');
        var width = $(this).width(),
            height = $(this).height(),
            coef = width * 0.61;
        $tb.height(height - 2*coef);
    }, function(){
        $tb.height(0);
    });
    
    // Clients Triangle
    $('.clients .arrow').click(function(){
        var visible_items = 3,
            dir = $(this).attr('data-arrow'),
            $items = $('.clients .list li.item.client'),
            $first = $items.parent().find('li.client.first'),
            fi = $first.index(),
            next = 0, count = $items.length;
        if(dir === 'right'){
            if(fi + visible_items < count){
                next = fi + 1;
                $items.eq(fi).toggleClass('first opaque');
                $items.eq(next).addClass('first');
            }
        }else{
            if(fi !== 0){
                next = fi - 1;
                $items.eq(fi).toggleClass('first');
                $items.eq(next).toggleClass('first opaque');
            }
        }
    });
});

$(window).resize(function() {

    // Resize services wrapper to be square
    $3angle.service_width();
    $3angle.service_triangle();
    
    //Resize Gallery riangles
    $3angle.gallery_triangle();

});

$3angle.service_width = function  service_width() {
    $service_circle = $('section.services figure.circle');
    $service_circle.height($service_circle.width());
};

$3angle.service_triangle = function service_triangle(){
    $service_circle = $('section.services figure.circle');
    $service_triangle = $('section.services figure.circle .triangle');
    var s_width = $service_circle.width(),
        b_top = s_width/2,
        b_bottom = b_top,
        b_right = Math.sqrt(Math.pow(s_width, 2) - Math.pow(s_width/2, 2));
    $service_triangle.css({
        'border-top-width': b_top, 
        'border-bottom-width': b_bottom, 
        'border-right-width': b_right});
};

$3angle.gallery_triangle = function gallery_triangle(){
    $figure = $('section.gallery figure.figure');
    var width = $figure.width(),
        height = $figure.height(),
        coef = width * 0.61,
        tt = $figure.find('.triangle.top'),
        mt = $figure.find('.triangle.middle'),
        bt = $figure.find('.triangle.bottom'),
        ct = $figure.find('.content');

    // bottom triangle
    $(bt).css({
        'border-left-width': width, 
        'border-top-width': coef});
    // top triangle
    $(tt).css({
        'border-left-width': width,
        'border-bottom-width': coef,
        'height': height - 2*coef});
    // middle triangle
    $(mt).css({
        'border-right-width': width + 1,
        'border-top-width': coef + 1, // +1 In order to fix the gap
        'border-bottom-width': coef,
    });
    // content margin
    $(ct).css('top', coef - $(ct).height()/2);
};


function LoadGmaps() {
    var myLatlng = new google.maps.LatLng(44.2661906,-68.5691898);
    var myOptions = {
        zoom: 16,
        center: myLatlng,
        disableDefaultUI: true,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT
        },

        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
        },
        streetViewControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        }
    var map = new google.maps.Map(document.getElementById("contact-map"), myOptions);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"brooklin"
    });
}

if($('#contact-map').length){
    LoadGmaps();
}

$(function(){
    var portfoloAngle = function () {
        var container = $('.portfolio-gallery'),
            item = container.find('li');

        container.isotope({
            itemSelector : item,
            layoutMode : 'fitRows',
            
        });

        $(document).resize(function() {
            container.width(container.outerWidth()+1);
            container.isotope( 'reLayout' );
        });

        // filter items when filter link is clicked
        $('.portfolio-nav a').click(function() {
            var selector = $(this).attr('data-filter');
            container.isotope({filter: selector});
            $('.portfolio-nav li').removeClass('active')
            $(this).parent('li').addClass('active');
            return false;
        });
    }

    portfoloAngle();

    var clientAngle = function () {
        var container = $('.client-slider ul'),
            item = container.find('li'),
            itemWidth = $('.client-slider').width() / 3,
            itemNum  = item.length,
            containerWidth = itemWidth * itemNum,
            leftArrow = $('.left-arrow'),
            rightArrow = $('.right-arrow'),
            i = 0;

            rightArrow.click(function (e) {
                e.preventDefault();
                i++;
                if(i > itemNum-3) {
                    i = 0;
                }
                container.css({'left': -itemWidth*i});
            });

            leftArrow.click(function (e) {
                e.preventDefault();
                i--;
                if(i < 0) {
                    i = itemNum-3;
                }
                container.css({'left': -itemWidth*i});
            });

        container.width(containerWidth);
        item.width(itemWidth);
        $(window).resize(function(){
            itemWidth = $('.client-slider').width() / 3;
            container.width(containerWidth);
            item.width(itemWidth);
            console.log(itemWidth);
        });


    }
    clientAngle();

});