@inject('service', 'App\Services\SocialPostService')

@php
    $postData = $service->postData($post);
@endphp

<div class="social-post">
    <div class="post-body p-lg-2 ml-lg-0 {{ $postData['type'] }}">
        <a href="{{ $post->url }}" target="_blank" @if($postData['type'] === 'youtube') class="video-btn" data-toggle="modal" data-src="{{ $postData['url'] }}?feature=oembed" data-target="#myModal" data-backdrop="static" data-keyboard="false" @endif>
            @if($postData['type'] === 'instagram')
                <img id="img-post-{{ $post->id }}" src="{{ $postData['img'] }}" onerror="imgError({{ $post->id }}, '{{ $postData['type'] }}', this)"/>
                <blockquote id="blockquote-post-{{ $post->id }}" style="display: none;">
                    <p>
                        {!! $postData['title'] !!}
                    </p>
                </blockquote>
            @elseif($postData['type'] === 'twitter')
                {!! $postData['title'] !!}
            @elseif($postData['type'] === 'youtube')
                <img id="img-post-{{ $post->id }}" src="{{ $postData['img'] }}"s onerror="imgError({{ $post->id }}, '{{ $postData['type'] }}', this)" />
                <blockquote id="blockquote-post-{{ $post->id }}" style="display: none;">
                    <p>
                        {!! $postData['title'] !!}
                    </p>
                </blockquote>
            @endif
        </a>
    </div>
    <div class="post-footer">
        <div class="d-flex ml-lg-0 flex-row align-items-center py-1 author">
            <img class="mr-1" src="{{  asset('/img/frontend/'.$postData['type'].'.png') }}"/>
            <p>
                <a href="{{ $postData['authorURL'] }}" target="_blank">
                    {{ $postData['author'] }}
                </a>
            </p>
        </div>
    </div>
</div>
