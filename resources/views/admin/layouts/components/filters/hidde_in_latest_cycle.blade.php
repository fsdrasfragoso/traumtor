@component('admin.layouts.components.form.input_checkbox')
    @slot('type', $type)
    @slot('name', 'hidde_in_latest_cycle')
    @slot('checked', request()->query('hidde_in_latest_cycle', false))
@endcomponent
