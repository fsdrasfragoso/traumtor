@php
    if(Request::query('birth_date_range')){
        $dateRange = Request::query('birth_date_range');
        $date = explode(' - ', $dateRange);

        $beginDate = data_get($date, 0);
        $endDate = data_get($date, 1);

        $beginDate = $beginDate
            ? now()->createFromFormat('d/m/Y', $beginDate)
            : now();
        $endDate = $endDate
            ? now()->createFromFormat('d/m/Y', $endDate)
            : now();

        $beginDate->startOfDay();
        $endDate->startOfDay();
    }

@endphp
@component('admin.layouts.components.filters.date_range')
   @slot('name', 'birth_date_range')
   @slot('label', 'Data de Nascimento')
   @slot('beginDate', $beginDate ?? null)
   @slot('endDate', $endDate ?? null)
@endcomponent
