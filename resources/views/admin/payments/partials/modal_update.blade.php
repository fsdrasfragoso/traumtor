@php

use App\Models\Plan;

$plan = data_get($instance, 'subscription.plan');

@endphp

<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="modal-update-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{ html()->form('PUT', $instance->route('update'))->open() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="modal-update-label">
                        Alterar fatura
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close p-0 m-0">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @component('admin.layouts.components.form.input_text')
                        @slot('type', $instance)
                        @slot('name', 'amount')
                        @slot('class', 'mask-currency strip-before-send')
                        @slot('prepend', 'R$')
                    @endcomponent

                    @if ($plan)
                        <h5>Período de cobrança</h5>

                        <div class="form-row">
                            <div class="col-md-6">
                                @component('admin.layouts.components.form.input_datetime')
                                    @slot('type', $instance->period)
                                    @slot('name', 'start_at')
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('admin.layouts.components.form.input_datetime')
                                    @slot('type', $instance->period)
                                    @slot('name', 'end_at')
                                    @slot('disabled', true)
                                @endcomponent
                            </div>
                        </div>
                    @endif

                    <small class="text-muted">
                        Deixe qualquer campo em branco para não atualiza-lo.
                    </small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            </div>
        {{ html()->form()->close() }}
    </div>
</div>

<div class="modal fade" id="modal-update-confirmation" tabindex="-1" role="dialog" aria-labelledby="modal-update-confirmation-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="modal-update-confirmation-label">
                    Deseja fazer a seguinte alteração?
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close p-0 m-0">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Valor:</h5>
                <p>
                    <span class="font-weight-bold">De:</span>
                    <span>{{ moneyFormat(data_get($instance, 'amount')) }}</span>
                    <br>
                    <span class="font-weight-bold">Para:</span>
                    <span id="new-amount">{{ moneyFormat(data_get($instance, 'amount')) }}</span>
                </p>

                @if ($plan)
                    <h5>Período:</h5>
                    <p>
                        @php($start_at = data_get($instance, 'period.start_at'))
                        @php($end_at = data_get($instance, 'period.end_at'))

                        <span class="font-weight-bold">De:</span>
                        <span>{{ $start_at ? $start_at->format('d/m/Y') : 'Não determinado' }} - {{ $end_at ? $start_at->format('d/m/Y') : 'Não determinado' }}</span>
                        <br>
                        <span class="font-weight-bold">Para:</span>
                        <span id="new-start_at">{{ $start_at ? $start_at->format('d/m/Y') : 'Não determinado' }}</span> - <span id="new-end_at">{{ $end_at ? $start_at->format('d/m/Y') : 'Não determinado' }}</span>
                    </p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <button id="payment-update-confirm-btn" type="button" class="btn btn-primary">Sim</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')

@javascript('hasPlan', !!$plan)

@if($plan)
    @javascript('intervalCount', $plan->interval_count)
    @javascript('isMonth', $plan->interval == Plan::INTERVAL_MONTH)
@endif

<script>
    $(function() {
        $(document).on('dp.change', '#start_at', function() {
            if(!hasPlan) {
                return
            }

            const format = 'DD/MM/YYYY HH:mm:ss'

            if (isMonth) {
                var start_at = moment($(this).val(), format)
                var end_at = start_at.add(intervalCount, 'M').endOf('day').format(format)

                $('#end_at').val(end_at)
                $('#end_at').removeAttr('disabled')
            }
        })

        $('#modal-update form').submit(function(e) {
            // Determines if the event is triggered by the trigger jquery's function.
            if (e.isTrigger) {
                return
            }

            e.preventDefault();

            const dateFormat = 'DD/MM/YYYY'

            let newAmount = $('#amount').val()

            if (newAmount) {
                $('#new-amount').html(`R$ ${number_format(newAmount / 100, 2, ',', '.')}`).addClass('text-success')
            }

            if (hasPlan) {
                let newStartAt = $('#start_at').val()
                let newEndAt = $('#end_at').val()

                if (newStartAt) {
                    $('#new-start_at').html(moment(newStartAt, dateFormat).format(dateFormat)).addClass('text-success')
                }

                if (newEndAt) {
                    $('#new-end_at').html(moment(newEndAt, dateFormat).format(dateFormat)).addClass('text-success')
                }
            }

            $('#modal-update').modal('hide')
            $('#modal-update-confirmation').modal('show')
            $('#modal-update button[type=submit]').removeAttr('disabled')
        })

        $('#payment-update-confirm-btn').click(function(e) {
            $('#modal-update form').submit()
        })
    });
</script>
@endpush
