<div class="form-group">
    {{ html()->label(__('Livro'), 'q[book_id][equals]') }}
    {{ html()->select('q[book_id][equals]', $books, request()->input('q.book_id.equals'))->placeholder(null)->class('form-control') }}
</div>
