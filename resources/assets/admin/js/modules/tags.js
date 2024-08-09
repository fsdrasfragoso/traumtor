$(function() {
    $(document).on('change', '.tag-checkbox', function() {
        $(this).closest(".tag").toggleClass("checked");
    });
});
