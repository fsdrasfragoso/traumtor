window.verifyCardQuantity = function(urlVerifyQuantity, paymentQuantity) {
    var quantity = paymentQuantity;

    var limit = 10;

    var myInterval = setInterval(function () {
        if (limit == 0) {
            clearInterval(myInterval);
            return;
        }

        $.ajax({
            type: "POST",
            url: urlVerifyQuantity,
            data: {
                quantity,
            },
            success: function(data) {
                if( data.equals ) {
                    quantity++;
                    toastr.success('Sua forma de pagamento foi atualizada.');
                    clearInterval(myInterval);
                    $.pjax.reload({ container: '#main' });
                    return;
                }
            },
        });
        limit--;
    }, 2000);

    return quantity;
};

window.initSaveCard = function(urlSaveCard, urlVerifyQuantity,paymentQuantity){

    $(document).on('submit', "#credit-card-form", function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $('#credit-card-form').find('.invalid-feedback').remove();

        var quantity = paymentQuantity;
        let _method = 'PUT';
        let _token = $('meta[name="csrf-token"]').attr('content');
        let serial = $('#credit_card_serial').val();
        let flag = $('#credit_card_flag').val();
        let holder = $('#credit_card_holder').val();
        let cvv = $('#credit_card_cvv').val();
        let month = parseInt($('#credit_card_month').val());
        let year = $('#credit_card_year').val();

        $.ajax({
            type: "POST",
            url: urlSaveCard,
            data: {
                _method,
                _token,
                serial,
                flag,
                holder,
                cvv,
                month,
                year
            },
            error: function(response) {
                var errors = Object.entries(response.responseJSON.errors);
                errors.forEach(function (item) {
                    let item_id = '#credit_card_' + item[0];
                    let errors_list = item[1];
                    let message = '';
                    errors_list.forEach(function (error) {
                        toastr.error(error);
                        if(message) {
                            message = message + '<br/>' + error;
                        } else {
                            message = error;
                        }
                    });
                    $( '<span class="invalid-feedback" role="alert"><strong>' + message + '</strong></span>' ).insertAfter( item_id );
                });
                $('.invalid-feedback').css('display','block');
                $('#credit-card-form').find('button[type=submit]').removeAttr('disabled');
                $('#credit-card-form').find('button[type=submit]').css({'background-color': '#0ea8c3', 'border-color':'#0ea8c3'});
            },
            success: function(data) {
                toastr.info('Sua forma de pagamento está sendo atualizada.');
                quantity = verifyCardQuantity(urlVerifyQuantity, quantity);
            }
        });
    });
};