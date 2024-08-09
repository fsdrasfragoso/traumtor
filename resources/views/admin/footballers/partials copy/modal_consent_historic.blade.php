<div class="modal fade" id="consent-historic" tabindex="-1" role="dialog" aria-labelledby="consent-historic" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 m-0">
                <table class="w-100 table-responsive-lg">
                    <thead class="bg-gray-200">
                        <th class="pl-3 py-2">Ciclo</th>
                        <th>Início do Período</th>
                        <th>Final do Período</th>
                        <th>Data do Consentimento</th>
                    </thead>
                    <tbody id="consent-content">
                        {{-- Conteúdo do modal --}}
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">fechar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('.consent-history').on('click', function() {
                const format = 'DD/MM/YYYY HH:mm:ss'
                let subscriptionId = $(this).data('id');
                $('#consent-content').html('');

                axios.get("/admin/get/subscription/" + subscriptionId)
                    .then((data) => {
                        let plan = data.data.plan;
                        let periods = data.data.periods;

                        if (periods.length > 0) {
                            $('#modal-title').html("Histórico de consentimentos | " + plan.title)
                            $.each(periods, function(k, v) {
                                $('#consent-content').append(`
                                    <tr class="${ k%2 != 0 ? 'bg-gray-200' : '' }">
                                        <td class="ml-3 text-center py-2">${v.cycle}</td>
                                        <td>${moment(v.start_at).format(format)}</td>
                                        <td>${moment(v.end_at).format(format)}</td>
                                        <td>${moment(v.consent_at).format(format)}</td>
                                    </tr>
                                `)
                            })
                            $('#consent-historic').modal('show');
                        }
                    })
            })
        })
    </script>
@endpush
