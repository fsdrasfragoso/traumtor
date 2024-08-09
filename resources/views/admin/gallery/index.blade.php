@extends('admin.layouts.template')

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
                                    <a href="#modal-media-{{ $media->id }}" data-toggle="modal">
                                        <img class="card-img-top" src="{{ $media->getUrl() }}" alt="{{ $media->name }}">
                                    </a>
                                @else
                                    <img src="" class="card-img-top" />
                                @endif
                            </div>
                            <div id="modal-media-{{ $media->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $media->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body m-3">
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                <img class="img-responsive mb-3" src="{{ $media->getUrl() }}" alt="{{ $media->name }}">
                                            </a>
                                            <code>
                                                {{ $media->getUrl() }}
                                            </code>
                                            <br />
                                            <small> {{ $media->human_readable_size }} | {{ $media->mime_type }} </small>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route("web.admin.gallery.destroy", $media)}}" onclick="$('#modal-media-{{ $media->id }}').modal('hide')" data-method="delete" data-method-pjax="true" data-confirm="{{ modelAction($type, 'confirmation.delete') }}" data-token="{{ csrf_token() }}" class="btn btn-danger">Excluir</a>
                                        </div>
                                    </div><!-- /.modal-content -->

                                </div>
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
        <script>
			$(function() {
                $('#media-dropzone').dropzone({
                    acceptedFiles: ".png,.jpg,.jpeg",
                    maxFilesize: 2,
                    init: function() {
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
                });
            });
        </script>
    @endpush
@stop