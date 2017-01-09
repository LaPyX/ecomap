@extends('admin.base')

@section('content')
    <h1>Текстовые страницы</h1>

    <a class="btn btn-primary" href="{{ route('admin.pages.create') }}">Создать страницу</a>

    <form class="pull-right">
        <input class="form-control" type="text" placeholder="Поиск" name="search">
    </form>

    <table class="table" style="margin-top: .75em;">
        <thead>
        <td>Название</td>
        <td>Дата создания</td>
        <td>Статус</td>
        </thead>
        @forelse($itemsList as $item)
            <tr>
                <td>
                    <a href="{{ route('admin.pages.edit', ['page' => $item->id]) }}">{{ $item->name }}</a>
                </td>
                <td>
                    {{ $item->created_at }}
                </td>
                <td>
                    {{ $item->status ? 'Опубликовано' : 'Черновик' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <i>Нет добавленных страниц</i>
                </td>
            </tr>
        @endforelse
    </table>
@endsection