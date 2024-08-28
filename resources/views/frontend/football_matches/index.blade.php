
@extends('frontend.layouts.template')

@section('title', title(__('Editar meu perfil')))

@section('main-nav')
    @include('frontend.layouts.partials.sections.profiles-main-nav')
@endsection

@section('content')

    <main class="main-content d-flex flex-column">

        <div class="default-container input-profile">

            <div class="d-none d-lg-flex flex-column">
                <div class="flex-column aside-subscriber-area">
                    <span class="folder-title bg-primary d-flex align-items-center fs-16 px-2">
                        Minha área
                    </span>
                    @include('frontend.layouts.partials.sections.subscriber-area-aside')
                </div>
            </div>

            <div>
                @foreach($footballer->matches as $match)
                <div id="accordion" class="accordion--profile">
                    
                    <div class="card mb-3 rounded-sm position-relative overflow-hidden full-card">
                        <div class="card-header rounded-sm card-shadow d-flex justify-content-between align-items-center" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span>Partida de {{ \Carbon\Carbon::parse($match->match_datetime)->translatedFormat('l d/m/Y \à\s H:i:s') }}</i></span>
                            <i class="fal fa-angle-down fa-2x ml-1"></i>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                           @if($match->pivot->is_present == 0 && isset($match->pivot->id))
                                {{ html()->form('PUT', route('web.frontend.football_match_players.update', ['id' => $match->pivot->id]))->open() }}


                                {{ html()->hidden('is_present', 1) }}
                                {{ html()->hidden('football_match_id', $match->pivot->football_match_id) }}
                                {{ html()->hidden('footballer_id', $footballer->id) }}
                                

                                <button type="submit" style="width: 100%" class="btn btn-primary fields-toggle" data-toggle="fields" data-target="sales-fields">
                                    Confirmar Presença
                                </button>
                            
                                {{ html()->form()->close() }}
                           @endif
                           @component('admin.layouts.components.card_clean')
                                @slot('title', __('Jogadores Confirmados Para o Jogo'))
                                <div class="table-responsive">
                                    <table class="table table-striped footballer-data">
                                         @foreach ($match->footballers as $footballer)
                                             @if($footballer->pivot->is_present == 1)
                                             <tr>
                                                <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'name') }}</strong></td>
                                                <td>
                                                   {{ $footballer->name }}
                                                </td>
                                                <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'overall') }}</strong></td>
                                                <td>
                                                    {{ $footballer->overall }}
                                                </td>
                                                <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'dominant_foot') }}</strong></td>
                                                <td>                        
                                                    {{ modelAttribute(\App\Models\Footballer::class, 'options.dominant_foot.' . $footballer->dominant_foot) }}
                                                </td>                                                
                                            </tr> 
                                            @endif
                                         @endforeach        
                                    </table>
                                </div> 
                            @endcomponent
                        </div>
                    </div>                   
                    
                    
                  
                </div>
                @endforeach
            </div>
            
        </div>
    </main>
@endsection
