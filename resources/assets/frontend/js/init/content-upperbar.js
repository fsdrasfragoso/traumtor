window.initContentUpperBar = function () {
	var $actionbar = $('.actionbar__content-actions');

	if($actionbar.length) {

		var lastScroll = window.pageYOffset;

		var originalPosition = $actionbar.offset().top;

		var contentUpperbarScroll = function () {

			var isMobile = window.matchMedia('(max-width: 991px)').matches;
			var scroll = window.pageYOffset;

			if (window.pageYOffset > originalPosition) {
				$actionbar.addClass('fixed');

				if (isMobile && scroll >= lastScroll) {
					$actionbar.css({ 'top': '20px', 'right': '20px' });
				}
				else if($('.header__container__admin-loggedin').length) {
					$actionbar.css({ 'top': '120px', 'right': '20px' });
				} else {
					$actionbar.css({ 'top': '80px', 'right': '20px' });
				}

			} else {
				$actionbar.removeClass('fixed');
			}

			lastScroll = scroll;
		};

		$(window).scroll(contentUpperbarScroll);
	}
};