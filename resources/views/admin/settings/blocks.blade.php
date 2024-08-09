@extends('admin.layouts.template')

@section('form')
    {{ html()->modelForm($instance, 'PUT', $instance->route('blocks'))->acceptsFiles(true)->attribute('data-validation', $instance->hasRoute('validation') ? $instance->route('validation') : '')->open() }}

    <div class="row">
        <div class="col-lg-12">
            @component('admin.layouts.components.card_clean')
                @slot('title', __('E-mails bloqueados'))
                @slot('subtitle', __('(adicione e-mails ou dominios para serem bloqueados no cadastro)'))

                @php($blocks = old('blocks', settings('blocks') ?: []))

                <div class="repeater repeater-blocks">
                    <div class="card-body">
                        <button data-repeater-create type="button" class="btn btn-secondary">
                            Adicionar
                        </button>
                    </div>

                    <table data-repeater-list="blocks" class="table table-striped mb-0">
                        <tbody>
                        @forelse ($blocks as $item)
                            <tr data-repeater-item>
                                <td><input type="text" class="form-control {{ $errors->has('blocks.'.$loop->index.'.email') ? 'is-invalid' : '' }}" name="email" value="{{ $item['email'] }}"></td>
                                <td class="shrink"><button data-repeater-delete type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i></button></td>
                            </tr>
                        @empty
                            <tr data-repeater-item style="display:none">
                                <td><input type="text" class="form-control" name="email"></td>
                                <td class="shrink"><button data-repeater-delete type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i></button></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @push('scripts')
                    <script>
                        $(function() {
                            $('.repeater-blocks').repeater({
                                @if (!$blocks)
                                initEmpty: true
                                @endif
                            });
                        });
                    </script>
                @endpush
            @endcomponent

            <div class="form-group">
                {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
            </div>
        </div>
    </div>

    {{ html()->closeModelForm() }}

@stop

@include('admin.settings.partials.wrapper')
