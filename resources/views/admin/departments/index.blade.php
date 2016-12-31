@extends('admin.base')

@section('content')
    <h1>Отделения</h1>

    <a class="btn btn-primary" href="{{ route('admin.departments.create') }}">Создать отделение</a>

    <form class="pull-right">
        <input class="form-control" type="text" placeholder="Поиск" name="search">
    </form>
    <div class="clearfix"></div>

    @if ($search)
        <p style="margin-top: 1em;">
        Поиск: "{{ $search }}"
        </p>
    @endif

    <table class="table" style="margin-top: .75em;">
        <thead>
        <td>Регион</td>
        <td>Название</td>
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