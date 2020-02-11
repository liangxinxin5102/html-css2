$(document).ready(function(){
  $('ul').each(function() {
    $(this).find('> li:last').addClass('ie_last_child');
  });
  $('.bg-header-menu ul.menu li a').addClass('border-menu');
});