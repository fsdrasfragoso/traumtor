$(function() {
    $( document ).ready(function() {
        $('#close-modal').click(function(e) {
            console.log(e)
            let modal_element = $('.auth-modal-container');
            modal_element.addClass('d-none');
            modal_element.removeClass('d-flex');

        });
        $('.open-auth-modal').click(function(){
            console.log('open modal')
            let modal_element = $('.auth-modal-container');
            modal_element.addClass('d-flex');
            modal_element.removeClass('d-none');
        });
    });
});