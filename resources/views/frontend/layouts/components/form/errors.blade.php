@if ($errors->has($name))
    <span class="validation-input-{{$name}} invalid-feedback" role="alert">
        @foreach($errors->get($name) as $error)
            @if(!$loop->first)
                <br>
            @endif
            <strong class='auth-erro'>{{ $error }}</strong>
        @endforeach
    </span>
@endif

