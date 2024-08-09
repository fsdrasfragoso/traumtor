window.initFilterSeries = function () {
    $(document).on('change','.filters', function() {
        if(this.checked) {
            $(this).closest('.slide').addClass('marked');
        } else {
            $(this).closest('.slide').removeClass('marked');
        }
        $('.submit-filters').removeClass('d-none');
    });

    $(document).on('change','input[name=select-filters-desk], input[name=select-filters-mobile]', function() {
        if(this.checked) {
            $('.filters').prop('checked', 'checked');
            $('.filters').closest('.slide').addClass('marked');
        } else {
            $('.filters').prop('checked', null);
            $('.filters').closest('.slide').removeClass('marked');
        }
        $('.submit-filters').removeClass('d-none');
    });

    $(document).on('click','.submit-filters', function() {
        $('.form-folder-filter').submit();
    });

};
