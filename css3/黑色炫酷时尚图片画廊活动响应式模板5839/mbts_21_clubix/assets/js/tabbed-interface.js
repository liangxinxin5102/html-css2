function hideTabs() {
	$('div.tabbed-interface-container .the-tabs li.tab a').each(function(){
		var href = $(this).data('file');

		$(href).hide();
	});
};

$(document).ready(function(){

	hideTabs();

	$('div.tabbed-interface-container .the-tabs li.tab:first a').addClass('selected');

	$('div.tabbed-interface-container .the-tabs li.tab a').click(function(){
		var href = $(this).data('file');

		$('div.tabbed-interface-container .the-tabs li.tab a').removeClass('selected');
		$(this).addClass('selected');
		hideTabs();

		$(href).fadeIn('fast');
	});

	$('div.tabbed-interface-container .the-tabs li.tab a.selected').each(function(){
		var href = $(this).data('file');

		$(href).show();
	});

});