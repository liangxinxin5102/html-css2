$(document).ready(function() {

    // Click event for any anchor tag that's href starts with #
    $('a[href^="#"]').click(function(event) {

        // The id of the section we want to go to.
        var id = $(this).attr("href");

        // An offset to push the content down from the top.
        var offset = 0;

        // Our scroll target : the top position of the
        // section that has the id referenced by our href.
        var target = $(id).offset().top - offset;

        // The magic...smooth scrollin' goodness.
        $('html, body').animate({scrollTop:target}, 500);

        //prevent the page from jumping down to our section.
        //event.preventDefault();
		
    });
});