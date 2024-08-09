window.initSlickSeries = name => {
    let $carousel = $(`.folders-${name}`);
    let $controls = $(`.controls-${name}`);

    let $prev = $controls.find(".prev");
    let $next = $controls.find(".next");

    $carousel.on("init", function(event, slick) {
        $prev.css({ opacity: 0.4 });

        if (
            slick.currentSlide >=
            slick.slideCount - slick.options.slidesToShow
        ) {
            $controls.addClass("d-none");
        }
    });

    $carousel.slick({
        infinite: false,
        speed: 300,
        swipe: true,
        slidesToShow: 6,
        swipeToSlide: true,
        arrows: false,
        dots: false,
        touchThreshold: 30,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }
        ]
    });

    $carousel.on("afterChange", function(event, slick) {
        if (slick.currentSlide === 0) {
            $prev.css({ opacity: 0.4 });
        } else {
            $prev.css({ opacity: 1 });
        }

        if (
            slick.currentSlide >=
            slick.slideCount - slick.options.slidesToShow
        ) {
            $next.css({ opacity: 0.4 });
        } else {
            $next.css({ opacity: 1 });
        }
    });

    $prev.click(function() {
        $carousel.slick("slickPrev");
    });

    $next.click(function() {
        $carousel.slick("slickNext");
    });
};
