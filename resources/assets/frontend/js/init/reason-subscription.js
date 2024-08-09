window.initReasonsSubscription = (type, subscriptionID) => {

    let element = `#${type}-modal-${subscriptionID}`;

    $(`${element}`).on(`hidden.bs.modal`, function (e) {
        $(`${element} input[name ="reason"]`).prop(`checked`, false);
        $(`${element} input[name ="action"]`).prop(`checked`, false);
        $(`${element} textarea[name ="observations"]`).val('');

        $(`${element} .cancel-input-observation`).addClass(`d-none`);
        $(`${element} .process-${type}`).addClass(`d-none`);
        $(`${element} .step-two`).addClass(`d-none`);
        $(`${element} .step-three`).addClass(`d-none`);
        $(`${element} .step-confirm-${type}`).addClass(`d-none`);
        $(`${element} .error-${type}`).addClass(`d-none`);

        $(`${element} .step-one`).removeClass(`d-none`);
    });

    $(document).on(`click`, `${element} .continue-${type}`, function (e) {

        let isChecked = $(`${element} input[name="reason"]:checked`).val() ? true : false;

        let selected = $(`${element} input[name="reason"]:checked`).val();

        let description = $(`${element} textarea[name="observations"]`).val();

        if (isChecked) {
            if (selected === `others_ea` && !description && type !== 'deactivate') {
                $(`${element} .error-cancel`).html(`Informe o motivo no campo abaixo.`).removeClass(`d-none`);
            } else {
                $(`${element} .step-one`).addClass(`d-none`);
                $(`${element} .step-two`).removeClass(`d-none`);
            }
        } else {
            $(`${element} .error-cancel`).html(`Escolha um motivo da lista abaixo.`).removeClass(`d-none`)
        }
    });

    $(document).on(`change`, `${element} input[name="reason"]`, function (e) {
        if($(this).val() === `others_ea` && type !== 'deactivate') {
            $(`${element} .${type}-input-observation`).removeClass(`d-none`);
        } else if(!$(`${element} .${type}-input-observation`).hasClass(`d-none`)) {
            $(`${element} .${type}-input-observation`).addClass(`d-none`);
        }
        $(`${element} .error-${type}`).addClass(`d-none`);
    });
};
