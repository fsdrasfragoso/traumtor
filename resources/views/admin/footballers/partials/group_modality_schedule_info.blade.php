@component('admin.layouts.components.card_clean')
    @slot('title', $schedule->day)
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