import TextAdjustService from "../services/text-adjust-service";

const selector = ".article .description.entry-content *";

$(document).ready(() => {
    new TextAdjustService(selector).adjust(selector);
});

$(document).on("click", ".article-zoom-plus-btn", () => {
    new TextAdjustService(selector).increment();
});

$(document).on("click", ".article-zoom-reset-btn", () => {
    console.log(`click`)
    new TextAdjustService(selector).reset();
});
