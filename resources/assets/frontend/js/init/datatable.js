window.initDatatable = function() {

    const options  = {
        paging: false,
        fixedHeader: true,
        scrollY: ($(window).height() - 300) + 'px',
        bScrollCollapse: true,
        language: {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        fnInitComplete: function(){
            $('.dataTables_scrollHead').css('overflow', 'auto');

            $('.dataTables_scrollHead').on('scroll', function () {
                $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
            });
        }
    };

    if(window.matchMedia('(max-width: 991px)').matches) {
        options['responsive'] = true;
    } else {
        options['fixedColumns'] = true;
        options['scrollX'] = true;
    }

    $('#content-data-table').DataTable(options);

    $(document).on('click', '.btn-fullscreen', function(e) {
        e.preventDefault();
        $('.content-data').addClass('fullscreen');
        $('.btn-fullscreen-close').removeClass('d-none');
    });
    $(document).on('click', '.btn-fullscreen-close', function(e) {
        e.preventDefault();
        $('.content-data').removeClass('fullscreen');
        $('.btn-fullscreen-close').addClass('d-none');
    });
};
