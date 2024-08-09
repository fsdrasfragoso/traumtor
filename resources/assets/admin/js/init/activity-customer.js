//FIXME: Tem uns codigos repetidos, precisa estudar uma melhor forma de fazer isso
window.initActivityFootballer = function() {
    $('input[name="answered_call"]').each(function() {
        $(this).prop('checked', false);
    });

    $(document).on('change', 'input[name="answered_call"]', function () {
        $('.change_answered').removeClass('text-gray-300');

        if (this.value == 1) {

            $('input[name="purchased"]').prop('disabled', false);
            $('input[name="purchased"] + label').removeClass('text-gray-300');
            $('input[name="purchased"]').each(function( index ) {
                $(this).prop('checked', false);
            });


            $('input[name="already_invest"]').prop('disabled', false);
            $('select[name="already_invest"]').prop('required', true);
            $('input[name="already_invest"] + label').removeClass('text-gray-300');
            $('input[name="already_invest"]').each(function( index ) {
                $(this).prop('checked', false);
            });

            $('.show-answered').addClass('d-none');

            $('.disable_answered').addClass('text-gray-300');

            $('.enable_answered').removeClass('text-gray-300');
            $('.enable_answered').removeClass('disabled');

            if($('.enable_answered').find('input').length) {
                $('.enable_answered').find('input').prop('disabled', false);
            }

            $('.show-purchased-return').addClass('d-none');
            $('input[name="purchased"]').filter('[value=return]').prop('checked', false);
        } else {

            $('input[name="purchased"]').prop('disabled', false);
            $('input[name="purchased"] + label').removeClass('text-gray-300');
            $('input[name="purchased"]').filter('[value=return]').prop('checked', true);

            $('input[name="already_invest"]').prop('disabled', true);
            $('select[name="already_invest"]').prop('required', false);
            $('input[name="already_invest"] + label').addClass('text-gray-300');
            $('input[name="already_invest"]').each(function( index ) {
                $(this).prop('checked', false);
            });

            $('.show-answered').removeClass('d-none');

            $('.disable_answered').removeClass('text-gray-300');

            $('.enable_answered').addClass('text-gray-300');
            $('.enable_answered').addClass('disabled');

            if($('.enable_answered').find('input').length) {
                $('.enable_answered').find('input').prop('disabled', true);
            }

            $('.enable_invest').addClass('text-gray-300');
            $('.enable_invest').addClass('disabled');
            $('.enable_invest').removeClass('checked');

            if($('.enable_invest').find('input').length) {
                $('.enable_invest').find('input').prop('disabled', true);
                $('.enable_invest').find('input').prop('checked', false);
            }

            $('.show-purchased-return').removeClass('d-none');
        }
    });

    $(document).on('change', 'input[name="already_invest"]', function () {
        if (this.value == 1) {
            $('.enable_invest').removeClass('text-gray-300');
            $('.enable_invest').removeClass('disabled');
            $('.enable_invest').removeClass('checked');

            if($('.enable_invest').find('input').length) {
                $('.enable_invest').find('input').prop('disabled', false);
                $('.enable_invest').find('input').prop('checked', false);
                $('.enable_invest').find('input').closest('.input-group-prepend').closest('.input-group + label').removeClass('text-gray-300');
            }
        } else {
            $('.enable_invest').addClass('text-gray-300');
            $('.enable_invest').addClass('disabled');
            $('.enable_invest').removeClass('checked');

            if($('.enable_invest').find('input').length) {
                $('.enable_invest').find('input').prop('disabled', true);
                $('.enable_invest').find('input').prop('checked', false);
            }
        }
    });

    $(document).on('change', 'input[name="purchased"]', function () {
        if (this.value == 'return') {
            $('input[name="call_in"]').prop('required', true);
            $('select[name="purchased_reason"]').prop('required', false);
            $('.show-purchased-return').removeClass('d-none');
            $('.show-purchased-no').addClass('d-none');

        } else if (this.value == 'no') {
            $('input[name="call_in"]').prop('required', false);
            $('select[name="purchased_reason"]').prop('required', true);
            $('.show-purchased-return').addClass('d-none');
            $('.show-purchased-no').removeClass('d-none');
        } else if (this.value == 'yes') {
            $('input[name="call_in"]').prop('required', false);
            $('select[name="purchased_reason"]').prop('required', false);
            $('.show-purchased-no').addClass('d-none');
            $('.show-purchased-return').addClass('d-none');
        }
    });
};
