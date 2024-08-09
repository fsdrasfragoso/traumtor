@component('admin.layouts.components.form.select')
    @slot('label', 'Tipo de cancelamento')
    @slot('name', 'cancellation_type')
    @slot('options', \App\Models\Subscription::cancellationTypeOptions())
    @cannot('setCancellationType', $instance)
        @slot('value', \App\Models\Subscription::CANCELLATION_TYPE_REAL)
        @slot('class', 'd-none')
    @endcannot
@endcomponent

@component('admin.layouts.components.form.input_datetime')
    @slot('class', 'hide-on-test d-none')
    @slot('label', 'Data de cancelamento')
    @slot('name', 'canceled_at')
    @slot('value', now()->format('d/m/Y H:i'))
@endcomponent

@component('admin.layouts.components.form.select')
    @slot('class', 'hide-on-test d-none')
    @slot('label', 'Motivo do Cancelamento')
    @slot('name', 'reasons')
    @slot('options', modelAttribute(\App\Models\Subscription::class, 'reasons.cancellation'))
@endcomponent

@component('admin.layouts.components.form.input_textarea')
    @slot('class', 'hide-on-test d-none')
    @slot('label', 'Observações')
    @slot('name', 'observations')
@endcomponent