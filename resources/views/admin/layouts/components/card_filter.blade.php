@php($uniqueId = uniqid(''))
@php($collapse = request()->has('q'))

<div class="card">
    <a href="#card{{ $uniqueId }}" data-toggle="collapse">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="far fa-filter"></i> {{ __('Filtrar registros') }}
            </h5>
        </div>
    </a>

    <div class="card-body collapse {{ $collapse ? 'show' : '' }}" id="card{{ $uniqueId }}">
        {{ $slot }}
    </div>
</div>
