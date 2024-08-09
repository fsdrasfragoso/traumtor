window.initSlickSocial = (page = 1) => {
    $(".page-contents-" + page).slick({
        dots: true,
        arrows: false,
        infinite: false,
        speed: 300,
        swipe: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        mobileFirst: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    swipe: true,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    swipe: true,
                    dots: true
                }
            }
        ]
    });
};
