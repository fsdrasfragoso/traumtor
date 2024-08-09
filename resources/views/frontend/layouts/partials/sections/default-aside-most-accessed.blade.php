@php
    /**
     * @var \App\Models\Footballer $footballer
     * @var \App\Models\Content[]|\Illuminate\Support\Collection $moreRead
     * @var \App\Models\Content[]|\Illuminate\Support\Collection $lastRead
     */

@endphp


<div class="d-none d-lg-flex flex-column w-100 side-left ">

    @component("frontend.layouts.newsletter")
        
    @endcomponent

    <h3>Mais Acessados</h3>
    <div class="d-flex flex-column w-100">
        <ul class="d-flex flex-column w-100">
            @foreach($moreRead as $content)
            <li class="align-items-center most-accessed {{ $loop->index > 2 ?  'hide-most-content':''}}">
                <a class="d-flex align-items-center h-100 w-100" data-pjax="#main" href="{{ route('web.frontend.contents.show', [$content->folder->slug, $content->slug]) }}">
                    <span class="number">{{ $loop->index + 1 }}</span>
                    <span class="content d-flex flex-column">

                            <span class="title">{{ $content->title }}</span>
                        {{-- @component('frontend.layouts.components.content-authors')
                            @slot('authors', $content->authors)
                        @endcomponent --}}
                        {{-- <span class="summary">{{$content->summary }}</span> --}}
                        {{-- <span class="time">{{ 'Publicado em ' . $content->published_at->format('d/m/Y') }}</span> --}}
                        <span class="time">
                            @if(!$content->folders->count())
                                {{ $content->folder->title }}
                            @endif
                        </span>
                    </span>
                    @if ($footballer && !$footballer->hasRead($content))
                        <span class="has-read"></span>
                    @endif
                </a>

            </li>
            @endforeach
        </ul>
    </div>
    @if($moreRead->count() > 3)
        <div class="see-all d-flex">
            <h3 id="see-all-most" class=" w-100 h-100 align-items-center justify-content-center" >Ver todos</h3>
            <h3 id="see-less-most" class=" w-100 h-100 align-items-center justify-content-center d-none" >Ver menos</h3>
        </div>
    @endif
</div>

@push('scripts')
    @if($moreRead->count() > 3)
        <script>
            $('#see-all-most').click(function() {
                $('.hide-most-content').each(function(i,el) {
                    el.classList.add('d-flex');
                })
                $('#see-all-most').addClass('d-none');
                $('#see-less-most').removeClass('d-none');
            });
            $('#see-less-most').click(function() {
                $('.hide-most-content').each(function(i,el) {
                    el.classList.remove('d-flex');
                })
                $('#see-all-most').removeClass('d-none');
                $('#see-less-most').addClass('d-none');
            });
        </script>
    @endif
@endpush
