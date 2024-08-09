@extends('admin.layouts.template')

@section('filters')

    <div class="row">
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.name_contains')
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
