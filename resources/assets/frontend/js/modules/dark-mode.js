const icon = Cookies.get("dark-mode") ? '/img/frontend/sun.svg' : '/img/frontend/moon.svg';
$('.switch-theme img').attr('src', icon);

$(document).on("click", ".toggle-theme-btn", function() {
    const $element = $(".toggle-theme-btn");
    if (Cookies.get("dark-mode")) {
        $("body").toggleClass("dark-mode", false);
        $('.switch-theme img').attr('src', '/img/frontend/moon.svg');
        $element.find("[aria-label='darkmode-text']")
            .text("Modo Claro")
        $element.find("[aria-label='darkmode-icon']")
            .toggleClass("fas",false)
            .toggleClass("fal",true)
        Cookies.remove("dark-mode");
    } else {
        $("body").toggleClass("dark-mode", true);
        $('.switch-theme img').attr('src', '/img/frontend/sun.svg');
        $element.find("[aria-label='darkmode-text']")
            .text("Modo Escuro")
        $element.find("[aria-label='darkmode-icon']")
            .toggleClass("fas",true)
            .toggleClass("fal",false)

        Cookies.set("dark-mode", true, { expires: 365 * 100 });
    }
});
