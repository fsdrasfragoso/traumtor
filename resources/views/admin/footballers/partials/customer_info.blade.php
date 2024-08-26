<table class="table table-striped">
    <tr>
        <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'name') }}</strong></td>
        <td>{{ $footballer->name }}</td> 
    </tr>
    <tr>
        <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'email') }}</strong></td>
        <td><a href="{{ route('web.admin.footballers.show', $footballer) }}">{{ $footballer->email }}</a></td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'document') }}</strong></td>
        <td>{{ data_get($footballer, 'document') }}</td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'phone') }}</strong></td>
        <td>{{ data_get($footballer, 'phone') }}</td>
    </tr>
    @if(data_get($footballer, 'address.city'))
    <tr>
        <td class="shrink"><strong>{{ modelAttribute(\App\Models\Footballer::class, 'city') }}</strong></td>
        <td>{{ data_get($footballer, 'address.city') . '/' . data_get($footballer, 'address.state') }}</td>
    </tr>
    @endif

</table>