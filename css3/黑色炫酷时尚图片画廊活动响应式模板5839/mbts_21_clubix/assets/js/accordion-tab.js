function hideAccordion() {
	$('div.accordion-tab-container .the-tabs li.tab a').each(function(){
		var href = $(this).data('file');

		$(href).slideUp('fast');
	});
};

$(document).ready(function(){

	hideAccordion();

	$('div.accordion-tab-container .the-tabs li.tab:first a').addClass('selected');

	$('div.accordion-tab-container .the-tabs li.tab a').click(function(){
		var href = $(this).data('file');

		$('div.accordion-tab-container .the-tabs li.tab a').removeClass('selected');
		$(this).addClass('selected');
		hideAccordion();

		$(href).slideDown('fast');
	});

	$('div.accordion-tab-container .the-tabs li.tab a.selected').each(function(){
		var href = $(this).data('file');

		$(href).slideDown('fast');
	});

});