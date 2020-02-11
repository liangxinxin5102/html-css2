jQuery(document).ready(function() {


/* Back to top */

	jQuery('.go-top').click(function(event) {
		event.preventDefault();
		
		jQuery('html, body').animate({scrollTop: 0}, 300);
	})

	
/* Mobile menu */

    jQuery('#topmenu').mobileMenu({
			prependTo:'.mobilenavi'
			});		

	
/* grid */
/* 	jQuery('.latest-posts .col-md-6:nth-child(2n)').after('<div class="clear"></div>'); */


/* Countdown */

	jQuery('#ctimer').countdown(fab_objects.timer, function(event) {
    jQuery(this).html(event.strftime(
         '<span> <h3>%w</h3> Weeks </span>'
       + '<span> <h3>%d</h3> Days </span>'
       + '<span> <h3>%H</h3> Hours </span>'   ));
   });
   
   
/* Prettyphoto    */
   
   jQuery("a[rel^='prettyPhoto']").prettyPhoto();
   
 
	
});