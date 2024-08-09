export default class TextAdjustService {
    constructor(selector) {
        this.localStorageKey = "text-size-percentage";
        this.incrementThickness = 0.1;

        this.selector = selector;
        this.textSizePercentage = 1;

        this.textSizePercentage = parseFloat(
            localStorage.getItem(this.localStorageKey)
        );

        console.log(this.textSizePercentage);

        if (!this.textSizePercentage) {
            localStorage.setItem(this.localStorageKey, 1);
        }
    }

    adjust() {
        $(this.selector).each((key, element) => {
            if (!$(element).data("default-font-size")) {
                $(element).data(
                    "default-font-size",
                    $(element).css("font-size")
                );
            }

            if (!$(element).data("default-line-height")) {
                $(element).data(
                    "default-line-height",
                    $(element).css("line-height")
                );
            }

            let fontSize = parseFloat($(element).data("default-font-size"));
            fontSize *= this.textSizePercentage;

            let lineHeight = parseFloat($(element).data("default-line-height"));
            lineHeight *= this.textSizePercentage;

            $(element).css("font-size", fontSize + "px");
            $(element).css("line-height", lineHeight + "px");
        });

        return this;
    }

    increment() {
        if (this.textSizePercentage >= 2) {
            return;
        }

        this.textSizePercentage += this.incrementThickness;
        localStorage.setItem(this.localStorageKey, this.textSizePercentage);

        this.adjust();

        return this;
    }

    reset() {
        this.textSizePercentage = 1;
        localStorage.setItem(this.localStorageKey, this.textSizePercentage);

        this.adjust();

        return this;
    }
}
