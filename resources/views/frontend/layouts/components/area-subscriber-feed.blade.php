@php
    /**
     * @var \App\Models\Footballer $footballer
     */
    use Carbon\Carbon;
    $num_lines_title_desktop = 30;
    $num_lines_title_mobile = 20;
    $num_lines_summary_desktop = 60;
    $num_lines_summary_mobile = 50;
@endphp

@php($folder = $content->folder)
@php($link = route('web.frontend.contents.show', [$folder->slug, $content->slug]))

<div class="content flex-column w-100 ">
    <span class="folder-title">{{ $folder->title }}</span>
    <a class="content-info d-flex flex-column" href="{{ $link }}" data-pjax="#main">
    <h4 class="title-content">
         {{-- title desktop--}}
        <span class="d-none d-lg-block">
            @if (strlen($content->title) > $num_lines_title_desktop)
                {{ substr($content->title, 0, strrpos($content->title, ' ', ($num_lines_title_desktop - 3) - strlen($content->title))) . '...' }}
            @else
                {{ $content->title }}
            @endif
        </span>
        {{-- title mobile--}}
        <span class="d-block d-lg-none">
            @if (strlen($content->title) > $num_lines_title_mobile)
                {{ substr($content->title, 0, strrpos($content->title, ' ', ($num_lines_title_mobile - 3) - strlen($content->title))) . '...' }}
            @else
                {{ $content->title }}
            @endif
        </span>
    </h4>
    <p class="summary-content">
        {{-- summary desktop--}}
        <span class="d-none d-lg-block">
            @if (strlen($content->summary) > $num_lines_summary_desktop)
                {{ substr($content->summary, 0, strrpos($content->summary, ' ', ($num_lines_summary_desktop - 3) - strlen($content->summary))) . '...' }}
            @else
                {{ $content->summary }}
            @endif
        </span>
        {{-- summary mobile --}}
        <span class="d-block d-lg-none">
            @if (strlen($content->summary) > $num_lines_summary_mobile)
                {{ substr($content->summary, 0, strrpos($content->summary, ' ', ($num_lines_summary_mobile - 3) - strlen($content->summary))) . '...' }}
            @else
                {{ $content->summary }}
            @endif
        </span>
    </p>
    </a>
    <span class="authors d-flex">
        @foreach($content->authors as $author)
            @if($loop->index > 0)
                @if($loop->index < $content->authors->count() - 1)
                    ,&nbsp;
                @else
                &nbsp;e&nbsp;
                @endif
            @endif
            <a href="{{ route('web.frontend.authors.show', [$author->slug]) }}">{{ $author->name }}</a>
        @endforeach
    </span>
    @if(1)
        <span class="time">
            {{Carbon::parse($content->published_at)->day}} de 
            {{Carbon::parse($content->published_at)->locale('pt_BR')->monthName}} de
            {{Carbon::parse($content->published_at)->year}}
        </span>
    @endif

</div>