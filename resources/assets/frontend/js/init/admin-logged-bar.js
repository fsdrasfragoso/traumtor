window.initAdminLoggedBar = function (editTitle, editLink) {
    $('.title-admin-loggedin').html(editTitle);

    if(editLink){
        $('.link-admin-loggedin').removeClass('d-none').addClass('d-inline');
        $('.link-admin-loggedin').prop('href', editLink);
    } else {
        $('.link-admin-loggedin').removeClass('d-inline').addClass('d-none');
        $('.link-admin-loggedin').prop('href', '');
    }
};