@extends('admin.layouts.template')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            @component('admin.layouts.components.card')
                @slot('title', __('Features'))

                {{ html()->form('GET', $instance->route('features'))->open() }}
                    <div class="input-group">
                        <input class="form-control" name="q" value="{{ request()->input('q') }}" placeholder="Pesquisar...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                {{ html()->form()->close() }}

                {{ html()->modelForm($instance, 'PUT', $instance->route('features'))->acceptsFiles(true)->attribute('data-validation', $instance->hasRoute('validation') ? $instance->route('validation') : '')->attribute('id', 'features-form')->open() }}
                    <table class="table table-striped mt-4">
                        <thead>
                            <th scope="col">Funcionalidade</th>
                            <th scope="col" class="shrink">Data de criação</th>
                            <th scope="col" class="shrink">Ativo?</th>
                        </thead>
                        <tbody>
                            @forelse ($features as $feature)
                                <tr class="feature-row">
                                    <td>
                                        <span>{{ $feature->description }}</span>
                                        <br>
                                        <code>{{ $feature->slug }}</code>
                                    </td>
                                    <td class="text-center">
                                        {{ $feature->created_at->format(config('admin.date_format')) }}
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="hidden" name="{{ $feature->slug }}" value="0" />
                                                {{ html()->checkbox($feature->slug, $feature->active, 1)->id($feature->slug)->class(['custom-control-input']) }}
                                                {{ html()->label('', $feature->slug)->class(['custom-control-label']) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        {{ trans('pagination.no_records') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <nav aria-label="Page navigation example">
                            {!! $features->links('vendor.pagination.bootstrap-4') !!}
                        </nav>
                    </div>
                {{ html()->closeModelForm() }}
            @endcomponent

            <div class="form-group">
                {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg')->attribute('form', 'features-form') }}
            </div>
        </div>
    </div>
@stop

@include('admin.settings.partials.wrapper')

@push('scripts')
    <script>
        $(function () {
            $(document).on('click', '.feature-row', function (e) {
                e.preventDefault();
                let feature_checkbox = $(this).children().last().find('input[type=checkbox]');
                let label = feature_checkbox.parent().find('label');
                feature_checkbox.attr('checked', !feature_checkbox.is(':checked'));
                label.html(feature_checkbox.is(':checked') ? 'Ativo' : 'Inativo');
            })
        })
    </script>
@endpush
