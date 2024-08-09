<div id="checkout-info" class="card card--checkout-info {{ $class ?? '' }}">   
    <div class="card-body">

        <div class="d-flex justify-content-between mb-2">
            
            <div>
                <h1 class="title">{{ $title }} </h1>
                @if(isset($summary) && $summary)
                <div class="summary">{{ $summary }}</div>
                @endif
            </div>
            @if($image)
                <div class="image ml-2">
                    <img src="{{ $image }}" />
                </div>
            @endif
        </div>

        <div class="mb-1 h5"><strong>{{ moneyFormat($price) }}</strong></div>

        <div class="credit-card-value">
            <div class="mb-1">
                {{ $max_installments }}x <span class="h5">{{ moneyFormat($price / $max_installments) }}</span>
                <span class="text-muted">(total {{ moneyFormat($price) }})</span>
            </div>
        </div>
    </div>
</div>
