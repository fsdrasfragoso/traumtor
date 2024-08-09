@php
    /**
     * @var \App\Models\Footballer $footballer
     * @var \App\Models\Content[]|\Illuminate\Support\Collection $moreRead
     * @var \App\Models\Content[]|\Illuminate\Support\Collection $lastRead
     */

@endphp

@if($lastRead->count() > 0)
    <div class="d-none d-lg-flex flex-column w-100 default-aside-historic-accesse">
        <h3>Últimos vistos</h3>
        <div class="d-flex flex-column w-100">
            <ul class="d-flex flex-column w-100">
                @foreach($lastRead as $content)
                <li class="align-items-center {{ $loop->index > 2 ?  'hide-historic-content':''}}">
                    <a class="d-flex align-items-center h-100 w-100" data-pjax="#main" href="{{ route('web.frontend.contents.show', [$content->folder->slug, $content->slug]) }}">
                        <span class="content d-flex flex-column">

                            <span class="title">{{ $content->title }}</span>
                            <span class="time">
                                @if(!$content->folders->count())
                                    {{ $content->folder->title }}
                                @endif
                            </span>
                        </span>
                    </a>

                </li>
                @endforeach
            </ul>
        </div>
        @if($lastRead->count() > 3)
            <div class="see-all d-flex">
                <h3 id="see-all-historic" class=" w-100 h-100 align-items-center justify-content-center" >Ver todos</h3>
                <h3 id="see-less-historic" class=" w-100 h-100 align-items-center justify-content-center d-none" >Ver menos</h3>
            </div>
        @endif
    </div>
@endif

@push('scripts')
    @if($lastRead->count() > 3)
        <script>
            $('#see-all-historic').click(function() {
                $('.hide-historic-content').each(function(i,el) {
                    el.classList.add('d-flex');
                })
                $('#see-all-historic').addClass('d-none');
                $('#see-less-historic').removeClass('d-none');
            });
            $('#see-less-historic').click(function() {
                $('.hide-historic-content').each(function(i,el) {
                    el.classList.remove('d-flex');
                });
                $('#see-all-historic').removeClass('d-none');
                $('#see-less-historic').addClass('d-none');
            });
        </script>
    @endif
@endpush

