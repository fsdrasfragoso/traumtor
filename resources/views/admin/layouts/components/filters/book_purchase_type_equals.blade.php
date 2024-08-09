<div class="form-group">
    {{ html()->label(__('Tipo de Livro'), 'q[book_purchase_type][equals]') }}
    {{ html()->select('q[book_purchase_type][equals]', \App\Models\BookPurchase::typePlanOptions(), request()->input('q.book_purchase_type.equals'))->placeholder(null)->class('form-control') }}
</div>
