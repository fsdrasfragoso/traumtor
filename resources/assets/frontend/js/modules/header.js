$(function() {
    if ($(".header__nav").length) {
        var prevScrollPos = window.pageYOffset;
        var maxHeight = $(".header__nav").height();

        var headerScroll = function(e) {
            var isMobile = window.matchMedia("(max-width: 991px)").matches;

            if (isMobile && !$("#main").hasClass("sidebar-open")) {
                var currentScrollPos = window.pageYOffset;

                if (
                    currentScrollPos >= maxHeight &&
                    currentScrollPos > prevScrollPos
                ) {
                    $(".header__container").css(
                        "transform",
                        "translateY(-100%)"
                    );
                } else {
                    $(".header__container").css("transform", "");
                }

                prevScrollPos = currentScrollPos;
            } else {
                $(".header__container").css("transform", "");
            }
        };

        $(window).scroll(headerScroll);
    }

    $("header .logo a").click(function() {
        $("#main").toggleClass("sidebar-open", false);
        $(".avatar").toggleClass("is-active", false);
    });
});
