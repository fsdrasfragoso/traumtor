@php
    /** @var \App\Models\EmailActivity[] $activities */
@endphp

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th class="shrink">Atividade</th>
        <th class="shrink">Data</th>
        <th>Meta</th>
    </tr>
    </thead>
    <tbody>
    @forelse($activities as $activity)
        <tr>
            <td class="shrink">{{ modelAttribute(\App\Models\EmailActivity::class, 'options.activity.'.$activity->activity) }}</td>
            <td class="shrink">
                {{ $activity->created_at->format('d/m/Y H:i:s')}}
            </td>
            <td><a href="#data-{{$activity->id}}" data-toggle="collapse">Detalhes</a>
                <div id="data-{{$activity->id}}" class="collapse">
                    <code class="json">{{ json_encode($activity->meta) }}</code>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Não há registros no momento</td>
        </tr>
    @endforelse
    </tbody>
</table>
