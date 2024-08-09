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

        @if ($message = session('modal-notify'))
        $('#modal-notify').modal('show');
        @endif
	});

</script>

@if ($message = session('modal-notify'))
    <div id="modal-notify" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content {{ $message['top-color'] ?? 'border-top-primary' }}">
                <div class="modal-header border-bottom-0">
                    <h4 class="modal-title text-center font-weight-bold font-family-secondary w-100 mr-n5">
                        @if(isset($message['fa-icon']))
                            <i class="fas {{ $message['fa-icon'] }} text-{{ $message['icon-color'] ?? null }} mr-1"></i>
                        @endif
                        {{ $message['title'] }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="small" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        {!! nl2br($message['description']) !!}
                    </p>
                    @if(!empty($message['show-contact']))
                        <div class="d-flex flex-column align-items-center justify-content-center font-family-secondary">
                            <p class="font-size-2x mb-1">
                                <i class="fal fa-phone-alt"></i>
                                4003-3178
                            </p>
                            <small class="mb-1">Custo de ligação local</small>
                            <small><b>Horário de atendimento:</b> segunda a sexta das 9h às 18h</small>
                        </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-white border-dark px-3 py-1">FECHAR</button>
                </div>
            </div>
        </div>
    </div>
@endif
