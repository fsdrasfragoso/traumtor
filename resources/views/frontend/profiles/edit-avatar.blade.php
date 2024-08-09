@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\Profile $profile
 * @var \App\Models\Address $address
 */
@endphp

@extends('frontend.layouts.template')

@section('title', title(__('Alterar foto')))

@section('main-nav')
    @include('frontend.layouts.partials.sections.profiles-main-nav')
@endsection

@section('content')
<main class="main-content d-flex flex-column p-0 py-2 p-sm-4">
    <div class="default-container">

        <div class="d-none d-lg-flex flex-column">
            <div class="flex-column aside-subscriber-area">
                <span class="folder-title bg-primary d-flex align-items-center fs-16 px-2">
                    <a class="d-flex align-items-center" href="{{ route('web.frontend.profiles.edit', null, false) }}" data-pjax="#main">
                        <i class="fal fa-arrow-left m-2 font-weight-bold"></i>
                        <span>
                            Área do Assinante
                        </span>
                    </a>
                </span>
                @include('frontend.layouts.partials.sections.subscriber-area-aside')
            </div>
        </div>
        <div id="form-preference" class="d-flex flex-column">
                <div class="default-card flex-column p-1 py-2 p-sm-4">
                    <div class="title d-flex">
                        <h3>Alterar foto</h3>
                    </div>

                    @php($avatar = $footballer ? $footballer->getFirstMedia('avatar') : null)
                    @if( isset($avatar) )
                        @php($avatarUrl = $avatar ? $avatar->getUrl() : null)
                        <div class="my-croppie-element mb-2"><img id="img" src="{{ $avatarUrl }}" width="300px"></div>
                    @else
                        <div class="my-croppie-element"></div>
                    @endif

                    {{ html()->file('avatar') }}

                    <div class="form-group mt-3 mb-0">
                        <button type="button" class="btn btn-danger btn-md btn-delete mb-1 {{!$avatar ? 'd-none' : ''}}">Excluir</button>
                        <button type="button" class="btn btn-primary btn-md btn-upload mb-1">Salvar</button>
                    </div>
                </div>
        </div>
    </div>
</main>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var empty = true;
            var avatar = $("#avatar");
            var img = $("#img");
            var btnDelete = $(".btn-delete");
            var btnUpload = $(".btn-upload");
            var $element = $('.my-croppie-element');

            avatar.on('change', function () {
                var fileExtension = ['jpeg', 'jpg', 'png'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    empty = true;
                    toastr.warning('Sua foto deve estar em jpeg, jpg ou png.');
                    $(this).val('');
                } else {
                    empty = false;
                    var reader = new FileReader();
                    reader.onloadend = function () {
                        if(!$element.data('croppie')) {
                            img.hide();
                            $element.croppie({
                                enableExif: true,
                                enableOrientation: true,
                                viewport: {
                                    width: 300,
                                    height: 300,
                                    type: 'square' // circle para redondo
                                },
                                boundary: {
                                    width: 320,
                                    height: 320
                                }
                            });
                        }
                        $element.croppie('bind', reader.result);
                        btnDelete.show();
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            btnDelete.on("click", function() {
                empty = true;
                $element.html('');
                $element.removeClass("croppie-container");
                $element.croppie({
                    enableExif: true,
                    enableOrientation: true,
                    viewport: {
                        width: 300,
                        height: 300,
                        type: 'square' // circle para redondo
                    },
                    boundary: {
                        width: 320,
                        height: 320
                    }
                });
                avatar.val('');
                btnDelete.addClass('d-none');
            });

            btnUpload.on('click', function () {
                if ($element.data('croppie')) {
                    if(empty) {
                        sendAvatar(null);
                    } else {
                        $element.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                        }).then(function (img) {
                            sendAvatar(img);
                        });
                    }
                } else {
                    toastr.warning('Você precisa selecionar uma imagem.');
                }
            });

            function sendAvatar(img) {
                $.ajax({
                    url: "{{route('web.frontend.profiles.updateAvatar')}}",
                    type: "PUT",
                    data: {"image":img},
                    complete: function (response) {
                        if (response.status == '200'){
                            $.pjax.reload({container:'#wrapper'});
                            toastr.success(response.responseJSON.message);
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            }
        });
    </script>
@endpush
