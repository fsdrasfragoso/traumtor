<div class="form-group">
    {{ html()->label(__('Origem'), 'q[origin]') }}
    {{ html()->multiselect('q[origin]', $origin, request()->input('q.origin'))->id('origin')->class('form-control') }}
    @push('scripts')
        <script>
            $(function() {
                $('#origin').select2();
            });
        </script>
    @endpush
</div>
