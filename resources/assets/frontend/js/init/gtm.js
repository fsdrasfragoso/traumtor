window.initGTM = function() {
	$('link[rel="canonical"]').attr('href', location.href);
	ga = gaData = gaGlobal = gaplugins = google_tag_manager = dataLayer = undefined;
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TLDBT4X');
	console.log('initGTM');
};