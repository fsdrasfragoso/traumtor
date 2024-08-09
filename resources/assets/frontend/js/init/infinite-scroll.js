window.initInfiniteScroll = function () {
	$("ul.pagination").hide();

	$(".infinite-scroll").jscroll({
		autoTrigger: true,
		loadingHtml:
			'<div class="d-flex justify-content-center p-2 mt-2 mb-2">' +
			'<div class="spinner-border text-primary" role="status">' +
			'<span class="sr-only">Carregando...</span>' +
			"</div>" +
			"</div>",
		padding: 150,
		nextSelector: ".pagination li.active + li a",
		contentSelector: "div.infinite-scroll",
		callback: () => {
			$("ul.pagination").hide();
			const slider = $(".pagination li.active + li a").html() - 1;
			initSlickSocial(slider);
		}
	});
};