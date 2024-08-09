$(function() {
    $(document).on('submit', 'form', function(e) {
        if(!e.defaultPrevented) {
            $(this).find('button:submit').prop('disabled', true);
        }

		$this = $(this);

		if ($this.data().isSubmitted) {
			return false;
		}

		$this.data().isSubmitted = true;

    });
});
