$(function() {
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
    function _filterMatches(item) {
        let url = window.location.pathname.replace(/\/$/, '');
        let regex = new RegExp(_escapeRegex(url) + '(?:\\/?(?:\\?.*)?)?$', 'i');

        return !!item.href.match(regex);
    }

    /**
     * Get all menu items matching callback.
     *
     * @param {function} callback
     * @return {Array<HTMLAnchorElement>}
     * @private
     */
    function _getMenuItems(callback) {
        return [...document.querySelectorAll('.sidebar-nav a[href]')]
            .filter(callback);
    }

    /**
     * Set menu item as active.
     *
     * @private
     */
    function _setActiveItem() {
        let items = _getMenuItems(_filterMatches);

        for (let key in items) {
            if (items.hasOwnProperty(key)) {
                let item = items[key];

                while (item = item.parentNode) {
                    if (item instanceof HTMLLIElement) {
                        item.classList.add('active');
                    }

                    if (item.classList.contains('collapse')) {
                        item.classList.add('show');
                    }

                    if (item.classList.contains('sidebar-nav')) {
                        break;
                    }
                }
            }
        }
    }

    _setActiveItem();

});
