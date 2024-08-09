window.initFormAnchors = function() {
	let $selectors = $('[data-method]');

	function forward($item) {
		var method = $item.data('method');
		var action = $item.attr('href');
		var csrf_token = $('meta[name="csrf-token"]').attr('content');

		var form =
			$('<form>', {
				'method': 'POST',
				'action': action,
			});

		if($item.data('method-pjax')) {
			form.attr('data-pjax', '');
		}

		var token =
			$('<input>', {
				'type': 'hidden',
				'name': '_token',
				'value': csrf_token
			});

		var hiddenInput =
			$('<input>', {
				'name': '_method',
				'type': 'hidden',
				'value': method
			});

		return form.append(token, hiddenInput)
			.appendTo('body')
			.submit();
	}

	$selectors.each(function () {
		let $item = $(this);

		$item.on('click', function (e) {
			e.preventDefault();

			let confirmation;
			let $this = $(this);

			if (confirmation = $this.data('confirm')) {

				if(confirm(confirmation)) {
					forward($this);
				}
			} else {
				forward($this);
			}

			return false;
		});
	});
};