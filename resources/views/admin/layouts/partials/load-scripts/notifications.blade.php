<script>

	$(function() {

		// Validation Errors
        @if ($errors->count())
        @foreach($errors->all() as $message)
		toastr.error('{{ $message }}');
        @endforeach
        @endif

		// Success
        @if ($message = session('success'))
		toastr.success('{{ $message }}');
        @endif

		// Warning
        @if ($message = session('warning'))
		toastr.warning('{{ $message }}');
        @endif

		// Information
        @if ($message = session('info'))
		toastr.info('{{ $message }}');
        @endif

		// Status
        @if ($message = session('status'))
		toastr.info('{{ $message }}');
        @endif
	});

</script>
