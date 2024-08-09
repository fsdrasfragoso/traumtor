window.initFormValidation = function() {
    let errors = {};
    let activeRequest = null;

    /**
     * Update field icon.
     *
     * @param $field
     * @private
     */
    function _updateIcon($field) {
        let type = ($field.attr('name') in errors) ? 'invalid' : 'valid';

        $field
            .removeClass('is-loading')
            .removeClass('is-invalid')
            .removeClass('is-valid');

        if ($field.val()) {
            $field.addClass('is-' + type);
        }
    }

    function _updateMessage($field,message) {
        let type = ($field.attr('name') in errors) ? 'invalid' : 'valid';
        let fieldClasses = `.validation-input-${$field.attr('name')}`;


        $(fieldClasses)
        //.removeClass('valid-feedback')
        //.removeClass('invalid-feedback')
            .addClass(type+'-feedback');

        if(type === 'valid'){
            $(fieldClasses+' strong').text('');
        }else{
            $(fieldClasses+' strong').text(message[0]);
        }

    }

    /**
     * Update fields icons.
     *
     * @param $form jquery dom object
     * @private
     */
    function _updateAllIcons($form) {
        $form.find('input, select, textarea').each((index, item) => {
            let $field = $(item);

            if ($field.data('touched')) {
                _updateIcon($field);
            }
        });
    }

    function _updateAllMessages($form) {
        messages = errors;
        $form.find('input, select, textarea').each((index, item) => {
            let $field = $(item);
            let message = messages[$field.attr('name')];
            if ($field.data('touched')) {
                _updateMessage($field,message);
            }
        });
    }

    /**
     * Send validation request to server.
     *
     * @param $form jquery dom object
     * @param $field jquery dom object
     * @private
     */
    function _sendValidationRequest($form, $field) {
        let data = $form.serialize();
        let url = $form.data('validation');
        let method = $form.attr('method') || 'GET';


        $field.addClass('is-loading');


        activeRequest && activeRequest.abort();

        activeRequest = $.ajax({
            method,
            url,
            data,
            success() {
                errors = {};
            },
            error(error) {
                errors = error.responseJSON.errors;
            },
            complete(xhr, status) {
                if (status === 'success' || status === 'error') {
                    _updateAllIcons($form);
                    _updateAllMessages($form);
                }

                activeRequest = null;
            }
        });
    }

    /**
     * Send validate request.
     * @private
     */
    function _validateField(e) {
        let $field = $(e.target);
        let $form = $field.parents('form');

        if ("" === $form.data('validation')) {
            return;
        }

        $field.data('touched', true);

        _sendValidationRequest($form, $field);
    }

    function _createMessageSpan(input){
        var spansFeedback = $(input).closest('.form-group, .form-label-group').find('.invalid-feedback, .valid-feedback, .loading-feedback');

        if(spansFeedback.length==0){
            if(!$(input).parent().next().hasClass(`validation-input-${$(input).attr('name')}`)) {
                $(input).parent().after(`<span class='validation-input-${$(input).attr('name')} invalid-feedback' role='alert'><strong class='auth-erro'></strong></span>`);
            }
        }else{
            console.log(spansFeedback);
            spansFeedback.each(function(){

                $(this).addClass(`validation-input-${$(this).attr('name')}`);
            });
        }
    }

    /**
     * Attach change events.
     */
    function init() {
        $('[data-validation]').find('input:not([type=file]), select, textarea').each(function(){
            $(this).on('blur', _validateField);
            _createMessageSpan(this);
        });
    }

    init();
};
