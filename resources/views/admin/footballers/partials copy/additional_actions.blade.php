@if($totalPurchasedAmount ?? false && $totalPaidAmount ?? false && $totalBook ?? false)
    <div class="d-flex">
        <span class="text-right mr-3">Total: {{ moneyFormat($totalPurchasedAmount) }}</span>
        <span class="text-right text-success">Total pago: {{ moneyFormat($totalPaidAmount + $totalBook) }}</span>
    </div>
@endif
