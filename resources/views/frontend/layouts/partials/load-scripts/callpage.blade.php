<!-- BEGIN callpage.io widget -->
<!-- IMPORTANT: Remove script below if you don't need support for older browsers. -->
<script>
    (function() {
        var script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.min.js';
        script.async = false;
        document.head.appendChild(script);
    }())

</script>
<script>
    var _cp = {
        "id": "CK8vmsyo7MaJ8At5Rp7O74plZ2fJUNBdH_htnmJf5Gg",
        "version": "1.1"
    };
    (function(window, document) {
        var cp = document.createElement('script');
        cp.type = 'text/javascript';
        cp.async = false;
        cp.src = "++cdn-widget.callpage.io+build+js+callpage.js".replace(/[+]/g, '/').replace(/[=]/g, '.');
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(cp, s);
        if (window.callpage) {
            console.warn('You could have only 1 CallPage code on your website!');
        } else {
            window.callpage = function(method) {
                if (method == '__getQueue') {
                    return this.methods;
                } else if (method) {
                    if (typeof window.callpage.execute === 'function') {
                        return window.callpage.execute.apply(this, arguments);
                    } else {
                        (this.methods = this.methods || []).push({
                            arguments: arguments
                        })
                    }
                }
            };
            window.callpage.__cp = _cp;
            window.callpage('api.button.autoshow')
        }
    })(window, document);

</script>
<!-- END callpage.io widget -->
