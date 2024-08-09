$(function () {

	$(document).on('show.bs.dropdown', '#header .dropdown', (e) => {
		var $header_container = $('#header .header__container');
		$header_container.css('top', 0);
		disableBodyScroll();
	});

	$(document).on('hidden.bs.dropdown', '#header .dropdown', (e) => {
		var $header_container = $('#header .header__container');
		$header_container.css('top', 0);
		clearAllBodyScrollLocks();
	});

});