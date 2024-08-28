@component('admin.layouts.components.card_clean')
@slot('title', $group->name)
<div class="table-responsive">
    
    <table class="table table-striped footballer-data">
        <tr>
            <td class="shrink"><strong>{{ modelAttribute($type_group, 'street') }}</strong></td>
            <td>
               {{ $group->street }},
            </td>
            <td class="shrink"><strong>{{ modelAttribute($type_group, 'number') }}</strong></td>
            <td>
               {{ $group->number }}
            </td>
        </tr>
        <tr>
            <td class="shrink"><strong>{{ modelAttribute($type_group, 'zip_code') }}</strong></td>
            <td>
               {{ $group->zip_code }}
            </td>
            <td class="shrink"><strong>{{ modelAttribute($type_group, 'neighborhood') }}</strong></td>
            <td>
               {{ $group->neighborhood }}
            </td>
        </tr>           
        <tr>
            <td class="shrink"><strong>{{ modelAttribute($type_group, 'city') }}</strong></td>
            <td>
               {{ $group->city }}
            </td>
            <td class="shrink"><strong>{{ modelAttribute($type_group, 'state') }}</strong></td>
            <td>
               {{ $group->state }}
            </td>
        </tr>            
    </table>
</div> 
@endcomponent
@component('admin.layouts.components.card_clean')
@slot('title', __('Horarios'))

@foreach ($group->schedules as $schedule)
    @component('frontend.groups.partials.group_modality_schedule_info')

        @slot('schedule',$schedule)
        @slot('type_group',$type_group)
    @endcomponent    
@endforeach

@endcomponent


@component('admin.layouts.components.card_clean')
@slot('title', __('Jogadores'))
<div class="table-responsive">
    <table class="table table-striped footballer-data">
        @foreach ($group->footballers as $footballer)
            <tr>
                <td class="shrink"><strong>{{ modelAttribute($type, 'name') }}</strong></td>
                <td>
                   {{ $footballer->name }}
                </td>
                <td class="shrink"><strong>{{ modelAttribute($type, 'overall') }}</strong></td>
                <td>
                    {{ $footballer->overall }}
                </td>
                <td class="shrink"><strong>{{ modelAttribute($type, 'dominant_foot') }}</strong></td>
                <td>                        
                    {{ modelAttribute($type, 'options.dominant_foot.' . $footballer->dominant_foot) }}
                </td>
                <td class="shrink"><strong>{{ modelAttribute($type, 'positions') }}</strong></td>
                <td>
                    {{ $footballer->positions->pluck('name')->implode(', ') }}
                </td>
                <td class="d-flex justify-content-end">
                    <span class="mr-2 message"></span>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="update-request" value="name">
                        <label class="custom-control-label"></label>
                    </div>
                </td>
            </tr>                           
        @endforeach            
    </table>
</div> 
@endcomponent