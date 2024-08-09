@php
    use App\Models\Subscription;    
@endphp

<table class="table table-striped">
    <tr>
        <td class="shrink"><strong>{{ __('ID') }}</strong></td>
        <td><a href="{{ route('web.admin.subscriptions.show', $subscription) }}">#{{ $subscription->id }}</a></td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Status') }}</strong></td>
        <td><span class="badge badge-status-{{ $subscription->status }}">{{ modelAttribute(\App\Models\Subscription::class, 'options.status.' . $subscription->status) }}</span>
            @if ($subscription->reason)
                <br/>
                @if (in_array($subscription->status, [Subscription::STATUS_CANCELED, Subscription::STATUS_CANCELED_GIFT]))
                    {{
                        modelAttribute(
                            Subscription::class,
                            "reasons.cancellation.admin.$subscription->reason",
                            "reasons.cancellation.ea.$subscription->reason"
                        )
                    }}
                @elseif (in_array($subscription->status, [Subscription::STATUS_INACTIVE, Subscription::STATUS_ACTIVE_WR]))
                    {{ modelAttribute(Subscription::class, "reasons.deactivation.$subscription->reason") }}
                @else
                    {{ $subscription->reason }}
                @endif
            @endif
        </td>
    </tr>
</table>