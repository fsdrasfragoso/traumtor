@extends('admin.layouts.template_browser')

@section('title', title(__('Imagens')))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', __('Imagens'))
    @endcomponent

    <div class="row">

        <div class="col-lg-12">
            @component('admin.layouts.components.card')
                @slot('title', __('Upload de imagens'))

                {{ html()->form('POST', route('web.admin.gallery.store'))->class('dropzone')->id('media-dropzone') }}
                {{ html()->form()->close() }}

            @endcomponent
        </div>

        <div class="col-lg-12">

            @component('admin.layouts.components.card_filter')

                {{ html()->form('GET', $instance->route('index'))->open() }}

                    <div class="row">
                        <div class="col-12">
                            @include('admin.layouts.components.filters.file_name_contains')
                        </div>
                    </div>
                    @include('admin.layouts.components.filters.buttons')

                {{ html()->form()->close() }}
            @endcomponent

        </div>
        <div class="col-lg-12">

            @component('admin.layouts.components.card')
                @slot('title', __('Listagem de imagens'))

                @if($resources->isEmpty())
                    Nenhuma imagem.
                @endif

                <div class="row">
                    @foreach($resources as $media)
                        <div class="col-xs-3 col-sm-2">
                            <div class="card">
                                @if(starts_with($media->mime_type, 'image'))
                                    <a href="{{ $media->getUrl() }}" class="thumbnail">
                                        <img class="card-img-top" src="{{ $media->getUrl() }}" alt="{{ $media->name }}">
                                    </a>
                                @else
                                    <img src="" class="card-img-top" />
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endcomponent

            @if($pagination = $resources->appends(request()->all())->links())
                {!! $pagination !!}
            @endif

        </div>
    </div>

    @push('scripts')
        <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>
        <script>
			$.urlParam = function(name){
				var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
				return results[1] || 0;
			};

			$('a.thumbnail').on('click', function (e) {
				e.preventDefault();

				var url = $(this).attr('href');

				this.onclick = null;

				funcNum = decodeURIComponent($.urlParam('CKEditorFuncNum'));

				window.opener.CKEDITOR.tools.callFunction(funcNum, url);

				window.close();
			});

			Dropzone.options.mediaDropzone = {
                acceptedFiles: ".png,.jpg,.jpeg",
                maxFilesize: 2,
				parallelUploads: 1,
				dictDefaultMessage: "Clique ou arraste uma imagem para enviar",
				init: function () {
                    this.on('error', function(file) {
                        if (!file.accepted) {
                            this.removeFile(file);
                            toastr.error('O arquivo deve ser uma imagem e deve ter o tamanho máximo de 2MB.');
                        }
                    })
					this.on('success', function(file, response) {
                        this.on("queuecomplete", function (file) {
                            location.reload();
                        });
                    })
				}
			};
        </script>
    @endpush
@stop
