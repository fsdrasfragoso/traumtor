@extends('admin.layouts.template')

@section('filters')

    <div class="row">
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.id_equals')
        </div>
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.external_code_contains')
        </div>
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.status_multiple', [
                'statuses' => $instance->statusOptions()
            ])
        </div>
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.payment_gateway_equals')
        </div>
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.payment_method_equals')
        </div>

        <div class="col-lg-4">
            @include('admin.layouts.components.filters.created_at_greater')
        </div>
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.created_at_lesser')
        </div>

    </div>
@stop

@include('admin.layouts.partials.crud.index')
