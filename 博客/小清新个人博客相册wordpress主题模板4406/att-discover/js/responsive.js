jQuery(function($){
	$(document).ready(function(){
		
		$(".fitvids").fitVids();
		
		$("<select />").appendTo("#site-navigation");
		$("<option />", {
		   "selected": "selected",
		   "value" : "",
		   "text" : attParams.responsiveMenu
		}).appendTo("#site-navigation select");
		
		$("#site-navigation a").each(function() {
			var el = $(this);
			if (el.parents( '.sub-menu').length >= 1) {
				$('<option />', {
				 'value' : el.attr("href"),
				 'text' : '- ' + el.text()
				}).appendTo("#site-navigation select");
			}
			else if (el.parents( '.sub-menu .sub-menu').length >= 1) {
				$('<option />', {
				 'value' : el.attr( 'href'),
				 'text' : '-- ' + el.text()
				}).appendTo("#site-navigation select");
			}
			else {
				$('<option />', {
				 'value' : el.attr( 'href'),
				 'text' : el.text()
				}).appendTo("#site-navigation select");
			}
		});
		
		$("#site-navigation select").change(function() {
		  window.location = $(this).find("option:selected").val();
		});	
		
	});
});