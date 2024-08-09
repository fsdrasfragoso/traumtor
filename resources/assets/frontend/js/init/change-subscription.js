window.initChangeSubscription = (subscriptionID) => {

    let element = `#change-modal-${subscriptionID}`;

    $(element).on('hidden.bs.modal', function (e) {
        $(this).find('.can-change').removeClass('d-none');
        $(this).find('.not-change').addClass('d-none');
        $(this).find('.not-change-this-year').addClass('d-none');
        $(this).find('input[name ="product"]').prop('checked', false);
    });

    $(document).on('submit', `.form-change-${subscriptionID}`, function (e) {
        e.preventDefault();

        let self = this;

        let data = $(self).serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        if (data['changed'] || data['changedThisYear'] || data['changedProduct']) {

            if(data['changed']){
                $(self).find('.not-change').removeClass('d-none');
            } else if (data['changedThisYear']) {
                $(self).find('.not-change-this-year').removeClass('d-none');
            } else {
                $(self).find('.not-change-product').removeClass('d-none');
            }

            $(self).find('.can-change').addClass('d-none');

            let product_title = $(self).find('input[value="' + data['product'] + '"]').data('product-title');
            let product_route = $(self).find('input[value="' + data['product'] + '"]').data('route');

            $(self).find('.product-title').html(product_title);

            $(self).find('.not-change-product a').prop("href", product_route);
            $(self).find('.not-change-this-year a').prop("href", product_route);
            $(self).find('.not-change a').prop("href", product_route);
        } else {
            self.submit();
        }

        setTimeout(function () {
            $(self).find('button[type=submit]').removeAttr('disabled');
        }, 0);
    });
};
