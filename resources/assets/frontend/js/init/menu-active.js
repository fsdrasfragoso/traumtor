window.initMenuActive = function() {
	/**
	 * Escape regex characters.
	 *
	 * @param {string} regex
	 * @returns {string}
	 * @private
	 */
	function _escapeRegex(regex) {
		return regex.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
	}

	/**
	 * Filter by current url.
	 *
	 * @param {HTMLAnchorElement} item
	 * @return {boolean}
	 * @private
	 */
	function _filterMatches(index) {
		var item = this;
		let url = window.location.pathname;
		let link = $(item).attr('href');

		if(url.substring(0, link.length) == link) {
			if(url.length > link.length) {
				if(url[link.length] == '/') {
					return true;
				}
				return false;
			}
			return true;
		}
	}

	/**
	 * Set menu item as active.
	 *
	 * @private
	 */
	function _setActiveItem() {
		let items = $('.header__nav .menu a[href!="#"]').filter(_filterMatches);

		$('.header__nav .menu .menu__item.is-active').removeClass('is-active');

		items.each(function() {
			$(this).closest('.menu__item').addClass('is-active');
		});
	}

	_setActiveItem();
};