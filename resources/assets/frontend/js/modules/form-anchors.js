$(function() {
    function forward($item) {
        var method = $item.data("method");
        var action = $item.attr("href");
        var csrf_token = $('meta[name="csrf-token"]').attr("content");

        var form = $("<form>", {
            method: "POST",
            action: action
        });

        if ($item.data("method-pjax")) {
            form.attr("data-pjax", $item.data("method-pjax"));
        }

        if ($item.data("pjax-noscroll")) {
            form.attr("data-pjax-noscroll", $item.data("pjax-noscroll"));
        }

        var token = $("<input>", {
            type: "hidden",
            name: "_token",
            value: csrf_token
        });

        var hiddenInput = $("<input>", {
            name: "_method",
            type: "hidden",
            value: method
        });

        return form
            .append(token, hiddenInput)
            .appendTo("body")
            .submit();
    }

    $(document).on("click", "[data-method]", function(e) {
        e.preventDefault();

        let confirmation;
        let $this = $(this);

        if ((confirmation = $this.data("confirm"))) {
            if (confirm(confirmation)) {
                forward($this);
            }
        } else {
            forward($this);
        }

        return false;
    });
});
