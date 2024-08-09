@component('admin.layouts.components.form.input_checkbox')
    @slot('type', $type)
    @slot('checked', $instance->published_at != old('apparent_date', $instance->apparent_date))
    @slot('name', 'check-' . $name)
@endcomponent

@component('admin.layouts.components.form.input_datetime')
    @slot('type', $type)
    @slot('name', $name)
    @slot('label', '')
    @slot('value', $instance->published_at != old('apparent_date', $instance->apparent_date) ? $instance->apparent_date->format(config('admin.timestamp_format')) : null)
    @slot('class', $instance->published_at != old('apparent_date', $instance->apparent_date) ? '' : 'd-none')
@endcomponent

@push('scripts')
    <script>
        $(function() {
            $('input[name=check-{{$name}}').change(function () {
                let input_wrapper = $('input[name={{$name}}]').parent().parent();

                input_wrapper.toggleClass('d-none');

                if (input_wrapper.hasClass('d-none')) {
                    $('input[name={{$name}}]').val(null);
                }
            })
        })
    </script>
@endpush
