@extends('admin.layouts.template')

@section('filters')

    <div class="row">
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.name_contains')
        </div>
        <div class="col-lg-4">
            @include('admin.layouts.components.filters.player_count_contains')
        </div>        
    </div>

@stop

@include('admin.layouts.partials.crud.index')

@push('scripts')
    <script>
        $(function() {
            initMask();
        })
    </script>
@endpush
