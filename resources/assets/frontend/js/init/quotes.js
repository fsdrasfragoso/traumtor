window.initQuotes = quotes => {

    quotes.forEach((key) => {

        axios.get('/ws/quotes/' + key).then((response) => {
            const quote = response.data;

            $('.quote-'+key+' .points').html(number_format(quote.lastTrade, 2, ',', '.'));

            $('.quote-'+key+' .percentage span').html(number_format(quote.change, 2, ',', '.'));

            $('.quote-'+key+' .loaded').removeClass('d-none');

            $('.quote-'+key+' .loading').addClass('d-none');

            if(quote.change > 0){
                $('.quote-'+key+' .percentage').addClass('percentage--up');
                $('.quote-'+key+' .percentage .fa').removeClass('fa-level-down');
                $('.quote-'+key+' .percentage .fa').addClass('fa-level-up');
            } else if(quote.change < 0){
                $('.quote-'+key+' .percentage').addClass('percentage--down');
                $('.quote-'+key+' .percentage .fa').removeClass('fa-level-up');
                $('.quote-'+key+' .percentage .fa').addClass('fa-level-down');
            }
        }).catch(() => {

        });

    });
};