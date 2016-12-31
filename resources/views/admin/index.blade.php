@extends('admin.base')

@section('content')
    <h1>Статистика</h1>

    Всего обращений: {{ $total }}<br>
    На модерации: {{ $moderate }}<br>

    <p class="status small text-danger" v-if="isStatusPending()" style="margin-top: 1em;">
        <i class="fa fa-info-circle" aria-hidden="true"></i> Обращений в стадии рассмотрения: {{ $pending }}
    </p>

    <p class="status small text-warning" v-if="isStatusDelivered()">
        <i class="fa fa-hourglass" aria-hidden="true"></i> В работе: {{ $work }}
    </p>

    <p class="status small text-success" v-if="isStatusInProgress()">
        <i class="fa fa-check" aria-hidden="true"></i> Проблем решено: {{ $done }}
    </p>
@endsection