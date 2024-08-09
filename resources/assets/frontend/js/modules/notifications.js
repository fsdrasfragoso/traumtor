const { update } = require("lodash");

$(function () {

    function getNotitifcationsIDS() {
        let allIDS = [];

        $('.checked-box:checked').each(function () {
            allIDS.push($(this).val());
        });

        const dataRequestIDs = 'messages=' + allIDS.join('-');

        $(".delete-all-notification-button-mobile")[0].search = dataRequestIDs
        $("a.delete-all-notification-button")[0].search = dataRequestIDs
    }

    $(document).on('change', '.checked-box', function () {
        if (this.checked) {
            $(this).parents('.card-header').addClass('marked');
        } else {
            $(this).parents('.card-header').removeClass('marked');
        }

        getNotitifcationsIDS();

        if ($('.checked-box:checked').length > 0) {
            $('.delete-all-notification-button').removeClass('disabled');
        }
        else {
            $('.delete-all-notification-button').addClass('disabled');
        }

    });

    $(document).on('click', '.toggle-notification-collapse', function () {
        let url = 'notificacoes/' + $(this).data('id');
        let updateNotification = axios.put(url);

        $('#notification-' + $(this).data('id'))
            .removeClass('unread')
            .addClass('read');

        updateNotification.then(function () { 
            url = 'notificacoes-nao-lidas';
            let unreadNotifications = axios.get(url);

            unreadNotifications.then(function (response) {
                if (!response.data) {
                    $('.notification-circle').addClass('d-none');
                }
            });
        })
    });

    $(document).on('change', 'input[name=select-read]', function () {
        if (this.checked) {
            $('.checked-box').prop('checked', null);
            $('.card-header').removeClass('marked');
            $('.read .checked-box').prop('checked', 'checked');
            $('.read').addClass('marked');
            $('input[name=select-all]').prop('checked', null);
            $('.delete-all-notification-button').removeClass('disabled');

            getNotitifcationsIDS();
        } else {
            $('.read .checked-box').prop('checked', null);
            $('.read').removeClass('marked');
            $('.delete-all-notification-button').addClass('disabled');
        }
    });

    $(document).on('change', 'input[name=select-all]', function () {
        if (this.checked) {
            $('.checked-box').prop('checked', 'checked');
            $('.card-header').addClass('marked');
            $('.delete-all-notification-button').removeClass('disabled');

            getNotitifcationsIDS();
        } else {
            $('.checked-box').prop('checked', null);
            $('.card-header').removeClass('marked');
            $('input[name=select-read]').prop('checked', null);
            $('.delete-all-notification-button').addClass('disabled');
        }
    });

    $('#icon-notification').on('click', function () {
        if($('#notification-container').hasClass('d-none')) {
            $('#notification-container').removeClass('d-none')
            $('#notification-drop').removeClass('d-none');
        } else {
            $('#notification-container').addClass('d-none')
            $('#notification-drop').addClass('d-none');
        }
    })

    $('#notification-drop').on('click', function () {
        $('#notification-container').addClass('d-none')
        $('#notification-drop').addClass('d-none');
    })

    $(document).on('click', '#icon-notification-footer', () => {
        if($('#notification-container-footer').hasClass('d-none')) {
            $('#notification-drop-footer').removeClass('d-none')
            $('#notification-container-footer').removeClass('d-none')

            $("[title='Mensagem da empresa']").addClass('d-none');
            $("[title='Botão para abrir a janela de mensagens']").addClass('d-none');
            $("[title='Número de mensagens não lidas']").addClass('d-none');
        } else {
            $('#notification-drop-footer').addClass('d-none')
            $('#notification-container-footer').addClass('d-none')

            $("[title='Mensagem da empresa']").removeClass('d-none');
            $("[title='Botão para abrir a janela de mensagens']").removeClass('d-none');
            $("[title='Número de mensagens não lidas']").removeClass('d-none');
        }
        $('#notification-drop-footer').on('click', function() {
            $(this).addClass('d-none')
            $('#notification-container-footer').addClass('d-none')
        })
    })

});
