@component('admin.layouts.components.card_clean')
    @slot('title', modelAttribute('default', 'options.day.' . $schedule->day)) 
    {{ html()->form('POST', route('web.admin.football_matches.store'))->open() }}

        
        {{ html()->hidden('group_modality_schedule_id', $schedule->id) }}
        {{ html()->hidden('day', $schedule->day) }}
        {{ html()->hidden('start_time', $schedule->start_time) }}
       
        <button type="submit" style="width: 100%" class="btn btn-primary fields-toggle" data-toggle="fields" data-target="sales-fields">
            Agendar Partida
        </button>

    {{ html()->form()->close() }}
    <div class="table-responsive">        
        <table class="table table-striped footballer-data">
            <tr>
                <td class="shrink"><strong>{{ modelAttribute($type_group, 'modality_id') }}</strong></td>
                <td>
                   {{ $schedule->modality->name }},
                </td>  
                <td class="shrink"><strong>{{ __('Duração') }}</strong></td>
                <td>
                    @component('admin.footballers.partials.duration')
                        @slot('start_time',$schedule->start_time)
                        @slot('closing_time',$schedule->closing_time)                        
                    @endcomponent
                </td>              
            </tr> 
            <tr>             
                
                <td class="shrink"><strong>{{ modelAttribute($type_group, 'start_time') }}</strong></td>
                <td>
                   {{ $schedule->start_time }}
                </td>
                <td class="shrink"><strong>{{ modelAttribute($type_group, 'closing_time') }}</strong></td>
                <td>
                   {{ $schedule->closing_time }}
                </td>
                
            </tr>             
        </table> 
    </div> 
@endcomponent