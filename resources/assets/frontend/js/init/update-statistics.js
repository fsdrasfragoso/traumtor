window.updateStatistic = function (path, method) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: path,
        type: "PUT",
        data: {
            attribute: method
        },
        success: function (response) {
            if (response.status == '200'){
                console.log('success');
            } else {
                console.log('error');
            }
        }
    })
}