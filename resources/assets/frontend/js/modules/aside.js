$(function () {

	$(document).on('click', '#aside-nav [data-pjax]', (e) => {
		var $link = $(e.currentTarget);
		var $menu_item = $link.closest('.menu__item');
		var is_collapsed = $menu_item.parent().hasClass('show');
		var $menu = $link.closest('.menu');
		if (!is_collapsed) {
			$menu.find('.menu__item.is-active').removeClass('is-active');
		}
		$menu_item.addClass('is-active');
	});

});