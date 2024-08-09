@component('admin.layouts.components.form.input_checkbox')
    @slot('type', $type)
    @slot('name', 'show_total_amount')
    @slot('checked', request()->query('show_total_amount', false))
@endcomponent
