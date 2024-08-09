$(function() {
	var $dates;
	$dates = $('.mask-date');
	$dates.mask('99/99/9999');

	var $months;
	$months = $('.mask-month');
	$months.mask('99/9999');

	var $cnpjs;
	$cnpjs = $('.mask-cnpj');
	$cnpjs.mask('00.000.000/0000-00');

	var $times;
	$times = $('.mask-time');
	$times.mask('00:00');

	var $documents;
	$documents = $('.mask-cpf');
	$documents.mask('000.000.000-00');

	var $zip_code;
	$zip_code = $('.mask-zipcode');
	$zip_code.mask('00000-000');

	var $currency;
	$currency = $('.mask-currency');
	$currency.mask("#0,00", {reverse: true});
	/*
	$currency.maskMoney({ thousands: '', decimal: ',', allowZero: true });
	$currency.each(function (i, e) {
		if ($(e).val()) {
			$(e).maskMoney('mask');
		}
	});
	*/

	var $slug;
	$slug = $('.mask-slug');
	$slug.mask('Z', { translation: { 'Z': { pattern: /^[a-z0-9\-]+$/, recursive: true } } });

	var $integer;
	$integer = $('.mask-integer');
	$integer.mask('Z', { translation: { 'Z': { pattern: /^[0-9]+$/, recursive: true } } });

	var upperOptions = {
		onKeyPress: function (val, e, field, options) {
			e.currentTarget.value = val.toUpperCase();
		},
		translation: {
			'Y': { pattern: /^[A-z0-9\-_]$/, recursive: true }
		}
	};
	$('.mask-uppercase').mask('Y', upperOptions);

	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	};
	var spOptions = {
		onKeyPress: function (val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};
	$('.mask-phone').mask(SPMaskBehavior, spOptions);

	var CardBehaviour = function (val) {
		val = val.replace(/\D/g, '').substring(0, 6);

		var creditCardType = require('credit-card-type');
		var result = creditCardType(val);

		if (result.length == 1) {
			if (result[0].type == 'american-express') {
				return '0000 000000 00000'
			} else if (result[0].type == 'diners-club') {
				return '00000 0000 00000';
			}
		}

		return '0000 0000 0000 0000';
	};
	var cardOptions = {
		onKeyPress: function (val, e, field, options) {
			field.mask(CardBehaviour.apply({}, arguments), options);
		}
	};
	$('.mask-creditcard').mask(CardBehaviour, cardOptions);

	$('form').on('submit', function () {
		$(this).find('.strip-before-send').each(function () {
			$(this).val($(this).val().replace(/\D/g, ''));
			if ($(this).val() !== '0') {
				$(this).val($(this).val().replace(/^0+/, ''));
			}
		});
	});
});
