window.initBootstrap = function() {
	// Popovers
	// Note: Disable this if you're not using Bootstrap's Popovers
	$('[data-toggle="popover"]').popover({
		container: '#main-content'
	});

	// Tooltips
	// Note: Disable this if you're not using Bootstrap's Tooltips
	$('[data-toggle="tooltip"]').tooltip({
		container: '#main-content'
	});
};