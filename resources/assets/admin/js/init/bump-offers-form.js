window.initBumpOffersForm = () => {
    const typeRenewalOffer = document.querySelector('#type-renewal-offer');
    const aTypeRenewalOffer = typeRenewalOffer.querySelector('a');
    const selectOfferableId = typeRenewalOffer.querySelector('select#offerable_id')
    const urlBumpOffer = window.location.href;



    const editRenewalLink = (id) => {
        aTypeRenewalOffer.href = '/admin/renewal_offers/' + id  + '/edit';
        aTypeRenewalOffer.textContent = 'Renewal Offer #' + id;
    };

    const createRenewalLink = () => {
        aTypeRenewalOffer.href = '/admin/renewal_offers/create';
        aTypeRenewalOffer.textContent = 'Criar Renovação';
    };

    const typeBumpOfferEnvironment = () => {
        let idOfferableType = [];

        document.getElementsByName('offerable_type').forEach((item, index, list) => {
            const check = ! (item.checked && index !== 0);

            if (list.length == ++index) {
                list[0].checked = check;
            }

            idOfferableType.push(item.id)
        });

        const bumpOfferType = () => {
            const radioTypeId = document.querySelector('input[name=offerable_type]:checked').id;

            idOfferableType.forEach((id) => {
                if (id !== radioTypeId) {
                    $(`#type-${id}`).hide();
                    $(`#type-${id}`).find('select').attr('disabled', 'disabled');
                }
            });

            $(`#type-${radioTypeId}`).show();
            $(`#type-${radioTypeId}`).find('select').attr('disabled', false);
        };

        bumpOfferType();

        $('input[name=offerable_type]').on('change', () => {
            if (urlBumpOffer.search('edit') != -1 && selectOfferableId.value == '') {
                createRenewalLink();
            }
            bumpOfferType();
        });
    };

    const offerRenewalLinkToCreateOrEdit = () => {
        if (urlBumpOffer.search('create') != -1) {
            createRenewalLink();
        } else if (urlBumpOffer.search('edit') != -1) {
            editRenewalLink(selectOfferableId.value);
        }

        selectOfferableId.addEventListener('change', (ev) => {
            if (ev.target.value != '') {
                editRenewalLink(ev.target.value);
            } else {
                createRenewalLink();
            }

        });
    };

    typeBumpOfferEnvironment();
    offerRenewalLinkToCreateOrEdit();
};
