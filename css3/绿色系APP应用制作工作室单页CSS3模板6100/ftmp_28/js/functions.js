// remap jQuery to $
(function($){})(window.jQuery);

$(document).ready(function (){

/*-----------------------------------------------------------------------------------*/
/*  MAIN NAVIGATION SMOOTH SCROLL
/*-----------------------------------------------------------------------------------*/
  $('nav').localScroll();

  $('#lead-section').localScroll();

/*-----------------------------------------------------------------------------------*/
/*  TRIGGER THE MODALS IN PORTFOLIO SECTION
/*-----------------------------------------------------------------------------------*/

  $('a[rel*=leanModal]').leanModal({ top : 50, closeButton: ".modal_close" });

/*-----------------------------------------------------------------------------------*/
/*  CONTACT FORM
/*-----------------------------------------------------------------------------------*/
  $("#ajax-contact-form").submit(function() {
    var str = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "includes/contact-process.php",
      data: str,
      success: function(msg) {
          // Message Sent? Show the 'Thank You' message
          if(msg == 'OK') {
            result = '<div class="notification_ok">Your message has been sent. Thank you!</div>';
            //$("#fields").hide();
          } else {
            result = msg;
          }
          $('#note').html(result);
      }
    });
    return false;
  });

/*-----------------------------------------------------------------------------------*/
/*  BACK TO TOP
/*-----------------------------------------------------------------------------------*/
  $("#back-top").hide();
  
  // fade in
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#back-top').fadeIn();
    } else {
      $('#back-top').fadeOut();
    }
  });

  // scroll body to 0px on click
  $('#back-top a').click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });

/*-----------------------------------------------------------------------------------*/
/*  PORTFOLIO SLIDER
/*-----------------------------------------------------------------------------------*/
  $('#slider').anythingSlider({
    easing              : 'easeInOutBack',
    buildArrows         : false,
    buildNavigation     : true, 
    buildStartStop      : false, 
    hashTags            : false
  });

/*-----------------------------------------------------------------------------------*/
/*  NEWS PAGER
/*-----------------------------------------------------------------------------------*/
  $('ul#news').easyPaginate({
      step:2 //Change this to the number of news you want to show
    });

  $('#pagination').prepend('<li class="quicknotes">Quicknotes archive:</li>');

/*-----------------------------------------------------------------------------------*/
/*  GET TWEETS
/*-----------------------------------------------------------------------------------*/
  $(".tweet").tweet({
    username: "jalberto13", //change this to your twitter username
    join_text: "auto",
    avatar_size: 0, //show avatar?
    count: 1,       //number of tweets to display
    auto_join_text_default: "",
    auto_join_text_ed: "",
    auto_join_text_ing: "",
    auto_join_text_reply: "",
    auto_join_text_url: "",
    loading_text: "loading tweets..." //you can change this to a preloader image
  })

});