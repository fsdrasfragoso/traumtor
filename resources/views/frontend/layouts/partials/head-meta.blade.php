@if(isset($meta))
    <meta name="description" content="{{ data_get($meta, 'OG_DESCRIPTION') }}" />

    <meta property="og:type" content="website" />

    @if(data_get($meta, 'OG_TITLE'))
        <meta property="og:title" content="{{ data_get($meta, 'OG_TITLE') }}" />
    @endif

    @if(data_get($meta, 'OG_DESCRIPTION'))
        <meta property="og:description" content="{{ data_get($meta, 'OG_DESCRIPTION') }}" />
    @endif

    @if(data_get($meta, 'OG_IMAGE'))
        <meta property="og:image" content="{{ str_replace('https://', 'http://', data_get($meta, 'OG_IMAGE')) }}" />
        <meta property="og:image:secure_url" content="{{ data_get($meta, 'OG_IMAGE') }}" />
    @endif
@endif