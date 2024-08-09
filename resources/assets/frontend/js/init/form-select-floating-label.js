window.initFormSelectFloatingLabel = function() {

	function checkval() {
		if ($(this).val() === "") {
			$(this).removeClass('is-selected');
		} else {
			$(this).addClass('is-selected');
		}
	}

	$('.form-label-group select.form-control').on('change', checkval);
	$('.form-label-group select.form-control').each(checkval);
};