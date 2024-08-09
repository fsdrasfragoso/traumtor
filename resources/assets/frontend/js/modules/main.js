$(function() {
    $(document).on("click", ".logo", e => {
        $("#sidebar-menu,.hamburger").removeClass("is-active");
    });

    $(document).on("click", "#main-nav [data-pjax]", e => {
        var $link = $(e.currentTarget);
        var $menu_item = $link.closest(".menu__item");
        var $menu = $link.closest(".menu");
        $menu.find(".menu__item.is-active").removeClass("is-active");
        $menu_item.addClass("is-active");
    });

    $(document).on("change", "#my_content_check", function() {
        if (this.checked) {
            $("input[name='my_content']").prop("checked", "checked");
            Cookies.set("my_content", 1);
        } else {
            $("input[name='my_content']").prop("checked", "");
            Cookies.set("my_content", 0);
        }
        $.pjax.reload({ container: "#main" });
    });

    $(document).on("submit", "#form-search, #form-search-m", function(e) {
        e.preventDefault();

        let data = $(this).serializeArray();

        for (let key in data) {
            Cookies.set(data[key].name, data[key].value);
        }

        $("#form-search")
            .find(".is-cookie")
            .prop("disabled", "disabled");

        $("#body").css("overflow", "visible");
        $.pjax.submit(e, "#wrapper");
    });

    $(document).on("click", ".clean-search", function(e) {
        e.preventDefault();
        Cookies.remove("my_content");

        $.pjax({ url: "/", container: "#wrapper" });
    });
});
