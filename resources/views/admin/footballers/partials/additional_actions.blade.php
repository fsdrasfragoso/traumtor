@if($totalPurchasedAmount ?? false && $totalPaidAmount ?? false)
    <div class="d-flex">
        <span class="text-right mr-3">Total: {{ moneyFormat($totalPurchasedAmount) }}</span>
        <span class="text-right text-success">Total: {{ moneyFormat($totalPaidAmount) }}</span>
    </div>
@endif
