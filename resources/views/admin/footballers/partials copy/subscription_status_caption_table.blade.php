@php
    $statuses = \App\Models\Subscription::statusOptions();
@endphp

@component('admin.layouts.components.card_clean')
    @slot('title', 'Legenda')
    @slot('class', 'mt-5')

    <div class="table-responsive">
        <table class="table">
            <tr>
                @foreach($statuses as $key => $status)
                    <td class="subscription-status px-0 bg-status-{{ $key }}"></td>
                    <td>{{ modelAttribute(\App\Models\Subscription::class, 'options.status.' . $key) }}</td>

                    @if(!(($loop->index + 1) % 3))
                        </tr>
                        <tr>
                    @endif
                @endforeach
            </tr>
        </table>
    </div>
@endcomponent
