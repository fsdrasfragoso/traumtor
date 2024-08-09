window.initCancelSubscription = (subscriptionID) => {

    let element = `#cancel-modal-${subscriptionID}`;

    $(document).on(`click`, `${element} .confirm-cancel`, function (e) {
        $(`${element} .step-two`).addClass(`d-none`);
        $(`${element} input[name ="action"]`).prop(`checked`, false);
        $(`${element} .step-confirm-cancel`).removeClass(`d-none`);
    });

    $(document).on(`click`, `${element} .not-cancel`, function (e) {
        $(`${element} .step-two`).removeClass(`d-none`);
        $(`${element} .step-three`).addClass(`d-none`);
        $(`${element} input[name ="action"]`).prop(`checked`, false);
        $(`.process-cancel`).addClass(`d-none`);
        $(`${element} .step-confirm-cancel`).addClass(`d-none`);
    });

    $(document).on(`click`, `${element} .confirm-action`, function (e) {

        let isChecked = $(`${element} input[name="action"]:checked`).val() ? true : false;

        let selected = $(`${element} input[name="action"]:checked`).val();

        if (isChecked) {
            if (selected === `change`) {
                $(`${element}`).modal(`hide`);
                $(`#change-modal-${subscriptionID}`).modal(`show`);
            } else {
                $(`${element} .step-two`).addClass(`d-none`);
                $(`${element} .step-three`).removeClass(`d-none`);
            }
        } else {
            $(`${element} .error-cancel`).html(`Escolha uma ação abaixo.`).removeClass(`d-none`);
        }
    });

    $(document).on(`change`, `${element} input[name="action"]`, function (e) {
        let selected = $(`${element} input[name="action"]:checked`).val();

        if(selected) {
            $(`.process-cancel`).removeClass(`d-none`);
        } else  {
            $(`.process-cancel`).addClass(`d-none`);
        }
    });
};
