<div class="row d-flex flex-column mb-2 {{ $container_class ?? '' }}">
    <b class="mb-2 {{ $title_class ?? '' }} {{ isset($disabled) ? 'text-gray-300' : '' }}">{{ modelAttribute($type, $name) }}</b>
    <div>
        @foreach($data as $key => $value)
            <div class="tag {{ $tag_class ?? '' }} {{ isset($disabled) ? 'disabled' : '' }} {{ !isset($show_icon) ? 'not-icon' : '' }}">
                <label class="mb-0">
                    <input class="tag-checkbox" {{ isset($disabled) ? 'disabled="disabled"' : 'false' }} type="checkbox" name="{{ $name }}[]" value="{{ $key }}">
                    @if(isset($show_icon))
                        <span class="cr">
                            <i class="cr-icon fa fa-check"></i>
                            <i class="cr-icon-plus fa fa-plus"></i>
                        </span>
                    @endif
                    {{ $value }}
                </label>
            </div>
        @endforeach
    </div>
</div>
