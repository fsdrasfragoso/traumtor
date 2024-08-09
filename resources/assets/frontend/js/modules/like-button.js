/**
 * Variables
 */

let timeout = null;
let likeBtn = null;
let requestParams = {};

/**
 * Methods
 */

const sendRequest = _.debounce(() => {
    axios
        .post("/usuario/curtidas", requestParams)
        .then(({ data }) => {
            likeBtn.data("footballer-counter", data.likes);
            likeBtn.data("stage-counter", 0);
        })
        .catch(() => {
            let defaultCounter = likeBtn.data("default-counter");
            let footballerCounter = likeBtn.data("footballer-counter");

            likeBtn.data("stage-counter", 0);

            likeBtn
                .children(".like-button__total-counter")
                .html(defaultCounter + footballerCounter);

            if (footballerCounter > 0) {
                likeBtn.addClass("like-button--liked");
            } else {
                likeBtn.removeClass("like-button--liked");
            }
        });
}, 1000);

/**
 * Listeners
 */

$(document).on("click", ".like-button>.like-button__container", function() {

    likeBtn = $(this).parent();
    
    let totalCounter = likeBtn.children(".like-button__total-counter");

    let footballerCounter = likeBtn.data("footballer-counter");
    let defaultCounter = likeBtn.data("default-counter");

    let count = 1;

    if (footballerCounter < 1) {
        likeBtn.addClass("like-button--liked");
    } else {
        count = 0;
        likeBtn.removeClass("like-button--liked");
    }

    likeBtn.data("footballer-counter", count);

    totalCounter.html(defaultCounter + count);

    requestParams = {
        id: likeBtn.data("content-id"),
        likes: count
    };

    sendRequest();
});
