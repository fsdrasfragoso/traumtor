

@extends('admin.layouts.template')

@section('title', title('Dashboard'))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', 'Dashboard')
        @slot('aside')
            <div class="row">
                <div class="col-12 my-1">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="auto-reload">
                        <label class="form-check-label" for="auto-reload">Atualizar automaticamente</label>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent

    @if(user()->can('manage dashboard') || user()->can('list', \App\Models\Footballer::class))
        {{ html()->form('GET', route('web.admin.default.show'))->open() }}
        <div class="row">
            <div class="col-12 col-lg-4 my-2">
                <div class="form-group m-0">
                    {{ html()->select('footballer', $footballers, request()->input('footballer'))->placeholder('Selecione um jogador')->class(['form-control']) }}
                </div>
            </div>
            <div class="col-12 col-lg-4 my-2">
                <div class="form-group m-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
                        </div>
                        {{ html()->text('reportrange', null)->class(['form-control']) }}
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fal fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ html()->form()->close() }}
    @endif

    @push('scripts')
        <script>
            $(function () {

               

                $('#reportrange').daterangepicker({
                    opens: 'left',
                    locale: {format: 'DD/MM/YYYY'},
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Hoje': [moment(), moment()],
                        'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                        'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                        'Esse mês': [moment().startOf('month'), moment().endOf('month')],
                        'Mês passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

            });
        </script>
    @endpush

   
    

    @can('list', App\Models\Footballer::class)
        <div class="row" id="footballer-stats-list">
            <div class="col-12 col-lg-6">
                @component('admin.layouts.components.card_clean')
                    @slot('title', 'Estatísticas dos jogadores')
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Gols Marcados</th>
                                    <th>Assistências</th>
                                    <th>Faltas Cometidas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($statistics))
                                    @foreach ($statistics->getFootballerStats(request()->input('footballer')) as $stat)
                                        <tr>
                                            <td>{{ $stat->name }}</td>
                                            <td>{{ $stat->goals }}</td>
                                            <td>{{ $stat->assists }}</td>
                                            <td>{{ $stat->fouls }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endcomponent
            </div>
        </div>
    @endcan
@endsection

@push('scripts')
    <script>
        $(() => {
            const reloadTime = 1000 * 60;
            const checkboxAutoReload = document.getElementById('auto-reload');

            const reloadContent = () => {
                

                if (checkboxAutoReload.checked == true) {
                    $.pjax.reload({container: '#footballer-stats-list'});
                   
                } else {
                    return;
                }

                setTimeout(reloadContent, reloadTime);
            };

            checkboxAutoReload.addEventListener('change', () => {
                if (checkboxAutoReload.checked == true) {
                    reloadContent();
                }
            });
        });
    </script>
@endpush
