$(function() {
    /* Searchbar behaviour */
    $(document).on("click", "#searchbar", function() {
        let form_search = $("#form-search");

        if ($(document).scrollTop() < form_search.height()) {
            form_search.slideToggle('fast');
        }

        if ($(document).scrollTop() >= form_search.height()) {
            $(window).scrollTop(0);
            form_search.slideDown('fast');
        }
    });

    $(document).on("click", "#filter-hide", function() {
        $("#form-search").slideToggle('fast');
    })

    $(document).on('scroll', function() {
        let search = $("#form-search");
        let aside = $('.aside');
        aside.css('top', 'initial');
        
        if ($(document).scrollTop() >= search.height() && search.is(':visible')) {
            aside.css('top', '60px');
        }
    })
});
