$(function () {
    function makeUrlWithRedirectUrl(url, redirectUrl) {
        var newUrl = new URL(url);
        var newRedirectUrl = new URL(redirectUrl);
        if (newRedirectUrl.searchParams.has('redirect_url')) {
            newUrl.searchParams.set('redirect_url', newRedirectUrl.searchParams.get('redirect_url'));
            return newUrl.toString();
        }

        newUrl.searchParams.set('redirect_url', newRedirectUrl.toString());
        return newUrl.toString();
    }

    window.updateRedirectUrl = function (url) {
        $('a[data-redirect-back]').each(function () {
            var $target = $(this);
            var newUrl = makeUrlWithRedirectUrl($target.attr('href'), url);
            $target.attr('href', newUrl);
        });
        $('form[data-redirect-back]').each(function () {
            var $target = $(this);
            var newUrl = makeUrlWithRedirectUrl($target.attr('action'), url);
            $target.attr('action', newUrl);
        });
    };
});
