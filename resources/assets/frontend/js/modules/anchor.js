$(() => {
    console.log('Init anchor.js');

    function isDomain(url) {
        let domains = [
            'traumtor',
        ];
        let size = domains.length;
        for (let i = 0; i < size; ++i) {
            let domain = domains[i];
            if (url.indexOf(domain) != -1) {
                return true;
            }
        }

        return false;
    }

    function getParam(url, param) {
        let urlObject = new URL(url);
        return urlObject.searchParams.get(param);
    }

    function updateParam(url, param, value) {
        let urlObject = new URL(url);
        urlObject.searchParams.set(param, value)
        return urlObject.toString();
    }

    let current_url = window.location.href;
    $('[data-param-replacer] a').each((_, e) => {
        let $target = $(e);
        let href = $target.attr('href');
        if (!isDomain(href)) {
            return;
        }

        let xpromo = getParam(current_url, 'xpromo');
        if (xpromo != null) {
            $target.prop('href', updateParam(href, 'xpromo', xpromo));
            href = updateParam(href, 'xpromo', xpromo)
        }

        let xcode = getParam(current_url, 'xcode');
        if (xcode != null) {
            $target.prop('href', updateParam(href, 'xcode', xcode));
            href = updateParam(href, 'xcode', xcode);
        }

        let utmCampaign = getParam(current_url, 'utm_campaign');
        if (utmCampaign != null) {
            $target.prop('href', updateParam(href, 'utm_campaign', utmCampaign));
            href = updateParam(href, 'xcode', xcode);
        }
    });
});
