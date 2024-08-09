<div class="form-group">
    {{ html()->label(modelAttribute($type, 'authors'), 'q[authors]') }}
    {{ html()->multiselect('q[authors]', $authors, request()->input('q.authors'))
        ->id('authors')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#authors').select2();
			});
        </script>
    @endpush
</div>
