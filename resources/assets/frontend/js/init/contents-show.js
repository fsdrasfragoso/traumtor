window.initContentsShow = function() {
    var is_mobile = /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
    );
    var btn = $(".to-top-btn");

    btn.click(function() {
        $("html, body").animate({ scrollTop: 0 }, 1000);
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > $(this).height() / 2) {
            btn.removeClass("collapse");
        } else {
            btn.addClass("collapse");
        }
    });

    if (!is_mobile) {
        $(document).on("click", ".entry-content .fa-search", function(ev) {
            var el = $(ev.target).prev();

            var src = (el.is('img') ? el : el.find('img')).attr('src');

            var target_img = $("#show_image");
            target_img.attr("src", src);
            
            if (!$(this).parent().is('a')) {
                var modal = $("#imageModal");
                modal.modal("show");
            }
        });
    }

    $("html, body").click(function() {
        var social = $("#social");
        if (social.hasClass("show")) {
            social.collapse("hide");
        }
    });
};

window.setZoomIcons = function () {
    if ($('.fas.fa-search').length == 0) {
        $(".entry-content img").wrap("<div class='image-zoom'></div>");
        $(".entry-content a .image-zoom > img").unwrap();
        $(".entry-content img").after("<i class='fas fa-search'></i>");
        $(".entry-content a > img ~ i").remove();
        $(".entry-content img.image-align-right").parent().addClass('align-right');
        $(".entry-content img.image-align-left").parent().addClass('align-left');
    }
}
