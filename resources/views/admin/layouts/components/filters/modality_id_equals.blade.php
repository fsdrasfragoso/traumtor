<div class="form-group">
    {{ html()->label(__('Modalidade'), 'q[modality_id][equals]') }}
    {{ html()->select('q[modality_id][equals]', $modalities, request()->input('q.modality_id.equals'))->placeholder(null)->class('form-control') }}
</div>
