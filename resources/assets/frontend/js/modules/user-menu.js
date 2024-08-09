$(function () {

    $('.icon-avatar, .link-drop').click(function () {
        $('.user-container').toggle();
        if($('.user-drop').hasClass('is-active')){
            $('.user-drop').removeClass('is-active');
        }
        else {
            $('.user-drop').addClass('is-active');
        }
    })
    $('.user-drop').click(function () {
        $('.user-container').toggle();
        $('.user-drop').removeClass('is-active');
    })
});
