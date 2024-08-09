@php

use App\Models\Subscription;

@endphp

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="shrink subscription-status p-0">
            </th>

            <th class="shrink">
                {{ __('Status') }}
            </th>

            <th>
                {{ __('Motivo') }}
            </th>

            <th class="shrink">
                {{ __('Desde') }}
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($statuses as $status)
            <tr class="border-status-{{ $status->name }}">
                <td class="shrink subscription-status bg-status-{{ $status->name }} p-0">
                </td>

                <td class="shrink">
                    {{ modelAttribute('App\\Models\\Subscription', "options.status.$status->name") }}
                    @if ($loop->index == 0)
                        <span class="fa fa-check-circle text-primary"></span>
                    @endif
                </td>

                <td>
                    @if ($status->reason)
                        @if (in_array($status->name, [Subscription::STATUS_CANCELED, Subscription::STATUS_CANCELED_GIFT]))
                            {{
                                modelAttribute(
                                    Subscription::class,
                                    "reasons.cancellation.admin.$status->reason",
                                    "reasons.cancellation.ea.$status->reason"
                                )
                            }}
                        @elseif (in_array($status->name, [Subscription::STATUS_INACTIVE, Subscription::STATUS_ACTIVE_WR]))
                            {{ modelAttribute(Subscription::class, "reasons.deactivation.$status->reason") }}
                        @else
                            {{ $status->reason }}
                        @endif
                    @endif
                </td>

                <td class="shrink">
                    {{ $status->created_at->format(config('admin.timestamp_format')) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
