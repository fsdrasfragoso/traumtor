@component('admin.layouts.components.card_clean')
    @slot('title', 'Partida de ' . \Carbon\Carbon::parse($match->match_datetime)->translatedFormat('l d/m/Y \à\s H:i:s'))
    <div class="table-responsive">

    </div>
@endcomponent
