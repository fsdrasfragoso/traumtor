@php
    use Carbon\Carbon;
    // Convertendo os horários para objetos Carbon
    $startTime = Carbon::createFromFormat('H:i:s', $start_time);
    $closingTime = Carbon::createFromFormat('H:i:s', $closing_time);
    // Calculando a duração
    $duration = $startTime->diff($closingTime)->format('%H:%I:%S');
@endphp

{{$duration}}