<div class="share-container position-relative">
    <a role="button" href="#social-{{$content->id}}" data-toggle="collapse" aria-expanded="false" aria-controls="social-{{$content->id}}"><span class="fal fa-share-alt"></span></a>
    <div id="social-{{$content->id}}" class="collapse social_bar__social-net-buttons position-absolute border share-icons">
        <div class="d-flex social-media-bar">
            <a href="{{ $facebook_link }}" class="btn" target="_blank"><span class="fab fa-facebook"></span></a>
            <a href="{{ $whatsapp_link }}" class="btn" target="_blank"><span class="fab fa-whatsapp"></span></a>
            <a href="{{ $linkedin_link }}" class="btn" target="_blank"><span class="fab fa-linkedin"></span></a>
            <a href="{{ $twitter_link }}" class="btn" target="_blank"><span class="fab fa-twitter"></span></a>
        </div>
    </div>
</div>
@if($footballer)
    @php($likes = $footballer->likesInContent($content))
    <a id="like-action"
        class="like-button {{ $likes > 0 ? 'like-button--liked' : '' }}"
        data-content-id="{{ $content->id }}"
        data-footballer-counter="{{ $likes }}"
        data-stage-counter="0">

        <div class="like-button__container">
            <i class="fal fa-heart"></i>
            <i class="fas fa-heart"></i>
        </div>
    </a>
    <a class="favorite-button"
        href="#"
        data-content-id="{{ $content->id }}"
        data-is-favorite="{{ optional($footballer)->isFavorite($content) ?? false }}">
        <span class= " {{ (optional($footballer)->isFavorite($content) ?? false) ? 'fas' : 'fal' }} fa-bookmark"></span>
    </a>
    @if(isset($allow_download) && $allow_download)
        <a class="download-button"
            href="{{ route('web.frontend.contents.download.text', [$folder->slug, $content->slug]) }}">
            <span class= "fal fa-download"></span>
        </a>
    @endif
@else
    <button class="like-btn open-auth-modal">
        <div class="like-button__container">
            <i class="fal fa-heart"></i>
        </div>
    </button>
    <button class="favorite-btn open-auth-modal">
        <span class= "fal fa-bookmark"></span>
    </button>
@endif

@push('scripts')
    <script>
        $('.share-container').on('focusout', function () {
            $('.share-icons').collapse('hide');
        });
    </script>
@endpush