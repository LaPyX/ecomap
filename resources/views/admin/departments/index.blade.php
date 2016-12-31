@extends('admin.base')

@section('content')
    <h1>Отделения</h1>

    <a class="btn btn-primary" href="{{ route('admin.departments.create') }}">Создать отделение</a>

    <table class="table" style="margin-top: .75em;">
        <thead>
        <td>Регион</td>
        <td>Название</td>
        <td>Контактных лиц</td>
        </thead>
        @forelse($departments as $department)
            <tr>
                <td>
                    <a href="{{ route('admin.departments.edit', ['department' => $department->id]) }}">{{ $department->region_name }}</a>
                </td>
                <td>
                    {{ $department->name }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <i>Нет активных отделений</i>
                </td>
            </tr>
        @endforelse
    </table>
@endsection