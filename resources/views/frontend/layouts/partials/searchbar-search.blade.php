
<div id="form-search" class="searchbar {{ user() ? 'searchbar--with-admin' : '' }}" style="position: initial; display: none;">
    <div class="container" style="border:0px;">
        <div class="form">
            {{ html()->form('GET', route('web.frontend.default.index'))->id('form-search')->open() }}
                @include('frontend.layouts.partials.searchbar-filters')
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
