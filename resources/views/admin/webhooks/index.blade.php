@extends('admin.layouts.template')

@section('filters')
    <div class="row">
        <div class="col-lg-6">
            @include('admin.layouts.components.filters.payment_gateway_equals')
        </div>
        <div class="col-lg-6">
            @include('admin.layouts.components.filters.type_contains')
        </div>
        <div class="col-lg-6">
            @include('admin.layouts.components.filters.reference_type_contains')
        </div>
        <div class="col-lg-6">
            @include('admin.layouts.components.filters.reference_id_equals')
        </div>
    </div>
@stop

@include('admin.layouts.partials.crud.index')
