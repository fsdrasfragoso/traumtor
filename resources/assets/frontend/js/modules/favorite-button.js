const elementClass = "favorite-button";

const sendRequest = (contentId, favorite) => {
    return axios.put(`/usuario/favoritos/${contentId}`, { favorite });
};

const markButtonAsFavorited = contentId => {
    let btn = $(`.${elementClass}[data-content-id=${contentId}]`);

    $(btn).data("is-favorite", true);
    $(btn)
        .children("span")
        .removeClass("fal")
        .addClass("fas");
};

const markButtonAsUnfavorited = contentId => {
    let btn = $(`.${elementClass}[data-content-id=${contentId}]`);

    $(btn).data("is-favorite", false);
    $(btn)
        .children("span")
        .removeClass("fas")
        .addClass("fal");
};

$(document).on("click", `.${elementClass}`, function(e) {
    e.preventDefault();

    let btn = $(this);
    let contentId = btn.data("content-id");
    let isFavorite = btn.data("is-favorite");

    isFavorite
        ? markButtonAsUnfavorited(contentId)
        : markButtonAsFavorited(contentId);

    sendRequest(contentId, !isFavorite).catch(() => {
        isFavorite
            ? markButtonAsFavorited(contentId)
            : markButtonAsUnfavorited(contentId);
    });
});
