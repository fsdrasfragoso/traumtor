window.initDatetimepicker = function() {
	let $datePicker = $('.date-picker');

	$datePicker.datetimepicker({
		format: 'DD/MM/YYYY',
		useCurrent: false,
	});

	$('.datetime-picker').datetimepicker({
		format: 'DD/MM/YYYY HH:mm:ss',
	});

	$('.month-picker').datetimepicker({
		format: 'MM/YYYY',
	});

	$datePicker.on('dp.change', function (e) {
		let min = e.target.dataset.min;
		let max = e.target.dataset.max;
		let date = e.date || moment(e.target.value, "DD/MM/YYYY");

		if (min) {
			$(min).data("DateTimePicker").minDate(date);
		}

		if (max) {
			$(max).data("DateTimePicker").maxDate(date);
		}
	});

	$datePicker.trigger('dp.change');
};