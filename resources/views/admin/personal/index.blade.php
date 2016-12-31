@extends('admin.base')

@section('content')
    <h1>Сотрудники</h1>

    <a class="btn btn-primary" href="{{ route('admin.personal.create') }}">Создать сотрудника</a>

    <form class="pull-right">
        <input class="form-control" type="text" placeholder="Поиск" name="search">
    </form>

    <table class="table" style="margin-top: .75em;">
        <thead>
        <td>ФИО</td>
        <td>Отделение</td>
        <td>Должность</td>
        <td>Уведомления</td>
        </thead>
        @forelse($personalList as $personal)
            <tr>
                <td>
                    <a href="{{ route('admin.personal.edit', ['personal' => $personal->id]) }}">{{ $personal->name }}</a>
                </td>
                <td>
                    {{ isset($personal->department) ? $personal->department->name : '---' }}
                </td>
                <td>
                    {{ $personal->position }}
                </td>
                <td>
                    {{ '' !== $personal->email ? 'Включены' : 'Email не указан' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <i>Нет активных сотрудников</i>
                </td>
            </tr>
        @endforelse
    </table>
@endsection