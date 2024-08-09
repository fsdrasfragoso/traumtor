$(function () {
	var forceSelect = function (el, option) {
		el.val(option);
		el.change();
	};

	$(document).on('keydown', '[data-flag]', function () {
		var val = $(this).val().replace(/\D/g, '').substring(0, 6);
		var result = creditCardType(val);
		var target = $($(this).data('flag'));

		if (result.length == 1) {
			if (result[0].type == 'american-express') {
				return forceSelect(target, 'american_express');
			} else if (result[0].type == 'visa') {
				return forceSelect(target, 'visa');
			} else if (result[0].type == 'mastercard') {
				return forceSelect(target, 'mastercard');
			} else if (result[0].type == 'elo') {
				return forceSelect(target, 'elo');
			} else if (result[0].type == 'hipercard') {
				return forceSelect(target, 'hipercard');
			}
		}
	});

});
