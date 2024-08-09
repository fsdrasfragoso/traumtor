window.initFormSubmit = function() {
	$('form').on('submit', function(e) {
		if(!e.defaultPrevented) {
			$(this).find('button:submit').prop('disabled', true);
		}
	});
};