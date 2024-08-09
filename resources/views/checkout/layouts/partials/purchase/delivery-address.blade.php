@if ($address)
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="h3 mb-2 text-center text-lg-left">Endereço de entrega</h3>
            <p>{{$address['street'] ?? ''}}, {{$address['number'] ?? ''}}, {{$address['neighborhood'] ?? ''}}, 
                {{$address['city'] ?? ''}} - {{$address['state'] ?? ''}}, {{$address['zipCode'] ?? ''}}</p>
            <a href="{{ route('web.frontend.profiles.edit', ['redirect_url' => url()->current()]) }}" class="text-dark"><u>Atualizar endereço</u></a>
        </div>
    </div>
@else
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="h3 mb-2 text-center text-lg-left">Endereço de entrega</h3>
            <p>Você ainda não cadastrou seu endereço de entrega.</p>
            <a href="{{ route('web.frontend.profiles.edit', ['redirect_url' => url()->current()]) }}" class="text-dark"><u>Cadastrar endereço</u></a> 
            </p>
        </div>
    </div>
@endif
