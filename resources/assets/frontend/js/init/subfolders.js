window.initSubfolders = function() {
    function scrollLeft() {
        $(".wrapit").css("left", function() {
            let x = $(this).parent().position().left;
            let viewport_width = $( window ).width();
            let el_width = $(this).width();
            let new_x = x;

            if ( x < 0 ) {
                new_x = 0;
            } else if ( (x + el_width) > viewport_width ) {
                new_x = (viewport_width - el_width - 2);
            }

            return new_x;
        });
    }

    $(".menu-container").scroll(function() {
         scrollLeft();
         $(".submenu").children().removeClass("display-show");
    });

    $(".submenu").on('click', function(e) {

        let has = $(this).children().hasClass("display-show");

        $(".submenu").children().removeClass("display-show");

        if(!has){
            $(this).children().addClass("display-show");
        }

        scrollLeft();

        $(".wrapit").css("top", function() {
            return ($(this).parent().position().top + $(this).parent().height() + 9);
        });
    });

    document.addEventListener('click', (event) => {
        const $target = $(event.target);
        if (!$target.closest(".display-show").length) {
            $(".submenu").children().removeClass("display-show");
        }
    });

    scrollLeft();
};