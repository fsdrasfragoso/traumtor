window.initAside = function() {
	var stickyAside = function() {
		var $left = $('.aside--left');
		var $right = $('.aside--right');

		$left.css('width', $left.parent().width() + 20);
		$left.addClass('sticky');
		$right.css('width', $right.parent().width() + 20);
		$right.addClass('sticky');
	};

	stickyAside();

	$(window).off('resize.aside').on('resize.aside', stickyAside);
};