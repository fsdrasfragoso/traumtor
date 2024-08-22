<div class="form-group {{ isset($required) && $required ? 'required' : ''  }} {{ $groupClass ?? null }}">
    @if(!(isset($label) && $label === false))
        {{ html()->label($label ?? modelAttribute($type, $name), $name)
            ->addClass($label_class ?? null)
        }}
    @endif

    <div class="schedule-group">
        @forelse($schedules as $index => $schedule)
            <div class="row mb-3" style="margin-top: 20px">
                <div class="col-md-3">
                    <label for="schedules[{{ $index }}][day]">Dia da Semana</label>
                    {{ html()->select("schedules[$index][day]", $daysOfWeek, $schedule['day'] ?? null)
                        ->class('form-control')
                        ->attribute('required', true)
                    }}
                </div>
                <div class="col-md-3">
                    <label for="schedules[{{ $index }}][startTime]">Hora de Início</label>
                    {{ html()->time("schedules[$index][startTime]", $schedule['start_time'] ?? null)
                        ->class('form-control')
                        ->attribute('required', true)
                    }}
                </div>
                <div class="col-md-3">
                    <label for="schedules[{{ $index }}][endTime]">Hora de Término</label>
                    {{ html()->time("schedules[$index][endTime]", $schedule['closing_time'] ?? null)
                        ->class('form-control')
                        ->attribute('required', true)
                    }}
                </div>
                <div class="col-md-3">
                    <label for="schedules[{{ $index }}][modality_id]">Modalidade</label>
                    {{ html()->select("schedules[$index][modality_id]", $modalities, $schedule['modality_id'] ?? null)
                        ->class('form-control')
                        ->attribute('required', true)
                    }}
                </div>
            </div>
        @empty
            <p>Nenhum horário adicionado. Clique em "Adicionar Horário" para começar.</p>
        @endforelse
        <button type="button" class="btn btn-secondary" id="add-schedule">Adicionar Horário</button>
    </div>

    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>


@push('scripts')
<script>
    document.getElementById('add-schedule').addEventListener('click', function() {
        const scheduleGroup = document.querySelector('.schedule-group');
        const newIndex = scheduleGroup.querySelectorAll('.row').length;
        const daysOfWeekOptions = @json($daysOfWeek);
        const modalitiesOptions = @json($modalities);

        const newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-3');

        // Criação das labels
        const dayLabel = createLabelElement(`Dia da Semana`, `schedules[${newIndex}][day]`);
        const startTimeLabel = createLabelElement(`Hora de Início`, `schedules[${newIndex}][startTime]`);
        const endTimeLabel = createLabelElement(`Hora de Término`, `schedules[${newIndex}][endTime]`);
        const modalityLabel = createLabelElement(`Modalidade`, `schedules[${newIndex}][modality_id]`);

        // Criação dos inputs
        const daySelect = createSelectElement(`schedules[${newIndex}][day]`, daysOfWeekOptions, 'form-control');
        const startTimeInput = createInputElement(`schedules[${newIndex}][startTime]`, 'time', 'form-control');
        const endTimeInput = createInputElement(`schedules[${newIndex}][endTime]`, 'time', 'form-control');
        const modalitySelect = createSelectElement(`schedules[${newIndex}][modality_id]`, modalitiesOptions, 'form-control');

        // Montagem das colunas
        newRow.appendChild(createColElement(dayLabel, daySelect));
        newRow.appendChild(createColElement(startTimeLabel, startTimeInput));
        newRow.appendChild(createColElement(endTimeLabel, endTimeInput));
        newRow.appendChild(createColElement(modalityLabel, modalitySelect));

        scheduleGroup.appendChild(newRow);
    });

    function createLabelElement(text, forInput) {
        const label = document.createElement('label');
        label.textContent = text;
        label.setAttribute('for', forInput);
        return label;
    }

    function createSelectElement(name, options, className) {
        const select = document.createElement('select');
        select.name = name;
        select.classList.add(className);
        select.required = true;

        for (const [value, text] of Object.entries(options)) {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = text;
            select.appendChild(option);
        }

        return select;
    }

    function createInputElement(name, type, className) {
        const input = document.createElement('input');
        input.name = name;
        input.type = type;
        input.classList.add(className);
        input.required = true;
        return input;
    }

    function createColElement(label, input) {
        const col = document.createElement('div');
        col.classList.add('col-md-3');
        col.appendChild(label);
        col.appendChild(input);
        return col;
    }
</script>
@endpush


