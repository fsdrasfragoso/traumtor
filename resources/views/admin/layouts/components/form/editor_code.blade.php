@php($startHidden = $startHidden ?? false)
<div class="form-group{{ isset($class) ? ' ' . $class : '' }} {{ isset($required) && $required ? 'required' : ''  }}">
    <div id="fold-add-{{ $name }}" class="{{ !$startHidden ? 'd-none' : '' }}">
        <a href="#fold-body-{{ $name }}" data-toggle="collapse">Adicionar {{ modelAttribute($type, $name) }}</a>
    </div>
    <div id="fold-body-{{ $name }}" class="collapse {{ !$startHidden ? 'show' : '' }}">
        {{ html()->label(modelAttribute($type, $name), $name) }}
        <div id="{{ $name }}_editor" style="height: 300px;"></div>
        {{ html()->textarea($name)
            ->class(['form-control d-none', 'is-invalid' => $errors->has($name)])
            ->attributeIf($required ?? false, 'required') }}
        @include('admin.layouts.components.form.errors')
        {{ $slot }}
    </div>
</div>

<script id="val_{{ $name }}_editor" type="text/plain">{!! $value !!}</script>

@push('scripts')
    <script>
        $(function() {
			var aceEditor = ace.edit('{{ $name }}_editor');
			var aceEditorTextarea = $('#{{ $name }}');
			aceEditor.setTheme('ace/theme/monokai');
			aceEditor.session.setMode('ace/mode/{{ $mode }}');
			aceEditor.getSession().setValue($('#val_{{ $name }}_editor').html());
			aceEditorTextarea.val($('#val_{{ $name }}_editor').html());
			aceEditor.getSession().on('change', function(){
				aceEditorTextarea.val(aceEditor.getSession().getValue());
			});
            $(document).on('pjax:complete', function() {
                aceEditor.destroy();
            })

            $('#fold-add-{{ $name }} a').click(function (e) {
                console.log('weow');
                $('#fold-add-{{ $name }}').hide();
            });
        });
    </script>
@endpush
