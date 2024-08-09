@if ($errors->has($name))
    <span class="invalid-feedback" role="alert">
        @foreach($errors->get($name) as $error)
            @if(!$loop->first)
                <br>
            @endif
            <strong>{{ $error }}</strong>
        @endforeach
    </span>
@endif

