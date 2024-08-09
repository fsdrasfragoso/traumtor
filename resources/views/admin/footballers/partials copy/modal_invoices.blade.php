<div id="invoices-modal-{{ $id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notas fiscais</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-{{ $id }}" data-url-invoices="{{ $urlInvoices }}">
                <div class="table-responsive" id="table-responsive-{{ $id }}">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="shrink border-top-0">#</th>
                            <th class="shrink border-top-0">Notas Fiscais</th>
                        </tr>
                        </thead>
                        <tbody id="tbody-{{ $id }}">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            const callInvoices = () => {
                const $tableResponsive = $('#table-responsive-{{ $id }}');
                const $modalBody = $('#modal-body-{{ $id }}');
                const urlInvoices = $modalBody.data('urlInvoices');
                const $tbody = $('#tbody-{{ $id }}');

                $('#invoices-modal-{{ $id }}').on('show.bs.modal', () => {
                    $tableResponsive.hide();
                    $.ajax({
                        url: urlInvoices,
                        beforeSend: () => {
                            $modalBody.append('<i class="fas fa-spinner fa-pulse fa-3x"></i>');
                            $modalBody.addClass('text-center');
                        },
                        complete: () => {
                            $tableResponsive.show();
                            $modalBody.find('i').remove();
                            $modalBody.removeClass('text-center');
                        },
                    }).done((response) => {

                        if (response.data.length > 0) {
                            if ($tbody.length > 0 ) {
                                response.data.forEach((url, key) => {
                                    let html =
                                        '<'+'tr>' +
                                        '<'+'td class="shrink">#' + ++key + '<'+'/td>' +
                                        '<'+'td class="shrink">' +
                                        '<'+'div class="mb-1">' +
                                        '<'+'a href="' + url + '" class="btn btn-outline-primary btn-sm" target="_blank" download>' +
                                        '<'+'i class="fal fa-download"><'+'/i> Baixar NFe' +
                                        '<'+'/a>' +
                                        '<'+'/div>' +
                                        '<'+'/td>' +
                                        '<'+'/tr>';

                                    $tbody.append(html);
                                });
                            }
                        } else {
                            $('#modal-body-{{ $id }}')
                                .empty()
                                .append('Nenhuma nota fiscal emitida.');
                        }
                    });
                }).on('hide.bs.modal', () => {
                    $tbody.empty();
                });
            };

            $(document).ready(function() {
                callInvoices();
            });
        });

    </script>
@endpush
