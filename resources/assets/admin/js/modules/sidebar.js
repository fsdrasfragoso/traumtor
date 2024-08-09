
$(function () {
	const simpleBarEnabled = document.getElementsByClassName('js-simplebar').length > 0;
	const simpleBarInstance = simpleBarEnabled ? new SimpleBar(document.getElementsByClassName('js-simplebar')[0]) : null;

	/* Sidebar toggle behaviour */
	$('.sidebar-toggle').on('click', function (e) {
		e.preventDefault();
		$('.sidebar').toggleClass('toggled');
	});

	const active = $('.sidebar .active');

	if (active.length && active.parent('.collapse').length) {
		const parent = active.parent('.collapse');

		parent.prev('a').attr('aria-expanded', true);
		parent.addClass('show');
	}

	$('.sidebar-nav .sidebar-item a[data-pjax]').on('click', function (e)  {

		$('.sidebar-item.active').removeClass('active');

		$(e.currentTarget).parent().addClass('active');
	});
});