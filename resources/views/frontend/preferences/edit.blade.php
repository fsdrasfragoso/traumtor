@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\Profile $profile
 * @var \App\Models\Address $address
 */
@endphp

@extends('frontend.layouts.template')

@section('title', title(__('Preferências')))

@section('content')
<main class="main-content d-flex flex-column">
    <div class="default-container">
        <div class="d-none d-lg-flex flex-column">
            <div class="flex-column aside-subscriber-area">
                <span class="folder-title bg-primary d-flex align-items-center fs-16 px-2">
                    Minha área
                </span>
                @include('frontend.layouts.partials.sections.subscriber-area-aside')
            </div>
        </div>
        <div id="form-preference" class="d-flex flex-column">
            <div class="default-card flex-column p-1 py-2 p-sm-4">
                <div class="title d-flex mb-0">
                    <h3>Preferências</h3>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{ html()->form('POST', route('frontend.preferences.update'))->open() }}
                @csrf

                <div class="form-group">
                    <label for="position">Posição no jogo:</label>
                    {{ html()->select('position', $positions, $preference->position ?? null)->class(['form-control'])->required() }}
                </div>

                <div class="form-group">
                    <label for="dominant_foot">Pé dominante:</label>
                    {{ html()->select('dominant_foot', $dominantFeet, $preference->dominant_foot ?? null)->class(['form-control'])->required() }}
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script>
        $( document ).ready(function() {
            $('#drop-preferences').click(function(){
                if($('#drop-preferences').hasClass('preferences-is-active')){
                    $('#drop-preferences').removeClass('preferences-is-active')
                    $('#drop-preferences-contents').hide(300)
                }
                else {
                    $('#drop-preferences').addClass('preferences-is-active')
                    $('#drop-preferences-contents').show(300)
                }
            });
        });
    </script>
@endpush
